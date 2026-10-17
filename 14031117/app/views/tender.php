<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
global $flashMessage;
?>
<?php if (isset($flashMessage)): ?>
    <div class="container my-alerts form-alert top-0">
        <div class="<?= isset($flashMessage["success"]) ? "success message-toast" : "warning" ?> my-alert">
            <div class="content">
                <div class="icon">
                    <?php if (isset($flashMessage["success"])) { ?>
                        <svg width="50" height="50" id="Layer_1"
                             style="enable-background:new 0 0 128 128;"
                             version="1.1" viewBox="0 0 128 128" xml:space="preserve"
                             xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"><g>
                                <circle fill="#fff" cx="64" cy="64" r="64"></circle>
                            </g>
                            <g>
                                <path fill="#3EBD61"
                                      d="M54.3,97.2L24.8,67.7c-0.4-0.4-0.4-1,0-1.4l8.5-8.5c0.4-0.4,1-0.4,1.4,0L55,78.1l38.2-38.2   c0.4-0.4,1-0.4,1.4,0l8.5,8.5c0.4,0.4,0.4,1,0,1.4L55.7,97.2C55.3,97.6,54.7,97.6,54.3,97.2z"></path>
                            </g></svg>
                    <?php } else { ?>
                        <svg height="50" viewBox="0 0 512 512" width="50"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill="#fff"
                                  d="M449.07,399.08,278.64,82.58c-12.08-22.44-44.26-22.44-56.35,0L51.87,399.08A32,32,0,0,0,80,446.25H420.89A32,32,0,0,0,449.07,399.08Zm-198.6-1.83a20,20,0,1,1,20-20A20,20,0,0,1,250.47,397.25ZM272.19,196.1l-5.74,122a16,16,0,0,1-32,0l-5.74-121.95v0a21.73,21.73,0,0,1,21.5-22.69h.21a21.74,21.74,0,0,1,21.73,22.7Z"/>
                        </svg>
                    <?php } ?>
                </div>
                <p class="text-2xl"><?= $this->flash('message') ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Main modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center
 w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-screen-xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    همه ی مناقصات
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm
                 w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="px-5">
                <table class="text-sm w-full mx-0" id="tendersTableAAA">
                    <thead class="text-white dark:bg-gray-700 dark:text-gray-400 bg-this-teal">
                    <tr role="row">
                        <th style="text-align: center !important" scope="col">
                            کد مناقصه
                        </th>
                        <th style="text-align: center !important" scope="col">
                            نام مناقصه
                        </th>
                        <th style="text-align: center !important" scope="col">
                            تاریخ مناقصه
                        </th>
                        <th style="text-align: center !important" scope="col">
                            تاریخ سررسید ارسال اسناد
                        </th>
                        <th style="text-align: center !important" scope="col">کارفرما
                        </th>
                        <th style="text-align: center !important" scope="col">
                            عملیات
                        </th>
                    </tr>
                    </thead>
                    <tbody class="text-this-gray text-center">
                    <?php foreach ($tenders as $key => $ten):if ($key % 2) { ?>
                        <tr class="bg-zinc-200 border-b dark:bg-gray-800 ltr dark:border-gray-700 hover:bg-zinc-400 dark:hover:bg-gray-600">
                            <td><?= $ten["code"] ?></td>
                            <td><?= $ten["name"] ?></td>
                            <td><?= $ten["trkh"] ?></td>
                            <td><?= $ten["due_date"] ?></td>
                            <td><?= $ten["customercod"] ?></td>
                            <td>
                                <button id="button_tenders_edit" value="<?= $ten["code"] ?>" type="button"
                                        class="button_tenders_edit text-yellow-700 font-medium rounded-full hover:animate-pulse
                                                     text-center me-5 mb-2 fa fa-edit"></button>
                                <button value="<?= $ten["code"] ?>" type="button"
                                        class="button_tenders_del text-red-600 font-medium rounded-full hover:animate-pulse
                                                     text-center me-2 mb-2 fa fa-close"></button>
                            </td>
                        </tr>
                    <?php } else { ?>
                        <tr class="bg-zinc-100 border-b dark:bg-gray-800 ltr dark:border-gray-700 hover:bg-zinc-400 dark:hover:bg-gray-600">
                            <td><?= $ten["code"] ?></td>
                            <td><?= $ten["name"] ?></td>
                            <td><?= $ten["trkh"] ?></td>
                            <td><?= $ten["due_date"] ?></td>
                            <td><?= $ten["customercod"] ?></td>
                            <td>
                                <button value="<?= $ten["code"] ?>" type="button"
                                        class="button_tenders_edit text-yellow-700 font-medium rounded-full hover:animate-pulse
                                                     text-center me-5 mb-2 fa fa-edit transition-all duration-300 hover:scale-150"></button>

                                <button onclick="delthisTender('<?= $ten["code"] ?>')" value="<?= $ten["code"] ?>" type="button" <?=$ten['status']!=1?'disabled':''?>
                                        class="button_tenders_del text-red-600 font-medium rounded-full hover:animate-pulse
                                                     text-center me-2 mb-2 fa fa-close <?=$ten['status']==1?'transition-all duration-300 hover:scale-150':''?> "></button>

                            </td>
                        </tr>
                    <?php } endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<div class="p-2 pb-0">
    <div class="container">
        <p class="text-center mb-4 text-2xl">تعریف استعلام و مناقصه</p>
        <button id="tendersList" data-modal-target="default-modal" data-modal-toggle="default-modal"
                data-tooltip-target="tooltip-customer-2" type="button" class="fa fa-th-list
          text-white bg-this-teal hover:bg-this-teal/80 focus:ring-4 focus:outline-none focus:ring-this-teal/50
        font-medium rounded-lg text-lg px-5 py-2.5 text-center inline-flex items-center dark:hover:bg-this-teal/80 dark:focus:ring-this-teal/40 me-2 mb-2 float-end">

        </button>
        <div id="tooltip-customer-2" role="tooltip"
             class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            رویت همه موارد
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <div class="w-2/3 my-7 relative mx-auto my-arbitrary-input">
            <form id="tenderForm" method="post" action="<?= $this->url('tender/submit') ?>" enctype="multipart/form-data"
                  class="h-2/3 flex flex-col justify-evenly">
                <input hidden="" value="-1" name="option" id="option"/>
                <label for="tenCode"
                       class="text-black mt-7">
                    کد مناقصه:
                </label>
                <input type="text" id="tenCode" name="tenCode" readonly value="<?= $code ?>"
                       class=" w-full border-gray-400 border focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                <label for="tenName"
                       class="text-black mt-7">
                    نام مناقصه:
                </label>
                <input type="text" id="tenName" name="tenName" autocomplete="false"
                       class=" w-full border-gray-400 border focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                <label for="tenDate"
                       class="text-black mt-7">
                    تاریخ مناقصه:
                </label>
                <input type="text" id="tenDate" name="tenDate" data-jdp autocomplete="false"
                       class=" w-full border-gray-400 border focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                <label for="tenDocDate"
                       class="text-black mt-7">
                    تاریخ سررسید ارسال اسناد:
                </label>
                <input type="text" id="tenDocDate" name="tenDocDate" data-jdp autocomplete="false"
                       class=" w-full border-gray-400 border focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                <label for="tenCus"
                       class="text-black mt-7">
                    کارفرما:
                </label>
                <div class="relative" data-hs-combo-box="">
                    <div class="relative">
                        <input type="text" id="tenCus" name="tenCus"
                               class=" w-full border-gray-400 border focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                               role="combobox" aria-expanded="false"
                               data-hs-combo-box-input=""/>
                        <div class="absolute top-1/2 end-3 -translate-y-1/2" aria-expanded="false"
                             data-hs-combo-box-toggle="">
                            <svg class="shrink-0 size-3.5 text-gray-500 dark:text-neutral-500"
                                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="m7 15 5 5 5-5"></path>
                                <path d="m7 9 5-5 5 5"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute z-50 w-full max-h-72 p-1 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto
                    [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100
                    [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500
                    dark:bg-neutral-900 dark:border-neutral-700"
                         style="display: none;" data-hs-combo-box-output="">
                        <?php foreach ($all as $cus): ?>
                            <div class="cursor-pointer py-2 px-4 w-full text-sm text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100
                         dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800"
                                 tabindex="1" data-hs-combo-box-output-item="">
                                <div class="flex justify-between items-center w-full">
                                    <span data-hs-combo-box-search-text="<?= $cus['nam'] ?>"
                                          data-hs-combo-box-value=""><?= $cus['nam'] ?></span>
                                    <span class="hidden hs-combo-box-selected:block">
          <svg class="shrink-0 size-3.5 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24"
               height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
               stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
        </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="flex justify-between mt-16">
                    <label class="block w-fit my-2 bg-black p-2 text-white rounded-lg cursor-pointer font-medium  dark:text-white"
                           for="files">بارگذاری اسناد مناقصه</label>
                    <input class="hidden" accept=".pdf,.png,.jpg,.xls,.xlsx" type="file" id="files" name="files[]" hidden multiple/>
                    <button type="button" id="savetenderData"
                            class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4
                            focus:outline-none text-zinc-200 focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg
                            dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        ثبت
                    </button>
                    <button type="button" id="clearAllfieldsT"
                            class="hidden bg-gradient-to-r from-red-400 via-red-400 to-red-600 hover:bg-gradient-to-br focus:ring-4
                            focus:outline-none text-zinc-200 focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-400/50 dark:shadow-lg
                            dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        پاک کردن
                    </button>
                </div>
                <div class="mt-10">
                    <button type="button"
                            class="bg-gradient-to-l from-this-teal to-teal-500 hover:to-teal-400 focus:ring-4
                            focus:outline-none text-zinc-200 focus:ring-teal-300 dark:focus:ring-green-800 shadow-lg shadow-teal-500/50 dark:shadow-lg
                            dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                            onclick="window.open('<?=$this->url("tList")?>','_self')">
                      رفتن به فهرست مناقصات <i class="fa fa-list p-0 fa-xl"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/tender.js'); ?>"></script>