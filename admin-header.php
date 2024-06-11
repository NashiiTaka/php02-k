<!-- ========== HEADER ========== -->
<?php
include './html-head.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<header class="flex flex-wrap sm:justify-start sm:flex-nowrap z-50 w-full bg-blue-600 text-sm py-3 sm:py-0 sticky top-0">
  <nav class="relative max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8" aria-label="Global">
    <div class="flex items-center justify-between">
      <a class="flex-none text-xl font-semibold text-white" href="#" aria-label="Brand">
        <img src="./img/okalogo.png" class="max-h-12">
      </a>
      <div class="sm:hidden">
        <button type="button" class="hs-collapse-toggle size-9 flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-white/20 text-white hover:border-white/40 disabled:opacity-50 disabled:pointer-events-none" data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
          <svg class="hs-collapse-open:hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" x2="21" y1="6" y2="6" />
            <line x1="3" x2="21" y1="12" y2="12" />
            <line x1="3" x2="21" y1="18" y2="18" />
          </svg>
          <svg class="hs-collapse-open:block hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18" />
            <path d="m6 6 12 12" />
          </svg>
        </button>
      </div>
    </div>
    <div id="navbar-collapse-with-animation" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end py-2 md:py-0 sm:ps-7">
        <?php foreach (['Requests' => 'admin-req-list.php', 'Users' => 'admin-user-list.php'] as $disp => $page) {
          if ($currentPage === $page) {
            echo '<a class="py-3 ps-px sm:px-3 font-medium text-white" href="' . $page . '" aria-current="page">' . $disp . '</a>';
          } else {
            echo '<a class="py-3 ps-px sm:px-3 font-medium text-white/80 hover:text-white" href="' . $page . '">' . $disp . '</a>';
          }
        } ?>
        <a class="flex items-center gap-x-2 font-medium text-white/80 hover:text-white sm:border-s sm:border-white/30 py-2 md:py-0 sm:my-6 sm:ps-6" href="./logout.php">
          <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
            <circle cx="12" cy="7" r="4" />
          </svg>
          Log out
        </a>
      </div>
    </div>
  </nav>
</header>
<!-- ========== END HEADER ========== -->