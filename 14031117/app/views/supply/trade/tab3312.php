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
<div class="container">


    <!-- Main modal -->


<div class="w-1/2 float-start">
    <table  class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400"  id="incomorderTable">
                <thead class="text-sm text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ردیف
                    </th>
                    <th scope="col" class="px-6 py-3">
                        شماره پکینگ
                    </th>
                    <th align="center" scope="col" class="px-6 py-3">
                       تاریخ پکینگ
                    </th>

                    <th scope="col" class="px-6 py-3">
                        عملیات
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($incbuyOrder as $key=>$BPM_INFO){
                    ?>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white ml-20">
                            <?=$key+1?>
                        </th>
                        <td class="px-6 py-3 underline">
                            <button class="animate-bounce ml-20 underline">
                            <a class="cursor-pointer" target="_blank" href="<?= $this->url("trade/packing/?p=" . $BPM_INFO['buy_packing_no'] .
                                "&d=" . $BPM_INFO['buy_packing_date']) ?>"><?=$BPM_INFO['buy_packing_no']?>
                                </a></button>

                        </td>
                        <td class="px-6 py-3 ltr">
                            <?=$BPM_INFO['buy_packing_date']?>
                        </td>

                        <td>

                        <button class="animate-bounce text-red-600 text-2xl mr-20" onclick="packBuyComplete(<?=$BPM_INFO['buy_packing_no']?>,'<?=$BPM_INFO['buy_packing_date']?>')">

                                <i class="fa fa-close "></i></a></button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>

</div>




</div>


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
<script src="<?=Base_Url?>/node_modules/preline/dist/preline.js"></script>
<script type="text/javascript" src="<?php $this->asset('lib/js/jalalidatepicker.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('js/helpers.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('js/main.js') ?>"></script>
<script type="text/javascript" src="<?= $this->asset('lib/jsc/jscharting.js') ?>"></script>
<script>
    $(document).ready(()=>{
        new DataTable("#incomorderTable", {

            paging: false,
            order: [[1, 'desc']],
        });
    })

    async function packBuyComplete(p, d) {
        Swal.fire({
            icon: 'question',
            iconHtml: '؟',
            text: `عملیات خرید پکینگ ${p} به تاریخ ${d} به پایان رسیده است؟`,
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: 'بله',
            cancelButtonText: 'خیر'
        }).then(async (result) => {
            if (result.isConfirmed) {
                await $.ajax({
                    url: url('trade/packingcompleted'),
                    type: "POST",
                    data: {
                        p: p,
                        d: d

                    }, dataType: "html"
                }).then(async m=>{
                    await ToastPro('عملیات با موفقیت انجام شد!', 'top', "info",1)
                })
            }
        } )
        }

</script>

</html>
