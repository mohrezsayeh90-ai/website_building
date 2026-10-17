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
    <style>
        *[dir=rtl] table.dataTable thead th, *[dir=rtl] table.dataTable thead td, *[dir=rtl] table.dataTable tfoot th, *[dir=rtl] table.dataTable tfoot td {
            text-align: center;
        }
    </style>
</head>

<body>
<div class="container bg-white mt-0">
<h1 class="text-center text-3xl">Price analyze of <?=$q?></h1>
    <h3 class="text-center text-xl mt-10">EPL Refrence</h3>
    <table id="myEquip" class="w-full text-xs ltr text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-10">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">

        <tr>
            <th style="text-align: center !important;width:5%" scope="col" class="pr-6 pl-1 py-3">ROW</th>
            <th style="text-align: center !important;width:40%" scope="col" class="pr-6 pl-1 py-3">TECHNICAL
                SPECIFICATION
            </th>
            <th style="text-align: center !important;width:15%" scope="col" class="pr-6 pl-1 py-3 text-end">
                Manufaturer
            </th>
            <th style="text-align: center !important;width:10%" scope="col" class="pr-6 pl-1 py-3 text-end">Date</th>
            <th style="text-align: center !important;width:15%" scope="col" class="pr-6 pl-1 py-3 text-end">PRICE I</th>
            <th style="text-align: center !important;width:15%" scope="col" class="pr-6 pl-1 py-3 text-end">PRICE RIAL
            </th>

        </tr>
        </thead>
        <tbody>
        <?php
        // print_r($incompl eteProj);
        foreach ($allData as $key => $data) {
            ?>

            <tr class="odd:bg-white text-center odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <td scope="row" class="px-6 py-0 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?= $key + 1 ?>
                </td>
                <td class="px-6 py-0 text-left">
                    <?= $data['type'] ?>
                </td>
                <td class="px-6 py-0">
                    <?= $data['manufact'] ?>
                </td>
                <td class="px-6 py-0">
                    <?= $data['trkh'] ?>
                </td>
                <td class="px-6 py-0">
                    <?= number_format($data['price_i']) ?>
                </td>
                <td class="px-6 py-0">
                    <?= number_format($data['price_r']) ?>
                </td>

            </tr>

            <?php
        }
        ?>
        </tbody>
    </table>
    <h3 class="text-center text-xl mt-10">Buy Refrence</h3>
    <table id="myEquip0" class="w-full text-xs ltr text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-10">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">

        <tr>
            <th style="text-align: center !important;width:5%" scope="col" class="pr-6 pl-1 py-3">ROW</th>
            <th style="text-align: center !important;width:40%" scope="col" class="pr-6 pl-1 py-3">TECHNICAL
                SPECIFICATION
            </th>
            <th style="text-align: center !important;width:15%" scope="col" class="pr-6 pl-1 py-3 text-end">
                Manufaturer
            </th>
            <th style="text-align: center !important;width:10%" scope="col" class="pr-6 pl-1 py-3 text-end">Date</th>
            <th style="text-align: center !important;width:15%" scope="col" class="pr-6 pl-1 py-3 text-end">PRICE I</th>
            <th style="text-align: center !important;width:15%" scope="col" class="pr-6 pl-1 py-3 text-end">PRICE II
            </th>
            <th style="text-align: center !important;width:15%" scope="col" class="pr-6 pl-1 py-3 text-end">PRICE III
            </th>

        </tr>
        </thead>
        <tbody>
        <?php
        // print_r($incompl eteProj);
        foreach ($allData1 as $key => $data) {
            ?>

            <tr class="odd:bg-white text-center odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <td scope="row" class="px-6 py-0 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?= $key + 1 ?>
                </td>
                <td class="px-6 py-0 text-left">
                    <?= $data['spec'] ?>
                </td>
                <td class="px-6 py-0">
                    <?= $data['manufact'] ?>
                </td>
                <td class="px-6 py-0">
                    <?= $data['trkh'] ?>
                </td>
                <td class="px-6 py-0">
                    <?= number_format($data['price1']) ?>
                </td>
                <td class="px-6 py-0">
                    <?= number_format($data['price2']) ?>
                </td>
                <td class="px-6 py-0">
                    <?= number_format($data['price3']) ?>
                </td>

            </tr>

            <?php
        }
        ?>
        </tbody>
    </table>
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
        // new DataTable("#incorderTable", {
        //
        //     "pageLength": 10,
        // });
        new DataTable("#myEquip", {

            "pageLength": 10,
            order: [[3, 'desc']],
        });
        new DataTable("#myEquip0", {

            "pageLength": 10,
            order: [[3, 'desc']],
        });
    })
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

