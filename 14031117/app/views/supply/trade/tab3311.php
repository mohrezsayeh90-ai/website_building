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
<div class="container ">


    <!-- درخواست دارای مجوز خرید -->
<div class="flex flex-row mt-1 text-sm mb-1">
    <button onclick="selectAll()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">انتخاب همه</button>
    <button onclick="disselectAll()" class="bg-blue-400 hover:bg-red-700 text-white font-bold py-2 mr-2 px-4 rounded">پاک کردن همه</button>
    <button onclick="packSelected()" class="bg-gray-400 hover:bg-gray-700  text-white font-bold py-2 mr-2 px-4 rounded">پک (دسته) کردن انتخاب شده ها</button>
</div>


    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"  id="incomorderTable">
                <thead class="text-sm text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ردیف
                    </th>
                    <th scope="col" class="px-6 py-3">
                        کد پروژه
                    </th>
                    <th align="center" scope="col" class="px-6 py-3">
                       شرح پروژه
                    </th>

                    <th scope="col" class="px-6 py-3">
                        شماره BOM
                    </th>

                    <th scope="col" class="px-6 py-3">
                        شماره درخواست خرید
                    </th>
                    <th scope="col" class="px-6 py-3">
                        تاریخ درخواست خرید
                    </th>

                    <th scope="col" class="px-6 py-3">
                        انتخاب
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($incbuyOrder as $key=>$BPM_INFO){
                    ?>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th style="text-align: center !important" scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?=$key+1?>
                        </th>
                        <td style="text-align: center !important" class="px-6 py-3">
                            <?=$BPM_INFO['proj_code']?>
                        </td>
                        <td style="text-align: center !important" class="px-6 py-3">
                            <?=$BPM_INFO['proj_name']?>
                        </td>
                        <td style="text-align: center !important" class="px-6 py-3">
                            <?=$BPM_INFO['document_no']?>
                        </td>


                        <td style="text-align: center !important" class="px-6 py-3  underline">
<!--                            <a class="cursor-pointer" target="_blank" href="--><?php //= $this->url("trade/trade/?p=" . $BPM_INFO['proj_code'] . "&b=" . $BPM_INFO['buy_no'].'&closed=2') ?><!--">-->
                                <?=$BPM_INFO['buy_no']?></a>
                        </td>
                        <td style="text-align: center !important" class="px-6 py-3">
                            <?=$BPM_INFO['date']?>
                        </td>

                        <td style="text-align: center !important">
                        <input type="checkbox" aria-label="<?=$BPM_INFO['proj_code']?>_<?=$BPM_INFO['buy_no']?>" id="chk_<?=$key?>">
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
            order: [[9, 'desc']],
        });
    })
    function selectAll()
    {
        $('input[type="checkbox"]').each(function (l,k){
            //alert(k.id)
            k.checked=true
        })
    }
    function disselectAll()
    {
        $('input[type="checkbox"]').each(function (l,k){
            k.checked=false
        })
    }
   async function packSelected()
    {
        let packingno=''
        await $.ajax({
            url:url('trade/getproperpacking'),
            type:"POST",
            data:{

            },dataType:"html"
        }).then(result=>{
                if(result)
                {
                    packingno=JSON.parse(result)
                }
            }
        )
        let cnt=0
        let idarr=[]
        $('input[type="checkbox"]').each(function (l,k){
            if(k.checked)
            {
                cnt++
                idarr.push({"id":k.id.replace("chk_",""),"info":k.ariaLabel})
            }
        })
        if(cnt==0)
        {
            await ToastPro('موردی انتخاب نشده است!', 'top', "info")
            return
        }
        Swal.fire({
            icon: 'question',
            iconHtml: '؟',
            text: `آیا قصد ایجاد پکینگ برای موارد انتخاب شده دارید؟`,
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: 'بله',
            cancelButtonText: 'خیر'}).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    text: `شماره درخواست پکینگ مورد نظر را وارد نمایید`,
                    input: "text",
                    inputValue:packingno,
                    inputAttributes: {
                        autocapitalize: "off",
                        dir:"ltr"
                    },
                    showCancelButton: true,
                    cancelButtonText: "انصراف",
                    confirmButtonText: "تایید",
                    showLoaderOnConfirm: true,
                    preConfirm: async (number) => {
                        if (number) {

                            return number;
                        } else {
                            Swal.showValidationMessage(`
         <span class="text-sm">شماره پکینگ خرید را وارد نمایید</span>
      `);
                        }
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then(async (result) => {
                    //alert(result.value)
                    if (result.isConfirmed && result.value) {
                        await $.ajax({
                            url: url('trade/setpackno'),
                            method: "POST",
                            data: {
                                packno: packingno,
                               mdata:idarr
                            }, dataType: "html"
                        }).then(async () => {
                            await ToastPro('برای درخواستهای انتخابی، درخواست پکینگ مکانیزه صادر شد!', 'top', "info",1)
                            //parent.parent.document.getElementById('tolid2').click()

                        })

                    }

                });





            }
        })
        // $('input[type="checkbox"]').each(function (l,k){
        //     k.checked=false
        // })
    }
</script>

</html>
