<?php
/**
 * پنل کاربر - صفحه اصلی
 * فرم ساده شروع داستان
 */
define('PROJECT_ROOT', dirname(__DIR__));
require_once PROJECT_ROOT . '/_components/config.php';

$pageTitle = 'پنل کاربری';

component('head');
?>

<body class="bg-background min-h-screen">

  <?php component('header', ['isLoggedIn' => true]); ?>

  <main class="container mx-auto px-4 py-8">

    <!-- خوش‌آمدگویی -->
    <div class="max-w-3xl mx-auto">

      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-textDark mb-2">سلام! 👋</h1>
        <p class="text-gray-600">برای شروع، ماجرای خود را به زبان ساده بگویید</p>
      </div>

      <!-- سلب مسئولیت -->
      <div class="mb-8">
        <?php component('disclaimer'); ?>
      </div>

      <!-- فرم شروع داستان -->
      <div class="card">
        <div class="card-body">

          <form id="story-form" onsubmit="return handleStorySubmit(event)">

            <div class="mb-6">
              <label class="form-label text-lg">
                چه اتفاقی افتاده است؟
              </label>
              <p class="text-gray-500 text-sm mb-4">
                به زبان ساده و خودمانی بنویسید. نگران اصطلاحات حقوقی نباشید.
              </p>
              <textarea
                id="user-story"
                name="story"
                class="form-input min-h-[150px] resize-none"
                placeholder="مثال: دوستم ماشینم را برای یک هفته امانت گرفت ولی الان ۳ ماه است برنمی‌گرداند..."
                required
              ></textarea>
              <p class="form-hint mt-2">
                💡 هرچه جزئیات بیشتری بنویسید، بهتر می‌توانیم کمکتان کنیم
              </p>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-full">
              بررسی و ادامه
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
              </svg>
            </button>

          </form>

        </div>
      </div>

      <!-- یا انتخاب مستقیم نوع مشکل -->
      <div class="mt-8">
        <p class="text-center text-gray-500 mb-6">یا مستقیماً نوع مشکل خود را انتخاب کنید:</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

          <a href="/panel/wizard.php?type=khianat" class="crime-card">
            <div class="crime-card-icon">🤝</div>
            <div class="crime-card-title">خیانت در امانت</div>
            <div class="crime-card-subtitle">خودرو، چک، سفته، پول</div>
          </a>

          <a href="/panel/wizard.php?type=tohin" class="crime-card">
            <div class="crime-card-icon">🗣️</div>
            <div class="crime-card-title">توهین و فحاشی</div>
            <div class="crime-card-subtitle">فضای مجازی یا حقیقی</div>
          </a>

          <a href="/panel/wizard.php?type=mozahemat" class="crime-card">
            <div class="crime-card-icon">📞</div>
            <div class="crime-card-title">مزاحمت</div>
            <div class="crime-card-subtitle">تلفنی، بانوان، اطفال</div>
          </a>

        </div>
      </div>

    </div>

  </main>

  <?php component('footer'); ?>

  <script src="<?= asset('js/app.js') ?>"></script>
  <script>
    function handleStorySubmit(e) {
      e.preventDefault();

      const story = document.getElementById('user-story').value.trim();

      if (story.length < 20) {
        App.showToast('لطفاً توضیحات بیشتری بنویسید', 'warning');
        return false;
      }

      // ذخیره داستان
      sessionStorage.setItem('anik_user_story', story);

      // نمایش لودینگ
      const btn = e.target.querySelector('button');
      btn.innerHTML = '<span class="loading">در حال تحلیل...</span>';
      btn.disabled = true;

      // شبیه‌سازی تحلیل AI
      setTimeout(() => {
        // تشخیص نوع جرم بر اساس کلمات کلیدی (شبیه‌سازی)
        let detectedType = 'unknown';
        const storyLower = story.toLowerCase();

        if (storyLower.includes('امانت') || storyLower.includes('برنگرداند') || storyLower.includes('پس نداد') || storyLower.includes('ماشین') || storyLower.includes('چک') || storyLower.includes('سفته')) {
          detectedType = 'khianat';
        } else if (storyLower.includes('توهین') || storyLower.includes('فحش') || storyLower.includes('فحاشی') || storyLower.includes('ناسزا')) {
          detectedType = 'tohin';
        } else if (storyLower.includes('مزاحم') || storyLower.includes('زنگ') || storyLower.includes('تماس') || storyLower.includes('پیامک')) {
          detectedType = 'mozahemat';
        }

        sessionStorage.setItem('anik_detected_type', detectedType);

        // هدایت به wizard
        window.location.href = '/panel/wizard.php?type=' + detectedType;
      }, 2000);

      return false;
    }
  </script>

</body>
</html>
