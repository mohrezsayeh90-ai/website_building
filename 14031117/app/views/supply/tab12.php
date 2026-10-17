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
<div class="container mt-0">
    <div class="no-print  text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200
        dark:border-gray-700 dark:text-gray-400" id="alltabsMain"
            data-tabs-toggle="#default-styled-tab-content"
            data-tabs-active-classes="text-purple-600"
            data-tabs-inactive-classes="dark:border-transparent text-this-gray hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
            role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500"

                        id="incomplete-styled-tab"
                        data-tabs-target="#styled-incomplete" type="button"
                        role="tab"
                        aria-controls="incomplete">
                    فهرست درخواستهای باز
                </button>

            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500"
                        onclick="document.getElementById('thisFrame').src='<?= $this->url('produce/tab122') ?>'"
                        id="complete-styled-tab"
                        data-tabs-target="#styled-complete" type="button"
                        role="tab"
                        aria-controls="complete">
                    فهرست درخواستها تکمیل شده
                </button>

            </li>
        </ul>
    </div>
    <div class=" rounded-lg dark:bg-gray-800 w-full h-full" id="styled-complete" role="tabpanel"
         aria-labelledby="complete-styled-tab">
        <div class="h-full">
            <iframe style="min-height: 800px !important" id="thisFrame" class=" w-full h-full"></iframe>
        </div>
    </div>
    <div class=" rounded-lg dark:bg-gray-800"
         id="styled-incomplete"
         role="tabpanel"
         aria-labelledby="incomplete-styled-tab">
        <div style="max-width:1600px">


                    <table id="myDPL" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-sm text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ردیف
                            </th>
                            <th scope="col" class="px-6 py-3">
                                کد پروژه
                            </th>
                            <th scope="col" class="px-6 py-3">
                                شرح پروژه
                            </th>
                            <th scope="col" class="px-6 py-3">
                                شماره BOM
                            </th>

                            <th scope="col" class="px-6 py-3">
                                شماره درخواست/سفارش
                            </th>
                            <th scope="col" class="px-6 py-3">
                                تاریخ درخواست
                            </th>
                            <th scope="col" class="px-6 py-3">
                                وضعیت درخواست
                            </th>
                            <th scope="col" class="px-6 py-3">
                                عملیات
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // print_r($incompl eteProj);
                        foreach ($incompleteOrders as $key => $incOrd) {
                            ?>

                            <tr class="odd:bg-white text-center odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td scope="row" class="px-6 py-0 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?= $key + 1 ?>
                                </td>
                                <td class="px-6 py-0">
                                    <?= $incOrd['proj_code'] ?>
                                </td>
                                <td class="px-6 py-0">
                                    <?= $incOrd['proj_name'] ?>
                                </td>
                                <td class="px-6 py-0">
                                    <?= $incOrd['document_no'] ?>
                                </td>

                                <td class="px-6 py-0">
                                    <?= $incOrd['demand_no'] ?>
                                </td>
                                <td class="px-6 py-0 ltr">

                                        <?= tr_num(jdate('Y/m/d H:i:s', (int)($incOrd['order_no_time'] / 1000))) ?>

                                </td>
                                <td class="px-6 py-0">
                                    <?php
                                    if($incOrd['demand_no']=='' && !$incOrd['iscompleted'])
                                    {
                                        echo "در حال بررسی/واحد انبار";
                                    }
                                    ?>

                                </td>


                                <td class="px-6 py-0">
                                    <button  onclick="window.open('<?= $this->url("produce/demandDetails/?p=" . $incOrd['proj_code'] . "&o=" . $incOrd['order_no_time']) ?>','_blank')"
                                            class=" rtl mb-1 float-left mt-1 text-sm font-medium text-gray-900 focus:outline-none bg-white
                rounded-lg border
                                  animate-bounce fa fa-eye border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100
                                  dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600
                                  dark:hover:text-white dark:hover:bg-gray-700"></button>
                                </td>
                            </tr>

                            <?php
                        }
                        ?>
                        </tbody>

                    </table>

        </div>
    </div>


    <div class=" rounded-lg dark:bg-gray-800"
         id="styled-complete"
         role="tabpanel"
         aria-labelledby="complete-styled-tab">

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
        // new DataTable("#incorderTable", {
        //
        //     "pageLength": 10,
        // });
        new DataTable("#myDPL", {

            "pageLength": 10,
            order: [[1, 'desc']],
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