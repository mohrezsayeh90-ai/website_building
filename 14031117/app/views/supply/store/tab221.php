<!doctype html>
<html lang="fa" dir="rtl">
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
</head>

<body>
<div class="container">

    <?php
    $buyvisible=false;
    if(!$allData[0]['bought_iscomplete'])
    foreach ($allData as $BPM_INFO) {
        if($BPM_INFO['qty_buy']<$BPM_INFO['qty_demand']-$BPM_INFO['qty_draft'])
        {
            $buyvisible=true;
            break;
        }
    }
    ?>

    <!-- Main modal -->
    <div class="no-print rtl text-xs mt-5">

        <button onclick="sbatDemanNo('<?= $allData[0]['order_no_time'] ?>')"
                class="bg-blue-500 <?= !isset($allData[0]['demand_no']) ? '' : 'hidden' ?>
    hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            ثبت شماره درخواست
        </button>
        <?php
        $drafall=0;
        for($i=0;$i<count($allData);$i++)
        {
            if(isset($allData[$i]['qty_draft']) && $allData[$i]['qty_draft']!=null && $allData[$i]['qty_draft']>0)
            {
                $drafall=1;
                break;
            }
        }


        ?>
        <button onclick="draftALL('<?= $allData[0]['proj_code'] ?>','<?= $allData[0]['demand_no'] ?>')" class="bg-red-400 hover:bg-red-700
<?= isset($allData[0]['demand_no']) && $drafall==0 ? '' : 'hidden' ?> text-white font-bold py-2 px-4 rounded">
            صدور حواله بصورت یکجا
        </button>
        <button onclick="buyALL('<?= $allData[0]['proj_code'] ?>','<?= $allData[0]['demand_no'] ?>')"
                class="<?=!$buyvisible?'hidden':''?> bg-slate-400 hover:bg-slate-700 <?= isset($allData[0]['demand_no']) ? '' : 'hidden' ?> text-white font-bold py-2 px-4 rounded">
            درخواست یکجای خرید
        </button>
        <button title="تایید و بستن" onclick="window.close()" class="mr-10 text-green-600 text-2xl <?= isset($allData[0]['demand_no']) ? '' : 'hidden' ?>"><i class="fa fa-check"></i></button>
        <button onclick="closeDemand('<?= $allData[0]['proj_code'] ?>','<?= $allData[0]['demand_no'] ?>')" class="bg-red-800 ml-10 float-end hover:bg-gray-700 <?= isset($allData[0]['demand_no']) ? '' : 'hidden' ?> text-white font-bold py-2 px-4 rounded">
            بستن این درخواست
        </button>
    </div>
    <div class="relative overflow-x-auto max-w-[1500px] bg-zinc-300 border-black border-2 shadow-md sm:rounded-lg">
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
                <td colspan="2">شماره
                    سفارش: <?= $allData[0]['proj_code'] . (isset($allData[0]['demand_no']) ? ' - ' . $allData[0]['demand_no'] : '') ?></td>
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
                    تعداد حواله شده
                </th>
                <th scope="col" class="px-6 py-3">
                    تعداد درخواست خرید
                </th>
                <th scope="col" class="px-6 py-3">
                    ملاحظات
                </th>
                <th scope="col" class="px-6 py-3">
                    عملیات
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
                        <?= $BPM_INFO['qty_buy'] ?>
                    </td>
                    <td class="px-6 py-1">
                        <?= $BPM_INFO['description'] ?>
                    </td>
                    <td class="px-6 py-1">
                        <div class="flex w-full <?= $BPM_INFO['qty_draft']>=$BPM_INFO['qty_demand'] ?'hidden':'' ?> <?= isset($allData[0]['demand_no'])?'':'hidden' ?> justify-evenly">
                            <button onclick="draftSome('<?= $BPM_INFO['prjCod'] ?>','<?= $allData[0]['demand_no'] ?>',
                            <?= $BPM_INFO['qty_demand'] ?>, <?= $BPM_INFO['qty_draft'] ?>,<?= $BPM_INFO['idd'] ?>)"
                                    title="حواله کردن" class="hover:animate-pulse text-red-600 mx-1 text-xl"><i class="fa fa-arrow-circle-right"></i>
                            </button>
                            <button <?= $BPM_INFO['qty_buy']>=$BPM_INFO['qty_demand']-$BPM_INFO['qty_draft'] ?'hidden':'' ?>
                                    onclick="buySome('<?= $BPM_INFO['prjCod'] ?>','<?= $allData[0]['demand_no'] ?>',
                                    <?= $BPM_INFO['qty_demand'] ?>, <?= $BPM_INFO['qty_draft'] ?>,<?= $BPM_INFO['qty_buy'] ?>,<?= $BPM_INFO['idd'] ?>)"
                                    title="اضافه کردن به درخواست خرید" class="hover:animate-pulse text-yellow-500 mx-1 text-xl"><i
                                        class="fa fa-shopping-cart"></i></button>

                        </div>
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
                    ?>
                </td>
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
    let defaulthvl='<?=$_GET['defaulthvl']??''?>'
    let defaultbuy='<?=$_GET['defaultbuy']??''?>'
