# Anic – AI Context & Development Guidelines

This document outlines the architectural principles, strict coding rules, and workflow standards for the Anic project. **Adherence is mandatory.**

## 1. Project Context
- **Stack:** Laravel 12 (Core), Monolithic architecture
- **Localization:** Persian (Jalali dates, RTL support). Enums must have a `label()` method for Persian output.
- **Environment:** All commands **must** run via Docker:
  ```bash
  docker exec anik_app php artisan [command]
  docker exec anik_app composer [command]
  ```

## 2. Architecture & Request Flow
**Pattern:** `Request → FormRequest → Mapper → DTO → Service → Entity → Transformer → Response`

### Module Structure
- **Paths:** `app` (Core Monolithic).
- **Key Directories:**
    - `Contracts/`, `Entities/` (Eloquent), `ValueObjects/` (Immutable), `Enums/`
    - `DTOs/` (Readonly), `Mappers/`, `Services/` (Logic)
    - `Http/` (Controllers, Transformers, Requests), `Observers/`, `Database/`

### Layer Responsibilities
- **Controllers:** Thin layers for HTTP parsing/delegation only. **No private methods.** Max 3 lines of logic.
- **Services:** Pure business logic, transaction management, and event firing. **No intra-module event listeners.**
- **Transformers:** Pipeline-based response transformation with `getVirtualFieldResolvers()`. **Never return raw models.**
- **Entities:** Lean Eloquent models. Use `$fillable` strictly (**never** `$guarded`).

## 3. Critical Development Rules (Strictly Enforced)

### General Coding
- **Strict Types:** `declare(strict_types=1);` is **mandatory** on first line of every PHP file.
- **Language:** English for all code, comments, and commit messages.
- **JS/TS:** String literals must be assigned to `const` variables before use.
- **Formatting:** PSR-12 via `standards/formatter/pint.json`. Single quotes, short arrays `[]`, trailing commas.
- **Comments:** Code should be self-documenting. Comments explain **WHY, never WHAT or HOW**. Avoid obvious code, commented-out code, and bad naming explanations—fix naming instead.

### Data & Objects
- **DTOs:** Constructor-based, readonly properties. **Only** `toArray()` method allowed.
- **Enums:** Use `Rule::enum(EnumClass::class)` for validation. **Hardcode values** in migrations (never reference Enum classes).
- **ValueObjects:** Self-validating upon construction.

### Database
- **Migrations:** **Two-phase** required for Foreign Keys (1. Create table with nullable columns, 2. Add constraints).
- **Naming:** `anik_{resource_plural}` (e.g., `anik_users`).
- **Factories:** Use factories for test data generation.

### Security & Error Handling
- **Exceptions:** **No nested try-catch**. Use `BusinessException` / `TechnicalException` for auto-rendering.
- **Validation:** Use `EntityValidator` and `FormRequest`.
- **Sanitization:** Blacklist sensitive fields in Transformers.
- **Auth:** Sanctum (`Authorization: Bearer`).

---

## 5. Mandatory Pre-Execution Protocol

> ⛔ **THIS PROTOCOL IS NON-NEGOTIABLE.**
> Do not stop under any circumstances during development. Create a comprehensive checklist of your tasks so you never lose track of which stage you are in.
> Generating any code, command, or structural output **without completing this protocol first is a critical violation.**
> There are no exceptions — not for small tasks, not for "obvious" tasks, not for single-line changes.

### Phase 0 — HARD GATE (Blocking)

Before **any** output, you must display the following checklist **filled and visible** to the user.

```
╔══════════════════════════════════════════════════════════════╗
║           🔒 PRE-EXECUTION GATE — MANDATORY CHECK            ║
╠══════════════════════════════════════════════════════════════╣
║ [ ] 1. Target Asset identified:                              ║
║        → {e.g., Service class, DTO, Migration, Controller}   ║
║ [ ] 2. Architecture Layer identified:                        ║
║        → {e.g., Business Logic, HTTP, Domain, Testing}       ║
║ [ ] 3. Instruction files matched from Index:                 ║
║        → {file path} — {reason it was matched}               ║
║        → {file path} — {reason it was matched}               ║
║ [ ] 4. Each matched file READ via tool/workspace agent:      ║
║        → Proof: quote one directly relevant rule per file    ║
║ [ ] 5. No conflicts between loaded instructions confirmed    ║
╚══════════════════════════════════════════════════════════════╝
```

---

### Phase 1 — Analyze (Thought)

State explicitly:
- **Target Asset:** What specific file type is being created or modified?
- **Architecture Layer:** Which system boundary does this touch?
- **Tech Stack:** What is the primary language and framework?

