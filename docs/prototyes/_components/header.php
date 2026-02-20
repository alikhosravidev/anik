<?php
$showLogin = $showLogin ?? true;
$isLoggedIn = $isLoggedIn ?? false;
?>
<header class="bg-primary text-white shadow-lg sticky top-0 z-50">
  <div class="container mx-auto px-4 py-4">
    <div class="flex items-center justify-between">

      <!-- لوگو -->
      <a href="/index.php" class="flex items-center gap-3">
        <div class="w-10 h-10 bg-secondary rounded-lg flex items-center justify-center">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
          </svg>
        </div>
        <span class="text-xl font-bold"><?= $siteConfig['name'] ?></span>
      </a>

      <!-- دکمه ورود/پنل -->
      <?php if ($showLogin): ?>
        <?php if ($isLoggedIn): ?>
          <a href="/panel/index.php" class="bg-secondary hover:bg-opacity-90 text-white px-6 py-2 rounded-lg transition font-medium">
            پنل کاربری
          </a>
        <?php else: ?>
          <a href="/auth.php" class="bg-secondary hover:bg-opacity-90 text-white px-6 py-2 rounded-lg transition font-medium">
            ورود / ثبت‌نام
          </a>
        <?php endif; ?>
      <?php endif; ?>

    </div>
  </div>
</header>
