<?php
require_once './funcs.php';
checkAuth();

require_once './DbManager.php';
$db = new DbManager();

$reqs = $db->select("SELECT * FROM t_reqs ORDER BY updated_at DESC");

include './admin-header.php';
?>
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
                Requests
              </h2>
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
                <?php foreach (['ID', 'Status', 'ご要望', '価格帯', '重視ポイント', 'デザインテイスト', 'カラーテイスト', 'その他テイスト', '対象サイト', 'Updated'] as $caption) { ?>
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

              <?php for ($i = 0; $i < count($reqs); $i++) { ?>
                <tr>
                  <td class="size-px whitespace-nowrap">
                    <div class="p-3">
                      <div class="flex items-center gap-x-3">
                        <div>
                          <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"><?= h($reqs[$i]['id']) ?></span>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="size-px whitespace-nowrap">
                    <?php if ($reqs[$i]['status'] === 'Done') { ?>
                      <div class="px-6 py-3 flex justify-center">
                        <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                          <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                          </svg>
                          Done
                        </span>
                      </div>
                    <?php } else if ($reqs[$i]['status'] === 'InProgress') { ?>
                      <div class="px-6 py-3 flex justify-center">
                        <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full dark:bg-yellow-500/10 dark:text-yellow-500">
                          <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                          </svg>
                          In Progress
                        </span>
                      </div>
                    <?php } else { ?>
                      <div class="px-6 py-3 flex justify-center">
                        <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500">
                          <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                          </svg>
                          Not Started
                        </span>
                      </div>
                    <?php } ?>
                  </td>
                  <td class="h-px w-72">
                    <div class="px-6 py-3">
                      <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"><?= h($reqs[$i]['wish']) ?></span>
                    </div>
                  </td>
                  <td class="size-px whitespace-nowrap">
                    <div class="px-6 py-3">
                      <span class="text-xs text-gray-500 dark:text-neutral-500"><?= str_replace(',', '<br />', h($reqs[$i]['price_ranges'])) ?></span>
                    </div>
                  </td>
                  <td class="size-px whitespace-nowrap">
                    <div class="px-6 py-3">
                      <span class="text-xs text-gray-500 dark:text-neutral-500"><?= str_replace(',', '<br />', h($reqs[$i]['points'])) ?></span>
                    </div>
                  </td>
                  <td class="size-px whitespace-nowrap">
                    <div class="px-6 py-3">
                      <span class="text-xs text-gray-500 dark:text-neutral-500"><?= str_replace(',', '<br />', h($reqs[$i]['design_tastes'])) ?></span>
                    </div>
                  </td>
                  <td class="size-px whitespace-nowrap">
                    <div class="px-6 py-3">
                      <span class="text-xs text-gray-500 dark:text-neutral-500"><?= str_replace(',', '<br />', h($reqs[$i]['color_tastes'])) ?></span>
                    </div>
                  </td>
                  <td class="size-px whitespace-nowrap">
                    <div class="px-6 py-3">
                      <span class="text-xs text-gray-500 dark:text-neutral-500"><?= str_replace(',', '<br />', h($reqs[$i]['other_tastes'])) ?></span>
                    </div>
                  </td>
                  <td class="size-px whitespace-nowrap">
                    <div class="px-6 py-3">
                      <div class="text-xs text-gray-500 dark:text-neutral-500"><?= str_replace(',', '<br />', h($reqs[$i]['shops'])) ?></div>
                    </div>
                  </td>
                  <td class="size-px whitespace-nowrap">
                    <div class="px-6 py-3">
                      <div class="text-xs text-gray-500 dark:text-neutral-500 text-center"><?= str_replace(' ', '<br />', h($reqs[$i]['updated_at'])) ?></div>
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
                <span class="font-semibold text-gray-800 dark:text-neutral-200"><?= count($reqs) ?> </span> results
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