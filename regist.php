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

<main class="bg-gray-100 flex w-full h-full items-center py-16 dark:bg-neutral-800">
  <div id="content" class="w-full max-w-md mx-auto p-6">
    <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-900 dark:border-neutral-700">
      <div class="p-4 sm:p-7">
        <div class="text-center">
          <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">買い物レコメンド</h1>
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
  </div>
</main>

<?php include 'html-header.php'; ?>