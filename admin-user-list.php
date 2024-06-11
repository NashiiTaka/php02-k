<?php
require_once './funcs.php';
checkAuth();

require_once './DbManager.php';
$db = new DbManager();

$users = $db->select("SELECT * FROM t_users");

$title = 'おかサポ - ユーザー管理';
include './admin-header.php';
$error_msg = $_GET['err'];
?>
<script>
  const onAdminStatChanging = (e) => {
    if (confirm("管理者権限を変更してよろしいですか？")) {
      // buttonの親フォームを取得
      const form = e.target.closest('form');
      if (form) {
        // フォームのsubmitメソッドを呼び出す
        form.submit();
      } else {
        alert.error('エラーが発生しました。');
        e.preventDefault();
      }
    } else {
      e.preventDefault();
    }
  };

  const onDeleteButton = (e) => {
    if (confirm("削除してよろしいですか？")) {
      // buttonの親フォームを取得
      const form = e.target.closest('form');
      if (form) {
        // フォームのsubmitメソッドを呼び出す
        form.submit();
      } else {
        alert.error('エラーが発生しました。');
        e.preventDefault();
      }
    } else {
      e.preventDefault();
    }
  };
</script>
<!-- Table Section -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Card -->
  <div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
          <!-- Header -->
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
            <div>
              <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                Administrators
              </h2>
              <?= $error_msg ? '<p class="mt-2 text-sm text-red-600 dark:text-neutral-400">' . $error_msg . '</p>' : '' ?>
            </div>

            <div>
              <div class="inline-flex gap-x-2">
                <!-- <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800" href="#">
                  View all
                </a>

                <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                  <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                  Add user
                </a> -->
              </div>
            </div>
          </div>
          <!-- End Header -->

          <!-- Table -->
          <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead class="bg-gray-50 dark:bg-neutral-800">
              <tr>
                <?php foreach (['ID', 'Mail', '管理者', '削除'] as $caption) { ?>
                  <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 py-3 text-start">
                    <div class="flex items-center gap-x-2 text-center">
                      <div class="text-xs font-semibold uppercase w-full tracking-wide text-gray-800 dark:text-neutral-200">
                        <?= $caption ?>
                      </div>
                    </div>
                  </th>
                <?php } ?>
              </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">

              <?php for ($i = 0; $i < count($users); $i++) { ?>
                <tr>
                  <td class="size-px whitespace-nowrap">
                    <div class="p-3">
                      <div class="flex justify-center items-center gap-x-3">
                        <div>
                          <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"><?= h($users[$i]['id']) ?></span>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="h-px w-72 whitespace-nowrap">
                    <div class="px-6 py-3 flex justify-center items-center">
                      <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"><?= h($users[$i]['mail']) ?></span>
                    </div>
                  </td>
                  <td class="size-px whitespace-nowrap">
                    <div class="px-6 py-3 flex justify-center items-center">
                      <form method="post" action="./admin-user-edit.php">
                        <input name="id" type="hidden" value="<?= $users[$i]['id'] ?>" />
                        <input name="mail" type="hidden" value="<?= $users[$i]['mail'] ?>" />
                        <input name="is_admin" type="checkbox" value="1" <?= $users[$i]['is_admin'] ? 'checked="checked"' : '' ?> onclick="onAdminStatChanging(event)" class="relative w-[3.25rem] h-7 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-600 before:inline-block before:size-6 before:bg-white checked:before:bg-blue-200 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-blue-200">
                        <label for="hs-basic-usage" class="sr-only">switch</label>
                      </form>
                    </div>
                  </td>
                  <td class="size-px whitespace-nowrap ">
                    <div class="flex justify-center hover:cursor-pointer">
                      <form method="post" action="./admin-user-delete.php">
                        <input name="id" type="hidden" value="<?= $users[$i]['id'] ?>" />
                        <svg onclick="onDeleteButton(event)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="32" height="32" viewBox="0 0 256 256" xml:space="preserve">
                          <defs>
                          </defs>
                          <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                            <circle cx="69.253" cy="75.333" r="10.973" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) " />
                            <path d="M 38.877 40.375 L 38.877 40.375 c -9.415 0 -17.118 -7.703 -17.118 -17.118 v -6.139 C 21.759 7.703 29.462 0 38.877 0 h 0 c 9.415 0 17.118 7.703 17.118 17.118 v 6.139 C 55.995 32.672 48.292 40.375 38.877 40.375 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(110,177,225); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path d="M 50.103 75.603 c 0 -10.209 7.969 -18.535 18.022 -19.154 c -3.98 -7.222 -11.159 -12.461 -19.609 -13.722 c -2.896 1.499 -6.169 2.363 -9.639 2.363 c -3.47 0 -6.743 -0.863 -9.639 -2.363 C 16.296 44.659 6.286 55.889 6.286 69.347 v 17.707 C 6.286 88.674 7.612 90 9.232 90 h 47.391 C 52.633 86.479 50.103 81.342 50.103 75.603 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(110,177,225); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path d="M 69.317 61.206 c -7.951 0 -14.397 6.446 -14.397 14.397 C 54.92 83.554 61.366 90 69.317 90 c 7.951 0 14.397 -6.446 14.397 -14.397 C 83.714 67.652 77.268 61.206 69.317 61.206 z M 77.351 77.375 c 0 0.57 -0.462 1.032 -1.032 1.032 H 62.474 c -0.57 0 -1.032 -0.462 -1.032 -1.032 v -3.756 c 0 -0.57 0.462 -1.032 1.032 -1.032 h 13.844 c 0.57 0 1.032 0.462 1.032 1.032 V 77.375 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(240,88,47); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                          </g>
                        </svg>
                      </form>
                    </div>
                  </td>
                </tr>
              <?php } ?>

            </tbody>
          </table>
          <!-- End Table -->

          <!-- Footer -->
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-center md:items-center border-t border-gray-200 dark:border-neutral-700">
            <div>
              <p class="text-sm text-gray-600 dark:text-neutral-400">
                <span class="font-semibold text-gray-800 dark:text-neutral-200"><?= count($users) ?> </span> results
              </p>
            </div>

            <!-- <div>
              <div class="inline-flex gap-x-2">
                <button type="button" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
                  <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                  Prev
                </button>

                <button type="button" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
                  Next
                  <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </button>
              </div>
            </div> -->
          </div>
          <!-- End Footer -->
        </div>
      </div>
    </div>
  </div>
  <!-- End Card -->
</div>
<!-- End Table Section -->