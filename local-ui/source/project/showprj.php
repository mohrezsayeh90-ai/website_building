<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
global $flashMessage;
?>
<style>
    .dropzone {
        box-sizing: content-box;
        height: 60px;
        border: 0px;
        min-height: fit-content !important;
    }
</style>
<div class="no-print fixed w-full flex flex-row rtl text-3xl mr-5  border-b-2 mt-2">
    <i data-tooltip-target="tender_finalize_t"
       id="saveAllSheetsprj<?= $ProjData['proj_status'] > 1 &&
       !($ProjData['proj_status'] == 3 && (in_array($_SESSION["tim"], array(501, 507)) || isset($_SESSION['admin']))) ? 'disabled' : '' ?>" <?= $ProjData['proj_status'] > 1
    && !($ProjData['proj_status'] == 3 && (in_array($_SESSION["tim"], array(501, 507)) || isset($_SESSION['admin']))) ? 'disabled' : '' ?>
       class=" cursor-pointer fa fa-save
         h-auto relative z-0 rounded-lg transition-all duration-300 <?= $ProjData['proj_status'] > 1 ? '' : 'hover:scale-150' ?> "></i>
    <i data-tooltip-target="tender_finalize_t1" id="reloadAllSheets" onclick="location.reload()" class="fa fa-refresh cursor-pointer ms-4 h-auto relative z-0 rounded-lg
        transition-all duration-300 hover:scale-150"></i>
    <i data-tooltip-target="tender_finalize_t2"
       onclick="window.open(url('project/showprjp/?p=<?= $ProjData['proj_code'] ?>'),'_blank')"
       id="createmyExcelfileprj" class="fa fa-download cursor-pointer ms-4 h-auto relative z-0 rounded-lg
        transition-all duration-300 hover:scale-150"></i>
    <?php
    if ($ProjData['proj_status'] < 3 && (in_array($_SESSION["tim"], array(509, 501, 507)) || isset($_SESSION['admin']))) {
        ?>
        <i data-tooltip-target="tender_finalize_t111" id="sendBadgetoManager" class="fa fa-bell-o cursor-pointer ms-4 h-auto relative z-0 rounded-lg
        transition-all duration-300 hover:scale-150"></i>
        <?php
    }
    ?>
    <?php
    if ($ProjData['proj_status'] < 2 && (in_array($_SESSION["tim"], array(500, 501, 507, 509)) || isset($_SESSION['admin']))) {
        ?>
        <img onclick="signProjectID('<?= $ProjData['proj_code'] ?>')" id="tender_signature"
             style="width:30px;margin-top:-3px; height:30px" src="<?= $this->asset('images/signature.png') ?>"
             data-tooltip-target="tender_sign" class="cursor-pointer float-end bg-green-200
  relative z-0 rounded-lg transition-all duration-300 hover:scale-150 border border-red-400 mr-10">
        <?php
    }
    if ($ProjData['proj_status'] == 2 && (in_array($_SESSION["tim"], array(500, 507)) || isset($_SESSION['admin']))) {
        ?>
        <img onclick="p3000Decision('<?= $ProjData['proj_code'] ?>')" id="tender_audit"
             style="width:30px;margin-top:-3px; height:30px" src="<?= $this->asset('images/magnifier.png') ?>"
             data-tooltip-target="tender_auditt" class="cursor-pointer float-end bg-green-200
  relative z-0 rounded-lg transition-all duration-300 hover:scale-150 border border-red-400 mr-10">
        <?php
    }
    if ($ProjData['proj_status'] == 3 && (in_array($_SESSION["tim"], array(501, 507)) || isset($_SESSION['admin']))) {
        ?>
        <img onclick="p3000Decision2('<?= $ProjData['proj_code'] ?>')" id="tender_audit"
             style="width:30px;margin-top:-3px; height:30px" src="<?= $this->asset('images/magnifier.png') ?>"
             data-tooltip-target="tender_audittt" class="cursor-pointer float-end bg-green-200
  relative z-0 rounded-lg transition-all duration-300 hover:scale-150 border border-red-400 mr-10">
        <?php
    }
    ?>
    <i id="ender_return" onclick="window.location.href=url('prjman')" data-tooltip-target="tender_return" class="cursor-pointer float-end fa fa-share-square-o
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
<div id="tender_sign" role="tooltip"
     class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
    امضاء کردن
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
<div id="tender_return" role="tooltip"
     class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
    بازگشت
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
<div id="tender_finalize_t111" role="tooltip"
     class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
    اطلاع رسانی به مدیران در مورد انجام کار
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
<div id="tender_auditt" role="tooltip"
     class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
    ممیزی شناسنامه پروژه توسط مدیر پروژه
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
<div id="tender_audittt" role="tooltip"
     class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
    ممیزی شناسنامه پروژه توسط برنامه ریزی دفتر
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
<div style="font-family: Zar;background-color: white !important
        <?= isset($_GET['margin']) && $_GET['margin'] == 100 ? ';margin-right:-30px !important;width:1280px !important;' : '' ?>"
     class="container mt-12 mb-12">
    <table id="detail_table"
           style="<?= isset($_GET['margin']) && $_GET['margin'] == 100 ? ';margin-top:-50px !important' : '' ?>"
           class="w-full table-fixed border border-collapse bg-white border-slate-400 text-end">
        <thead class="hidden">
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>
        <th style="width:5%">-</th>

        </thead>
        <tbody>
        <tr>
            <td colspan="4" rowspan="3" align="center" class="border-b"><img style="width:80%"
                                                                             src="../../assets/images/picture3.png"/>
            </td>
            <td class="border-l text-sm text-right border-r" colspan="13">عنوان مدرک:</td>
            <td colspan="3" class="border-b text-right text-sm">شماره مدرک: MIC 03</td>

        </tr>
        <tr>
            <td colspan="13" rowspan="2" class="border-b border-l text-center text-3xl border-r">شناسنامه پروژه</td>
            <td colspan="3" class="border-b text-right text-sm">تاریخ:
                <spanclass
                ="mr-3"><?= $ProjData['proj_start_date'] ?></span></td>
        </tr>
        <tr>
            <td colspan="3" class="border-b text-right text-sm">ویرایش:<span
                        class="mr-3"><?= str_replace('V', '', $OtherProjData[5]['proj_main_forms_version']) ?></span>
            </td>
        </tr>
        <tr>
            <td colspan="1" style="background-color: #e2efda" rowspan="10" class="text-lg text-center border">مشخصات
                کلی
            </td>
            <td colspan="19" class="text-right text-sm border-r">موضوع پروژه:</td>
        </tr>
        <tr>
            <td class="border-b bg-gray-400" colspan="3" rowspan="2"></td>
            <td colspan="13" rowspan="2"
                class="border-b text-center text-2xl border-r bg-gray-400"><?= $ProjData['proj_name'] ?></td>
            <td colspan="3" rowspan="2" class="border-b bg-gray-400"></td>
        </tr>
        <tr></tr>
        <tr>
            <td colspan="19" class="text-right text-sm border-r">*محدوده پروژه شامل موارد زیر می شود</td>
        </tr>
        <tr>
            <td colspan="16" class="border-b text-right text-sm border-r">
                <span class="<?= $ProjData['proj_include_training'] == 1 ? 'mr-5' : '' ?>"><?= $ProjData['proj_include_training'] == 1 ? 'آموزش' : '' ?></span>
                <span class="<?= $ProjData['proj_include_installation_supervision'] == 1 ? 'mr-5' : '' ?>"><?= $ProjData['proj_include_installation_supervision'] == 1 ? 'نظارت بر نصب' : '' ?></span>
                <span class="<?= $ProjData['proj_include_installation'] == 1 ? 'mr-5' : '' ?>"><?= $ProjData['proj_include_installation'] == 1 ? 'نصب و راه اندازی' : '' ?></span>
                <span class="<?= $ProjData['proj_include_transport'] == 1 ? 'mr-5' : '' ?>"><?= $ProjData['proj_include_transport'] == 1 ? 'حمل و تخلیه' : '' ?></span>
            </td>
            <td colspan="3" class="border-b"></td>
        </tr>
        <tr>
            <td colspan="9" class="text-sm text-right border-b border-r">
                شماره قرارداد: <span id="proj_code"
                                     class="text-lg font-bold float-end ml-5"><?= $ProjData['proj_code'] ?></span></td>
            <td colspan="10" class="text-sm text-right border-b border-r">
                کارفرما: <span class="text-sm font-bold mr-2"><?= $ProjData['nam'] ?></span></td>
        </tr>
        <tr>
            <td colspan="9" class="text-sm text-right border-r">
                مدیر پروژه: <span class="text-sm font-bold "><?= $ProjData['proj_manager'] ?></span></td>
            <td colspan="10" class="text-sm text-right  border-r">
                مجری طرح کارفرما: <span class="text-sm font-bold mr-2"><?= !(in_array($_SESSION["tim"], array(509, 500, 501, 507, 508, 513)) || isset($_SESSION['admin'])) ? '' :  $ProjData['proj_executer'] ?></span></td>
        </tr>
        <tr>
            <td colspan="9" class="text-sm text-right border-b border-r">
                شماره تماس/ایمیل: <span class="text-sm font-bold "><?= $ProjData['proj_manager_email'] ?></span></td>
            <td colspan="10" class="text-sm text-right border-b border-r">
                شماره تماس/ایمیل: <span class="text-sm font-bold mr-2"><?= !(in_array($_SESSION["tim"], array(509, 500, 501, 507, 508, 513)) || isset($_SESSION['admin'])) ? '' :  $ProjData['proj_contact_no'] ?></span></td>
        </tr>
        <tr>
            <td colspan="5" class="text-sm text-right border-b border-r">
                تاریخ شروع پروژه: <span class="text-sm font-bold "><?= $ProjData['proj_start_date'] ?></span></td>
            <td colspan="4" class="text-sm text-right border-b border-r">
                محل تحویل موضوع قرارداد : <span
                        class="text-sm font-bold mr-2"><?= $ProjData['proj_delivery_place'] ?></span></td>
            <td colspan="5" class="text-sm text-right border-b border-r">
                مشاور: <span class="text-sm font-bold "><?= $ProjData['conSultNam'] ?></span></td>
            <td colspan="5" class="text-sm text-right border-b ">
                شماره تماس/ایمیل: <span class="text-sm font-bold mr-2"><?= !(in_array($_SESSION["tim"], array(509, 500, 501, 507, 508, 513)) || isset($_SESSION['admin'])) ? '' :  $ProjData['conSultEmali'] ?></span></td>
        </tr>
        <tr>
            <td colspan="5" class="text-sm text-right border-b border-r">
                مدت زمان اجراي پروژه : <span class="text-sm font-bold "><?= $ProjData['proj_duration'] ?> روز</span>
            </td>
            <td colspan="4" class="text-sm text-right border-b border-r">
                دوره تضمین : <span class="text-sm font-bold mr-2"><?= $ProjData['project_warranty_duration'] ?></span>
            </td>
            <td colspan="5" class="text-sm text-right border-b border-r">
                جریمه تاخیر:</span></td>
            <td colspan="5" class="text-sm text-right border-b ">
                <span class="text-sm font-bold mr-2"><?= $ProjData['proj_late_payment_penalty'] ?></span></td>
        </tr>
        <tr style='page-break-before: always;'>
            <td style="height:20px" colspan="20" class="border"></td>
        </tr>
        <tr>
            <td colspan="1" rowspan="<?= 16 + count($OtherProjData[0] ?? [2, 3, 4]) - 5 ?>"
                style="background-color: #e2efda" class="text-lg text-center border">اطلاعات فنی
            </td>
            <td style="background-color: #D1E1F2" class="text-center font-bold text-sm border-r border-t">ردیف</td>
            <td colspan="5" style="background-color: #D1E1F2" class="text-center font-bold text-sm border-r border-t">
                شرح
            </td>
            <td colspan="1" style="background-color: #D1E1F2" class="text-center font-bold text-sm border-r border-t">
                تعداد
            </td>
            <td colspan="1" style="background-color: #D1E1F2" class="text-center font-bold text-sm border-r border-t">
                نوع تابلو
            </td>
            <td colspan="1" style="background-color: #D1E1F2" class="text-center font-bold text-sm border-r border-t">PT
                فيکس/ کشويي
            </td>
            <td colspan="1" style="background-color: #D1E1F2" class="text-center font-bold text-sm border-r border-t">
                رنگ
            </td>
            <td colspan="1" style="background-color: #D1E1F2" class="text-center font-bold text-sm border-r border-t">
                نوع دسترسی
            </td>

            <td colspan="2" style="background-color: #D1E1F2" class="text-center font-bold text-sm border-r border-t">
                روبند تجهیزات / درب داخلی
            </td>
            <td colspan="1" style="background-color: #D1E1F2" class="text-center font-bold text-sm border-r border-t">
                درجه حفاظت
            </td>
            <td colspan="1" style="background-color: #D1E1F2" class="text-center font-bold text-sm border-r border-t">
                قدرت قطع تابلو(kA)
            </td>
            <td colspan="2" style="background-color: #D1E1F2" class="text-center font-bold text-sm border-r border-t">
                شماره سفارش
            </td>
            <td colspan="2" style="background-color: #D1E1F2" class="text-center font-bold text-sm border-r border-t">
                شماره سریال طراحی
            </td>
        </tr>

        <?php

        for ($i = 0; $i < 8 + count($OtherProjData[0] ?? [2, 3, 4]) - 5; $i++) {

            ?>
            <tr>
                <input type="hidden" id="tech_1_<?= $i ?>"
                       value="<?= $OtherProjData[0][$i]['proj_item_mah_cod'] ?? '' ?>">
                <td class="text-center font-bold text-lg border-r border-t "><?= $i + 1 ?></td>
                <td colspan="5" class="text-center font-bold text-lg border-r border-t">
                    <textarea rows="1"
                              id="tech_2_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[0][$i]['proj_item_description'] ?? '' ?></textarea>
                </td>
                <td colspan="1" class="text-center font-bold text-lg border-r border-t">
                    <textarea rows="1"
                              id="tech_3_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[0][$i]['proj_item_number'] ?? '' ?></textarea>
                </td>
                <td colspan="1" class="text-center font-bold text-sm border-r border-t">
                    <textarea rows="1"
                              id="tech_4_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[0][$i]['proj_item_panel_type'] ?? '' ?></textarea>
                </td>
                <td colspan="1" class="text-center font-bold text-sm border-r border-t">
                    <textarea rows="1"
                              id="tech_5_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[0][$i]['proj_item_ptFix'] ?? '' ?></textarea>
                </td>
                <td colspan="1" class="text-center font-bold text-sm border-r border-t">
                    <textarea rows="1"
                              id="tech_6_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[0][$i]['proj_item_color'] ?? '' ?></textarea>
                </td>
                <td colspan="1" class="text-center font-bold text-sm border-r border-t">
                    <textarea rows="1"
                              id="tech_7_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[0][$i]['proj_item_access_type'] ?? '' ?></textarea>
                </td>

                <td colspan="2" class="text-center font-bold text-lg border-r border-t">
                    <textarea rows="1"
                              id="tech_8_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[0][$i]['proj_item_cover'] ?? '' ?></textarea>
                </td>
                <td colspan="1" class="text-center font-bold text-lg border-r border-t">
                    <textarea rows="1"
                              id="tech_9_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[0][$i]['proj_item_protection_grade'] ?? '' ?></textarea>
                </td>
                <td colspan="1" class="text-center font-bold text-lg border-r border-t">
                    <textarea rows="1"
                              id="tech_10_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[0][$i]['proj_item_breaking_power'] ?? '' ?></textarea>
                </td>
                <td colspan="2" class="text-center font-bold text-lg border-r border-t">
                    <textarea rows="1"
                              id="tech_11_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[0][$i]['proj_item_order_no'] ?? '' ?></textarea>
                </td>
                <td colspan="2" class="text-center font-bold text-lg border-r border-t">
                    <textarea rows="1"
                              id="tech_12_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[0][$i]['proj_item_serial_no'] ?? '' ?></textarea>
                </td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td colspan="5" class="text-center font-bold  border text-lg border">توضیحات</td>
            <td colspan="14" rowspan="8"
                class="text-center font-bold text-sm border text-lg border-b border-l border-r"></td>
        </tr>
        <tr>
            <td colspan="2" class="text-center border-l border-r  text-sm ">مدارک تکمیلی پیوست</td>
            <td colspan="2" class="text-center border-l border-r text-sm ">شرایط محیطی</td>
            <td colspan="1" class="text-center  border-l border-r text-sm ">* نوع دسترسی</td>
        </tr>
        <tr>
            <td colspan="2" class="text-center border-l border-r  text-sm "></td>
            <td colspan="2" class="text-center border-l border-r text-sm "></td>
            <td colspan="1" class="text-center border-l border-r  text-sm "><span>عقب</span><span>جلو</span></td>
        </tr>
        <tr>
            <td colspan="2" class="text-center  border-l border-r text-sm ">*نقشه های تک خطی</td>
            <td colspan="2" class="text-center border-l border-r text-sm ">*ارتفاع از سطح دریا</td>
            <td colspan="1" class="text-center border-l border-r  text-sm "></td>
        </tr>
        <tr>
            <td colspan="2" class="text-center border-l border-r  text-sm ">*مدارات فرمان/فلسفه کنترل</td>
            <td colspan="2" class="text-center border-l border-r text-sm ">*رطوبت%</td>
            <td colspan="1" class="text-center border-l border-r  text-sm "></td>
        </tr>
        <tr>
            <td colspan="2" class="text-center border-l border-r  text-sm ">*مشخصات فني</td>
            <td colspan="2" class="text-center border-l border-r text-sm ">*حداقل و حداکثر دمای محیط</td>
            <td colspan="1" class="text-center  border-l border-r text-sm "><span>پایین/بالا</span></td>
        </tr>
        <tr>
            <td colspan="2" class="text-center border-l border-r border-b  text-sm ">*لیست سازندگان مجاز</td>
            <td colspan="2" class="text-center border-l border-r border-b text-sm "></td>
            <td colspan="1" class="text-center border-l border-r  border-b text-sm "></td>
        </tr>
        <tr style='page-break-before: always;'>
            <td style="height:20px" colspan="20" class="border border-t"></td>
        </tr>
        <tr class="<?= (in_array($_SESSION["tim"], array(509, 500, 501, 507, 508, 513)) || isset($_SESSION['admin'])) ? '' : 'hidden mehran' ?>">
            <td colspan="1" rowspan="<?= 16 + count($OtherProjData[1] ?? [2, 3, 4]) - 5 ?>"
                style="background-color: #e2efda" class="text-lg text-center border">اطلاعات مالی
            </td>
            <td style="background-color: #D1E1F2" class="text-center font-bold text-lg border-r border-t">ردیف</td>
            <td colspan="7" style="background-color: #D1E1F2" class="text-center font-bold text-lg border-r border-t">
                شرح
            </td>
            <td colspan="2" style="background-color: #D1E1F2" class="text-center font-bold text-lg border-r border-t">
                تعداد
            </td>
            <td colspan="4" style="background-color: #D1E1F2" class="text-center font-bold text-lg border-r border-t">
                قیمت واحد (ریال - یورو)
            </td>
            <td colspan="5" style="background-color: #D1E1F2" class="text-center font-bold text-lg border-r border-t">
                قیمت کل (ریال - یورو)
            </td>

        </tr>
        <?php
        for ($i = 0; $i < 8 + count($OtherProjData[1] ?? [2, 3, 4]) - 5; $i++) {

            ?>
            <tr class="<?= (in_array($_SESSION["tim"], array(509, 500, 501, 507, 508, 513)) || isset($_SESSION['admin'])) ? '' : 'hidden mehran' ?>">
                <input type="hidden" id="fin_1_<?= $i ?>"
                       value="<?= $OtherProjData[1][$i]['proj_f_item_mah_cod'] ?? '' ?>">
                <td class="text-center font-bold text-lg border-r border-t "><?= $i + 1 ?></td>
                <td colspan="7" class="text-center font-bold text-lg border-r border-t">
                    <textarea rows="1"
                              id="fin_2_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[1][$i]['proj_f_item_description'] ?? '' ?></textarea>
                </td>
                <td colspan="2" class="text-center font-bold text-lg border-r border-t">
                    <textarea rows="1"
                              id="fin_3_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[1][$i]['proj_f_item_numbers'] ?? '' ?></textarea>
                </td>
                <td colspan="4" class="text-center font-bold text-lg border-r border-t">
                    <textarea rows="1"
                              id="fin_4_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[1][$i]['proj_f_item_cost_rial'] ?? '' ?></textarea>
                </td>
                <td colspan="5" class="text-center font-bold text-lg border-r border-t">
                    <textarea readonly rows="1"
                              id="fin_5_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= isset($OtherProjData[1][$i]['proj_f_item_cost_rial']) && $OtherProjData[1][$i]['proj_f_item_cost_rial'] != '' ?
                            number_format((float)str_replace(',', '', $OtherProjData[1][$i]['proj_f_item_numbers']) *
                                (float)str_replace(',', '', $OtherProjData[1][$i]['proj_f_item_cost_rial'])) : '' ?></textarea>
                </td>

            </tr>
            <?php
        }
        ?>
        <tr class="<?= (in_array($_SESSION["tim"], array(509, 500, 501, 507, 508, 513)) || isset($_SESSION['admin'])) ? '' : 'hidden mehran' ?>">
            <td colspan="8" class="text-center font-bold text-2xl border">مجموع</td>
            <td id="finqtyTot" colspan="2" class="text-center font-bold text-2xl border"></td>

            <td id="tintotal2" colspan="9" class="text-center font-bold text-2xl border"></td>
        </tr>
        <tr class="<?= (in_array($_SESSION["tim"], array(509, 500, 501, 507, 508, 513)) || isset($_SESSION['admin'])) ? '' : 'hidden mehran' ?>">
            <td colspan="4" class="text-right  text-lg border">مرجع محاسبات مبلغ قرارداد :</td>
            <td colspan="4" class="text-right  text-lg border"><textarea rows="1" id="finrefrences"
                                                                         class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[3][0]['proj_financial_calculation_refrence'] ?? '' ?></textarea>
            </td>
            <td colspan="2" class="text-center  text-lg border">نوع ارز پرداختی</td>
            <td colspan="4" class="text-center text-2xl border">
                <?php
                // print_r($OtherProjData[3][0]['proj_payment_currency_type']);
                ?>
                <input id="checkbox-item-1" <?= isset($OtherProjData[3][0]['proj_payment_currency_type']) && (int)$OtherProjData[3][0]['proj_payment_currency_type'] == 1 ?
                    'checked' : '' ?>
                       name="checkbox-item-1" type="radio"
                       value="0"
                       class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                <label for="checkbox-item-1"
                       class="w-full ms-2 text-lg font-medium text-gray-900 rounded dark:text-gray-300">
                    ریال</label>
                <input id="checkbox-item-2" <?= isset($OtherProjData[3][0]['proj_payment_currency_type']) && (int)$OtherProjData[3][0]['proj_payment_currency_type'] == 2 ?
                    'checked' : '' ?> name="checkbox-item-1" type="radio"
                       value="1"
                       class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                <label for="checkbox-item-0"
                       class="w-full ms-2 text-lg font-medium text-gray-900 rounded dark:text-gray-300">
                    یورو</label>
            </td>
            <td colspan="2" class="text-center  text-lg border">نرخ مبنای تسعیر:</td>
            <td colspan="3" class="text-center  text-lg border"><textarea rows="1" id="fintaseere"
                                                                          class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[3][0]['proj_payment_exchange_rate'] ?? '' ?></textarea>
            </td>
        </tr>
        <tr class="<?= (in_array($_SESSION["tim"], array(509, 500, 501, 507, 508, 513)) || isset($_SESSION['admin'])) ? '' : 'hidden mehran' ?>">
            <td colspan="1" class="text-right  text-sm border">تعدیل:</td>
            <td colspan="2" class="text-right  text-lg border">
                <textarea rows="1" id="fintadil"
                          class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[3][0]['proj_payment_adjustment'] ?? '' ?></textarea>
            </td>
            <td colspan="1" class="text-center  text-sm border">نوع ضمانت نامه:</td>
            <td colspan="2" class="text-right  text-lg border">
                <textarea rows="1" id="finzemanat"
                          class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[3][0]['proj_payment_insurance_document'] ?? '' ?></textarea>
            </td>
            <td colspan="1" class="text-center  text-sm border">اجرای تعهدات:</td>
            <td colspan="2" class="text-center  text-lg border">
                <textarea rows="1" id="fintaahod"
                          class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[3][0]['proj_do_duty_payment'] ?? '' ?></textarea>
            </td>
            <td colspan="1" class="text-center  text-sm border">پیش پرداخت:</td>
            <td colspan="2" class="text-center  text-lg border">
                <textarea rows="1" id="finpish"
                          class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[3][0]['proj_advance_payment'] ?? '' ?></textarea>
            </td>
            <td colspan="1" class="text-center  text-sm border">میان پرداخت:</td>
            <td colspan="2" class="text-center  text-lg border">
                <textarea rows="1" id="finmian"
                          class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[3][0]['proj_along_payment'] ?? '' ?></textarea>
            </td>
            <td colspan="1" class="text-center  text-sm border">حسن انجام کار:</td>
            <td colspan="3" class="text-center  text-lg border">
                <textarea rows="1" id="finhosn"
                          class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[3][0]['proj_fulfillment_price'] ?? '' ?></textarea>
            </td>
        </tr>
        <tr class="<?= (in_array($_SESSION["tim"], array(509, 500, 501, 507, 508, 513)) || isset($_SESSION['admin'])) ? '' : 'hidden mehran' ?>">
            <td colspan="2" class="text-right  text-sm border">تاریخ دریافت پیش پرداخت:</td>
            <td colspan="2" class="text-right  text-lg border">
                <input id="finpishdate1" data-jdp
                       class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                       value="<?= $OtherProjData[3][0]['proj_advance_payment_date'] ?? '' ?>">
            </td>
            <td colspan="2" class="text-center  text-sm border">مبلغ(ریال):</td>
            <td colspan="2" class="text-right  text-lg border">
                <textarea rows="1" id="finpishreal1"
                          class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[3][0]['proj_advance_payment_real'] ?? '' ?></textarea>
            </td>
            <td colspan="11" class="border"></td>
        </tr>
        <tr class="<?= (in_array($_SESSION["tim"], array(509, 500, 501, 507, 508, 513)) || isset($_SESSION['admin'])) ? '' : 'hidden mehran' ?>">
            <td colspan="2" class="text-right  text-sm border">تاریخ دریافت میان پرداخت:</td>
            <td colspan="2" class="text-right  text-lg border"><input id="finpishdate2" data-jdp
                                                                      class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                                                                      value="<?= $OtherProjData[3][0]['proj_along_payment_date'] ?? '' ?>">
            </td>
            <td colspan="2" class="text-center  text-sm border">مبلغ(ریال):</td>
            <td colspan="2" class="text-right  text-lg border"><textarea rows="1" id="finmianreal2"
                                                                         class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[3][0]['proj_along_payment_real'] ?? '' ?></textarea>
            </td>
            <td colspan="11" class="border"></td>
        </tr>
        <tr class="<?= (in_array($_SESSION["tim"], array(509, 500, 501, 507, 508, 513)) || isset($_SESSION['admin'])) ? '' : 'hidden mehran' ?>">
            <td colspan="2" class="text-right  text-sm border">تاریخ دریافت تسویه:</td>
            <td colspan="2" class="text-right  text-lg border"><input style="box-sizing:border-box !important"
                                                                      id="finpishdate3" data-jdp
                                                                      class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                                                                      value="<?= $OtherProjData[3][0]['proj_complete_payment_date'] ?? '' ?>">
            </td>
            <td colspan="2" class="text-center  text-sm border">مبلغ(ریال):</td>
            <td colspan="2" class="text-right  text-lg border"><textarea rows="1" id="finclearreal3"
                                                                         class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[3][0]['proj_complete_payment_real'] ?? '' ?></textarea>
            </td>
            <td colspan="11" class="border"></td>
        </tr>
        <tr></tr>
        <tr style='page-break-before: always;'>
            <td style="height:20px" colspan="20" class="border border-t"></td>
        </tr>
        <tr>
            <td colspan="1" rowspan="<?= 4 + count($OtherProjData[2]) - 1 ?>" style="background-color: #e2efda"
                class="text-lg text-center border">مشکلات و ریسک های پروژه
            </td>
            <td style="background-color: #D1E1F2" class="text-center font-bold text-lg border-r border-t">ردیف</td>
            <td colspan="6" style="background-color: #D1E1F2" class="text-center font-bold text-lg border-r border-t">
                شرح
            </td>
            <td colspan="2" style="background-color: #D1E1F2" class="text-center font-bold text-lg border-r border-t">
                احتمال وقوع
            </td>
            <td colspan="4" style="background-color: #D1E1F2" class="text-center font-bold text-lg border-r border-t">
                اثرات مالی و زمانی
            </td>
            <td colspan="6" style="background-color: #D1E1F2" class="text-center font-bold text-lg border-r border-t">
                استراتژی برخورد با ریسک
            </td>

        </tr>
        <?php
        for ($i = 0; $i < 3 + count($OtherProjData[2]) - 1; $i++) {

            ?>
            <tr>
                <td class="text-center font-bold text-lg border-r border-t"><?= $i + 1 ?></td>
                <td colspan="6" class="text-center font-bold text-lg border-r border-t">
                    <textarea rows="1"
                              id="risk_2_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[2][$i]['risk_description'] ?? '' ?></textarea>
                </td>
                <td colspan="2" class="text-center font-bold text-lg border-r border-t">
                    <textarea rows="1"
                              id="risk_3_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[2][$i]['risk_occurence_probability'] ?? '' ?></textarea>
                </td>
                <td colspan="4" class="text-center font-bold text-lg border-r border-t">
                    <textarea rows="1"
                              id="risk_4_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[2][$i]['risk_effects'] ?? '' ?></textarea>
                </td>
                <td colspan="6" class="text-center font-bold text-lg border-r border-t">
                    <textarea rows="1"
                              id="risk_5_<?= $i ?>"
                              class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[2][$i]['risk_coping_strategy'] ?? '' ?></textarea>
                </td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td style="height:20px" colspan="20" class="border border-t"></td>
        </tr>
        <tr>
            <td colspan="1" rowspan="<?= 5 + ($ProjData['techSize'] ?? 0) ?>" style="background-color: #e2efda"
                class="text-lg text-center border">اطلاعات تکمیلی
            </td>
            <td colspan="3" class="text-center  text-sm border-sm border-t">لیست تجهیزات در تعهد مشتری:</td>
            <td colspan="2" class="text-center  text-sm border-sm border-t">نوع بسته بندی :</td>
            <td colspan="5" class="text-center  text-sm border-sm border-t">سایر موارد خاص و نکات قابل توجه از
                قرارداد:
            </td>
            <td colspan="7" class="text-center  text-sm border-sm border-t">پیوست ها:</td>
            <td colspan="2" class="text-center  text-sm border-sm border-t">نام و امضا تهیه کننده :</td>

        </tr>
        <tr>
            <td colspan="3" rowspan="4" class="text-right  text-sm border-sm border">
                <textarea rows="4" id="otherinfo_1"
                          class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[4][0]['list_of_equipment_in_customer_commitment'] ?? '' ?></textarea>
            </td>
            <td colspan="2" rowspan="4" class="text-center  text-lg border-sm border">
                <textarea rows="4"
                          id="otherinfo_2"
                          class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[4][0]['proj_packing_type'] ?? '' ?></textarea>
            </td>
            <td colspan="5" rowspan="4" class="text-center  text-lg border-sm border">
                <textarea rows="4"
                          id="otherinfo_3"
                          class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $OtherProjData[4][0]['proj_other_important_notes'] ?? '' ?></textarea>
            </td>
            <td colspan="7" rowspan="4" class="text-center border-sm border">

                <form action="<?= Base_Url . '/prjman/uploadPrjAppendix' ?>" class="dropzone border-0" id="my-dropzone">
                    <input type="hidden" id="prjcode" name="prjcode" value="<?= $ProjData['proj_code'] ?>">
                    <div class="dz-message no-print block bg-gray-50 hover:bg-gray-100 cursor-auto text-sm leading-10  w-full border-2
                         border-dashed border-gray-500 ">
                        ارسال مستندات-فایلهای جدید به قبلیها اضافه می شوند
                    </div>
                </form>

            </td>
            <td colspan="2" rowspan="4" class="text-center  text-lg border-sm border">
                <textarea rows="4"
                          id="otherinfo_5"
                          class="h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                       pt-4 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?php if ($OtherProjData[4][0]['proj_signers']) {
                        echo $OtherProjData[4][0]['proj_signers'];
                    } else {
                        if ($OtherProjData[4][0]['user_id']) {
//                            echo "<div contenteditable=\"true\"><p style=\"font-family: 'Monotype Corsiva';font-weight: bolder;\" class=\"text-center\">Signature: " . $OtherProjData[4][0]['user_id'] . PHP_EOL . "</p>";
//                            echo "<p style=\"font-family: 'Monotype Corsiva';font-weight: bolder;\" class=\"text-center\">Address: " .
//                                explode("::",$OtherProjData[4][0]['host'])[0] . PHP_EOL . "</p>";
//                            echo "<p style=\"font-family: 'Monotype Corsiva';font-weight: bolder;\" class=\"text-center\">Date: " .
//                                explode("::",$OtherProjData[4][0]['host'])[1] . PHP_EOL . "</p></div>";
                            echo $OtherProjData[4][0]['user_id'];
                        }
                    } ?></textarea>

            </td>
        </tr>
        </tbody>
    </table>
    <?php
    $filesArray = [];
    if (isset($files)) if (count($files) > 0) {

        ?>
        <div class="container print:hidden <?= (in_array($_SESSION["tim"], array(509, 500, 501, 507, 508, 513, 502)) || isset($_SESSION['admin'])) ? '' : 'hidden mehran' ?>
        text-sm w-full mb-10 mt-10">
            <table class="w-full" id="productsTable">
                <thead style="background-color: #e2efda" class="text-black uppercase dark:text-gray-400 ">
                <tr>
                    <!--                    <th scope="col" class="pr-6 pl-1 py-3 text-end">Date</th>-->
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3">شناسه سند</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">نام سند</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">تاریخ اضافه
                        شدن
                    </th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">پیش نمایش</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">
                        <button onclick="dowmloadAlltogether()" class="hover:scale-150 text-base text-black"
                                title="دانلود همه"><i class="fa fa-download"></i></button>
                    </th>
                </tr>
                </thead>
                <tbody class="text-this-gray text-center">
                <?php
                foreach ($files

                         as $key => $row) {
                    if(in_array($_SESSION["tim"],array(502,503,504,505,506,510,511,512)) && $row['techallowed']!=1)continue;
                    $filesArray[] = getcwd() . DIRECTORY_SEPARATOR . '\\assets\\images\\projects\\' . $row['attachment_file'];
                    ?>
                    <tr className="bg-zinc-100 border-b dark:bg-gray-800 ltr dark:border-gray-700 hover:bg-zinc-400 dark:hover:bg-gray-600">
                        <td style="text-align: center !important"><?= $row['id'] ?></td>
                        <td onclick="window.open(url('assets/images/projects/<?= $row['attachment_file'] ?>'),'_blank')"
                            style="text-decoration-line: underline;
                            text-decoration-style: dotted;text-decoration-color: gray;"
                            class="ltr cursor-pointer text-right">
                            <?= $row['attachment_name'] ?>

                        </td>
                        <td dir="ltr" style="text-align: center !important"><?= $row['date'] ?></td>
                        <?php
                        if (!$row['attachment_file']) {
                            ?>
                            <td></td>
                            <?php
                        } else if (str_ends_with(strtolower($row['attachment_file']), '.jpg') ||
                            str_ends_with(strtolower($row['attachment_file']), '.png') ||
                            str_ends_with(strtolower($row['attachment_file']), '.bmp')
                            || str_ends_with(strtolower($row['attachment_file']), '.tiff')) {
                            ?>

                            <td class="cursor-pointer"
                                onclick="window.open(url('assets/images/projects/<?= $row['attachment_file'] ?>'),'_blank')"
                                style="text-align: center !important">
                                <img style="width:60px;margin: auto"
                                     src="<?= $this->asset('images/projects/' . $row['attachment_file']) ?>"></td>
                            <?php
                        } else if (str_ends_with(strtolower($row['attachment_file']), '.pdf')) {
                            ?>

                            <td class="cursor-pointer"
                                onclick="window.open(url('assets/images/projects/<?= $row['attachment_file'] ?>'),'_blank')"
                                style="text-align: center !important">
                                <embed style="height:90px;width:130px;margin: auto"
                                       src="<?= $this->asset('images/projects/' . $row['attachment_file']) ?>"/>
                            </td>
                            <?php
                        } else {
                            ?>

                            <td onclick="window.open(url('assets/images/projects/<?= $row['attachment_file'] ?>'),'_blank')"
                                style="text-align: center !important" class="text-3xl cursor-pointer">
                                <i class="fa fa-file-text fa-3x"></i></td>
                            <?php
                        }
                        ?>
                        <td></td>
                    </tr>

                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
    }
    ?>

</div>


<?php
$this->includeFile('layouts/partials/back-to-top');
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>

<script type="text/javascript" src="<?php $this->asset('js/showprj.js'); ?>"></script>
<script>
    async function dowmloadAlltogether() {
        await $.ajax({
            url: url('project/downloadZipfiles'),
            method: "post",
            data: {
                files: <?=json_encode($filesArray)?>,
            }, dataType: "html"
        }).then(async (result) => {
            if (result != "nothing") window.open(result, '_blank')
        })
    }
</script>