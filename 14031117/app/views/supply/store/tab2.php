<!doctype html>
<html lang="fa" dir="rtl">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Reyahane Pirouznia">
    <title>سامانه مناقصات شرکت صنعتی مهرآباد</title>
    <link rel="icon" href="<?php $this->asset("images/logo.png")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/outputWind.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/owl.theme.default.min.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/fonts/bootstrap-icons.min.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/fonts/font-awesome.min.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/dataTables.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/buttons-datatables.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/jalalidatepicker.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/sweetAlert2.min.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/swiper.min.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/swiper-bundle.min.css")?>">
    <link type="text/css" rel="stylesheet" href=<?php $this->asset("lib/css/dropzone.css") ?>>
    <link type="text/css" rel="stylesheet" href=<?php $this->asset("css/general.css") ?>>
    <link type="text/css" rel="stylesheet" href=<?php $this->asset("css/special.css") ?>>
    <style>
        *[dir=rtl] table.dataTable thead th, *[dir=rtl] table.dataTable thead td, *[dir=rtl] table.dataTable tfoot th, *[dir=rtl] table.dataTable tfoot td {
            text-align: center ;
        }
    </style>
</head>

<body>
<div class="container mt-0">

    <table id="myDPL" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="uppercase text-md dark:bg-gray-700 dark:text-gray-400 bg-this-teal text-white">
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
                تاریخ BOM
            </th>
            <th scope="col" class="px-6 py-3">
                وضعیت BOM
            </th>

            <th scope="col" class="px-6 py-3">
                عملیات
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
        // print_r($incompl eteProj);
        foreach ($incompleteProj as $key => $incProj) {
            ?>

            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <td style="text-align: center !important" scope="row" class="px-6 py-0 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?= $key + 1 ?>
                </td>
                <td style="text-align: center !important" class="px-6 py-0">
                    <?= $incProj['proj_code'] ?>
                </td>
                <td style="text-align: center !important" class="px-6 py-0">
                    <?= $incProj['proj_name'] ?>
                </td>
                <td style="text-align: center !important" class="px-6 py-0">
                    <?= $incProj['document_no'] ?>
                </td>
                <td style="text-align: center !important" class="px-6 py-0">
                    <?= $incProj['document_date'] ?>
                </td>


                <td style="text-align: center !important" class="px-6 py-0">
                    <?php
                    switch ($incProj['proj_status']) {
                        case 0:
                            echo "ثبت مشخصات کلی";
                            break;
                        case 1:
                            echo "استخراج داده از مناقصه" . " " . $incProj['proj_tender_code_default'] . ' و تکمیل شناسنامه پروژه';
                            break;
                        case 3:
                            echo 'بررسی شناسنامه پروژه توسط دفتر';
                            break;
                        case 6:
                            echo 'تکمیل اسناد EPL توسط مدیر پروژه';
                            break;
                        case 7:
                            echo 'بررسی اسناد EPL توسط برنامه ریزی دفتر';
                            break;
                        case 8:
                            echo 'تکمیل اسناد DPL توسط واحد مهندسی';
                            break;
                        case 10:
                            echo 'در حال تایید نهایی اسناد DPL';
                            break;
                        case 12:
                            echo 'تامین مواد اولیه و ساخت';
                            break;
                    }
                    ?></p>
                </td>

                <td class="px-6 py-0">
                    <button style="background-color: #009999;color:#000000" onclick="window.open('<?=$this->url("store/dpl/?p=".$incProj['proj_code'])?>','_self')"
                            class="w-full rtl mb-1 float-left mt-1 text-sm font-medium text-gray-900 focus:outline-none bg-white
                rounded-lg border
                                  animate-bounce  border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100
                                  dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600
                                  dark:hover:text-white dark:hover:bg-gray-700">DPL</button>
                </td>

            </tr>
            <?php
        }
        ?>

        </tbody>
    </table>
</div>
<?php
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script>
    $(document).ready(()=>{
        searchInRow($("#search"), ".product_name, .product_code, .product_manager, .product_date, .product_client, .product_duration, .product_status", $(".product_card"))
        new DataTable("#myDPL", {

            "pageLength": 10,
            order: [[1, 'desc']],
        });
        $('#myDPL').css('width','100%')
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
let inputID = $('#inputID'), listID =$("#listID");
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
                        display =ev.target.value === j.nam ?'block':'none';
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
   hideOnClick(document,listID )
listID.on("click", ".list-row ", function (){
    let text = $(this).find(`span[aria-label]`).attr('aria-label');
    inputID.val(text)
    listID.hide()
})
    //}
</script>
</body>
<script type="text/javascript" src="<?php $this->asset('lib/js/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset("lib/js/dataTables.min.js")?>"></script>
<script type="text/javascript" src="<?php $this->asset("lib/js/dataTables.buttons.min.js")?>"></script>
<script type="text/javascript" src="<?php $this->asset("lib/js/buttons.print.min.js")?>"></script>
<script type="text/javascript" src="<?php $this->asset("lib/js/buttons.html5.min.js")?>"></script>
<script type="text/javascript" src="<?php $this->asset("lib/js/dataTables.fixedHeader.min.js")?>"></script>
<script type="text/javascript" src="<?php $this->asset('lib/js/sweetAlert2.all.min.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('lib/js/owl.carousel.min.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('lib/js/swiper.min.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('lib/js/swiper-bundle.min.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('lib/js/dropzone.js') ?>"></script>
<script type="text/javascript" src="<?=Base_Url?>/node_modules/flowbite/dist/flowbite.min.js"></script>

<script type="text/javascript" src="<?php $this->asset('lib/js/jalalidatepicker.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('js/helpers.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('js/main.js') ?>"></script>
<script type="text/javascript" src="<?= $this->asset('lib/jsc/jscharting.js') ?>"></script>

</html>
<!--<script type="text/javascript" src="--><?php //$this->asset('js/project.js'); ?><!--"></script>-->