<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
global $flashMessage;
?>
<style>
    *[dir=rtl] table.dataTable thead th, *[dir=rtl] table.dataTable thead td, *[dir=rtl] table.dataTable tfoot th, *[dir=rtl] table.dataTable tfoot td {
        text-align: center ;
    }
</style>
<div class="p-2 pb-0">
    <section>
        <div class="container">
            <p class="text-2xl text-center mt-2">استعلامات و مناقصات</p>
            <div class="inline-flex w-32 items-center justify-between">
                <button id="dropdownRadioButton" data-dropdown-toggle="dropdownDefaultRadio" class="bg-zinc-200 hover:bg-zinc-300 focus:ring-2
             focus:outline-none focus:ring-zinc-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600
             dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Filter
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <i class="fa fa-close text-xl text-red-600 hover:text-2xl" id="removeFilter" style="display: none"></i>
            </div>


            <!-- Dropdown menu -->
            <div id="dropdownDefaultRadio"
                 class="z-10 hidden w-fit bg-white rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600 p-3">
                <input type="text" class="text-end border border-gray-200 rounded block
                                      text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0" id="startDate" placeholder="Start Date:14030207"/>
                <input type="text" class="text-end border border-gray-200 rounded block my-3
                                      text-sm font-normal outline-0 placeholder-shown:border-blue-gray-200
                                       focus:border-0 focus:ring-teal-400 focus:ring-2
                                       focus:outline-0" id="endDate" placeholder="End Date:14040207"/>
                <div  class="inline-flex items-center">
                    <input id="startDateRadio" type="radio" value="1" name="date-radio" checked
                           class="w-4 h-4 ml-1 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">

                        <label for="startDateRadio" class="me-2 text-sm font-medium text-gray-900 dark:text-gray-300">تاریخ
                            تنظیم</label>
                </div>

                <div class="inline-flex items-center">
                    <input id="endDateRadio" type="radio" value="2" name="date-radio"
                           class="w-4 h-4 ml-1 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">

                        <label for="endDateRadio" class="me-2 text-sm font-medium text-gray-900 dark:text-gray-300">تاریخ
                            تکمیل</label>
                </div>

            </div>

            <table id="tenderTable" class="w-full ltr text-left rtl:text-right text-this-gray dark:text-gray-400 mt-7">
                <thead class="uppercase text-md dark:bg-gray-700 dark:text-gray-400 bg-this-teal text-white">
                <tr>
                    <th scope="col" class="px-6 py-1 text-center">عملیات</th>
                    <th scope="col" class="px-6 py-3 text-center">EAS</th>
                    <th scope="col" class="px-6 py-3 text-center">EPL</th>
                    <th scope="col" class="px-6 py-3 text-center">اضافه کردن محصول</th>
                    <th scope="col" class="px-6 py-3 text-end">تاریخ تکمیل</th>
                    <th scope="col" class="px-6 py-3 text-end">وضعیت</th>
                    <th scope="col" class="px-6 py-3 text-end">کارفرما</th>
                    <th scope="col" class="px-6 py-3 text-end">تاریخ</th>
                    <th scope="col" class="px-6 py-3 text-end">کد</th>
                    <th scope="col" class="px-6 py-3 text-end">شرح مناقصه</th>
                    <th scope="col" class="px-6 py-3 text-end">شناسه</th>
                </tr>
                </thead>
                <tbody  class="text-sm">
                <!--<input class="w-full bg-transparent border-0 focus:ring-0" data-jdp type="text" name="date"
                                       autocomplete="off"/>-->
                <?php foreach ($all as $key => $item) { ?>
                    <tr class="<?php echo $key % 2 ? "bg-zinc-100" : "bg-zinc-200" ?> border-b dark:bg-gray-800 dark:border-gray-700
                    hover:bg-zinc-400 dark:hover:bg-gray-600 text-end">
                        <td class="pl-1 py-2">
                            <div class="flex w-full justify-evenly text-3xl">
                                <button onclick="loseTender('<?= $item["code"] ?>')" <?= $item['status'] >= 100 || $item['status'] < 2 ? 'disabled' : '' ?>
                                        type="button" class=" text-red-700 border
                                border-red-700 bg-red-800 focus:ring-4
                                focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center me-2 mb-2 dark:border-red-500
                                dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                    <img src="<?= $this->asset('images/lose.png') ?>" class="w-7 h-7"
                                         alt="loser icon"/>
                                </button>
                                <button onclick="winTender('<?= $item["code"] ?>')" <?= $item['status'] >= 100 || $item['status'] < 2 ? 'disabled' : '' ?>
                                        type="button" class=" text-green-700 border
                                border-green-700 bg-green-800 focus:ring-2
                            focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-1 text-center me-2 mb-2
                            dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
                                    <img src="<?= $this->asset('images/win.png') ?>" class="w-7 h-7"
                                         alt="winner icon"/>
                                </button>
                                <i onclick="showDocuments('<?= $item["code"] ?>')"
                                   id="seeDocuments<?= $item["code"] ?>"
                                   data-tooltip-target="tender_asnad<?=$key?>" class="cursor-pointer mt-1 float-end fa fa-download
                    h-auto relative z-0 rounded-lg transition-all duration-300 hover:scale-150"></i>
                                <div id="tender_asnad<?=$key?>" role="tooltip"
                                     class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    رویت اسناد
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center <?= $item['status'] < 2 || $item['status'] >= 100 ? '' : 'animate-bounce' ?>  pl-1 py-2">
                            <a target="_self" class="text-black font-medium text-lg hover:animate-pulse
                        text-center"
                               href="<?= $item['status'] < 2 || $item['status'] >= 100 ? ($item['status'] >= 100 ? $this->url("detail/proposal/?q=" . $item['id']) : '#')
                                   : $this->url("detail/proposal/?q=" . $item['id']) ?>"><i
                                        class="fa fa-eye"></i></a></td>
                        <td class="text-center <?= $item['status'] < 2 || $item['status'] >= 100 ? '' : 'animate-bounce' ?>  pl-1 py-2">
                            <a target="_self" class="text-black font-medium text-lg hover:animate-pulse
                        text-center"
                               href="<?= $item['status'] < 2 || $item['status'] >= 100 ? '#' : $this->url("detail/show/?q=" . $item['id']) ?>"><i
                                        class="fa fa-eye"></i></a></td>
                        <td class=" text-center pl-1 py-2 <?= $item['status'] != 1 ? '' : "animate-bounce" ?>"><a
                                    target="_self" class="font-medium  text-lg hover:animate-pulse
                                                     text-center"
                                    href="<?= $item['status'] != 1 ? '#' : $this->url("tList/show/q=" . $item['id']) ?>"><i
                                        class="bi bi-boxes"></i></a></td>
                        <td class="ltr text-end pl-1 py-2"><?= $item["completiondate"] ?></td>
                        <td colspan="text-end pl-1 py-2">
                            <?php
                            switch ($item["status"]) {
                                case 1:
                                    echo "<B class=\"ltr\">Making preparations</B>";
                                    break;
                                case 2:
                                    echo "<B class=\"ltr\">Preparing EPL</B>";
                                    break;
                                case 100:
                                    echo "<B class=\"ltr text-green-400\">Success-" . $item["related_project_code"] . "</B>";
                                    break;
                                case 101:
                                    echo "<B class=\"ltr text-red-400\">Failure</B>";
                                    break;
                            }
                            ?>
                        </td>
                        <td colspan="text-end pl-1 py-2"><B class="ltr"><?= $item["nam"] ?></B></td>
                        <td class="ltr text-end pl-1 py-2"><B
                                    class="ltr"><?= $item["trkh"] ?></B></td>
                        <td colspan="text-end pl-1 py-2"><?= $item["code"] ?></td>
                        <td colspan="text-end pl-1 py-2"><?= $item["name"] ?></td>
                        <td colspan="text-end pl-1 py-2"><?= $key + 1 ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>
    </section>
</div>

<?php
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/assign.js'); ?>"></script>