---

### Phase 2 — Retrieve & Prove Context (Action — BLOCKING)

1. Consult the **Instruction Files Index** (Section 6 of this document).
2. Identify **every** matching instruction file for the task.
3. **Read each file** using the `@workspace` agent or available file-reading tools.
4. **Mandatory proof of reading:** For each file read, quote at least one rule that is directly applicable to this task. Without this quote, the file is considered **unread**.

> 🚫 **You are explicitly prohibited from proceeding to Phase 3 if:**
> - You cannot confirm reading a matched instruction file.
> - You rely solely on memory or prior training for project-specific rules.
> - The proof quote is missing or generic (not from the actual file content).

---

### Phase 3 — Execute (Act)

Generate the code or implement the requested modifications.
Every decision must be traceable to a rule from the files loaded in Phase 2.
If a decision cannot be traced → apply the most conservative interpretation and flag it.

---

### Phase 4 — Self-Evaluate & Correct (Reflexion)

Before presenting the final output, perform an internal review:

1. **Checklist:** Go through each rule quoted in Phase 2. Does the generated code comply?
2. **Anti-pattern scan:** Does any output violate principles in `coding-standards.md` or `cto.md`?
3. **Fix:** If violations exist, correct them independently. Maximum **2 refinement iterations**.
4. **Final declaration:** End your response with:

```
✅ Self-Evaluation Complete
- Rules applied: {list}
- Violations found and fixed: {list or "none"}
- Remaining concerns: {list or "none"}
```

---

## 5. Instructions Routing Map

> This index is the **source of truth** for Phase 2. Every matched file **must** be read before code generation.

### Review Mode Detection

If the task contains any of these keywords, activate **Review Mode**:

| Keyword in Task | Review Type | Instructions to Load |
| :--- | :--- | :--- |
| "review", "check", "audit" | Code Review | [cto.md](AI/instructions/cto.md) + instruction(s) matching the file type |
| "review test", "test review" | Test Review | The matching `-review.md` file from the test section below |
| "refactor" | Refactor Review | [cto.md](AI/instructions/cto.md) + [coding-standards.md](AI/instructions/coding/coding-standards.md) + instruction(s) for the relevant layer |

---

#### Presentation Layer

##### [transformers.md](AI/instructions/presentation/transformers.md)
* **Trigger Condition:** Creating or editing a Transformer class, shaping API response output, adding relationship includes, or applying field-level transformations.
* **Purpose/Action:** Pipeline-based transformation using `BaseTransformer` (built on League Fractal). Covers `getVirtualFieldResolvers()` for computed fields, `fieldTransformers` for type coercion (e.g., `EnumTransformer`), `availableIncludes` for relationships, and recursive nested includes. Raw models must never be returned directly.

---

#### Business Logic Layer

##### [data-transfer-objects.md](AI/instructions/business_logic/data-transfer-objects.md)
* **Trigger Condition:** Creating or editing a DTO class, or transferring structured data between application layers.
* **Purpose/Action:** DTOs must have a constructor with at least one required `public readonly` property. No business logic, no static factory methods. Only `toArray()` is permitted as an additional method (when implementing `Arrayable`). Required parameters come before optional ones.

##### [value-objects.md](AI/instructions/business_logic/value-objects.md)
* **Trigger Condition:** Creating or editing a Value Object, encapsulating domain concepts (e.g., `Email`, `Money`, `NationalCode`).
* **Purpose/Action:** Value Objects are immutable domain-layer constructs defined by their values, not identity. They self-validate upon construction via a `private __construct` and a static named constructor (e.g., `fromString`). They belong strictly in the Domain Layer. Provide `equals()` and `__toString()`. Mutating methods return new instances.

##### [mappers.md](AI/instructions/business_logic/mappers.md)
* **Trigger Condition:** Transforming an HTTP `Request` into a DTO, or updating a DTO from a `Request` while preserving existing entity values.
* **Purpose/Action:** Mappers contain only data transformation logic — no business rules. Use `fromRequest(Request $request): DTO` for creation and `fromRequestForUpdate(Request $request, Entity $entity): DTO` for updates (filling missing fields from the existing entity). Inject dependencies via constructor when related lookups are needed.

##### [custom-collection.md](AI/instructions/business_logic/custom-collection.md)
* **Trigger Condition:** Creating a typed collection to hold a specific class of objects instead of a plain PHP array.
* **Purpose/Action:** Custom collections must extend `BaseCustomCollection` and implement `setExpectedClass()` to enforce type safety. No business or commercial logic inside collections — they are pure data-structure holders. Provide domain-specific accessor methods (e.g., `getByKey()`). Prefer immutability; return new instances for transformations.

