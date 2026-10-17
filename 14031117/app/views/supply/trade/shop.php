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

<body class="ml-10 mr-10 mt-10">
<div class="h-100 my-4 no-print hidden">
    <input type="hidden" id="tender_code" value="">
    <div class="flex flex-row  text-3xl ml-5 border-b-2">
        <i data-tooltip-target="tender_finalize_t" id="saveAllSheets" class=" cursor-pointer fa fa-save
         h-auto relative z-0 rounded-lg transition-all duration-300 hover:scale-150"></i>
        <i data-tooltip-target="tender_finalize_t1" id="reloadAllSheets" class="fa fa-refresh cursor-pointer ms-4 h-auto relative z-0 rounded-lg
        transition-all duration-300 hover:scale-150"></i>
        <i data-tooltip-target="tender_finalize_t2" id="createmyExcelfile" class="fa fa-download cursor-pointer ms-4 h-auto relative z-0 rounded-lg
        transition-all duration-300 hover:scale-150"></i>
        <i id="ender_return" data-tooltip-target="tender_return" class="cursor-pointer float-end fa fa-share-square-o
 h-auto relative z-0 rounded-lg transition-all duration-300 hover:scale-150 mr-10"></i>
    </div>
    <div id="tender_finalize_t" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        ثبت تغییرات
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <div id="tender_finalize_t1" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        بازنشانی مجدد از دیتابیس
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <div id="tender_finalize_t2" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        دانلود فایل
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <div id="tender_return" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        بازگشت
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</div>
<div style="margin-left:0px !important" class="ltr m-4 grid grid-cols-10">

    <div class="col-span-7">
        <table style="max-width: 100%"
               class="border border-slate-400 border-collapse ltr table-fixed bg-white mt-4 w-full text-this-gray">
            <tr class="text-sm">
                <th scope="col" class="border-slate-400 border p-1">
                    کد فرم
                </th>
                <th scope="col" class="border-slate-400 border p-1">کد انبار
                </th>
                <th scope="col" class="border-slate-400 border p-1">
                    نوع خرید
                </th>
                <th scope="col" class="border-slate-400 border p-1">
                    نوع درخواست
                </th>
                <th scope="col" class="border-slate-400 border p-1">
                    تاریخ انقضا درخواست
                </th>
                <th scope="col" class="border-slate-400 border p-1">
                    شماره سفارش/کار/قرارداد
                </th>
                <th scope="col" class="border-slate-400 border p-1">
                    تاریخ
                </th>
                <th scope="col" class="border-slate-400 border p-1">
                    شماره درخواست
                </th>
            </tr>
            <tr>
                <td class="border-slate-400 border px-1 text-center">
                    1201
                </td>
                <td class="border-slate-400 border px-1">

                </td>
                <td class="border-slate-400 border px-1">

                </td>
                <td class="border-slate-400 border px-1 text-center">

                </td>
                <td class="border-slate-400 border px-1">

                <td align="center" class="border-slate-400 border px-1 text_center">
                    <?= $Order[0]['proj_code'] ?>
                </td>
                <td class="border-slate-400 border px-1 text-center text-sm">
                    <?= $Order[0]['date10'] ?>
                </td>
                <td class="border-slate-400 border px-1 text-center font-bold text-red-600">
                    <?= $Order[0]['buy_no'] ?>
                </td>
            </tr>
            <tr dir="rtl">
                <td class="border-slate-400 border p-1 " colspan="2">
                    <label for="supplyDAte" class="text-this-gray text-xs">
                        شماره و تاریخ دریافت تدارکات :
                    </label>
                    <div class="flex-row flex items-center w-full">
                        <input id="supplyNum" name="supplyNum" value="<?= $Order[0]['buy_packing_no'] ?? '' ?>" class=" w-1/3 border text-center underline border-l border-gray-500 text-this-gray inline-block border-0
                                                       focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400 focus:outline-0"/>
                        <input id="supplyDAte" value="<?= $Order[0]['buy_packing_date'] ?? '' ?>"
                               name="supplyDAte" class="text-center w-2/3 text-this-gray inline-block border-0 ltr underline
                                                       focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400 focus:outline-0"/>
                    </div>

                </td>
                <td class="border-slate-400 border text-center" colspan="2">
                    <input id="request-0" checked="" name="requestType" type="radio" value="1" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                    <label for="request-0" class="w-full me-2 text-sm text-this-gray rounded dark:text-gray-300">
                        درخواست اصلی</label>
                    <input id="request-1" name="requestType" type="radio" value="0" class="ms-3 w-4 h-4 text-teal-500 bg-gray-100
                        border-gray-300 rounded focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700
                         focus:ring-1 dark:bg-gray-600 dark:border-gray-500">
                    <label for="request-1" class="w-full text-sm text-this-gray rounded dark:text-gray-300">
                        تغییرات درخواست اصلی</label>
                </td>
                <td class="border-slate-400 border px-1" colspan="2">
                    <div class="items-start">

                        درخواست کننده : <?= $Order[0]['expense_code1'] ?>

                    </div>
                </td>
                <td colspan="2" class="text-center border border-slate-400">
                    <input id="checkbox-item-0" name="checkbox-item-1" type="radio" value="1" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                    <label for="checkbox-item-0"
                           class="w-full me-2 text-sm text-this-gray rounded dark:text-gray-300">
                        اقلام غیر انبار</label>
                    <input id="checkbox-item-1" checked="" name="checkbox-item-1" type="radio" value="0" class="ms-3 w-4 h-4 text-teal-500 bg-gray-100
                        border-gray-300 rounded focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700
                         focus:ring-1 dark:bg-gray-600 dark:border-gray-500">
                    <label for="checkbox-item-1"
                           class="w-full text-sm text-this-gray rounded dark:text-gray-300">
                        اقلام انبار</label>

                </td>
            </tr>
        </table>
    </div>
    <?php
    if (isset($Order[0]['buy_req_status']) && $Order[0]['buy_req_status'] == 1) {
        ?>
        <div class="col-start-9 col-span-2 w-full ml-5 no-print">
            <table class="w-full float-end mt-4 table-fixed border border-collapse border-slate-400 rtl border border-2">
                <tr>
                    <td colspan="2" class="bg-slate-400 text-center">تعیین سطوح معاملات</td>
                </tr>
                <tr>
                    <td class="border">معاملات جزء</td>
                    <td><textarea id="p_0_1"
                                  class="h-full max-h-[30px] w-full resize-none border-b border-blue-gray-200
                                        p-1 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= number_format($levels[0]['maxval']) ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="border">معاملات متوسط</td>
                    <td><textarea id="p_0_2"
                                  class="h-full max-h-[30px] w-full resize-none border-b border-blue-gray-200
                                       p-1 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= number_format($levels[1]['maxval']) ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center bg-green-200 text-normal"><span id="p_0_3"></span></td>
                </tr>
                <!--    <tr>-->
                <!--        <td class="border">معاملات کلان</td>-->
                <!--        <td><textarea id="p_0_3"-->
                <!--                      class="h-full max-h-[25px] w-full resize-none border-b border-blue-gray-200-->
                <!--                                       p-1-->
                <!--                                      font-sans text-xs font-normal outline-0 placeholder-shown:border-blue-gray-200-->
                <!--                                       focus:border-0 focus:ring-teal-400 focus:ring-2-->
                <!--                                       focus:outline-0 disabled:resize-none-->
                <!--                                       disabled:border-0-->
                <!--                                       disabled:bg-blue-gray-50">-->
                <?php //=number_format($levels[2]['maxval'])
                ?><!--</textarea></td>-->
                <!--    </tr>-->
            </table>
        </div>
        <?php
    }
    ?>
