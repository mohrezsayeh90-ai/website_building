<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
global $flashMessage;
?>
<style>
    *[dir=rtl] table.dataTable thead th, *[dir=rtl] {
        text-align: center;
    }

    .box {
        opacity: 1.0;
        transition: all 0.8s ease-in-out;
        visibility: visible;
    }

    .hide {
        visibility: hidden;
        transition: all 0.8s ease-in-out;
        opacity: 0.0;
    }
</style>


<!-- Modal Overlay -->
<div id="modalOverlay" class="fixed inset-0 bg-black/50 opacity-0 pointer-events-none flex items-center justify-center
          transition-opacity duration-300 z-50">
    <!-- Modal -->
    <div id="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" aria-describedby="modalDesc"
         class="bg-white max-w-lg w-[90%] md:w-2/3 lg:w-1/2 rounded-2xl shadow-2xl transform scale-95 opacity-0 transition-all overflow-y-auto
         max-h-[600px]  duration-300">
        <!-- Header -->
        <div class="flex items-start justify-between p-6 border-b">
            <div>
                <h2 id="modalTitle" class="text-xl font-semibold text-gray-800">فهرست نسخ DPL</h2>
                <p id="modalDesc" class="text-sm text-gray-500 mt-1">توضیح کوتاه دربارهٔ محتوای مدال.</p>
            </div>
            <button id="closeModalBtn" class="text-gray-500 hover:text-gray-800 rounded-full p-2 focus:outline-none"
                    aria-label="بستن مدال">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M10 8.586L15.293 3.293a1 1 0 011.414 1.414L11.414 10l5.293 5.293a1 1 0 01-1.414 1.414L10 11.414l-5.293 5.293a1 1 0 01-1.414-1.414L8.586 10 3.293 4.707A1 1 0 014.707 3.293L10 8.586z"
                          clip-rule="evenodd"/>
                </svg>
            </button>
        </div>

        <!-- Body -->
        <div class="p-6 space-y-4">
            <ul id="modalBody" class="space-y-3">
                <!--                <li class="p-4 bg-white shadow-md rounded-lg hover:shadow-lg transition">-->
                <!--                    مورد اول-->
                <!--                </li>-->
                <!--                <li class="p-4 bg-white shadow-md rounded-lg hover:shadow-lg transition">-->
                <!--                    مورد دوم-->
                <!--                </li>-->
                <!--                <li class="p-4 bg-white shadow-md rounded-lg hover:shadow-lg transition">-->
                <!--                    مورد سوم-->
                <!--                </li>-->
            </ul>
        </div>

    </div>
