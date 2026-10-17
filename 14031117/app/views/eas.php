<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
global $flashMessage;
$financells = 16;
//print_r($eplsum);
?>

<div class="container my-4 "

     style="<?= isset($_GET['margin']) && $_GET['margin'] == 10 ? ';margin-right:-30px !important;width:1280px !important;background:white !important' : '' ?>">
    <p class="text-center border-black mb-2 bg-green-200 border border-2 text-3xl font-bold">Estimat Analysis Sheet
        (EAS)</p>
    <div id="accordion-open" data-accordion="open">
        <h2 id="accordion-open-heading-1" class="no-print">
            <button type="button" class="flex  items-center justify-between w-full p-1 font-medium rtl:text-right text-gray-500 border border-b-0
            border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400
             hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-open-body-1"
                    aria-expanded="false" aria-controls="accordion-open-body-1">
                <span class="flex items-center"><svg class="w-5 h-5 me-2 shrink-0" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path
                                fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd"></path></svg>
                    <?= $materials[0]['name'] ?><i id="ender_return" onclick="window.location.href=url('tList')"
                                                   data-tooltip-target="tender_return" class="cursor-pointer float-end fa fa-share-square-o
 h-auto relative z-0 rounded-lg transition-all duration-300 hover:scale-150 mr-10"></i></span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5 5 1 1 5"/>
                </svg>
            </button>
        </h2>
        <div id="tender_return" role="tooltip"
             class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            بازگشت
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <div id="accordion-open-body-1" class="<?= isset($_GET['margin']) ? '' : 'hidden' ?>"
             aria-labelledby="accordion-open-heading-1">
            <div class="flex items-center w-full <?= isset($_GET['title']) ? 'text-xs' : '' ?>">
                <div class="basis-1/3 md:pl-3">
                    <div style="margin-top=0px" class="bg-gradient-to-br from-white to-slate-100 text-center px-4 border py-1
                    border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img style="height:96px !important" class="rounded-t-lg  mx-auto w-auto h-auto h-24"/>
                        </a>
                        <h6 class="mb-3 mt-2 font-normal text-this-gray dark:text-gray-400 ltr">CONSULTANT: -</h6>
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
            <table class="border border-slate-400 border-collapse table-fixed bg-white mt-4 w-full ltr <?= isset($_GET['title']) ? 'text-xs' : '' ?> text-this-gray">
                <tr>
                    <td class="border-slate-400 border px-1">
                        <p class="text-start">DOCUMENT NO.: <?= $materials[0]['code'] ?></p>
                        <input type="hidden" id="mon_cod_main" value="<?= $materials[0]['code'] ?>">
                    </td>
                    <td class="border-slate-400 border px-1">
                        <p id="thistabTile" class="text-center">EAS Analyze</p>
                    </td>
                    <td class="border-slate-400 border px-1">
                        <p class="text-start">REVISION: 01</p>
                    </td>
                </tr>
                <tr>
                    <td class="border-slate-400 border px-1" colspan="2">
                        <p class="text-start">PROJECT NAME: <?= $materials[0]['name'] ?></p>
                    </td>
                    <td class="border-slate-400 border px-1">
                        <p class="text-start">DATE: <?= str_replace("/", "/ ", $materials[0]['trkh']) ?></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="container ">
    <div class="ltr text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200
        dark:border-gray-700 dark:text-gray-400 no-print" id="alltabsMain"
            data-tabs-toggle="#default-styled-tab-content"
            data-tabs-active-classes="text-purple-600"
            data-tabs-inactive-classes="dark:border-transparent text-this-gray hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
            role="tablist">
            <?php
            $tabcnt = 0;
            foreach ($materials[1] as $key => $material) {
                ?>

                <?php
                $tabcnt++;
            }
            ?>
            <li role="presentation">
                <button class="inline-block p-4 text-black bg-gray-100 rounded-t-lg  dark:bg-gray-800 dark:text-blue-500"
                        onclick="setBackColor(0)" id="settings-styled-tab"
                        data-tabs-target="#styled-settings" type="button" role="tab"
                        aria-controls="settings" aria-selected="false">Settings
                </button>

            </li>
            <li role="presentation">
                <button class="inline-block p-4 text-black bg-gray-100 rounded-t-lg  dark:bg-gray-800 dark:text-blue-500"
                        onclick="setBackColor(1)" id="materials-styled-tab"
                        data-tabs-target="#styled-materials" type="button" role="tab"
                        aria-controls="materials" aria-selected="false">Materials
                </button>

            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 text-black  bg-gray-100 rounded-t-lg  dark:bg-gray-800 dark:text-blue-500"
                        id="processing-styled-tab"

                        data-tabs-target="#styled-processing" type="button" role="tab"
                        onclick="setBackColor(2)"
                        aria-selected="false">Processing Cost
                </button>


            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 text-black  bg-gray-100 rounded-t-lg  dark:bg-gray-800 dark:text-blue-500"
                        id="eas-styled-tab"

                        data-tabs-target="#styled-eas" type="button" role="tab"
                        onclick="setBackColor(3)"
                        aria-selected="false">EAS
                </button>


            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 text-black  bg-gray-100 rounded-t-lg  dark:bg-gray-800 dark:text-blue-500"
                        id="financial-styled-tab"

                        data-tabs-target="#styled-financial" type="button" role="tab"
                        onclick="setBackColor(4)"
                        aria-selected="false">Financial Calculation
                </button>


            </li>
        </ul>
    </div>

    <div <?= $materials[0]['status'] >= 100 ? 'style="pointer-events:none"' : '' ?> id="default-styled-tab-content">
        <div class="hidden font-sans rounded-lg dark:bg-gray-800" id="styled-settings" role="tabpanel"
             style="<?= isset($_GET['activesheet']) && $_GET['activesheet'] == $tabcnt ? 'display:block !important;background:white' : (isset($_GET['margin']) ? 'display:none !important' : '') ?>"
             aria-labelledby="settings-styled-tab">

            <h2 style="font-family: primaryFont; font-size: 15pt" class="text-center mt-2 font-bold">اطلاعات مربوط به
                نامه
                پیشنهاد
                <button style="pointer-events: all !important; " title="چاپ پیشنهاد مالی"
                        class="text-3xl mr-10 text-gray-500"
                        onclick="openPrint()">
                    <i class="fa fa-print fa-3xl hover:scale-150"></i>
                </button>
                <input type="hidden" id="mat_tedad" value="">
                <input type="hidden" id="mat_price" value="">
                <input type="hidden" id="print_url"
                       value="<?= $this->url('detail/print/?q=' . $materials[0]['code']) ?>"
            </h2>
            <div class="grid grid-cols-2 gap-2">
                <div>

                    <table style="font-family: primaryFont;"
                           class="mt-5 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="uppercase text-md dark:bg-gray-700 dark:text-gray-400 bg-slate-400 text-white">
                        <tr>
                            <th class="px-6 py-3" scope="col" style="width:100px">ردیف</th>
                            <th class="px-6 py-3" scope="col" style="width:250px">متغیر</th>
                            <th class="px-6 py-3" scope="col" style="width:400px">مقدار</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-0">
                                1
                            </td>
                            <td class="px-6 py-0">
                                شماره نامه
                            </td>
                            <td>
                        <textarea id="ps_1"
                                  class="h-full overflow-hidden max-h-[35px] w-full bg-transparent resize-none text-right border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" aria-label="<?= $eplsum[0]['mon_cod'] ?>"></textarea>
                            </td>
                        </tr>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-0">
                                2
                            </td>
                            <td class="px-6 py-0">
                                تاریخ نامه
                            </td>
                            <td>
                        <textarea id="ps_2"
                                  class="h-full max-h-[35px] w-full overflow-hidden resize-none bg-transparent text-right border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" aria-label="<?= $eplsum[0]['mon_cod'] ?>"></textarea>
                            </td>
                        </tr>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-0">
                                3
                            </td>
                            <td class="px-6 py-0">
                                پیوست(دارد/ندارد)
                            </td>
                            <td>
                        <textarea id="ps_3"
                                  class="h-full max-h-[35px] w-full overflow-hidden resize-none bg-transparent text-right border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" aria-label="<?= $eplsum[0]['mon_cod'] ?>"></textarea>
                            </td>
                        </tr>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-0">
                                4
                            </td>
                            <td class="px-6 py-0">
                                کارفرمای مخاطب
                            </td>
                            <td>
                        <textarea id="ps_4"
                                  class="h-full max-h-[35px] w-full overflow-hidden resize-none bg-transparent text-right border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" aria-label="<?= $eplsum[0]['mon_cod'] ?>"></textarea>
                            </td>
                        </tr>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-0">
                                5
                            </td>
                            <td class="px-6 py-0">
                                شخص مخاطب
                            </td>
                            <td>
                        <textarea id="ps_5"
                                  class="h-full max-h-[35px] w-full overflow-hidden resize-none bg-transparent text-right border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" aria-label="<?= $eplsum[0]['mon_cod'] ?>"></textarea>
                            </td>
                        </tr>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-0">
                                6
                            </td>
                            <td class="px-6 py-0">
                                موضوع
                            </td>
                            <td>
                        <textarea id="ps_6"
                                  class="h-full max-h-[35px] w-full overflow-hidden resize-none bg-transparent text-right border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" aria-label="<?= $eplsum[0]['mon_cod'] ?>"></textarea>
                            </td>
                        </tr>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-0">
                                7
                            </td>
                            <td class="px-6 py-0">
                                توضیحات اول
                            </td>
                            <td>
                        <textarea id="ps_7"
                                  class="h-full  w-full h-fit overflow-hidden bg-transparent text-right border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" aria-label="<?= $eplsum[0]['mon_cod'] ?>">-	70% كل هزينه برآورد شده، به عنوان پيش پرداخت در زمان عقد قرارداد و مابقي پس از تست و قبل از حمل تابلوها دریافت مي‎‌گردد، ماليات ‎برارزش‎ افزوده در زمان فاكتوراسيون به مبلغ پيشنهادي افزوده خواهد گرديد.</textarea>
                            </td>
                        </tr>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-0">
                                8
                            </td>
                            <td class="px-6 py-0">
                                توضیحات دوم
                            </td>
                            <td>
                        <textarea id="ps_8"
                                  class="h-full  w-full overflow-hidden h-fit bg-transparent text-right border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" aria-label="<?= $eplsum[0]['mon_cod'] ?>">-	زمان تحويل تابلو چهار ماه پس از مبادله قرارداد، دريافت پيش پرداخت و تأييد نقشه‌ها </textarea>
                            </td>
                        </tr>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-0">
                                9
                            </td>
                            <td class="px-6 py-0">
                                توضیحات سوم
                            </td>
                            <td>
                        <textarea id="ps_9"
                                  class="h-full  w-full h-fit overflow-hidden bg-transparent text-right border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" aria-label="<?= $eplsum[0]['mon_cod'] ?>">-	تحويل درب كارخانه شركت صنعتي مهرآباد</textarea>
                            </td>
                        </tr>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-0">
                                10
                            </td>
                            <td class="px-6 py-0">
                                توضیحات چهارم
                            </td>
                            <td>
                        <textarea id="ps_10"
                                  class="h-full  w-full h-fit overflow-hidden bg-transparent text-right border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" aria-label="<?= $eplsum[0]['mon_cod'] ?>">-	تحويل درب كارخانه شركت صنعتي مهرآباد</textarea>
                            </td>
                        </tr>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-0">
                                11
                            </td>
                            <td class="px-6 py-0">
                                توضیحات پنجم
                            </td>
                            <td>
                        <textarea id="ps_11"
                                  class="h-full  w-full h-fit overflow-hidden bg-transparent text-right border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" aria-label="<?= $eplsum[0]['mon_cod'] ?>">-	مدت اعتبار اين پيشنهاد 7 روز </textarea>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div>
                    <table style="font-family: primaryFont;"
                           class="mt-5 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="uppercase text-md dark:bg-gray-700 dark:text-gray-400 bg-slate-400 text-white">
                        <tr>
                            <th class="px-6 py-3" scope="col" style="width:100px">ردیف</th>
                            <th class="px-6 py-3" scope="col" style="width:250px">متغیر</th>
                            <th class="px-6 py-3" scope="col" style="width:400px">مقدار</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-0">
                                12
                            </td>
                            <td class="px-6 py-0">
                                مدیر بازرگانی
                            </td>
                            <td>
                        <textarea id="ps_12"
                                  class="h-full  w-full h-fit overflow-hidden bg-transparent text-right border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                                  aria-label="<?= $eplsum[0]['mon_cod'] ?>">محمد شریفی</textarea>
                            </td>
                        </tr>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-0">
                                13
                            </td>
                            <td class="px-6 py-0">
                                جمله اصلی نامه
                            </td>
                            <td>
                        <textarea id="ps_13"
                                  class="h-full  w-full h-fit overflow-hidden bg-transparent text-right border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" aria-label="<?= $eplsum[0]['mon_cod'] ?>">احتراماً، بازگشت به استعلام بعمل آمده جهت
        خرید پروژه، بدینوسیله پیشنهاد مالی به شرح ذیل تقدیم حضور می
        گردد.</textarea>
                            </td>
                        </tr>
                        <?php

                        foreach ($materials[1] as $key => $material) {
                            $lastcnt = $key + 15;
                            ?>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-0">
                                    <?= $key + 14 ?>
                                </td>
                                <td class="px-6 py-0">
                                    عنوان متریال
                                </td>
                                <td>
                        <textarea id="ps_m<?= $key ?>" dir="auto"
                                  class="h-full max-h-[35px] overflow-hidden w-full resize-none bg-transparent text-left  border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" aria-label="<?= $eplsum[0]['mon_cod'] ?>"><?=
                            $material['voltage'] . ' ' . $material['name'] . ' ' . $material['crnt'] ?></textarea>
                                </td>
                            </tr>

                            <?php
                        }
                        ?>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-0">
                                <?= $lastcnt ?>
                            </td>
                            <td class="px-6 py-0">
                                شرح مشاور
                            </td>
                            <td>
                        <textarea dir="auto" id="extra_data_1"
                                  class="h-full  w-full h-fit overflow-hidden resize-none bg-transparent text-left border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" "></textarea>
                            </td>
                        </tr>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-0">
                                <?= $lastcnt+1 ?>
                            </td>
                            <td class="px-6 py-0">
                                S/S Name
                            </td>
                            <td>
                        <textarea dir="auto" id="extra_data_2"
                                  class="h-full  w-full h-fit overflow-hidden resize-none bg-transparent text-left border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" "></textarea>
                            </td>
                        </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <div class="hidden font-sans rounded-lg dark:bg-gray-800" id="styled-materials" role="tabpanel"
             style="<?= isset($_GET['activesheet']) && $_GET['activesheet'] == $tabcnt ? 'display:block !important;background:white' : (isset($_GET['margin']) ? 'display:none !important' : '') ?>"
             aria-labelledby="materials-styled-tab">
            <table id="material_table"
                   class="w-full table-auto border border-collapse border-slate-400 text-end">
                <thead>
                <tr class="text-center">

                    <th class="border border-slate-500 bg-gray-400 py-1 px-1" scope="col">Sell unit Price
                    </th>
                    <th class="border border-slate-500 bg-gray-400 py-1 px-1" scope="col" colspan="4"></th>

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
                    <td class="border border-slate-500 bg-gray-400 py-1 px-1">Foreign Accessories</td>
                    <td class="border border-slate-500 bg-gray-400 py-1 px-1">Foreign Parts</td>

                    <td class="border border-slate-500 bg-gray-400 py-1 px-1">Rial</td>
                </tr>

                </thead>
                <tbody class="text-sm">
                <?php
                $tedad = 0;
                $sum_r = 0;
                $sum_i = 0;
                $sum_for = 0;
                $sum_vcb = 0;
                foreach ($materials[1] as $key => $material) {

                    $tedad += $material['tedad'];
                    $sum_r += $eplsum[$key]['col_r'] * $material['tedad'];
                    $sum_vcb += $eplsum[$key]['col_vcb'] * $material['tedad'];
                    $sum_for += $eplsum[$key]['col_for'] * $material['tedad'];
                    if (isset($eplsum[$key]['col_i']) && $eplsum[$key]['col_for'])
                        $sum_i += ($eplsum[$key]['col_i'] - $eplsum[$key]['col_for']) * $material['tedad'];
                    ?>

                    <tr class="text-center">

                        <td id="mat_row_tot_<?= $key ?>" style="width:180px !important"
                            class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-2 px-1">
                        </td>
                        <td style="width:140px !important" id='vcb_panir_<?= $key ?>'
                            class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-2 px-1">
                            <?= number_format($eplsum[$key]['col_vcb']) ?>
                        </td>
                        <td style="width:160px !important" id="pi1_tp_<?= $key ?>"
                            class="border border-slate-500 bg-gray-400 hover:border-gray-400 "><textarea
                                    id="cell_ai_<?= $key ?>" readonly
                                    class="h-full max-h-[35px] w-full overflow-hidden resize-none text-center border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                                    aria-label="<?= $eplsum[$key]['mon_cod'] . '_' . $eplsum[$key]['mah_cod'] ?>"><?= number_format($eplsum[$key]['col_for'], 1) ?></textarea>
                        </td>
                        <td style="width:120px !important" aria-label="<?= $eplsum[$key]['col_i'] ?>"
                            id="pi_tp_<?= $key ?>"
                            class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-2 px-1"><?= isset($eplsum[$key]['col_i']) && $eplsum[$key]['col_for'] ? number_format($eplsum[$key]['col_i'] - $eplsum[$key]['col_for']) : 0 ?>
                        </td>
                        <td style="width:160px !important" id="pr_tp_<?= $key ?>"
                            class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-2 px-1"><?= number_format($eplsum[$key]['col_r']) ?>
                        </td>

                        <td id="mat_list_tedad_<?= $key ?>"
                            class="border border-slate-300 bg-white hover:border-gray-400 h-fit"><?= $material['tedad'] ?></td>
                        <td class="border border-slate-300 bg-white hover:border-gray-400 ltr text-left pl-1 "><?=
                            $material['voltage'] . ' ' . $material['name'] . ' ' . $material['crnt'] ?>
                        </td>
                        <td class="border border-slate-300 bg-white hover:border-gray-400"><?= $key + 1 ?>
                        </td>
                    </tr>
                    <?php
                } ?>

                <tr class="text-center text-base total-sum bg-gray-400">

                    <td id="mat_sum_sell" class="border border-slate-500 px-1 font-bold">0</td>
                    <td id="vcb_panir"
                        class="border border-slate-500 px-1 font-bold"><?= number_format($sum_vcb) ?> </td>
                    <td id="pfor_tp"
                        class="border border-slate-500 px-1 font-bold"><?= number_format($sum_for, 1) ?></td>
                    <td id="pi_tp" class="border border-slate-500 px-1 font-bold"><?= number_format($sum_i) ?></td>
                    <td id="pr_tp" class="border border-slate-500 px-1 font-bold"><?= number_format($sum_r) ?></td>

                    <td class="border border-slate-500 font-bold px-1"><?= $tedad ?></td>
                    <td class="border border-slate-500 py-3 font-bold px-1" colspan="2">
                        SUM
                    </td>
                </tr>

                <tr class="text-center text-lg total-sum bg-gray-300">
                    <td id="mat_sum_sell_tax" class="border border-slate-500 px-1"></td>
                    <td class="border border-slate-500 px-1"></td>
                    <td class="border border-slate-500 px-1"></td>
                    <td class="border border-slate-500 px-1"></td>
                    <td class="border border-slate-500 px-1"></td>
                    <td class="border border-slate-500 px-1"></td>
                    <td class="border border-slate-500 py-3 px-1" colspan="2">
                        TAX(10%)
                    </td>
                </tr>
                <tr class="text-center text-lg total-sum bg-gray-300">
                    <td id="mat_sum_sell_final" class="border border-slate-500 px-1 font-bold">0</td>
                    <td class="border border-slate-500 px-1"></td>
                    <td class="border border-slate-500 px-1"></td>
                    <td class="border border-slate-500 px-1"></td>
                    <td class="border border-slate-500 px-1"></td>
                    <td class="border border-slate-500 px-1"></td>
                    <td class="border border-slate-500 py-3 px-1 animate-bounce" colspan="2">
                        Total Price
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
        <div class="hidden font-sans rounded-lg ltr dark:bg-gray-800" id="styled-processing" role="tabpanel"
             aria-labelledby="processing-styled-tab">
            <table class="mt-2 w-1/2">
                <tbody>
                <tr>
                    <?php
                    $controlSheet1 = "block";
                    if (count($materials[9]) > 0) {
                        for ($i = 0; $i < count($materials[9]); $i++) {
                            if ($materials[9][$i]['eas_sheet'] == "controlSheet1")
                                $controlSheet1 = "none";
                        }
                    }
                    ?>
                    <td style="width:1%;white-space: nowrap;" class="text-lg font-bold">Selling Target(K.Rls )=</td>
                    <td align="left" style="width:40%" class="justify-start"><textarea id="pcs_b" dir="auto"
                                                                                       class="h-full max-h-[35px] w-full overflow-hidden resize-none bg-transparent text-left  border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></textarea>
                    </td>
                    <td style="width:200px;text-align: center;color:green;">
                        <button id="controlSheet1"
                                onclick="controlSheet('controlSheet1','<?= $materials[0]['code'] ?>')"
                                style="display:<?= $controlSheet1 ?>"
                                data-tooltip-target="t1113" class="text-2xl  mb-2 text-center ml-20">
                            <i class="fa fa-check-square hover:scale-150"></i></button>
                        <div id="t1113" role="tooltip"
                             class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                           text-black  transition-opacity duration-300 bg-green-200 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Full control done
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </td>
                    <td style="width:200px;text-align: center;color:red">
                        <button onclick="setYearlyP('styled-processing','<?= substr($materials[0]['trkh'], 0, 4) ?>')"
                                data-tooltip-target="t1111" class="text-2xl  mb-2 text-center"><i
                                    class="fa fa-gear hover:scale-150"></i></button>
                        <div id="t1111" role="tooltip"
                             class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-black font-bold transition-opacity duration-300 bg-red-500 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Set yearly initiale variables (<?= substr($materials[0]['trkh'], 0, 4) ?>)
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <p class="mt-2 text-lg font-bold">Staff Calculation Cost:</p>
            <table class="border border-2 mt-2">
                <thead class="bg-this-teal  text-base text-white font-bold text-center">
                <tr class="border border-1">
                    <th style="width:30px" class="border border-1 border-black">Item</th>
                    <th style="width:300px" class="border border-1 border-black text-left pl-5">Description</th>
                    <th style="width:100px" class="border border-1 border-black pl-2 pr-2">Qty</th>
                    <th style="width:130px" class="border border-1 border-black pl-2 pr-2">Unit Price
                        (KRLS/Hour)
                    </th>
                    <th style="width:160px" class="border border-1 border-black pl-2 pr-2">Annual<p>Salary-KRLS</p></th>
                    <th style="width:70px" class="border border-1 border-black pl-2 pr-2">O/H</th>
                    <th style="width:160px" class="border border-1 border-black pl-2 pr-2">Total Salary<p
                                class="text-sm">
                            (O/H included)</p>
                    </th>
                    <th style="width:100px" class="border border-1 border-black pl-2 pr-2">% Coeff.</th>
                </tr>
                </thead>
                <tbody>
                <tr style="max-height: fit-content" class="text-sm">
                    <td style="width:30px" class="border border-1 border-black text-center">1</td>
                    <td style="width:300px" class="border border-1 border-black text-left pl-5">Engineering Dep.</td>
                    <td style="width:100px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pcs_1_1" dir="auto"
                                                                                           class="overflow-hidden w-full h-full resize-none text-center bg-transparent text-left border-none border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td style="width:130px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pcs_1_2" dir="auto"
                                                                                           class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea>
                    </td>
                    <td id="pcs_1_3" style="width:160px" class="border border-1 border-black text-center"></td>
                    <td style="width:70px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                          id="pcs_1_4" dir="auto"
                                                                                          class="h-full overflow-hidden w-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td id="pcs_1_5" style="width:160px" class="border border-1 border-black text-center"></td>
                    <td id="pcs_1_6" style="width:100px" class="border border-1 border-black text-center"></td>
                </tr>
                <tr style="max-height: fit-content" class="text-sm">
                    <td style="width:30px" class="border border-1 border-black text-center">2</td>
                    <td style="width:300px" class="border border-1 border-black text-left pl-5">Commercial
                        Dep.(Tender/Procurement/Project manager)
                    </td>
                    <td style="width:100px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pcs_2_1" dir="auto"
                                                                                           class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-none border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td style="width:130px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pcs_2_2" dir="auto"
                                                                                           class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea>
                    </td>
                    <td id="pcs_2_3" style="width:160px" class="border border-1 border-black text-center"></td>
                    <td style="width:70px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                          id="pcs_2_4" dir="auto"
                                                                                          class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td id="pcs_2_5" style="width:160px" class="border border-1 border-black text-center"></td>
                    <td id="pcs_2_6" style="width:100px" class="border border-1 border-black text-center"></td>
                </tr>
                <tr style="max-height: fit-content" class="text-sm">
                    <td style="width:30px" class="border border-1 border-black text-center">3</td>
                    <td style="width:300px" class="border border-1 border-black text-left pl-5">Financial Dep.</td>
                    <td style="width:100px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pcs_3_1" dir="auto"
                                                                                           class="h-full overflow-hidden w-full resize-none bg-transparent text-center  border-none border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td style="width:130px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pcs_3_2" dir="auto"
                                                                                           class="h-full overflow-hidden w-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea>
                    </td>
                    <td id="pcs_3_3" style="width:160px" class="border border-1 border-black text-center"></td>
                    <td style="width:70px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                          id="pcs_3_4" dir="auto"
                                                                                          class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td id="pcs_3_5" style="width:160px" class="border border-1 border-black text-center"></td>
                    <td id="pcs_3_6" style="width:100px" class="border border-1 border-black text-center"></td>
                </tr>
                <tr style="max-height: fit-content" class="text-sm">
                    <td style="width:30px" class="border border-1 border-black text-center">4</td>
                    <td style="width:300px" class="border border-1 border-black text-left pl-5">Human
                        Resource/Administration Dept.
                    </td>
                    <td style="width:100px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pcs_4_1" dir="auto"
                                                                                           class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-none border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td style="width:130px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pcs_4_2" dir="auto"
                                                                                           class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea>
                    </td>
                    <td id="pcs_4_3" style="width:160px" class="border border-1 border-black text-center"></td>
                    <td style="width:70px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                          id="pcs_4_4" dir="auto"
                                                                                          class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td id="pcs_4_5" style="width:160px" class="border border-1 border-black text-center"></td>
                    <td id="pcs_4_6" style="width:100px" class="border border-1 border-black text-center"></td>
                </tr>
                <tr style="max-height: fit-content" class="text-sm">
                    <td style="width:30px" class="border border-1 border-black text-center">5</td>
                    <td style="width:300px" class="border border-1 border-black text-left pl-5">Planning Dep.</td>
                    <td style="width:100px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pcs_5_1" dir="auto"
                                                                                           class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-none border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td style="width:130px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pcs_5_2" dir="auto"
                                                                                           class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea>
                    </td>
                    <td id="pcs_5_3" style="width:160px" class="border border-1 border-black text-center"></td>
                    <td style="width:70px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                          id="pcs_5_4" dir="auto"
                                                                                          class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td id="pcs_5_5" style="width:160px" class="border border-1 border-black text-center"></td>
                    <td id="pcs_5_6" style="width:100px" class="border border-1 border-black text-center"></td>
                </tr>
                <tr style="max-height: fit-content" class="text-sm">
                    <td style="width:30px" class="border border-1 border-black text-center">6</td>
                    <td style="width:300px" class="border border-1 border-black text-left pl-5">Technical services
                        Dep.
                    </td>
                    <td style="width:100px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pcs_6_1" dir="auto"
                                                                                           class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-none border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td style="width:130px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pcs_6_2" dir="auto"
                                                                                           class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea>
                    </td>
                    <td id="pcs_6_3" style="width:160px" class="border border-1 border-black text-center"></td>
                    <td style="width:70px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                          id="pcs_6_4" dir="auto"
                                                                                          class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td id="pcs_6_5" style="width:160px" class="border border-1 border-black text-center"></td>
                    <td id="pcs_6_6" style="width:100px" class="border border-1 border-black text-center"></td>
                </tr>
                <tr style="max-height: fit-content" class="text-sm">
                    <td style="width:30px" class="border border-1 border-black text-center">7</td>
                    <td style="width:300px" class="border border-1 border-black text-left pl-5">Other</td>
                    <td style="width:100px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pcs_7_1" dir="auto"
                                                                                           class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-none border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td style="width:130px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pcs_7_2" dir="auto"
                                                                                           class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea>
                    </td>
                    <td id="pcs_7_3" style="width:160px" class="border border-1 border-black text-center"></td>
                    <td style="width:70px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                          id="pcs_7_4" dir="auto"
                                                                                          class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td id="pcs_7_5" style="width:160px" class="border border-1 border-black text-center"></td>
                    <td id="pcs_7_6" style="width:100px" class="border border-1 border-black text-center"></td>
                </tr>
                <tr>
                    <td colspan="7" class="text-right text-lg">SUM</td>
                    <td id="pcs_sum"
                        class="text-center text-lg font-bold border border-2 border-black bg-yellow-100"></td>
                </tr>
                </tbody>


            </table>
            <p class="mt-3 text-lg font-bold">Line Calculation Cost:</p>
            <table class="border border-2 mt-2">
                <thead class="bg-this-teal  text-base text-white font-bold text-center">
                <tr class="border border-1">
                    <th style="width:30px" class="border border-1 border-black">Item</th>
                    <th style="width:300px" class="border border-1 border-black text-left pl-5">Description</th>
                    <th style="width:150px" class="border border-1 border-black pl-2 pr-2">Total Work<p>(Hour)</p>
                    </th>
                    <th style="width:200px" class="border border-1 border-black pl-2 pr-2">Unit Price
                        <p>(KRLS/Hour)</p>
                    </th>
                    <th style="width:150px" class="border border-1 border-black pl-2 pr-2">O/H
                        <p>(%)</p></th>
                    <th style="width:200px" class="border border-1 border-black pl-2 pr-2">Total Price(KRLS)
                        <p>(including O/H)</p>
                    </th>

                </tr>
                </thead>
                <tbody>

                <tr style="max-height: fit-content" class="text-sm">
                    <td style="width:30px" class="border border-1 border-black text-center">1</td>
                    <td style="width:300px" class="border border-1 border-black text-left pl-5">Mechanical Labour</td>
                    <td id="pcl-1-1" style="width:150px" class="border border-1 border-black text-center"></td>
                    <td style="width:200px" class="border border-1 border-black h-fit"><textarea rows=1
                                                                                                 style="max-height: 30px"
                                                                                                 id="pcl-1-2" dir="auto"
                                                                                                 class=" resize-none bg-transparent text-center border-transparent overflow-hidden w-full h-full
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea>
                    </td>
                    <td style="width:150px" class="border border-1 border-black"><textarea rows=1
                                                                                           style="max-height: 30px"
                                                                                           id="pcl-1-3" dir="auto"
                                                                                           class="  resize-none bg-transparent text-center  overflow-hidden overflow-hidden w-full h-full border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td id="pcl-1-4" style="width:200px" class="border border-1 border-black text-center"></td>
                </tr>
                <tr style="max-height: fit-content" class="text-sm">
                    <td style="width:30px" class="border border-1 border-black text-center">2</td>
                    <td style="width:300px" class="border border-1 border-black text-left pl-5">Paint Labour</td>
                    <td id="pcl-2-1" style="width:150px" class="border border-1 border-black text-center"></td>
                    <td style="width:200px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pcl-2-2" dir="auto"
                                                                                           class="h-full overflow-hidden w-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea>
                    </td>
                    <td style="width:150px" class="border border-1 border-black"><textarea
                                style="max-height: 30px" id="pcl-2-3" dir="auto"
                                class="h-full  w-full resize-none bg-transparent text-center overflow-hidden border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td id="pcl-2-4" style="width:200px" class="border border-1 border-black text-center"></td>
                </tr>
                <tr style="max-height: fit-content" class="text-sm">
                    <td style="width:30px" class="border border-1 border-black text-center">3</td>
                    <td style="width:300px" class="border border-1 border-black text-left pl-5">Electrical Labour</td>
                    <td id="pcl-3-1" style="width:150px" class="border border-1 border-black text-center"></td>
                    <td style="width:200px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pcl-3-2" dir="auto"
                                                                                           class="h-full overflow-hidden  w-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea>
                    </td>
                    <td style="width:150px" class="border border-1 border-black"><textarea
                                style="max-height: 30px" id="pcl-3-3" dir="auto"
                                class="overflow-hidden w-full h-full resize-none bg-transparent text-center   border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td id="pcl-3-4" style="width:200px" class="border border-1 border-black text-center"></td>
                </tr>

                <tr>
                    <td colspan="5" class="text-right text-lg">SUM</td>
                    <td id="pcl-sum"
                        class="text-center text-lg font-bold border border-2 border-black bg-orange-200"></td>
                </tr>
                </tbody>
            </table>
            <p class="mt-2 text-lg font-bold text-red-400">Line Calculation Cost Cross Check:</p>
            <table class="border border-2 mt-2">
                <thead class="bg-green-700  text-base text-white font-bold text-center">
                <tr class="border border-1">
                    <th style="width:30px" class="border border-1 border-black">Item</th>
                    <th style="width:300px" class="border border-1 border-black text-left pl-5">Description</th>
                    <th style="width:100px" class="border border-1 border-black pl-2 pr-2">Qty</th>
                    <th style="width:130px" class="border border-1 border-black pl-2 pr-2">Unit Price
                        (KRLS/Hour)
                    </th>
                    <th style="width:160px" class="border border-1 border-black pl-2 pr-2">Annual<p>Salary-KRLS</p></th>
                    <th style="width:70px" class="border border-1 border-black pl-2 pr-2">O/H</th>
                    <th style="width:160px" class="border border-1 border-black pl-2 pr-2">Total Salary<p
                                class="text-sm">
                            (O/H included)</p>
                    </th>
                    <th style="width:200px" class="border border-1  border-black pl-2 pr-2 bg-slate-700">
                        <button class="animate-bounce">CrossCheck</button>
                    </th>

                </tr>
                </thead>
                <tbody>
                <tr style="max-height: fit-content" class="text-sm">
                    <td style="width:30px" class="border border-1 border-black text-center">1</td>
                    <td style="width:300px" class="border border-1 border-black text-left pl-5">Workers</td>
                    <td style="width:100px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pclcc-1" dir="auto"
                                                                                           class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-none border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td style="width:130px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                           id="pclcc-2" dir="auto"
                                                                                           class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea>
                    </td>
                    <td id="pclcc-3" style="width:160px" class="border border-1 border-black text-center"></td>
                    <td style="width:70px" class="border border-1 border-black"><textarea style="max-height: 30px"
                                                                                          id="pclcc-4" dir="auto"
                                                                                          class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td id="pclcc-5" style="width:160px" class="border border-1 border-black text-center"></td>
                    <td id="pclcc-cross" style="width:150px"
                        class="border border-1 border-black bg-orange-200 text-center text-lg font-bold"></td>
                </tr>

                </tbody>


            </table>
            <p class="mt-3 text-lg font-bold">Work (Labour & test) details :</p>
            <table class="border border-2 mt-2">
                <thead class="bg-this-teal  text-base text-white font-bold text-center">
                <tr class="border border-1">
                    <th style="width:30px" class="border border-1 border-black">Item</th>
                    <th style="width:300px" class="border border-1 border-black text-left pl-5">Description</th>
                    <th style="width:100px" class="border border-1 border-black pl-2 pr-2">Qty</th>
                    <th style="width:130px" class="border border-1 border-black pl-2 pr-2">Unit
                        <p>Mech. Work
                            (Hour)</p>
                    </th>
                    <th style="width:130px" class="border border-1 border-black pl-2 pr-2">CNC</p></th>
                    <th style="width:130px" class="border border-1 border-black pl-2 pr-2">Unit
                        <p>Paint Work
                            (Hour)</p></th>
                    <th style="width:130px" class="border border-1 border-black pl-2 pr-2">Unit
                        <p>Elec. Work</p>
                        <p> (Hour)</p>
                    </th>
                    <th style="width:130px" class="border border-1 border-black pl-2 pr-2">Unit
                        <p>Pack. Work
                            (Hour)</p></th>
                    <th style="width:130px" class="border border-1 border-black pl-2 pr-2">Unit
                        <p>Test. Work
                            (Hour)</p></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($materials[1] as $key => $material) {

                    ?>
                    <tr style="max-height: fit-content" class="text-sm">
                        <td style="width:30px" class="border border-1 border-black text-center"><?= $key + 1 ?></td>
                        <td style="width:300px"
                            class="border border-1 border-black text-left pl-5"><?= $material['voltage'] . ' ' . $material['name'] . ' ' . $material['crnt'] ?></td>
                        <td id="pcw-lts-1-<?= $key ?>"
                            class="text-center border border-1 border-black"><?= $material['tedad'] ?></td>
                        <td class="text-center border border-1 border-black"><textarea id="pcw-lts-2-<?= $key ?>"
                                                                                       style="max-height: 30px"
                                                                                       dir="auto"
                                                                                       class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" "></textarea></td>
                        <td class="text-center border border-1 border-black"><textarea id="pcw-lts-3-<?= $key ?>"
                                                                                       style="max-height: 30px"
                                                                                       dir="auto"
                                                                                       class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" "></textarea></td>
                        <td class="text-center border border-1 border-black"><textarea id="pcw-lts-4-<?= $key ?>"
                                                                                       style="max-height: 30px"
                                                                                       dir="auto"
                                                                                       class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" "></textarea></td>
                        <td class="text-center border border-1 border-black"><textarea id="pcw-lts-5-<?= $key ?>"
                                                                                       style="max-height: 30px"
                                                                                       dir="auto"
                                                                                       class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" "></textarea></td>
                        <td class="text-center border border-1 border-black"><textarea id="pcw-lts-6-<?= $key ?>"
                                                                                       style="max-height: 30px"
                                                                                       dir="auto"
                                                                                       class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" "></textarea></td>
                        <td class="text-center border border-1 border-black"><textarea id="pcw-lts-7-<?= $key ?>"
                                                                                       style="max-height: 30px"
                                                                                       dir="auto"
                                                                                       class="overflow-hidden w-full h-full resize-none bg-transparent text-center  border-transparent
                                       pt-0  font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" "></textarea></td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td colspan="2" class="border border-1 border-black text-center font-bold text-lg">Total:</td>
                    <td id="pcw-sum1" class="text-center border border-1 border-black text-lg font-bold"></td>
                    <td id="pcw-sum2" class="text-center border border-1 border-black text-lg font-bold"></td>
                    <td id="pcw-sum3" class="text-center border border-1 border-black text-lg font-bold"></td>
                    <td id="pcw-sum4" class="text-center border border-1 border-black text-lg font-bold"></td>
                    <td id="pcw-sum5" class="text-center border border-1 border-black text-lg font-bold"></td>
                    <td id="pcw-sum6" class="text-center border border-1 border-black text-lg font-bold"></td>
                    <td id="pcw-sum7" class="text-center border border-1 border-black text-lg font-bold"></td>
                </tr>
                </tbody>


            </table>
            <br/><br/><br/>
        </div>
        <div class="hidden font-sans rounded-lg ltr dark:bg-gray-800" id="styled-eas" role="tabpanel"
             aria-labelledby="eas-styled-tab">
            <table class="mt-2 ml-2 w-1/2">
                <tbody>
                <?php
                $controlSheet2 = "block";
                if (count($materials[9]) > 0) {
                    for ($i = 0; $i < count($materials[9]); $i++) {
                        if ($materials[9][$i]['eas_sheet'] == "controlSheet2")
                            $controlSheet2 = "none";
                    }
                }
                ?>
                <tr class="bg-transparent">
                    <td style="width:1%;white-space: nowrap" class="text-lg font-bold ">1EU/Rls=</td>
                    <td><textarea id="celleas_dollar" dir="auto"
                                  class="h-full max-h-[35px] w-full overflow-hidden resize-none bg-transparent text-center  border-b border-blue-gray-200
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"
                        ></textarea></td>
                    <td style="width:200px;text-align: center;color:green;">
                        <button id="controlSheet2"
                                onclick="controlSheet('controlSheet2','<?= $materials[0]['code'] ?>')"
                                style="display:<?= $controlSheet2 ?>"
                                data-tooltip-target="t1114" class="text-2xl  mb-2 text-center  ml-20">
                            <i class="fa fa-check-square hover:scale-150"></i></button>
                        <div id="t1114" role="tooltip"
                             class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                           text-black  transition-opacity duration-300 bg-green-200 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Full control done
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </td>
                    <td style="width:200px;text-align: center;color:red;">
                        <button onclick="setYearlyP('styled-eas','<?= substr($materials[0]['trkh'], 0, 4) ?>')"
                                data-tooltip-target="t1112" class="text-2xl  mb-2 text-center"><i
                                    class="fa fa-gear hover:scale-150"></i></button>
                        <div id="t1112" role="tooltip"
                             class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-black font-bold transition-opacity duration-300 bg-red-500 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Set yearly initiale variables (<?= substr($materials[0]['trkh'], 0, 4) ?>)
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </td>
                </tr>
                </tbody>

            </table>
            <?php
            $ar1 = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "I", "10", "11", "II", "12", "13", "14", "III", "15", "16", "17", "18", "19", "20", "21", "22", "23", "IV", "24", "25", "", "V", "42", "43", "44", "", ""
            ];
            $ar2 = ["Engineering Dep.", "Commercial Dep.(Tender/Procurement/Project manager)",
                "Financial Dep.", "Human Resource/Administration Dept.", "Planning Dep.",
                "Technical services Dep.", "Line Labours", "Other", "Civil/Erection/Commissioning",
                "Total Processing Cost(1-9)", "Material/Services", "Contingency", "Materials Cost (10-11)",
                "Freight /Insurance", "Duties and Taxes ", "Custom clearance", "Total Material Cost(I+II+12+13+14)",
                "Depreciation", "Factory Overhead", "Bonds", "Selling and Marketing", "General & Administrative",
                "Financial Cost", "Loading & Local trasportation", "Tax", "Insurance", "Total Cost(III+15--23)",
                "Research & Development ", "Net Margin", "Selling Price-CPT (IV+24+25)",
                "Selling Price-CPT (cross checking)", "Transport  to site (  in  Iran )",
                "Insurance  up  to  site (in Iran )", "Selling Price  (( CIF )) (54+56+57)", "MIC Total Coeff.", "Shift from Euro  to  Rls"
            ];
            $ar3 = ["V", "V", "V", "V", "V", "V", "", "V", "", "", "", "", "", "II", "II", "II", "", "V", "V", "V", "V", "V", "", "V", "V", "V", "", "V", "V", "", "", "", "", "", "", ""
            ];
            ?>
            <table class="w-full mt-3 ">
                <thead>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="3"
                        class="bg-this-teal text-white text-center text-2xl text-center border border-2 border-black">
                        Internal Parts
                    </td>
                    <td colspan="3"
                        class="bg-this-teal text-white text-center text-2xl text-center border border-2 border-black">
                        Foreign Accessories
                    </td>
                    <td colspan="3"
                        class="bg-this-teal text-white text-center text-2xl text-center border border-2 border-black">
                        VCB-Panir

                    </td>
                    <td colspan="3"
                        class="bg-this-teal text-white text-center text-2xl text-center border border-2 border-black">
                        Civil/Erection

                    </td>
                    <td class="border-none"></td>
                </tr>
                <tr class="bg-this-teal text-white text-center text-lg font-bold ">
                    <td style="width:3%" class="border border-2 border-black">No.</td>
                    <td style="width:29%" class="border border-2 border-black">Description</td>
                    <td style="width:10%" class="border border-2 border-black">K.Rls</td>
                    <td style="width:4%" class="border border-2 border-black">%</td>
                    <td style="width:4%" class="border border-2 border-black">Item</td>
                    <td style="width:9%" class="border border-2 border-black">K Euro</td>
                    <td style="width:5%" class="border border-2 border-black">%</td>
                    <td style="width:4%" class="border border-2 border-black">Item</td>
                    <td style="width:10%" class="border border-2 border-black">K.Rls</td>
                    <td style="width:4%" class="border border-2 border-black">%</td>
                    <td style="width:4%" class="border border-2 border-black">Item</td>
                    <td style="width:7%" class="border border-2 border-black">K.Rls</td>
                    <td style="width:4%" class="border border-2 border-black">%</td>
                    <td style="width:3%" class="border border-2 border-black">Item</td>
                    <td style="background: #f3f3f3" class="border-none "></td>
                </tr>
                </thead>
                <tbody>
                <?php
                for ($i = 0; $i < count($ar1); $i++) {
                    if ($ar1[$i] == "I" || $ar1[$i] == "II" || $ar1[$i] == "III" || $ar1[$i] == "IV" || $i == 29 || $i == "33")

                        echo "<tr class='bg-green-200 font-bold text-lg text-red-600'>";
                    else if ($i == "30") echo "<tr class='bg-slate-400 text-lg font-bold'>";
                    else echo "<tr>";
                    ?>


                    <td style="width:3%" class="border border-1 border-black text-center"><?= $ar1[$i] ?></td>
                    <td style="width:29%" class="border border-1 border-black pl-2"><?= $ar2[$i] ?></td>
                    <td style="width:10%" class="border border-1 border-black text-center"><textarea rows="1"
                                                                                                     id="celleas_<?= $i ?>_2"
                                                                                                     dir="auto"

                                                                                                     class="h-full  w-full overflow-hidden resize-none bg-transparent text-center text-black
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50" "></textarea></td>
                    <td style="width:4%" class="border border-1 border-black text-center"><textarea
                                style="padding-right: 0px !important; padding-left: 0px !important;" rows="1"
                                id="celleas_<?= $i ?>_3"
                                dir="auto"
                                class="h-full  w-full overflow-hidden resize-none bg-transparent text-center text-black
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></textarea></td>
                    <td style="width:4%" class="border border-1 border-black text-center"><textarea rows="1"
                                                                                                    id="celleas_<?= $i ?>_4"
                                                                                                    dir="auto"
                                                                                                    readonly
                                                                                                    class="h-full  w-full overflow-hidden resize-none bg-transparent text-center text-black
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $ar3[$i] ?></textarea></td>
                    <td style="width:6%" class="border border-1 border-black text-center"><textarea rows="1"
                                                                                                    id="celleas_<?= $i ?>_5"
                                                                                                    dir="auto"
                                                                                                    class="h-full  w-full overflow-hidden resize-none bg-transparent text-center text-black
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></textarea></td>
                    <td style="width:4%" class="border border-1 border-black text-center"><textarea rows="1"
                                                                                                    style="padding-right: 0px !important; padding-left: 0px !important;"
                                                                                                    id="celleas_<?= $i ?>_6"
                                                                                                    dir="auto"
                                                                                                    class="h-full  w-full overflow-hidden resize-none bg-transparent text-center text-black
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></textarea></td>
                    <td style="width:4%" class="border border-1 border-black text-center"><textarea rows="1"
                                                                                                    id="celleas_<?= $i ?>_7"
                                                                                                    dir="auto"
                                                                                                    readonly
                                                                                                    class="h-full  w-full overflow-hidden resize-none bg-transparent text-center text-black
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $ar3[$i] ?></textarea></td>
                    <td style="width:10%" class="border border-1 border-black text-center"><textarea rows="1"
                                                                                                     id="celleas_<?= $i ?>_8"
                                                                                                     dir="auto"
                                                                                                     class="h-full  w-full overflow-hidden resize-none bg-transparent text-center text-black
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></textarea></td>
                    <td style="width:4%" class="border border-1 border-black text-center"><textarea rows="1"
                                                                                                    style="padding-right: 0px !important; padding-left: 0px !important;"
                                                                                                    id="celleas_<?= $i ?>_9"
                                                                                                    dir="auto"
                                                                                                    class="h-full  w-full overflow-hidden resize-none bg-transparent text-center text-black
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></textarea></td>
                    <td style="width:4%" class="border border-1 border-black text-center"><textarea rows="1"
                                                                                                    id="celleas_<?= $i ?>_10"
                                                                                                    dir="auto"
                                                                                                    readonly
                                                                                                    class="h-full  w-full overflow-hidden resize-none bg-transparent text-center text-black
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $ar3[$i] ?></textarea></td>
                    <td style="width:10%" class="border border-1 border-black text-center"><textarea rows="1"
                                                                                                     id="celleas_<?= $i ?>_11"
                                                                                                     dir="auto"
                                                                                                     class="h-full  w-full overflow-hidden resize-none bg-transparent text-center text-black
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></textarea></td>
                    <td style="width:4%" class="border border-1 border-black text-center"><textarea rows="1"
                                                                                                    id="celleas_<?= $i ?>_12"
                                                                                                    dir="auto"
                                                                                                    class="h-full  w-full overflow-hidden resize-none bg-transparent text-center text-black
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></textarea></td>
                    <td style="width:4%" class="border border-1 border-black text-center"><textarea rows="1"
                                                                                                    id="celleas_<?= $i ?>_13"
                                                                                                    dir="auto"
                                                                                                    readonly
                                                                                                    class="h-full  w-full overflow-hidden resize-none bg-transparent text-center text-black
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $ar3[$i] ?></textarea></td>
                    <?php
                    if ($i >= 0 && $i < count($ar1) - 2) {
                        ?>
                        <td id="celleas_rowsum_<?= $i ?>" style="background: cyan;width:250px !important"
                            class="border border-2 border-slate-700 text-black text-center text-xs font-light"></td>
                        <?php
                    }
                    ?>
                    </tr>

                    <?php
                }
                ?>
                <tr class="bg-this-teal text-white text-center text-2xl font-bold ">
                    <td style="width:3%" class="border border-2 border-black"></td>
                    <td style="width:29%" class="border border-2 border-black text-right">Total Selling Price (KRLS)
                    </td>
                    <td colspan="6" id="tsellp" class="border border-2 border-black text-left pl-1"></td>

                    <td colspan="2" class="border-b border-2 border-black border-t text-right pr-1">Total Coeff.=</td>
                    <td colspan="4" id="tsellcoff" class="border border-2 border-black text-left pl-1">-</td>
                    <td style="background: #f3f3f3" class="border-none "></td>
                </tr>
                </tbody>

            </table>
            <br/><br/><br/>
        </div>
        <div class=" ltr  hidden font-sans rounded-lg dark:bg-gray-800" id="styled-financial" role="tabpanel"
             aria-labelledby="financial-styled-tab">
            <?php
            $par11 = ["Client downpayment", "Client delayed payment (month)", "Contract Time", "Interest Rate"
            ];
            $par12 = ["Client Downpayment", "Internal Parts", "Processing Cost", "O/H", "Transport  to site", "Last payment"
            ];
            ?>
            <div style="overflow-x: scroll !important;" class="">
                <table class="mt-5 text-xs min-w-[1800px]">
                    <thead>
                    <tr>
                        <?php
                        $controlSheet3 = "block";
                        if (count($materials[9]) > 0) {
                            for ($i = 0; $i < count($materials[9]); $i++) {
                                if ($materials[9][$i]['eas_sheet'] == "controlSheet3")
                                    $controlSheet3 = "none";
                            }
                        }
                        ?>
                        <td colspan="3" style="width:200px;text-align: center;color:green;">
                            <button id="controlSheet3"
                                    onclick="controlSheet('controlSheet3','<?= $materials[0]['code'] ?>')"
                                    style="display:<?= $controlSheet3 ?>"
                                    data-tooltip-target="t1115" class="text-2xl  mb-2 text-center  ml-20">
                                <i class="fa fa-check-square hover:scale-150"></i></button>
                            <div id="t1115" role="tooltip"
                                 class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                           text-black  transition-opacity duration-300 bg-green-200 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Full control done
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </td>
                        <td id="Procurement"
                            class="bg-green-200 text-black font-bold text-center border border-1 border-black">
                            Procurement
                        </td>
                        <?php
                        for ($i = 0; $i < $financells; $i++) {
                            ?>
                            <th style="width:80px" class="text-center border border-1 border-black"><textarea
                                        style="padding-left: 0px !important;padding-right: 0px !important;"
                                        rows="1"
                                        id="proc1_<?= $i ?>"
                                        dir="auto"
                                        class="h-full w-full overflow-hidden resize-none bg-transparent text-center text-black
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"></textarea></th>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr class="bg-this-teal text-white font-bold">
                        <td style="width: 50px !important;" class="text-center border border-1 border-black">Subjects
                        </td>
                        <th style="width:200px !important" colspan="2" class="text-center border border-1 border-black">
                            Assumptions
                        </th>
                        <th style="width:150px" class="text-center border border-1 border-black"></th>
                        <?php
                        for ($i = 0; $i < $financells; $i++) {
                            ?>
                            <th style="width:80px" class="text-center border border-1 border-black"><?= $i + 1 ?></th>
                            <?php
                        }
                        ?>
                    </tr>
                    </thead>

                    <?php
                    for ($i = 0; $i < count($par11); $i++) {
                        ?>
                        <tr>
                            <?php
                            if ($i == 0) {
                                ?>
                                <td rowspan="10"
                                    class=" text-center border border-1 border-black text-white font-bold bg-this-teal">
                                    Internal Parts
                                </td>
                                <?php
                            }
                            ?>
                            <td style="width:150px !important"
                                class=" border border-1 border-black bg-slate-200 text-left pl-2"><?= $par11[$i] ?></td>
                            <td style="width:50px;"
                                class="text-center border border-1 border-black bg-slate-200"><textarea
                                        style="padding-left: 0px !important;padding-right: 0px !important;"
                                        rows="1"
                                        id="fin1_<?= $i ?>"
                                        dir="auto"
                                        class="h-full w-full overflow-hidden resize-none bg-transparent text-center text-black
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $i == 0 ? '50%' : ($i == 1 ? '2' : ($i == 2 ? '4' : ($i == 3 ? '2%' : ''))) ?></textarea>
                            </td>


                            <td class=" border border-1 border-black bg-slate-200 pl-2 text-left"><?= $par12[$i] ?></td>
                            <?php

                            for ($j = 0; $j < $financells; $j++) {
                                ?>
                                <td id="cellfin_<?= $i . "_" . $j ?>" style="width:80px"
                                    class="text-center border border-1 border-black"></td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    for ($i = count($par11); $i < count($par12); $i++) {
                        ?>
                        <tr style="height: 40px !important;">
                            <td colspan="2" class=" border border-1 border-black bg-slate-200 pl-2 text-left"></td>
                            <td class=" border border-1 border-black bg-slate-200 pl-2 text-left"><?= $par12[$i] ?></td>
                            <?php

                            for ($j = 0; $j < $financells; $j++) {
                                ?>
                                <td id="cellfin_<?= $i . "_" . $j ?>" style="width:80px"
                                    class="text-center border border-1 border-black"></td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr style="height: 40px !important;">
                        <?php

                        for ($j = 1; $j < $financells + 4; $j++) {
                            if ($j == 1)
                                echo '<td colspan="2" class=" border border-1 border-black bg-slate-200 pl-2 text-left"></td>';
                            else if ($j == 3)
                                echo '<td  class=" border border-1 border-black bg-slate-200 pl-2 text-left"></td>';
                            else if ($j != 2)
                                echo '<td style="width:80px" class="text-center border border-1 border-black"></td>';

                        }
                        ?>
                    </tr>
                    <tr style="height: 40px !important;">
                        <td colspan="2" class=" border border-1 border-black bg-slate-200 pl-2 text-left"></td>
                        <td class=" border border-1 border-black bg-slate-200 pl-2 text-left text-sm font-bold">
                            Cashflow
                        </td>

                        <?php

                        for ($j = 0; $j < $financells; $j++) {
                            echo '<td id="cellfincash_' . $j . '" style="width:80px" class="text-center border border-1 border-black"></td>';

                        }
                        ?>
                    </tr>
                    <tr style="height: 40px !important;">
                        <td colspan="2" class=" border border-1 border-black bg-slate-200 pl-2 text-left"></td>
                        <td class=" border border-1 border-black bg-slate-200 pl-2 text-left text-sm font-bold">
                            Cum-Cashflow
                        </td>

                        <?php

                        for ($j = 0; $j < $financells; $j++) {
                            echo '<td id="cellfincashcum1_' . $j . '" style="width:80px" class="text-center border border-1 border-black"></td>';

                        }
                        ?>
                    </tr>
                    <tr style="height: 40px !important;">
                        <td colspan="2" class=" border border-1 border-black bg-slate-200 pl-2 text-left"></td>
                        <td class=" border border-1 border-black bg-slate-200 pl-2 text-left text-sm font-bold"></td>

                        <?php

                        for ($j = 0; $j < $financells; $j++) {
                            echo '<td id="cellfincashcum2_' . $j . '" style="width:80px" class="text-center border border-1 border-black"></td>';

                        }
                        ?>
                    </tr>

                    <?php
                    $par21 = ["Manufacturing period (month)", "Transportation to Iran (month)", "Delay for production", "Contract Time", "Client delayed payment", "Total"
                    ];
                    $par22 = ["Foreign Parts(100%)", "Processing Cost", "O/H", "Transport  to site", "Client Downpayment", "Client Last payment"
                    ];
                    for ($i = 0; $i < count($par21); $i++) {
                        ?>
                        <tr>
                            <?php
                            if ($i == 0) {
                                ?>
                                <td rowspan="10"
                                    class=" text-center border border-1 border-black  font-bold bg-red-300">Foreign
                                    Accessories
                                </td>
                                <?php
                            }
                            ?>
                            <td class=" border border-1 border-black bg-slate-200 text-left pl-2"><?= $par21[$i] ?></td>
                            <td style="width:50px"
                                class="text-center border border-1 border-black bg-slate-200"><textarea
                                        style="padding-left: 0px !important;padding-right: 0px !important;" rows="1"
                                        id="fin_for_1_<?= $i ?>" <?= $i >= 3 ? 'readonly' : '' ?>
                      dir="auto"
                                        class="h-full w-full overflow-hidden resize-none bg-transparent text-center text-black
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $i == 0 ? '2' : ($i == 1 ? '0.5' : ($i == 2 ? '2.5' : ($i == 3 ? '4' : ($i == 4 ? '2' : '11')))) ?></textarea>
                            </td>


                            <td class=" border border-1 border-black bg-slate-200 pl-2 text-left"><?= $par22[$i] ?></td>
                            <?php

                            for ($j = 0; $j < $financells; $j++) {
                                ?>
                                <td id="cell_fin_for_<?= $i . "_" . $j ?>" style="width:80px"
                                    class="text-center border border-1 border-black"></td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr style="height: 40px !important;">
                        <?php

                        for ($j = 1; $j < $financells + 4; $j++) {
                            if ($j == 1)
                                echo '<td colspan="2" class=" border border-1 border-black bg-slate-200 pl-2 text-left"></td>';
                            else if ($j == 3)
                                echo '<td  class=" border border-1 border-black bg-slate-200 pl-2 text-left"></td>';
                            else if ($j != 2)
                                echo '<td style="width:80px" class="text-center border border-1 border-black"></td>';

                        }
                        ?>
                    </tr>
                    <tr style="height: 40px !important;">
                        <td colspan="2" class=" border border-1 border-black bg-slate-200 pl-2 text-left"></td>
                        <td class=" border border-1 border-black bg-slate-200 pl-2 text-left text-sm font-bold">
                            Cashflow
                        </td>

                        <?php

                        for ($j = 0; $j < $financells; $j++) {
                            echo '<td id="cellfin_forcash_' . $j . '" style="width:80px" class="text-center border border-1 border-black"></td>';

                        }
                        ?>
                    </tr>
                    <tr style="height: 40px !important;">
                        <td colspan="2" class=" border border-1 border-black bg-slate-200 pl-2 text-left"></td>
                        <td class=" border border-1 border-black bg-slate-200 pl-2 text-left text-sm font-bold">
                            Cum-Cashflow
                        </td>

                        <?php

                        for ($j = 0; $j < $financells; $j++) {
                            echo '<td id="cellfin_forcashcum1_' . $j . '" style="width:80px" class="text-center border border-1 border-black"></td>';

                        }
                        ?>
                    </tr>
                    <tr style="height: 40px !important;">
                        <td colspan="2" class=" border border-1 border-black bg-slate-200 pl-2 text-left"></td>
                        <td class=" border border-1 border-black bg-slate-200 pl-2 text-left text-sm font-bold"></td>

                        <?php

                        for ($j = 0; $j < $financells; $j++) {
                            echo '<td id="cellfin_forcashcum2_' . $j . '" style="width:80px" class="text-center border border-1 border-black"></td>';

                        }
                        ?>
                    </tr>
                    <?php
                    $par31 = ["Client downpayment", "MIC downpayment", "installments", "Contract Time", "Client delayed payment"
                    ];
                    $par32 = ["MIC Payment", "Processing Cost", "O/H", "Client downpayment", "Client Last payment"
                    ];
                    ?>
                    <?php
                    for ($i = 0; $i < count($par31); $i++) {
                        ?>
                        <tr>
                            <?php
                            if ($i == 0) {
                                ?>
                                <td rowspan="10"
                                    class=" text-center border border-1 border-black text-white font-bold bg-this-teal">
                                    VCB
                                </td>
                                <?php
                            }
                            ?>
                            <td class=" border border-1 border-black bg-slate-200 text-left pl-2"><?= $par31[$i] ?></td>
                            <td style="width:50px"
                                class="text-center border border-1 border-black bg-slate-200"><textarea
                                        style="padding-left: 0px !important;padding-right: 0px !important;" rows="1"
                                        id="fin_vcb_1_<?= $i ?>" <?= $i == 0 || $i == 3 || $i == 4 ? 'readonly' : '' ?>
                               dir="auto"
                                        class="h-full w-full overflow-hidden resize-none bg-transparent text-center text-black
                                       pt-0 pb-1.5 font-sans text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?= $i == 0 ? '50%' : ($i == 1 ? '50%' : ($i == 2 ? '4' : ($i == 3 ? '4' : ($i == 4 ? '2' : '10')))) ?></textarea>
                            </td>


                            <td class=" border border-1 border-black bg-slate-200 pl-2 text-left"><?= $par32[$i] ?></td>
                            <?php

                            for ($j = 0; $j < $financells; $j++) {
                                ?>
                                <td id="cellfin_vcb_<?= $i . "_" . $j ?>" style="width:80px"
                                    class="text-center border border-1 border-black"></td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr style="height: 40px !important;">

                        <td class=" border border-1 border-black bg-slate-200 text-left pl-2">Total</td>
                        <td id="fin_vcb_1_total" style="width:50px"
                            class="text-center border border-1 border-black bg-slate-200"></td>


                        <td class=" border border-1 border-black bg-slate-200 pl-2 text-left"></td>
                        <?php

                        for ($j = 0; $j < $financells; $j++) {
                            ?>
                            <td style="width:80px" class="text-center border border-1 border-black"></td>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr style="height: 40px !important;">
                        <?php

                        for ($j = 1; $j < $financells + 4; $j++) {
                            if ($j == 1)
                                echo '<td colspan="2" class=" border border-1 border-black bg-slate-200 pl-2 text-left"></td>';
                            else if ($j == 3)
                                echo '<td  class=" border border-1 border-black bg-slate-200 pl-2 text-left"></td>';
                            else if ($j != 2)
                                echo '<td style="width:80px" class="text-center border border-1 border-black"></td>';

                        }
                        ?>
                    </tr>
                    <tr style="height: 40px !important;">
                        <td colspan="2" class=" border border-1 border-black bg-slate-200 pl-2 text-left"></td>
                        <td class=" border border-1 border-black bg-slate-200 pl-2 text-left text-sm font-bold">
                            Cashflow
                        </td>

                        <?php

                        for ($j = 0; $j < $financells; $j++) {
                            echo '<td id="cellfin_vcbcash_' . $j . '" style="width:80px" class="text-center border border-1 border-black"></td>';

                        }
                        ?>
                    </tr>
                    <tr style="height: 40px !important;">
                        <td colspan="2" class=" border border-1 border-black bg-slate-200 pl-2 text-left"></td>
                        <td class=" border border-1 border-black bg-slate-200 pl-2 text-left text-sm font-bold">
                            Cum-Cashflow
                        </td>

                        <?php

                        for ($j = 0; $j < $financells; $j++) {
                            echo '<td id="cellfin_vcbcashcum1_' . $j . '" style="width:80px" class="text-center border border-1 border-black"></td>';

                        }
                        ?>
                    </tr>
                    <tr style="height: 40px !important;">
                        <td colspan="2" class=" border border-1 border-black bg-slate-200 pl-2 text-left"></td>
                        <td class=" border border-1 border-black bg-slate-200 pl-2 text-left text-sm font-bold"></td>

                        <?php

                        for ($j = 0; $j < $financells; $j++) {
                            echo '<td id="cellfin_vcbcashcum2_' . $j . '" style="width:80px" class="text-center border border-1 border-black"></td>';

                        }
                        ?>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br/>
            <br/>
            <br/>

        </div>
    </div>
</div>
<?php
$this->includeFile('layouts/partials/back-to-top');
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/eas.js'); ?>"></script>
