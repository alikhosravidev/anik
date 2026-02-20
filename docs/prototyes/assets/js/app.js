/**
 * آنیک - دستیار هوشمند حقوقی
 * منطق اصلی اپلیکیشن
 */

const App = {

  // ذخیره‌سازی موقت داده‌ها
  sessionData: {},

  /**
   * مقداردهی اولیه
   */
  init() {
    this.initOTP();
    this.initWizard();
    this.initCrimeSelector();
    this.initQuickReplies();
    this.initForms();
    this.loadSessionData();
  },

  /**
   * مدیریت OTP
   */
  initOTP() {
    const otpInputs = document.querySelectorAll('.otp-input');
    if (!otpInputs.length) return;

    otpInputs.forEach((input, index) => {
      input.addEventListener('input', (e) => {
        const value = e.target.value;

        // فقط عدد
        e.target.value = value.replace(/\D/g, '').slice(0, 1);

        // رفتن به فیلد بعدی
        if (value && index < otpInputs.length - 1) {
          otpInputs[index + 1].focus();
        }

        // چک کردن تکمیل شدن
        this.checkOTPComplete();
      });

      input.addEventListener('keydown', (e) => {
        // Backspace برای برگشت
        if (e.key === 'Backspace' && !e.target.value && index > 0) {
          otpInputs[index - 1].focus();
        }
      });

      // Paste handling
      input.addEventListener('paste', (e) => {
        e.preventDefault();
        const pastedData = e.clipboardData.getData('text').replace(/\D/g, '').slice(0, 4);
        pastedData.split('').forEach((char, i) => {
          if (otpInputs[i]) {
            otpInputs[i].value = char;
          }
        });
        this.checkOTPComplete();
      });
    });
  },

  checkOTPComplete() {
    const otpInputs = document.querySelectorAll('.otp-input');
    const submitBtn = document.getElementById('otp-submit');
    if (!submitBtn) return;

    const allFilled = Array.from(otpInputs).every(input => input.value.length === 1);
    submitBtn.disabled = !allFilled;

    if (allFilled) {
      submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
    } else {
      submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
    }
  },

  /**
   * مدیریت Wizard
   */
  initWizard() {
    this.currentStep = 1;
    this.totalSteps = document.querySelectorAll('[data-wizard-step]').length;

    // دکمه‌های بعدی
    document.querySelectorAll('[data-wizard-next]').forEach(btn => {
      btn.addEventListener('click', () => this.nextStep());
    });

    // دکمه‌های قبلی
    document.querySelectorAll('[data-wizard-prev]').forEach(btn => {
      btn.addEventListener('click', () => this.prevStep());
    });
  },

  nextStep() {
    if (this.currentStep < this.totalSteps) {
      // ذخیره داده‌های مرحله فعلی
      this.saveStepData(this.currentStep);

      // مخفی کردن مرحله فعلی
      const currentEl = document.querySelector(`[data-wizard-step="${this.currentStep}"]`);
      if (currentEl) currentEl.classList.add('hidden');

      // نمایش مرحله بعدی
      this.currentStep++;
      const nextEl = document.querySelector(`[data-wizard-step="${this.currentStep}"]`);
      if (nextEl) {
        nextEl.classList.remove('hidden');
        nextEl.classList.add('fade-in');
      }

      // آپدیت progress
      this.updateProgress();
    }
  },

  prevStep() {
    if (this.currentStep > 1) {
      const currentEl = document.querySelector(`[data-wizard-step="${this.currentStep}"]`);
      if (currentEl) currentEl.classList.add('hidden');

      this.currentStep--;
      const prevEl = document.querySelector(`[data-wizard-step="${this.currentStep}"]`);
      if (prevEl) prevEl.classList.remove('hidden');

      this.updateProgress();
    }
  },

  goToStep(step) {
    if (step >= 1 && step <= this.totalSteps) {
      document.querySelectorAll('[data-wizard-step]').forEach(el => {
        el.classList.add('hidden');
      });

      this.currentStep = step;
      const targetEl = document.querySelector(`[data-wizard-step="${step}"]`);
      if (targetEl) targetEl.classList.remove('hidden');

      this.updateProgress();
    }
  },

  updateProgress() {
    document.querySelectorAll('.wizard-step').forEach((step, index) => {
      step.classList.remove('active', 'completed');

      if (index + 1 < this.currentStep) {
        step.classList.add('completed');
      } else if (index + 1 === this.currentStep) {
        step.classList.add('active');
      }
    });
  },

  saveStepData(step) {
    const stepEl = document.querySelector(`[data-wizard-step="${step}"]`);
    if (!stepEl) return;

    const inputs = stepEl.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
      if (input.name) {
        this.sessionData[input.name] = input.value;
      }
    });

    // ذخیره در sessionStorage
    sessionStorage.setItem('anik_data', JSON.stringify(this.sessionData));
  },

  loadSessionData() {
    const saved = sessionStorage.getItem('anik_data');
    if (saved) {
      this.sessionData = JSON.parse(saved);
    }
  },

  /**
   * انتخاب نوع جرم
   */
  initCrimeSelector() {
    document.querySelectorAll('.crime-card').forEach(card => {
      card.addEventListener('click', () => {
        // حذف انتخاب قبلی
        document.querySelectorAll('.crime-card').forEach(c => c.classList.remove('selected'));

        // انتخاب جدید
        card.classList.add('selected');

        // ذخیره مقدار
        const crimeType = card.dataset.crime;
        this.sessionData.crimeType = crimeType;

        // فعال کردن دکمه ادامه
        const nextBtn = document.querySelector('[data-wizard-next]');
        if (nextBtn) {
          nextBtn.disabled = false;
          nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        }
      });
    });
  },

  /**
   * Quick Reply Buttons
   */
  initQuickReplies() {
    document.querySelectorAll('.quick-reply').forEach(btn => {
      btn.addEventListener('click', () => {
        const group = btn.closest('[data-reply-group]');
        if (group) {
          group.querySelectorAll('.quick-reply').forEach(b => b.classList.remove('selected'));
        }

        btn.classList.add('selected');

        // ذخیره پاسخ
        const questionId = btn.dataset.question;
        const answer = btn.dataset.answer;
        if (questionId) {
          this.sessionData[questionId] = answer;
        }

        // اگر callback داشت اجرا کن
        if (btn.dataset.callback) {
          const callback = btn.dataset.callback;
          if (typeof this[callback] === 'function') {
            this[callback](answer);
          }
        }
      });
    });
  },

  /**
   * اعتبارسنجی فرم‌ها
   */
  initForms() {
    document.querySelectorAll('form[data-validate]').forEach(form => {
      form.addEventListener('submit', (e) => {
        e.preventDefault();

        let isValid = true;
        const fields = form.querySelectorAll('[required]');

        fields.forEach(field => {
          field.classList.remove('border-red-500');

          if (!field.value.trim()) {
            isValid = false;
            field.classList.add('border-red-500');
          }

          // اعتبارسنجی موبایل
          if (field.dataset.validate === 'mobile') {
            const mobileRegex = /^09\d{9}$/;
            if (!mobileRegex.test(field.value)) {
              isValid = false;
              field.classList.add('border-red-500');
            }
          }
        });

        if (isValid) {
          form.submit();
        } else {
          this.showToast('لطفاً تمام فیلدها را به درستی پر کنید', 'error');
        }
      });
    });
  },

  /**
   * نمایش Toast
   */
  showToast(message, type = 'info', duration = 3000) {
    const toast = document.createElement('div');
    const colors = {
      success: 'bg-success',
      error: 'bg-red-500',
      warning: 'bg-warning',
      info: 'bg-secondary'
    };

    toast.className = `fixed top-4 left-4 right-4 md:left-auto md:right-4 md:w-auto ${colors[type]} text-white px-6 py-4 rounded-lg shadow-lg z-50 fade-in`;
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(() => {
      toast.style.opacity = '0';
      setTimeout(() => toast.remove(), 300);
    }, duration);
  },

  /**
   * دانلود PDF
   */
  downloadPDF(sectionId) {
    const section = document.getElementById(sectionId);
    if (!section) return;

    // در پروتوتایپ فقط پیام نمایش می‌دهیم
    this.showToast('فایل PDF در حال آماده‌سازی است...', 'info');

    setTimeout(() => {
      this.showToast('فایل با موفقیت دانلود شد', 'success');
    }, 1500);
  },

  /**
   * کپی متن
   */
  copyText(elementId) {
    const element = document.getElementById(elementId);
    if (!element) return;

    const text = element.innerText;
    navigator.clipboard.writeText(text).then(() => {
      this.showToast('متن کپی شد', 'success');
    }).catch(() => {
      this.showToast('خطا در کپی متن', 'error');
    });
  }

};

// اجرا بعد از لود صفحه
window.addEventListener('DOMContentLoaded', () => {
  App.init();
});
