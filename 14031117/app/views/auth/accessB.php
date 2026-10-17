<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
        data-tabs-toggle="#default-styled-tab-content"
        data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
        data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
        role="tablist">
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="add-styled-tab"
                    data-tabs-target="#styled-add"
                    type="button" role="tab" aria-controls="add" aria-selected="false">ایجاد تیم ها و اعضای
                کاربری
            </button>
        </li>
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="teams-styled-tab" data-tabs-target="#styled-teams" type="button" role="tab"
                    aria-controls="teams" aria-selected="false">تعیین سطح دسترسی تیم ها
            </button>
        </li>
    </ul>
</div>
<div id="default-styled-tab-content">
    <div id="default-styled-tab-content">
        <di class="hidden p-4 rounded-lg dark:bg-gray-800" id="styled-add" role="tabpanel"
            aria-labelledby="add-tab">
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
                            <div data-bs-toggle="accordion" data-bs-target="accordion2"
                                 class="dark:text-gray-400 mt-5">
                                <span>افزودن به تیم های دارای دسترسی:</span>
                                <i class="fa fa-chevron-down"></i>
                            </div>
                            <div id="accordion2"
                                 class="md:me-4 pt-3 pr-3 pl-3 pb-0 border border-zinc-400 dark:border-gray-700 dark:bg-gray-900 rounded">
                                <div class="flex items-center p-2 rounded">
                                    <input id="avaTeam22" type="checkbox" value="22" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                    <label for="avaTeam22"
                                           class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                        بازرگانی- مدیر پروژه
                                    </label>
                                </div>
                                <div class="flex items-center p-2 rounded">
                                    <input id="avaTeam22" type="checkbox" value="22" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                    <label for="avaTeam22"
                                           class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                        برنامه ریزی- دفتر
                                    </label>
                                </div>
                                <div class="flex items-center p-2 rounded">
                                    <input id="avaTeam22" type="checkbox" value="22" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                    <label for="avaTeam22"
                                           class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                        مهندسی
                                    </label>
                                </div>
                                <div class="flex items-center p-2 rounded">
                                    <input id="avaTeam22" type="checkbox" value="22" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                    <label for="avaTeam22"
                                           class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                        تولید
                                    </label>
                                </div>
                                <div class="flex items-center p-2 rounded">
                                    <input id="avaTeam22" type="checkbox" value="22" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                    <label for="avaTeam22"
                                           class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                        برنامه ریزی- انبار
                                    </label>
                                </div>
                                <div class="flex items-center p-2 rounded">
                                    <input id="avaTeam22" type="checkbox" value="22" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                    <label for="avaTeam22"
                                           class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                        بازرگانی- خرید
                                    </label>
                                </div>
                                <div class="flex items-center p-2 rounded">
                                    <input id="avaTeam22" type="checkbox" value="22" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                    <label for="avaTeam22"
                                           class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                        کمیسیون معاملات
                                    </label>
                                </div>
                                <div class="flex items-center p-2 rounded">
                                    <input id="avaTeam22" type="checkbox" value="22" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                    <label for="avaTeam22"
                                           class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                        مدیرعامل
                                    </label>
                                </div>
                                <div class="flex items-center p-2 rounded">
                                    <input id="avaTeam22" type="checkbox" value="22" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                    <label for="avaTeam22"
                                           class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                        هیات مدیره
                                    </label>
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
        </di>

        <div class="hidden p-4 rounded-lg dark:bg-gray-800" id="styled-teams" role="tabpanel"
             aria-labelledby="teams-tab">
            <div class="container">
                <div class="rounded shadow p-3 bg-white">
                    <p class="text-gray-500 text-sm mb-2">ابتدا تیم مورد نظر را انتخاب و سپس دسترسی های مربوطه را
                        تعیین
                        نمایید.</p>
                    <ul class="list-group border border-gray-200 rounded" id="teamListGroup">
                        <li class="list-group-item hover:bg-gray-100 border-b border-gray-200" id="teamLi22">
                            <div class="flex flex-row items-center px-2">
                                <div class="flex-none basis-2/5">
                                    <div class="flex items-center p-2 rounded">
                                        <input id="firstRadio22" type="radio" value="2" name="teamListGroupRadio"
                                               class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded-full
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500"/>
                                        <label for="firstRadio22"
                                               class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">شخص
                                            حقوقی
                                        </label>
                                    </div>
                                </div>
                                <div class="shrink basis-2/5 team-users">
                                    <ol type="1" class="d-inline-flex flex-wrap">
                                        <li class="me-4" id="inTeamLi46">modirQA _</li>
                                    </ol>
                                </div>
                                <div class="flex-none basis-1/5">
                                    <i class="fa fa-trash d-none"></i>
                                    <span class="badge rounded-pill"></span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div id="accordion-collapse" data-accordion="collapse" class="mt-5">
                    <h2 id="accordion-collapse-heading-1">
                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0
                             border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400
                             hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                                data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                                aria-controls="accordion-collapse-body-1">
                            <strong>تعیین دسترسی ها</strong>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
                        <div class="p-5 bg-white border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                            <ul class="list-group">
                                <li class="list-group-item bg-transparent">
                                    <div class="flex items-center p-2 rounded">
                                        <input id="avaTeam22" type="checkbox" value="check35" name="avaTeam" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                        <label for="avaTeam22"
                                               class="w-full ms-2 font-bold text-gray-900 rounded dark:text-gray-300">
                                            هیات مدیره
                                        </label>
                                    </div>
                                    <ul class="list-group border border-zinc-400 rounded inner-accordion mx-5">
                                        <li class="list-group-item">
                                            <div class="flex items-center p-2 rounded bg-gary-50">
                                                <input id="avaTeam22" type="checkbox" value="check5" name="avaTeam"
                                                       class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                                <label for="avaTeam22"
                                                       class="w-full ms-2 font-medium text-gray-900 rounded dark:text-gray-300">
                                                    هیات مدیره
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="flex items-center p-2 rounded bg-gary-100">
                                                <input id="avaTeam22" type="checkbox" value="check55" name="avaTeam"
                                                       class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                                <label for="avaTeam22"
                                                       class="w-full ms-2 font-medium text-gray-900 rounded dark:text-gray-300">
                                                    هیات مدیره
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="flex justify-center mt-7">
                                <button type="button" id="confirmTeamAccess" class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4
                            focus:outline-none text-zinc-200 focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg
                            dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    تأیید
                                    سطح
                                    دسترسی ها
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>