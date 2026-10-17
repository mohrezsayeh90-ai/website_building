<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
global $flashMessage;
?>
<div id="mydrpbH_1" class="ltr z-10 hidden w-48 bg-white divide-y divide-gray-100
                                                    rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
     style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 10px);"
     data-popper-reference-hidden=""
     data-popper-escaped="" data-popper-placement="bottom">
    <input type="hidden" id="row_typem" value="">
    <ul class="p-3 space-y-1  text-gray-700 dark:text-gray-200" aria-labelledby="mydrpb_1">
        <li>
            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <input id="radio_4_1" type="radio" value="" name="radio_1" class="w-4 h-4 text-blue-600
                bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700
                focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="radio_4_1" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">VCB</label>
            </div>
        </li>
        <li>
            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <input id="radio_4_2" type="radio" value="" name="radio_1" class="w-4 h-4 text-blue-600
                bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700
                dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="radio_4_2" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Accessories</label>
            </div>
        </li>
        <li>
            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <input id="radio_4_3" type="radio" value="" name="radio_1"
                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="radio_4_3" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Normal</label>
            </div>
        </li>
        <li>
            <hr>
        </li>
        <li>
            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <input id="radio_4_4" type="radio" value="" name="radio_1"
                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="radio_4_4" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Foreign
                    Accessories</label>
            </div>
        </li>
        <li>
            <hr>
        </li>
        <li>
            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">

                <i id="deletethisRow" class="fa fa-close cursor-pointer text-red-600 fa-2xl ml-4 mt-3">Delete
                    this row</i>

            </div>
        </li>
        <li>
            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">

                <i id="insertNewRow" class="fa fa-plus-square cursor-pointer text-blue-400 fa-2xl ml-4 mt-3">Insert new
                    row</i>

            </div>
        </li>
    </ul>
</div>

<div id="my-search-list00"
     class="z-20 absolute flex flex-wrap ltr mt-3 text-sm font-medium
     text-left text-gray-500 border-1 bg-gray-200 border-gray-400 dark:border-gray-700 dark:text-gray-400 "
     style="max-height:500px;--width:65%;top: 32px;margin-right: 168px;display: none;min-width:300px ; overflow-y: scroll">
    <i class="fa fa-circle animate-bounce"></i>
    <ul class="list-none p-2" id="search-result00">
        <?php
        foreach ($materials[2] as $description) {
            ?>
            <li class="ml-2 hover:bg-black hover:text-white cursor-pointer"><?= $description['description'] ?></li>
            <?php
        }
        ?>
    </ul>
</div>
<div id="my-search-list10"
     class="z-20 absolute flex flex-wrap ltr mt-3 text-sm font-medium
     text-left text-gray-500 border-1 bg-gray-200 border-gray-400 dark:border-gray-700 dark:text-gray-400 "
     style="max-height:500px;--width:65%;top: 32px;margin-right: 168px;display: none;min-width:300px ; overflow-y: scroll">
    <i class="fa fa-circle animate-bounce"></i>
    <ul class="list-none p-2" id="search-result10">
        <?php
        foreach ($materials[3] as $description) {
            ?>
            <li class="ml-2 hover:bg-black hover:text-white cursor-pointer"><?= $description['description'] ?></li>
            <?php
        }
        ?>
    </ul>
</div>

<div id="my-search-list01"
     class="z-20 absolute flex flex-wrap ltr mt-3 text-sm font-medium text-left text-gray-500 border-1 bg-gray-200
     border-gray-400 dark:border-gray-700 dark:text-gray-400"
     style="max-height:500px;--width:65%;top: 32px;margin-right: 168px;display: none;min-width:300px; overflow-y: scroll">
    <i class="fa fa-circle animate-bounce"></i>
    <ul class="list-none p-2" id="search-result01">
        <?php
        foreach ($materials[4] as $mtype) {
            ?>
            <li aria-label="<?= $mtype['clue'] ?>"
                class="ml-2 hover:bg-black hover:text-white cursor-pointer"><?= $mtype['type'] ?></li>
            <?php
        }
        ?>
    </ul>
</div>
<div id="my-search-list11"
     class="z-20 absolute flex flex-wrap ltr mt-3 text-sm font-medium text-left text-gray-500 border-1 bg-gray-200
     border-gray-400 dark:border-gray-700 dark:text-gray-400"
     style="max-height:500px;--width:65%;top: 32px;margin-right: 168px;display: none;min-width:300px; overflow-y: scroll">
    <i class="fa fa-circle animate-bounce"></i>
    <ul class="list-none p-2" id="search-result11">
        <?php
        foreach ($materials[5] as $mtype) {
            ?>
            <li aria-label="<?= $mtype['clue'] ?>"
                class="ml-2 hover:bg-black hover:text-white cursor-pointer"><?= $mtype['type'] ?></li>
            <?php
        }
        ?>
    </ul>
