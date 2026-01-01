<?php
/**
 * صفحه نتیجه - نمایش شکواییه/دادخواست/مشاوره
 * آنیک - دستیار هوشمند حقوقی
 */
define('PROJECT_ROOT', dirname(__DIR__));
require_once PROJECT_ROOT . '/_components/config.php';

$pageTitle = 'نتیجه - شکواییه شما';

component('head');
?>

<body class="bg-background min-h-screen">

  <?php component('header', ['isLoggedIn' => true]); ?>

  <main class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">

      <!-- هدر موفقیت -->
      <div class="text-center mb-8">
        <div class="w-20 h-20 bg-success rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
        </div>
        <h1 class="text-3xl font-bold text-textDark mb-2">شکواییه شما آماده است!</h1>
        <p class="text-gray-600">بر اساس اطلاعات وارد شده، اسناد زیر برای شما تنظیم شده است</p>
      </div>

      <!-- سلب مسئولیت -->
      <div class="mb-8">
        <?php component('disclaimer'); ?>
      </div>

      <!-- سکشن شکواییه -->
      <div class="result-section" id="section-complaint">
        <div class="result-section-header">
          <div class="flex items-center gap-3">
            <span class="text-2xl">📄</span>
            <span class="result-section-title">شکواییه</span>
          </div>
          <div class="flex gap-2">
            <button onclick="App.copyText('complaint-text')" class="bg-white bg-opacity-20 hover:bg-opacity-30 px-3 py-1 rounded text-sm transition">
              کپی
            </button>
            <button onclick="App.downloadPDF('section-complaint')" class="bg-white bg-opacity-20 hover:bg-opacity-30 px-3 py-1 rounded text-sm transition">
              دانلود PDF
            </button>
          </div>
        </div>
        <div class="result-section-body">
          <pre id="complaint-text">بسمه تعالی

ریاست محترم دادسرای عمومی و انقلاب

با سلام و احترام،

اینجانب <span class="text-secondary font-bold" data-field="plaintiff_name">[نام شاکی]</span> فرزند <span class="text-secondary font-bold" data-field="plaintiff_father">[نام پدر]</span> به شماره ملی <span class="text-secondary font-bold" data-field="plaintiff_national_id">[کد ملی]</span> به نشانی <span class="text-secondary font-bold" data-field="plaintiff_address">[آدرس]</span>

شاکی هستم علیه:

آقا/خانم <span class="text-secondary font-bold" data-field="accused_name">[نام متهم]</span>

موضوع شکایت: <span class="text-secondary font-bold" data-field="crime_title">خیانت در امانت</span>

شرح ماوقع:

احتراماً به استحضار می‌رساند در تاریخ <span class="text-secondary font-bold" data-field="incident_date">[تاریخ]</span> در محل <span class="text-secondary font-bold" data-field="incident_location">[محل وقوع]</span>، مشتکی‌عنه اقدام به <span class="text-secondary font-bold" data-field="crime_description">[شرح جرم]</span> نموده است.

با توجه به مراتب فوق و مستندات پیوست، تقاضای رسیدگی و تعقیب کیفری متهم را وفق <span class="text-secondary font-bold" data-field="crime_article">ماده ۶۷۴ قانون مجازات اسلامی</span> دارم.

