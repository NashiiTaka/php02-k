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
<style>
  .typing-indicator {
    display: inline-block;
    width: 5px;
    height: 5px;
    margin-right: 3px;
    background-color: #999;
    border-radius: 50%;
    animation: blink 1s infinite;
  }

  @keyframes blink {

    0%,
    100% {
      opacity: 1;
    }

    50% {
      opacity: 0;
    }
  }
</style>

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

          <!-- Right Col -->
          <div>
            <div class="lg:max-w-lg lg:mx-auto lg:me-0 ms-auto">
              <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-900 dark:border-neutral-700">
                <div class="p-4 sm:p-7" id="chat-area">
                  <!-- 雛形 -->
                  <div id="chat-template" class="hidden">
                    <div id="chat-chatno" class="hidden mb-6">
                      <div id="bot-wrap-chatno">
                        <div>
                          <img class="inline-block size-10 rounded-full" src="./img/bot.png" alt="Image Description"><span class="font-bold">アシスタント</span>
                        </div>
                        <div class="ps-10" id="bot-chatno">
                          <div class="flex p-4" aria-label="読み込み中">
                            <div class="animate-ping h-2 w-2 bg-blue-600 rounded-full"></div>
                            <div class="animate-ping h-2 w-2 bg-blue-600 rounded-full mx-4"></div>
                            <div class="animate-ping h-2 w-2 bg-blue-600 rounded-full"></div>
                          </div>
                        </div>
                      </div>
                      <div id="you-wrap-chatno" class="hidden pt-2">
                        <div class="text-2xl font-bold">
                          You
                        </div>
                        <div class="ps-10" id="you-chatno">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End 雛形 -->

                  <!-- 1チャット -->
                  <div id="chat-1" class="hidden mb-6">
                    <div id="bot-wrap-1">
                      <div>
                        <img class="inline-block size-10 rounded-full" src="./img/bot.png" alt="Image Description"><span class="font-bold">アシスタント</span>
                      </div>
                      <div class="ps-10" id="bot-1">
                        <div class="flex p-4" aria-label="読み込み中">
                          <div class="animate-ping h-2 w-2 bg-blue-600 rounded-full"></div>
                          <div class="animate-ping h-2 w-2 bg-blue-600 rounded-full mx-4"></div>
                          <div class="animate-ping h-2 w-2 bg-blue-600 rounded-full"></div>
                        </div>
                      </div>
                    </div>
                    <div id="you-wrap-1" class="hidden pt-2">
                      <div class="text-2xl font-bold">
                        You
                      </div>
                      <div class="ps-10" id="you-1">
                      </div>
                    </div>
                  </div>
                  <!-- End 1チャット -->
                </div>
              </div>
            </div>
          </div>
          <!-- End Right Col -->

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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="./index.js" type="module"></script>
</body>

</html>