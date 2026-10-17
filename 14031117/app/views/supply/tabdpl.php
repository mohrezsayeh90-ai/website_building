<!doctype html>
<html lang="fa" dir="rtl" class="overflow-hidden">
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
</head>

<body class="overflow-y-auto overflow-x-hidden">
<div class="container my-4"
     style="<?= isset($_GET['margin']) && $_GET['margin'] == 10 ? ';margin-right:-30px !important;width:1280px !important;' : '' ?>">
    <div id="accordion-open" data-accordion="open">
        <h2 id="accordion-open-heading-1" class="no-print">
            <button type="button" class="flex items-center justify-between w-full p-1 font-medium rtl:text-right text-gray-500 border border-b-0
            border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400
             hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-open-body-1"
                    aria-expanded="false" aria-controls="accordion-open-body-1">
                <span class="flex items-center"><svg class="w-5 h-5 me-2 shrink-0" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path
                                fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd"></path></svg>
                    <?= $materials[0]['proj_code'] ?>-<i class="text-3xl">DPL</i></span>
                <input id="prjCode" value="<?= $materials[0]['proj_code'] ?>" type="hidden">
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5 5 1 1 5"/>
                </svg>
            </button>
        </h2>
        <div id="accordion-open-body-1" class="<?= isset($_GET['margin']) ? '' : 'hidden' ?>"
             aria-labelledby="accordion-open-heading-1">
            <div class="flex items-center w-full">
                <div class="basis-1/3 md:pl-3">
                    <div class="bg-gradient-to-br from-white to-slate-100 text-center px-4 border py-1
                    border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="rounded-t-lg mx-auto w-auto h-auto max-h-24"
                                 src="<?= $this->asset('images/customers/' . $materials[0]['conSultLogo']) ?>"
                                 alt="لوگوی مشاور"/>
                        </a>
                        <h6 class="mb-3 mt-2 font-normal text-this-gray dark:text-gray-400 ltr">
                            CONSULTANT: <?= $materials[0]['conSultEname'] ?></h6>
                    </div>
                </div>
                <div class="basis-1/3 md:pl-3">
                    <div class="bg-gradient-to-br from-white to-slate-100 text-center px-4 py-1 border
                    border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="rounded-t-lg mx-auto w-auto max-h-24"
                                 src="<?= $this->asset('images/picture3.png') ?>" alt="لوگوی تولید کننده"/>
                        </a>
                        <h6 class="mb-3 mt-2 font-normal text-this-gray dark:text-gray-400 ltr">MANUFACTURER: MEHRABAD
                            INDUSTRIAL CO.</h6>
                    </div>
                </div>
                <div class="basis-1/3">
                    <div class="bg-gradient-to-br from-white to-slate-100 text-center px-4 border py-1
                    border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="rounded-t-lg mx-auto w-auto max-h-24"
                                 src="<?= $this->asset('images/customers/' . $materials[0]['logo']) ?>"
                                 alt="لوگوی مشتری"/>
                        </a>
                        <h6 class="mb-3 mt-2 font-normal text-this-gray dark:text-gray-400 ltr">
                            CLIENT: <?= $materials[0]['ename'] ?></h6>
                    </div>
                </div>
            </div>
            <table class="border border-slate-400 border-collapse table-fixed bg-white mt-4 w-full ltr text-this-gray">
                <tr>
                    <td class="border-slate-400 border px-1">
                        <p class="text-start">PROJECT NO.: <?= $materials[0]['proj_code'] ?></p>
                    </td>
                    <td class="border-slate-400 border px-1">
                        <p id="thistabTile" class="text-center">DOCUMENT
                            TITLE: <?= $materials[1][0]['voltage'] . ' ' . $materials[1][0]['name'] . ' ' . $materials[1][0]['crnt'] ?></p>
                    </td>
                    <td class="border-slate-400 border px-1">
                        <p class="text-start">
                            REVISION: <?= str_replace('V', '', $materials[9]['proj_main_forms_version']) ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="border-slate-400 border px-1" colspan="1">
                        <p class="text-start">PROJECT NAME: <?= $materials[0]['proj_name'] ?></p>
                    </td>
                    <td class="border-slate-400 border px-1" colspan="1">
                        <span class="float-left">DOCUMENT NO: </span>
                        <span class="block overflow-hidden">
                                <input id="BOM_CODE" onchange="changeBOM(1,'BOM_CODE','<?= $materials[0]['proj_code'] ?>')"
                                       class="w-full ml-2 max-h-[20px] border-0 mr-10" type="text"
                                       <?= $materials[0]['proj_status'] > 8 ? 'readonly' : '' ?>
                                       value="<?= $materials[8][0]['document_no'] ?>"></span>
                    </td>
                    <td class="border-slate-400 border px-1">
                        <span class="float-left">DATE:</span><span class="block overflow-hidden">
                            <input onchange="changeBOM(2,'BOM_DATE','<?= $materials[0]['proj_code'] ?>')"
                                   id="BOM_DATE"  class="w-1/2 ml-2 max-h-[20px] border-0 mr-10"
                                   <?= $materials[0]['proj_status'] > 8 ? 'readonly' : 'data-jdp' ?>
                                   value="<?= str_replace("/", "/", $materials[8][0]['document_date']) ?>">
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="relative w-[99vw]">
    <div class="my-scroll-parent scroll1">
        <div class="my-scroll-div w-full grid grid-cols-3 gap-2">
            <div class="container col-span-1 h-full">
                <div class="flex flex-col justify-center">
                    <button id="request" type="button" class="text-white w-full mt-12 bg-blue-700 hover:bg-blue-800 focus:ring-4
                focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600
                dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">ایجاد درخواست جدید</button>

                    <p class="mt-5">
                    <div id="dropZone" class="border-4 border-dashed border-slate-500 min-h-10  text-zinc-400 text-center ">
                        برای اضافه کردن تجهیزات به درخواست روی آنها دبل کلیک کنید
                    </div>
                    </p>
                </div>

                <div class="fixed flex flex-col w-1/3  hidden m-12 max-h-[400px] overflow-y-scroll" id="requestDiv">
                    <div class="flex flex-row justify-between">
                        <button type="button" id="clearAll" class="bg-gradient-to-r from-red-300 via-red-400 to-red-600
                        hover:bg-gradient-to-br focus:ring-2 focus:outline-none text-zinc-200 focus:ring-red-300 dark:focus:ring-red-800
                        shadow-lg shadow-red-400/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            حذف
                        </button>
                        <button type="button" id="elementButId" class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br
                        focus:ring-2
                            focus:outline-none text-zinc-200 focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg
                            dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            ثبت نهایی
                        </button>
                    </div>
                    <div class="h-full w-full pt-4">
                        <div class="bg-white rounded-2 p-5" >
                            <div class="ms-2">

                                <table id="productsTable" class="table  table-auto w-full rounded-lg ">
                                    <thead class="bg-gray-300">
                                    <tr>
                                        <th class="text-start pr-1 border border-slate-400">ردیف</th>
                                        <th class="text-start pr-1 border border-slate-400">تجهیزات</th>
                                        <th class="text-start pr-1 border border-slate-400">تعداد</th>
                                        <th class="text-start pr-1 border border-slate-400">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody id="requestedElems">
                                    </tbody>
                                </table>
                            </div>
                        </div>




                    </div>

                </div>

            </div>
            <div class="container col-span-2" style="<?=isset($_GET['margin']) && $_GET['margin']==10?';margin-right:-30px !important;width:1280px !important;':''?>">
                <div class="no-print ltr text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200
        dark:border-gray-700 dark:text-gray-400" id="alltabsMain"
                        data-tabs-toggle="#default-styled-tab-content"
                        data-tabs-active-classes="text-purple-600"
                        data-tabs-inactive-classes="dark:border-transparent text-this-gray hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                        role="tablist">
                        <?php
                        $tabcnt = 0;
                        foreach ($materials[1] as $key => $material) {
                            ?>
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500"
                                        onclick="setTitle(<?= $key ?>)"
                                        id="<?= str_replace(array(' ','&',';',"\\","/",','), '', $material['code']) ?>-styled-tab"
                                        data-tabs-target="#styled-<?= str_replace(array(' ','&',';',"\\","/",','), '', $material['code']) ?>" type="button"
                                        role="tab"
                                        aria-controls="<?= str_replace(array(' ','&',';',"\\","/",','), '', $material['code']) ?>"
                                        aria-selected="false"><?= $material['name'] ?>
                                </button>
                                <input type="hidden" value="<?= $material['code'] ?>" id="prd_ten_<?= $key ?>">
                                <input type="hidden"
                                       value="<?=isset($_GET['title'])?$_GET['title']:$material['voltage'] . ' ' . $material['name'] . ' ' . $material['crnt'] ?>"
                                       id="prd_ten_title_<?= $key ?>">
                            </li>
                            <?php
                            $tabcnt++;
                        }
                        ?>
                        <li role="presentation">

                            <input type="hidden" value="Materials List" id="prd_ten_title_<?= $tabcnt ?>">
                        </li>
                    </ul>
                </div>
                <div id="default-styled-tab-content">
                    <?php
                    $tabn = 0;
                    $tabbefore = 0;
                    foreach ($materials[1] as $key => $material) {

                        ?>
                        <div style="<?=isset($_GET['activesheet']) && $_GET['activesheet']==$key?'display:block !important':(isset($_GET['margin'])?'display:none !important':'') ?>" class=" rounded-lg dark:bg-gray-800"
                             id="styled-<?= str_replace(array(' ','&',';',"\\","/",','), '', $material['code']) ?>"
                             role="tabpanel"
                             aria-labelledby="<?= str_replace(array(' ','&',';',"\\","/",','), '', $material['code']) ?>-tab">
                            <div class=" ltr">
                                <div class="colorful-counter mb-1"></div>
                                <div class="inline-block mt-1 mr-2 hidden">
                                    <i class="bi bi-plus-circle hover:text-purple-900"></i>
                                </div>
                                <table id="detail_table"
                                       class="w-full table-fixed border border-collapse border-slate-400 text-end">
                                    <thead>
                                    <tr class="text-center">
                                        <th colspan="5" style="width:50px !important"
                                            class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col"
                                            rowspan="2">No.
                                        </th>
                                        <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col"
                                            rowspan="2" colspan="24">EQUIPMENT
                                        </th>
                                        <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col"
                                            rowspan="2" colspan="30">SPECIFICATION
                                        </th>
                                        <th colspan="15" class="border border-slate-500 bg-gray-300 py-1 px-1"
                                            scope="col"
                                            rowspan="2">BRAND
                                        </th>
                                        <th colspan="6" class="border border-slate-500 bg-gray-300 py-1 px-1"
                                            scope="col"
                                            rowspan="2">Unit
                                        </th>
                                        <th  colspan="<?=18 + $materials[10][$key][1]*6?>" class="border border-slate-500 bg-gray-300 py-1 px-1"
                                             scope="col">QTY
                                        </th>
                                        <th rowspan="2" colspan="20"
                                            class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col">OrderNo
                                        </th>
                                        <th rowspan="2" colspan="20"
                                            class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col">
                                            Description
                                        </th>
                                        <th colspan="18"
                                            class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col">
                                            Demands
                                        </th>

                                    </tr>
                                    <tr class="text-center " style="height:80px !important;">
                                        <!--                                        <td class="border border-slate-500 bg-gray-300 py-1 px-1" colspan="2">--->
                                        <!--                                        </td>-->
                                        <td colspan="6" class="border border-slate-500 bg-gray-300 py-1  px-1">
                                            <div class="mt-4 -rotate-90">Request</div>
                                        </td>
                                        <td colspan="6" class="border border-slate-500 bg-gray-300 py-1  px-1">
                                            <div class="mt-4 -rotate-90">Spare</div>
                                        </td>
                                        <?php

                                        for ($t = 1; $t <= 5; $t++) {

                                            ?>
                                            <td colspan="6"
                                                class="<?= $materials[8][$tabn]['col' . $t . 'name']==""?"hidden":"" ?> border border-slate-500 bg-gray-300 py-1  px-1">
                                                <div class="-rotate-90"><?= $materials[8][$tabn]['col' . $t . 'name'] ?></div>
                                            </td>

                                            <?php

                                        }
                                        ?>
                                        <td colspan="6" class="border border-slate-500 bg-gray-300 py-1  px-1">
                                            <div class="mt-4 -rotate-90">Total</div>
                                        </td>
                                        <td colspan="6" class="border border-slate-500 bg-gray-300 py-1  px-1">
                                            <div class="mt-4 -rotate-90">Ordered</div>
                                        </td>
                                        <td colspan="6" class="border border-slate-500 bg-gray-300 py-1  px-1">
                                            <div class="mt-4 -rotate-90">Received</div>
                                        </td>
                                        <td colspan="6" class="border border-slate-500 bg-gray-300 py-1">
                                            <div class="mt-4 -rotate-90">Remained</div>
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody class="text-sm">

                                    <?php
                                    $mybreak=false;
                                    for ($row = 0; $row < 100; $row++) {
                                        if ($tabn == count($materials[8]) || $materials[8][$tabn]['mah_cod'] != $material['code'] ) {
                                          $mybreak=true;
                                          break;
                                        }
                                        ?>
                                        <tr class="text-center ml-2
                                            <?php

                                        if (($tabn >= count($materials[8]) || $materials[8][$tabn]['mah_cod'] != $material['code']) && isset($_GET['margin'])) {
                                            echo "no-print";
                                        }

                                        ?>">
                                            <td colspan="5" id="item_<?= $key . '-' . $row ?>"
                                                style="width:50px !important"
                                                class="border border-slate-300 font-sans <?php
                                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                                    switch ($materials[8][$tabn]['row_type']) {
                                                        case 'Normal':
                                                            echo "bg-white";
                                                            break;
                                                        case "VCB":
                                                            echo "bg-green-300";
                                                            break;
                                                        case "Accessories":
                                                            echo "bg-red-200";
                                                            break;
                                                        case "Foreign Accessories":
                                                            echo "bg-slate-200";
                                                            break;
                                                        default:
                                                            echo "bg-white";

                                                    }
                                                }
                                                ?> hover:border-gray-400">
                                                <button id="mydrpb_<?= $key . '-' . $row ?>"
                                                        class="text-black  focus:ring-1 focus:outline-none focus:ring-blue-300 font-sans rounded-lg
         text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                        type="button"><?= $row + 1 ?></button>
                                                <input type="hidden" id="row_typem_<?= $key . '-' . $row ?>"
                                                       value="<?php
                                                       if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                                           echo $materials[8][$tabn]['row_type'];
                                                       } ?>"></td>

                                            <td colspan="24"
                                                class="border border-slate-300 bg-white text-left hover:border-gray-400 ">
                            <span id="cell_1_<?= $key . '_' . $row ?>"
                                      class="cursor-pointer peer h-full min-h-[50px] w-full ml-2 border-b border-blue-gray-200
                                      bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700"><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabn]['equip'];
                                }
                                ?></span>

                                            </td>
                                            <td colspan="30"
                                                class="border border-slate-300 bg-white hover:border-gray-400">
                            <span id="cell_2_<?= $key . '_' . $row ?>"
                                      class="peer h-full min-h-[50px] w-ful border-b border-blue-gray-200 text-center
                                       bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 "><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabn]['type'];

                                }
                                ?></span>
                                            </td>
                                            <td colspan="15"
                                                class="border border-slate-300 bg-white hover:border-gray-400">
                            <span id="cell_3_<?= $key . '_' . $row ?>"
                                      class="peer h-full min-h-[50px] w-full  border-b border-blue-gray-200
                                      bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 "><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabn]['manufact'];

                                }
                                ?></span>

                                            </td>
                                            <td colspan="6"
                                                class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">
                            <span id="cell_4_<?= $key . '_' . $row ?>"
                                      class="peer h-full min-h-[50px] w-full border-b border-blue-gray-200
                                      bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 "><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    //  echo $materials[8][$tabn]['qty'] == 0 ? $material['tedad'] : $materials[8][$tabn]['qty'];
                                    echo $materials[8][$tabn]['unit'] ?? 'Pcs';
                                }
                                ?></span>

                                            </td>
                                            <td colspan="6"
                                                class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">
                            <span id="cell_5_<?= $key . '_' . $row ?>"
                                      class="peer h-full min-h-[50px] w-full border-b
                                        border-blue-gray-200 bg-white pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 "><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabn]['qty'];

                                }
                                ?></span>

                                            </td>
                                            <td colspan="6"
                                                class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">
                            <span id="cell_6_<?= $key . '_' . $row ?>"
                                      class="peer h-full min-h-[50px] w-full border-b
                                      border-blue-gray-200 bg-white pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 "><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabn]['spare'] ?? '0';

                                }
                                ?></span>

                                            </td>
                                            <?php
                                            for ($tt = 1; $tt <= 5; $tt++) {
                                            ?>
                                            <td colspan="6"
                                                class=" <?=$tt<=$materials[10][$key][1]?"":"hidden" ?> border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">
                            <span id="cell_6<?= $tt ?>_<?= $key . '_' . $row ?>" aria-label="<?= $tt<=$materials[10][$key][1]?$materials[8][$tabn]['col' . $tt . 'name']:"" ?>"
                                  class="peer h-full min-h-[50px] w-full border-b
                                      border-blue-gray-200 bg-white pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 "><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabn]['col'.$tt] ?? '0';

                                }
                                ?></span>

                                            </td>
                                                <?php
                                            }
                                            ?>

                                            <td colspan="6" id="cell_7_<?= $key . '_' . $row ?>"
                                                class="border border-slate-500 bg-white font-sans hover:border-gray-400 py-1 px-1"><?php
                                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                                    $newcol = 0;
                                                    for ($t = 1; $t <= 5; $t++) {
                                                        $newcol += (float)($materials[8][$tabn]['col' . $t] ?? '0');
                                                    }

                                                    echo $newcol + (float)($materials[8][$tabn]['spare'] ?? '0') + (float)$materials[8][$tabn]['qty'];
                                                }
                                                ?></td>
                                            <td colspan="20"
                                                class="border border-slate-500 bg-white font-sans hover:border-gray-400 py-1 px-1">
                                                <span id="cell_8_<?= $key . '_' . $row ?>"
                                                          class="peer h-full min-h-[50px] w-full  border-b
                                      border-blue-gray-200 bg-white pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 "><?php
                                                    if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                                        //  echo number_format($materials[8][$tabn]['price_r'] * ($materials[8][$tabn]['qty'] == 0 ? $material['tedad'] : $materials[8][$tabn]['qty']));
                                                        echo $materials[8][$tabn]['orderno'] ?? '';
                                                    }
                                                    ?></span></td>
                                            <td colspan="20"
                                                class="border border-slate-500 bg-white font-sans hover:border-gray-400 py-1 px-1">
                                                 <span id="cell_9_<?= $key . '_' . $row ?>"
                                                           class="peer h-full min-h-[50px] w-full rtl border-b
                                      border-blue-gray-200 bg-white pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700"><?php
                                                     if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                                         // echo number_format($materials[8][$tabn]['price_r'] * ($materials[8][$tabn]['qty'] == 0 ? $material['tedad'] : $materials[8][$tabn]['qty']));
                                                         echo $materials[8][$tabn]['description'] ?? '';

                                                     }
                                                     ?></span></td>
                                            <td colspan="6"
                                                class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">
                            <span id="cell_10_<?= $key . '_' . $row ?>"
                                  class="peer h-full min-h-[50px] w-full border-b
                                      border-blue-gray-200 bg-white pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700"><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabn]['Ordered'] ?? '0';

                                }
                                ?></span>

                                            </td>
                                            <td colspan="6"
                                                class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">
                            <span id="cell_11_<?= $key . '_' . $row ?>"
                                  class="peer h-full min-h-[50px] w-full border-b
                                      border-blue-gray-200 bg-white pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700"><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabn]['Received'] ?? '0';

                                }
                                ?></span>

                                            </td>
                                            <td colspan="6"
                                                class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">
                            <span id="cell_12_<?= $key . '_' . $row ?>"
                                  class="peer h-full min-h-[50px] w-full border-b
                                      border-blue-gray-200 bg-white pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700"><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabn]['Remained'] ?? '0';
                                    $tabn++;
                                }
                                ?></span>

                                            </td>
                                        </tr>
                                        <?php
                                       // if($mybreak)break;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <!--                                <div class="fixed bottom-0 left-0 right-0">-->
                                <!--                                    <div class="text-center font-sans total-sum bg-gray-400 flex flex-row mx-auto">-->
                                <!--                                        <div class="w-1/2 p-3">-->
                                <!--                                            <span> Total Price (€):</span>-->
                                <!--                                            <span id="cell_sum_i_-->
                                <?php //= $key ?><!--" class="px-1">0</span>-->
                                <!--                                        </div>-->
                                <!--                                        <div class="w-1/2 p-3 border-l border-slate-500">-->
                                <!--                                            <span> Total Price (Rial):</span>-->
                                <!--                                            <span id="cell_sum_r_-->
                                <?php //= $key ?><!--" class="px-1"-->
                                <!--                                                  colspan="1"></span>-->
                                <!--                                        </div>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="hidden font-sans rounded-lg dark:bg-gray-800" id="styled-materials" role="tabpanel"
                         aria-labelledby="materials-tab">
                        <table id="material_table"
                               class="w-full table-auto border border-collapse border-slate-400 text-end">
                            <thead>
                            <tr class="text-center">
                                <th class="border border-slate-500 bg-gray-400 py-1 px-1" scope="col">Sell unit Price
                                </th>
                                <th class="border border-slate-500 bg-gray-400 py-1 px-1" scope="col" colspan="3"></th>
                                <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" rowspan="2">QTY
                                </th>
                                <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" rowspan="2">
                                    Description
                                </th>
                                <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" rowspan="2">Item
                                </th>
                            </tr>
                            <tr class="text-center">
                                <td class="border border-slate-500 bg-gray-400 py-1 px-1">Rial</td>
                                <td class="border border-slate-500 bg-gray-400 py-1 px-1">VCB</td>
                                <td class="border border-slate-500 bg-gray-400 py-1 px-1">Foreign Parts</td>
                                <td class="border border-slate-500 bg-gray-400 py-1 px-1">Rial</td>
                            </tr>
                            </thead>
                            <tbody class="text-sm">
                            <?php
                            $tedad = 0;
                            foreach ($materials[1] as $key => $material) {
                                $tedad += $material['tedad'];
                                ?>

                                <tr class="text-center">
                                    <td class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-2 px-1">0
                                    </td>
                                    <td id='vcb_panir_<?= $key ?>'
                                        class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-2 px-1">0
                                    </td>
                                    <td id="pi_tp_<?= $key ?>"
                                        class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-2 px-1">0
                                    </td>
                                    <td id="pr_tp_<?= $key ?>"
                                        class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-2 px-1">0
                                    </td>
                                    <td class="border border-slate-300 bg-white hover:border-gray-400 h-fit"><?= $material['tedad'] ?></td>
                                    <td class="border border-slate-300 bg-white hover:border-gray-400 ltr text-left pl-1 "><?= $material['name'] . ' ' .
                                        $material['voltage'] . ' ' . $material['crnt'] . ' ' . $material['type1'] ?>
                                    </td>
                                    <td class="border border-slate-300 bg-white hover:border-gray-400"><?= $key + 1 ?>
                                    </td>
                                </tr>
                                <?php
                            } ?>

                            <tr class="text-center total-sum bg-gray-400">
                                <td class="border border-slate-500 px-1">0</td>
                                <td id="vcb_panir" class="border border-slate-500 px-1">0</td>
                                <td id="pi_tp" class="border border-slate-500 px-1">0</td>
                                <td id="pr_tp" class="border border-slate-500 px-1">0</td>
                                <td class="border border-slate-500 px-1"><?= $tedad ?></td>
                                <td class="border border-slate-500 py-3 px-1" colspan="2">
                                    SUM
                                </td>
                            </tr>
                            <tr class="text-center total-sum bg-gray-300">
                                <td class="border border-slate-500 px-1">0</td>
                                <td class="border border-slate-500 px-1">0</td>
                                <td class="border border-slate-500 px-1">0</td>
                                <td class="border border-slate-500 px-1">0</td>
                                <td class="border border-slate-500 px-1">0</td>
                                <td class="border border-slate-500 py-3 px-1" colspan="2">
                                    TAX(10%)
                                </td>
                            </tr>
                            <tr class="text-center total-sum bg-gray-300">
                                <td class="border border-slate-500 px-1">0</td>
                                <td class="border border-slate-500 px-1">0</td>
                                <td class="border border-slate-500 px-1">0</td>
                                <td class="border border-slate-500 px-1">0</td>
                                <td class="border border-slate-500 px-1">0</td>
                                <td class="border border-slate-500 py-3 px-1" colspan="2">
                                    Total Price
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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

