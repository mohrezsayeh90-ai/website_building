<?php $this->includeFile('layouts/partials/header');
$this->includeFile('layouts/partials/open-tags-tmp');
global $flashMessage, $uri;
function info($cnt): array
{
    $info = array();
    switch ($cnt + 1) {
        case 1:
            $info = ['elemental', "تعاریف پایه"];
            break;
        case 2:
            $info = ['tender', "استعلامات و مناقصات"];
            break;
        case 3:
            $info = ['project', "سامانه پروژه ها"];
            break;
        case 4:
            $info = ['supply', "سامانه تامین"];

    }
    return $info;
}

?>
<style>
    *[dir=rtl] table.dataTable thead th, *[dir=rtl] table.dataTable thead td, *[dir=rtl] table.dataTable tfoot th, *[dir=rtl] table.dataTable tfoot td {
        text-align: center ;
    }
</style>
<div class="container">
    <h1 class="text-center text-3xl mt-4">داشبورد فعالیتها</h1>
    <div class="container mt-16 flex flex-row rounded-lg dark:border-gray-700 justify-between dark:bg-gray-800">
        <?php for ($i = 0; $i < 4; $i++) { ?>
            <div class="bg-white w-1/5 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative drop-shadow-lg hover:drop-shadow-2xl">
                <button type="button" aria-label="categories_notifications"
                        class="absolute -top-8 -left-5 inline-flex items-center px-5 py-2.5 text-sm font-medium text-center
                     bg-red-200 text-red-800 rounded-lg hover:bg-red-300 focus:ring-4 focus:outline-none
                    focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    پیامهای مهم
                    <span aria-label="number_of_<?php echo info($i)[0]; ?>_badges"
                          class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold bg-red-300 text-red-800 rounded-full">
<?php
$count = 0;
    foreach ($badges as $badge) {
        if ($badge['seen_at'] === Null && $badge['badge_category'] === info($i)[0]) $count++;
}
echo $count;
?>
</span>
                </button>

                <a href="#">
                    <!--                <img style="width:50%" class="h-auto rounded-t-lg self-center" src="-->
                    <?php //= Base_Url."/assets/images/mehrabad.png" ?><!--" alt=""/>-->
                </a>
                <div class="p-5 bg-gradient-to-br from-slate-50 to-slate-100 h-full">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <?php echo info($i)[1]; ?>
                        </h5>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php if ($_SESSION['tkn'] === '70' || $_SESSION['tkn'] === '67' || 1==1) { ?>
        <div class="notifications-tabs relative w-full <?php echo (isset($uri[1]) && $uri[1] === 'badge')  ? 'show' : 'hidden' ?> ">
            <div id="loadingStyle"
                    class="w-full h-full top-10 left-0 absolute z-50 backdrop-blur-[3px] flex justify-center items-start hidden">
                <button disabled type="button" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4
             focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center">
                    <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    Loading...
                </button>
            </div>
            <div class="flex flex-row w-full">
            <ul class="flex flex-wrap -mb-px text font-medium text-center mt-10 w-3/4" id="notificationsTab"
                data-tabs-toggle="#notifications-tab-content" role="tablist"
                data-tabs-active-classes="bg-slate-200">
                <li class="me-2">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg focus:text-purple-600 hover:text-gray-600 hover:border-gray-300
        dark:hover:text-gray-300 dark:border-transparent text-this-gray dark:text-gray-400 border-gray-100 dark:border-gray-700"
                            id="unreadNotifications" data-tabs-target="#unreadNotifications_tab" type="button"
                            role="tab"
                            aria-selected="false">اعلان های خوانده نشده
                    </button>
                </li>
                <li class="me-2">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg focus:text-purple-600 hover:text-gray-600 hover:border-gray-300
        dark:hover:text-gray-300 dark:border-transparent text-this-gray dark:text-gray-400 border-gray-100 dark:border-gray-700"
                            id="allNotifications" data-tabs-target="#allNotifications_tab" type="button" role="tab"
                            aria-selected="false">همه ی اعلان ها
                    </button>
                </li>
            </ul>
            <div class="w-1/4 flex flex-col mt-10 items-end">
                <button id="hideNotificationsContainer" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
                        focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center me-2 mb-2 w-44">
                    <small>مخفی کردن اعلان ها</small><i class="fa fa-close mr-1"></i></button>
                <?php if($cnt){ ?>
                <button id="tickAllNotifications"
                        class="text-yellow-500 hover:text-white border border-yellow-400 hover:bg-yellow-300 focus:ring-4 focus:outline-none
                        focus:ring-yellow-300 font-medium rounded-lg px-5 py-2.5 text-center me-2 mb-2 w-44">
                    <small>خواندن همه</small><i class="fa fa-check mr-1"></i></button>
                <?php } ?>
            </div>
            </div>
            <div id="notifications-tab-content">
                <div class="hidden p-4 rounded-lg w-full dark:bg-gray-800" id="unreadNotifications_tab"
                     role="tabpanel"
                     aria-labelledby="unreadNotifications">
<!--                    notifications-tabs__list-->
                    <div  class="notifications-tabs__list shadow-lg">
                        <table  class="w-full" id="unreadTable00">
                        <thead class="uppercase text-md rounded-t-lg block dark:bg-gray-700 dark:text-gray-400 bg-this-teal text-white">
                            <tr class="w-full flex px-6 py-3">
                                    <th style="width:10%" >ردیف</th>
                                    <th style="width:40%" >عنوان</th>
                                <th  style="width:15%"  >تاریخ</th>
                                    <th  style="width:15%"  >دسته بندی</th>
                                    <th  style="width:10%"  >ایجاد کننده</th>
                                    <th  style="width:10%"  >عملیات</th>
                            </tr>
                        </thead>
                        <tbody aria-label="unread-notifications"
                            class="uppercase text-md text-start bg-white divide-y divide-gray-200">
                            <?php
                            foreach ($badges as $key => $badge) {
                                if (!$badge['seen_at']) { ?>
                                    <tr data-id="tr_<?= $badge['badge_id'] ?>" class="w-full flex px-6 py-1 items-center bg-red-200">
                                            <td style="width:10%"><?= $key + 1 ?></td>
                                            <td style="width:40%" ><?= $badge['descriptions'] ?></td>
                                        <td style="width:15%" ><?=  tr_num(jdate('Y/m/d H:i:s',strtotime($badge['tarikh']))); ?></td>
                                            <td style="width:15%"><?= $this->getBadgeCategory($badge['badge_category']) ?></td>
                                            <td style="width:10%"><?= $badge['from_user_id'] ?></td>
                                            <td style="width:10%" class="notification-operation">
                                                <button type="button" value="<?= $badge['badge_id'] ?>"
                                                        class="notify_read text-yellow-500 hover:text-white border border-yellow-400 hover:bg-yellow-300
                                                         focus:ring-2 focus:outline-none rounded-full
                        focus:ring-yellow-300 font-medium px-5 py-2.5 text-center me-2 mb-2">
                                                    <small class="hover:animate-pulse">خوانده شد</small>
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </td>
                                    </tr>
                                <?php }
                            } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="hidden p-4 rounded-lg  dark:bg-gray-800" id="allNotifications_tab" role="tabpanel"
                     aria-labelledby="allNotifications">
<!--                    notifications-tabs__list-->
                    <div class="notifications-tabs__list shadow-lg">
                        <table class="w-full" id="allTable00">
                            <thead class="uppercase text-md rounded-t-lg block dark:bg-gray-700 dark:text-gray-400 bg-this-teal text-white">
                            <tr class="w-full flex px-6 py-3">
                                <th style="width:10%" >ردیف</th>
                                <th style="width:40%" >عنوان</th>
                                <th  style="width:15%"  >تاریخ</th>
                                <th  style="width:15%"  >دسته بندی</th>
                                <th  style="width:10%"  >ایجاد کننده</th>
                                <th  style="width:10%"  >عملیات</th>
                            </tr>
                            </thead>
                            <tbody aria-label="all-notifications"
                                   class="uppercase text-md text-start bg-white divide-y divide-gray-200">
                            <?php
                            foreach ($badges as $key => $badge) { ?>
                                    <tr data-id="tr_<?= $badge['badge_id'] ?>"
                                        class="w-full flex px-6 py-1 items-center <?= $badge['seen_at'] ? 'bg-white' : 'bg-red-200'; ?>">
                                        <td style="width:10%"><?= $key + 1 ?></td>
                                        <td style="width:40%"><?= $badge['descriptions'] ?></td>
                                        <td style="width:15%"><?=  tr_num(jdate('Y/m/d H:i:s',strtotime($badge['tarikh']))); ?></td>
                                        <td style="width:15%"><?= $this->getBadgeCategory($badge['badge_category']) ?></td>
                                        <td style="width:10%"><?= $badge['from_user_id'] ?></td>
                                        <td style="width:10%" class="notification-operation">
                                            <?php if (!$badge['seen_at']) { ?>
                                                <button type="button" value="<?= $badge['badge_id'] ?>"
                                                        class="notify_read text-yellow-500 hover:text-white border border-yellow-400 hover:bg-yellow-300
                                                         focus:ring-2 focus:outline-none rounded-full
                        focus:ring-yellow-300 font-medium px-5 py-2.5 text-center me-2 mb-2">
                                                    <small class="hover:animate-pulse">خوانده شد</small>
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            <?php } else { ?>
                                                <img class="w-11" src="<?= $this->asset('images/double-check.png') ?>"
                                                     alt="خوانده شده"/>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php }
                             ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php
$this->includeFile('layouts/partials/close-tags-tmp');
$this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/home.js'); ?>"></script>