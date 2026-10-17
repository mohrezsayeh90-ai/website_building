<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
global $flashMessage;
?>
<div  id="list00"
     class="z-20 hidden absolute flex flex-wrap  mt-3 text-sm font-medium rounded-lg hover:ring-2
      text-gray-500 border-1 bg-gray-200 border-gray-400 dark:border-gray-700 dark:text-gray-400 "
     style="max-height:500px;--width:65%;top: 32px;margin-right: 168px;min-width:300px ; overflow-y: scroll">

    <ul  class="list-none p-2 w-full" id="result00">
        <?php
        foreach ($customerList as $customer) {
            ?>
            <li aria-label="<?= $customer['cod'] ?>" title="<?= $customer['email'] ?>" class="ml-2 hover:bg-black hover:text-white cursor-pointer"><?= $customer['nam'] ?></li>
            <?php
        }
        ?>
    </ul>
</div>
<div class="pb-0">
    <div id="default-styled-tab-content">

            <section>
                <div class="">
                    <h4 class="text-2xl text-center">شناسنامه پروژه</h4>
                    <div class="relative">
                                <div class="container">
                                    <button id="projectList"
                                            data-tooltip-target="tooltip-customer-2" type="button" class="fa fa-th-list
          text-white bg-this-teal hover:bg-this-teal/80 focus:ring-4 focus:outline-none focus:ring-this-teal/50
        font-medium rounded-lg text-lg px-5 py-2.5 text-center inline-flex items-center dark:hover:bg-this-teal/80 dark:focus:ring-this-teal/40
         me-2 mb-2 float-end">
                                    </button>
                                    <div id="tooltip-customer-2" role="tooltip" class="absolute z-10 inline-block px-3 py-2 text-sm font-medium text-white
                    transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm tooltip dark:bg-gray-700 opacity-0 invisible"
                                         data-popper-placement="top">
                                        رویت همه موارد
                                        <div class="tooltip-arrow" data-popper-arrow=""></div>
                                    </div>
                                    <div class="rounded-lg bg-white border border-zinc-300 clear-left" id="form1">
                                        <div class="bg-zinc-300 p-2 rounded-t-lg">
                                            <h5 class="text-center text-lg">مشخصات کلی</h5>
                                        </div>
                                        <div class="p-3">
                                            <form class="my-arbitrary-input" id="mainProjForm" method="post" action="project/saveProj">
                                                <input type="hidden" id="cuscod" name="cuscod" value="">
                                                <input type="hidden" id="updateProj" name="updateProj" value="0">
                                                <input type="hidden" id="consulcod" name="consulcod" value="">
                                                <label for="projectName"
                                                       class="text-this-gray mt-5">
                                                   موضوع پروژه*:
                                                </label>
                                                <input id="projectName" name="projectName" type="text"
                                                       class="w-full border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                                                       autocomplete="off"/>

                                                <div class="my-5">
                                                    <label for="ii"
                                                           class="text-this-gray text-sm">
                                                         محدودۀ پروژه شامل موارد ذیل می شود:
                                                    </label>
                                                    <div id="dropdownSearch"
                                                         class="flex flex-row z-10 bg-slate-100 rounded-lg shadow w-auto dark:bg-gray-700">


                                                        <div class="flex items-center p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-600">
                                                            <input id="checkbox-item-11" name="checkbox-item-11" type="checkbox"
                                                                   value="1"
                                                                   class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                                            <label for="checkbox-item-11"
                                                                   class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                                آموزش</label>
                                                        </div>

                                                        <div class="flex items-center p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-600">
                                                            <input  id="checkbox-item-12" name="checkbox-item-12"
                                                                   type="checkbox"
                                                                   value="1" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                                            <label for="checkbox-item-12"
                                                                   class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                                نظارت بر نصب</label>
                                                        </div>
                                                        <div class="flex items-center p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-600">
                                                            <input  id="checkbox-item-13" name="checkbox-item-13"
                                                                   type="checkbox"
                                                                   value="1" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                                            <label for="checkbox-item-13"
                                                                   class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                                نصب و راه اندازی</label>
                                                        </div>
                                                        <div class="flex items-center p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-600">
                                                            <input  id="checkbox-item-13" name="checkbox-item-14"
                                                                   type="checkbox"
                                                                   value="1" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                                            <label for="checkbox-item-13"
                                                                   class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                                حمل و تخلیه</label>
                                                        </div>

                                                    </div>
                                                    <div class="flex w-full">
                                                        <div class="basis-1/2 flex flex-col px-7">
                                                            <label for="contract"
                                                                   class="text-this-gray mt-5">
                                                                شماره قرارداد:
                                                            </label>
                                                            <input id="contract" dir="ltr" readonly name="contract" type="text" value="<?=$code?>"
                                                                   class="border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                                                                   autocomplete="off"/>
                                                            <label for="manager"
                                                                   class="text-this-gray mt-5">
                                                                مدیر پروژه*:
                                                            </label>
                                                            <input id="manager" name="manager" type="text"
                                                                   class="border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                            <label for="contact"
                                                                   class="text-this-gray mt-5">
                                                                شماره تماس/ایمیل:
                                                            </label>
                                                            <input id="contact" name="contact" type="text"
                                                                   class="border-0 focus:border ltr focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                            <div class="flex flex-col md:flex-row w-full items-center mt-5">
                                                                <div class="md:basis-1/2 basis-1 md:ml-2">
                                                                    <label for="startDate"
                                                                           class="text-this-gray mt-5">
                                                                        تاریخ شروع پروژه*:
                                                                    </label>
                                                                    <input id="startDate" data-jdp name="startDate"
                                                                           type="text"
                                                                           class="w-full border-0 focus:border focus:border-teal-500 focus:ring-1
                                hover:border-teal-500 hover:border focus:ring-teal-400" autocomplete="off"/>
                                                                </div>
                                                                <div class="md:basis-1/2 basis-1 mt-5 md:mt-0 md:mr-2">
                                                                    <label for="location"
                                                                           class="text-this-gray mt-5">
                                                                        محل تحویل موضوع قرارداد*:
                                                                    </label>
                                                                    <input id="location" name="location" type="text"
                                                                           class="w-full border-0 focus:border focus:border-teal-500 focus:ring-1
                                hover:border-teal-500 hover:border focus:ring-teal-400" autocomplete="off"/>
                                                                </div>


                                                            </div>
                                                            <div class="flex w-full mt-5">
                                                                <div class="basis-1/2">
                                                                    <div class="flex-col flex">
                                                                        <label for="duration"
                                                                               class="text-this-gray">
                                                                            مدت زمان اجرای پروژه*:
                                                                        </label>
                                                                        <div class="flex items-center">
                                                                            <input id="duration" name="duration"
                                                                                   type="text"
                                                                                   class="w-24 border-0 focus:border focus:border-teal-500 focus:ring-1
                                hover:border-teal-500 hover:border focus:ring-teal-400" autocomplete="off"/>
                                                                            <select name="vahed" class="lg:mx-7 min-w-12 mx-3 border-0">
                                                                                <option value="0">روز</option>
                                                                                <option value="1">ماه شمسی</option>
                                                                                <option value="2">سال</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="basis-1/2 ">
                                                                    <label for="insurance"
                                                                           class="text-this-gray mt-5">
                                                                        دورهْ تضمین*:
                                                                    </label>
                                                                    <input id="insurance" name="insurance" type="text" class="w-full border-0 focus:border focus:border-teal-500 focus:ring-1
                                hover:border-teal-500 hover:border focus:ring-teal-400" autocomplete="off"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="basis-1/2 flex flex-col px-7">
                                                            <label for="customer"
                                                                   class="text-this-gray mt-5">
                                                                کارفرما*:
                                                            </label>
                                                            <input id="customer" name="customer" type="text" class="border-0 focus:border focus:border-teal-500 focus:ring-1
                                hover:border-teal-500 hover:border focus:ring-teal-400" autocomplete="off"/>
                                                            <label for="operator"
                                                                   class="text-this-gray mt-5">
                                                                مجری طرح کارفرما*:
                                                            </label>
                                                            <input id="operator" name="operator" type="text"
                                                                   class="border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                            <label for="contactCus"
                                                                   class="text-this-gray mt-5">
                                                                شماره تماس/ایمیل:
                                                            </label>
                                                            <input id="contactCus" name="contactCus" type="text"
                                                                   class="border-0 focus:border ltr focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                            <div class="flex flex-col md:flex-row w-full items-center mt-5">
                                                                <div class="basis-1 md:basis-1/2 md:ml-2">
                                                                    <label for="consultant"
                                                                           class="text-this-gray">
                                                                        مشاور*:
                                                                    </label>
                                                                    <input id="consultant" name="consultant" type="text"
                                                                           class="w-full border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                                </div>
                                                                <div class="basis-1 md:basis-1/2 md:mr-2 md:mt-0 mt-5">
                                                                    <label for="contactCon"
                                                                           class="text-this-gray mt-5">
                                                                        شماره تماس/ایمیل:
                                                                    </label>
                                                                    <input readonly id="contactCon" name="contactCon" type="text"
                                                                           class="w-full border-0 focus:border ltr focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                                </div>
                                                            </div>
                                                            <label for="penalty"
                                                                   class="text-this-gray mt-5">
                                                                جریمه تأخیر و سقف آن:
                                                            </label>
                                                            <input id="penalty" name="penalty" type="text" class="w-full border-0 focus:border focus:border-teal-500 focus:ring-1
                                hover:border-teal-500 hover:border focus:ring-teal-400" autocomplete="off"/>

                                                        </div>
                                                    </div>

                                                    <div class="flex w-full mt-5">


                                                    </div>
                                                </div>
                                                <div class="flex justify-center">
                                                    <button
                                                            type="button" id="submitKoli" class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4
                            focus:outline-none text-zinc-200 focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg
                            dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                                        ثبت
                                                    </button>
                                                    <button type="button" id="clearAllfieldsProj"
                                                            class="hidden bg-gradient-to-r from-red-400 via-red-400 to-red-600 hover:bg-gradient-to-br focus:ring-4
                            focus:outline-none text-zinc-200 focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-400/50 dark:shadow-lg
                            dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                                        پاک کردن
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>

                    </div>
                </div>
            </section>



    </div>

</div>
<?php
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/project.js'); ?>"></script>