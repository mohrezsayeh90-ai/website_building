<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
global $flashMessage;
?>
<style>
    *[dir=rtl] table.dataTable thead th, *[dir=rtl]  {
        text-align: center ;
    }
</style>
    <div class="pb-0">
        <div class="border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center mt-3" id="default-styled-tab"
                data-tabs-toggle="#default-styled-tab-content"
                data-tabs-active-classes="text-purple-600"
                data-tabs-inactive-classes="dark:border-transparent text-this-gray hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="current-project-tab"
                            data-tabs-target="#current-project" type="button" role="tab" aria-controls="project"
                            aria-selected="false">پروژه های در جریان
                    </button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="completed-project-tab" data-tabs-target="#completed-project" type="button" role="tab"
                            aria-controls="completed" aria-selected="false">پروژه های تکمیل شده
                    </button>
                </li>

            </ul>
        </div>
        <div class="hidden p-4 rounded-lg dark:bg-gray-800" id="current-project" role="tabpanel"
             aria-labelledby="current-project-tab">

            <div class="container">

                <table id="myDPL" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="uppercase text-md dark:bg-gray-700 dark:text-gray-400 bg-this-teal text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ردیف
                        </th>
                        <th scope="col" class="px-6 py-3">
                            کد قرارداد

                        </th>
                        <th scope="col" class="px-6 py-3">
                            شرح پروژه
                        </th>
                        <th scope="col" class="px-6 py-3">
                            مدیر پروژه
                        </th>
                        <th scope="col" class="px-6 py-3">
                            کارفرما
                        </th>
                        <th scope="col" class="px-6 py-3">
                            تاریخ شروع پروژه
                        </th>
                        <th scope="col" class="px-6 py-3">
                            مدت زمان اجرا
                        </th>
                        <th scope="col" class="px-6 py-3">
                            میزان پیشرفت
                        </th>
                        <th scope="col" class="px-6 py-3">
                            وضعیت پروژه
                        </th>
                        <th scope="col" class="px-6 py-3">
                            عملیات
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // print_r($incompl eteProj);
                    foreach ($incompleteProj as $key => $incProj) {
                        ?>

                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td scope="row" class="px-6 py-0 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= $key + 1 ?>
                            </td>
                            <td class="px-6 py-0">
                               <div class="flex flex-row m-1">
                                <button  class="text-slate-500 float-end font-medium mt-0 text-center" type="button">

                                            <span data-modal-target="crud-modal_<?=$key?>" data-modal-toggle="crud-modal_<?=$key?>"
                                                  data-tooltip-target="proj_t11_<?= $key ?>"  class="hover:text-gray-900 cursor-pointer bg-slate-500 text-white border border-gray-300 p-1 rounded-lg
                                    focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100
                                    text-xs dark:bg-gray-800 dark:text-white
                                    dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">BPM</span></button>
                                   <?= $incProj['proj_code'] ?>
                               </div>
                            </td>
                            <td style="width:150px !important;" class="px-6 py-0">
                                <?= $incProj['proj_name'] ?>
                            </td>
                            <td class="px-6 py-0 text-center">
                                <?= $incProj['proj_manager'] ?>
                            </td>
                            <td class="px-6 py-0 text-center">
                                <?= $incProj['proj_executer'] ?>
                            </td>
                            <td style="width:60px !important;" class="px-6 py-0">
                                <div class="flex flex-row m-1 float-left">

                                    <button  class="text-slate-500 float-end font-medium mt-0 text-center" type="button">

                                            <span onclick="showProjectLOG('<?= $incProj['proj_code'] ?>','<?= $incProj['proj_name'] ?>')"
                                                  data-tooltip-target="proj_t12_<?= $key ?>"  class="hover:text-gray-900 cursor-pointer bg-slate-500 text-white border border-gray-300 p-1 rounded-lg
                                    focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100
                                    text-xs dark:bg-gray-800 dark:text-white
                                    dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">LOG</span></button>
                                    <?= $incProj['proj_start_date'] ?>
                                </div>

                            </td>
                            <td class="px-6 py-0">
                                <?= $incProj['proj_duration'] ?>

                            </td>
                            <td class="px-6 py-0">
                                <div class="mb-1 text-base bg-zinc-100 font-medium dark:text-blue-500 py-0">

                                    <span id="prjprg_<?= $key ?>" class="px-2 text-blue-700"><?= $incProj['proj_physical_progress'] ?>%</span>
                                    <span class="float-start"><i data-tooltip-target="proj_t2_<?= $key ?>"
                                                               class="text-slate-500 ml-2 fa fa-bar-chart hover:scale-150"></i></span>
                                    <div class="w-full bg-gray-300 rounded-full h-2.5 mt-1 dark:bg-gray-700">
                                        <div class="bg-blue-600 h-2.5 rounded-full"
                                             style="width: <?= $incProj['proj_physical_progress'] ?>%"></div>

                                    </div>
                                </div>

                            </td>
                            <td style="width:150px !important;" class="px-6 py-0 text-center">
                                <?php
                                switch ($incProj['proj_status']) {
                                    case 0:
                                        echo "ثبت مشخصات کلی";
                                        break;
                                    case 1:
                                        echo "استخراج داده از مناقصه" . " " . $incProj['proj_tender_code_default'] . ' و تکمیل شناسنامه پروژه';
                                        break;
                                    case 3:
                                        echo 'بررسی شناسنامه پروژه توسط دفتر';
                                        break;
                                    case 6:
                                        echo 'تکمیل اسناد EPL توسط مدیر پروژه';
                                        break;
                                    case 7:
                                        echo 'بررسی اسناد EPL توسط برنامه ریزی دفتر';
                                        break;
                                    case 8:
                                        echo 'تکمیل اسناد DPL توسط واحد مهندسی';
                                        break;
                                    case 10:
                                        echo 'در حال تایید نهایی اسناد DPL';
                                        break;
                                    case 12:
                                        echo 'تامین مواد اولیه و ساخت';
                                        break;
                                }
                                ?></p>
                            </td>

                            <td  style="width:150px !important;" class=" px-6 py-0 ">
                                <div style="width:195px !important;" class="ltr flex flex-row relative border-t border-b bg-slate-100 left-0 float-left">
                                    <div>
                                        <button <?= $incProj['proj_status'] > 0  ? 'disabled' :
                                            ((in_array($_SESSION["tim"],array(500,507)) || isset($_SESSION['admin']))?'':'disabled') ?>
                                                onclick="assignTender('<?= $incProj['proj_code'] ?>')"
                                                class="text-slate-500 mr-2
                        font-medium text-2xl
                                                     text-center  <?= $incProj['proj_status'] == 0 && (in_array($_SESSION["tim"],array(500,507)) || isset($_SESSION['admin']))
                                                    ? 'hover:scale-150' : '' ?> ">
                                            <i
                                                    data-tooltip-target="proj_t1_<?= $key ?>"
                                                    class="fa fa-cloud-download"></i>
                                        </button>
                                    </div>
                                    <div>
                                        <button class="text-slate-500 mr-2
                        font-medium text-2xl
                                                     text-center hover:scale-150"><a
                                                    data-tooltip-target="proj_t4_<?= $key ?>" class="fa fa-barcode"
                                                    href="/mehrabad/prjman/show/?p=<?= $incProj['proj_code'] ?>"></a>
                                        </button>
                                    </div>
                                    <div>
                                        <button <?= $incProj['proj_status'] < 6 ? 'disabled' : '' ?>
                                                onclick="window.open(url('prjman/epl/?p=<?= $incProj['proj_code'] ?>'),'_self')"
                                                class="text-slate-500 mr-2
                        font-medium mt-1
                                                     text-center  <?= $incProj['proj_status'] >= 6 ? 'hover:scale-125' : '' ?> ">
                                    <span class="hover:text-gray-900 bg-slate-500 text-white border border-gray-300 p-1 rounded-lg
                                    focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100
                                    text-xs dark:bg-gray-800 dark:text-white
                                    dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">EPL</span>
                                        </button>
                                    </div>

                                    <div>
                                        <button <?= $incProj['proj_status'] < 8 ? 'disabled' : '' ?>
                                                onclick="window.open(url('prjman/dpl/?p=<?= $incProj['proj_code'] ?>'),'_self')"
                                                class="text-slate-500 mr-2
                        font-medium mt-1
                                                     text-center  <?= $incProj['proj_status'] >= 8 ? 'hover:scale-125' : '' ?> ">
                                    <span class="hover:text-gray-900 bg-slate-500 text-white border border-gray-300 p-1 rounded-lg
                                    focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100
                                    text-xs dark:bg-gray-800 dark:text-white
                                    dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">DPL</span>
                                        </button>
                                    </div>

                                    <div>
                                        <button class="text-slate-500 mr-2 float-end
                        font-medium text-2xl
                                                     text-center hover:scale-150"><i
                                                    onclick="openDocContainer('<?= $incProj['proj_code'] ?>','<?= $incProj['proj_name'] ?>')"
                                                    data-tooltip-target="proj_t10_<?= $key ?>"
                                                    class="fa fa-file-text"></i></button>

                                    </div>
                                    <div> <button class=" mr-2 text-red-200 float-end
                                                     font-medium text-2xl
                                                     text-center hover:scale-150"><i
                                                    onclick="closePrj('<?= $incProj['proj_code'] ?>',<?= $key ?>)"
                                                    data-tooltip-target="proj_t3_<?= $key ?>"
                                                    class="fa fa-close"></i></button></div>
                                </div>
                            </td>
                        </tr>
                        <div id="proj_t12_<?= $key ?>" role="tooltip"
                             class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            رویت وقایع مرتبط با پروژه
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <div id="proj_t11_<?= $key ?>" role="tooltip"
                             class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            رویت اطلاعات مربوط به مدیریت فرآیندهای پروژه
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <div id="proj_t10_<?= $key ?>" role="tooltip"
                             class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            مدیریت اسناد پروژه
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <div id="proj_t1_<?= $key ?>" role="tooltip"
                             class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            تخصیص مناقصه و تکمیل مکانیزه داده ها
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <div id="proj_t2_<?= $key ?>" role="tooltip"
                             class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            ثبت میزان پیشرفت پروژه
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <div id="proj_t3_<?= $key ?>" role="tooltip"
                             class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            بستن پروژه
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <div id="proj_t4_<?= $key ?>" role="tooltip"
                             class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            شناسنامه پروژه
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <div id="proj_t5_<?= $key ?>" role="tooltip"
                             class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            EPL
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>

                        <?php
                    }
                    ?>

                    </tbody>
                </table>

            </div>
        </div>
        <div class="hidden p-4 rounded-lg dark:bg-gray-800" id="completed-project" role="tabpanel"
             aria-labelledby="completed-project-tab">
            <div class="container" >
                <table id="myDPL1" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="uppercase text-md dark:bg-gray-700 dark:text-gray-400 bg-this-teal text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ردیف
                        </th>
                        <th scope="col" class="px-6 py-3">
                            کد قرارداد

                        </th>
                        <th scope="col" class="px-6 py-3">
                            شرح پروژه
                        </th>
                        <th scope="col" class="px-6 py-3">
                            مدیر پروژه
                        </th>
                        <th scope="col" class="px-6 py-3">
                            کارفرما
                        </th>
                        <th scope="col" class="px-6 py-3">
                            تاریخ شروع پروژه
                        </th>
                        <th scope="col" class="px-6 py-3">
                            مدت زمان اجرا
                        </th>
                        <th scope="col" class="px-6 py-3">
                            میزان پیشرفت
                        </th>
                        <th scope="col" class="px-6 py-3">
                            وضعیت پروژه
                        </th>
                        <th scope="col" class="px-6 py-3">
                            عملیات
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // print_r($incompl eteProj);
                    foreach ($completeProj as $key => $incProj) {
                        ?>

                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td scope="row" class="px-6 py-0 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= $key + 1 ?>
                            </td>
                            <td class="px-6 py-0">
                                <div class="flex flex-row m-1">
                                    <?= $incProj['proj_code'] ?>
                                </div>
                            </td>
                            <td style="width:150px !important;" class="px-6 py-0">
                                <?= $incProj['proj_name'] ?>
                            </td>
                            <td class="px-6 py-0 text-center">
                                <?= $incProj['proj_manager'] ?>
                            </td>
                            <td class="px-6 py-0 text-center">
                                <?= $incProj['proj_executer'] ?>
                            </td>
                            <td style="width:60px !important;" class="px-6 py-0">
                                <div class="flex flex-row m-1 float-left">

                                    <button  class="text-slate-500 float-end font-medium mt-0 text-center" type="button">

                                            <span onclick="showProjectLOG('<?= $incProj['proj_code'] ?>','<?= $incProj['proj_name'] ?>')"
                                                  data-tooltip-target="proj_t121_<?= $key ?>"  class="hover:text-gray-900 cursor-pointer bg-slate-500 text-white border border-gray-300 p-1 rounded-lg
                                    focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100
                                    text-xs dark:bg-gray-800 dark:text-white
                                    dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">LOG</span></button>
                                    <?= $incProj['proj_start_date'] ?>
                                </div>

                            </td>
                            <td class="px-6 py-0">
                                <?= $incProj['proj_duration'] ?>

                            </td>
                            <td class="px-6 py-0">
                                <div class="mb-1 text-base bg-zinc-100 font-medium dark:text-blue-500 py-0">

                                    <span id="prjprg1_<?= $key ?>" class="px-2 text-blue-700"><?= $incProj['proj_physical_progress'] ?>%</span>
                                    <span class="float-start"><i data-tooltip-target="proj_t21_<?= $key ?>"
                                                                 class="text-slate-500 ml-2 fa fa-bar-chart hover:scale-150"></i></span>
                                    <div class="w-full bg-gray-300 rounded-full h-2.5 mt-1 dark:bg-gray-700">
                                        <div class="bg-blue-600 h-2.5 rounded-full"
                                             style="width: <?= $incProj['proj_physical_progress'] ?>%"></div>

                                    </div>
                                </div>

                            </td>
                            <td style="width:150px !important;" class="px-6 py-0 text-center">
                                <?php
                                switch ($incProj['proj_status']) {
                                    case 0:
                                        echo "ثبت مشخصات کلی";
                                        break;
                                    case 1:
                                        echo "استخراج داده از مناقصه" . " " . $incProj['proj_tender_code_default'] . ' و تکمیل شناسنامه پروژه';
                                        break;
                                    case 3:
                                        echo 'بررسی شناسنامه پروژه توسط دفتر';
                                        break;
                                    case 6:
                                        echo 'تکمیل اسناد EPL توسط مدیر پروژه';
                                        break;
                                    case 7:
                                        echo 'بررسی اسناد EPL توسط برنامه ریزی دفتر';
                                        break;
                                    case 8:
                                        echo 'تکمیل اسناد DPL توسط واحد مهندسی';
                                        break;
                                    case 10:
                                        echo 'در حال تایید نهایی اسناد DPL';
                                        break;
                                    case 12:
                                        echo 'تامین مواد اولیه و ساخت';
                                        break;
                                    case 100:
                                        echo 'بسته شده';
                                        break;
                                }
                                ?></p>
                            </td>

                            <td  style="width:80px !important;" class=" px-6 py-0 ">
                                <div style="width:100px !important;" class="ltr flex flex-row relative border-t border-b bg-slate-100 left-0 float-left">

                                    <div>
                                        <button class="text-slate-500 mr-2
                        font-medium text-2xl
                                                     text-center hover:scale-150"><a
                                                    data-tooltip-target="proj_t41_<?= $key ?>" class="fa fa-barcode"
                                                    href="/mehrabad/prjman/show/?p=<?= $incProj['proj_code'] ?>"></a>
                                        </button>
                                    </div>
                                    <div>
                                        <button <?= $incProj['proj_status'] < 6 ? 'disabled' : '' ?>
                                                onclick="window.open(url('prjman/epl/?p=<?= $incProj['proj_code'] ?>'),'_self')"
                                                class="text-slate-500 mr-2
                        font-medium mt-1
                                                     text-center  <?= $incProj['proj_status'] >= 6 ? 'hover:scale-125' : '' ?> ">
                                    <span class="hover:text-gray-900 bg-slate-500 text-white border border-gray-300 p-1 rounded-lg
                                    focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100
                                    text-xs dark:bg-gray-800 dark:text-white
                                    dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">EPL</span>
                                        </button>
                                    </div>

                                    <div>
                                        <button <?= $incProj['proj_status'] < 8 ? 'disabled' : '' ?>
                                                onclick="window.open(url('prjman/dpl/?p=<?= $incProj['proj_code'] ?>'),'_self')"
                                                class="text-slate-500 mr-2
                        font-medium mt-1
                                                     text-center  <?= $incProj['proj_status'] >= 8 ? 'hover:scale-125' : '' ?> ">
                                    <span class="hover:text-gray-900 bg-slate-500 text-white border border-gray-300 p-1 rounded-lg
                                    focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100
                                    text-xs dark:bg-gray-800 dark:text-white
                                    dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">DPL</span>
                                        </button>
                                    </div>

                                    <div>
                                        <button class="text-slate-500 mr-2 float-end
                        font-medium text-2xl
                                                     text-center hover:scale-150"><i
                                                    onclick="openDocContainer('<?= $incProj['proj_code'] ?>','<?= $incProj['proj_name'] ?>')"
                                                    data-tooltip-target="proj_t101_<?= $key ?>"
                                                    class="fa fa-file-text"></i></button>

                                    </div>

                                </div>
                            </td>
                        </tr>
                        <div id="proj_t121_<?= $key ?>" role="tooltip"
                             class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            رویت وقایع مرتبط با پروژه
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <div id="proj_t111_<?= $key ?>" role="tooltip"
                             class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            رویت اطلاعات مربوط به مدیریت فرآیندهای پروژه
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <div id="proj_t101_<?= $key ?>" role="tooltip"
                             class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            مدیریت اسناد پروژه
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <div id="proj_t11_<?= $key ?>" role="tooltip"
                             class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            تخصیص مناقصه و تکمیل مکانیزه داده ها
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <div id="proj_t21_<?= $key ?>" role="tooltip"
                             class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            ثبت میزان پیشرفت پروژه
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <div id="proj_t31_<?= $key ?>" role="tooltip"
                             class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            بستن پروژه
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <div id="proj_t41_<?= $key ?>" role="tooltip"
                             class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            شناسنامه پروژه
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <div id="proj_t51_<?= $key ?>" role="tooltip"
                             class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            EPL
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>

                        <?php
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
        <div id="divTriggerTarget" style="display: none;overflow-y: scroll"
             class="absolute bottom-0 rounded-t-lg border-4 border-b-0 z-20 border-purple-500 bg-gray-50 w-full h-3/4 animate-wiggle">
            <button class="p-2 px-3 text-2xl" id="closeDivTrigger">
                <i class="fa fa-close text-purple-600 hover:text-purple-400"></i>
            </button>
            <div id="projectManager" class="w-full h-full"></div>
        </div>
        <button type="button" id="divTrigger"
                class="z-10 absolute p-1 bottom-5 right-10 hover:text-blue-200 text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 rounded-full
         hover:bg-gradient-to-br hover:from-purple-400 hover:via-purple-500 focus:ring-4 focus:outline-none w-10 h-10
        focus:ring-purple-300 dark:focus:ring-purple-800 font-medium text-sm shadow-sm text-center me-2 mb-2">
            <img src="<?= $this->asset('images/projects-icon.png') ?>" alt="آیکون پروژه">
        </button>
    </div>
<?php
// print_r($incompleteProj);
foreach ($incompleteProj as $key => $incProj) {
?>
<div id="crud-modal_<?=$key?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden
                        fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <iframe style="width:1600px;height:700px !important;" class="relative overflow-x-auto" src="<?=Base_Url.'/prjman/modalShow/?prgCode='.$incProj['proj_code']?>"></iframe>
</div>
<?php
}
?>
<?php
$this->includeFile('layouts/partials/back-to-top');
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?= $this->asset('js/allProjects.js') ?>"></script>
