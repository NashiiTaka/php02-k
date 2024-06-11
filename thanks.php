<?php
$title = 'ご登録ありがとうございました - 家電探します。';
include 'html-head.php';
$error_msg = $_GET['err'];
?>

<body>
  <!-- Features -->
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Grid -->
    <div class="md:grid md:grid-cols-2 md:items-center md:gap-12 xl:gap-32">
      <div>
        <img class="rounded-xl" src="./img/kaden.webp" alt="Image Description">
      </div>
      <!-- End Col -->

      <div class="mt-5 sm:mt-10 lg:mt-0">
        <div class="space-y-6 sm:space-y-8">
          <!-- Title -->
          <div class="space-y-2 md:space-y-4">
            <h2 class="font-bold text-3xl lg:text-4xl text-gray-800 dark:text-neutral-200">
              ご登録ありがとうございました！
            </h2>
            <p class="text-gray-500 dark:text-neutral-500">
              ご提案までしばらくお時間を下さいませ。
            </p>
          </div>
          <!-- End Title -->

          <!-- List -->
          <ul class="space-y-2 sm:space-y-4">
            <li class="flex space-x-3">
              <span class="mt-0.5 size-5 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 dark:bg-blue-800/30 dark:text-blue-500">
                <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12" />
                </svg>
              </span>

              <span class="text-sm sm:text-base text-gray-500 dark:text-neutral-500">
                <span class="font-bold">よい商品を</span><br />あなたにマッチする商品を探します。
              </span>
            </li>

            <li class="flex space-x-3">
              <span class="mt-0.5 size-5 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 dark:bg-blue-800/30 dark:text-blue-500">
                <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12" />
                </svg>
              </span>

              <span class="text-sm sm:text-base text-gray-500 dark:text-neutral-500">
                <span class="font-bold">おトクに買って</span><br />
                販売キャンペーンなど調査し、最適な販売サイト・購入タイミングを提案します。
              </span>
            </li>

            <li class="flex space-x-3">
              <span class="mt-0.5 size-5 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 dark:bg-blue-800/30 dark:text-blue-500">
                <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12" />
                </svg>
              </span>

              <span class="text-sm sm:text-base text-gray-500 dark:text-neutral-500">
                <span class="font-bold">商品を活かした豊かな生活を</span><br />
                迷ったり後悔したりという体験は最小に、商品の価値を最大化して豊かな生活を
              </span>
            </li>
          </ul>
          <!-- End List -->
        </div>
      </div>
      <!-- End Col -->
    </div>
    <!-- End Grid -->
  </div>
  <!-- End Features -->
</body>

</html>