با تشکر و احترام
<span class="text-secondary font-bold" data-field="plaintiff_name">[نام شاکی]</span>
تاریخ: <span class="text-secondary font-bold"><?= date('Y/m/d') ?></span>
امضاء</pre>
        </div>
      </div>

      <!-- سکشن توضیحات و راهنما -->
      <div class="result-section" id="section-guide">
        <div class="result-section-header bg-secondary">
          <div class="flex items-center gap-3">
            <span class="text-2xl">📋</span>
            <span class="result-section-title">راهنمای اقدام</span>
          </div>
        </div>
        <div class="result-section-body">

          <h3 class="font-bold text-textDark mb-4">مراحل بعدی:</h3>

          <div class="space-y-4">
            <div class="flex items-start gap-3">
              <div class="w-8 h-8 bg-secondary text-white rounded-full flex items-center justify-center flex-shrink-0 font-bold">۱</div>
              <div>
                <p class="font-medium text-textDark">پرینت شکواییه</p>
                <p class="text-sm text-gray-600">فایل PDF را دانلود و پرینت بگیرید</p>
              </div>
            </div>

            <div class="flex items-start gap-3">
              <div class="w-8 h-8 bg-secondary text-white rounded-full flex items-center justify-center flex-shrink-0 font-bold">۲</div>
              <div>
                <p class="font-medium text-textDark">امضای شکواییه</p>
                <p class="text-sm text-gray-600">شکواییه را امضا کنید</p>
              </div>
            </div>

            <div class="flex items-start gap-3">
              <div class="w-8 h-8 bg-secondary text-white rounded-full flex items-center justify-center flex-shrink-0 font-bold">۳</div>
              <div>
                <p class="font-medium text-textDark">مراجعه به دفتر خدمات قضایی</p>
                <p class="text-sm text-gray-600">به همراه مدارک زیر به نزدیک‌ترین دفتر خدمات الکترونیک قضایی مراجعه کنید</p>
              </div>
            </div>
          </div>

          <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <h4 class="font-bold text-textDark mb-3">چک‌لیست مدارک مورد نیاز:</h4>
            <ul class="space-y-2 text-sm">
              <li class="flex items-center gap-2">
                <input type="checkbox" class="w-4 h-4 text-secondary">
                <span>کارت ملی اصل و کپی</span>
              </li>
              <li class="flex items-center gap-2">
                <input type="checkbox" class="w-4 h-4 text-secondary">
                <span>شکواییه پرینت شده و امضا شده</span>
              </li>
              <li class="flex items-center gap-2">
                <input type="checkbox" class="w-4 h-4 text-secondary">
                <span>مدارک و مستندات (رسید، پیامک، قرارداد و...)</span>
              </li>
              <li class="flex items-center gap-2">
                <input type="checkbox" class="w-4 h-4 text-secondary">
                <span>هزینه دادرسی (حدود ۵۰۰,۰۰۰ تومان)</span>
              </li>
            </ul>
          </div>

        </div>
      </div>

      <!-- سکشن مشاوره -->
      <div class="result-section" id="section-advice">
        <div class="result-section-header bg-success">
          <div class="flex items-center gap-3">
            <span class="text-2xl">💡</span>
            <span class="result-section-title">نکات حقوقی مهم</span>
          </div>
          <button onclick="App.copyText('advice-text')" class="bg-white bg-opacity-20 hover:bg-opacity-30 px-3 py-1 rounded text-sm transition">
            کپی
          </button>
        </div>
        <div class="result-section-body">
          <div id="advice-text" class="space-y-4 text-gray-700 leading-relaxed">

            <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
              <h4 class="font-bold text-blue-800 mb-2">درباره جرم شما:</h4>
              <p class="text-sm text-blue-700" id="crime-explanation">
                بر اساس اطلاعات وارده، شرایط ماده ۶۷۴ قانون مجازات اسلامی (خیانت در امانت) محرز به نظر می‌رسد. مجازات این جرم حبس از شش ماه تا سه سال است.
              </p>
            </div>

            <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
              <h4 class="font-bold text-yellow-800 mb-2">نکته مهم:</h4>
              <p class="text-sm text-yellow-700">
                اگر مدرک کتبی (قرارداد، رسید) ندارید، شهادت شهود می‌تواند کمک‌کننده باشد. حداقل دو شاهد عادل نیاز است.
              </p>
            </div>

            <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
              <h4 class="font-bold text-green-800 mb-2">توصیه:</h4>
              <p class="text-sm text-green-700">
                قبل از طرح شکایت، یک بار دیگر از طریق پیامک یا پیام‌رسان از متهم درخواست استرداد مال کنید و آن را ذخیره نمایید. این مدرک در دادگاه بسیار مفید خواهد بود.
              </p>
            </div>

          </div>
        </div>
      </div>

      <!-- دکمه‌های اقدام -->
      <div class="flex flex-col md:flex-row gap-4 mt-8">
        <button onclick="App.downloadPDF('section-complaint')" class="btn btn-primary btn-lg flex-1">
          <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          دانلود شکواییه (PDF)
        </button>

        <a href="/panel/index.php" class="btn btn-outline btn-lg flex-1 text-center">
          شکواییه جدید
        </a>
      </div>

      <!-- نظرسنجی -->
      <div class="card mt-8">
        <div class="card-body text-center">
          <p class="text-textDark mb-4">آیا این متن برای ثبت در دفتر خدمات قضایی مفید بود؟</p>
          <div class="flex justify-center gap-4">
            <button onclick="submitFeedback(5)" class="text-4xl hover:scale-110 transition">😊</button>
            <button onclick="submitFeedback(4)" class="text-4xl hover:scale-110 transition">🙂</button>
            <button onclick="submitFeedback(3)" class="text-4xl hover:scale-110 transition">😐</button>
            <button onclick="submitFeedback(2)" class="text-4xl hover:scale-110 transition">🙁</button>
            <button onclick="submitFeedback(1)" class="text-4xl hover:scale-110 transition">😞</button>
          </div>
        </div>
      </div>

    </div>
  </main>

  <?php component('footer'); ?>

  <script src="<?= asset('js/app.js') ?>"></script>
  <script>
    // پر کردن فیلدها با داده‌های ذخیره شده
    document.addEventListener('DOMContentLoaded', () => {
      const formData = JSON.parse(sessionStorage.getItem('anik_form_data') || '{}');
      const crimeType = sessionStorage.getItem('anik_crime_type') || 'khianat';

      // تنظیمات جرم
      const crimeConfig = {
        khianat: {
          title: 'خیانت در امانت',
          article: 'ماده ۶۷۴ قانون مجازات اسلامی',
          description: 'عدم استرداد مال امانی',
          explanation: 'بر اساس اطلاعات وارده، شرایط ماده ۶۷۴ قانون مجازات اسلامی (خیانت در امانت) محرز به نظر می‌رسد. مجازات این جرم حبس از شش ماه تا سه سال است.'
        },
        tohin: {
          title: 'توهین',
          article: 'ماده ۶۰۸ قانون مجازات اسلامی',
          description: 'توهین و فحاشی',
          explanation: 'بر اساس اطلاعات وارده، شرایط ماده ۶۰۸ قانون مجازات اسلامی (توهین) محرز به نظر می‌رسد. مجازات این جرم شلاق تا ۷۴ ضربه یا جزای نقدی است.'
        },
        mozahemat: {
          title: 'مزاحمت',
          article: 'ماده ۶۴۱ قانون مجازات اسلامی',
          description: 'ایجاد مزاحمت',
          explanation: 'بر اساس اطلاعات وارده، شرایط ماده ۶۴۱ قانون مجازات اسلامی (مزاحمت تلفنی) محرز به نظر می‌رسد. مجازات این جرم حبس از یک تا شش ماه است.'
        }
      };

      const crime = crimeConfig[crimeType] || crimeConfig.khianat;

      // پر کردن فیلدها
      document.querySelectorAll('[data-field]').forEach(el => {
        const field = el.dataset.field;
        let value = formData[field];

        // فیلدهای خاص جرم
        if (field === 'crime_title') value = crime.title;
        if (field === 'crime_article') value = crime.article;
        if (field === 'crime_description') value = crime.description;

        if (value) {
          el.textContent = value;
        }
      });

      // توضیحات جرم
      document.getElementById('crime-explanation').textContent = crime.explanation;
    });

    function submitFeedback(rating) {
      App.showToast('ممنون از نظر شما!', 'success');

      // ذخیره در session
      sessionStorage.setItem('anik_feedback', rating);
    }
  </script>

</body>
</html>
