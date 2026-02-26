---
trigger: manual
---

# Date Handling & Localization Standards

## Core Principle

This project serves a **Persian (Farsi)** audience. Dates are **displayed** in Jalali (Solar Hijri) calendar but **transmitted and stored** in Gregorian (Miladi) format.

---

## Date Flow Architecture

```
Frontend (Input)          →  API  →  Backend (Processing)  →  Database (Storage)
Gregorian (ISO 8601)         →         Gregorian                 Gregorian
e.g. "2024-01-15"                      Carbon instance           MySQL DATE/DATETIME
```

```
Database (Storage)  →  Backend (Processing)  →  API  →  Frontend (Display)
Gregorian              Carbon instance           →       DateTimeTransformer
MySQL DATE/DATETIME                                      → human.default: "25 دی 1402"
                                                         → human.short: "1402/10/25"
                                                         → human.gregorian.default: "24-01-15"
```

---

## Rules (Strictly Enforced)

### 1. Frontend Always Sends Gregorian Dates

All date pickers, date inputs, and date parameters from the frontend are in **Gregorian (Miladi)** format. The AI must **never** assume dates from the frontend are Jalali.

```php
// ❌ PROHIBITED — Assuming frontend sends Jalali and converting
$date = Verta::parse($request->input('start_date'))->toCarbon();

// ❌ PROHIBITED — Manual Jalali-to-Gregorian conversion on input
$date = jdate($request->input('start_date'))->toCarbon();

// ✅ CORRECT — Frontend sends Gregorian, parse directly
$date = Carbon::parse($request->input('start_date'));

// ✅ CORRECT — Use Laravel's date validation (expects Gregorian)
'start_date' => ['required', 'date', 'date_format:Y-m-d'],
```

### 2. Backend Stores Gregorian

All database columns (`DATE`, `DATETIME`, `TIMESTAMP`) store Gregorian dates. Never store Jalali date strings in the database.

### 3. Response Formatting Is Automatic

`BaseTransformer` auto-detects date fields (`*_at`, `deadline`, `due_date`, `expires_at`, etc.) and applies `DateTimeTransformer` which outputs:

```json
{
    "main": "2024-01-15T10:30:00",
    "timestamp": 1705312200,
    "human": {
        "default": "25 دی 1402",
        "short": "1402/10/25",
        "long": "25 دی 1402 ساعت 10:30",
        "gregorian": {
            "default": "24-01-15",
            "long": "January 15, 2024 10:30"
        }
    }
}
```

This means the Jalali conversion for **display** is handled entirely by the transformer layer — **no manual Jalali conversion is needed anywhere**.

### 4. Date Filtering in V3 API

When filtering by date via `RequestCriteria`, dates in `search` parameters are **Gregorian**:

```php
// In FilterBuilder (v3Params):
->where('created_at', '>=', '2024-01-01')
->between('due_date', '2024-01-01', '2024-12-31')

// Via query string:
// ?search=created_at:2024-01-15&searchFields=created_at:=
```

### 5. No Jalali Logic in Backend Code

Backend code (Controllers, Services, Repositories, Criteria) must **never** perform Jalali-to-Gregorian or Gregorian-to-Jalali conversion for data processing. The only place Jalali appears is in:
- `DateTimeTransformer` (automatic, for API response display)
- Blade views (for human-readable display via `@jalali` or Verta helpers)
- Notification/email templates (for user-facing date display)

---

## Common Mistakes to Avoid

| Mistake | Why It's Wrong | Correct Approach |
|---------|---------------|-----------------|
| Converting input dates from Jalali | Frontend sends Gregorian | Parse with `Carbon::parse()` directly |
| Storing Jalali strings in DB | Breaks sorting, indexing, comparisons | Store as Gregorian `DATE`/`DATETIME` |
| Manual Jalali formatting in Controller | Controllers don't format data | Let `DateTimeTransformer` handle it |
| Comparing dates with Jalali strings | String comparison fails | Compare `Carbon` instances |
| Adding Verta/Jalali dependencies in Services | Services don't handle display | Only Transformers/Views use Jalali |
