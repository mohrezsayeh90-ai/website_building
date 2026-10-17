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
<div style="margin-left:0px !important" class="ltr m-4">
<!--    <div id="accordion-open" data-accordion="open">-->
<!--        <h2 id="accordion-open-heading-1">-->
<!--            <button type="button" class="flex items-center justify-between w-full p-1 font-medium :text-right text-gray-500 border border-b-0-->
<!--            border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400-->
<!--             hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-open-body-1"-->
<!--                    aria-expanded="false" aria-controls="accordion-open-body-1">-->
<!--                <span class="flex items-center"><svg class="w-5 h-5 me-2 shrink-0" fill="currentColor"-->
<!--                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path-->
<!--                                fill-rule="evenodd"-->
<!--                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"-->
<!--                                clip-rule="evenodd"></path></svg>-->
<!--                    </span>-->
<!--                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"-->
<!--                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">-->
<!--                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"-->
<!--                          d="M9 5 5 1 1 5"/>-->
<!--                </svg>-->
<!--            </button>-->
<!--        </h2>-->
<!--        <div id="accordion-open-body-1" class="" aria-labelledby="accordion-open-heading-1">-->
<!--           -->
<!--        </div>-->
<!--    </div>-->
    <table style="max-width: 70%" class="border border-slate-400 border-collapse ltr table-fixed bg-white mt-4 w-full text-this-gray">
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
                <?=$Order[0]['proj_code']?>
            </td>
            <td class="border-slate-400 border px-1 text-center text-sm">
                <?=$Order[0]['date10']?>
            </td>
            <td class="border-slate-400 border px-1 text-center font-bold text-red-600">
            <?=$Order[0]['buy_no']?>
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

                        درخواست کننده : <?=$Order[0]['expense_code1']?>

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


<div >
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
                    rowspan="1" colspan="8">مشخصات جنس
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
                <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col"
                    rowspan="1" colspan="2">رسید شده
                </th>
            </tr>
            <tr class="text-center">
                <td class="border border-slate-500 bg-gray-300 py-1 px-1" colspan="4" rowspan="2">شرح جنس</td>
                <td class="border border-slate-500 bg-gray-300 py-1 px-1" rowspan="2">واحد</td>
                <td class="border border-slate-500 bg-gray-300 py-1 px-1" colspan="2">کد جنس</td>
                <td class="border border-slate-500 bg-gray-300 py-1 px-1">کد واحد</td>
                <td class="border border-slate-500 bg-gray-300 py-1 px-1" rowspan="2">مقدار</td>
                <td class="border border-slate-500 bg-gray-300 py-1 px-1" rowspan="2">شماره</td>
            </tr>
            <tr class="text-center">
                <td class="border border-slate-500 bg-gray-300 py-1 px-1">11</td>
                <td class="border border-slate-500 bg-gray-300 py-1 px-1" colspan="2">12</td>
                <td class="border border-slate-500 bg-gray-300 py-1 px-1">13</td>
                <td class="border border-slate-500 bg-gray-300 py-1 px-1">14</td>
                <td class="border border-slate-500 bg-gray-300 py-1 px-1">15</td>
            </tr>
            </thead>
            <tbody class="text-sm">
            <?php
            $summ=0;
            foreach ($Order as $key=> $ord){

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
                                       disabled:bg-blue-gray-50"><?=$key+1?></span>

                </td>
                <td
                    class="border border-slate-300 bg-white hover:border-gray-400 ">
                            <textarea id="cell_1_"
                                      class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></textarea>

                </td>
                <td colspan="4"
                    class="border border-slate-300 bg-white hover:border-gray-400 " align="left">
                            <span id="cell_2_"
                                      class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200 text-right
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?=$ord['equip'].';'.$ord['spec'].';'.$ord['manufact']?></span>
                </td>
                <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <span id="cell_3_"
                                      class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?=$ord['unit']?></span>

                </td>
                <td colspan="2" class="border border-slate-300 bg-white hover:border-gray-400">
                            <textarea id="cell_3_"
                                      class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></textarea>

                </td>
                <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <textarea id="cell_3_"
                                      class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></textarea>

                </td>
                <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <span id="cell_3_"
                                      class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?=number_format($ord['qty_buy'])?></span>

                </td>
                <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <input <?= isset($Order[0]['buy_req_status']) && $Order[0]['buy_req_status']>0 ?  'readonly' : 'data-jdp' ?> onchange="changeDate(<?=$ord['demand_row_id']?>)" value="<?=$ord['buy_req_trkh']?>"
                                       style="height:100% !important" id="cell_3_<?=$ord['demand_row_id']?>"
                                      class="h-full min-h-[62px] w-full h-full  border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50">

                </td>
                <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <textarea id="cell_3_"
                                      class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></textarea>

                </td>
                <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <textarea readonly id="cell_3_"
                                      class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?=$ord['expense_code1'] . '-' .$Order[0]['proj_code']?></textarea>

                </td>
                <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <textarea id="cell_3_"
                                      class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></textarea>

                </td> <td colspan="1" class="border border-slate-300 bg-white hover:border-gray-400">
                            <textarea id="cell_3_"
                                      class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></textarea>

                </td>

            </tr>
            <?php
                $summ+=$ord['qty_buy'];
            }
         //   print_r($summ);
            ?>
            </tbody>
        </table>
        <div class="w-full flex flex-row border border-slate-300 p-1">
            <label class="d-inline-block me-2 mt-3" for="tips">ملاحظات:</label>
            <textarea <?= isset($Order[0]['buy_req_status']) && $Order[0]['buy_req_status']>0 ?  'readonly' : '' ?> id="tips" aria-label="<?=$Order[0]['demand_row_id']?>"
                      class="h-full min-h-[50px] w-1/2 resize-none text-right p-1 text-this-gray inline-block border border-blue-gray-200 focus:border-0
                                                hover:border-0 focus:ring-2 hover:border-teal-500 focus:ring-teal-400 focus:outline-0"><?=$Order[0]['buy_req_descriptions']?></textarea>
            <label class="d-inline-block me-2 ms-2 mt-3" for="controlSum">جمع کنترلی:</label>
            <input value="<?=number_format($summ)?>" id="controlSum" readonly name="theDate" class=" p-1 mr-0 text-lg text-center inline-block border border-blue-gray-200
                                                hover:border-0 focus:ring-2 hover:border-teal-500 focus:ring-teal-400 focus:outline-0">


            <button onclick="signBuyReq('<?=$Order[0]['proj_code']?>','<?=$Order[0]['buy_no']?>')"
                    class="bg-blue-500 <?= isset($Order[0]['buy_req_status']) && $Order[0]['buy_req_status']>0 ?  'hidden' : '' ?>
    hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-20 ml-0">
                امضاء و ارسال درخواست به واحد بازرگانی
            </button>

        </div>