</div>
<div id="my-search-list02"
     class="z-20 absolute flex flex-wrap ltr mt-3 text-sm font-medium text-left text-gray-500 border-1 bg-gray-200
     border-gray-400 dark:border-gray-700 dark:text-gray-400"
     style="max-height:500px;--width:65%;top: 32px;margin-right: 168px;display: none;min-width:300px; overflow-y: scroll">
    <i class="fa fa-circle animate-bounce"></i>
    <ul class="list-none p-2" id="search-result02">
        <?php
        foreach ($materials[6] as $manf) {
            ?>
            <li aria-label="<?= $manf['clue'] ?>"
                class="ml-2 hover:bg-black hover:text-white cursor-pointer"><?= $manf['manufacturer'] ?></li>
            <?php
        }
        ?>
    </ul>
</div>
<div id="my-search-list12"
     class="z-20 absolute flex flex-wrap ltr mt-3 text-sm font-medium text-left text-gray-500 border-1 bg-gray-200
     border-gray-400 dark:border-gray-700 dark:text-gray-400"
     style="max-height:500px;--width:65%;top: 32px;margin-right: 168px;display: none;min-width:300px; overflow-y: scroll">
    <i class="fa fa-circle animate-bounce"></i>
    <ul class="list-none p-2" id="search-result12">
        <?php
        foreach ($materials[7] as $manf) {
            ?>
            <li aria-label="<?= $manf['clue'] ?>"
                class="ml-2 hover:bg-black hover:text-white cursor-pointer"><?= $manf['manufacturer'] ?></li>
            <?php
        }
        ?>
    </ul>
