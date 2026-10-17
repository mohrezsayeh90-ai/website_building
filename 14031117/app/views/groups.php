<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
global $flashMessage;
?>
<div class="p-2 pb-0" style="font-family:'Iranian Sans';">
    <section>
        <div class="mx-14">
            <p class="text-3xl text-center mt-2 " style="font-weight: bolder">Basic equipments of accessories</p>
            <div class="w-full my-7 relative mx-auto h-full bg-white rounded-lg p-4">
                <form id="equipmentForm" dir="ltr" method="post" action="<?= $this->url('group/submit') ?>"
                      enctype="multipart/form-data"
                      class="flex flex-row flex-wrap justify-between items-start">
                    <input type="hidden" value="0" id="elementPro" name="elementPro">
                    <input type="hidden" value="0" id="elementID" name="elementID">
                    <div class="relative my-arbitrary-input">
                        <label for="equipment" class="absolute text-this-gray dark:text-gray-400 duration-300
                        transform -translate-y-4 scale-75 top-2 z-0 origin-[0] bg-gray-100 dark:bg-gray-900
                        px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500
                        peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                        peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4
                        rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Equipment</label>
                        <input id="equipment" name="equipment" type="text"
                               class="text-this-gray inline-block border-0 focus:border focus:border-teal-500
                                                       focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                    </div>
                    <div class="relative  my-arbitrary-input">
                        <label for="specification" class="absolute text-this-gray dark:text-gray-400 duration-300
                        transform -translate-y-4 scale-75 top-2 z-0 origin-[0] bg-gray-100 dark:bg-gray-900
                        px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500
                        peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                        peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4
                        rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Specification</label>
                        <textarea id="specification" name="specification" type="text" rows="1"
                                  class="text-this-gray text-wrap h-fit inline-block border-0 focus:border focus:border-teal-500
                                                       focus:ring-1 focus:ring-teal-400"></textarea>
                    </div>
                    <div class="relative my-arbitrary-input">
                        <label for="brand" class="absolute text-this-gray dark:text-gray-400 duration-300
                        transform -translate-y-4 scale-75 top-2 z-0 origin-[0] bg-gray-100 dark:bg-gray-900
                        px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500
                        peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                        peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4
                        rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Brand</label>
                        <input id="brand" name="brand" type="text"
                               class="text-this-gray inline-block border-0 focus:border focus:border-teal-500
                                                       focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                    </div>
                    <button type="button" id="elementButId"
                            class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4
                            focus:outline-none text-zinc-200 focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg
                            dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Save
                    </button>
                    <button type="button" id="clearAll"
                            class="hidden bg-gradient-to-r from-red-200 via-red-400 to-red-600 hover:bg-gradient-to-br focus:ring-4
                            focus:outline-none text-zinc-200 focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-400/50 dark:shadow-lg
                            dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Clear
                    </button>
                </form>
            </div>
        </div>
    </section>
    <section>
        <div class="container ">
            <table class=" display compact ltr"
                   id="elementTable">
                <thead class="text-white uppercase dark:bg-gray-700 dark:text-gray-400 bg-this-teal">
                <tr>
                    <!--                    <th scope="col" class="pr-6 pl-1 py-3 text-end">Date</th>-->
                    <th scope="col" class="pr-6 pl-1 py-3 text-end">Item</th>
                    <th scope="col" class="pr-6 pl-1 py-3 text-end">Equipment</th>
                    <th scope="col" class="pr-6 pl-1 py-3 text-end">Specification</th>
                    <th scope="col" class="pr-6 pl-1 py-3 text-end">Brand</th>
                    <th scope="col" class="pr-6 pl-1 py-3 text-end">Operations</th>


                </tr>
                </thead>
                <tbody class="text-this-gray">
                <?php
                $i = 1;
                foreach ($all as $item) {
                    ?>
                    <tr class="bg-zinc-100 border-b dark:bg-gray-800 ltr dark:border-gray-700 hover:bg-zinc-400 dark:hover:bg-gray-600">
                        <!--                            <td class="ltr"><input class="w-full bg-transparent border-0 focus:ring-0" data-jdp-->
                        <!--                                                   type="text" name="date"-->
                        <!--                                                   autocomplete="off"/></td>-->
                        <td><?= $item["id"] ?></td>
                        <td><?= $item["description"] ?></td>
                        <td><?= $item["type"] ?></td>
                        <td><?= $item["manufacturer"] ?></td>
                        <td class="text-center">
                            <button id="button_element_edit_<?= $item["id"] ?>" type="button"
                                    class="text-yellow-700 font-medium rounded-full hover:animate-pulse
                                                     text-center me-5 mb-2 fa fa-edit"
                                    aria-label="<?= $item["description"] ?>;;;<?= $item["type"] ?>;;;<?= $item["manufacturer"] ?>">

                            </button>
                            <button id="button_element_del_<?= $item["id"] ?>" type="button"
                                    class="text-red-600 font-medium rounded-full hover:animate-pulse
                                                     text-center me-2 mb-2 fa fa-close">

                            </button>
                    </tr>

                    <?php
                } ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php
$this->includeFile('layouts/partials/back-to-top');
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/details.js'); ?>"></script>