<!--        <table id="detail_table"-->
<!--               class="w-full table-fixed border border-collapse border-slate-400 text-end">-->
<!--            <tr class="text-center">-->
<!--                <th style="width:50px !important"-->
<!--                    class="border border-slate-500 bg-gray-300 py-1 px-1 text-sm" scope="col">شرح-->
<!--                </th>-->
<!--                <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" colspan="3">تهیه کننده-->
<!--                </th>-->
<!--                <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" colspan="3">تائید کننده-->
<!--                </th>-->
<!--                <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" colspan="3">تصویب کمیته خرید-->
<!--                </th>-->
<!--                <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" colspan="2">تصویب نهایی-->
<!--                </th>-->
<!--                <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" colspan="3">ارجاع به-->
<!--                </th>-->
<!--                <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col"-->
<!--                    colspan="3">توزیع نسخ-->
<!--                </th>-->
<!--            </tr>-->
<!--            <tr class="text-center">-->
<!--                <td class="border border-slate-500 bg-gray-300 py-1 px-1">نام</td>-->
<!--                <td class="border border-slate-500" colspan="3">-->
<!--                    <textarea id="cell_2_" class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200 text-center-->
<!--                                        pt-4 pb-1.5 text-sm font-normal outline-0-->
<!--                                        placeholder-shown:border-blue-gray-200 focus:ring-2 focus:ring-teal-400 focus:border-0-->
<!--                                      focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"></textarea>-->
<!--                </td>-->
<!--                <td class="border border-slate-500" colspan="3">-->
<!--                        <textarea id="cell_2_" class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200 text-center-->
<!--                                        pt-4 pb-1.5 text-sm font-normal outline-0-->
<!--                                        placeholder-shown:border-blue-gray-200 focus:ring-2 focus:ring-teal-400 focus:border-0-->
<!--                                      focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"></textarea>-->
<!--                </td>-->
<!--                <td class="border border-slate-500" colspan="3">-->
<!--                        <textarea id="cell_2_" class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200 text-center-->
<!--                                        pt-4 pb-1.5 text-sm font-normal outline-0-->
<!--                                        placeholder-shown:border-blue-gray-200 focus:ring-2 focus:ring-teal-400 focus:border-0-->
<!--                                      focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"></textarea>-->
<!--                </td>-->
<!--                <td class="border border-slate-500" colspan="2">-->
<!--                        <textarea id="cell_2_" class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200 text-center-->
<!--                                        pt-4 pb-1.5 text-sm font-normal outline-0-->
<!--                                        placeholder-shown:border-blue-gray-200 focus:ring-2 focus:ring-teal-400 focus:border-0-->
<!--                                      focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"></textarea>-->
<!--                </td>-->
<!--                <td class="border border-slate-500" rowspan="2" colspan="3">-->
<!--                       <textarea id="cell_2_" class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200 text-center-->
<!--                                        text-sm font-normal outline-0-->
<!--                                        placeholder-shown:border-blue-gray-200 focus:ring-2 focus:ring-teal-400 focus:border-0-->
<!--                                      focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"-->
<!--                                 rows="5"></textarea>-->
<!--                </td>-->
<!--                <td class="border border-slate-500" rowspan="3" colspan="3">-->
<!--                        <textarea id="cell_2_" class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200 text-center-->
<!--                                        text-sm font-normal outline-0-->
<!--                                        placeholder-shown:border-blue-gray-200 focus:ring-2 focus:ring-teal-400 focus:border-0-->
<!--                                      focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"-->
<!--                                  rows="7"></textarea>-->
<!--                </td>-->
<!--            </tr>-->
<!--            <tr class="text-center">-->
<!--                <td class="border border-slate-500 bg-gray-300 py-1 px-1">امضا</td>-->
<!--                <td class="border border-slate-500" colspan="3">-->
<!--                      <textarea id="cell_2_" class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200 text-center-->
<!--                                        pt-4 pb-1.5 text-sm font-normal outline-0-->
<!--                                        placeholder-shown:border-blue-gray-200 focus:ring-2 focus:ring-teal-400 focus:border-0-->
<!--                                      focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"></textarea>-->
<!--                </td>-->
<!--                <td class="border border-slate-500" colspan="3">-->
<!--                      <textarea id="cell_2_" class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200 text-center-->
<!--                                        pt-4 pb-1.5 text-sm font-normal outline-0-->
<!--                                        placeholder-shown:border-blue-gray-200 focus:ring-2 focus:ring-teal-400 focus:border-0-->
<!--                                      focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"></textarea>-->
<!--                </td>-->
<!--                <td class="border border-slate-500" colspan="3">-->
<!--                      <textarea id="cell_2_" class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200 text-center-->
<!--                                        pt-4 pb-1.5 text-sm font-normal outline-0-->
<!--                                        placeholder-shown:border-blue-gray-200 focus:ring-2 focus:ring-teal-400 focus:border-0-->
<!--                                      focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"></textarea>-->
<!--                </td>-->
<!--                <td class="border border-slate-500" colspan="2">-->
<!--                      <textarea id="cell_2_" class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200 text-center-->
<!--                                        pt-4 pb-1.5 text-sm font-normal outline-0-->
<!--                                        placeholder-shown:border-blue-gray-200 focus:ring-2 focus:ring-teal-400 focus:border-0-->
<!--                                      focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"></textarea>-->
<!--                </td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td class="border border-slate-500 bg-gray-300 py-1 px-1 text-start" colspan="12">-->
<!--                    <label class="d-inline-block me-2" for="theDate">تاریخ:</label>-->
<!--                    <input data-jdp id="theDate" name="theDate" class="border border-blue-gray-200 text-right w-1/2 p-1 text-this-gray inline-block-->
<!--                                                       focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400 focus:outline-0"/>-->
<!--                </td>-->
<!--                <td class="border border-slate-500 bg-gray-300 py-1 px-1 text-start" colspan="3">-->
<!--                    <input id="systemConfirm" name="systemConfirm" type="radio" value="1" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded-->
<!--                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600-->
<!--                                dark:border-gray-500">-->
<!--                    <label for="systemConfirm"-->
<!--                           class="w-full me-2 text-sm text-this-gray rounded dark:text-gray-300">-->
<!--                        تائید ثبت اطلاعات در سیستم مکانیزه</label>-->
<!--                </td>-->
<!--            </tr>-->
<!--        </table>-->
    </div>
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

jalaliDatepicker.startWatch()
    })
    $(document).on('keydown',(e)=>{
        if(e.keyCode==27)
        {
            jalaliDatepicker.hide()
        }
    })
async function changeDate(id)
{
    let value=event.target.value
   // alert(value)
    await $.ajax({
        url:url('store/reqDate'),
        method:"POST",
        data:{
            id:id,
            dvalue:value
        }
    }).then(()=>{

    })
}
$('#tips').on('change',async (e)=>{
    let id=e.target.ariaLabel
    let valm=e.target.value
    await $.ajax({
        url:url('store/reqDescriptions'),
        method:"POST",
        data:{
            id:id,
            dvalue:valm
        }
    }).then(()=>{

    })
})
    async function signBuyReq(p,b)
    {
        await $.ajax({
            url:url('store/signBuyReq'),
            method:"POST",
            data:{
                p:p,
                b:b
            }
        }).then(async ()=>{
            await ToastPro('درخواست با موفقیت امضاء شد!', 'top', 'success')
            window.close();
        })
    }
</script>

</html>

