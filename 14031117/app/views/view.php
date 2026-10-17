<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
global $flashMessage;
?>
<!--<input type="text" id="00000" name="00000" data-jdp>-->
<div class="w-full h-full  p-4">
    <!--    <pre>--><?php //=print_r($tender)?><!--</pre>-->



    <div class="grid md:grid-cols-3 lg:grid-cols-3 2xl:grid-cols-3 2xl:gap-3 md:gap-3 mt-0 ">
        <div class="flex flex-col mt-0 col-span-1 ">
            <div class="flex flex-row">
           <div class="w-full ltr px-2 py-2 text-2xl mb-1 border-b border-teal-600 rounded-t-lg dark:border-gray-600">
               <span id="seeDocuments" onclick="showDocuments()"
                     data-tooltip-target="tender_asnad" class="cursor-pointer float-end fa fa-download
                    h-auto relative z-0 rounded-lg transition-all duration-300 hover:scale-150"></span>
               <div id="tender_asnad" role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                   رویت اسناد مناقصه
                   <div class="tooltip-arrow" data-popper-arrow></div>
               </div>

               <span id="ender_return" onclick="window.location.href=url('tList')"
                     data-tooltip-target="tender_return" class="cursor-pointer float-end mr-5 fa fa-share-square-o
 h-auto relative z-0 rounded-lg transition-all duration-300 hover:scale-150"></span>
               <div id="tender_return" role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                   بازگشت
                   <div class="tooltip-arrow" data-popper-arrow></div>

               </div>
           </div>
            <div class="text-2xl ml-2 text-red-400 mt-2  rounded-t-lg">

               <span id="ender_finalize" onclick="tender_finalize('<?= $tender[0]["code"]; ?>')"
                     data-tooltip-target="tender_finalize_t" class="cursor-pointer mr-5 float-end fa fa-arrow-left
 h-auto relative z-0 rounded-lg text-red   transition-all duration-300 animate-pulse hover:scale-150"></span>
               <div id="tender_finalize_t" role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                   ثبت نهایی و رفتن به مرحله بعدی
                   <div class="tooltip-arrow" data-popper-arrow></div>
               </div>
           </div>
           </div>
            <div class="w-full">
                <ul class="w-full font-medium text-sm bg-white border shadow-lg border-teal-600 text-this-gray rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full px-4 py-4 border-b border-teal-600 rounded-t-lg dark:border-gray-600">
                        <span class="font-bold text-black">نام مناقصه:</span>
                        <span class="font-bold mx-1"><?= $tender[0]["name"]; ?></span>

                    </li>
                    <li class="w-full px-4 py-4 border-b border-teal-600 dark:border-gray-600">
                        <span class="font-bold text-black">کد مناقصه:</span>
                        <span class="font-bold mx-1" id="monCode"><?= $tender[0]["code"]; ?></span>

                    </li>
                    <li class="w-full px-4 py-4 border-b border-teal-600 dark:border-gray-600">
                        <span class="font-bold text-black">تاریخ ثبت:</span>
                        <span class="font-bold mx-1"><B
                                    class="ltr"><?= jdate('Y/m/d H:i:s', strtotime($tender[0]["created_at"])) ?></B></span>

                    </li>
                    <li class="w-full px-4 py-4 border-b border-teal-600">
                        <span class="font-bold text-black"> وضعیت:</span>
                        <span class="font-bold mx-1">Making preparations</span>
                    </li>
                    <li class="w-full px-4 py-4 border-b border-teal-600">
                        <span class="font-bold text-black"> تعداد محصولات:</span>
                        <span id="proLength"
                              class="font-bold mx-1"><?= !$tender[0]["mon_cod"] ? 0 : count($tender); ?></span>
                    </li>
