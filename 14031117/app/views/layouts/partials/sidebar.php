<?php //if(IP === '50.19.103.150') print_r($_SESSION['access']);
$acs = $_SESSION["access"] ?? Null;
//print_r($_SESSION);
 ?>
<aside id="logo-sidebar" class="sideBarMenu bg-this-gray is-closed">
    <div class="h-full pb-4 overflow-y-auto dark:bg-gray-800 pt-4">
        <ul class="space-y-7 font-medium">
            <li>
                <button id="menu_icon"
                   class="ps-1 flex items-center text-slate-100 rounded-lg dark:text-white  hover:text-black dark:hover:bg-gray-700 group">
                    <i class="fa fa-bars fa-2x"></i>
                </button>
            </li>
            <li>
                <a href="<?= $this->url('home') ?>"
                   class="flex p-1 items-center rounded-lg dark:text-white hover:bg-white  hover:text-black dark:hover:bg-gray-700 group fa_icon
                    <?= uri === 'home' ? " text-black bg-white" :"text-slate-100" ?>">
                    <i class="fa fa-home fa-2x"></i>
                    <span class="ms-4">داشبورد</span>
                </a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center text-slate-100 rounded-lg dark:text-white hover:bg-white  hover:text-black dark:hover:bg-gray-700 fa_icon">
                    <i class="fa fa-wrench fa-2x"></i>
                    <button type="button"
                            class="flex items-center w-full text-base   text-slate-100 transition duration-75 rounded-lg group hover:bg-white  hover:text-black dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-001" data-collapse-toggle="dropdown-001">

                        <span class="flex-1 ms-4 text-left rtl:text-right whitespace-nowrap">تعاریف پایه</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <ul id="dropdown-001" class="drop_down <?= in_array(uri, ['element', 'group', 'product', 'customer', 'supplier']) ? "focus_in" :"hidden" ?>
                     py-2 space-y-2 mr-14">
                        <li>