async function draftSome(p,d,o,drf,id)
{
    let draftno=''
    await $.ajax({
        url:url('store/getproperdraftno'),
        type:"POST",
        data:{

        },dataType:"html"
    }).then(result=>{
            if(result)
            {
                draftno=JSON.parse(result)
            }
        }
    )
    Swal.fire({


        showCancelButton: true,
        cancelButtonText: "انصراف",
        confirmButtonText: "تایید",
        showLoaderOnConfirm: true,
        width:550,
            html:
                `<div
<h3>شماره حواله و تعداد آن را مشخص نمایید</h3><br/><br/>
<label class="float-start" for="swal-input1">شماره حواله</label>
<input value="${draftno}" style="width:80%" id="swal-input1" class="swal2-input"><br/>
<label style="margin-top:30px !important;margin-bottom: 10px !important;" for="swal-input">مقدار</label></div>
                '<input style="width:80%;margin-top: 10px !important;margin-bottom: 20px" id="swal-input2" placeholder="${o-drf}" class="swal2-input">
`,
            focusConfirm: false,
            preConfirm: () => {
                return [
                    document.getElementById('swal-input1').value,
                    document.getElementById('swal-input2').value
                ]
            }
        }
        ).then(async (result) => {
            //alert(result.value)
            if (result.isConfirmed && result.value[0] && result.value[1]) {
                if(parseFloat(result.value[1])<=0 || parseFloat(result.value[1])>o-drf)result.value[1]=o-drf
                defaulthvl=result.value[0]
                await $.ajax({
                    url: url('store/registerDraft'),
                    method: "POST",
                    data: {
                        prjCod:p,
                        demandNo: d,
                        id:id,
                        No:result.value[1],
                        draftNo:result.value[0]
                    }, dataType: "html"
                }).then(async (res) => {
                  if(res!="bad")  {
                      await ToastPro('حواله با موفقیت ثبت شد!', 'top', "info")

                  }
                  else return
                    if(!window.location.href.includes('&defaulthvl=H'))
                    {
                       window.location=window.location.href+`&defaulthvl=${defaulthvl}`
                    }
                    else
                        location.reload()

                })

            }

        }
    );
}
 async   function buySome(p,d,o,drf,buy,id)
    {
        let buyno=''
        await $.ajax({
            url:url('store/getproperbuyno'),
            type:"POST",
            data:{

            },dataType:"html"
        }).then(result=>{
                if(result)
                {
                    buyno=JSON.parse(result)
                }
            }
        )
        Swal.fire({


                showCancelButton: true,
                cancelButtonText: "انصراف",
                confirmButtonText: "تایید",
                showLoaderOnConfirm: true,
                width:550,
                html:
                    `<div
<h3>شماره درخواست خرید و تعداد آن را مشخص نمایید</h3><br/><br/>
<label class="float-start" for="swal-input1">شماره درخواست خرید</label>
<input value="${buyno}" style="width:80%" id="swal-input1" class="swal2-input"><br/>
<label style="margin-top:30px !important;margin-bottom: 10px !important;" for="swal-input">مقدار</label></div>
                '<input style="width:80%;margin-top: 10px !important;margin-bottom: 20px" id="swal-input2" placeholder="${o-drf-buy}" class="swal2-input">
`,
                focusConfirm: false,
                preConfirm: () => {
                    return [
                        document.getElementById('swal-input1').value,
                        document.getElementById('swal-input2').value
                    ]
                }
            }
        ).then(async (result) => {
                //alert(result.value)
                if (result.isConfirmed && result.value[0] && result.value[1]) {
                    if(parseFloat(result.value[1])<=0 || parseFloat(result.value[1])>o-drf-buy)result.value[1]=o-drf-buy
                    defaultbuy=result.value[0]
                    await $.ajax({
                        url: url('store/registerBuy'),
                        method: "POST",
                        data: {
                            prjCod:p,
                            demandNo: d,
                            id:id,
                            No:result.value[1],
                            buyNo:result.value[0]
                        }, dataType: "html"
                    }).then(async (res) => {
                        if(res!="bad")  {
                            await ToastPro('آیتم مورد نظر با موفقیت به درخواست خرید اضافه شد!', 'top', "info")

                        }
                        else return
                        if(!window.location.href.includes('&defaultbuy=B'))
                        {
                            window.location=window.location.href+`&defaultbuy=${defaultbuy}`
                        }
                        else
                            location.reload()

                    })

                }

            }
        );
    }
    async function sbatDemanNo(demandTime) {
        let demno=''
        await $.ajax({
            url:url('store/getproperdemandno'),
            type:"POST",
            data:{
                demandtime:demandTime
            },dataType:"html"
        }).then(result=>{
            if(result)
            {
                demno=JSON.parse(result)
            }
            }
        )
        Swal.fire({
            text: `شماره این درخواست را وارد نمایید`,
            input: "text",
            inputValue: demno,
            inputAttributes: {
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
         <span class="text-sm">شماره درخواست را وارد نمایید</span>
      `);
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then(async (result) => {
                //alert(result.value)
                if (result.isConfirmed && result.value) {
                    await $.ajax({
                        url: url('store/sabtDemanNo'),
                        method: "POST",
                        data: {
                            demandTime: demandTime,
                            demandNo: result.value
                        }, dataType: "html"
                    }).then(async () => {
                        await ToastPro('شماره درخواست با موفقیت ثبت شد!', 'top', "info", 1)
                    })

                }

            }
        );
    }

    async function draftALL(s, s2) {
        let draftno=''
        await $.ajax({
            url:url('store/getproperdraftno'),
            type:"POST",
            data:{
                projCode:s
            },dataType:"html"
        }).then(result=>{
                if(result)
                {
                    draftno=JSON.parse(result)
                }
            }
        )
        Swal.fire({
            icon: 'question',
            question: '؟',
            text: `آیا واقعا می خواهید برای درخواست کالا به شماره ${s2} حواله صادر نمایید؟`,
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: 'بله',
            cancelButtonText: 'خیر'}).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    text: `شماره حواله مورد نظر را وارد نمایید`,
                    input: "text",
                    inputValue:draftno,
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
         <span class="text-sm">شماره حواله را وارد نمایید</span>
      `);
                        }
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then(async (result) => {
                    //alert(result.value)
                    if (result.isConfirmed && result.value) {
                        await $.ajax({
                            url: url('store/draftAll'),
                            method: "POST",
                            data: {
                                prjCode: s,
                                demandNo: s2,
                                draftNo: result.value
                            }, dataType: "html"
                        }).then(async () => {
                            await ToastPro('همه اقلام باقیمانده این درخواست با موفقیت حواله شد!', 'top', "info",1)
                            parent.parent.document.getElementById('tolid2').click()
                        })

                    }

                });





            }
        })



    }

    async function buyALL(s, s2) {
        let buyno=''
        await $.ajax({
            url:url('store/getproperbuyno'),
            type:"POST",
            data:{
                projCode:s
            },dataType:"html"
        }).then(result=>{
                if(result)
                {
                    buyno=JSON.parse(result)
                }
            }
        )
        Swal.fire({
            icon: 'question',
            question: '؟',
            text: `آیا واقعا می خواهید برای درخواست کالا به شماره ${s2} درخواست خرید کلی صادر نمایید؟`,
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: 'بله',
            cancelButtonText: 'خیر'}).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    text: `شماره درخواست خرید مورد نظر را وارد نمایید`,
                    input: "text",
                    inputValue:buyno,
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
         <span class="text-sm">شماره درخواست خرید را وارد نمایید</span>
      `);
                        }
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then(async (result) => {
                    //alert(result.value)
                    if (result.isConfirmed && result.value) {
                        await $.ajax({
                            url: url('store/buyAll'),
                            method: "POST",
                            data: {
                                prjCode: s,
                                demandNo: s2,
                                buyNo: result.value
                            }, dataType: "html"
                        }).then(async () => {
                            await ToastPro('برای این درخواست جنس، درخواست خرید مکانیزه صادر شد!', 'top', "info")
                            //parent.parent.document.getElementById('tolid2').click()
                           location.reload()
                        })

                    }

                });





            }
        })



    }

    async function closeDemand(p, d) {
        Swal.fire({
            icon: 'question',
            question: '؟',
            text: `آیا واقعا قصد بستن این درخواست را به همین شکل دارید؟`,
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: 'بله',
            cancelButtonText: 'خیر'}).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    text: `دلایل بستن درخواست قبل از انجام فرآیندها را وارد نمایید`,
                    input: "text",
                    inputAttributes: {
                        autocapitalize: "off",
                        placeholder:"دلیل",
                        dir:"rtl"

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
         <span class="text-sm">توضیحی وارد شود</span>
      `);
                        }
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then(async (result) => {
                    //alert(result.value)
                    if (result.isConfirmed && result.value) {
                        await $.ajax({
                            url: url('store/closeDemand'),
                            method: "POST",
                            data: {
                                p: p,
                                d: d,
                                desc: result.value
                            }, dataType: "html"
                        }).then(async () => {
                            await ToastPro('درخواست جنس با موفقیت بسته شد!', 'top', "info")
                            parent.parent.document.getElementById('tolid2').click()
                           // location.reload()
                        })

                    }

                });





            }
        })



    }
</script>

</html>
<!--<script type="text/javascript" src="--><?php //$this->asset('js/project.js'); ?><!--"></script>-->