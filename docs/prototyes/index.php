<?php
/**
 * صفحه اصلی (Landing Page)
 * آنیک - دستیار هوشمند حقوقی
 */
define('PROJECT_ROOT', __DIR__);
require_once PROJECT_ROOT . '/_components/config.php';

$pageTitle = 'تنظیم رایگان شکواییه در ۵ دقیقه';

component('head');
?>

<body class="bg-background">

  <?php component('header', ['showLogin' => true]); ?>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container mx-auto px-4">
      <h1 class="hero-title">
        تنظیم هوشمند شکواییه
        <br>
        <span class="text-secondary">در ۵ دقیقه</span>
      </h1>
      <p class="hero-subtitle">
        بدون نیاز به وکیل، شکواییه خود را به صورت حرفه‌ای و استاندارد تنظیم کنید.
        رایگان و آنلاین.
      </p>
      <a href="/auth.php" class="btn btn-secondary btn-lg inline-flex items-center gap-2">
        <span>شروع کنید</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
      </a>
    </div>
  </section>

  <!-- سلب مسئولیت -->
  <div class="container mx-auto px-4 -mt-6">
    <?php component('disclaimer'); ?>
  </div>

  <!-- خدمات ما -->
  <section class="py-16">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl font-bold text-center text-textDark mb-4">خدمات آنیک</h2>
      <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">
        با پاسخ دادن به چند سوال ساده، شکواییه حرفه‌ای خود را دریافت کنید
      </p>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">

        <!-- خیانت در امانت -->
        <div class="feature-card">
          <div class="feature-icon">🤝</div>
          <h3 class="text-xl font-bold text-textDark mb-3">خیانت در امانت</h3>
          <p class="text-gray-600 text-sm leading-relaxed">
            اگر مال یا پولی را به کسی امانت داده‌اید و برنگردانده است
            <br>
            <span class="text-xs text-gray-500">(ماده ۶۷۴ قانون مجازات)</span>
          </p>
        </div>

        <!-- توهین -->
        <div class="feature-card">
          <div class="feature-icon">🗣️</div>
          <h3 class="text-xl font-bold text-textDark mb-3">توهین و فحاشی</h3>
          <p class="text-gray-600 text-sm leading-relaxed">
            اگر کسی به شما توهین کرده یا فحاشی کرده است
            <br>
            <span class="text-xs text-gray-500">(مواد ۶۰۸ و ۶۰۹ قانون مجازات)</span>
          </p>
        </div>

        <!-- مزاحمت -->
        <div class="feature-card">
          <div class="feature-icon">📞</div>
          <h3 class="text-xl font-bold text-textDark mb-3">مزاحمت</h3>
          <p class="text-gray-600 text-sm leading-relaxed">
            اگر کسی برای شما مزاحمت تلفنی یا حضوری ایجاد کرده
            <br>
            <span class="text-xs text-gray-500">(مواد ۶۴۱ و ۶۱۹ قانون مجازات)</span>
          </p>
        </div>

      </div>
    </div>
  </section>

  <!-- نحوه کار -->
  <section class="py-16 bg-white">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl font-bold text-center text-textDark mb-12">چگونه کار می‌کند؟</h2>

      <div class="grid grid-cols-1 md:grid-cols-4 gap-8 max-w-5xl mx-auto">

        <div class="text-center">
          <div class="w-16 h-16 bg-secondary text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">۱</div>
          <h3 class="font-bold text-textDark mb-2">ورود با موبایل</h3>
          <p class="text-gray-600 text-sm">فقط با شماره موبایل وارد شوید</p>
        </div>

        <div class="text-center">
          <div class="w-16 h-16 bg-secondary text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">۲</div>
          <h3 class="font-bold text-textDark mb-2">شرح ماجرا</h3>
          <p class="text-gray-600 text-sm">داستان خود را به زبان ساده بگویید</p>
        </div>

        <div class="text-center">
          <div class="w-16 h-16 bg-secondary text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">۳</div>
          <h3 class="font-bold text-textDark mb-2">پاسخ به سوالات</h3>
          <p class="text-gray-600 text-sm">به چند سوال کوتاه پاسخ دهید</p>
        </div>

        <div class="text-center">
          <div class="w-16 h-16 bg-success text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">۴</div>
          <h3 class="font-bold text-textDark mb-2">دریافت شکواییه</h3>
          <p class="text-gray-600 text-sm">فایل PDF حرفه‌ای را دانلود کنید</p>
        </div>

      </div>

      <div class="text-center mt-12">
        <a href="/auth.php" class="btn btn-primary btn-lg">
          همین الان شروع کنید - رایگان
        </a>
      </div>
    </div>
  </section>

  <!-- سوالات متداول -->
  <section class="py-16">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl font-bold text-center text-textDark mb-12">سوالات متداول</h2>

      <div class="max-w-3xl mx-auto space-y-4">

        <div class="card">
          <div class="card-body">
            <h3 class="font-bold text-textDark mb-2">آیا این سرویس رایگان است؟</h3>
            <p class="text-gray-600 text-sm">بله، تنظیم شکواییه در آنیک کاملاً رایگان است.</p>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h3 class="font-bold text-textDark mb-2">آیا شکواییه تولید شده معتبر است؟</h3>
            <p class="text-gray-600 text-sm">شکواییه بر اساس فرمت استاندارد دادسراها تنظیم می‌شود و قابل ارائه به دفاتر خدمات قضایی است.</p>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h3 class="font-bold text-textDark mb-2">اطلاعات من امن است؟</h3>
            <p class="text-gray-600 text-sm">اطلاعات شما فقط برای تنظیم شکواییه استفاده می‌شود و به هیچ شخص ثالثی ارائه نمی‌شود.</p>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h3 class="font-bold text-textDark mb-2">بعد از دریافت شکواییه چه کنم؟</h3>
            <p class="text-gray-600 text-sm">شکواییه را پرینت کرده و به همراه مدارک هویتی به نزدیک‌ترین دفتر خدمات الکترونیک قضایی مراجعه کنید.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- CTA نهایی -->
  <section class="py-16 bg-primary text-white text-center">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl font-bold mb-4">آماده‌اید شکواییه خود را تنظیم کنید؟</h2>
      <p class="text-lg opacity-90 mb-8">در کمتر از ۵ دقیقه، شکواییه حرفه‌ای خود را دریافت کنید</p>
      <a href="/auth.php" class="btn btn-secondary btn-lg">
        شروع رایگان
      </a>
    </div>
  </section>

  <?php component('footer'); ?>

  <script src="<?= asset('js/app.js') ?>"></script>

</body>
</html>