<!--                            //--><?php //if(isset($acs))echo $acs[0]['display'] ? $this->url('element') : '#'; ?>
                            <a href="<?php
                            if(isset($acs) && $acs != NULL){echo $acs[0]['display']  ? $this->url('element') : '#';}
                           echo isset($_SESSION["admin"]) || isset($_SESSION["owner"]) ? $this->url('element') : '#';
                            ?>"
                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white  hover:text-black dark:text-white
                               dark:hover:bg-gray-700 <?= uri === 'element' ? " text-black bg-white" :"text-slate-100" ?>">قطعات</a>
                        </li>
                        <li>
                            <a href="<?php if(isset($acs) && $acs != NULL)echo $acs[1]['display']  ? $this->url('group') : '#';
                           echo isset($_SESSION["admin"]) || isset($_SESSION["owner"]) ? $this->url('group') : '#'; ?>"
                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white
                               hover:text-black dark:text-white dark:hover:bg-gray-700 <?= uri === 'group' ? " text-black bg-white" :"text-slate-100" ?>">مجموعه
                                ها</a>
                        </li>
                        <li>

                            <a href="<?php if(isset($acs) && $acs != NULL)echo $acs[2]['display']  ? $this->url('product') : '#';
                            echo isset($_SESSION["admin"]) || isset($_SESSION["owner"]) ? $this->url('product') : '#'; ?>"
                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white
                               hover:text-black dark:text-white dark:hover:bg-gray-700 <?= uri === 'product' ? " text-black bg-white" :"text-slate-100" ?>">محصولات</a>
                        </li>
                        <li>

                            <a href="<?php
                            if(isset($acs) && $acs != NULL)echo $acs[3]['display']  ? $this->url('customer') : '#';
                            echo isset($_SESSION["admin"]) || isset($_SESSION["owner"]) ? $this->url('customer') : '#'; ?>"
                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white
                               hover:text-black dark:text-white dark:hover:bg-gray-700 <?= uri === 'customer' ? " text-black bg-white" :"text-slate-100" ?>">کارفرمایان و مشاورین</a>
                        </li>
                        <li>

                            <a href="<?php if(isset($acs) && $acs != NULL)echo $acs[4]['display']  ? $this->url('supplier') : '#';
                            echo isset($_SESSION["admin"]) || isset($_SESSION["owner"]) ? $this->url('supplier') : '#'; ?>"
                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white
                                hover:text-black dark:text-white dark:hover:bg-gray-700 <?= uri === 'supplier' ? " text-black bg-white" :"text-slate-100" ?>">تامین
                                کنندگان</a>
                        </li>
                    </ul>
                </a>

            </li>
            <li>

                <a href="#"
                   class="flex items-center text-slate-100 rounded-lg dark:text-white hover:bg-white  hover:text-black dark:hover:bg-gray-700 group fa_icon">
                    <i class="fa fa-gavel fa-2x mx-1"></i>
                    <button type="button"
                            class="flex items-center w-full text-base   text-slate-100 transition duration-75 rounded-lg group hover:bg-white  hover:text-black dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-002" data-collapse-toggle="dropdown-002">

                        <span class="flex-1 ms-2 text-left rtl:text-right whitespace-nowrap">سامانه استعلامات و مناقصات</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <ul id="dropdown-002" class="drop_down <?= in_array(uri, ['tender', 'tList']) ? "focus_in" :"hidden" ?> py-2 space-y-2 mr-14">
                        <li>

                            <a href="<?php if(isset($acs) && $acs != NULL)echo $acs[5]['display']  ? $this->url('tender') : '#';
                            echo isset($_SESSION["admin"]) || isset($_SESSION["owner"]) ? $this->url('tender') : '#'; ?>"
                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white hover:text-black
                                dark:text-white dark:hover:bg-gray-700 <?= uri === 'tender' ? " text-black bg-white" :"text-slate-100" ?>">ایجاد
                                استعلام یا مناقصه جدید</a>
                        </li>
                        <li>

                            <a href="<?php if(isset($acs) && $acs != NULL)echo $acs[6]['display']  ? $this->url('tList') : '#';
                            echo isset($_SESSION["admin"]) || isset($_SESSION["owner"]) ? $this->url('tList') : '#'; ?>"
                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white  hover:text-black
                               dark:text-white dark:hover:bg-gray-700 <?= uri === 'tList' ? " text-black bg-white" :"text-slate-100" ?>">فهرست
                                استعلامات و مناقصات</a>
                        </li>

                    </ul>
                </a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center text-slate-100 rounded-lg dark:text-white hover:bg-white  hover:text-black dark:hover:bg-gray-700 group fa_icon">
                    <i class="fa fa-file-zip-o fa-2x ms-1"></i>
                    <button type="button"
                            class="flex items-center w-full text-base   text-slate-100 transition duration-75 rounded-lg group hover:bg-white  hover:text-black dark:text-white
                            dark:hover:bg-gray-700"
                            aria-controls="dropdown-003" data-collapse-toggle="dropdown-003">
                        <span class="flex-1 ms-2 text-left rtl:text-right whitespace-nowrap">سامانه پروژه ها</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <ul id="dropdown-003" class="drop_down
                    <?= in_array(uri, ['project', 'prjman', 'pmanager', 'planing', 'engineering']) ? "focus_in" :"hidden" ?> py-2 space-y-2 mr-14">
                        <li>
                            <a href="<?php if(isset($acs) && $acs != NULL)echo $acs[7]['display']  ? $this->url('project') : '#';
                            echo isset($_SESSION["admin"]) || isset($_SESSION["owner"]) ? $this->url('project') : '#'; ?>"
                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white  hover:text-black
                                dark:text-white dark:hover:bg-gray-700 <?= uri === 'project' ? " text-black bg-white" :"text-slate-100" ?>"> پروژه</a>
                        </li>
                        <li>
                            <a href="<?php if(isset($acs) && $acs != NULL)echo $acs[8]['display']  ? $this->url('prjman') : '#';
                            echo isset($_SESSION["admin"]) || isset($_SESSION["owner"]) ? $this->url('prjman') : '#'; ?>"
                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white  hover:text-black
                                dark:text-white dark:hover:bg-gray-700 <?= uri === 'prjman' ? " text-black bg-white" :"text-slate-100" ?>">مدیریت و برنامه ریزی پروژه
                            </a>
                        </li>