<script type="text/javascript" src="<?php $this->asset('lib/js/jalalidatepicker.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('js/helpers.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('js/main.js') ?>"></script>
<script type="text/javascript" src="<?= $this->asset('lib/jsc/jscharting.js') ?>"></script>
<script>
    let thiselem
    function dragStart(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
        ev.dataTransfer.effectAllowed = 'copy';
        ev.target.style.cursor='grab';
        thiselem=ev.target.id
    }

    let requestId=0
    function onDrag(ev) {
        ev.preventDefault();

    }
    $('#clearAll').on('click',async ()=>{
        Swal.fire({
            icon:'question',
            text:'آیا درخواست حذف شود؟',
            showConfirmButton:true,
            showCancelButton: true,
            confirmButtonText: 'بله',
            cancelButtonText: 'خیر',
            question:'؟'
        }).then((result)=>{
            if(result.isConfirmed){
                $("#requestedElems").html('')
                $("#requestDiv").addClass('hidden');
                requestId=0
                ToastPro('درخواست موقت با موفقیت حذف شد','top','info')
            }
        })
    })
    $('tbody>tr>td>span[id^="cell_1"]').on('dblclick',async (ev)=>{
        //alert(1)
        let cnn1=ev.target.id.split("_")
        let qty=parseFloat($(`#cell_7_${cnn1[2]}_${cnn1[3]}`).html())
        let ordered=parseFloat($(`#cell_10_${cnn1[2]}_${cnn1[3]}`).html())
        let maxord=qty-ordered
        // alert(qty)
        //alert(ordered)
        if(ordered>=qty)return
        requestId+=1
        Swal.fire({
            text: `لطفا تعداد را مشخص نمایید`,
            input: "text",
            inputAttributes: {
                autocapitalize: "off",
                placeholder:`${maxord}`

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
         <span class="text-sm">تعداد را مشخص نمایید!</span>:Request failed
      `);

                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then(async (result) => {
            if (result.isConfirmed && result.value) {
                // let data = ev.dataTransfer.getData("text");
                let elem = $(`#${ev.target.id}`).text()
                result.value=Math.min(maxord,qty,parseFloat(result.value))
                if(parseFloat(result.value)<=0)result.value=maxord
                let ariaLabelm=$(`#prjCode`).val()+';;;'+$(`#prd_ten_${cnn1[2]}`).val()+';;;'+$(`#cell_1_${cnn1[2]}_${cnn1[3]}`).html()+';;;'+$(`#cell_2_${cnn1[2]}_${cnn1[3]}`).html()+';;;'+
                    $(`#cell_3_${cnn1[2]}_${cnn1[3]}`).html()+';;;'+$(`#cell_8_${cnn1[2]}_${cnn1[3]}`).html()+';;;'+
                    $(`#cell_9_${cnn1[2]}_${cnn1[3]}`).html()+';;;'+String(result.value)+';;;'+
                    $(`#cell_4_${cnn1[2]}_${cnn1[3]}`).html()
                //console.log(data)

                $("#requestedElems").html($("#requestedElems").html()+`<tr aria-label="${ariaLabelm}" id="request_${requestId}"><td>${requestId}</td><td class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
        <span  class="peer h-full w-full text-sm font-normal text-blue-gray-700
                                      focus:border-gray-900 focus:outline-0">${elem}</span>
        </td><td>${result.value}</td><td class="text-center"><span onclick="removeThisrow(${requestId})" class="fa fa-close text-center text-red-400"></span></td></tr>`)
            }
        })

    })
    $('#elementButId').on('click',async ()=>{
        let scor=0
        $('#requestedElems>tr').each(async function(key, element){
            scor+=1
        })
        if(scor==0)return
        Swal.fire({
            icon:'question',
            text:'آیا از ثبت نهایی درخواست خود اطمینان دارید؟',
            showConfirmButton:true,
            showCancelButton: true,
            confirmButtonText: 'بله',
            cancelButtonText: 'خیر',
            question:'؟'
        }).then(async (result)=>{
            if(result.isConfirmed){
                let ordertime=Date.now()
                data=[]
                $('#requestedElems>tr').each(async function(key, element){
                    // alert(element.ariaLabel)
                    let tmp=element.ariaLabel.split(';;;')
                    data.push({"proj_code":tmp[0],
                        "mah_cod":tmp[1],"equip":tmp[2],"spec":tmp[3],"manufact":tmp[4],
                        "orderno":tmp[5],"description":tmp[6],"qty_demand":tmp[7],"order_no_time":ordertime,"expense_code1":'tolid',"unit":tmp[8]})
                })
                $.ajax({
                    url: url('produce/registerDeman'),
                    method: "POST",
                    data: {
                        data:data,
                        dno:$(`#BOM_CODE`).val(),
                        ddate:$(`#BOM_DATE`).val(),
                    }, dataType: "html"
                })
                await  ToastPro('درخواست با موفقیت ثبت شد!','top','info')
                location.reload()
            }
        })
    })
    function removeThisrow(id){
        document.getElementById('request_'+id).remove()
        requestId--
    }
    $("#request").on('click', function (){
        $("#requestDiv").removeClass('hidden');
        requestId=0
    })
    function dropEnd(ev) {
        ev.preventDefault();



        // let tender = document.getElementById('monCode').innerText, child = data.split('_')[1];
    }

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
    function setTitle(k,l=0)
    {
        // if(l!=0)$('#summ').addClass('hidden')
        // else if($('#summ').hasClass('hidden') || l==0){
        //     $('#summ').removeClass('hidden')
        //   //  headerSum(k+'_0')
        // }
        $('#thistabTile').html('DOCUMENT TITLE: '+$(`#prd_ten_title_${k}`).val())
    }
    //}
</script>

</html>
<!--<script type="text/javascript" src="--><?php //$this->asset('js/project.js'); ?><!--"></script>-->