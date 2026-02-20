<?php
/**
 * صفحه Wizard - سوالات گام‌به‌گام
 * آنیک - دستیار هوشمند حقوقی
 */
define('PROJECT_ROOT', dirname(__DIR__));
require_once PROJECT_ROOT . '/_components/config.php';

$pageTitle = 'تنظیم شکواییه';
$crimeType = isset($_GET['type']) ? $_GET['type'] : 'unknown';

// تنظیمات بر اساس نوع جرم
$crimeConfig = [
    'khianat' => [
        'title' => 'خیانت در امانت',
        'icon' => '🤝',
        'article' => 'ماده ۶۷۴ قانون مجازات اسلامی',
    ],
    'tohin' => [
        'title' => 'توهین',
        'icon' => '🗣️',
        'article' => 'مواد ۶۰۸ و ۶۰۹ قانون مجازات اسلامی',
    ],
    'mozahemat' => [
        'title' => 'مزاحمت',
        'icon' => '📞',
        'article' => 'مواد ۶۴۱ و ۶۱۹ قانون مجازات اسلامی',
    ],
    'unknown' => [
        'title' => 'بررسی موضوع',
        'icon' => '🔍',
        'article' => '',
    ],
];

$config = $crimeConfig[$crimeType] ?? $crimeConfig['unknown'];

component('head');
?>