</div>


<div>
    <div id="default-styled-tab-content">
        <table id="detail_table"
               class="w-full table-fixed border border-collapse border-slate-400 text-end">
            <thead>
            <tr class="text-center">
                <th style="width:50px !important"
                    class="border border-slate-500 bg-gray-300 py-1 px-1 text-sm" scope="col"
                    rowspan="3">شماره سفارش خرید خارجی
                </th>
                <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col"
                    rowspan="2">ردیف
                </th>
                <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" rowspan="3">نوع تغییرات
                </th>
                <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col"
                    rowspan="1" colspan="7">مشخصات جنس
                </th>
                <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col"
                    rowspan="2">مقدار درخواستی
                </th>
                <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col"
                    rowspan="2">تاریخ نیاز جنس
                </th>
                <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col"
                    rowspan="3">موجودی انبار
                </th>
                <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col"
                    rowspan="3">مورد/محل مصرف
                </th>
                <?php
                if (isset($Order[0]['buy_req_status']) && $Order[0]['buy_req_status'] == 1) {
                    ?>
                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col"
                        rowspan="1" colspan="3">استعلام قیمت
                    </th>
                    <th style="width:20px !important" class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col"
                        rowspan="3">
                    </th>
                    <?php
                } else {
                    ?>
                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col"
                        rowspan="3" colspan="1">متوسط قیمت خرید
                    </th>
                    <?php
                }
                ?>
            </tr>
            <tr class="text-center">
                <td class="border border-slate-500 bg-gray-300 py-1 px-1" colspan="4" rowspan="2">شرح جنس</td>
                <td class="border border-slate-500 bg-gray-300 py-1 px-1" rowspan="2">واحد</td>
                <td class="border border-slate-500 bg-gray-300 py-1 px-1" colspan="1">کد جنس</td>
                <td class="border border-slate-500 bg-gray-300 py-1 px-1">کد واحد</td>
                <?php
                if (isset($Order[0]['buy_req_status']) && $Order[0]['buy_req_status'] == 1) {
                    ?>
                    <td class="border border-slate-500 bg-gray-300 py-1 px-1" rowspan="2">استعلام اول</td>
                    <td class="border border-slate-500 bg-gray-300 py-1 px-1" rowspan="2">استعلام دوم</td>
                    <td class="border border-slate-500 bg-gray-300 py-1 px-1" rowspan="2">استعلام سوم</td>
                    <?php
                }
                ?>
            </tr>
            <tr class="text-center">
                <td class="border border-slate-500 bg-gray-300 py-1 px-1">11</td>
                <td class="border border-slate-500 bg-gray-300 py-1 px-1" colspan="1">12</td>
                <td class="border border-slate-500 bg-gray-300 py-1 px-1">13</td>
                <td class="border border-slate-500 bg-gray-300 py-1 px-1">14</td>
                <td class="border border-slate-500 bg-gray-300 py-1 px-1">15</td>
            </tr>
            </thead>
            <tbody class="text-sm">
            <?php
            $summ = 0;
            foreach ($Order as $key => $ord) {

                ?>
                <tr class="text-center ml-2">
                <td id="item_" style="width:50px !important"
                    class="border border-slate-300 font-sans  hover:border-gray-400">
                    <button id="mydrpb_"
                            class="text-black  focus:ring-1 focus:outline-none focus:ring-blue-300 font-sans rounded-lg
         text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button"></button>
                    <input type="hidden" id="row_typem_"
                           value=""></td>
                <td
                        class="border border-slate-300 bg-white hover:border-gray-400 ">
                            <span id="cell_0_"
                                  class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $key + 1 ?></span>

                </td>
                <td
                        class="border border-slate-300 bg-white hover:border-gray-400 ">
                            <span id="cell_1_"
                                  class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></span>

                </td>
                <td colspan="4"
                    class="border border-slate-300 bg-white hover:border-gray-400 " align="left">
                            <span id="cell_2_"
                                  class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200 text-right
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $ord['equip'] . ';' . $ord['spec'] . ';' . $ord['manufact'] ?></span>
                </td>
                <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <span id="cell_3_"
                                  class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $ord['unit'] ?></span>

                </td>
                <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <span id="cell_3_"
                                  class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></span>

                </td>
                <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <span id="cell_3_"
                                  class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></span>

                </td>
                <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <span id="BNO_<?= $ord['demand_row_id'] ?>"
                                  class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= number_format($ord['qty_buy']) ?></span>

                </td>
                <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                    <input <?= isset($Order[0]['buy_req_status']) && $Order[0]['buy_req_status'] > 0 ? 'readonly' : 'data-jdp' ?>
                            onchange="changeDate(<?= $ord['demand_row_id'] ?>)" value="<?= $ord['buy_req_trkh'] ?>"
                            style="height:100% !important" id="cell_3_<?= $ord['demand_row_id'] ?>"
                            class="h-full min-h-[62px] w-full h-full  border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50">

                </td>
                <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <span id="cell_3_"
                                  class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></span>

                </td>
                <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <span readonly id="cell_3_"
                                  class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $ord['expense_code1'] . '-' . $Order[0]['proj_code'] ?></span>

                </td>
                <?php
                if (isset($Order[0]['buy_req_status']) && $Order[0]['buy_req_status'] == 1) {
                    ?>
                    <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <textarea id="p_1_<?= (int)$ord['demand_row_id'] ?>"
                                      class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= number_format($ord['price1'] ?? 0) ?></textarea>

                    </td>
                    <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <textarea id="p_2_<?= (int)$ord['demand_row_id'] ?>"
                                      class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= number_format($ord['price2'] ?? 0) ?></textarea>
                    <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <textarea id="p_3_<?= (int)$ord['demand_row_id'] ?>"
                                      class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= number_format($ord['price3'] ?? 0) ?></textarea>

                    </td>
                    <td style="width:20px !important" class="border border-1"><i onclick="openHistory('<?=str_replace(array("\r","\n"),'', $ord['equip']) ?>',
                                '<?=  str_replace(array("\r","\n"),'',$ord['spec']) ?>')"
                                                                                 class="fa fa-history "
                                                                                 title="Show price history"></i></td>
                    </tr>

                    <?php
                } else {
                    ?>
                    <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <textarea id="p_4_<?= (int)$ord['demand_row_id'] ?>"
                                      class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= number_format($ord['price_final'] ?? 0) ?></textarea>

                    </td>
                    </tr>
                    <?php
                }
                ?>


                <?php
                $summ += $ord['qty_buy'];
            }
            //   print_r($summ);
            ?>
            <?php
            if (isset($Order[0]['buy_req_status']) && $Order[0]['buy_req_status'] == 1) {
                ?>
                <tr>
                    <td colspan="14" class="border border-2 text-2xl font-bold"><span>جمع تقریبی:</span></td>
                    <td colspan="3" class="border border-2 text-2xl font-bold text-center"><span id="totalSum"></span>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="w-full flex flex-row border border-slate-300 p-1">
            <label class="d-inline-block me-2 mt-3" for="tips">ملاحظات:</label>
            <textarea <?= isset($Order[0]['buy_req_status']) && $Order[0]['buy_req_status'] > 0 ? 'readonly' : '' ?> id="tips"
                                                                                                                     aria-label="<?= $Order[0]['demand_row_id'] ?>"
                                                                                                                     class="h-full min-h-[50px] w-1/2 resize-none text-right p-1 text-this-gray inline-block border border-blue-gray-200 focus:border-0
                                                hover:border-0 focus:ring-2 hover:border-teal-500 focus:ring-teal-400 focus:outline-0"><?= $Order[0]['buy_req_descriptions'] ?></textarea>
            <label class="d-inline-block me-2 ms-2 mt-3" for="controlSum">جمع کنترلی:</label>
            <input value="<?= number_format($summ) ?>" id="controlSum" readonly name="theDate" class=" p-1 mr-0 text-lg text-right pr-5 inline-block border border-blue-gray-200
                                                hover:border-0 focus:ring-2 hover:border-teal-500 focus:ring-teal-400 focus:outline-0">

            <?php
            if (isset($Order[0]['buy_req_status']) && $Order[0]['buy_req_status'] == 1) {
                ?>
                <button onclick="signBuyReq('<?= $Order[0]['proj_code'] ?>','<?= $Order[0]['buy_no'] ?>')"
                        class="bg-blue-500 <?= isset($Order[0]['buy_req_status']) && $Order[0]['buy_req_status'] > 50 ? 'hidden' : '' ?>
    hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-20 ml-0">
                    تایید نهایی اطلاعات ثبتی
                </button>
                <?php
            }
            else if($Order[0]['buy_req_status'] <25 && $Order[0]['buy_req_status']>=4)
            {
                ?>
                <button onclick="issueBuyCommand('<?= $Order[0]['proj_code'] ?>','<?= $Order[0]['buy_no'] ?>')"
                        class="bg-blue-500 <?= isset($Order[0]['buy_req_status']) && $Order[0]['buy_req_status'] > 50 ? 'hidden' : '' ?>
                        hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-20 ml-0">
                    صدور دستور خرید
                </button>
                    <?php
            }
            else if($Order[0]['buy_req_status'] <100 && $Order[0]['buy_req_status']>=28) {
                ?>
                <button onclick="signBuyReqEnd('<?= $Order[0]['proj_code'] ?>','<?= $Order[0]['buy_no'] ?>')"
                        class="bg-blue-500 <?= isset($Order[0]['buy_req_status']) && $Order[0]['buy_req_status'] > 50 ? 'hidden' : '' ?>
    hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-20 ml-0">
                    اعلام پایان عملیات خرید این درخواست
                </button>
                <?php
            }
            ?>
        </div>
        <table class="mr-1 ml-10 mt-1 w-full min-h-[100px] border">
            <tr>
                <td colspan="1" class="border border-2 min-w-[250px]">
                     <textarea
                             rows="10" readonly class="h-full w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?php
                         foreach ($signs as $keys => $s) {
                             echo ($keys + 1) . "-" . $s['user_id'] . " این سند را در تاریخ " . $s['trkh'] . " امضا نمودند:" . ($s['accepted'] == 1 ? '✓' : '×') . "\n\n";
                         }
                         ?></textarea>

                </td>
                <td colspan="1" class="border border-2 min-w-[250px]"><textarea
                            rows="10" readonly class="h-full w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?php
                        foreach ($signs as $keys => $s) {
                            if ($s['descriptions']) echo "توضیحات" . " " . $s['user_id'] . ":" . $s['descriptions'] . "\n\n";
                        }
                        ?></textarea></td>
                <td colspan="1" class="border border-2 min-w-[250px]"></td>
                <td colspan="1" class="border border-2 min-w-[250px]"></td>
                <td colspan="1" class="border border-2 min-w-[250px]">
                    <form action="<?= Base_Url . '/trade/uploadAppendix' ?>" class="dropzone border-0 w-full"
                          id="my-dropzone">
                        <input type="hidden" name="proj_code" value="<?= $Order[0]['proj_code'] ?>">
                        <input type="hidden" name="buy_no" value="<?= $Order[0]['buy_no'] ?>">
                        <div class="dz-message no-print block bg-gray-50 hover:bg-gray-100 cursor-auto text-sm min-w-[250px] leading-10  border-2
                         border-dashed border-gray-500 ">
                            ارسال مستندات-فایلهای جدید به قبلیها اضافه می شوند
                        </div>
                    </form>
                </td>
            </tr>
        </table>


    </div>
</div>
<div class="container text-sm mt-5">
    <h3 class="text-center">فهرست اسناد مرتبط</h3>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
           id="productsTable">
        <thead class="text-white uppercase dark:bg-gray-700 dark:text-gray-400 bg-this-teal">
        <tr>

            <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3">شناسه سند</th>
            <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">نام سند</th>
            <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">تاریخ اضافه شدن</th>
            <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">پیش نمایش</th>
            <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">عملیات</th>
        </tr>
        </thead>
        <tbody class="text-this-gray text-center">
        <?php
        foreach ($docs as $keys => $doc) {
            ?>
            <tr className="bg-zinc-100 border-b dark:bg-gray-800 ltr dark:border-gray-700 hover:bg-zinc-400 dark:hover:bg-gray-600">
                <td style="text-align: center !important"><?= $doc['id'] ?></td>
                <td class="ltr"><?= $doc['filename'] ?></td>
                <td dir="ltr" style="text-align: center !important"><?= $doc['trkh'] ?></td>

                <?php

                if (str_ends_with(strtolower($doc['filelink']), '.jpg') || str_ends_with(strtolower($doc['filelink']), '.png') || str_ends_with(strtolower($doc['filelink']), '.bmp')
                    || str_ends_with(strtolower($doc['filelink']), '.tiff')) {
                    ?>
                    <td class="cursor-pointer"
                        onclick="window.open('<?= $this->asset('images/supply/' . $doc['filelink']) ?>','_blank')"
                        style="text-align: center !important">
                        <img style="width:60px;margin: auto"
                             src="<?= $this->asset('images/supply/' . $doc['filelink']) ?>"></td>
                    <?php
                } else if (str_ends_with(strtolower($doc['filelink']), '.pdf')) {
                    ?>
                    <td class="cursor-pointer"
                        onclick="window.open('<?= $this->asset('images/supply/' . $doc['filelink']) ?>','_blank')"
                        style="text-align: center !important">
                        <embed style="height:90px;width:130px;margin: auto"
                               src="<?= $this->asset('images/supply/' . $doc['filelink']) ?>"/>
                    </td>
                    <?php
                } else {
                    ?>
                    <td onclick="window.open('<?= $this->asset('images/supply/' . $doc['filelink']) ?>','_blank')"
                        style="text-align: center !important" class="text-3xl cursor-pointer">
                        <i class="fa fa-file-text fa-3x"></i></td>
                    <?php
                }
                ?>
                <td align="center">
                    -
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
        new DataTable("#productsTable", {
            order: [[0, 'desc']],


        });
        let totalTrade = 0;
        $('span[id^="BNO_"]').each(function (key, elem) {
            let id = parseInt(elem.id.split('_')[1])
            //alert(`#p_1_${id}`)

            let maxp = Math.max(parseFloat($(`#p_1_${id}`).val() == '' ? '0' : $(`#p_1_${id}`).val().replaceAll(',', '')),
                parseFloat($(`#p_2_${id}`).val() == '' ? '0' : $(`#p_2_${id}`).val().replaceAll(',', '')),
                parseFloat($(`#p_3_${id}`).val() == '' ? '0' : $(`#p_3_${id}`).val().replaceAll(',', '')))
            // alert(maxp)
            if (maxp) totalTrade += maxp * parseFloat(elem.innerText)
        })
        $('#totalSum').html(totalTrade.toLocaleString())
        if (totalTrade <= parseFloat($(`#p_0_1`).val().replaceAll(',', ''))) $(`#p_0_3`).html('معاملات خرد')
        else if (totalTrade <= parseFloat($(`#p_0_2`).val().replaceAll(',', ''))) $(`#p_0_3`).html('معاملات متوسط')
        else $(`#p_0_3`).html('معاملات کلان')
        jalaliDatepicker.startWatch()
    })
    $(document).on('keydown', (e) => {
        if (e.keyCode == 27) {
            jalaliDatepicker.hide()
        }

    })

    async function changeDate(id) {
        let value = event.target.value
        // alert(value)
        await $.ajax({
            url: url('store/reqDate'),
            method: "POST",
            data: {
                id: id,
                dvalue: value
            }
        }).then(() => {

        })
    }

    $('#tips').on('change', async (e) => {
        let id = e.target.ariaLabel
        let valm = e.target.value
        await $.ajax({
            url: url('store/reqDescriptions'),
            method: "POST",
            data: {
                id: id,
                dvalue: valm
            }
        }).then(() => {

        })
    })

    async function signBuyReq(p, b) {
        Swal.fire({
            icon: 'question',
            text: `آیا از امضای درخواست ${b} به صورت «${$(`#p_0_3`).html()}» مطمئن هستید؟ `,

            showCancelButton: true,
            cancelButtonText: "انصراف",
            confirmButtonText: "تایید",
            question: '؟'
        }).then(async (result) => {
            if (result.isConfirmed) {
                await $.ajax({
                    url: url('trade/signBuyReq'),
                    method: "POST",
                    data: {
                        p: p,
                        b: b,
                        type: $(`#p_0_3`).html()
                    }
                }).then(async () => {
                    await ToastPro('درخواست با موفقیت امضاء شد!', 'top', 'success', 1)

                })
            }
        })
    }

    $('textarea').on("keydown", function (e) {
        /* ENTER PRESSED*/
        // alert(e.which)
        if (e.keyCode == 13) {
            /* FOCUS ELEMENT */
            let inputs = $(this).parents().parent().eq(0).find("textarea");
            let idx = inputs.index(this);

            if (idx == inputs.length - 1) {
                inputs[0].select()
            } else {
                inputs[idx + 1].focus(); //  handles submit buttons
                inputs[idx + 1].select();
            }

            return false;
        }


    });

    $('textarea').on("blur", function (e) {
        /* ENTER PRESSED*/
        // alert(e.which)

        /* FOCUS ELEMENT */
        let inputs = $(this).parents().parent().eq(0).find("textarea");
        let idx = inputs.index(this);
        //console.log(inputs[idx].value)
        try {
            if (/^\d+$/.test(inputs[idx].value)) inputs[idx].value = parseInt(inputs[idx].value).toLocaleString()
        } catch (e) {

        }
    });
    $('textarea').on("focus", function (e) {
        /* ENTER PRESSED*/
        // alert(e.which)

        /* FOCUS ELEMENT */
        let inputs = $(this).parents().parent().eq(0).find("textarea");
        let idx = inputs.index(this);
        if (/^\d+$/.test(inputs[idx].value.replaceAll(',', '').replaceAll('،', ''))) inputs[idx].value = inputs[idx].value.replaceAll(',', '').replaceAll('،', '')
        inputs[idx].select();

    });

    $('textarea[id^="p_"]').on("change", async function (e) {
        let totalTrade = 0;
        let idd = e.target.id.split('_')
        if (idd[1] != "0") {
            await $.ajax({
                url: url('trade/setPrice'),
                method: "POST",
                data: {
                    id: idd[2],
                    p: idd[1],
                    value: e.target.value.replaceAll(',', '')
                }
            })
            $('span[id^="BNO_"]').each(function (key, elem) {
                let id = parseInt(elem.id.split('_')[1])
                //alert(`#p_1_${id}`)

                let maxp = Math.max(parseFloat($(`#p_1_${id}`).val() == '' ? '0' : $(`#p_1_${id}`).val().replaceAll(',', '')),
                    parseFloat($(`#p_2_${id}`).val() == '' ? '0' : $(`#p_2_${id}`).val().replaceAll(',', '')),
                    parseFloat($(`#p_3_${id}`).val() == '' ? '0' : $(`#p_3_${id}`).val().replaceAll(',', '')))
                // alert(maxp)
                if (maxp) totalTrade += maxp * parseFloat(elem.innerText)
            })
            $('#totalSum').html(totalTrade.toLocaleString())
            if (totalTrade <= parseFloat($(`#p_0_1`).val().replaceAll(',', ''))) $(`#p_0_3`).html('معاملات خرد')
            else if (totalTrade <= parseFloat($(`#p_0_2`).val().replaceAll(',', ''))) $(`#p_0_3`).html('معاملات متوسط')
            else $(`#p_0_3`).html('معاملات کلان')
        } else {
            await $.ajax({
                url: url('trade/setTradeLevel'),
                method: "POST",
                data: {
                    id: idd[2],
                    value: e.target.value.replaceAll(',', '')
                }
            }).then(async () => {
                await ToastPro('مبلغ ریالی سطوح معاملات تغییر یافت!', 'top', 'success')
                location.reload()
            })
        }
    })
    Dropzone.autoDiscover = false;
    let myDropzone = new Dropzone("#my-dropzone", {
        maxFilesize: 100, //mb
        maxFiles: 20,
        acceptedFiles: "image/*,application/pdf,.doc,.docx,.xls,.xlsx",  //exactly this line
    });

    async function signBuyReqEnd(p, b) {
        Swal.fire({
            icon: 'question',
            text: `آیا از بستن درخواست خرید ${b} برای پروژه ${p} مطمئن هستید؟`,

            showCancelButton: true,
            cancelButtonText: "انصراف",
            confirmButtonText: "تایید",
            question: '؟'
        }).then(async (result) => {
            if (result.isConfirmed) {
                await $.ajax({
                    url: url('trade/closeBuyReq'),
                    method: "POST",
                    data: {
                        p: p,
                        b: b,

                    }
                }).then(async () => {
                    await ToastPro('عملیات بازرگانی برای این درخواست خرید پایان یافت!', 'top', 'success', 1)

                })
            }
        })
    }