<!--                        <li>-->
<!--                            <a href="--><?php //= $this->url('pmanager') ?><!--"-->
<!--                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white  hover:text-black-->
<!--                                dark:text-white dark:hover:bg-gray-700 --><?php //= uri === 'pmanager' ? " text-black bg-white" :"text-slate-100" ?><!--">بازرگانی-مدیر پروژه-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="--><?php //= $this->url('planing') ?><!--"-->
<!--                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white  hover:text-black-->
<!--                                dark:text-white dark:hover:bg-gray-700 --><?php //= uri === 'planing' ? " text-black bg-white" :"text-slate-100" ?><!--">برنامه ریزی-دفتر-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
                            <a href="<?php if(isset($acs) && $acs != NULL)echo $acs[9]['display']  ? $this->url('engineering') : '#';
                            echo isset($_SESSION["admin"]) || isset($_SESSION["owner"]) ? $this->url('engineering') : '#'; ?>"
                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white  hover:text-black
                                dark:text-white dark:hover:bg-gray-700 <?= uri === 'engineering' ? " text-black bg-white" :"text-slate-100" ?>">مهندسی پروژه
                            </a>
                        </li>
                    </ul>
                </a>
            </li>
            <li>
                <a href="#"
                   class="flex items-center text-slate-100 rounded-lg dark:text-white hover:bg-white  hover:text-black dark:hover:bg-gray-700 group fa_icon">
                    <i class="fa fa-list fa-2x mx-1"></i>
                    <button type="button"
                            class="flex items-center w-full text-base text-slate-100 transition duration-75 rounded-lg group hover:bg-white  hover:text-black dark:text-white
                            dark:hover:bg-gray-700"
                            aria-controls="dropdown-004" data-collapse-toggle="dropdown-004">
                        <span class="flex-1 ms-2 text-left rtl:text-right whitespace-nowrap"> سامانه تأمین</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <ul id="dropdown-004" class="drop_down
                    <?= in_array(uri, ['warehouse', 'shop', 'produce', 'store', 'trade', 'transactions', 'directors', 'manager', 'request']) ? "focus_in" :"hidden" ?> py-2 space-y-2 mr-14">
                        <li>
                            <a href="<?php if(isset($acs) && $acs != NULL)echo $acs[10]['display']  ? $this->url('produce') : '#';
                            echo isset($_SESSION["admin"]) || isset($_SESSION["owner"]) ? $this->url('produce') : '#'; ?>"
                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white  hover:text-black
                                dark:text-white dark:hover:bg-gray-700  <?= uri === 'produce' ? " text-black bg-white" :"text-slate-100" ?>"> تولید</a>
                        </li>
                        <li>
                            <a href="<?php if(isset($acs) && $acs != NULL)echo $acs[11]['display']  ? $this->url('store') : '#';
                            echo isset($_SESSION["admin"]) || isset($_SESSION["owner"]) ? $this->url('store') : '#'; ?>"
                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white  hover:text-black
                                dark:text-white dark:hover:bg-gray-700  <?= uri === 'store' ? " text-black bg-white" :"text-slate-100" ?>"> برنامه ریزی انبار</a>
                        </li>
                        <li>
                            <a href="<?php if(isset($acs) && $acs != NULL)echo $acs[12]['display']  ? $this->url('trade') : '#';
                            echo isset($_SESSION["admin"]) || isset($_SESSION["owner"]) ? $this->url('trade') : '#'; ?>"
                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white  hover:text-black
                                dark:text-white dark:hover:bg-gray-700  <?= uri === 'trade' ? " text-black bg-white" :"text-slate-100" ?>"> بازرگانی خرید</a>
                        </li>
                        <li>
                            <a href="<?php if(isset($acs) && $acs != NULL)echo $acs[13]['display']  ? $this->url('transactions') : '#';
                            echo isset($_SESSION["admin"]) || isset($_SESSION["owner"]) ? $this->url('transactions') : '#'; ?>"
                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white  hover:text-black
                                dark:text-white dark:hover:bg-gray-700  <?= uri === 'transactions' ? " text-black bg-white" :"text-slate-100" ?>"> کمیسیون معاملات</a>
                        </li>
                        <li>
                            <a href="<?php if(isset($acs) && $acs != NULL)echo $acs[14]['display']  ? $this->url('manager') : '#';
                            echo isset($_SESSION["admin"]) || isset($_SESSION["owner"]) ? $this->url('manager') : '#'; ?>"
                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white  hover:text-black
                                dark:text-white dark:hover:bg-gray-700  <?= uri === 'manager' ? " text-black bg-white" :"text-slate-100" ?>"> مدیر عامل</a>
                        </li>
                        <li>
                            <a href="<?php if(isset($acs) && $acs != NULL)echo $acs[15]['display']  ? $this->url('directors') : '#';
                            echo isset($_SESSION["admin"]) || isset($_SESSION["owner"]) ? $this->url('directors') : '#'; ?>"
                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white  hover:text-black
                                dark:text-white dark:hover:bg-gray-700  <?= uri === 'directors' ? " text-black bg-white" :"text-slate-100" ?>">هیئت مدیره</a>
                        </li>
<!--                        <li>-->
<!--                            <a href="--><?php //= $this->url('request') ?><!--"-->
<!--                               class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-white  hover:text-black-->
<!--                                dark:text-white dark:hover:bg-gray-700  --><?php //= uri === 'request' ? " text-black bg-white" :"text-slate-100" ?><!--"> درخواست های کالا از انبار</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="--><?php //= $this->url('shop') ?><!--"-->
<!--                               class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 group hover:bg-white hover:text-black-->
<!--                                dark:text-white dark:hover:bg-gray-700"> درخواست های خرید کالا-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="--><?php //= $this->url('shop') ?><!--"-->
<!--                               class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 group hover:bg-white hover:text-black-->
<!--                                dark:text-white dark:hover:bg-gray-700">  کمیسیون خرید کالا-->
<!--                            </a>-->
<!--                        </li>-->
                    </ul>
                </a>
            </li>
        </ul>
    </div>
</aside>
