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

<div class="pb-0">
    <div class="container">
        <p class="text-center my-4 text-2xl">فرم تعریف محصول</p>
        <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
            <div class="flex flex-col w-full">
                <div class="flex justify-end">
                    <button id="productsList" data-tooltip-target="tooltip-customer-2" type="button" class="fa fa-th-list
          text-white bg-this-teal hover:bg-this-teal/80 focus:ring-4 focus:outline-none focus:ring-this-teal/50
        font-medium rounded-lg text-lg px-5 py-2.5 text-center inline-flex items-center dark:hover:bg-this-teal/80 dark:focus:ring-this-teal/40 me-2 mb-2 float-end">
                        <i></i>
                    </button>
                    <div id="tooltip-customer-2" role="tooltip"
                         class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        رویت همه موارد
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
                <form id="mainprodForm" class="px-4 my-arbitrary-input" method="post"
                      action="<?= $this->url('product/submit') ?>"
                      enctype="multipart/form-data">
                    <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                        <div class="flex flex-col w-full">
                            <input type="hidden" vale="" id="assignData" name="assignData">
                            <label for="proCode"
                                   class=" text-black">
                                کد محصول:
                            </label>
                            <input type="text" id="proCode" name="proCode" value="<?= $code ?>"
                                   class=".. invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 ltr w-full focus:border
                       focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                                   pattern="PRO-[0-9]{4}"/>
                            <label for="proName"
                                   class="text-black mt-5">
                                نام محصول:
                            </label>
                            <input dir="auto" type="text" id="proName" name="proName"
                                   class="w-full focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                            <label for="proVolt"
                                   class="text-black mt-5">
                                ولتاژ :
                            </label>
                            <select style="padding-left: 10px !important" id="proVolt" name="proVolt"
                                   class=".. invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 ltr w-full focus:border
                       focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400">
                                <option value="-">-</option>
                                <option value="12 KV">12 KV</option>
                                <option value="24 KV">24 KV</option>
                                <option value="40.5 KV">40.5 KV</option>
                            </select>
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="proAmp"
                                   class=" text-black">
                                جریان :
                            </label>
                            <select  style="padding-left: 10px !important"  id="proAmp" name="proAmp"
                                   class=".. invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 ltr w-full focus:border
                       focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400">
                                <option value="-">-</option>
                                <option value="630 A">630 A</option>
                                <option value="1250 A">1250 A</option>
                                <option value="2000 A">2000 A</option>
                                <option value="2500 A">2500 A</option>
                            </select>
                            <label for="proModel"
                                   class="text-black mt-5">
                                مدل :
                            </label>
                            <select  style="padding-left: 10px !important"  id="proModel" name="proModel"
                                   class=".. invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 ltr w-full focus:border
                       focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400">
                                <option value="-">-</option>
                                <option value="AMS">AMS</option>
                                <option value="FLUX">FLUX</option>
                                <option value="CONEX">CONEX</option>

                            </select>
                            <label for="proType"
                                   class="text-black mt-5">
                                 نوع :
                            </label>
                            <select  style="padding-left: 10px !important"  id="proType" name="proType"
                                   class=".. invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 ltr w-full focus:border
                       focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400">
                                <option value="-">-</option>
                                <option value="INCOMMING">INCOMMING</option>
                                <option value="OUTGOING">OUTGOING</option>
                                <option value="OTHER">OTHER</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between mt-10">
                        <label class="block w-fit my-2 bg-black p-2 text-white rounded-lg cursor-pointer font-medium  dark:text-white"
                               for="files">بارگذاری تصویر محصول</label>
                        <input class="hidden" accept=".png,.jpg" type="file" id="files" name="files" hidden/>

                        <button type="button" id="prodSave"
                                class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4
                            focus:outline-none text-zinc-200 focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg
                            dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            ثبت
                        </button>
                        <button type="button" id="clearAllfieldsP"
                                class="hidden bg-gradient-to-r from-red-400 via-red-400 to-red-600 hover:bg-gradient-to-br focus:ring-4
                            focus:outline-none text-zinc-200 focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-400/50 dark:shadow-lg
                            dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            پاک کردن
                        </button>
                    </div>
                </form>
                <div class="relative mt-5">
                    <p class="text-center text-xl">فهرست ادوات تخصیص داده شده</p>
                    <div class="colorful-counter"></div>
                    <div style="overflow-y: scroll;max-height: 400px"
                         class="ltr relative overflow-x-auto shadow-md sm:rounded-lg ">

                        <table id="equipmentTableA" class="w-full text-sm text-left text-this-gray dark:text-gray-400">
                            <thead class="text-white uppercase bg-this-teal dark:bg-gray-700 dark:text-gray-400">
                            <tr>

                                <th scope="col" class="px-6 py-3">
                                    Equipment name
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="flex flex-col w-full">

                <div class="relative h-full overflow-x-hidden border border-this-teal border-b-0 shadow-md sm:rounded-t-lg">
                    <div class="relative mt-2">
                        <p class="text-center text-xl">فهرست ادوات قابل تخصیص</p>
                        <div class="colorful-counter"></div>
                    </div>
                    <table id="equipmentTable"
                           class="m-0 h-full w-full text-sm text-left text-this-gray dark:text-gray-400">
                        <thead class="text-white text-white uppercase bg-this-teal dark:bg-gray-700 dark:text-gray-400">
                        <tr style="max-height: 30px">
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Equipment name
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($allequip as $itm) {
                            ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="fa fa-plus-square ml-5"
                                    onclick='addItems("<?= str_replace(array("\r", "\n"), '', $itm['description']) ?>")'></td>
                                <td class="text-left ml-2"><?= str_replace(array("\r", "\n"), '', $itm['description']) ?></td>
                            </tr>
                            <?php
                        } ?>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>

<?php
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/product.js'); ?>"></script>