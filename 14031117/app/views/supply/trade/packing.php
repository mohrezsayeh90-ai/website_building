<!doctype html>
<html lang="fa" dir="rtl" class="overflow-hidden">
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


        .page {
            position: relative;
            height: auto;
            min-height: 95%;
            width: 95%;
            display: block;
            background: rgba(255, 255, 255, 1) !important;
            margin: 0 auto 5px;
            page-break-after: always; /*This style rule makes every page element start at the top of a new page:*/
            counter-increment: page
        }
        /*page numbers*/
        div.page:before {
            content: " PAGE - " counter(page);
            position: absolute;
            bottom: 0px;
            right: 15px;
            z-index: 999;
            padding: 2px 12px;
            border-right: 2px solid #23b8e7;
            font-size: 10px;
            font-family: "Iranian Sans";
        }

        .main-div-project {

            bottom: 0;
            left: 0;
            right: 0;
            top: 0px;
            height: calc(100vh);
            width: 100%;
            background: #ffffff;
            overflow-y: scroll;
            /*background: linear-gradient(116deg, rgba(249, 251, 255, 1) 0%, rgba(240, 235, 227, 1) 57%, rgba(249, 251, 255, 1) 100%);*/

        }

        @media print {

            @page {
                size: A4 portrait !important;

            }

            .main-div-project{
                overflow: initial !important;
            }

            .page-break {
                page-break-after: always !important;

            }
        }

    </style>
</head>

<body style="font-family: primaryFont">

<div id="main_divm" class="m-2 bg-white main-div-project">
        <?php
        $pagecnt=1;
        $intipage=12;

            for($i=0;$i<count($incbuyOrder);$i+=$intipage){

            ?>
            <div class="page">
            <table style="font-family: 'Iranian Sans'" class="ltr w-[95%] text-xs mt-5 mr-5">
         <thead>
    <tr style="height:30px">
        <td colspan="7" class="border-2"><p>Packing No: <?=$incbuyOrder[0]['buy_packing_no']?></p>
        <p><p>Packing Date: <?=$incbuyOrder[0]['buy_packing_date']?></p></td>
        <td colspan="13" class="border-2"><img style="margin:auto" class="mt-2 mr-2 w-[150px]" src="<?= $this->asset('images/picture3.png') ?>"></td>
    </tr>
    <tr>
        <th colspan="2" style="width:5%" class="border-2">ITEM</th>
        <th colspan="4" style="width:15%" class="border-2">DESCRIPTION</th>
        <th colspan="6" style="width:25%" class="border-2">TECHNICAL SPECIFICATION</th>
        <th colspan="2" style="width:10%" class="border-2">MANUFACTURER</th>
        <th style="width:15%" class="border-2">QTY</th>
        <th colspan="4" style="width:25%" class="border-2">Price</th>
        <th  style="width:5%" class="border-2">Done</th>
    </tr>
    </thead>
    <tbody>

<!--        شروع صفحه-->
<?php
for($j=$i;$j<min(count($incbuyOrder),$i+$intipage);$j++){
?>
    <tr>
        <td colspan="2" style="width:5%" class="border-2 text-center"><?=$j+1?></td>
        <td colspan="4" style="width:15%" class="border-2 ml-2" ><?=$incbuyOrder[$j]['equip']?></td>
        <td colspan="6" style="width:40%" class="border-2 text-center text-wrap"><?=$incbuyOrder[$j]['spec']?></td>
        <td colspan="2" style="width:10%" class="border-2 text-center"><?=$incbuyOrder[$j]['manufact']?></td>
        <td style="width:15%" class="border-2 text-center"><?=$incbuyOrder[$j]['qty_buy']?></td>
        <td style="width:10%" colspan="4" class="border-2 text-center"></td>
        <td style="width:5%" class="border-2 text-center"></td>
    </tr>
<!--        پایان صفحه-->
        <?php
                }
        ?>
    </tbody>
            </table>
            </div>

        <?php


            $pagecnt++;
            }
        ?>

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

    })
    $(document).ready(() => {
        searchInRow($("#search"), ".product_name, .product_code, .product_manager, .product_date, .product_client, .product_duration, .product_status", $(".product_card"))
        new DataTable("#myDPL", {

            "pageLength": 10,
            order: [1, 'desc'],
        });
        $('#myDPL').css('width', '100%')
    })
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

    async function setProjectProgress(p) {
        await Swal.fire({
                text: `لطفا درصد پیشرفت پروژه را در محدوده صفر تا صد وارد نمایید!`,
                input: "text",
                inputAttributes: {
                    autocapitalize: "off",
                    placeholder: "0-100",
                    dir: 'ltr'
                },
                showCancelButton: true,
                cancelButtonText: "انصراف",
                confirmButtonText: "تایید",
                showLoaderOnConfirm: true,
                preConfirm: async (number) => {
                    if (number) {
                        return number;
                    } else {
                        Swal.showValidationMessage(`<span class="text-sm">لطفا عدد بین 0 تا 100 وارد نمایید</span>`);
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }
        ).then(async (result) => {
            if (result.isConfirmed && result.value) {

                await $.ajax({
                    url: url('prjman/setProjectProgress'),
                    method: "POST",
                    data: {
                        p: p,

                        progress: result.value
                    }
                }).then(async () => {
                    await ToastPro('درصد پیشرفت پروژه با موفقیت به روز شد!', 'top', 'success', 1)
                    //  location.reload()
                })

            }
        });
    }

    //}
</script>
</html>
<!--<script type="text/javascript" src="--><?php //$this->asset('js/project.js'); ?><!--"></script>-->