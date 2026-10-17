<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
global $flashMessage;
?>

<?php if (isset($flashMessage)): ?>
    <div class="container my-alerts form-alert" style="font-family: 'Iranian Sans'">
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
                <h5><?= $this->flash('message') ?></h5>
            </div>
        </div>
    </div>
<?php endif; ?>


<div class="p-2 pb-0">
    <div class="container">
        <h4 class="text-2xl text-center font-bold mt-2">کارفرمایان و مشاورین</h4>
        <button id="customersList" data-tooltip-target="tooltip-customer-2" type="button" class="fa fa-th-list
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
        <div class="rounded-lg p-4 bg-white shadow mt-7">
            <form id="customerAdd" method="post" action="<?= $this->url("customer/submit") ?>"
                  class="my-arbitrary-input" enctype="multipart/form-data">
                <input type="hidden" id="editCustomers" name="editCustomers" value="-1">
                <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                    <div class="flex flex-col w-full">
                        <label for="cusCode">کد کارفرما: </label>
                        <input id="cusCode" name="cusCode" type="text" placeholder="MOT-0000"
                               class="... invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 ltr border-0 md:ms-4 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                            value="<?=$code?>"   autocomplete="off" pattern="MOT-[0-9]{4}"/>
                        <label for="name" class="mt-7"> نام شرکت یا شخص حقیقی:<em
                                    class="text-red-400">*</em></label>
                        <input id="name" name="name" type="text"
                               class="md:me-4 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                               autocomplete="off"/>
                        <label for="eName" class="mt-7 float-end ltr">Name in english:<em
                                    class="text-red-400">*</em></label>
                        <input dir="ltr" id="eName" name="eName" type="text"
                               class="md:ms-4 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                               autocomplete="off"/>

                        <label for="address" class="mt-7"> آدرس:<em
                                    class="text-red-400">*</em></label>
                        <input id="address" name="address" type="text"
                               class="md:me-4 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                               autocomplete="off"/>
                        <label for="phone1" class="mt-7"> تلفن۱:<em
                                    class="text-red-400">*</em></label>
                        <input id="phone1" name="phone1" type="text"
                               class="md:ms-4 ltr border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                               autocomplete="off"/>

                        <div class="md:break-after-column mt-5">
                            <div class="flex flex-row">
                                <div class="">
                                    <div class="flex items-center p-2 rounded">
                                        <input id="cusType1" type="radio" value="2" name="cusType" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500" checked>
                                        <label for="cusType1"
                                               class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">شخص
                                            حقوقی
                                        </label>

                                    </div>
                                    <div class="flex items-center p-2 rounded">
                                        <input id="cusType2" type="radio" value="1" name="cusType" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                        <label for="cusType2"
                                               class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                            شخص حقیقی
                                        </label>
                                    </div>
                                    <label class="block w-fit my-2 bg-black p-2 md:ms-4 mt-7 text-white rounded-lg hover:bg-gray-600 cursor-pointer text-sm font-medium
                            dark:text-white" for="files">بارگذاری لوگو</label>
                                    <input class="hidden" accept=".png" type="file" id="files" name="files" hidden/>
                                </div>

                                <div class="ms-28">
                                    <div class="flex items-center p-2 rounded">
                                        <input id="cusRole1" type="checkbox" value="1" name="cusRole1" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500" checked>
                                        <label for="cusRole1"
                                               class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                            کارفرما
                                        </label>
                                    </div>
                                    <div class="flex items-center p-2 rounded">
                                        <input id="cusRole2" type="checkbox" value="2" name="cusRole2" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                        <label for="cusRole2"
                                               class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                            مشاور
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="flex flex-col w-full">
                        <label for="email" class="mt-0 md:ms-4"> ایمیل:<em
                                    class="text-red-400">*</em></label>
                        <input id="email" name="email" type="text"
                               class="ltr md:me-4 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                               autocomplete="off"/>
                        <label for="postCode" class="mt-7 md:ms-4">کد پستی: <em
                                    class="text-red-400">*</em></label>
                        <input id="postCode" name="postCode" type="text"
                               class="ltr md:me-4 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                               autocomplete="off"/>

                        <label for="identitiy" class="mt-7 md:ms-4">کد / شناسه ملی:<em
                                    class="text-red-400">*</em></label>
                        <input id="identitiy" name="identitiy" type="text"
                               class="ltr md:me-4 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                               autocomplete="off"/>
                        <label for="fax" class="mt-7 md:ms-4"> دورنما:</label>
                        <input id="fax" name="fax" type="text"
                               class="ltr md:me-4 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                               autocomplete="off"/>
                        <label for="phone2" class="mt-7 md:ms-4"> تلفن۲:</label>
                        <input id="phone2" name="phone2" type="text" placeholder="Mobile"
                               class="ltr md:me-4 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                               autocomplete="off"/>
                        <label for="connector" class="mt-7 md:ms-4"> نام رابط:<em class="text-red-400">*</em></label>
                        <input id="connector" name="connector" type="text"
                               class=" md:ms-4 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border
                               focus:ring-teal-400"
                               autocomplete="off"/>
                    </div>
                </div>
        </div>
                    <div class="flex justify-center mt-7">
                        <button type="button" id="submitInfo" class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4
                            focus:outline-none text-zinc-200 focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg
                            dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            ذخیره اطلاعات
                        </button>
                        <button type="button" id="clearAllfields"
                                class="hidden bg-gradient-to-r from-red-400 via-red-400 to-red-600 hover:bg-gradient-to-br focus:ring-4
                            focus:outline-none text-zinc-200 focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-400/50 dark:shadow-lg
                            dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            پاک کردن
                        </button>
                    </div>
            </form>
        </div>
