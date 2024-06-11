<?php
$title = 'ログイン';
include 'html-head.php';

$mail = $_GET['mail'];
$error_msg = $_GET['err'];
?>
<body>
  <main class="bg-gray-100 flex w-full h-full items-center py-16 dark:bg-neutral-800">
    <div id="content" class="w-full max-w-md mx-auto p-6">
      <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-900 dark:border-neutral-700">
        <div class="p-4 sm:p-7">
          <div class="text-center">
            <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">おかサポ管理機能</h1>
            <h2 class="block text-2xl font-bold text-gray-800 dark:text-white">ログイン</h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
              新規登録は
              <a class="text-blue-600 decoration-2 hover:underline font-bold dark:text-blue-500" href="./regist.php">
                こちら
              </a>
            </p>
            <!-- エラー -->
            <?= '<p class="mt-2 text-sm text-red-600 dark:text-neutral-400">' . $error_msg . '</p>' ?>
          </div>

          <div class="mt-5">

            <!-- Form -->
            <form action="login-exec.php" method="post">
              <div class="grid gap-y-4">
                <!-- Form Group -->
                <div>
                  <label for="email" class="block text-sm mb-2 dark:text-white">メールアドレス</label>
                  <div class="relative">
                    <input type="email" id="email" name="email" value="<?= $mail ?>" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required aria-describedby="email-error">
                    <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                      <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                      </svg>
                    </div>
                  </div>
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
                  <p class="hidden text-xs text-red-600 mt-2" id="password-error">8+ characters required</p>
                </div>
                <!-- End Form Group -->

                <button type="submit" class="w-full mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">ログイン</button>
              </div>
            </form>
            <!-- End Form -->
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>