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

        @media print {

            @page {
                size: A4 portrait !important;
                margin: auto;
            }

            .main-div-project {
                overflow: initial !important;
            }

            .page-break {
                page-break-after: always !important;

            }
        }

        .page {
            position: relative;
            height: 1000px;
            min-height: 95%;
            width: 100%;
            display: block;
            background: rgba(255, 255, 255, 1) !important;
            margin: 0 auto 5px;
            page-break-before: always; /*This style rule makes every page element start at the top of a new page:*/
            counter-increment: page
        }

        /*page numbers*/
        div.page:after {
            content:  counter(page);
            position: absolute;
            bottom: 0px;
            right: 30px;
            z-index: 999;
            padding: 2px 12px;
            border-right: 2px solid #23b8e7;
            border-left: 2px solid #23b8e7;
            background-color: lightgray;
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


    </style>
</head>

<body style="font-family: primaryFont;font-size: medium">

<div id="main_divm" class="m-2 bg-white main-div-project">
    <?php
    $tmp_price = explode(',', $_GET['price'] ?? '');
    $tmp_tedad = explode(',', $_GET['tedad'] ?? '');
    $sumarray = 0;
    for ($i = 0; $i < count($tmp_price); $i++) {
        $sumarray += intval($tmp_price[$i]) * intval($tmp_tedad[$i]);
    }
    //$sumarray=number_format(array_sum($tmp_price));
    $numpro = new Number2Word();
    $sumarrayletter = $numpro->numberToWords($sumarray);
    $pagebreak = 32;
    ?>


    <img class="absolute mt-2 mr-2 w-[200px]" src="<?= $this->asset('images/rectlogo.png') ?>">
    <table class="border-none mt-20 rtl w-[90%] ">
        <tr>
            <td style="width:85%"></td>
            <td style="width:8%">شماره:</td>
            <td class="text-right" style="width:8%"><?= $letter[0]['pval'] ?></td>
        </tr>
        <tr>
            <td style="width:85%"></td>
            <td style="width:8%">تاریخ:</td>
            <td align="right" style="width:8%"><?= $letter[1]['pval'] ?></td>
        </tr>
        <tr>
            <td style="width:85%;padding-right: 330px;" class="font-bold">بسمه تعالی</td>
            <td style="width:8%">پیوست:</td>
            <td align="right" style="width:8%"><?= $letter[2]['pval'] ?></td>
        </tr>
    </table>
    <p class="font-bold text-lg mr-5 mt-5"><?= $letter[3]['pval'] ?></p>
    <p class="font-bold text-lg mr-5 mt-2"><?= $letter[4]['pval'] ?></p>
    <p class="font-bold text-lg mr-5 mt-2"><?= $letter[5]['pval'] ?></p>
    <p class=" text-base mr-5 mt-10">باسلام</p>
    <p class=" text-base mr-5 mt-2 ml-10"><?= $letter[12]['pval'] ?></p>
    <table class="mt-5 mr-10 border-2 border-black w-[85%] ">
        <tr style="height:40px" class="text-center font-bold text-sm min-h-[40px]">
            <td style="width:10%" class="border-2">ردیف</td>
            <td style="width:40%" class="border-2">شرح</td>
            <td style="width:6%" class="border-2">تعداد</td>
            <td style="width:10%" class="border-2">واحد</td>
            <td style="width:17%" class="border-2">بهای واحد (ریال)</td>
            <td style="width:17%" class="border-2">بهای کل (ریال)</td>
        </tr>
        <?php
        for ($i = 13;
        $i < count($letter);
        $i++){

        ?>
        <tr class="text-right text-center text-sm min-h-[40px]">
            <td style="width:10%" class="border-2 text-center"><?= $i - 12 ?></td>
            <td style="width:40%" class="border-2 text-right pr-2 ltr "><?= $letter[$i]['pval'] ?? 0 ?></td>
            <td style="width:6%" class="border-2 text-center"> <?= $tmp_tedad[$i - 13] ?? 0 ?></td>
            <td style="width:10%" class="border-2 text-center">دستگاه</td>
            <td style="width:17%"
                class="border-2 text-center"> <?= isset($tmp_price[$i - 13]) && $tmp_price[$i - 13] != '' ? number_format(round($tmp_price[$i - 13] ?? 1, 0)) : '' ?></td>
            <td style="width:17%"
                class="border-2 text-center"><?= number_format(isset($tmp_price[$i - 13]) && $tmp_price[$i - 13] != '' ? $tmp_price[$i - 13] * $tmp_tedad[$i - 13] : 0) ?></td>
        </tr>
        <?php
        if ($i > 23)
        {
        ?>
    </table>
<?php
break;
}
?>
<?php
}
echo '<tr style="height:50px" class="text-right text-center text-sm ">
       
    <td colspan="2" class="text-base font-bold border-2 text-center pr-2">جمع کل (ریال)</td>
    <td colspan="4" class="text-base font-bold border-2 text-center pr-2">
    <p>' . number_format($sumarray) . '</p><p>' . $sumarrayletter . '</p>
</td>
    
    </tr>';
echo "</table>";
if (count($letter) > 24) {
?>
    <p style="page-break-after: always;">&nbsp;</p>

    <table class="mt-5 mr-10 border-2 border-black w-[70%] ">
        <tr style="height:40px" class="text-center font-bold text-sm min-h-[40px]">
            <td style="width:10%" class="border-2">ردیف</td>
            <td style="width:40%" class="border-2">شرح</td>
            <td style="width:6%" class="border-2">تعداد</td>
            <td style="width:10%" class="border-2">واحد</td>
            <td style="width:17%" class="border-2">بهای واحد (ریال)</td>
            <td style="width:17%" class="border-2">بهای کل (ریال)</td>
        </tr>
        <?php
        for ($i = 24;
             $i < count($letter);
             $i++) {
            ?>
            <tr class="text-right text-center text-sm min-h-[40px]">
                <td style="width:10%" class="border-2 text-center"><?= $i - 12 ?></td>
                <td style="width:40%" class="border-2 text-right pr-2"><?= $letter[$i]['pval'] ?? 0 ?></td>
                <td style="width:6%" class="border-2 text-center"><?= $tmp_tedad[$i - 13] ?? 0 ?></td>
                <td style="width:10%" class="border-2 text-center">دستگاه</td>
                <td style="width:17%" class="border-2 text-center"> <?= isset($tmp_price[$i - 13]) && $tmp_price[$i - 13] != '' ? number_format(round($tmp_price[$i - 13] ?? 1, 0)) : '' ?></td>
                <td style="width:17%" class="border-2 text-center"><?= number_format(isset($tmp_price[$i - 13]) && $tmp_price[$i - 13] != '' ? $tmp_price[$i - 13] * $tmp_tedad[$i - 13] : 0) ?></td>
            </tr>
            <?php
        }
        echo '<tr style="height:50px" class="text-right text-center text-sm ">
       
    <td colspan="2" class="text-base font-bold border-2 text-center pr-2">جمع کل (ریال)</td>
    <td colspan="4" class="text-base font-bold border-2 text-center pr-2"><p>' . number_format($sumarray) . '</p><p>' . $sumarrayletter . '</p></td>
    
    </tr></table>';
        ?>
        <?php
        }
        ?>
        <!--توضیحات-->
        <?php
        if(count($tmp_price)==11)
        {
            echo "<div style='page-break-after:always;></div>";
        }
        ?>
        <p class="font-bold text-lg mr-14 mt-10">توضیحات:</p>
        <p class=" text-sm mr-14 mt-3 ml-20"><?= $letter[6]['pval'] ?></p>
        <p class=" text-sm mr-14  mt-1 ml-20"><?= $letter[7]['pval'] ?></p>
        <?php
        if(count($tmp_price)==10)
        {
            echo "<div style='page-break-after:always;></div>";
        }
        ?>
        <p class=" text-sm mr-14 mt-1 ml-20"><?= $letter[8]['pval'] ?></p>
        <p class=" text-sm mr-14 mt-1 ml-20"><?= $letter[9]['pval'] ?></p>
        <p class=" text-sm mr-14 mt-1 ml-20"><?= $letter[10]['pval'] ?></p>
        <?php
        if(count($tmp_price)<=9 && count($tmp_price)>=7)
        {
            echo "<div style='page-break-after:always;></div>";
        }
        ?>
        <p class=" text-base mr-14 mt-3 ml-20">پیشاپیش از حسن توجه به عمل آمده سپاسگزاری می گردد.</p>
        <div class="relative">
            <img style="left:220px;top:-40px;width:20%;position: absolute;background-color: transparent"  src="<?=$this->asset('images/stamp-1.png')?>">
            <img style="left:100px;top:-100px;width:20%;position: absolute;background-color: transparent"  src="<?=$this->asset('images/sign-1.png')?>">

        <p style="margin-left: 150px" class="ltr text-sm mt-3">با تشکر</p>
        <p style="margin-left: 138px" class="ltr text-sm mt-3"><?= $letter[11]['pval'] ?></p>
        <p style="margin-left: 140px" class="ltr text-sm mt-3">مدیر بازرگانی</p>
        </div>

        <?php
        $pagecnt = 1;
        $intipage = $pagebreak;
        foreach ($eplm as $key => $mat) {
            $cnt = 1;
            for ($i = 0; $i < count($mat); $i += $intipage) {
                ?>
                <div class="page">

                    <table style="font-family: 'Iranian Sans'" class="ltr w-[90%] text-xs mt-10 mr-10">
                        <thead>
                        <tr style="height:50px">
                            <td colspan="7" class="border-2"></td>

                            <td colspan="8" class="border-2"><img style="margin:auto" class="mt-2 mr-2 w-[150px]"
                                                                  src="<?= $this->asset('images/rectlogo.png') ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="border-2 text-xs">MANUFACTURER : MIC</td>
                            <td rowspan="5" colspan="9"
                                class="font-bold text-lg text-center border-2"><?= $epl[1][$key]['voltage'] . ' ' . $epl[1][$key]['name'] . ' ' . $epl[1][$key]['crnt'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="border-2 text-xs ">PROJECT-NO : <?= $epl[0]['code'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="border-2 text-xs">S/S Name: <?= $otherdata[1]['pval'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="border-2 text-xs">CLIENT : <?= $epl[0]['ename'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="border-2 text-xs">CONSULTANT : <?= $otherdata[0]['pval'] ?></td>
                        </tr>
                        <tr>
                            <th colspan="2" style="width:5%" class="border-2">ITEM</th>
                            <th colspan="4" style="width:30%" class="border-2">DESCRIPTION</th>
                            <th colspan="6" style="width:45%" class="border-2">TECHNICAL SPECIFICATION</th>
                            <th colspan="2" style="width:15%" class="border-2">MANUFACTURER</th>
                            <th style="width:5%" class="border-2">QTY</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        for ($j = $i; $j < min(count($mat), $i + $intipage); $j++) {
                            ?>
                            <!--        شروع صفحه-->

                            <tr>
                                <td colspan="2" style="width:5%" class="border-2 text-center"><?= $cnt ?></td>
                                <td colspan="4" style="width:30%" class="border-2 ml-2"><?= $mat[$j]['equip'] ?></td>
                                <td colspan="6" style="width:45%"
                                    class="border-2 text-center text-wrap"><?= $mat[$j]['type'] ?></td>
                                <td colspan="2" style="width:15%"
                                    class="border-2 text-center"><?= $mat[$j]['manufact'] ?></td>
                                <td style="width:5%" class="border-2 text-center"><?= $mat[$j]['qty'] ?></td>
                            </tr>


                            <!--        پایان صفحه-->

                            <?php
                            $cnt++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <?php
            }
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