<!doctype html>
<html lang="fa" dir="rtl">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Reyahane Pirouznia">
    <title>سامانه مناقصات شرکت صنعتی مهرآباد</title>
    <link rel="icon" href="<?php $this->asset("images/logo.png")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/outputWind.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/owl.theme.default.min.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/fonts/bootstrap-icons.min.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/fonts/font-awesome.min.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/dataTables.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/buttons-datatables.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/jalalidatepicker.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/sweetAlert2.min.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/swiper.min.css")?>">
    <link rel="stylesheet" href="<?php $this->asset("lib/css/swiper-bundle.min.css")?>">
    <link type="text/css" rel="stylesheet" href=<?php $this->asset("lib/css/dropzone.css") ?>>
    <link type="text/css" rel="stylesheet" href=<?php $this->asset("css/general.css") ?>>
    <link type="text/css" rel="stylesheet" href=<?php $this->asset("css/special.css") ?>>
</head>

<body>
<div class="container">


    <!-- Main modal -->

        <div class="relative overflow-x-auto max-w-[1500px] bg-zinc-300 border-black border-2 shadow-md sm:rounded-lg">
            <h3 class="text-center font-bold mb-3 mt-3">جدول فرآیندهای مختلف کاری(BPM)-<?=$allbpmData[4]['proj_name']?></h3>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        کد فرآیند
                    </th>
                    <th scope="col" class="px-6 py-3">
                        شرح فرآیند
                    </th>
                    <th scope="col" class="px-6 py-3">
                        فرآیندهای بعدی
                    </th>
                    <th scope="col" class="px-6 py-3">
                        نحوه تصمیم گیری
                    </th>
                    <th scope="col" class="px-6 py-3">
                        نوع فرآیند
                    </th>
                    <th scope="col" class="px-6 py-3">
                        مجریان
                    </th>
                    <th scope="col" class="px-6 py-3">
                        وضعیت
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($allbpmData[0] as $key=>$BPM_INFO){
                    ?>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?=$BPM_INFO['process_step_id']?>
                        </th>
                        <td class="px-6 py-1">
                            <?=$BPM_INFO['process_step_description']?>
                        </td>
                        <td class="px-6 py-1">
                            <?=$BPM_INFO['next_step_id']?>
                        </td>
                        <td class="px-6 py-1">
                            <?=$BPM_INFO['labels']?>
                        </td>
                        <td class="px-6 py-1">
                            <?=$BPM_INFO['process_type']?>
                        </td>
                        <td class="px-6 py-1">
                            <?=$BPM_INFO['owners']?>
                        </td>
                        <td class="px-6 py-1 text-green-400">

                            <?=$BPM_INFO['passed']==0?'<i class="fa fa-square fa-2x text-slate-300"></i>':'<i class="fa fa-check fa-2x"></i>'?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <div class="grid grid-cols-2 gap-4 mt-5">

                <div>
                    <h3 class="text-center font-bold mb-3">جدول سطوح دسترسی</h3>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-sm text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                کد فرآیندها
                            </th>
                            <th scope="col" class="px-6 py-3">
                                مجری
                            </th>
                            <th scope="col" class="px-6 py-3">
                                نوع دسترسی
                            </th>
                            <th scope="col" class="px-6 py-3">
                                امکان مشاهده اطلاعات فنی
                            </th>
                            <th scope="col" class="px-6 py-3">
                                امکان مشاهده اطلاعات مالی
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($allbpmData[1] as $key=>$BPM_PRIV){
                            ?>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?=$BPM_PRIV['process_step_id']?>
                                </th>
                                <td class="px-6 py-1">
                                    <?=$BPM_PRIV['team_or_person']?>
                                </td>
                                <td class="px-6 py-1">
                                    <?=$BPM_PRIV['process_privileges']?>
                                </td>
                                <td class="px-6 py-1 text-green-400">
                                    <?=$BPM_PRIV['technical_info_allowed']==0?'<i class="fa fa-close fa-2x text-red-400"></i>':'<i class="fa fa-check fa-2x"></i>'?>
                                </td>
                                <td class="px-6 py-1 text-green-400">
                                    <?=$BPM_PRIV['financial_info_allowed']==0?'<i class="fa fa-close fa-2x text-red-400"></i>':'<i class="fa fa-check fa-2x"></i>'?>
                                </td>

                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <!-- ... -->
                <div>
                    <h3 class="text-center font-bold mb-3">جدول بازبینی اسناد</h3>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-sm text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                فرمهای پروژه
                            </th>
                            <th scope="col" class="px-6 py-3">
                                کد فرآیندها
                            </th>
                            <th scope="col" class="px-6 py-3">
                                آخرین نسخه
                            </th>
                            <th scope="col" class="px-6 py-3">
                                تاریخ
                            </th>


                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($allbpmData[2] as $key=>$BPM_REV){
                            ?>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?=$BPM_REV['proj_main_forms']?>
                                </th>
                                <td class="px-6 py-1">
                                    <?=$BPM_REV['main_form_process_step_id']?>
                                </td>
                                <td class="px-6 py-1">
                                    <?=$BPM_REV['proj_main_forms_version']?>
                                </td>
                                <td class="px-6 py-1 text-green-400 ltr">
                                    <?=$BPM_REV['proj_main_forms_last_accepted_date']?>
                                </td>


                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>





</div>
<?php
//$this->includeFile('layouts/partials/close-tags-tmp');
//$this->includeFile('layouts/scripts') ?>

</body>
<script type="text/javascript" src="<?php $this->asset('lib/js/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset("lib/js/dataTables.min.js")?>"></script>
<script type="text/javascript" src="<?php $this->asset("lib/js/dataTables.buttons.min.js")?>"></script>
<script type="text/javascript" src="<?php $this->asset("lib/js/buttons.print.min.js")?>"></script>
<script type="text/javascript" src="<?php $this->asset("lib/js/buttons.html5.min.js")?>"></script>
<script type="text/javascript" src="<?php $this->asset("lib/js/dataTables.fixedHeader.min.js")?>"></script>
<script type="text/javascript" src="<?php $this->asset('lib/js/sweetAlert2.all.min.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('lib/js/owl.carousel.min.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('lib/js/swiper.min.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('lib/js/swiper-bundle.min.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('lib/js/dropzone.js') ?>"></script>
<script type="text/javascript" src="<?=Base_Url?>/node_modules/flowbite/dist/flowbite.min.js"></script>

<script type="text/javascript" src="<?php $this->asset('lib/js/jalalidatepicker.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('js/helpers.js') ?>"></script>
<script type="text/javascript" src="<?php $this->asset('js/main.js') ?>"></script>
<script type="text/javascript" src="<?= $this->asset('lib/jsc/jscharting.js') ?>"></script>
</body>
<script>
    // onlineSearch($('#999'), url('supplier/getAll'), $("#888"), 'nam')

    // function jsonSearch(name, code=''){
    //     return  `<div aria-label=${code} class="cursor-pointer py-2 px-4 w-full text-sm text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-none
    //                     focus:bg-gray-100" tabindex="3" data-hs-combo-box-output-item="">
    //         <div class="flex justify-between items-center w-full">
    //             <span aria-label="${name}">${name}</span>
    //
    //       <svg class="shrink-0 size-3.5 text-blue-600"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
    //       stroke-linecap="round" stroke-linejoin="round">
    //         <path d="M20 6 9 17l-5-5"></path>
    //       </svg>
    //     </span>
    //         </div>
    //     </div>`
    // }
    // function onlineSearch(input, uri, list, name, code = '') {
    let inputID = $('#inputID'), listID =$("#listID");
    inputID.on('keyup', (ev) => {
        $.ajax({
            url: url('supplier/getAll'),
            type: 'POST',
            data: ev.target.value,
            async: false,
            success: result => {
                console.log(result)
                listID.show();
                let json = JSON.parse(result), info;
                let display;
                json.forEach(j => {
                    display =ev.target.value === j.nam ?'block':'none';
                    info += `<div aria-label=${j.cod} class="list-row cursor-pointer py-2 px-4 w-full text-sm text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-none
                        focus:bg-gray-100" tabindex="3" data-hs-combo-box-output-item="">
            <div class="flex justify-between items-center w-full">
                <span aria-label="${j.nam}">${j.nam}</span>
          <svg style="display:${display}" class="shrink-0 size-3.5 text-blue-600" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
        </span>
            </div>
        </div>`
                })

                listID.html(info)
            }
        });
    })
    hideOnClick(document,listID )
    listID.on("click", ".list-row ", function (){
        let text = $(this).find(`span[aria-label]`).attr('aria-label');
        inputID.val(text)
        listID.hide()
    })
    //}
</script>
</html>
<!--<script type="text/javascript" src="--><?php //$this->asset('js/project.js'); ?><!--"></script>-->