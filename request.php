<?php
session_start();
if (!$_SESSION['user_id']) {
  header('Location: ./login.php');
  return;
}

$title = 'リクエスト';
include 'html-header.php';
$error_msg = $_GET['err'];

require './DbManager.php';
$db = new DbManager();

$shops = $db->select('SELECT * FROM m_shops ORDER BY list_odr');
?>

<main class="bg-gray-100 flex w-full h-full items-center py-16 dark:bg-neutral-800">
  <div id="content" class="w-full max-w-md mx-auto p-6">
    <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-900 dark:border-neutral-700">
      <div class="p-4 sm:p-7">
        <div class="text-center">
          <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">欲しいものを教えて下さい</h1>
          <!-- エラー -->
          <?= '<p class="mt-2 text-sm text-red-600 dark:text-neutral-400">' . $error_msg . '</p>' ?>
        </div>

        <div class="mt-5">

          <!-- Form -->
          <form id="uploadForm" action="./request-exec.php" method="post" enctype="multipart/form-data">
            <div class="grid gap-y-4">
              <!-- Form Group -->
              <div>
                <label for="wish" class="block text-sm mb-2 dark:text-white">欲しいもののイメージ</label>
                <div class="relative">
                  <textarea id="wish" name="wish" class="py-2 px-3 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="6" placeholder="欲しいもののイメージを教えて下さい。例えば、ドラム式洗濯機、20万円前後、静か、電気代が安い、シワになりにくい、国産... など。"></textarea>
                </div>
              </div>
              <!-- End Form Group -->

              <!-- Form Group -->
              <div>
                <div class="flex justify-between items-center">
                  <label for="shops" class="block text-sm mb-2 dark:text-white">対象店舗</label>
                </div>
                <div class="relative">
                  <?php foreach ($shops as $shop) { ?>
                    <div class="flex">
                      <input id="checkbox-<?= $shop['id'] ?>" name="shops[]" value="<?= $shop['id'] ?>" type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                      <label for="checkbox-<?= $shop['id'] ?>" class="text-sm text-gray-500 ms-3 dark:text-neutral-400"><?= $shop['shop_name'] ?></label>
                    </div>
                  <?php } ?>
                </div>
              </div>
              <!-- End Form Group -->
              <div>
                <div class="flex justify-between items-center">
                  <label class="block text-sm mb-2 dark:text-white">参考の画像・URL等を貼り付けて下さい</label>
                </div>
              </div>
              <div id="pasteArea" tabindex="0" contenteditable="false" class="py-2 px-3 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                イメージ画像やURL等を貼り付けて下さい
              </div>
              <div id="previews" class="w-full">
                <!-- ここに追加項目をいれる -->
              </div>
              <button type="submit" class="w-full mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                登録
              </button>
            </div>
          </form>
          <!-- End Form -->
        </div>
      </div>
    </div>
  </div>
</main>
<script src="./mng-preview.js"></script>

<?php include 'html-header.php'; ?>