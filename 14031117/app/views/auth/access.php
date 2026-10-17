<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
?>
<div class="pb-0 p-2">
    <div class="">
        <h4 class="text-2xl text-center font-bold mt-2"> ایجاد تیم ها و اعضای
            کاربری
        </h4>
        <div class="p-4 rounded-lg dark:bg-gray-800" id="styled-add">
            <div class="container">
                <div class="rounded-lg p-4 bg-white shadow mt-7 add-member">
                    <h5 class="text-center text-xl">افزودن اعضا</h5>
                    <div class="grid grid-cols-1 gap-12 md:grid-cols-2 my-5">
                        <div class="flex flex-col w-full">

                            <label for="userName"> نام کاربری:<span class="text-red-600">*</span> </label>
                            <input id="userName" name="userName" type="text"
                                   class="... invalid:[&amp;:not(:placeholder-shown):not(:focus)]:border-red-500 ltr border border-zinc-400 rounded
                                           md:ms-4 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                                   value="" autocomplete="off">
                            <input id="userId" value="" type="text" hidden="">
                            <label for="userPass" class="mt-5"> رمز
                                ورود:<span class="text-red-600">*</span> </label>
                            <input data-name="forPass" id="userPass" name="userPass" type="text"
                                   class="... invalid:[&amp;:not(:placeholder-shown):not(:focus)]:border-red-500 ltr border border-zinc-400 rounded
                                           md:ms-4 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                                   value="" autocomplete="off">
                            <small data-name="forPass" class="text-gray-500">*حداقل ۶ کاراکتر و ترکیبی
                                از اعداد و حروف انگلیسی بزرگ و کوچک</small>
                            <input id="userId" value="" type="text" hidden=""/>
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="userRole"> سمت: </label>
                            <input id="userRole" name="userRole" type="text"
                                   class="... invalid:[&amp;:not(:placeholder-shown):not(:focus)]:border-red-500 border border-zinc-400 rounded
                                           md:me-4 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                                   value="" autocomplete="off">
                            <div id="accordion-open" data-accordion="open" class="mt-5">
                                <h2 id="accordion-open-heading-1">
                                    <button type="button"
                                            class="flex bg-transparent text-black items-center justify-between w-full rounded-t-xl"
                                            data-accordion-target="#accordion-open-body-1" aria-expanded="true"
                                            aria-controls="accordion-open-body-1">
                                        <span class="flex items-center"> افزودن به تیم های دارای دسترسی:
                               </span>
                                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2" d="M9 5 5 1 1 5"/>
                                        </svg>
                                    </button>
                                </h2>
                                <div id="accordion-open-body-1" class="hidden"
                                     aria-labelledby="accordion-open-heading-1">
                                    <div id="accordion2"
                                         class="md:me-4 pt-3 pr-3 pl-3 pb-0 border border-zinc-400 dark:border-gray-700 dark:bg-gray-900 rounded">
                                        <div class="flex items-center p-2 rounded">
                                            <input id="avaTeam500" type="radio" value="500" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded-full
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                            <label for="avaTeam500"
                                                   class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                بازرگانی- مدیر پروژه
                                            </label>
                                        </div>
                                        <div class="flex items-center p-2 rounded">
                                            <input id="avaTeam501" type="radio" value="501" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded-full
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                            <label for="avaTeam501"
                                                   class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                برنامه ریزی- دفتر
                                            </label>
                                        </div>
                                        <div class="flex items-center p-2 rounded">
                                            <input id="avaTeam502" type="radio" value="502" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded-full
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                            <label for="avaTeam502"
                                                   class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                مهندسی
                                            </label>
                                        </div>
                                        <div class="flex items-center p-2 rounded">
                                            <input id="avaTeam503" type="radio" value="503" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded-full
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                            <label for="avaTeam503"
                                                   class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                تولید
                                            </label>
                                        </div>
                                        <div class="flex items-center p-2 rounded">
                                            <input id="avaTeam504" type="radio" value="504" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded-full
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                            <label for="avaTeam504"
                                                   class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                برنامه ریزی- انبار
                                            </label>
                                        </div>
                                        <div class="flex items-center p-2 rounded">
                                            <input id="avaTeam505" type="radio" value="505" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded-full
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                            <label for="avaTeam505"
                                                   class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                بازرگانی- خرید
                                            </label>
                                        </div>
                                        <div class="flex items-center p-2 rounded">
                                            <input id="avaTeam506" type="radio" value="506" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded-full
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                            <label for="avaTeam506"
                                                   class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                کمیسیون معاملات
                                            </label>
                                        </div>
                                        <div class="flex items-center p-2 rounded">
                                            <input id="avaTeam507" type="radio" value="507" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded-full
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                            <label for="avaTeam507"
                                                   class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                مدیرعامل
                                            </label>
                                        </div>
                                        <div class="flex items-center p-2 rounded">
                                            <input id="avaTeam508" type="radio" value="508" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded-full
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                            <label for="avaTeam508"
                                                   class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                هیات مدیره
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <button type="button" id="createUser" class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4
                            focus:outline-none text-zinc-200 focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg
                            dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                ایجاد
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/access.js'); ?>"></script>