<!--                    <li class="w-full px-4 py-2 rounded-b-lg">-->
<!--                        <div class="mb-1 text-base font-medium text-yellow-700 dark:text-yellow-500 text-center">10%-->
<!--                        </div>-->
<!--                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4 dark:bg-gray-700">-->
<!--                            <div class="bg-yellow-400 h-2.5 rounded-full" style="width: 10%"></div>-->
<!--                        </div>-->
<!--                    </li>-->
                </ul>
            </div>
            <div class="w-full mt-5 text-sm">
                <div class="bg-white rounded-2 p-5 md:ms-4" ondrop="dropEnd(event)" ondragover="onDrag(event)">
                    <div class="ms-2">
                        <div id="dropZone"
                             class="border-4 border-dashed border-slate-500 min-h-20 text-zinc-400 text-center <?php if ($tender[0]["mon_cod"]) echo 'hidden'; ?>">
                            <p class="mt-5">کارت ها را بکشید و اینجا رها کنید</p>
                        </div>
                        <table id="productsTable"
                               class="table table-auto w-full rounded-lg <?php if (!$tender[0]["mon_cod"]) echo 'hidden'; ?>">
                            <thead class="bg-gray-300">
                            <tr>
                                <th class="text-start pr-1 border border-slate-400">ردیف</th>
                                <th class="text-start pr-1 border border-slate-400">محصول</th>
                                <th class="text-start pr-1 border border-slate-400">تعداد</th>
                                <th class="text-start pr-1 border border-slate-400">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($tender[0]["mon_cod"]) {
                                foreach ($tender as $key => $item) { ?>
                                    <tr class="bg-white hover:bg-zinc-300">
                                        <td class="pr-1 border border-slate-400"><?= $key + 1 ?></td>
                                        <td class="pr-1 border border-slate-400"><?= $item["mah_cod"]." : ".$item["mah_nam"] ?></td>
                                        <td class="pr-1 border border-slate-400"><?= $item["tedad"] ?></td>
                                        <td class="pr-1 border border-slate-400">
                                            <button class="delete-btn hover:animate-pulse text-red-600 text-2xl"
                                                    value="<?= $item["row_id"] ?>"><i
                                                        class="fa fa-close"></i></button>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-span-2 flex flex-col">
            <div >

                <input style=" background: white;padding-left: 20px;font-size: 14px;border: 1px solid #aaa;box-sizing: border-box; border-radius: 6px;"
                       dir="auto" type="text" id="search" class="border-0 focus:border focus:border-teal-500 focus:ring-1
               hover:border-teal-500 hover:border focus:ring-teal-400" autocomplete="off"/>
                <label class="text-sm" for="search">Search</label>
            </div>
            <div class="grid grid-cols-2  lg:grid-cols-4 gap-1 mt-1">

                <?php foreach ($products as $item) { ?>
                    <div style="font-family: 'Times New Roman'" id="card_<?= $item["code"] ?> "
                         draggable="true" ondragstart="dragStart(event)" class="product_card
                 bg-white border border-gray-200 col-auto
                 rounded-lg shadow max-w-[200px] max-h-[180px]  hover:bg-gray-100 mt-1
                dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 drop-shadow-lg hover:drop-shadow-2xl">
                        <div class="w-full bg-this-teal text-white text-center rounded-t-lg p-1">
                            <!--                    <p class="mt-3">کد محصول: --><?php //= $item["code"] ?><!--</p>-->
                            <p class="text-sm product_name"> <?= $item["name"] ?></p>
                        </div>
                        <div  class="flex flex-col items-start md:flex-row ltr p-1 w-full">
                            <!--                        <img class="object-cover  max-w-20 rounded-t-lg md:h-auto md:auto md:rounded-none md:rounded-s-lg shadow-lg"-->
                            <!--                             src="-->
                            <?php //= $this->asset('images/products/' . $item["logo"]) ?><!--" alt="تصویر محصول">-->
                            <div class="flex w-full flex-col justify-between leading-normal text-this-gray ps-1 text-sm">
                                <p class="bg-zinc-100 py-1 px-2 w-full product_code">Product code: <?= $item["code"] ?></p>

                                <p class="bg-zinc-200 py-1 px-2 w-full">Voltage:<?= $item["voltage"] ?></p>
                                <p class="bg-zinc-100 py-1 px-2 w-full">Nominal Current: <?= $item["crnt"] ?></p>
                                <p class="bg-zinc-200 py-1 px-2 w-full">Model: <?= $item["type1"] ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>
</div>
<?php
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/assign.js'); ?>"></script>