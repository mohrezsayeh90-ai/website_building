<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
global $flashMessage;
?>
<div class="pb-0">
    <div class="border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center mt-3" id="default-styled-tab"
            data-tabs-toggle="#default-styled-tab-content"
            data-tabs-active-classes="text-purple-600"
            data-tabs-inactive-classes="dark:border-transparent text-this-gray hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
            role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="identity-styled-tab"
                        data-tabs-target="#styled-identity" type="button" role="tab" aria-controls="identity"
                        aria-selected="false">شناسنامه پروژه
                </button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="EPL-styled-tab" data-tabs-target="#styled-EPL" type="button" role="tab"
                        aria-controls="EPL" aria-selected="false">EPL
                </button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="DPL-styled-tab" data-tabs-target="#styled-DPL" type="button" role="tab"
                        aria-controls="DPL" aria-selected="false">DPL
                </button>
            </li>
        </ul>
    </div>
    <div id="default-styled-tab-content">
        <div class="hidden pb-0 rounded-lg dark:bg-gray-800" id="styled-identity" role="tabpanel"
             aria-labelledby="identity-tab">
            <section>
                <div class="">
                    <h4 class="text-2xl text-center">شناسنامه پروژه</h4>
                    <div id="circles" class="mx-auto ltr flex items-center justify-between w-96 my-5">
                        <a href="#form1">
                            <div class="back-circle bg-gray-100">
                                <div class="my-circle hover:border-teal-400" style="--slist: #d9d9d9">
                                    کلی
                                </div>
                            </div>
                        </a>
                        <a href="#form2">
                            <div class="back-circle bg-gray-100">
                                <div class="my-circle hover:border-teal-400" style="--slist: #d9d9d9">
                                    فنی
                                </div>
                            </div>
                        </a>
                        <a href="#form3">
                            <div class="back-circle bg-gray-100">
                                <div class="my-circle hover:border-teal-400" style="--slist: #d9d9d9">
                                    مالی
                                </div>
                            </div>
                        </a>
                        <a href="#form4">
                            <div class="back-circle bg-gray-100">
                                <div class="my-circle hover:border-teal-400" style="--slist: #d9d9d9">
                                    ریسک
                                </div>
                            </div>
                        </a>
                        <a href="#form5">
                            <div class="back-circle bg-gray-100">
                                <div class="my-circle hover:border-teal-400" style="--slist: #d9d9d9">
                                    پیوست
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="relative">
                        <div class="my-scroll-parent scroll1">
                            <div class="my-scroll-div">
                                <div class="container">
                                    <div class="my-7 rounded-lg bg-white border border-zinc-300" id="form1">
                                        <div class="bg-zinc-300 p-2 rounded-t-lg">
                                            <h5 class="text-center text-lg">مشخصات کلی</h5>
                                        </div>
                                        <div class="p-3">
                                            <form class="my-arbitrary-input">
                                                <p class="text-this-gray">موضوع پروژه:</p>
                                                <p class="font-bold text-center">مناقصه ۱</p>
                                                <div class="my-5">
                                                    <label for="ii"
                                                           class="text-this-gray text-sm">
                                                        * محدودۀ پروژه شامل موارد ذیل می شود:
                                                    </label>
                                                    <div id="dropdownSearch"
                                                         class="z-10 bg-slate-100 rounded-lg shadow w-60 dark:bg-gray-700">
                                                        <ul class="h-48 p-3 pb-3 overflow-y-auto text-sm dark:text-gray-200"
                                                            aria-labelledby="dropdownSearchButton">
                                                            <li>
                                                                <div class="flex items-center p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-600">
                                                                    <input id="checkbox-item-11" type="checkbox"
                                                                           value=""
                                                                           class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                                                    <label for="checkbox-item-11"
                                                                           class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                                        آموزش</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="flex items-center p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-600">
                                                                    <input checked="" id="checkbox-item-12"
                                                                           type="checkbox"
                                                                           value="" class="w-4 h-4 text-teal-500 bg-gray-100 border-gray-300 rounded
                                focus:ring-teal-400 dark:focus:ring-teal-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-1 dark:bg-gray-600
                                dark:border-gray-500">
                                                                    <label for="checkbox-item-12"
                                                                           class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                                        نظارت بر نصب</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="flex w-full">
                                                        <div class="basis-1/2 flex flex-col px-7">
                                                            <label for="contract"
                                                                   class="text-this-gray mt-5">
                                                                شماره قرارداد:
                                                            </label>
                                                            <input id="contract" name="contract" type="text"
                                                                   class="border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                                                                   autocomplete="off"/>
                                                            <label for="manager"
                                                                   class="text-this-gray mt-5">
                                                                مدیر پروژه:
                                                            </label>
                                                            <input id="manager" name="manager" type="text"
                                                                   class="border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                            <label for="contact"
                                                                   class="text-this-gray mt-5">
                                                                شماره تماس/ایمیل:
                                                            </label>
                                                            <input id="contact" name="contact" type="text"
                                                                   class="border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                        </div>
                                                        <div class="basis-1/2 flex flex-col px-7">
                                                            <label for="customer"
                                                                   class="text-this-gray mt-5">
                                                                کارفرما:
                                                            </label>
                                                            <input id="customer" name="customer" type="text" class="border-0 focus:border focus:border-teal-500 focus:ring-1
                                hover:border-teal-500 hover:border focus:ring-teal-400" autocomplete="off"/>
                                                            <label for="operator"
                                                                   class="text-this-gray mt-5">
                                                                مجری طرح کارفرما:
                                                            </label>
                                                            <input id="operator" name="operator" type="text"
                                                                   class="border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                            <label for="contactCus"
                                                                   class="text-this-gray mt-5">
                                                                شماره تماس/ایمیل:
                                                            </label>
                                                            <input id="contactCus" name="contactCus" type="text"
                                                                   class="border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                            <span class="text-this-gray mt-5">مشاور</span>
                                                            <div class="flex items-center justify-between">
                                                                <div>
                                                                    <input id="yesCns" type="radio" value="yes"
                                                                           name="consultant-radio"
                                                                           class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-1 dark:bg-gray-700 dark:border-gray-600">
                                                                    <label for="yesCns"
                                                                           class="me-2 ms-1 text-sm font-medium text-gray-900 dark:text-gray-300">دارد</label>
                                                                    <input id="noCns" type="radio" value="no"
                                                                           name="consultant-radio"
                                                                           class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-1 dark:bg-gray-700 dark:border-gray-600">
                                                                    <label for="noCns"
                                                                           class="me-2 ms-1 text-sm font-medium text-gray-900 dark:text-gray-300">ندارد</label>
                                                                </div>
                                                                <label for="contactCns"
                                                                       class="text-this-gray text-xs">
                                                                    شماره تماس/ایمیل:
                                                                </label>
                                                                <input id="contactCns" name="contactCns" type="text"
                                                                       class="w-1/2 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex w-full mt-5">
                                                        <div class="basis-1/3 px-7">
                                                            <label for="startDate"
                                                                   class="text-this-gray mt-5">
                                                                تاریخ شروع پروژه:
                                                            </label>
                                                            <input id="startDate" data-jdp name="startDate" type="text"
                                                                   class="border-0 focus:border focus:border-teal-500 focus:ring-1
                                hover:border-teal-500 hover:border focus:ring-teal-400" autocomplete="off"/>
                                                        </div>
                                                        <div class="basis-1/3">
                                                            <label for="location"
                                                                   class="text-this-gray mt-5">
                                                                محل تحویل موضوع قرارداد:
                                                            </label>
                                                            <input id="location" name="location" type="text" class="w-full border-0 focus:border focus:border-teal-500 focus:ring-1
                                hover:border-teal-500 hover:border focus:ring-teal-400" autocomplete="off"/>
                                                        </div>

                                                        <div class="basis-1/3 pr-16">
                                                            <div class="flex-col flex items-end">
                                                                <label for="duration"
                                                                       class="text-this-gray ml-16">
                                                                    مدت زمان اجرای پروژه:
                                                                </label>
                                                                <div class="flex items-center">
                                                                    <input id="duration" name="duration" type="text"
                                                                           class="w-24 border-0 focus:border focus:border-teal-500 focus:ring-1
                                hover:border-teal-500 hover:border focus:ring-teal-400" autocomplete="off"/>
                                                                    <select class="lg:mx-7 min-w-12 mx-3 border-0">
                                                                        <option>روز</option>
                                                                        <option>ماه</option>
                                                                        <option>سال</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="flex w-full mt-5">
                                                        <div class="basis-1/3 px-7">
                                                            <label for="insurance"
                                                                   class="text-this-gray mt-5">
                                                                دورهْ تضمین:
                                                            </label>
                                                            <input id="insurance" name="insurance" type="text" class="border-0 focus:border focus:border-teal-500 focus:ring-1
                                hover:border-teal-500 hover:border focus:ring-teal-400" autocomplete="off"/>
                                                        </div>
                                                        <div class="basis-1/3">
                                                            <label for="penalty"
                                                                   class="text-this-gray mt-5">
                                                                جریمه تأخیر و سقف آن:
                                                            </label>
                                                            <input id="penalty" name="penalty" type="text" class="w-full border-0 focus:border focus:border-teal-500 focus:ring-1
                                hover:border-teal-500 hover:border focus:ring-teal-400" autocomplete="off"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex justify-center">
                                                    <button onclick="window.open('<?=Base_Url?>/project/pdfmaker','_blank')" type="button" id="submitKoli" class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4
                            focus:outline-none text-zinc-200 focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg
                            dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                                        ثبت
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="my-7 rounded-lg bg-white border border-zinc-300" id="form2">
                                        <div class="bg-zinc-300 p-2 rounded-t-lg">
                                            <h5 class="text-center text-lg">مشخصات فنی</h5>
                                        </div>
                                        <div class="p-3">
                                            <form class="my-arbitrary-input">
                                                <table class="w-full border-collapse table-auto text-sm" id="faniTable">
                                                    <thead>
                                                    <tr aria-label="-" class="bg-this-teal">
                                                        <th class="text-start p-1 pr-2 text-white" scope="col">
                                                            ردیف
                                                        </th>
                                                        <th class="text-start p-1 pr-2 text-white" scope="col">
                                                            شرح
                                                        </th>
                                                        <th class="text-start p-1 pr-2 text-white" scope="col">
                                                            تعداد
                                                        </th>
                                                        <th class="text-start p-1 pr-2 text-white" scope="col">
                                                            نوع تابلو
                                                        </th>
                                                        <th class="text-start p-1 pr-2 text-white" scope="col">
                                                            PT فیکس/ کشویی
                                                        </th>
                                                        <th class="text-start p-1 pr-2 text-white" scope="col">
                                                            رنگ
                                                        </th>
                                                        <th class="text-start p-1 pr-2 text-white" scope="col">
                                                            نوع دسترسی
                                                        </th>
                                                        <th class="text-start p-1 pr-2 text-white" scope="col">
                                                            روبند تجهیزات/درب داخلی
                                                        </th>
                                                        <th class="text-start p-1 pr-2 text-white" scope="col">
                                                            درجه حفاظت
                                                        </th>
                                                        <th class="text-start p-1 pr-2 text-white" scope="col">
                                                            قدرت قطع تابلو(KA)
                                                        </th>
                                                        <th class="text-start p-1 pr-2 text-white" scope="col">
                                                            شماره سفارش
                                                        </th>
                                                        <th class="text-start p-1 pr-2 text-white" scope="col">
                                                            شماره سریال طراحی
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="bg-zinc-300 hover:bg-zinc-400">
                                                        <td class="p-1 pr-2 border border-white">1</td>
                                                        <td class="p-1 pr-2 border border-white" aria-label="name">
                                                            CONTROL
                                                        </td>
                                                        <td class="p-1 pr-2 border border-white" aria-label="code">3
                                                        </td>
                                                        <td class="p-1 pr-2 border border-white">
                                                            FULX
                                                        </td>
                                                        <td class="p-1 pr-2 border border-white">
                                                            ندارد
                                                        </td>
                                                        <td class="p-1 pr-2 border border-white">
                                                            7035
                                                        </td>
                                                        <td class="p-1 pr-2 border border-white">
                                                            جلو
                                                        </td>
                                                        <td class="p-1 pr-2 border border-white">
                                                            ندارد
                                                        </td>
                                                        <td class="p-1 pr-2 border border-white">
                                                            42
                                                        </td>
                                                        <td class="p-1 pr-2 border border-white">
                                                            25
                                                        </td>
                                                        <td class="p-1 pr-2 border border-white">
                                                            402149
                                                        </td>
                                                        <td class="p-1 pr-2 border border-white">

                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <label class="block w-fit my-2 bg-black p-2 text-white rounded-lg cursor-pointer text-sm font-medium  dark:text-white"
                                                       for="small_size">بارگزاری اسناد</label>
                                                <input class="hidden" id="small_size" type="file">
                                                <div class="flex justify-center">
                                                    <button type="button" id="submitFani" class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4
                            focus:outline-none text-zinc-200 focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg
                            dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                                        ثبت
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="my-7 rounded-lg bg-white border border-zinc-300" id="form3">
                                        <div class="bg-zinc-300 p-2 rounded-t-lg">
                                            <h5 class="text-center text-lg">مشخصات مالی</h5>
                                        </div>
                                        <div class="p-3">
                                            <form class="my-arbitrary-input">
                                                <table class="w-full border-collapse table-auto text-sm" id="faniTable">
                                                    <thead>
                                                    <tr aria-label="-" class="bg-this-teal">
                                                        <th class="text-start p-1 pr-2 text-white" scope="col">
                                                            ردیف
                                                        </th>
                                                        <th class="text-start p-1 pr-2 text-white" scope="col">
                                                            شرح
                                                        </th>
                                                        <th class="text-start p-1 pr-2 text-white" scope="col">
                                                            تعداد
                                                        </th>
                                                        <th class="text-start p-1 pr-2 text-white" scope="col">
                                                            قیمت واحد(ریال - یورو)
                                                        </th>
                                                        <th class="text-start p-1 pr-2 text-white" scope="col">
                                                            قیمت واحد(ریال - یورو)
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="bg-zinc-300 hover:bg-zinc-400">
                                                        <td class="p-1 pr-2 border border-white">1</td>
                                                        <td class="p-1 pr-2 border border-white" aria-label="name">
                                                            CONTROL
                                                        </td>
                                                        <td class="p-1 pr-2 border border-white" aria-label="code">3
                                                        </td>
                                                        <td class="p-1 pr-2 border border-white">
                                                            860,000,000
                                                        </td>
                                                        <td class="p-1 pr-2 border border-white">
                                                            2,580,000,000
                                                        </td>
                                                    </tr>
                                                    <tr class="total-sum bg-white">
                                                        <td class="border border-slate-500 px-1 text-center"
                                                            colspan="2">
                                                            مجموع
                                                        </td>
                                                        <td class="border border-slate-500 p-1 pr-2" colspan="1">3</td>
                                                        <td class="border border-slate-500 text-center" colspan="2">
                                                            2,580,000,000
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <div class="mt-5">
                                                    <div class="flex items-center">
                                                        <div class="basis-1/3">
                                                            <span class="text-this-gray me-2 text-sm">مرجع محاسبات مبلغ قرارداد :</span>
                                                            <input id="cost" type="radio" value="cost"
                                                                   name="origin-radio"
                                                                   class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-1 dark:bg-gray-700 dark:border-gray-600">
                                                            <label for="cost"
                                                                   class="me-4 ms-1 text-sm font-medium text-gray-900 dark:text-gray-300">فهرست
                                                                بهاء</label>
                                                            <input id="list" type="radio" value="list"
                                                                   name="origin-radio"
                                                                   class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 focus:ring-teal-500
                                                        dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-1 dark:bg-gray-700 dark:border-gray-600">
                                                            <label for="list"
                                                                   class="me-4 ms-1 text-sm font-medium text-gray-900 dark:text-gray-300">پارت
                                                                لیست تجهیزات</label>

                                                        </div>
                                                        <div class="basis-1/3 px-7">
                                                            <span class="text-this-gray me-2 text-sm">نوع وجه پرداختی :</span>
                                                            <input id="rial" type="radio" value="rial"
                                                                   name="currency-radio"
                                                                   class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-1 dark:bg-gray-700 dark:border-gray-600">
                                                            <label for="rial"
                                                                   class="me-4 ms-1 text-sm font-medium text-gray-900 dark:text-gray-300">ریال</label>
                                                            <input id="uro" type="radio" value="uro"
                                                                   name="currency-radio"
                                                                   class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-1 dark:bg-gray-700 dark:border-gray-600">
                                                            <label for="uro"
                                                                   class="me-4 ms-1 text-sm font-medium text-gray-900 dark:text-gray-300">یورو</label>
                                                        </div>
                                                        <div class="basis-1/3 px-7">
                                                            <label for="tasir"
                                                                   class="text-this-gray text-sm me-2 inline-block">
                                                                نرخ مبنای تسعیر:
                                                            </label>
                                                            <input id="tasir" name="tasir" type="text"
                                                                   class="inline-block w-1/2 border-0 focus:border focus:border-teal-500
                                                       focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-5">
                                                    <div class="flex items-center">
                                                        <div class="basis-1/3">
                                                            <label for="adjustment"
                                                                   class="text-this-gray text-sm me-7 inline-block">
                                                                تـعـدیــل:
                                                            </label>
                                                            <input id="adjustment" name="adjustment" type="text"
                                                                   class="inline-block w-1/2 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                        </div>
                                                        <div class="basis-1/3 px-7">
                                                            <label for="guarantee"
                                                                   class="text-this-gray text-sm me-2 inline-block">
                                                                نوع ضمانتنامه:
                                                            </label>
                                                            <input id="guarantee" name="guarantee" type="text"
                                                                   placeholder="۰ ریال"
                                                                   class="inline-block w-1/2 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                        </div>
                                                        <div class="basis-1/3 px-7">
                                                            <label for="commitment"
                                                                   class="text-this-gray text-sm me-2 inline-block">
                                                                اجـرای تعهــدات:
                                                            </label>
                                                            <input id="commitment" name="commitment" type="text"
                                                                   placeholder="۰ ریال"
                                                                   class="inline-block w-1/2 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-5">
                                                    <div class="flex items-center">
                                                        <div class="basis-1/3">
                                                            <label for="prePay"
                                                                   class="text-this-gray text-sm me-2 inline-block">
                                                                پیش پرداخت :
                                                            </label>
                                                            <input id="prePay" name="prePay" type="text"
                                                                   placeholder="۰ ریال"
                                                                   class="inline-block w-1/2 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                        </div>
                                                        <div class="basis-1/3 px-7">
                                                            <label for="midPay"
                                                                   class="text-this-gray text-sm me-2 inline-block">
                                                                میـان پرداخت:
                                                            </label>
                                                            <input id="midPay" name="midPay" type="text"
                                                                   placeholder="۰ ریال"
                                                                   class="inline-block w-1/2 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                        </div>
                                                        <div class="basis-1/3 px-7">
                                                            <label for="wellPay"
                                                                   class="text-this-gray text-sm me-2 inline-block">
                                                                حـسـن انـجــام:
                                                            </label>
                                                            <input id="wellPay" name="wellPay" type="text"
                                                                   placeholder="۰ ریال"
                                                                   class="inline-block w-1/2 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mt-5">
                                                    <div class="flex items-center">
                                                        <div class="basis-1/2 pr-24">
                                                            <label for="prePayDate"
                                                                   class="text-this-gray text-sm me-2 inline-block">
                                                                تاریخ دریافت پیش پرداخت :
                                                            </label>
                                                            <input id="prePayDate" data-jdp name="prePayDate"
                                                                   type="text"
                                                                   class="inline-block w-1/2 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                        </div>
                                                        <div class="basis-1/2 px-7">
                                                            <label for="prePayCost"
                                                                   class="text-this-gray text-sm me-2 inline-block">
                                                                مبلغ:
                                                            </label>
                                                            <input id="prePayCost" name="prePayCost" type="text"
                                                                   placeholder="۰ ریال"
                                                                   class="inline-block w-1/2 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-5">
                                                    <div class="flex items-center">
                                                        <div class="basis-1/2 pr-24">
                                                            <label for="midPayDate"
                                                                   class="text-this-gray text-sm me-2 inline-block">
                                                                تاریخ دریافت میان پرداخت :
                                                            </label>
                                                            <input id="midPayDate" data-jdp name="midPayDate"
                                                                   type="text"
                                                                   class="inline-block w-1/2 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                        </div>
                                                        <div class="basis-1/2 px-7">
                                                            <label for="midPayCost"
                                                                   class="text-this-gray text-sm me-2 inline-block">
                                                                مبلغ:
                                                            </label>
                                                            <input id="midPayCost" name="midPayCost" type="text"
                                                                   placeholder="۰ ریال"
                                                                   class="inline-block w-1/2 border-0 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-5">
                                                    <div class="flex items-center">
                                                        <div class="basis-1/2 pr-24">
                                                            <label for="PayDate"
                                                                   class="text-this-gray text-sm me-5 inline-block">
                                                                تاریـخ دریافـت تـسـویـه :
                                                            </label>
                                                            <input id="PayDate" data-jdp name="PayDate" type="text"
                                                                   class="inline-block w-1/2 focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"/>
                                                        </div>
                                                        <div class="basis-1/2 px-7">
                                                            <label for="PayCost"
                                                                   class="text-this-gray text-sm me-2 inline-block">
                                                                مبلغ:
                                                            </label>
                                                            <input id="PayCost" name="PayCost" type="text"
                                                                   placeholder="۰ ریال"
                                                                   class="inline-block w-1/2  focus:border focus:border-teal-500 focus:ring-1 hover:border-teal-500
                                                       hover:border focus:ring-teal-400"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex justify-center mt-5">
                                                    <button type="button" id="submitMali" class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4
                            focus:outline-none text-zinc-200 focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg
                            dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                                        ثبت
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="my-7 rounded-lg bg-white border border-zinc-300" id="form4">
                                        <div class="bg-zinc-300 p-2 rounded-t-lg">
                                            <h5 class="text-center text-lg">مشکلات و ریسک های پروژه</h5>
                                        </div>
                                        <div class="p-3">
                                            <i class="fa fa-plus-circle" id="addRisk"></i>
                                            <i class="fa fa-check-square text-green-500 float-end hover:text-green-600"
                                               id="addRisk"></i>
                                            <table class="w-full border-collapse table-auto text-sm" id="problemsTable">
                                                <thead>
                                                <tr aria-label="-" class="bg-this-teal">
                                                    <th class="text-start p-1 pr-2 text-white" scope="col">
                                                        ردیف
                                                    </th>
                                                    <th class="text-start p-1 pr-2 text-white" scope="col">
                                                        شرح
                                                    </th>
                                                    <th class="text-start p-1 pr-2 text-white" scope="col">
                                                        احتمال وقوع
                                                    </th>
                                                    <th class="text-start p-1 pr-2 text-white" scope="col">
                                                        اثرات مالی و زمانی
                                                    </th>
                                                    <th class="text-start p-1 pr-2 text-white" scope="col">
                                                        استراتژی برخورد با ریسک
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr class="bg-zinc-300 my-arbitrary-input">
                                                    <td class="p-1 pr-2 border border-white">1</td>
                                                    <td class="p-1 pr-2 border border-white">
                                                    <textarea
                                                            class="focus:border focus:border-teal-500
                                                       focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                                                            rows="1"></textarea>
                                                    </td>
                                                    <td class="p-1 pr-2 border border-white">
                                                    <textarea
                                                            class="focus:border focus:border-teal-500
                                                       focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                                                            rows="1"></textarea>
                                                    </td>
                                                    <td class="p-1 pr-2 border border-white">
                                                    <textarea
                                                            class="focus:border focus:border-teal-500
                                                       focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                                                            rows="1"></textarea>
                                                    </td>
                                                    <td class="p-1 pr-2 border border-white">
                                                    <textarea
                                                            class="focus:border focus:border-teal-500
                                                       focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"
                                                            rows="1"></textarea>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="my-7 rounded-lg bg-white border border-zinc-300" id="form5">
                                        <div class="bg-zinc-300 p-2 rounded-t-lg">
                                            <h5 class="text-center text-lg">اطلاعات تکمیلی</h5>
                                        </div>
                                        <div class="p-3">
                                            <i class="fa fa-check-square text-green-500 float-end hover:text-green-600"
                                               id="checkMoreInfo"></i>
                                            <ul class="flex flex-wrap justify-between items-start my-arbitrary-input">
                                                <li>
                                                    <label class="text-this-gray me-2 text-sm" for="equipments">لیست
                                                        تجهیزات
                                                        در تعهد مشتری :</label>
                                                    <textarea id="equipments" class="focus:border focus:border-teal-500
                                                       focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"></textarea>
                                                </li>
                                                <li>
                                                    <label class="text-this-gray me-2 text-sm" for="packing">نوع بسته
                                                        بندی
                                                        :</label>
                                                    <textarea id="packing" class="focus:border focus:border-teal-500
                                                       focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"></textarea>
                                                </li>
                                                <li>
                                                    <label class="text-this-gray me-2 text-sm" for="more">سایر موارد خاص
                                                        و
                                                        نکات قابل توجه قرارداد :</label>
                                                    <textarea id="more" class="focus:border focus:border-teal-500
                                                       focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"></textarea>
                                                </li>
                                                <li>
                                                    <label class="text-this-gray me-2 text-sm" for="attachments">پیوست
                                                        ها
                                                        :</label>
                                                    <textarea id="attachments" class="focus:border focus:border-teal-500
                                                       focus:ring-1 hover:border-teal-500 hover:border focus:ring-teal-400"></textarea>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="hidden p-4 rounded-lg dark:bg-gray-800" id="styled-EPL" role="tabpanel"
             aria-labelledby="EPL-tab">
            <div class="container">
                <h4 class="text-2xl text-center mb-2"> مناقصه ۱</h4>
                <section>
                    <table id="epl_table"
                           class="w-full table-auto border border-collapse border-slate-400 text-end text-this-gray">
                        <thead>
                        <tr class="text-center">
                            <th class="border border-slate-500 bg-gray-300 py-2 px-1" scope="col">QTY</th>
                            <th class="border border-slate-500 bg-gray-300 py-2 px-1" scope="col">Manufacturer</th>
                            <th class="border border-slate-500 bg-gray-300 py-2 px-1" scope="col">TECHNICAL
                                SPECIFICATION DETAIL
                            </th>
                            <th class="border border-slate-500 bg-gray-300 py-2 px-1" scope="col">Description</th>
                            <th class="border border-slate-500 bg-gray-300 py-2 px-1" scope="col">Item</th>
                        </tr>
                        </thead>
                        <tbody class="text-sm">
                        <tr class="text-center">
                            <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">1</td>
                            <td class="border border-slate-300 bg-white hover:border-gray-400">FULMEN</td>
                            <td class="border border-slate-300 bg-white hover:border-gray-400 h-fit">
                                TYPE: FDV3, WITHDRAWABLE
                                24KV, 2000A, 25KA/3 SEC,
                                POLE DISTANCE: 270mm - EQUIPPED WITH
                                TRIP & CLOSE COILS, MOTOR OPERATOR, AUX. CONTACTS FOR C.B STATUS, TEST & SERVICE
                                POSITION

                            </td>
                            <td class="border border-slate-300 bg-white hover:border-gray-400">VACUUM CIRCUIT BREAKER
                            </td>
                            <td class="border border-slate-300 bg-white hover:border-gray-400">1
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">3</td>
                            <td class="border border-slate-300 bg-white hover:border-gray-400">MAG / PARS SHAR</td>
                            <td class="border border-slate-300 bg-white hover:border-gray-400 h-fit">
                                400-200/1A
                                CORE1: 5P20, 20VA
                                CORE2: 0.2FS5, 10VA
                            </td>
                            <td class="border border-slate-300 bg-white hover:border-gray-400">CURRENT TRANSFORMER, 2
                                CORES
                            </td>
                            <td class="border border-slate-300 bg-white hover:border-gray-400">2
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
        <div class="hidden p-4 rounded-lg dark:bg-gray-800" id="styled-DPL" role="tabpanel"
             aria-labelledby="DPL-tab">
            <div class="flex items-center w-full">
                <div class="basis-1/3 md:px-7">
                    <div class="bg-gradient-to-br from-white to-slate-100 text-center px-4 border
                    border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="rounded-t-lg mx-auto" src="<?= $this->asset('images/mehrabad.png') ?>" alt=""/>
                        </a>
                        <h5 class="text-lg mb-3 font-normal text-this-gray dark:text-gray-400">Client</h5>
                    </div>
                </div>
                <div class="basis-1/3 md:px-7">
                    <div class="bg-gradient-to-br from-white to-slate-100 text-center px-4 border
                    border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="rounded-t-lg mx-auto" src="<?= $this->asset('images/mehrabad.png') ?>" alt=""/>
                        </a>
                        <h5 class="text-lg mb-3 font-normal text-this-gray dark:text-gray-400">Manufacturer</h5>
                    </div>
                </div>
                <div class="basis-1/3 md:px-7">
                    <div class="bg-gradient-to-br from-white to-slate-100 text-center px-4 border
                    border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="rounded-t-lg mx-auto" src="<?= $this->asset('images/mehrabad.png') ?>" alt=""/>
                        </a>
                        <h5 class="text-lg mb-3 font-normal text-this-gray dark:text-gray-400">Consultant</h5>
                    </div>
                </div>
            </div>
            <table class="border border-slate-400 border-collapse table-fixed bg-white my-4 w-full ltr text-this-gray">
                <tr>
                    <td colspan="8" class="border-slate-400 border text-center">
                        <span class="font-bold ">Project Name :</span>
                        <span class="font-bold  mx-1">Project Name</span>
                    </td>
                </tr>
                <tr>
                    <td class="border-slate-400 border">
                        <p class="font-bold text-center">Project No.:</p>
                    </td>
                    <td class="border-slate-400 border">
                        <p class="font-bold text-center">Project Number</p>
                    </td>
                    <td class="border-slate-400 border">
                        <p class="font-bold text-center">Document No.:</p>
                    </td>
                    <td class="border-slate-400 border">
                        <p class="font-bold text-center">Document Number</p>
                    </td>
                    <td class="border-slate-400 border">
                        <p class="font-bold text-center">Date: </p>
                    </td>
                    <td class="border-slate-400 border">
                        <p class="font-bold text-center">1403/07/01</p>
                    </td>
                    <td class="border-slate-400 border">
                        <p class="font-bold text-center">Rev.:</p>
                    </td>
                    <td class="border-slate-400 border">
                        <p class="font-bold text-center">-</p>
                    </td>
                </tr>
            </table>
            <table id="detail_table"
                   class="w-full table-auto border border-collapse border-slate-400 text-end text-this-gray">
                <thead>
                <tr class="text-center">
                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" colspan="10">Bill Of
                        Material
                    </th>
                <tr class="text-center">
                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" rowspan="2">Description</th>
                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" rowspan="2">.Order NO</th>
                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" colspan="3">QTY</th>
                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" rowspan="2">Unit</th>
                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" rowspan="2">Brand</th>
                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" rowspan="2">Specification</th>
                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" rowspan="2">Equipment</th>
                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col" rowspan="2">.NO</th>
                </tr>
                <tr class="text-center">
                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col">Total</th>
                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col">Spare</th>
                    <th class="border border-slate-500 bg-gray-300 py-1 px-1" scope="col">Request</th>
                </tr>
                </thead>
                <tbody class="text-sm">
                <tr class="text-center">
                    <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1"></td>
                    <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">TZ-8111</td>
                    <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">1</td>
                    <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1"></td>
                    <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">1</td>
                    <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">Pcs</td>
                    <td class="border border-slate-300 bg-white hover:border-gray-400"></td>
                    <td class="border border-slate-300 bg-white hover:border-gray-400 h-fit">
                        230VAC, 1com
                    </td>
                    <td class="border border-slate-300 bg-white hover:border-gray-400">Limit Switch
                    </td>
                    <td class="border border-slate-300 bg-white hover:border-gray-400">1
                    </td>
                </tr>
                <tr class="text-center">
                    <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">بغل خور ترمینال</td>
                    <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1"></td>
                    <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">10</td>
                    <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1"></td>
                    <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">10</td>
                    <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1">Pcs</td>
                    <td class="border border-slate-300 bg-white hover:border-gray-400">RAAD</td>
                    <td class="border border-slate-300 bg-white hover:border-gray-400 h-fit">
                        P-RTP2.5H-10, Gray
                    </td>
                    <td class="border border-slate-300 bg-white hover:border-gray-400">Partition
                    </td>
                    <td class="border border-slate-300 bg-white hover:border-gray-400">2
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/project.js'); ?>"></script>