</div>
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
<div class="container h-100">
    <input type="hidden" id="proj_code" value="<?= $materials[0]['proj_code'] ?>">
    <div class="flex no-print flex-row rtl text-3xl ml-5 border-b-2">
        <i data-tooltip-target="tender_finalize_t"
           id="saveAllSheets<?= $materials[0]['proj_status'] > 8 ? 'disabled' : '' ?>" class=" cursor-pointer fa fa-save
         h-auto relative z-0 rounded-lg transition-all duration-300 <?= $materials[0]['proj_status'] > 8 ? 'disabled' : 'hover:scale-150' ?>"></i>
        <i data-tooltip-target="tender_finalize_t1" id="reloadAllSheets" class="fa fa-refresh cursor-pointer ms-4 h-auto relative z-0 rounded-lg
        transition-all duration-300 hover:scale-150"></i>
        <i data-tooltip-target="tender_finalize_t2" id="createmyExcelfile" class="fa fa-download cursor-pointer ms-4 h-auto relative z-0 rounded-lg
        transition-all duration-300 hover:scale-150"></i>
        <?php
        if ($materials[0]['proj_status'] < 10 && (in_array($_SESSION["tim"],array(507,502)) || isset($_SESSION['admin']))) {
            ?>
            <img onclick="signDPL('<?= $materials[0]['proj_code'] ?>')" id="tender_signature"
                 style="width:30px;margin-top:-3px; height:30px"
                 src="<?= $this->asset('images/signature.png') ?>" data-tooltip-target="tender_sign" class="cursor-pointer float-end bg-green-200
  relative z-0 rounded-lg transition-all duration-300 hover:scale-150 border border-red-400 mr-10">
            <?php
        }
        if ($materials[0]['proj_status'] == 10 && (in_array($_SESSION["tim"],array(507,500)) || isset($_SESSION['admin']))) {
            ?>
            <img onclick="p10000Decision('<?= $materials[0]['proj_code'] ?>')" id="tender_audit"
                 style="width:30px;margin-top:-3px; height:30px"
                 src="<?= $this->asset('images/magnifier.png') ?>" data-tooltip-target="tender_auditt" class="cursor-pointer float-end bg-green-200
  relative z-0 rounded-lg transition-all duration-300 hover:scale-150 border border-red-400 mr-10">
            <?php
        }
        ?>
        <i id="ender_return" onclick="gototheList()" data-tooltip-target="tender_return" class="cursor-pointer float-end fa fa-share-square-o
 h-auto relative z-0 rounded-lg transition-all duration-300 hover:scale-150 mr-10"></i>
        <div id="summ" style="left:185px" class="hidden fixed text-base mb-1 ltr w-1/2">
            <div class="text-center font-sans total-sum bg-gray-400 flex flex-row mx-auto">
                <div class="w-1/2 p-1">
                    <span> Total Price (€):</span>
                    <span id="cell_sum_i" class="px-1">0</span>
                </div>
                <div class="w-1/2 p-1 border-l border-slate-500">
                    <span> Total Price (Rial):</span>
                    <span id="cell_sum_r" class="px-1"
                          colspan="1"></span>
                </div>
            </div>
        </div>
    </div>
    <div id="tender_sign" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        امضاء کردن
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <div id="tender_auditt" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        ممیزی اسناد DPL توسط دفتر
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <div id="tender_finalize_t" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        ثبت تغییرات
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <div id="tender_finalize_t6" role="tooltip"
         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        اضافه نمودن متریال
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
    <div class="no-print ltr text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200
        dark:border-gray-700 dark:text-gray-400" id="alltabsMain"
            data-tabs-toggle="#default-styled-tab-content"
            data-tabs-active-classes="text-purple-600"
            data-tabs-inactive-classes="dark:border-transparent text-this-gray hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
            role="tablist">
            <?php
            $tabcnt = 0;
           // print_r($materials[10]);
            foreach ($materials[1] as $key => $material) {
                ?>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500"
                            onclick="setTitle(<?= $key ?>)"
                            id="<?= str_replace(' ', '', $material['code']) ?>-styled-tab"
                            data-tabs-target="#styled-<?= str_replace(' ', '', $material['code']) ?>" type="button"
                            role="tab"
                            aria-controls="<?= str_replace(' ', '', $material['code']) ?>"
                            aria-selected="false"><?= $material['name'] ?>
                    </button>
                    <input type="hidden" value="<?= $material['code'] ?>" id="prd_ten_<?= $key ?>">
                    <input type="hidden"
                           value="<?= isset($_GET['title']) ? $_GET['title'] : $material['voltage'] . ' ' . $material['name'] . ' ' . $material['crnt'] ?>"
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
</div>

<div class="relative w-full">
    <div class="my-scroll-parent scroll1">
        <div class="my-scroll-div w-full">
            <div class="container"
                 style="<?= isset($_GET['margin']) && $_GET['margin'] == 10 ? ';margin-right:-30px !important;width:1280px !important;' : '' ?>">
                <div id="default-styled-tab-content">
                    <?php
                    $tabn = 0;
                    $tabbefore = 0;
                    foreach ($materials[1] as $key => $material) {
                        ?>
                        <div style="<?= isset($_GET['activesheet']) && $_GET['activesheet'] == $key ? 'display:block !important' : (isset($_GET['margin']) ? 'display:none !important' : '') ?>"
                             class=" rounded-lg dark:bg-gray-800"
                             id="styled-<?= str_replace(' ', '', $material['code']) ?>"
                             role="tabpanel"
                             aria-labelledby="<?= str_replace(' ', '', $material['code']) ?>-tab">
                            <div class=" ltr">
                                <div class="colorful-counter mb-1"></div>
                                <div class="inline-block mt-1 mr-2 hidden">
                                    <i class="bi bi-plus-circle hover:text-purple-900"></i>
                                </div>
                                <table id="detail_table"
                                       class="w-full table-fixed border border-collapse border-slate-400 text-end">
                                    <thead>
                                    <tr style="height:1% !important" class="text-center">
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
                                        <th  colspan="<?=19 + $materials[10][$key][1]*6?>" class="border border-slate-500 bg-gray-300 py-1 px-1"
                                            scope="col"><i  onclick="delCol('<?=$material['code']?>','<?=$materials[0]['proj_code']?>')" class="<?= $materials[0]['proj_status'] > 8 ? '' : 'fa fa-minus' ?> mr-10  "></i>QTY
                                            <i  onclick="addCol('<?=$material['code']?>','<?=$materials[0]['proj_code']?>')" class="<?= $materials[0]['proj_status'] > 8 ? '' : 'fa fa-plus' ?> ml-10  "></i>
                                        </th>
                                        <th rowspan="2" colspan="20"
                                            class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col">OrderNo
                                        </th>
                                        <th rowspan="2" colspan="20"
                                            class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col">
                                            Description
                                        </th>

                                    </tr>
                                    <tr style="height:60px !important" class="text-center">
                                        <td colspan="7" class="border border-slate-500 bg-gray-300 py-1  px-1">
                                            <div class="-rotate-90">Request</div>
                                        </td>
                                        <td colspan="6" class="border border-slate-500 bg-gray-300 py-1  px-1">
                                            <div class="-rotate-90">Spare</div>
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
                                            <div class="-rotate-90">Total</div>
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody class="text-sm">

                                    <?php

                                    for ($row = 0; $row < 100; $row++) {
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
                                                class="border border-slate-300 bg-white hover:border-gray-400 ">
                            <textarea id="cell_1_<?= $key . '_' . $row ?>"
                                      class="h-full xl:overflow-hidden min-h-[50px] w-full bg-transparent resize-none text-left border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabn]['equip'];
                                }
                                ?></textarea>

                                            </td>
                                            <?php
                                            if (isset($_GET['margin']) && $_GET['margin'] == 10) {
                                                ?>
                                                <td colspan="30"
                                                    class="border border-slate-300 bg-white hover:border-gray-400">
                            <span id="cell_2_<?= $key . '_' . $row ?>"
                                  class="h-full xl:overflow-hidden min-h-[50px] w-full bg-transparent resize-none text-center border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabn]['type'];

                                }
                                ?></span>
                                                </td>
                                                <?php
                                            } else {
                                                ?>
                                                <td colspan="30"
                                                    class="border border-slate-300 bg-white hover:border-gray-400">
                            <textarea id="cell_2_<?= $key . '_' . $row ?>"
                                      class="h-full xl:overflow-hidden min-h-[50px] w-full bg-transparent resize-none text-center border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabn]['type'];

                                }
                                ?></textarea>
                                                </td>
                                                <?php
                                            }
                                            ?>
                                            <td colspan="15"
                                                class="border border-slate-300 bg-white hover:border-gray-400">
                            <textarea id="cell_3_<?= $key . '_' . $row ?>"
                                      class="h-full xl:overflow-hidden min-h-[50px] w-full bg-transparent resize-none text-center border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabn]['manufact'];

                                }
                                ?></textarea>

                                            </td>
                                            <td colspan="6"
                                                class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">
                            <textarea id="cell_4_<?= $key . '_' . $row ?>"
                                      class="h-full xl:overflow-hidden min-h-[50px] w-full bg-transparent resize-none text-center border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    //  echo $materials[8][$tabn]['qty'] == 0 ? $material['tedad'] : $materials[8][$tabn]['qty'];
                                    echo $materials[8][$tabn]['unit'] ?? 'Pcs';
                                }
                                ?></textarea>

                                            </td>
                                            <td colspan="7"
                                                class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">
                            <textarea id="cell_5_<?= $key . '_' . $row ?>"
                                      class="h-full xl:overflow-hidden min-h-[50px] w-full bg-transparent resize-none text-center border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabn]['qty'];

                                }
                                ?></textarea>

                                            </td>
                                            <td colspan="6"
                                                class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">
                            <textarea id="cell_6_<?= $key . '_' . $row ?>"
                                      class="h-full xl:overflow-hidden min-h-[50px] w-full bg-transparent resize-none text-center border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabn]['spare'] ?? '0';

                                }
                                ?></textarea>

                                            </td>
                                            <?php
                                            for ($tt = 1; $tt <= 5; $tt++) {
                                                ?>
                                                <td colspan="6"
                                                    class=" <?=$tt<=$materials[10][$key][1]?"":"hidden" ?> border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">
                            <textarea id="cell_6<?= $tt ?>_<?= $key . '_' . $row ?>" aria-label="<?= $tt<=$materials[10][$key][1]?$materials[8][$tabn]['col' . $tt . 'name']:"" ?>"
                                      class="h-full xl:overflow-hidden min-h-[50px] w-full bg-transparent resize-none text-center border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?php
                                if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabn]['col'.$tt] ?? '0';

                                }
                                ?></textarea>

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
                                                <textarea id="cell_8_<?= $key . '_' . $row ?>"
                                                          class="h-full xl:overflow-hidden min-h-[50px] w-full bg-transparent resize-none text-center border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?php
                                                    if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                                        //  echo number_format($materials[8][$tabn]['price_r'] * ($materials[8][$tabn]['qty'] == 0 ? $material['tedad'] : $materials[8][$tabn]['qty']));
                                                        echo $materials[8][$tabn]['orderno'] ?? '';
                                                    }
                                                    ?></textarea></td>
                                            <td colspan="20"
                                                class="border border-slate-500 bg-white font-sans hover:border-gray-400 py-1 px-1">
                                                 <textarea id="cell_9_<?= $key . '_' . $row ?>"
                                                           class="h-full xl:overflow-hidden min-h-[50px] w-full bg-transparent resize-none text-center border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?php
                                                     if ($tabn < count($materials[8]) && $materials[8][$tabn]['mah_cod'] == $material['code']) {
                                                         // echo number_format($materials[8][$tabn]['price_r'] * ($materials[8][$tabn]['qty'] == 0 ? $material['tedad'] : $materials[8][$tabn]['qty']));
                                                         echo $materials[8][$tabn]['description'] ?? '';
                                                         $tabn++;
                                                     }
                                                     ?></textarea></td>
                                        </tr>
                                        <?php
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

</div>
<?php
$this->includeFile('layouts/partials/back-to-top');
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/ddetails.js'); ?>"></script>