async function issueBuyCommand(p, b)
{
    Swal.fire({
        icon: 'question',
        text: `آیا از صدور مجوز برای درخواست خرید ${b} برای پروژه ${p} مطمئن هستید؟`,

        showCancelButton: true,
        cancelButtonText: "انصراف",
        confirmButtonText: "تایید",
        question: '؟'
    }).then(async (result) => {
        if (result.isConfirmed) {
            await $.ajax({
                url: url('trade/issueBuyCommand'),
                method: "POST",
                data: {
                    p: p,
                    b: b,

                }
            }).then(async () => {
                await ToastPro('این درخواست به درخواستهای آماده خرید منتقل شد!', 'top', 'success', 1)

            })
        }
    })
}
    async function openHistory(eq,sp) {
        let equip = eq
        let type = sp
        if (equip == '') return

        Swal.fire({
            title: '',

            html: `<div class="bg-gradient w-100 h-100">

</div>
<div style="height: 800px" class="overflow-y-scroll ltr">
    <iframe src="${url(`detail/statics/?q=${equip}&qq=${equip.replace(/[^a-zA-Z0-9]/g, '')}&spec=${type.replace(/[^a-zA-Z0-9]/g, '')}`)}" scrolling="yes" width="100%" height="1200">
        <p>Hello</p>
    </iframe>
</div>

`,
            grow: "row",
            reverseButtons: true,
            width: 1400,
            showCloseButton: true,
            showConfirmButton: false,
            showClass: {
                popup: `
animate__animated
animate__fadeInUp
animate__faster
`
            },
            hideClass: {
                popup: `
animate__animated
animate__fadeOutDown
animate__faster
`
            },

        })


    }
</script>

</html>

