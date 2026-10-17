<!doctype html>
<html lang="fa" dir="rtl">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Reyahane Pirouznia">
    <title>سامانه مناقصات شرکت صنعتی مهرآباد</title>
    <link rel="icon" href="<?php $this->asset("images/logo.png") ?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/outputWind.css") ?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/owl.theme.default.min.css") ?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/fonts/bootstrap-icons.min.css") ?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/fonts/font-awesome.min.css") ?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/dataTables.css") ?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/buttons-datatables.css") ?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/jalalidatepicker.css") ?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/sweetAlert2.min.css") ?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/swiper.min.css") ?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/swiper-bundle.min.css") ?>">
    <link type="text/css" rel="stylesheet" href=<?php $this->asset("lib/css/dropzone.css") ?>>
    <link type="text/css" rel="stylesheet" href=<?php $this->asset("css/general.css") ?>>
    <link type="text/css" rel="stylesheet" href=<?php $this->asset("css/special.css") ?>>
</head>

<body>
<div class="container mt-0">
    <div class="no-print  text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200
        dark:border-gray-700 dark:text-gray-400" id="alltabsMain"
            data-tabs-toggle="#default-styled-tab-content"
            data-tabs-active-classes="text-purple-600"
            data-tabs-inactive-classes="dark:border-transparent text-this-gray hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
            role="tablist">
            <li class="me-2" role="presentation">
                <button onclick="$('#thisFrame').attr('src',url('trade/tab331'))" class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500"

                        id="incomplete-styled-tab"
                        data-tabs-target="#styled-incomplete" type="button"
                        role="tab"
                        aria-controls="incomplete">
                    فهرست درخواستهای خرید باز
                </button>

            </li>
<!--            status=26-->
            <li class="me-2" role="presentation">
                <button onclick="$('#thisFrame01').attr('src',url('trade/tab3311'))" class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500"

                        id="have-buy-order-styled-tab"
                        data-tabs-target="#styled-have-buy-order" type="button"
                        role="tab"
                        aria-controls="">
                    فهرست درخواستهای دارای مجوز خرید
                </button>

            </li>
<!--           status=27 with packing -->
            <li class="me-2" role="presentation">
                <button onclick="$('#thisFrame02').attr('src',url('trade/tab3312'))" class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500"

                        id="packing-styled-tab"
                        data-tabs-target="#styled-packing" type="button"
                        role="tab"
                        aria-controls="">
                    پکهای خرید
                </button>

            </li>

            <li class="me-2" role="presentation">
                <button onclick="$('#thisFrame03').attr('src',url('trade/tab3313'))" class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500"

                        id="in-buying-state-styled-tab"
                        data-tabs-target="#styled-in-buying-state" type="button"
                        role="tab"
                        aria-controls="">
                    درخواستهای در حال خرید
                </button>

            </li>
            <li class="me-2" role="presentation">
                <button onclick="$('#thisFrame1').attr('src',url('trade/tab332'))" class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500"

                        id="complete-styled-tab"
                        data-tabs-target="#styled-complete" type="button"
                        role="tab"
                        aria-controls="complete">
                    فهرست درخواستهای خرید تکمیل شده
                </button>

            </li>
        </ul>
    </div>
    <div class=" rounded-lg dark:bg-gray-800 w-full h-full" id="styled-incomplete"  role="tabpanel" aria-labelledby="incomplete-styled-tab">
        <div class="h-full">
            <iframe style="min-height: 800px !important" id="thisFrame"  class=" w-full h-full"></iframe>
        </div>
    </div>
    <div class=" rounded-lg dark:bg-gray-800 w-full h-full" id="styled-have-buy-order"  role="tabpanel" aria-labelledby="have-buy-order-styled-tab">
        <div class="h-full">
            <iframe style="min-height: 800px !important" id="thisFrame01"  class=" w-full h-full"></iframe>
        </div>
    </div>
    <div class=" rounded-lg dark:bg-gray-800 w-full h-full" id="styled-packing"  role="tabpanel" aria-labelledby="packing-styled-tab">
        <div class="h-full">
            <iframe style="min-height: 800px !important" id="thisFrame02"  class=" w-full h-full"></iframe>
        </div>
    </div>
    <div class=" rounded-lg dark:bg-gray-800 w-full h-full" id="styled-in-buying-state"  role="tabpanel" aria-labelledby="in-buying-state-styled-tab">
        <div class="h-full">
            <iframe style="min-height: 800px !important" id="thisFrame03"  class=" w-full h-full"></iframe>
        </div>
    </div>
    <div class=" rounded-lg dark:bg-gray-800" id="styled-complete"  role="tabpanel"  aria-labelledby="complete-styled-tab">
        <div class="h-full">
            <iframe style="min-height: 800px !important" id="thisFrame1"   class=" w-full h-full"></iframe>
        </div>
    </div>



</div>


</body>
<script type="text/javascript" src="<?php $this->asset('lib/js/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset("lib/js/dataTables.min.js") ?>"></script>
<script type="text/javascript" src="<?php $this->asset("lib/js/dataTables.buttons.min.js") ?>"></script>
<script type="text/javascript" src="<?php $this->asset("lib/js/buttons.print.min.js") ?>"></script>
<script type="text/javascript" src="<?php $this->asset("lib/js/buttons.html5.min.js") ?>"></script>
<script type="text/javascript" src="<?php $this->asset("lib/js/dataTables.fixedHeader.min.js") ?>"></script>
<script type="text/javascript" src="<?php $this->asset('lib/js/sweetAlert2.all.min.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('lib/js/owl.carousel.min.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('lib/js/swiper.min.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('lib/js/swiper-bundle.min.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('lib/js/dropzone.js') ?>"></script>
<script type="text/javascript"
        src="<?=Base_Url?>/node_modules/flowbite/dist/flowbite.min.js"></script>

<script type="text/javascript" src="<?php $this->asset('lib/js/jalalidatepicker.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('js/helpers.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('js/main.js') ?>"></script>
<script type="text/javascript" src="<?= $this->asset('lib/jsc/jscharting.js') ?>"></script>
<script>
    $(document).ready(() => {

        $('#thisFrame1').attr('src',url('trade/tab332'))
        $('#thisFrame').attr('src',url('trade/tab331'))
       // $('#thisFrame01').attr('src',url('trade/tab3311'))
       // $('#thisFrame02').attr('src',url('trade/tab3312'))
       // $('#thisFrame03').attr('src',url('trade/tab3313'))

    })

</script>

</html>
<!--<script type="text/javascript" src="--><?php //$this->asset('js/project.js'); ?><!--"></script>-->