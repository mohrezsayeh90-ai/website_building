<?php

global $uri;

$this->includeFile('layouts/head-tags'); ?>


<body style="<?= isset($_GET['margin']) && $_GET['margin'] == 10 ? ';background:white !important;margin:0px 0px 0px 0px' : '' ?>"
      id="<?= $uri[1] ?? $uri[0] ?>" class="personal-panel">


<header class="no-print">
    <!--شروع روش ساید بار-->
    <nav class="header-back bg-this-gray text-white">
        <div class="max-h-full p-0 rounded-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                            aria-controls="logo-sidebar" type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                    <a href="#" class="flex ms-2 md:me-24 p-1">
                        <img class="w-24"
                             src="<?php echo $this->asset('images/logo.png') ?>" alt="logo"/>
                    </a>
                </div>
                <div class="flex items-center justify-center rtl:justify-center">
                    <h1 class="text-lg lg:text-3xl">سامانه جامع کسب و کار شرکت صنعتی مهر آباد</h1>
                </div>
                <div style="z-index: 11 !important;" class="flex items-center">
                    <button type="button" id="userNotificationsBadge"
                            class="relative flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-white dark:focus:ring-gray-600"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                        <span class="sr-only"></span>
                        <img id="userProfilePicture" class="w-10 h-10 rounded-full"
                             src="<?php echo isset($_SESSION['ax']) ? $this->asset('images/profiles/' . $_SESSION['ax']) : $this->asset('images/avatar.png') ?>"
                             alt="user photo">
                    </button>
                    <button type="button" id="logOutSystem" class="ms-2 text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-1 focus:outline-none focus:ring-gray-100
                         font-medium rounded-lg text-sm px-3 py-1 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700
                         dark:text-white dark:hover:bg-gray-700 me-2">
                        <i class="fa fa-sign-out ml-2"></i>خروج از سامانه
                    </button>
                    <div style="z-index: 11 !important;" class="hidden my-4  list-none bg-white divide-y divide-gray-100 min-w-40
                        rounded shadow-lg dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                        <div style="z-index: 11 !important;" class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                <?php echo $_SESSION['tkeNn'] ?? 'Guest'; ?>
                            </p>
                            <!--                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">-->
                            <!--                                    --><?php //echo $_SESSION["tke"]; ?>
                            <!--                                </p>-->
                        </div>
                        <ul style="z-index: 11 !important;" class="py-1" role="none">
                            <?php if (isset($_SESSION['admin'])): ?>
                                <li style="z-index: 11 !important;">
                                    <a href="<?php echo $this->url('access'); ?>"
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                       role="menuitem">تعریف کاربر</a>
                                </li>
                            <?php endif; ?>
                            <li style="z-index: 11 !important;" class="relative">
                                <a href="#" id="notificationsLi" class="relative block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300
                                     dark:hover:bg-gray-600
                                     dark:hover:text-white" role="menuitem">
                                    اعلان ها
                                </a>
                                <div class="absolute left-full hidden top-0 shadow-lg text-gray-900 border border-gray-200 rounded-lg dark:bg-gray-700
                                    dark:border-gray-600 dark:text-white p-1 bg-white max-h-[500px] overflow-auto" id="notificationsList">
                                </div>
                            </li>
                            <li style="z-index: 11 !important;">
                                <a href="<?= $this->url('home') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600
                                     dark:hover:text-white" role="menuitem">داشبورد</a>
                            </li>
                            <li style="z-index: 11 !important;">
                                <a href="<?php echo isset($_SESSION['tkn']) ? $this->url('profile/show/q=' . $_SESSION["tkn"]) : '#'; ?>"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600
                                        dark:hover:text-white" role="menuitem">پروفایل</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!--پایان روش ساید بار-->


    <?php $this->includeFile('layouts/partials/sidebar'); ?>
</header>


