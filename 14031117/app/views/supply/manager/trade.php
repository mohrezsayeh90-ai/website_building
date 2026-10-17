<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
?>
<div class="p-2 pb-0 h-full">
    <div class="container relative h-full">
        <h4 class="text-2xl text-center font-bold">
           مدیریت محترم عامل
        </h4>
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center mt-1" id="menuList">
            <li class="me-2">
                <button  class="inline-block p-4 border-b-2 rounded-t-lg
                focus:text-purple-600 hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300
                 dark:border-transparent text-this-gray bg-slate-200 dark:text-gray-400 border-gray-100 dark:border-gray-700 text-lg"  id="tolid1"
                        type="button" role="tab">پروژه های در جریان
                </button>
            </li>
            <li class="me-2">
                <button  class="inline-block p-4 border-b-2 rounded-t-lg focus:text-purple-600 hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300
                 dark:border-transparent text-this-gray  dark:text-gray-400 border-gray-100 dark:border-gray-700 text-lg" id="tolid2"
                         type="button">درخواستهای خرید
                </button>
            </li>

        </ul>
    </div>
    <div class="absolute bottom-0 w-full left-0 pr-2 " id="iframeDiv">
        <iframe class="h-full w-full" id="MainFrame" src="<?=$this->url($tradeAddress)?>"></iframe>
    </div>
</div>
<script>

</script>
<?php
$this->includeFile('layouts/partials/back-to-top');
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/manager.js'); ?>"></script>