</div>
<div class="pb-0">
    <div id="DCCForm"
         style="width:90vw;height:90vh;margin: auto !important;top:50%;left:50%;transform: translate(-50%, -50%); background-color: mintcream"
         class="box hide absolute z-50  overflow-y-scroll  rounded border-1 p-3">
        <div style="margin-top:-10px;color: black" class="text-xl  w-full">
            <i onclick="closeMe()" class="fa fa-close hover:scale-150 float-end"></i>
        </div>
        <br/>
        <h1 class="text-center text-lg w-full p-1 bg-indigo-200 text-black">سیستم کنترل اسناد</h1>

        <div style="height:80vh" class="overflow-x-scroll overflow-y-scroll w-full  mt-5 lg:mt-0 p-1 bg-white border border-gray-300 rounded-lg shadow shadow-indigo-500/50
         dark:bg-gray-800 dark:border-gray-700">
            <iframe id="innerFrame" style="display: block;width:100%;height:100%" src=""></iframe>
        </div>
    </div>
    <p class="text-center my-4 text-2xl">فهرست پروژه ها</p>
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
                    <th style="width:300px !important" scope="col" class="px-6 py-3">
                        عملیات
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                // print_r($incompleteProj);
                foreach ($incompleteProj as $key => $incProj) {
                    ?>

                    <tr class="<?= $incProj['danger'] == 0 ? 'odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800' : 'bg-red-300' ?>  border-b dark:border-gray-700">
                        <td scope="row" class="px-6 py-0 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $key + 1 ?>
                            <?php
                            if ($incProj['proj_status'] == 1 && isset($_SESSION['admin'])) {
                                ?>
                                <button onclick="reverseProject('<?= $incProj['proj_code'] ?>')"
                                        data-tooltip-target="proj_reverse_<?= $key ?>" style="color: red">
                                    <i class="fa fa-exclamation-triangle animate-bounce"></i></button>
                                <?php
                            }
                            ?>
                        </td>
                        <td class="px-6 py-0">
                            <div class="flex flex-row m-1">
                                <button onclick="window.open('<?= Base_Url . '/prjman/modalShow/?prgCode=' . $incProj['proj_code'] ?>','_blank')"
                                        class="text-slate-500 float-end font-medium mt-0 text-center" type="button">
                                    <!---->
                                    <!--                                            <span data-modal-target="crud-modal_-->
                                    <?php //=$key?><!--" data-modal-toggle="crud-modal_--><?php //=$key?><!--"-->
                                    <!--                                                  data-tooltip-target="proj_t11_-->
                                    <?php //= $key ?><!--"  class="hover:text-gray-900 cursor-pointer bg-slate-500 text-white border border-gray-300 p-1 rounded-lg-->
                                    <!--                                    focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100-->
                                    <!--                                    text-xs dark:bg-gray-800 dark:text-white-->
                                    <!--                                    dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">BPM</span>-->
                                    <span class="hover:text-gray-900 cursor-pointer bg-slate-500 text-white border border-gray-300 p-1 rounded-lg
                                    focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100
                                    text-xs dark:bg-gray-800 dark:text-white
                                    dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">BPM</span>
                                </button>
                                <?= $incProj['proj_code'] ?>
                            </div>
                        </td>
                        <td class="px-6 py-0 text-center text-wrap text-xs"
                        ">
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

                                <button class="text-slate-500 float-end font-medium mt-0 text-center" type="button">

                                            <span onclick="showProjectLOG('<?= $incProj['proj_code'] ?>','<?= $incProj['proj_name'] ?>')"
                                                  data-tooltip-target="proj_t12_<?= $key ?>" class="hover:text-gray-900 cursor-pointer bg-slate-500 text-white border border-gray-300 p-1 rounded-lg
                                    focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100
                                    text-xs dark:bg-gray-800 dark:text-white
                                    dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">LOG</span>
                                </button>
                                <?= $incProj['proj_start_date'] ?>
                            </div>

                        </td>
                        <td class="px-6 py-0">
                            <?= $incProj['proj_duration'] ?>

                        </td>
                        <td class="px-6 py-0">
                            <div class="mb-1 text-base bg-zinc-100 font-medium dark:text-blue-500 py-0">

                                <span id="prjprg_<?= $key ?>"
                                      class="px-2 text-blue-700"><?= $incProj['proj_physical_progress'] ?>%</span>
                                <span class="float-start"><i data-tooltip-target="proj_t2_<?= $key ?>"
                                                             class="text-slate-500 ml-2 fa fa-bar-chart hover:scale-150"></i></span>
                                <div class="w-full bg-gray-300 rounded-full h-2.5 mt-1 dark:bg-gray-700">
                                    <div class="bg-blue-600 h-2.5 rounded-full"
                                         style="width: <?= $incProj['proj_physical_progress'] ?>%"></div>

                                </div>
                            </div>

                        </td>
                        <td class="px-6 py-0 text-center w-fit text-xs">
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
                                case 9:
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

                        <td style="width:fit-content !important;" class="px-6 py-0 ">
                            <div style="width:195px !important;"
                                 class="ltr flex flex-row relative border-t border-b bg-slate-100 left-0 float-left">
                                <button class="text-white mr-2 float-end
                        font-medium text-xs bg-slate-400 rounded-lg p-1
                                                     text-center hover:scale-150"><i
                                            onclick="openDCCForm('<?= substr($incProj['proj_code'], 0, 7) ?>','<?= $incProj['proj_name'] ?>')"
                                            data-tooltip-target="proj_tdcc10_<?= $key ?>"
                                            class="">DCC</i></button>
                                <div id="proj_tdcc10_<?= $key ?>" role="tooltip"
                                     class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    مرکز کنترل اسناد
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                <div>
                                    <button <?= $incProj['proj_status'] > 0 ? 'disabled' :
                                            ((in_array($_SESSION["tim"], array(500, 507, 509)) || isset($_SESSION['admin'])) ? '' : 'disabled') ?>
                                            onclick="assignTender('<?= $incProj['proj_code'] ?>')"
                                            class="text-slate-500 mr-2
                        font-medium text-2xl
                                                     text-center  <?= $incProj['proj_status'] == 0 && (in_array($_SESSION["tim"], array(500, 507, 509)) || isset($_SESSION['admin']))
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
                                    <button class="text-slate-500 mr-2
                        font-medium text-2xl
                                                     text-center hover:scale-150"><a
                                                data-tooltip-target="proj_t40_<?= $key ?>" class="fa fa-edit"
                                                href="/mehrabad/project/editp/?p=<?= $incProj['proj_code'] ?>"></a>
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
                                    <?php
                                    if ($incProj['proj_dplv_cnt'][0] <= 1) {
                                        ?>
                                        <button <?= $incProj['proj_status'] < 8 ? 'disabled' : ((in_array($_SESSION["tim"], array(500, 507)) || isset($_SESSION['admin'])) ? '' : 'disabled') ?>
                                                onclick="window.open(url('prjman/dpl/?p=<?= $incProj['proj_code'] ?>'),'_self')"
                                                class="text-slate-500 mr-2
                        font-medium mt-1
                                                     text-center  <?= $incProj['proj_status'] >= 8 && (in_array($_SESSION["tim"], array(500, 507)) || isset($_SESSION['admin']))
                                                        ? 'hover:scale-125' : '' ?> ">
                                    <span class="hover:text-gray-900 bg-slate-500 text-white border border-gray-300 p-1 rounded-lg
                                    focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100
                                    text-xs dark:bg-gray-800 dark:text-white
                                    dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">DPL</span>
                                        </button>
                                        <?php
                                    } else {
                                        ?>
                                        <button <?= $incProj['proj_status'] < 8 ? 'disabled' : ((in_array($_SESSION["tim"], array(500, 507))
                                                || isset($_SESSION['admin'])) ? '' : 'disabled') ?>
                                                onclick='openModal("<?= $incProj['proj_code'] ?>" , "<?= $incProj['proj_name'] ?>",
                                                <?= json_encode($incProj['proj_dplv_cnt'][1]) ?>)'
                                                class="text-slate-500 mr-2 text-lg
                        font-medium
                                                     text-center  <?= $incProj['proj_status'] >= 8 &&
                                                (in_array($_SESSION["tim"], array(500, 507)) || isset($_SESSION['admin']))
                                                        ? 'hover:scale-125' : '' ?> ">
                                    <span title="DPL Versions" class="fa fa-copy hover:text-gray-900 bg-slate-500 text-white border border-gray-300 p-1 rounded-lg
                                    focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100
                                    text-xs dark:bg-gray-800 dark:text-white
                                    dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 "></span>
                                        </button>
                                        <?php
                                    } ?>
                                </div>

                                <div>
                                    <button class="text-slate-500 mr-2 float-end
                        font-medium text-2xl
                                                     text-center hover:scale-150"><i
                                                onclick="openDocContainer('<?= $incProj['proj_code'] ?>','<?= $incProj['proj_name'] ?>')"
                                                data-tooltip-target="proj_t10_<?= $key ?>"
                                                class="fa fa-file-text"></i></button>

                                </div>
                                <div>
                                    <button class=" mr-2 text-red-200 float-end
                                                     font-medium text-2xl
                                                     text-center hover:scale-150"><i
                                                onclick="closePrj('<?= $incProj['proj_code'] ?>',<?= $key ?>)"
                                                data-tooltip-target="proj_t3_<?= $key ?>"
                                                class="fa fa-close"></i></button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <div id="proj_reverse_<?= $key ?>" role="tooltip"
                         class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        برگردان استخراج پروژه
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
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
                    <div id="proj_t40_<?= $key ?>" role="tooltip"
                         class="absolute z-50  invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        ویرایش مشخصات کلی پروژه
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
        <div class="container">
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

                                <button class="text-slate-500 float-end font-medium mt-0 text-center" type="button">

                                            <span onclick="showProjectLOG('<?= $incProj['proj_code'] ?>','<?= $incProj['proj_name'] ?>')"
                                                  data-tooltip-target="proj_t121_<?= $key ?>" class="hover:text-gray-900 cursor-pointer bg-slate-500 text-white border border-gray-300 p-1 rounded-lg
                                    focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100
                                    text-xs dark:bg-gray-800 dark:text-white
                                    dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">LOG</span>
                                </button>
                                <?= $incProj['proj_start_date'] ?>
                            </div>

                        </td>
                        <td class="px-6 py-0">
                            <?= $incProj['proj_duration'] ?>

                        </td>
                        <td class="px-6 py-0">
                            <div class="mb-1 text-base bg-zinc-100 font-medium dark:text-blue-500 py-0">

                                <span id="prjprg1_<?= $key ?>"
                                      class="px-2 text-blue-700"><?= $incProj['proj_physical_progress'] ?>%</span>
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
                                case 9:
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

                        <td style="width:80px !important;" class=" px-6 py-0 ">
                            <div style="width:100px !important;"
                                 class="ltr flex flex-row relative border-t border-b bg-slate-100 left-0 float-left">

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
//// print_r($incompleteProj);
//foreach ($incompleteProj as $key => $incProj) {
//?>
<!--<div id="crud-modal_--><?php //=$key?><!--" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden-->
<!--                        fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">-->
<!--    <iframe style="width:1600px;height:700px !important;" class="relative overflow-x-auto" src="--><?php //=Base_Url.'/prjman/modalShow/?prgCode='.$incProj['proj_code']?><!--"></iframe>-->
<!--</div>-->
<?php
//}
//?>
<?php
$this->includeFile('layouts/partials/back-to-top');
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?= $this->asset('js/allProjects.js') ?>"></script>
<script>
    $(`i[id^="pm_"`).on("click", (e) => {
        let headcnt = e.target.id.split("_")[1];
        $(`.hclass_${headcnt}`).toggleClass("hidden");
        $(`#${e.target.id}`).toggleClass("fa-minus-square");
    })

    async function delBOM(prjcode) {
        Swal.fire({
            html: `<div><h4 class="text-right">آیا قصد حذف این BOM را دارید؟</h4>
</div>`,
            icon: "question",
            iconHtml: "؟",
            confirmButtonText: "بله",
            cancelButtonText: "خیر",
            showCancelButton: true,
            showCloseButton: true
        }).then(async (res) => {
            if (res.isConfirmed) {
                await $.ajax({
                    url: url('engineering/delBOM'),
                    method: "POST",
                    data: {
                        p: prjcode
                    }, dataType: "html"
                }).then(async (result) => {

                    await ToastPro('عملیات باموفقیت انجام شد!', 'top', 'success', 1)


                })
            }
        })
    }

    async function openDCCForm(p, pname) {
        // $('html, body').animate({         // انيميشن اسکرول
        //     scrollTop: 0                 // به بالاي صفحه برگردد
        // }, 600);
        let scrollElem = document.getElementsByClassName("my-vertical-scroll-div");
        scrollElem = scrollElem.length === 1 ? scrollElem[0] : scrollElem[1];
        scrollElem.scrollTop = 0;
        $(`#DCCForm`).toggleClass('hide')
        $(`#innerFrame`).attr('src', url('dcc/maindoc/?p=' + p))

    }

    async function closeMe() {
        $(`#DCCForm`).toggleClass('hide')
    }