<!--        <h4 class="mt-7 md:ms-4">آخرین تعاملات</h4>-->
        <!--                <div class="position-relative" style="border-top:1px solid var(--refah-khaki)">-->
        <!--                    <table class="table my-stripped-table mb-4 w-100" id="machineTable"-->
        <!--                           style="--row2:var(--refah-khaki);--row1:var(--light-silver);--row1Dark:#eeeeee4d ;--row2Dark:#cec7c175">-->
        <!--                        <thead>-->
        <!--                        <tr>-->
        <!--                            <th scope="col">-->
        <!--                                ردیف-->
        <!--                            </th>-->
        <!--                            <th scope="col">-->
        <!--                                کد متقاضی-->
        <!--                            </th>-->
        <!--                            <th scope="col">-->
        <!--                                نام متقاضی-->
        <!--                            </th>-->
        <!--                            <th scope="col">-->
        <!--                                کد سفارش-->
        <!--                            </th>-->
        <!--                            <th scope="col">-->
        <!--                                کد محصول-->
        <!--                            </th>-->
        <!--                            <th scope="col">-->
        <!--                                تاریخ عقد-->
        <!--                            </th>-->
        <!--                            <th scope="col">-->
        <!--                                تاریخ تحویل-->
        <!--                            </th>-->
        <!---->
        <!--                        </tr>-->
        <!--                        </thead>-->
        <!--                        <tbody>-->
        <!--                        --><?php
        //                        $n = 1;
        //                        foreach ($lastOrders as $item): ?>
        <!--                            <tr>-->
        <!--                                <td class="ps-4">-->
        <!--                                    --><?php //= $n++ ?>
        <!--                                </td>-->
        <!--                                <td>-->
        <!--                                    --><?php //= $item["moshtari_cod"] ?>
        <!--                                </td>-->
        <!--                                <td>-->
        <!--                                    --><?php //= $item["moshtari_nam"] ?>
        <!--                                </td>-->
        <!--                                <td>-->
        <!--                                    --><?php //= $item["sefaresh_cod"] ?>
        <!--                                </td>-->
        <!--                                <td>-->
        <!--                                    --><?php //= $item["mahsoul_cod"] ?>
        <!--                                </td>-->
        <!--                                <td>-->
        <!--                                    --><?php //= dateFormatter2($item["qarardad_tarikh"]) ?>
        <!--                                </td>-->
        <!--                                <td>-->
        <!--                                    --><?php //= dateFormatter2($item["tarikh_tahvil"]) ?>
        <!--                                </td>-->
        <!--                            </tr>-->
        <!--                        --><?php //endforeach; ?>
        <!--                        </tbody>-->
        <!--                    </table>-->
        <!--                </div>-->
    </div>
</div>
<?php
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/customer.js'); ?>"></script>
