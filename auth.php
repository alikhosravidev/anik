<?php
/**
 * صفحه ورود با OTP
 * آنیک - دستیار هوشمند حقوقی
 */
define('PROJECT_ROOT', __DIR__);
require_once PROJECT_ROOT . '/_components/config.php';

$pageTitle = 'ورود به آنیک';
$step = isset($_GET['step']) ? $_GET['step'] : 'mobile';

component('head');
?>

<body class="bg-background min-h-screen flex flex-col">

  <?php component('header', ['showLogin' => false]); ?>

  <main class="flex-1 flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-md">

      <!-- لوگو -->
      <div class="text-center mb-8">
        <div class="w-20 h-20 bg-primary rounded-2xl flex items-center justify-center mx-auto mb-4">
          <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
          </svg>
        </div>
        <h1 class="text-2xl font-bold text-textDark">ورود به آنیک</h1>
        <p class="text-gray-600 mt-2">دستیار هوشمند حقوقی شما</p>
      </div>

      <!-- کارت فرم -->
      <div class="card">
        <div class="card-body">

          <!-- مرحله ۱: شماره موبایل -->
          <div id="step-mobile" class="<?= $step !== 'mobile' ? 'hidden' : '' ?>">
            <h2 class="text-lg font-bold text-textDark mb-2">شماره موبایل خود را وارد کنید</h2>
            <p class="text-gray-600 text-sm mb-6">کد تایید به این شماره ارسال می‌شود</p>

            <form id="mobile-form" onsubmit="return handleMobileSubmit(event)">
              <div class="mb-6">
                <label class="form-label">شماره موبایل</label>
                <input
                  type="tel"
                  id="mobile"
                  name="mobile"
                  class="form-input text-left"
                  dir="ltr"
                  placeholder="09123456789"
                  maxlength="11"
                  pattern="09[0-9]{9}"
                  inputmode="numeric"
                  required
                  autofocus
                >
                <p class="form-hint">مثال: ۰۹۱۲۳۴۵۶۷۸۹</p>
              </div>

              <button type="submit" class="btn btn-primary w-full">
                دریافت کد تایید
              </button>
            </form>
          </div>

          <!-- مرحله ۲: کد OTP -->
          <div id="step-otp" class="<?= $step !== 'otp' ? 'hidden' : '' ?>">
            <h2 class="text-lg font-bold text-textDark mb-2">کد تایید را وارد کنید</h2>
            <p class="text-gray-600 text-sm mb-6">
              کد ۴ رقمی به شماره <span id="display-mobile" class="font-bold text-secondary">۰۹۱۲۳۴۵۶۷۸۹</span> ارسال شد
            </p>

            <form id="otp-form" onsubmit="return handleOTPSubmit(event)">
              <div class="mb-6">
                <div class="otp-container">
                  <input type="text" class="otp-input" maxlength="1" inputmode="numeric" autofocus>
                  <input type="text" class="otp-input" maxlength="1" inputmode="numeric">
                  <input type="text" class="otp-input" maxlength="1" inputmode="numeric">
                  <input type="text" class="otp-input" maxlength="1" inputmode="numeric">
                </div>
              </div>

              <button type="submit" id="otp-submit" class="btn btn-primary w-full opacity-50 cursor-not-allowed" disabled>
                تایید و ورود
              </button>

              <div class="text-center mt-4">
                <button type="button" id="resend-btn" class="text-secondary text-sm hover:underline" disabled>
                  ارسال مجدد کد (<span id="countdown">60</span> ثانیه)
                </button>
              </div>

              <div class="text-center mt-4">
                <button type="button" onclick="goToMobileStep()" class="text-gray-600 text-sm hover:underline">
                  تغییر شماره موبایل
                </button>
              </div>
            </form>
          </div>

        </div>
      </div>

      <!-- سلب مسئولیت -->
      <div class="mt-6">
        <?php component('disclaimer', ['disclaimerClass' => 'text-xs']); ?>
      </div>

    </div>
  </main>

  <script src="<?= asset('js/app.js') ?>"></script>
  <script>
    let countdownInterval;
    let userMobile = '';

    function handleMobileSubmit(e) {
      e.preventDefault();
      const mobileInput = document.getElementById('mobile');
      const mobile = mobileInput.value.replace(/\D/g, '');

      // اعتبارسنجی
      if (!/^09\d{9}$/.test(mobile)) {
        mobileInput.classList.add('border-red-500');
        App.showToast('شماره موبایل معتبر نیست', 'error');
        return false;
      }

      userMobile = mobile;

      // نمایش لودینگ
      const btn = e.target.querySelector('button');
      btn.innerHTML = '<span class="loading">در حال ارسال...</span>';
      btn.disabled = true;

      // شبیه‌سازی ارسال OTP
      setTimeout(() => {
        document.getElementById('step-mobile').classList.add('hidden');
        document.getElementById('step-otp').classList.remove('hidden');
        document.getElementById('display-mobile').textContent = mobile;

        // شروع شمارش معکوس
        startCountdown();

        // فوکوس روی اولین فیلد OTP
        document.querySelector('.otp-input').focus();

        App.showToast('کد تایید ارسال شد', 'success');
      }, 1500);

      return false;
    }

    function handleOTPSubmit(e) {
      e.preventDefault();

      const otpInputs = document.querySelectorAll('.otp-input');
      const otp = Array.from(otpInputs).map(i => i.value).join('');

      if (otp.length !== 4) {
        App.showToast('کد تایید را کامل وارد کنید', 'error');
        return false;
      }

      // نمایش لودینگ
      const btn = document.getElementById('otp-submit');
      btn.innerHTML = '<span class="loading">در حال بررسی...</span>';
      btn.disabled = true;

      // شبیه‌سازی تایید OTP
      setTimeout(() => {
        // ذخیره در session
        sessionStorage.setItem('anik_user_mobile', userMobile);
        sessionStorage.setItem('anik_logged_in', 'true');

        App.showToast('ورود موفق!', 'success');

        // هدایت به پنل
        setTimeout(() => {
          window.location.href = '/panel/index.php';
        }, 500);
      }, 1500);

      return false;
    }

    function goToMobileStep() {
      document.getElementById('step-otp').classList.add('hidden');
      document.getElementById('step-mobile').classList.remove('hidden');

      // ریست فرم
      const btn = document.querySelector('#mobile-form button');
      btn.innerHTML = 'دریافت کد تایید';
      btn.disabled = false;

      clearInterval(countdownInterval);
    }

    function startCountdown() {
      let seconds = 60;
      const countdownEl = document.getElementById('countdown');
      const resendBtn = document.getElementById('resend-btn');

      resendBtn.disabled = true;

      countdownInterval = setInterval(() => {
        seconds--;
        countdownEl.textContent = seconds;

        if (seconds <= 0) {
          clearInterval(countdownInterval);
          resendBtn.disabled = false;
          resendBtn.innerHTML = 'ارسال مجدد کد';

          resendBtn.onclick = () => {
            App.showToast('کد جدید ارسال شد', 'success');
            startCountdown();
          };
        }
      }, 1000);
    }
  </script>

</body>
</html>
