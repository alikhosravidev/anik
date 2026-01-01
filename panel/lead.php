<?php
/**
 * صفحه Lead Generation
 * برای موضوعات خارج از محدوده
 */
define('PROJECT_ROOT', dirname(__DIR__));
require_once PROJECT_ROOT . '/_components/config.php';

$pageTitle = 'درخواست مشاوره';

component('head');
?>

<body class="bg-background min-h-screen">

  <?php component('header', ['isLoggedIn' => true]); ?>

  <main class="container mx-auto px-4 py-8">
    <div class="max-w-lg mx-auto">

      <div class="card">
        <div class="card-body text-center">

          <div class="w-20 h-20 bg-warning bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-6">
            <span class="text-4xl">🤝</span>
          </div>

          <h1 class="text-2xl font-bold text-textDark mb-4">موضوع شما تخصصی است</h1>

          <p class="text-gray-600 mb-6 leading-relaxed">
            متأسفانه موضوع شما در حال حاضر خارج از محدوده خدمات آنیک است و نیاز به بررسی توسط وکیل متخصص دارد.
          </p>

          <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6 text-right">
            <p class="text-blue-800 text-sm">
              برای دریافت مشاوره رایگان یا ارزان با وکلای همکار ما، شماره تماس خود را وارد کنید تا با شما تماس بگیریم.
            </p>
          </div>

          <form id="lead-form" onsubmit="return handleLeadSubmit(event)">

            <div class="mb-4 text-right">
              <label class="form-label">شماره موبایل</label>
              <input
                type="tel"
                name="mobile"
                class="form-input text-left"
                dir="ltr"
                placeholder="09123456789"
                maxlength="11"
                inputmode="numeric"
                required
              >
            </div>

            <div class="mb-6 text-right">
              <label class="form-label">توضیح مختصر موضوع</label>
              <textarea
                name="description"
                class="form-input"
                rows="3"
                placeholder="موضوع خود را به اختصار بنویسید..."
              ></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-full">
              درخواست تماس
            </button>

          </form>

          <div class="mt-6 pt-6 border-t">
            <a href="/panel/index.php" class="text-secondary hover:underline text-sm">
              بازگشت به صفحه اصلی
            </a>
          </div>

        </div>
      </div>

    </div>
  </main>

  <?php component('footer'); ?>

  <script src="<?= asset('js/app.js') ?>"></script>
  <script>
    function handleLeadSubmit(e) {
      e.preventDefault();

      const mobile = e.target.mobile.value;
      const description = e.target.description.value;

      // اعتبارسنجی
      if (!/^09\d{9}$/.test(mobile)) {
        App.showToast('شماره موبایل معتبر نیست', 'error');
        return false;
      }

      // نمایش لودینگ
      const btn = e.target.querySelector('button');
      btn.innerHTML = '<span class="loading">در حال ثبت...</span>';
      btn.disabled = true;

      // شبیه‌سازی ثبت
      setTimeout(() => {
        App.showToast('درخواست شما ثبت شد. به زودی با شما تماس می‌گیریم.', 'success');

        setTimeout(() => {
          window.location.href = '/panel/index.php';
        }, 2000);
      }, 1500);

      return false;
    }
  </script>

</body>
</html>
