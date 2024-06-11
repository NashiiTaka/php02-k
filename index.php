<?php
require_once './funcs.php';

$title = '家電探します。';
include 'html-head.php';

require_once './DbManager.php';
$db = new DbManager();

$shops = $db->select('SELECT * FROM m_shops ORDER BY list_odr');

$posted = [];
$errMes = '';
$isErr = $_GET['err'] === 'y';

// 登録エラーの処理
if ($isErr) {
  session_start();
  $errMes = $_SESSION['errMes'];

  foreach ($_SESSION as $key => $value) {
    $posted[$key] = $value;
  }

  // ログアウトを実行する
  logout(false);
}
?>

<body class="bg-gray-100 flex w-full h-full items-center dark:bg-neutral-800">
  <!-- Hero -->
  <main class="w-full">
    <div class="relative bg-gradient-to-bl flex justify-center from-blue-100 via-transparent dark:from-blue-950 dark:via-transparent w-full">
      <div class="max-w-[85rem] mx-auto">
        <!-- Grid -->
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 lg:px-4 lg:pt-4 sm:px-3">
          <div>
            <div class="md:sticky top-4 lg:min-h-[95vh] opacity-80 p-4 md:p-6" style="background-image: url(./img/kaden.webp)">
              <div class="bg-white/70 backdrop-blur-md p-4 md:p-6 rounded-3xl">
                <div class="w-full inline-block text-xl font-medium bg-clip-text bg-gradient-to-l from-blue-800 to-violet-700 text-transparent dark:from-blue-300 dark:to-violet-300 text-center sm:text-left">
                  調べる時間、<br class="sm:hidden" />むだにかかっていませんか？
                </div>
                <div class="mt-4 max-w-2xl">
                  <h1 class="mb-3 lg:mb-4 inline-block font-semibold text-4xl lg:text-6xl dark:text-neutral-200 w-full text-center">ぴったりの</h1>
                  <h1 class="mb-3 lg:mb-4 inline-block font-semibold text-4xl lg:text-6xl dark:text-neutral-200 w-full text-center">家電・ガジェット</h1>
                  <h1 class="mb-4 inline-block font-semibold text-4xl lg:text-6xl dark:text-neutral-200 w-full text-center">探します</h1>
                </div>
                <div>
                  <div class="w-full inline-block mt-2 text-xl font-medium bg-clip-text bg-gradient-to-l from-blue-800 to-violet-700 text-transparent dark:from-blue-300 dark:to-violet-300 text-center sm:text-left">
                    解決する課題
                  </div>
                  <ul class="dark:text-white">
                    <li class="p-1 dark:text-neutral-400">
                      ・商品を詳しく調べているうちに何時間もたってしまう。
                    </li>
                    <li class="p-1 dark:text-neutral-400">
                      ・何を基準に比較したらよいかよくわからない。
                    </li>
                    <li class="p-1 dark:text-neutral-400">
                      ・他にももっとよい商品があるのではと気になる。
                    </li>
                    <li class="p-1 dark:text-neutral-400">
                      ・どこのサイトでいつ買えば一番おトクかわからない。
                    </li>
                    <li class="p-1 dark:text-neutral-400">
                      ・比較サイトや比較動画が多く、自分にとってのベストがわからない。
                    </li>
                  </ul>
                </div>

                <div>
                  <div class="w-full inline-block mt-3 text-xl font-medium bg-clip-text bg-gradient-to-l from-blue-800 to-violet-700 text-transparent dark:from-blue-300 dark:to-violet-300 text-center sm:text-left">
                    ステップ
                  </div>
                  <ul class="dark:text-white">
                    <li class="p-1 dark:text-neutral-400">
                      1. フォームより、どの様なものがほしいか教えて下さい。
                    </li>
                    <li class="p-1 dark:text-neutral-400">
                      2. 調査が終わりましたら、おすすめ商品とその理由をメールでお伝えいたします。
                    </li>
                    <li class="p-1 dark:text-neutral-400">
                      3. 再調査をご希望の場合は、メールにてご返信下さい。
                    </li>
                    <li class="p-1 dark:text-neutral-400">
                      4. ご納得頂ける商品がありましたらご購入下さい。
                    </li>
                  </ul>
                </div>
                <div class="mt-5 hidden sm:block flex justify-center">
                  <ul>
                    <li class="text-sm text-gray-600 dark:text-neutral-400">
                      ※ 約1〜2週間前後でご連絡差し上げます。ただし、ご要望が多数の場合は遅れる場合があります。
                    </li>
                    <li class="text-sm text-gray-600 dark:text-neutral-400">
                      ※ 費用は全て無料です。
                    </li>
                  </ul>
                </div>

                <!-- End Title -->
              </div>
            </div>
          </div>
          <!-- End Col -->
          <div>
            <!-- Form -->
            <form action="./index-exec.php" method="post">
              <div class="lg:max-w-lg lg:mx-auto lg:me-0 ms-auto">
                <!-- Start コンポーネント -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-900 dark:border-neutral-700">
                  <div class="p-4 sm:p-7">
                    <div class="text-center">
                      <!-- エラー -->
                      <?= '<p class="mt-2 text-sm text-red-600 dark:text-neutral-400">' . $errMes . '</p>' ?>
                    </div>

                    <!-- Form -->
                    <form id="uploadForm" action="./request-exec.php" method="post" enctype="multipart/form-data">
                      <div class="grid gap-y-4">

                        <!-- Form Group -->
                        <div>
                          <label for="wish" class="block text-xl mb-2 dark:text-white">欲しいものを教えて下さい！</label>
                          <div class="relative">
                            <textarea id="wish" name="wish" class="py-2 px-3 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="4" placeholder="欲しいものを教えて下さい。キーワードがたくさんあると精度が上がります。例えば、ドラム式洗濯機、20万円前後、静か、電気代が安い、シワになりにくい、国産... など。"><?= $posted['wish'] ?></textarea>
                          </div>
                        </div>
                        <!-- End Form Group -->

                        <!-- 価格帯 -->
                        <div>
                          <div class="flex justify-between items-center">
                            <label class="block text-sm mb-2 dark:text-white">希望価格帯を教えて下さい(複数可)</label>
                          </div>
                          <ul class="flex flex-col sm:flex-row">
                            <?php
                            $selectedValues = [];
                            $name = 'price_ranges';
                            foreach (['低価格帯', '中価格帯', '高価格帯'] as $disp) {
                              $value = $disp;
                            ?>
                              <li class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:mt-0 sm:first:rounded-se-none sm:first:rounded-es-lg sm:last:rounded-es-none sm:last:rounded-se-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-white">
                                <div class="relative flex items-start w-full">
                                  <div class="flex items-center h-5">
                                    <input id="chb-price-<?= $value ?>" <?= in_array($value, $isErr ? $posted[$name] ?? [] : $selectedValues) ? 'checked ' : '' ?> name="<?= $name ?>[]" value="<?= $value ?>" type="checkbox" class="shrink-0 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                  </div>
                                  <label for="chb-price-<?= $value ?>" class="ms-3 block w-full text-sm text-gray-600 dark:text-neutral-500">
                                    <?= $disp ?>
                                  </label>
                                </div>
                              </li>
                            <?php } ?>
                          </ul>
                        </div>
                        <!-- 価格帯 -->

                        <!-- 重視ポイント -->
                        <div>
                          <div class="flex justify-between items-center">
                            <label class="block text-sm mb-2 dark:text-white">重視ポイントを教えて下さい(複数可)</label>
                          </div>
                          <ul class="flex flex-col">
                            <?php
                            $selectedValues = [];
                            $name = 'points';
                            foreach (['デザイン', 'コスパ', '機能', '信頼性', 'カスタマーサービス'] as $disp) {
                              $value = $disp;
                            ?>
                              <li class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-white">
                                <div class="relative flex items-start w-full">
                                  <div class="flex items-center h-5">
                                    <input id="chb-point-<?= $value ?>" <?= in_array($value, $isErr ? $posted[$name] ?? [] : $selectedValues) ? 'checked ' : '' ?> name="<?= $name ?>[]" value="<?= $value ?>" type="checkbox" class="shrink-0 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                  </div>
                                  <label for="chb-point-<?= $value ?>" class="ms-3 block w-full text-sm text-gray-600 dark:text-neutral-500">
                                    <?= $disp ?>
                                  </label>
                                </div>
                              </li>
                            <?php } ?>
                          </ul>
                        </div>
                        <!-- 重視ポイント -->

                        <!-- デザインテイスト -->
                        <div>
                          <div class="flex justify-between items-center">
                            <label class="block text-sm mb-2 dark:text-white">好みのデザインテイストがあれば教えて下さい(複数可)</label>
                          </div>
                          <ul class="flex flex-col">
                            <?php
                            $selectedValues = [];
                            $name = 'design_tastes';
                            foreach ([
                              'シンプル&ミニマル',
                              'カジュアル',
                              'フォーマル',
                              '高級感'
                            ] as $disp) {
                              $value = $disp;
                            ?>
                              <li class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-white">
                                <div class="relative flex items-start w-full">
                                  <div class="flex items-center h-5">
                                    <input id="chb-design-<?= $value ?>" <?= in_array($value, $isErr ? $posted[$name] ?? [] : $selectedValues) ? 'checked ' : '' ?> name="<?= $name ?>[]" value="<?= $value ?>" type="checkbox" class="shrink-0 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                  </div>
                                  <label for="chb-design-<?= $value ?>" class="ms-3 block w-full text-sm text-gray-600 dark:text-neutral-500">
                                    <?= $disp ?>
                                  </label>
                                </div>
                              </li>
                            <?php } ?>
                          </ul>
                        </div>
                        <!-- デザインテイスト -->

                        <!-- カラーテイスト -->
                        <div>
                          <div class="flex justify-between items-center">
                            <label class="block text-sm mb-2 dark:text-white">好みのカラーテイストがあれば教えて下さい(複数可)</label>
                          </div>
                          <ul class="flex flex-col">
                            <?php
                            $selectedValues = [];
                            $name = 'color_tastes';
                            foreach ([
                              'ナチュラル',
                              'カラフル',
                              'パステル',
                              'ダークカラー'
                            ] as $disp) {
                              $value = $disp;
                            ?>
                              <li class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-white">
                                <div class="relative flex items-start w-full">
                                  <div class="flex items-center h-5">
                                    <input id="chb-design-<?= $value ?>" <?= in_array($value, $isErr ? $posted[$name] ?? [] : $selectedValues) ? 'checked ' : '' ?> name="<?= $name ?>[]" value="<?= $value ?>" type="checkbox" class="shrink-0 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                  </div>
                                  <label for="chb-design-<?= $value ?>" class="ms-3 block w-full text-sm text-gray-600 dark:text-neutral-500">
                                    <?= $disp ?>
                                  </label>
                                </div>
                              </li>
                            <?php } ?>
                          </ul>
                        </div>
                        <!-- カラーテイスト -->

                        <!-- その他テイスト -->
                        <div>
                          <div class="flex justify-between items-center">
                            <label class="block text-sm mb-2 dark:text-white">その他、あてはまる好みがあれば教えて下さい(複数可)</label>
                          </div>
                          <ul class="flex flex-col">
                            <?php
                            $selectedValues = [];
                            $name = 'other_tastes';
                            foreach ([
                              'レトロ',
                              'モダン',
                              '未来的',
                              '機械的',
                              'スポーティ'
                            ] as $disp) {
                              $value = $disp;
                            ?>
                              <li class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-white">
                                <div class="relative flex items-start w-full">
                                  <div class="flex items-center h-5">
                                    <input id="chb-design-<?= $value ?>" <?= in_array($value, $isErr ? $posted[$name] ?? [] : $selectedValues) ? 'checked ' : '' ?> name="<?= $name ?>[]" value="<?= $value ?>" type="checkbox" class="shrink-0 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                  </div>
                                  <label for="chb-design-<?= $value ?>" class="ms-3 block w-full text-sm text-gray-600 dark:text-neutral-500">
                                    <?= $disp ?>
                                  </label>
                                </div>
                              </li>
                            <?php } ?>
                          </ul>
                        </div>
                        <!-- カラーテイスト -->

                        <!-- 店舗 -->
                        <div>
                          <div class="flex justify-between items-center">
                            <label class="block text-sm mb-2 dark:text-white">通販サイトを選択してください(複数可)</label>
                          </div>
                          <ul class="flex flex-col">
                            <?php
                            $selectedValues = [
                              'Amazon.co.jp',
                              '楽天市場',
                              'Yahoo!ショッピング',
                              'その他'
                            ];
                            $name = 'shops';
                            foreach ($shops as $shop) {
                              $value = $shop['shop_name'];
                              $disp = $shop['shop_name'];
                            ?>
                              <li class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-white">
                                <div class="relative flex items-start w-full">
                                  <div class="flex items-center h-5">
                                    <input id="chb-shop-<?= $value ?>" <?= in_array($value, $isErr ? $posted[$name] ?? [] : $selectedValues) ? 'checked ' : '' ?> name="<?= $name ?>[]" value="<?= $value ?>" type="checkbox" class="shrink-0 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                  </div>
                                  <label for="chb-shop-<?= $value ?>" class="ms-3 block w-full text-sm text-gray-600 dark:text-neutral-500">
                                    <?= $disp ?>
                                  </label>
                                </div>
                              </li>
                            <?php } ?>
                          </ul>
                        </div>
                        <!-- 店舗 -->

                        <div>
                          <label for="email" class="block text-sm mb-2 dark:text-white">メールアドレス</label>
                          <div class="relative">
                            <input type="email" id="email" name="email" value="<?= $posted['email'] ?>" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required aria-describedby="email-error">
                            <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                              <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                              </svg>
                            </div>
                          </div>
                          <p class="mt-2 text-sm text-red-600 dark:text-neutral-400">ご登録頂きましたメールアドレスは、ご要望への返信、及び本サービス利用に関するアンケートの送付にのみ使用します。</p>
                        </div>

                        <div class="hidden sm:block">
                          <div class="flex justify-between items-center">
                            <label class="block text-sm mb-2 dark:text-white">イメージ画像やURL等があれば、画面上に貼り付けて下さい。</label>
                          </div>
                        </div>
                        <div id="previews" class="w-full overflow-auto">

                        </div>
                        <button type="submit" class="w-full mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                          登録
                        </button>
                      </div>
                    </form>
                    <!-- End Form -->

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
        <div class="mt-5 sm:hidden flex justify-center">
          <ul>
            <li class="text-sm text-gray-600 dark:text-neutral-400">
              ※ 約1〜2週間前後でご連絡差し上げます。ただし、ご要望が多数の場合は遅れる場合があります。
            </li>
            <li class="text-sm text-gray-600 dark:text-neutral-400">
              ※ 費用は全て無料です。
            </li>
          </ul>
        </div>
      </div>
      <!-- End Clients Section -->
    </div>
    <!-- End Hero -->
  </main>
  <script src="./mng-preview.js"></script>
</body>
</html>