<!doctype html>
<html lang="fa" dir="rtl" class="overflow-hidden">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Reyahane Pirouznia">
    <title>سامانه کسب وکار شرکت صنعتی مهرآباد</title>
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
    <style>
        *[dir=rtl] table.dataTable thead th, *[dir=rtl] table.dataTable thead td, *[dir=rtl] table.dataTable tfoot th, *[dir=rtl] table.dataTable tfoot td {
            text-align: center ;
        }
    </style>
</head>

<body >
<div class="container">


    <!-- Main modal -->

    <div class="relative mt-2 overflow-x-auto max-w-[1500px] bg-zinc-300 border-black border-2 shadow-md sm:rounded-lg">
        <table style="font-family: 'Iranian Sans'" class="rtl w-full">
            <tbody>
            <tr>
                <td class="border text-sm">شماره فرم بازنگری: SWFOPU04</td>
                <td rowspan="2" class="font-bold text-3xl text-center border">
                    شرکت صنعتی مهرآباد
                </td>
                <td rowspan="3" class="border text-center">
                    <img style="width:150px;margin: auto" src="<?= $this->asset('images/Picture3.png') ?>">
                </td>
            </tr>
            <tr>
                <td class="border">شماره بازنگری : 0</td>
            </tr>
            <tr>
                <td class="border text-sm">تاریخ بازنگری : 93/10/26</td>
                <td class="font-bold text-lg text-center border">فرم درخواست کالا از انبار</td>
            </tr>
            </tbody>

        </table>
        <table style="font-family: 'Iranian Sans'" class="rtl bg-white w-full mt-3 mb-3">
            <tbody>
            <tr>
                <td>واحد درخواست کننده: <?= $allData[0]['expense_code1'] ?></td>
                <td colspan="2">نام پروژه: <?= $allData[0]['proj_name'] ?></td>
            </tr>
            <tr class="mt-3">
                <td>تاریخ درخواست: <?= tr_num(jdate('Y/m/d H:i:s', (int)($allData[0]['order_no_time'] / 1000))) ?></td>
                <td colspan="2">شماره سفارش: <?= $allData[0]['proj_code'] . (isset($allData[0]['demand_no']) ? ' - ' . $allData[0]['demand_no'] : '')?></td>
            </tr>
            <tr class="mt-3">

                <td colspan="3">انبار: مواد اولیه</td>
            </tr>
            </tbody>

        </table>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-sm text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ردیف
                </th>
                <th scope="col" class="px-6 py-3">
                    شرح کالا
                </th>
                <th scope="col" class="px-6 py-3">
                    کد کالا
                </th>
                <th scope="col" class="px-6 py-3">
                    مشخصات فنی
                </th>
                <th scope="col" class="px-6 py-3">
                    تعداد درخواست
                </th>
                <th scope="col" class="px-6 py-3">
                    تعداد حواله
                </th>
                <th scope="col" class="px-6 py-3">
                    ملاحظات
                </th>
            </tr>
            </thead>
            <tbody>

            <?php

            foreach ($allData as $key => $BPM_INFO) {
                ?>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?= $key + 1 ?>
                    </th>
                    <td class="px-6 py-1">
                        <?= $BPM_INFO['equip'] ?>
                    </td>
                    <td class="px-6 py-1">
                        <?= $BPM_INFO['id_code'] ?>
                    </td>
                    <td class="px-6 py-1">
                        <?= $BPM_INFO['spec'] ?>
                    </td>
                    <td class="px-6 py-1">
                        <?= $BPM_INFO['qty_demand'] ?>
                    </td>
                    <td class="px-6 py-1">
                        <?= $BPM_INFO['qty_draft'] ?>
                    </td>
                    <td class="px-6 py-1">
                        <?= $BPM_INFO['description'] ?>

                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>

        <table style="font-family: 'Iranian Sans';height: 150px"
               class="rtl bg-white w-full text-sm text-normal font-bold mt-3 mb-3">
            <thead>
            <tr>
                <th>واحد درخواست کننده</th>
                <th>مدیر واحد درخواست کننده</th>
                <th>مسئول تحویل دهنده</th>
                <th>شخص تحویل گیرنده</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="1" class="border">
<!--                    <img style="width:150px;margin: auto"-->
<!--                                                    src="--><?php //= $this->asset('images/Picture3.png') ?><!--">-->
                    <div style="font-family: 'Monotype Corsiva';font-weight: bolder;" class="text-center">
                        <?php
                        if(isset($allData[0]['applicator']) && !is_null($allData[0]['applicator']) && str_contains($allData[0]['applicator'],";")){
                            $requester=explode(";",$allData[0]['applicator']);
                            echo "<p>Signature: ".$requester[0].PHP_EOL."</p>";
                            echo "<p>Address: ".$requester[1].PHP_EOL."</p>";
                            echo "<p>Date: ".$requester[2].PHP_EOL."</p>";}
                        ?>
                    </div>
                </td>
                <td colspan="1" class="border"></td>
                <td colspan="1" class="border">
                    <div style="font-family: 'Monotype Corsiva';font-weight: bolder;" class="text-center">
                    <?php
                    if (isset($signData) && count($signData) > 0 && isset($allData[0]['confirmer'])) {
                        $confirmer=explode(";",$allData[0]['confirmer']);
                        echo "<p>Signature: ".$confirmer[0].PHP_EOL."</p>";
                        echo "<p>Address: ".$confirmer[1].PHP_EOL."</p>";
                        echo "<p>Date: ".$confirmer[2].PHP_EOL."</p>";
                        ?>
<!--                        <img style="width:150px;margin: auto" src="--><?php //= $this->asset('images/Picture1.png') ?><!--">-->
                    </div>
                        <?php
                    }
                    ?></td>
                <td colspan="1" class="border"></td>
            </tr>
            </tbody>

        </table>
        <?php
        if (isset($signData) && count($signData) > 0)
        {

        ?>
        <div class="bg-white">
        <h5 class="mr-2">توضیحات:
        </h5>
        <?php
        for ($i = 0; $i < count($signData); $i++) {
            ?>
            <p class="mr-5"><?= $i + 1 ?>- حواله <?= $signData[$i]['draft_no'] ?> به
                تاریخ <?= $signData[$i]['date'] ?></p>
            <?php
        }
        ?>
    </div>
    <?php
    }
    ?>
        <?php
        if (isset($boughtData) && count($boughtData) > 0)
        {

            ?>
            <div class="bg-white">
                <h5 class="mr-2">توضیحات:
                </h5>
                <?php
                for ($i = 0; $i < count($boughtData); $i++) {
                    ?>
                    <p class="mr-5"><?= $i + 1 ?>- درخواست خرید <?= $boughtData[$i]['draft_no'] ?> به
                        تاریخ <?= $boughtData[$i]['date'] ?></p>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
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
    // onlineSearch($('#999'), url('supplier/getAll'), $("#888"), 'nam')

    // function jsonSearch(name, code=''){
    //     return  `<div aria-label=${code} class="cursor-pointer py-2 px-4 w-full text-sm text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-none
    //                     focus:bg-gray-100" tabindex="3" data-hs-combo-box-output-item="">
    //         <div class="flex justify-between items-center w-full">
    //             <span aria-label="${name}">${name}</span>
    //
    //       <svg class="shrink-0 size-3.5 text-blue-600"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
    //       stroke-linecap="round" stroke-linejoin="round">
    //         <path d="M20 6 9 17l-5-5"></path>
    //       </svg>
    //     </span>
    //         </div>
    //     </div>`
    // }
    // function onlineSearch(input, uri, list, name, code = '') {
    let inputID = $('#inputID'), listID = $("#listID");
    inputID.on('keyup', (ev) => {
        $.ajax({
            url: url('supplier/getAll'),
            type: 'POST',
            data: ev.target.value,
            async: false,
            success: result => {
                console.log(result)
                listID.show();
                let json = JSON.parse(result), info;
                let display;
                json.forEach(j => {
                    display = ev.target.value === j.nam ? 'block' : 'none';
                    info += `<div aria-label=${j.cod} class="list-row cursor-pointer py-2 px-4 w-full text-sm text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-none
                        focus:bg-gray-100" tabindex="3" data-hs-combo-box-output-item="">
            <div class="flex justify-between items-center w-full">
                <span aria-label="${j.nam}">${j.nam}</span>
          <svg style="display:${display}" class="shrink-0 size-3.5 text-blue-600" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
        </span>
            </div>
        </div>`
                })

                listID.html(info)
            }
        });
    })
    hideOnClick(document, listID)
    listID.on("click", ".list-row ", function () {
        let text = $(this).find(`span[aria-label]`).attr('aria-label');
        inputID.val(text)
        listID.hide()
    })
    //}
</script>
</html>
<!--<script type="text/javascript" src="--><?php //$this->asset('js/project.js'); ?><!--"></script>-->