---

#### Data / Domain Layer

##### [entities.md](AI/instructions/data_domain/entities.md)
* **Trigger Condition:** Creating or editing an Eloquent Model (Entity).
* **Purpose/Action:** Entities must remain lean — only `$fillable`, `$casts`, `$hidden`, relationships, simple accessors/mutators, and database-level hooks belong here. Always use `$fillable` (never `$guarded`). No complex queries, no external service calls, no multi-model operations. Delegate business logic and data access to Services.

##### [migration.md](AI/instructions/data_domain/migration.md)
* **Trigger Condition:** Creating or editing database migrations, adding columns, modifying indexes, or defining foreign key constraints.
* **Purpose/Action:** Each migration has a single responsibility. Always implement `down()`. Hardcode enum values as strings (never reference Enum classes). Use chunking for large data operations. Never modify already-executed production migrations — create new ones instead. Two-phase approach required for FK constraints (table first, constraints second).

##### [enums.md](AI/instructions/data_domain/enums.md)
* **Trigger Condition:** Creating or editing PHP Enum classes, or using enum values in validation, migrations, or output.
* **Purpose/Action:** Use backed enums (int or string). PascalCase for enum cases, no spacing between cases. Implement `toEnglish(): string` for user-facing English labels and the static `EnglishList(): array` for generating dropdown/select options. Use `Rule::enum(EnumClass::class)` for validation. Hardcode values in migrations.

##### [eloquent_observers.md](AI/instructions/data_domain/eloquent_observers.md)
* **Trigger Condition:** Creating or editing an Eloquent Observer, or reacting to model lifecycle events (creating, updated, deleted, etc.).
* **Purpose/Action:** Use Observers to decouple side-effects (emails, logging, event dispatching) from models and controllers. Keep observers lightweight — dispatch Jobs or Events for heavy/async work instead of executing directly. Register via `#[ObservedBy]` attribute on the model (Laravel 11+) or centrally in a ServiceProvider. Never register observers inside controllers.

---

#### Coding Standards

##### [coding-standards.md](AI/instructions/coding/coding-standards.md)
* **Trigger Condition:** Any PHP coding task, naming a class/method/variable, organizing code structure, or reviewing code quality.
* **Purpose/Action:** PSR-12 compliance, 120-char line limit, meaningful names (PascalCase classes, camelCase methods/variables, UPPER_SNAKE_CASE constants, snake_case DB columns). Thin controllers delegate to services. Avoid hardcoded strings — use boolean flags or translation files. Remove unused code. Avoid immediate re-queries after updates; use `updateAndRefresh` patterns.

---

### Event System

#### [event-listeners.md](AI/instructions/event-listeners.md)
* **Trigger Condition:** Creating or editing Events, Listeners, or deciding between event-based and direct coupling for inter-module communication.
* **Purpose/Action:** Event system standards: **intra-module event listeners are prohibited** (use direct calls within the same module). Events are only for inter-module communication. Fire Business Events for meaningful occurrences (even without current listeners). Listeners should be lightweight orchestrators — delegate business logic to services. Prefer event-based communication over direct service calls between modules for loose coupling.

---

## 7. Pattern-Based Routing (File Path → Instruction)

If you cannot determine the instruction from the task description, use the **file path** pattern:

| File/Path Pattern | Instruction(s) to Load |
| :--- | :--- |
| `app/Http/Transformers/**` or `app/Transformers/**` | [transformers.md](AI/instructions/presentation/transformers.md) |
| `app/Http/Controllers/**` | [coding-standards.md](AI/instructions/guidelines/coding-standards.md) |
| `app/Services/**` | [coding-standards.md](AI/instructions/guidelines/coding-standards.md) |
| `app/DTOs/**` | [data-transfer-objects.md](AI/instructions/business_logic/data-transfer-objects.md) |
| `app/ValueObjects/**` | [value-objects.md](AI/instructions/business_logic/value-objects.md) |
| `app/Mappers/**` | [mappers.md](AI/instructions/business_logic/mappers.md) |
| `app/Collections/**` | [custom-collection.md](AI/instructions/business_logic/custom-collection.md) |
| `app/Entities/**` or `app/Models/**` | [entities.md](AI/instructions/data_domain/entities.md) |
| `app/Enums/**` | [enums.md](AI/instructions/data_domain/enums.md) |
| `app/Observers/**` | [eloquent_observers.md](AI/instructions/data_domain/eloquent_observers.md) |
| `database/migrations/**` | [migration.md](AI/instructions/data_domain/migration.md) |