</script>
<script>

    // const openBtn = document.getElementById('openModalBtn');
    const overlay = document.getElementById('modalOverlay');
    const modal = document.getElementById('modal');
    const closeBtn = document.getElementById('closeModalBtn');
    const cancelBtn = document.getElementById('cancelBtn');


    function getFocusableElements(container) {
        return Array.from(container.querySelectorAll('a[href], button:not([disabled]), textarea, input, select, [tabindex]:not([tabindex="-1"])'))
            .filter(el => !el.hasAttribute('disabled'));
    }

    let lastFocusedElement = null;

    function openModal(prjc = '', prjname = '', list = []) {
        lastFocusedElement = document.activeElement;
        $(`#modalDesc`).html(` پروژه ${prjname} `)
        //console.log(list)
        $(`#modalBody`).html('')
        list.forEach(element => {
            $(`#modalBody`).append(`<li class="text-blue-500 p-4 bg-white shadow-md rounded-lg hover:shadow-lg transition cursor-pointer">
                     <a onclick="window.open(url('prjman/dpl/?p=${element.prj_cod}'),'_self')"> ${element.document_no?element.document_no:element.prj_cod}</a>
                     </li>`)

        })

        overlay.classList.remove('opacity-0', 'pointer-events-none');
        overlay.classList.add('opacity-100');

        modal.classList.remove('scale-95', 'opacity-0');
        modal.classList.add('scale-100', 'opacity-100');


        document.documentElement.style.overflow = 'hidden';
        document.body.style.overflow = 'hidden';


        const focusables = getFocusableElements(modal);
        if (focusables.length) focusables[0].focus();


        document.addEventListener('keydown', handleKeyDown);
    }

    function closeModal() {

        overlay.classList.add('opacity-0');
        overlay.classList.remove('opacity-100');

        modal.classList.add('opacity-0', 'scale-95');
        modal.classList.remove('opacity-100', 'scale-100');


        setTimeout(() => {
            overlay.classList.add('pointer-events-none');
            // بازیابی scroll صفحه
            document.documentElement.style.overflow = '';
            document.body.style.overflow = '';
        }, 300);

        // remove key event
        document.removeEventListener('keydown', handleKeyDown);

        // restore focus
        if (lastFocusedElement) lastFocusedElement.focus();
    }


    overlay.addEventListener('click', (e) => {
        if (!modal.contains(e.target)) {
            closeModal();
        }
    });


    // openBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);


    document.getElementById('modalForm').addEventListener('submit', function (e) {
        e.preventDefault();
        alert('فرم ارسال شد (نمونه)');
        closeModal();
    });

    // مدیریت کلیدها (Esc و Tab focus trap)
    function handleKeyDown(e) {
        if (e.key === 'Escape') {
            closeModal();
        }

        if (e.key === 'Tab') {
            const focusables = getFocusableElements(modal);
            if (!focusables.length) {
                e.preventDefault();
                return;
            }
            const first = focusables[0];
            const last = focusables[focusables.length - 1];
            if (e.shiftKey) {
                // shift + tab
                if (document.activeElement === first) {
                    e.preventDefault();
                    last.focus();
                }
            } else {
                // tab
                if (document.activeElement === last) {
                    e.preventDefault();
                    first.focus();
                }
            }
        }
    }
</script>