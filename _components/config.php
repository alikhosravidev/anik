<?php
/**
 * تنظیمات مرکزی پروژه آنیک
 * دستیار هوشمند حقوقی
 */

// جلوگیری از دسترسی مستقیم
if (!defined('PROJECT_ROOT')) {
    define('PROJECT_ROOT', dirname(__DIR__));
}

// مسیرهای اصلی
define('COMPONENTS_PATH', PROJECT_ROOT . '/_components/');
define('ASSETS_PATH', '/assets/');
define('DATA_PATH', PROJECT_ROOT . '/data/');

// تنظیمات زبان
define('SITE_LANG', 'fa');
define('SITE_DIR', 'rtl');

// اطلاعات پروژه
$siteConfig = [
    'name' => 'آنیک',
    'description' => 'دستیار هوشمند حقوقی - تنظیم شکواییه در ۵ دقیقه',
    'version' => '1.0.0',
    'disclaimer' => 'این سامانه وکیل دادگستری نیست و صرفاً پیش‌نویس اوراق قضایی را تنظیم می‌کند. مسئولیت صحت اطلاعات با کاربر است.',
];

// رنگ‌های پروژه (از سند UI Kit)
$colors = [
    'primary' => '#1A3A5F',      // آبی لاجوردی
    'secondary' => '#4A90E2',    // آبی آسمانی
    'background' => '#F9FAFB',   // سفید کاغذی
    'success' => '#27AE60',      // سبز کله‌غازی
    'warning' => '#F39C12',      // نارنجی هشدار
    'text' => '#333333',         // خاکستری تیره
];

// توابع کمکی برای کامپوننت‌ها
function component($name, $data = []) {
    extract($data);
    $componentPath = COMPONENTS_PATH . $name . '.php';

    if (file_exists($componentPath)) {
        include $componentPath;
    } else {
        echo "<!-- Component '$name' not found -->";
    }
}

function asset($path) {
    return ASSETS_PATH . ltrim($path, '/');
}

// تابع کمکی برای لود JSON
function loadJson($filename) {
    $filePath = DATA_PATH . $filename;
    if (file_exists($filePath)) {
        return json_decode(file_get_contents($filePath), true);
    }
    return null;
}
?>
