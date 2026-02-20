<?php
// کامپوننت سلب مسئولیت
$disclaimerType = $disclaimerType ?? 'default'; // default, sticky, modal
$disclaimerClass = $disclaimerClass ?? '';
?>
<div class="bg-yellow-50 border border-yellow-300 rounded-lg p-4 <?= $disclaimerClass ?>" data-disclaimer>
  <div class="flex items-start gap-3">
    <span class="text-xl flex-shrink-0">⚠️</span>
    <p class="text-sm text-yellow-800 leading-relaxed">
      <?= $siteConfig['disclaimer'] ?>
    </p>
  </div>
</div>
