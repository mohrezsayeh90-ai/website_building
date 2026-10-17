<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
global $flashMessage;
?>
<?php
//print_r($materials);
?>
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
<div id="my-search-list01"
     class="z-20 absolute flex flex-wrap ltr mt-3 text-sm font-medium text-left text-gray-500 border-1 bg-gray-200
     border-gray-400 dark:border-gray-700 dark:text-gray-400"
     style="max-height:500px;--width:65%;top: 32px;margin-right: 168px;display: none;min-width:300px; overflow-y: scroll">
    <i class="fa fa-circle animate-bounce"></i>
    <ul class="list-none p-2" id="search-result01">
        <?php
        foreach ($materials[4] as $mType) {
            ?>
            <li class="ml-2 hover:bg-black hover:text-white cursor-pointer"><?= $mType['type'] ?></li>
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
    <ul class="list-none p-2" id="search-result01">
        <?php
        foreach ($materials[6] as $manF) {
            ?>
            <li class="ml-2 hover:bg-black hover:text-white cursor-pointer"><?= $manF['manufacturer'] ?></li>
            <?php
        }
        ?>
    </ul>
</div>

<div class="">
    <div class="container">
        <p class="text-2xl text-center my-4"><?= $materials[0]['name'] ?></p>
        <input type="hidden" id="tender_code" value="<?= $materials[0]['code'] ?>">
        <div class="flex flex-row ltr ml-10 text-3xl border-b-2">
            <i data-tooltip-target="tender_finalize_t" id="saveAllSheets"
               class=" cursor-pointer fa fa-save  h-auto relative z-0 rounded-lg transition-all duration-300 hover:scale-150"></i>

            <i data-tooltip-target="tender_finalize_t1" class="fa fa-refresh cursor-pointer ms-4 h-auto relative z-0 rounded-lg
        transition-all duration-300 hover:scale-150"></i>
            <i data-tooltip-target="tender_finalize_t2" class="fa fa-download cursor-pointer ms-4 h-auto relative z-0 rounded-lg
        transition-all duration-300 hover:scale-150"></i>
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
            تنظیم مجدد
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <div id="tender_finalize_t2" role="tooltip"
             class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            دانلود فایل اکسل
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
    <div class="relative">
        <div class="my-scroll-parent scroll1">
            <div class="my-vertical-scroll-div">
                <div class="container">
                    <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                        <ul id="alltabsMain"
                            class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                            id="default-styled-tab"
                            data-tabs-toggle="#default-styled-tab-content"
                            data-tabs-active-classes="text-purple-600"
                            data-tabs-inactive-classes="dark:border-transparent text-this-gray hover:text-gray-600
                            dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                            role="tablist">
                            <?php

                            foreach ($materials[1] as $key => $material)
                            {

                            ?>
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500"
                                        id="<?= $material['name'] ?>-styled-tab"
                                        data-tabs-target="#styled-<?= $material['name'] ?>" type="button" role="tab"
                                        aria-controls="<?= $material['name'] ?>"
                                        aria-selected="false"><?= $material['name'] ?>
                                </button>
                                <input type="hidden" value="<?= $material['code'] ?>" id="prd_ten_<?= $key ?>">
                            </li>
                                <?php
                                }
                                ?>
                            <li role="presentation">
                                <button class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500"
                                        id="materials-styled-tab" data-tabs-target="#styled-materials" type="button"
                                        role="tab"
                                        aria-controls="materials" aria-selected="true">Materials
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="default-styled-tab-content">
                    <?php
                    $tabN = 0;

                    foreach ($materials[1] as $key => $material) {

                    ?>
                    <div class="hidden rounded-lg dark:bg-gray-800" id="styled-<?= $material['name'] ?>"
                         role="tabpanel"
                         aria-labelledby="<?= $material['name'] ?>-tab">
                        <div class="container ltr">
                            <table id="detail_table"
                                   class="w-full mb-14 table-fixed border border-collapse border-slate-400 text-end overflow-x-auto">
                                <thead>
                                <tr class="text-center">
                                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col"
                                        rowspan="2">Item
                                    </th>
                                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" colspan="2">
                                        Description
                                    </th>
                                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" colspan="3"
                                        rowspan="2">Type
                                    </th>
                                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col"
                                        rowspan="2">Manufacturer
                                    </th>
                                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col"
                                        rowspan="2">QTY
                                    </th>
                                    <th class="border border-slate-500 bg-gray-400 py-1 px-1"
                                        scope="col">Price I
                                    </th>
                                    <th class="border border-slate-500 bg-gray-400 py-1 px-1" scope="col">Price
                                        Rial
                                    </th>
                                    <th class="border border-slate-500 bg-gray-400 py-1 px-1" scope="col">Total
                                        Price
                                    </th>
                                    <th class="border border-slate-500 bg-gray-400 py-1 px-1"
                                        scope="col">Total Price
                                    </th>
                                </tr>
                                <tr class="text-center">
                                    <td class="border border-slate-500 bg-gray-300 py-1 px-1" colspan="2">(INCLUDING
                                        TECHNICAL
                                        SPECIFICATION DETAIL)
                                    </td>
                                    <td class="border border-slate-500 bg-gray-400 py-1 px-1" colspan="2">Unit</td>
                                    <td class="border border-slate-500 bg-gray-400 py-1 px-1">€</td>
                                    <td class="border border-slate-500 bg-gray-400 py-1 px-1">Rial</td>
                                </tr>
                                </thead>
                                <tbody class="text-sm">
                                <?php

                                for ($row = 0; $row < 100; $row++) {
                                    ?>
                                    <tr class="text-center ml-2">
                                        <td class="border border-slate-300 bg-white hover:border-gray-400"><?= $row + 1 ?></td>
                                        <td colspan="2"
                                            class="w-full border border-slate-300 bg-white hover:border-gray-400 ">
                            <textarea id="cell_1_<?= $key . '_' . $row ?>"
                                      class="w-full peer h-full min-h-[50px] resize-none border-b border-blue-gray-200
                                      bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0
                                      transition-all placeholder-shown:border-blue-gray-200
                                       focus:border-gray-900
                                       focus:outline-0 disabled:resize-none
                                       disabled:border-0
                                       disabled:bg-blue-gray-50"><?php
                                if ($tabN < count($materials[8]) && $materials[8][$tabN]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabN]['equip'];

                                }
                                ?></textarea>

                                        </td>
                                        <td colspan="3"
                                            class="border border-slate-300 bg-white hover:border-gray-400">
                            <textarea id="cell_2_<?= $key . '_' . $row ?>"
                                      class="peer h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200 text-center
                                       bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0
                                      transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900
                                      focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"><?php
                                if ($tabN < count($materials[8]) && $materials[8][$tabN]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabN]['type'];

                                }
                                ?></textarea>
                                        </td>
                                        <td
                                                class="border border-slate-300 bg-white hover:border-gray-400">
                            <textarea id="cell_3_<?= $key . '_' . $row ?>"
                                      class="peer h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                      bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0
                                      transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900
                                      focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"><?php
                                if ($tabN < count($materials[8]) && $materials[8][$tabN]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabN]['manufact'];

                                }
                                ?></textarea>

                                        </td>
                                        <td
                                                class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">
                            <textarea id="cell_4_<?= $key . '_' . $row ?>"
                                      class="peer h-full min-h-[50px] w-full resize-none border-b border-blue-gray-200
                                      bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0
                                      transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900
                                      focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"><?php
                                if ($tabN < count($materials[8]) && $materials[8][$tabN]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabN]['qty'] == 0 ? $material['tedad'] : $materials[8][$tabN]['qty'];

                                }
                                ?></textarea>

                                        </td>
                                        <td
                                                class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-1 px-1">
                            <textarea id="cell_5_<?= $key . '_' . $row ?>"
                                      class="peer h-full min-h-[50px] w-full resize-none border-b
                                        border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0
                                      transition-all placeholder-shown:border-blue-gray-200
                                      focus:border-gray-900 focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"><?php
                                if ($tabN < count($materials[8]) && $materials[8][$tabN]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabN]['price_i'];

                                }
                                ?></textarea>

                                        </td>
                                        <td
                                                class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-1 px-1">
                            <textarea id="cell_6_<?= $key . '_' . $row ?>"
                                      class="peer h-full min-h-[50px] w-full resize-none border-b
                                      border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0
                                      transition-all placeholder-shown:border-blue-gray-200
                                      focus:border-gray-900 focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"><?php
                                if ($tabN < count($materials[8]) && $materials[8][$tabN]['mah_cod'] == $material['code']) {
                                    echo $materials[8][$tabN]['price_r'];

                                }
                                ?></textarea>

                                        </td>
                                        <td id="cell_7_<?= $key . '_' . $row ?>"
                                            class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-1 px-1"><?php
                                            if ($tabN < count($materials[8]) && $materials[8][$tabN]['mah_cod'] == $material['code']) {
                                                echo $materials[8][$tabN]['price_i'] * ($materials[8][$tabN]['qty'] == 0 ? $material['tedad'] : $materials[8][$tabN]['qty']);
                                            }
                                            ?></td>
                                        <td id="cell_8_<?= $key . '_' . $row ?>"
                                            class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-1 px-1"><?php
                                            if ($tabN < count($materials[8]) && $materials[8][$tabN]['mah_cod'] == $material['code']) {
                                                echo $materials[8][$tabN]['price_r'] * ($materials[8][$tabN]['qty'] == 0 ? $material['tedad'] : $materials[8][$tabN]['qty']);
                                                $tabN++;
                                            }
                                            ?></td>


                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="fixed bottom-0 left-0 right-0">
                            <div class="text-center total-sum bg-gray-400 flex flex-row mx-auto">
                                <div class="w-1/2 p-3">
                                    <span> Total Price (€):</span>
                                    <span id="cell_sum_i_<?= $key ?>" class=" px-1">0</span>
                                </div>
                                <div class="w-1/2 p-3 border-l border-slate-500">
                                    <span> Total Price (Rial):</span>
                                        <span id="cell_sum_r_<?= $key ?>" class=" px-1"
                                              colspan="1"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                <div class="hidden  rounded-lg dark:bg-gray-800" id="styled-materials" role="tabpanel"
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
                                <td class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-2 px-1"><?= number_format(32660000, 0, ',') ?></td>
                                <td class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-2 px-1"><?= number_format(14630000, 0, ',') ?></td>
                                <td class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-2 px-1">
                                    834
                                </td>
                                <td class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-2 px-1"><?= number_format(14766000, 0, ',') ?></td>
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
                            <td class="border border-slate-500 px-1"><?= number_format(1761000000, 0, ',') ?></td>
                            <td class="border border-slate-500 px-1">0</td>
                            <td class="border border-slate-500 px-1">0</td>
                            <td class="border border-slate-500 px-1">0</td>
                            <td class="border border-slate-500 px-1"><?= $tedad ?></td>
                            <td class="border border-slate-500 py-3 px-1" colspan="2">
                                SUM
                            </td>
                        </tr>
                        <tr class="text-center total-sum bg-gray-300">
                            <td class="border border-slate-500 px-1"><?= number_format(1761000000, 0, ',') ?></td>
                            <td class="border border-slate-500 px-1">0</td>
                            <td class="border border-slate-500 px-1">0</td>
                            <td class="border border-slate-500 px-1">0</td>
                            <td class="border border-slate-500 px-1">0</td>
                            <td class="border border-slate-500 py-3 px-1" colspan="2">
                                TAX(10%)
                            </td>
                        </tr>
                        <tr class="text-center total-sum bg-gray-300">
                            <td class="border border-slate-500 px-1"><?= number_format(1761000000, 0, ',') ?></td>
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
<?php
$this->includeFile('layouts/partials/back-to-top');
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/details.js'); ?>"></script>
