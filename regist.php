<?php
session_start();
if ($_SESSION['user_id']) {
  header('Location: ./index.php');
  return;
}

$title = '新規登録';
include 'html-header.php';
$error_msg = $_GET['err'];
?>

<!-- Hero -->
<main class="w-full">
  <div class="relative bg-gradient-to-bl from-blue-100 via-transparent dark:from-blue-950 dark:via-transparent w-full">
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <!-- Grid -->
      <div class="grid items-center md:grid-cols-2 gap-8 lg:gap-12">
        <div>
          <p class="inline-block text-sm font-medium bg-clip-text bg-gradient-to-l from-blue-600 to-violet-500 text-transparent dark:from-blue-400 dark:to-violet-400">
            お買い物の面倒さ解消
          </p>

          <!-- Title -->
          <div class="mt-4 md:mb-12 max-w-2xl">
            <h1 class="mb-8 font-semibold text-gray-800 text-4xl lg:text-5xl dark:text-neutral-200 w-full text-center">
              あなたにピッタリの商品、<br /><span class="text-sm">(人力で)</span>探します！
            </h1>
            <p class="text-gray-600 dark:text-neutral-400">
              一つのものを買うのに何時間も調べてしまう・・・なんてことありませんか？
              インターネットが発達し、買い物の時にたくさんのものを見られる様になりました。
              しかし、アフィリエイトや販売目的のランキングが溢れ、今や何をみたら自分にとって
              価値のある商品かわかりにくくなっています。<br />
              <br />
              我々は、あなたのリクエストに応じて、もっとも良いと思われる商品を提案させていただきます！
              繰り返しリクエストを頂くことで、あなたにマッチした商品をご提案させて頂けるようになります。
              また、あなたと似た方が購入して満足されている商品や、そのレビューを配信致します。<br />
              <br />
            </p>
          </div>
          <!-- End Title -->

          <!-- Blockquote -->
          <blockquote class="md:block relative max-w-sm">
            <svg class="absolute top-0 start-0 transform -translate-x-6 -translate-y-8 size-16 text-gray-200 dark:text-neutral-800" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path d="M7.39762 10.3C7.39762 11.0733 7.14888 11.7 6.6514 12.18C6.15392 12.6333 5.52552 12.86 4.76621 12.86C3.84979 12.86 3.09047 12.5533 2.48825 11.94C1.91222 11.3266 1.62421 10.4467 1.62421 9.29999C1.62421 8.07332 1.96459 6.87332 2.64535 5.69999C3.35231 4.49999 4.33418 3.55332 5.59098 2.85999L6.4943 4.25999C5.81354 4.73999 5.26369 5.27332 4.84476 5.85999C4.45201 6.44666 4.19017 7.12666 4.05926 7.89999C4.29491 7.79332 4.56983 7.73999 4.88403 7.73999C5.61716 7.73999 6.21938 7.97999 6.69067 8.45999C7.16197 8.93999 7.39762 9.55333 7.39762 10.3ZM14.6242 10.3C14.6242 11.0733 14.3755 11.7 13.878 12.18C13.3805 12.6333 12.7521 12.86 11.9928 12.86C11.0764 12.86 10.3171 12.5533 9.71484 11.94C9.13881 11.3266 8.85079 10.4467 8.85079 9.29999C8.85079 8.07332 9.19117 6.87332 9.87194 5.69999C10.5789 4.49999 11.5608 3.55332 12.8176 2.85999L13.7209 4.25999C13.0401 4.73999 12.4903 5.27332 12.0713 5.85999C11.6786 6.44666 11.4168 7.12666 11.2858 7.89999C11.5215 7.79332 11.7964 7.73999 12.1106 7.73999C12.8437 7.73999 13.446 7.97999 13.9173 8.45999C14.3886 8.93999 14.6242 9.55333 14.6242 10.3Z" fill="currentColor" />
            </svg>

            <div class="relative z-10">
              <p class="text-xl italic text-gray-800 dark:text-white">
                節約できた時間と、素晴らしい商品で、あなたの人生がより良くなりますように！
              </p>
            </div>

            <footer class="mt-3">
              <div class="flex items-center">
                <div class="flex-shrink-0">
                  <img class="size-8 rounded-full" src="./img/nashii.jpeg" alt="Image Description">
                </div>
                <div class="grow ms-4">
                  <div class="font-semibold text-gray-800 dark:text-neutral-200">高梨 仁</div>
                  <div class="text-xs text-gray-500 dark:text-neutral-500">Freelance Engineer</div>
                </div>
              </div>
            </footer>
          </blockquote>
          <!-- End Blockquote -->
        </div>
        <!-- End Col -->

        <div>
          <!-- Form -->
          <form action="./regist-exec.php" method="post">
            <div class="lg:max-w-lg lg:mx-auto lg:me-0 ms-auto">
              <!-- Start コンポーネント -->
              <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-900 dark:border-neutral-700">
                <div class="p-4 sm:p-7">
                  <div class="text-center">
                    <h2 class="block text-2xl font-bold text-gray-800 dark:text-white">新規登録</h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                      すでに登録済みの方は
                      <a class="text-blue-600 decoration-2 hover:underline font-bold dark:text-blue-500" href="./login.php">
                        こちら
                      </a>
                    </p>
                    <!-- エラー -->
                    <?= '<p class="mt-2 text-sm text-red-600 dark:text-neutral-400">' . $error_msg . '</p>' ?>
                  </div>

                  <div class="mt-5">

                    <!-- Form -->
                    <form action="./regist-exec.php" method="post">
                      <div class="grid gap-y-4">
                        <!-- Form Group -->
                        <div>
                          <label for="email" class="block text-sm mb-2 dark:text-white">メールアドレス</label>
                          <div class="relative">
                            <input type="email" id="email" name="email" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required aria-describedby="email-error">
                            <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                              <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                              </svg>
                            </div>
                          </div>
                          <p class="mt-2 text-sm text-red-600 dark:text-neutral-400">おすすめ商品の用意ができたらメールで連絡します。</p>
                        </div>
                        <!-- End Form Group -->

                        <!-- Form Group -->
                        <div>
                          <div class="flex justify-between items-center">
                            <label for="password" class="block text-sm mb-2 dark:text-white">パスワード</label>
                          </div>
                          <div class="relative">
                            <input type="password" id="password" name="password" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required aria-describedby="password-error">
                            <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                              <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                              </svg>
                            </div>
                          </div>
                          <p class="mt-2 text-sm text-red-600 dark:text-neutral-400">暗号され安全に保管されます。</p>
                        </div>
                        <!-- End Form Group -->
                        <div>
                          <div class="flex justify-between items-center">
                            <label class="block text-sm mb-2 dark:text-white">性別</label>
                          </div>
                          <ul class="flex flex-col sm:flex-row">
                            <li class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ms-px sm:mt-0 sm:first:rounded-se-none sm:first:rounded-es-lg sm:last:rounded-es-none sm:last:rounded-se-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-white">
                              <div class="relative flex items-start w-full">
                                <div class="flex items-center h-5">
                                  <input id="hs-horizontal-list-group-item-radio-1" name="gender" type="radio" value="u" class="border-gray-200 rounded-full disabled:opacity-50 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" checked="">
                                </div>
                                <label for="hs-horizontal-list-group-item-radio-1" class="ms-3 block w-full text-sm text-gray-600 dark:text-neutral-500">
                                  未選択
                                </label>
                              </div>
                            </li>

                            <li class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ms-px sm:mt-0 sm:first:rounded-se-none sm:first:rounded-es-lg sm:last:rounded-es-none sm:last:rounded-se-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-white">
                              <div class="relative flex items-start w-full">
                                <div class="flex items-center h-5">
                                  <input id="hs-horizontal-list-group-item-radio-2" name="gender" type="radio" value="m" class="border-gray-200 rounded-full disabled:opacity-50 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                </div>
                                <label for="hs-horizontal-list-group-item-radio-2" class="ms-3 block w-full text-sm text-gray-600 dark:text-neutral-500">
                                  男性
                                </label>
                              </div>
                            </li>

                            <li class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ms-px sm:mt-0 sm:first:rounded-se-none sm:first:rounded-es-lg sm:last:rounded-es-none sm:last:rounded-se-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-white">
                              <div class="relative flex items-start w-full">
                                <div class="flex items-center h-5">
                                  <input id="hs-horizontal-list-group-item-radio-3" name="gender" type="radio" value="f" class="border-gray-200 rounded-full disabled:opacity-50 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                </div>
                                <label for="hs-horizontal-list-group-item-radio-3" class="ms-3 block w-full text-sm text-gray-600 dark:text-neutral-500">
                                  女性
                                </label>
                              </div>
                            </li>
                          </ul>
                        </div>

                        <div>
                          <div class="flex justify-between items-center">
                            <label for="birth_date" class="block text-sm mb-2 dark:text-white">誕生日</label>
                          </div>
                          <input type="date" id="birth_date" name="birth_date" value="<?php echo date('Y', strtotime('-35 years', strtotime('today'))) . '-01-01' ?>" min="1920-01-01" class="mt-2 py-3 px-4 block border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" />
                        </div>

                        <button type="submit" class="w-full mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                          新規登録
                        </button>
                      </div>
                    </form>
                    <!-- End Form -->
                  </div>
                </div>
              </div>
              <!-- End コンポーネント -->
            </div>
          </form>
          <!-- End Form -->
        </div>
        <!-- End Col -->
      </div>
      <!-- End Grid -->
    </div>
    <!-- End Clients Section -->
  </div>
  <!-- End Hero -->
</main>
<?php include 'html-header.php'; ?>