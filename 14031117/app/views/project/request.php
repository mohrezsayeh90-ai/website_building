<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
global $flashMessage;
?>
<div class="p-2 pb-0">
    <div class="container">
        <h4 class="text-2xl text-center my-2"> فرم درخواست کالا از انبار</h4>
        <table class="border border-slate-400 border-collapse table-auto bg-gray-300 mt-7 w-full text-this-gray text-start">
            <tr>
                <td colspan="8" class="border-slate-400 border pr-1 py-3">
                    <span class="font-bold ">نام پروژه:</span>
                    <span class="font-bold  mx-1">Project Name</span>
                </td>
            </tr>
            <tr>
                <td class="border-slate-400 border pr-1">
                    <p class="font-bold ">واحد درخواست کننده:</p>
                </td>
                <td class="border-slate-400 border pr-1">
                    <input type="text" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-400
                        focus:border-0 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                        dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                </td>
                <td class="border-slate-400 border pr-1">
                    <p class="font-bold ">تاریخ درخواست:</p>
                </td>
                <td class="border-slate-400 border pr-1">
                    <input data-jdp type="text" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-400
                        focus:border-0 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                        dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                </td>
                <td class="border-slate-400 border pr-1">
                    <p class="font-bold">شماره سفارش: </p>
                </td>
                <td class="border-slate-400 border pr-1">
                    <p class="font-bold ">1234</p>
                </td>
                <td class="border-slate-400 border pr-1">
                    <p class="font-bold ">انبار:</p>
                </td>
                <td class="border-slate-400 border pr-1">
                    <select id="countries"
                            class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-400
                        focus:border-0 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                        dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>-</option>
                        <option value="US">انبار 1</option>
                        <option value="CA">انبار 2</option>
                        <option value="FR">انبار 3</option>
                    </select>
                </td>
            </tr>
        </table>
        <table id="request_table"
               class="w-full table-auto border border-collapse border-slate-400 text-start text-this-gray">
            <thead>
            <tr class="">
                <th class="border border-slate-500 bg-gray-300 py-3 px-1 text-start" scope="col">ردیف</th>
                <th class="border border-slate-500 bg-gray-300 py-3 px-1 text-start" scope="col">نام کالا</th>
                <th class="border border-slate-500 bg-gray-300 py-3 px-1 text-start" scope="col">کد کالا</th>
                <th class="border border-slate-500 bg-gray-300 py-3 px-1 text-start" scope="col">مشخصات فنی کالا</th>
                <th class="border border-slate-500 bg-gray-300 py-3 px-1 text-start" scope="col">تعداد یا مقدار</th>
                <th class="border border-slate-500 bg-gray-300 py-3 px-1 text-start" scope="col">واحد</th>
                <th class="border border-slate-500 bg-gray-300 py-3 px-1 text-start" scope="col">ملاحظات</th>
                <th class="border border-slate-500 bg-gray-300 py-3 px-1 text-start" scope="col">عملیات</th>
            </tr>
            </thead>
            <tbody class="text-sm">
            <tr class="">
                <td class="border border-slate-500 bg-white hover:border-gray-400 py-3 px-1">1</td>
                <td class="border border-slate-500 bg-white hover:border-gray-400 py-3 px-1">Limit Switch۱</td>
                <td class="border border-slate-500 bg-white hover:border-gray-400 py-3 px-1">code</td>
                <td class="border border-slate-500 bg-white hover:border-gray-400 py-3 px-1">230VAC, 1com</td>
                <td class="border border-slate-500 bg-white hover:border-gray-400 py-3 px-1">1</td>
                   <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">Pcs</td>
                <td class="border border-slate-500 bg-white hover:border-gray-400 py-3 px-1">-</td>
                <td class="border border-slate-300 bg-white hover:border-gray-400">
                    <div class="flex w-full justify-evenly">
                        <button data-tooltip-target="tooltip-1"
                                class="hover:animate-pulse text-red-600 text-2xl"><i class="fa fa-close"></i></button>
                        <div id="tooltip-1" role="tooltip"
                             class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            حذف از لیست توسط واحد درخواست دهنده
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <button data-tooltip-target="tooltip-2"
                                class="hover:animate-pulse text-yellow-500 text-2xl"><i class="fa fa-shopping-cart"></i></button>
                        <div id="tooltip-2" role="tooltip"
                             class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            درخواست خرید توسط انبار
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <button data-tooltip-target="tooltip-3"
                                class="hover:animate-pulse text-blue-500 text-2xl"><i class="fa fa-refresh"></i></button>
                        <div id="tooltip-3" role="tooltip"
                             class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            درانتظار خرید
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="">
                <td class="border border-slate-500 bg-white hover:border-gray-400 py-3 px-1">2</td>
                <td class="border border-slate-500 bg-white hover:border-gray-400 py-3 px-1">Partition</td>
                <td class="border border-slate-500 bg-white hover:border-gray-400 py-3 px-1">code</td>
                <td class="border border-slate-500 bg-white hover:border-gray-400 py-3 px-1"> P-RTP2.5H-10, Gray</td>
                <td class="border border-slate-500 bg-white hover:border-gray-400 py-3 px-1">10</td>
                   <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">Pcs</td>
                <td class="border border-slate-500 bg-white hover:border-gray-400 py-3 px-1">-</td>
                <td class="border border-slate-300 bg-white hover:border-gray-400">
                    <div class="flex w-full justify-evenly">
                        <button class="hover:animate-pulse text-red-600 text-2xl"><i class="fa fa-close"></i></button>
                        <button class="hover:animate-pulse text-yellow-500 text-2xl"><i class="fa fa-shopping-cart"></i></button>
                        <button
                                class="hover:animate-pulse text-blue-500 text-2xl"><i class="fa fa-refresh"></i></button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="flex justify-center">
            <button type="button" id="loginSubmit" class="w-48 text-white mt-10 bg-gradient-to-br from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-r focus:ring-4 focus:outline-none
                         focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 font-medium rounded-lg
                          text-sm px-5 py-2.5 text-center me-2 mb-2">
                صدور حواله
            </button>
        </div>
    </div>
</div>
<?php
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/project.js'); ?>"></script>