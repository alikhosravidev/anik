<?php
// دریافت عنوان صفحه (اگر تعریف نشده، مقدار پیش‌فرض)
$pageTitle = $pageTitle ?? 'صفحه اصلی';
$fullTitle = $pageTitle . ' | ' . $siteConfig['name'];
?>
<!DOCTYPE html>
<html dir="<?= SITE_DIR ?>" lang="<?= SITE_LANG ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $fullTitle ?></title>
  <meta name="description" content="<?= $siteConfig['description'] ?>">

  <!-- Vazirmatn Font -->
  <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Tailwind Config -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#1A3A5F',
            secondary: '#4A90E2',
            background: '#F9FAFB',
            success: '#27AE60',
            warning: '#F39C12',
            textDark: '#333333',
          },
          fontFamily: {
            vazir: ['Vazirmatn', 'sans-serif'],
          }
        }
      }
    }
  </script>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?= asset('css/main.css') ?>">

  <style>
    * { font-family: 'Vazirmatn', sans-serif; }
    body { background-color: #F9FAFB; }
  </style>
</head>