<body class="bg-background min-h-screen">

  <?php component('header', ['isLoggedIn' => true]); ?>

  <main class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">

      <!-- هدر -->
      <div class="text-center mb-8">
        <span class="text-5xl mb-4 block"><?= $config['icon'] ?></span>
        <h1 class="text-2xl font-bold text-textDark mb-2"><?= $config['title'] ?></h1>
        <?php if ($config['article']): ?>
          <p class="text-gray-500 text-sm"><?= $config['article'] ?></p>
        <?php endif; ?>
      </div>

      <!-- Progress -->
      <div class="wizard-progress mb-8">
        <div class="wizard-step active"></div>
        <div class="wizard-step"></div>
        <div class="wizard-step"></div>
        <div class="wizard-step"></div>
        <div class="wizard-step"></div>
      </div>

      <!-- Wizard Steps -->
      <div class="card">
        <div class="card-body">

          <!-- مرحله ۱: تایید نوع جرم (برای unknown) -->
          <?php if ($crimeType === 'unknown'): ?>
          <div data-wizard-step="1">
            <h2 class="text-lg font-bold text-textDark mb-4">موضوع شما به کدام مورد نزدیک‌تر است؟</h2>

            <div class="grid grid-cols-1 gap-4 mb-6">
              <div class="crime-card" data-crime="khianat" onclick="selectCrime('khianat')">
                <div class="flex items-center gap-4">
                  <span class="text-3xl">🤝</span>
                  <div class="text-right">
                    <div class="font-bold text-textDark">خیانت در امانت</div>
                    <div class="text-sm text-gray-500">مال یا پولی را به کسی داده‌ام و برنمی‌گرداند</div>
                  </div>
                </div>
              </div>

              <div class="crime-card" data-crime="tohin" onclick="selectCrime('tohin')">
                <div class="flex items-center gap-4">
                  <span class="text-3xl">🗣️</span>
                  <div class="text-right">
                    <div class="font-bold text-textDark">توهین و فحاشی</div>
                    <div class="text-sm text-gray-500">کسی به من توهین کرده یا فحاشی کرده</div>
                  </div>
                </div>
              </div>

              <div class="crime-card" data-crime="mozahemat" onclick="selectCrime('mozahemat')">
                <div class="flex items-center gap-4">
                  <span class="text-3xl">📞</span>
                  <div class="text-right">
                    <div class="font-bold text-textDark">مزاحمت</div>
                    <div class="text-sm text-gray-500">کسی برایم مزاحمت ایجاد کرده</div>
                  </div>
                </div>
              </div>

              <div class="crime-card" data-crime="other" onclick="selectCrime('other')">
                <div class="flex items-center gap-4">
                  <span class="text-3xl">❓</span>
                  <div class="text-right">
                    <div class="font-bold text-textDark">موضوع دیگر</div>
                    <div class="text-sm text-gray-500">هیچکدام از موارد بالا نیست</div>
                  </div>
                </div>
              </div>
            </div>

            <button type="button" data-wizard-next class="btn btn-primary w-full opacity-50 cursor-not-allowed" disabled>
              ادامه
            </button>
          </div>
          <?php endif; ?>

          <!-- مرحله ۲: سوالات ترایاژ -->
          <div data-wizard-step="<?= $crimeType === 'unknown' ? '2' : '1' ?>">

            <?php if ($crimeType === 'khianat' || $crimeType === 'unknown'): ?>
            <!-- سوالات خیانت در امانت -->
            <div id="questions-khianat" class="<?= $crimeType !== 'khianat' ? 'hidden' : '' ?>">
              <h2 class="text-lg font-bold text-textDark mb-6">چند سوال کوتاه</h2>

              <div class="space-y-6">
                <div>
                  <p class="font-medium text-textDark mb-3">آیا مال یا پولی به طرف مقابل داده‌اید؟</p>
                  <div class="flex gap-3" data-reply-group>
                    <button type="button" class="quick-reply flex-1" data-question="gave_property" data-answer="yes">بله</button>
                    <button type="button" class="quick-reply flex-1" data-question="gave_property" data-answer="no">خیر</button>
                  </div>
                </div>

                <div>
                  <p class="font-medium text-textDark mb-3">آیا قرار بود عین همان چیز را برگرداند؟</p>
                  <p class="text-sm text-gray-500 mb-3">(نه معادل پولی آن)</p>
                  <div class="flex gap-3" data-reply-group>
                    <button type="button" class="quick-reply flex-1" data-question="return_same" data-answer="yes">بله، عین همان</button>
                    <button type="button" class="quick-reply flex-1" data-question="return_same" data-answer="no">خیر، قرض بود</button>
                  </div>
                </div>

                <div>
                  <p class="font-medium text-textDark mb-3">آیا مدرک (رسید، پیامک، قرارداد) دارید؟</p>
                  <div class="flex gap-3" data-reply-group>
                    <button type="button" class="quick-reply flex-1" data-question="has_evidence" data-answer="yes">بله</button>
                    <button type="button" class="quick-reply flex-1" data-question="has_evidence" data-answer="no">خیر</button>
                  </div>
                </div>
              </div>
            </div>
            <?php endif; ?>

            <?php if ($crimeType === 'tohin' || $crimeType === 'unknown'): ?>
            <!-- سوالات توهین -->
            <div id="questions-tohin" class="<?= $crimeType !== 'tohin' ? 'hidden' : '' ?>">
              <h2 class="text-lg font-bold text-textDark mb-6">چند سوال کوتاه</h2>

              <div class="space-y-6">
                <div>
                  <p class="font-medium text-textDark mb-3">نوع توهین چه بوده است؟</p>
                  <div class="flex flex-col gap-3" data-reply-group>
                    <button type="button" class="quick-reply" data-question="insult_type" data-answer="verbal">فحاشی و ناسزا</button>
                    <button type="button" class="quick-reply" data-question="insult_type" data-answer="honor">توهین ناموسی</button>
                    <button type="button" class="quick-reply" data-question="insult_type" data-answer="accusation">تهمت دزدی یا جرم</button>
                  </div>
                </div>

                <div>
                  <p class="font-medium text-textDark mb-3">توهین در کجا رخ داده؟</p>
                  <div class="flex flex-col gap-3" data-reply-group>
                    <button type="button" class="quick-reply" data-question="insult_place" data-answer="public">در ملاء عام</button>
                    <button type="button" class="quick-reply" data-question="insult_place" data-answer="online">فضای مجازی</button>
                    <button type="button" class="quick-reply" data-question="insult_place" data-answer="private">خصوصی</button>
                  </div>
                </div>

                <div>
                  <p class="font-medium text-textDark mb-3">آیا شاهد یا مدرک (اسکرین‌شات، ضبط صدا) دارید؟</p>
                  <div class="flex gap-3" data-reply-group>
                    <button type="button" class="quick-reply flex-1" data-question="has_evidence" data-answer="yes">بله</button>
                    <button type="button" class="quick-reply flex-1" data-question="has_evidence" data-answer="no">خیر</button>
                  </div>
                </div>
              </div>
            </div>
            <?php endif; ?>

            <?php if ($crimeType === 'mozahemat' || $crimeType === 'unknown'): ?>
            <!-- سوالات مزاحمت -->
            <div id="questions-mozahemat" class="<?= $crimeType !== 'mozahemat' ? 'hidden' : '' ?>">
              <h2 class="text-lg font-bold text-textDark mb-6">چند سوال کوتاه</h2>

              <div class="space-y-6">
                <div>
                  <p class="font-medium text-textDark mb-3">نوع مزاحمت چه بوده است؟</p>
                  <div class="flex flex-col gap-3" data-reply-group>
                    <button type="button" class="quick-reply" data-question="harassment_type" data-answer="phone">تماس تلفنی مکرر</button>
                    <button type="button" class="quick-reply" data-question="harassment_type" data-answer="sms">پیامک مزاحم</button>
                    <button type="button" class="quick-reply" data-question="harassment_type" data-answer="physical">مزاحمت حضوری</button>
                    <button type="button" class="quick-reply" data-question="harassment_type" data-answer="online">مزاحمت آنلاین</button>
                  </div>
                </div>

                <div>
                  <p class="font-medium text-textDark mb-3">آیا مدرک (لیست تماس، اسکرین‌شات) دارید؟</p>
                  <div class="flex gap-3" data-reply-group>
                    <button type="button" class="quick-reply flex-1" data-question="has_evidence" data-answer="yes">بله</button>
                    <button type="button" class="quick-reply flex-1" data-question="has_evidence" data-answer="no">خیر</button>
                  </div>
                </div>
              </div>
            </div>
            <?php endif; ?>

            <div class="mt-8 flex gap-3">
              <button type="button" data-wizard-prev class="btn btn-outline flex-1">قبلی</button>
              <button type="button" data-wizard-next class="btn btn-primary flex-1">ادامه</button>
            </div>
          </div>

          <!-- مرحله ۳: اطلاعات واقعه -->
          <div data-wizard-step="<?= $crimeType === 'unknown' ? '3' : '2' ?>" class="hidden">
            <h2 class="text-lg font-bold text-textDark mb-6">اطلاعات واقعه</h2>

            <div class="space-y-6">
              <div>
                <label class="form-label">تاریخ وقوع (حدودی)</label>
                <input type="text" name="incident_date" class="form-input" placeholder="مثال: اردیبهشت ۱۴۰۳">
              </div>

              <div>
                <label class="form-label">محل وقوع (شهر و آدرس)</label>
                <input type="text" name="incident_location" class="form-input" placeholder="مثال: تهران، خیابان ولیعصر">
              </div>

              <div>
                <label class="form-label">آیا شاهد دارید؟</label>
                <div class="flex gap-3 mt-2" data-reply-group>
                  <button type="button" class="quick-reply flex-1" data-question="has_witness" data-answer="yes">بله</button>
                  <button type="button" class="quick-reply flex-1" data-question="has_witness" data-answer="no">خیر</button>
                </div>
              </div>
            </div>

            <div class="mt-8 flex gap-3">
              <button type="button" data-wizard-prev class="btn btn-outline flex-1">قبلی</button>
              <button type="button" data-wizard-next class="btn btn-primary flex-1">ادامه</button>
            </div>
          </div>

          <!-- مرحله ۴: اطلاعات متهم -->
          <div data-wizard-step="<?= $crimeType === 'unknown' ? '4' : '3' ?>" class="hidden">
            <h2 class="text-lg font-bold text-textDark mb-6">اطلاعات طرف مقابل (متشاکی‌عنه)</h2>

            <div class="space-y-6">
              <div>
                <label class="form-label">آیا نام متهم را می‌دانید؟</label>
                <div class="flex gap-3 mt-2" data-reply-group>
                  <button type="button" class="quick-reply flex-1" data-question="know_accused" data-answer="yes" onclick="toggleAccusedFields(true)">بله</button>
                  <button type="button" class="quick-reply flex-1" data-question="know_accused" data-answer="no" onclick="toggleAccusedFields(false)">خیر (ناشناس)</button>
                </div>
              </div>

              <div id="accused-fields">
                <div class="mb-4">
                  <label class="form-label">نام و نام خانوادگی متهم</label>
                  <input type="text" name="accused_name" class="form-input" placeholder="نام کامل">
                </div>

                <div>
                  <label class="form-label">آدرس یا شماره تماس متهم (اختیاری)</label>
                  <input type="text" name="accused_contact" class="form-input" placeholder="در صورت داشتن">
                </div>
              </div>
            </div>

            <div class="mt-8 flex gap-3">
              <button type="button" data-wizard-prev class="btn btn-outline flex-1">قبلی</button>
              <button type="button" data-wizard-next class="btn btn-primary flex-1">ادامه</button>
            </div>
          </div>

          <!-- مرحله ۵: اطلاعات شاکی -->
          <div data-wizard-step="<?= $crimeType === 'unknown' ? '5' : '4' ?>" class="hidden">
            <h2 class="text-lg font-bold text-textDark mb-6">اطلاعات شما (شاکی)</h2>
            <p class="text-gray-500 text-sm mb-6">این اطلاعات برای درج در شکواییه نیاز است</p>

            <div class="space-y-6">
              <div>
                <label class="form-label">نام و نام خانوادگی</label>
                <input type="text" name="plaintiff_name" class="form-input" placeholder="نام کامل" required>
              </div>

              <div>
                <label class="form-label">نام پدر</label>
                <input type="text" name="plaintiff_father" class="form-input" placeholder="نام پدر" required>
              </div>

              <div>
                <label class="form-label">کد ملی</label>
                <input type="text" name="plaintiff_national_id" class="form-input text-left" dir="ltr" placeholder="۰۰۱۲۳۴۵۶۷۸" maxlength="10" inputmode="numeric" required>
              </div>

              <div>
                <label class="form-label">آدرس</label>
                <textarea name="plaintiff_address" class="form-input" rows="2" placeholder="آدرس محل سکونت" required></textarea>
              </div>

              <div>
                <label class="form-label">کد پستی</label>
                <input type="text" name="plaintiff_postal" class="form-input text-left" dir="ltr" placeholder="۱۲۳۴۵۶۷۸۹۰" maxlength="10" inputmode="numeric">
              </div>
            </div>

            <div class="mt-8">
              <button type="button" onclick="generateResult()" class="btn btn-success btn-lg w-full">
                تولید شکواییه
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </button>
            </div>
          </div>

        </div>
      </div>

    </div>
  </main>

  <?php component('footer'); ?>

  <script src="<?= asset('js/app.js') ?>"></script>
  <script>
    let selectedCrime = '<?= $crimeType ?>';

    function selectCrime(crime) {
      selectedCrime = crime;

      // آپدیت UI
      document.querySelectorAll('.crime-card').forEach(c => c.classList.remove('selected'));
      document.querySelector(`[data-crime="${crime}"]`).classList.add('selected');

      // فعال کردن دکمه
      const nextBtn = document.querySelector('[data-wizard-step="1"] [data-wizard-next]');
      if (nextBtn) {
        nextBtn.disabled = false;
        nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
      }

      // ذخیره
      sessionStorage.setItem('anik_crime_type', crime);

      // اگر "موضوع دیگر" انتخاب شد
      if (crime === 'other') {
        window.location.href = '/panel/lead.php';
      }
    }

    function toggleAccusedFields(show) {
      const fields = document.getElementById('accused-fields');
      if (show) {
        fields.classList.remove('hidden');
      } else {
        fields.classList.add('hidden');
      }
    }

    function generateResult() {
      // جمع‌آوری داده‌ها
      const formData = {};
      document.querySelectorAll('input, textarea').forEach(input => {
        if (input.name) {
          formData[input.name] = input.value;
        }
      });

      // ذخیره
      sessionStorage.setItem('anik_form_data', JSON.stringify(formData));
      sessionStorage.setItem('anik_crime_type', selectedCrime);

      // نمایش لودینگ
      App.showToast('در حال تولید شکواییه...', 'info');

      // هدایت به صفحه نتیجه
      setTimeout(() => {
        window.location.href = '/panel/result.php';
      }, 1500);
    }

    // نمایش سوالات مناسب بر اساس نوع جرم
    document.addEventListener('DOMContentLoaded', () => {
      if (selectedCrime !== 'unknown') {
        // مخفی کردن همه سوالات
        document.querySelectorAll('[id^="questions-"]').forEach(q => q.classList.add('hidden'));
        // نمایش سوالات مربوطه
        const questions = document.getElementById('questions-' + selectedCrime);
        if (questions) questions.classList.remove('hidden');
      }
    });
  </script>

</body>
</html>
