<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
global $flashMessage;
?>
<div class="p-2 pb-0">
    <div class="container">
        <h4 class="text-2xl text-center my-2 mb-7">لیست درخواست های کالا از انبار</h4>
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center mt-3" id="default-styled-tab"
                data-tabs-toggle="#default-styled-tab-content"
                data-tabs-active-classes="text-purple-600"
                data-tabs-inactive-classes="dark:border-transparent text-this-gray hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="recent-styled-tab"
                            data-tabs-target="#styled-recent" type="button" role="tab" aria-controls="recent"
                            aria-selected="false">جاری
                    </button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="shopping-styled-tab" data-tabs-target="#styled-shopping" type="button" role="tab"
                            aria-controls="shopping" aria-selected="false">در انتظار خرید
                    </button>
                </li>
                <li role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="done-styled-tab" data-tabs-target="#styled-done" type="button" role="tab"
                            aria-controls="done" aria-selected="false">تکمیل شده ها
                    </button>
                </li>
            </ul>
        </div>
        <div id="default-styled-tab-content">
            <div class="hidden p-4 rounded-lg dark:bg-gray-800" id="styled-recent" role="tabpanel"
                 aria-labelledby="recent-tab">
                <table class="w-full border-collapse table-auto text-this-gray">
                    <thead>
                    <tr aria-label="-" class="bg-this-teal">
                        <th class="text-start p-1 text-white" scope="col">
                            ردیف
                        </th>
                        <th class="text-start p-1 text-white" scope="col">
                            عنوان پروژه
                        </th>
                        <th class="text-start p-1 text-white" scope="col">
                            تارخ ثبت
                        </th>
                        <th class="text-start p-1 text-white" scope="col">
                            تاریخ درخواست
                        </th>
                        <th class="text-start p-1 text-white" scope="col">
                            واحد درخواست کننده
                        </th>
                        <th class="text-center p-1 text-white" scope="col">
                            عملیات
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-zinc-300 hover:bg-zinc-400">
                        <td class="p-1 border border-white">1</td>
                        <td class="p-1 border border-white" aria-label="name">پروژه 1</td>
                        <td class="p-1 border border-white" aria-label="code">1403/08/01</td>
                        <td class="p-1 border border-white">
                            1403/08/08
                        </td>
                        <td class="p-1 border border-white">
                            واحد 3
                        </td>
                        <td class="p-1 border border-white">
                            <div class="flex w-full justify-evenly">
                                    <a target="_blank" class="text-black font-medium hover:animate-pulse
                                                     text-center"href="<?= $this->url('supply') ?>"><i class="fa fa-eye"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr class="bg-zinc-200 hover:bg-zinc-400">
                        <td class="p-1 border border-white">2</td>
                        <td class="p-1 border border-white" aria-label="name">پروژه 2</td>
                        <td class="p-1 border border-white" aria-label="code">1403/07/01</td>
                        <td class="p-1 border border-white">
                            1403/07/07
                        </td>
                        <td class="p-1 border border-white">
                            واحد 1
                        </td>
                        <td class="p-1 border border-white text-center">
                            <a target="_blank" class="text-black font-medium hover:animate-pulse
                                                     text-center"href="<?= $this->url('supply') ?>"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="hidden p-4 rounded-lg dark:bg-gray-800" id="styled-shopping" role="tabpanel"
                 aria-labelledby="shopping-tab">
                <table class="w-full border-collapse table-auto text-this-gray">
                    <thead>
                    <tr aria-label="-" class="bg-this-teal">
                        <th class="text-start p-1 text-white" scope="col">
                            ردیف
                        </th>
                        <th class="text-start p-1 text-white" scope="col">
                            عنوان پروژه
                        </th>
                        <th class="text-start p-1 text-white" scope="col">
                            تارخ ثبت
                        </th>
                        <th class="text-start p-1 text-white" scope="col">
                            تاریخ درخواست
                        </th>
                        <th class="text-start p-1 text-white" scope="col">
                            واحد درخواست کننده
                        </th>
                        <th class="text-center p-1 text-white" scope="col">
                            عملیات
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-zinc-300 hover:bg-zinc-400">
                        <td class="p-1 border border-white">1</td>
                        <td class="p-1 border border-white" aria-label="name">پروژه 1</td>
                        <td class="p-1 border border-white" aria-label="code">1403/08/01</td>
                        <td class="p-1 border border-white">
                            1403/08/08
                        </td>
                        <td class="p-1 border border-white">
                            واحد 3
                        </td>
                        <td class="p-1 border border-white">
                            <div class="flex w-full justify-evenly">
                                <a target="_blank" class="text-black font-medium hover:animate-pulse
                                                     text-center"href="<?= $this->url('supply') ?>"><i class="fa fa-eye"></i></a>
                                <a target="_blank" data-tooltip-target="tooltip-2" class="text-green-600 text-lg font-medium hover:animate-pulse
                                                     text-center"href="<?= $this->url('supply') ?>"><i class="fa fa-check-square"></i></a>
                                <div id="tooltip-2" role="tooltip"
                                     class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    انتقال به تکمیل شده ها
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="bg-zinc-200 hover:bg-zinc-400">
                        <td class="p-1 border border-white">2</td>
                        <td class="p-1 border border-white" aria-label="name">پروژه 2</td>
                        <td class="p-1 border border-white" aria-label="code">1403/07/01</td>
                        <td class="p-1 border border-white">
                            1403/07/07
                        </td>
                        <td class="p-1 border border-white">
                            واحد 1
                        </td>
                        <td class="p-1 border border-white text-center">
                            <div class="flex w-full justify-evenly">
                                <a target="_blank" class="text-black font-medium hover:animate-pulse
                                                     text-center"href="<?= $this->url('supply') ?>"><i class="fa fa-eye"></i></a>
                                <a target="_blank" class="text-green-600 text-lg font-medium hover:animate-pulse
                                                     text-center"href="<?= $this->url('supply') ?>"><i class="fa fa-check-square"></i></a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="hidden p-4 rounded-lg dark:bg-gray-800" id="styled-done" role="tabpanel"
                 aria-labelledby="done-tab">
                <table class="w-full border-collapse table-auto text-this-gray">
                    <thead>
                    <tr aria-label="-" class="bg-this-teal">
                        <th class="text-start p-1 text-white" scope="col">
                            ردیف
                        </th>
                        <th class="text-start p-1 text-white" scope="col">
                            عنوان پروژه
                        </th>
                        <th class="text-start p-1 text-white" scope="col">
                            تارخ ثبت
                        </th>
                        <th class="text-start p-1 text-white" scope="col">
                            تاریخ درخواست
                        </th>
                        <th class="text-start p-1 text-white" scope="col">
                            واحد درخواست کننده
                        </th>
                        <th class="text-center p-1 text-white" scope="col">
                            عملیات
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-zinc-300 hover:bg-zinc-400">
                        <td class="p-1 border border-white">1</td>
                        <td class="p-1 border border-white" aria-label="name">پروژه 1</td>
                        <td class="p-1 border border-white" aria-label="code">1403/08/01</td>
                        <td class="p-1 border border-white">
                            1403/08/08
                        </td>
                        <td class="p-1 border border-white">
                            واحد 3
                        </td>
                        <td class="p-1 border border-white">
                            <div class="flex w-full justify-evenly">
                                <a target="_blank" class="text-black font-medium hover:animate-pulse
                                                     text-center"href="<?= $this->url('supply') ?>"><i class="fa fa-eye"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr class="bg-zinc-200 hover:bg-zinc-400">
                        <td class="p-1 border border-white">2</td>
                        <td class="p-1 border border-white" aria-label="name">پروژه 2</td>
                        <td class="p-1 border border-white" aria-label="code">1403/07/01</td>
                        <td class="p-1 border border-white">
                            1403/07/07
                        </td>
                        <td class="p-1 border border-white">
                            واحد 1
                        </td>
                        <td class="p-1 border border-white text-center">
                            <a target="_blank" class="text-black font-medium hover:animate-pulse
                                                     text-center"href="<?= $this->url('supply') ?>"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<?php
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/project.js'); ?>"></script>
