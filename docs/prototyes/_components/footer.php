<footer class="bg-primary text-white mt-16">
  <div class="container mx-auto px-4 py-8">

    <!-- سلب مسئولیت -->
    <div class="bg-yellow-100 border border-yellow-300 rounded-lg p-4 mb-8 text-textDark">
      <div class="flex items-start gap-3">
        <span class="text-2xl">⚠️</span>
        <p class="text-sm leading-relaxed">
          <?= $siteConfig['disclaimer'] ?>
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

      <!-- درباره -->
      <div>
        <h3 class="text-lg font-bold mb-4">درباره آنیک</h3>
        <p class="text-gray-300 text-sm leading-relaxed"><?= $siteConfig['description'] ?></p>
      </div>

      <!-- لینک‌های مفید -->
      <div>
        <h3 class="text-lg font-bold mb-4">لینک‌های مفید</h3>
        <ul class="space-y-2 text-gray-300 text-sm">
          <li><a href="#" class="hover:text-white transition">راهنمای استفاده</a></li>
          <li><a href="#" class="hover:text-white transition">سوالات متداول</a></li>
          <li><a href="#" class="hover:text-white transition">قوانین و مقررات</a></li>
        </ul>
      </div>

      <!-- تماس -->
      <div>
        <h3 class="text-lg font-bold mb-4">تماس با ما</h3>
        <p class="text-gray-300 text-sm">پشتیبانی: info@anik.ir</p>
      </div>

    </div>

    <!-- کپی‌رایت -->
    <div class="border-t border-gray-600 mt-8 pt-6 text-center text-gray-400 text-sm">
      <p>تمامی حقوق محفوظ است © <?= date('Y') ?> - آنیک نسخه <?= $siteConfig['version'] ?></p>
    </div>
  </div>
</footer>
