<?php $this->includeFile('layouts/head-tags') ?>
<body id="login" class="login bg-gradient-to-br from-white via-teal-50 to-this-teal">
<header class="header-back">
    <div class="w-full h-full">
        <div class="flex m-0 pt-5 h-full items-center">
            <div class="basis-1/3 h-full px-7">
<!--                <div class="navbar-brand overflow-hidden h-100">-->
<!--                    <img src="--><?php //= $this->asset('images/mehrabad.png') ?><!--" class="bg-light h-100" width="64"-->
<!--                         alt="logo"></div>-->
            </div>
<!--            <div style="margin-top: 100px" class="basis-1/3 h-full">-->
<!--                <span class="pt-4 text-center  font-extrabold sm:text-base md:text-2xl 2xl:text-3xl" >سامانه جامع کسب و کار-->
<!--                    شرکت صنعتی-->
<!--                    مهرآباد</span>-->
<!--            </div>-->
        </div>
</header>
<main class="h-screen overflow-hidden relative">
    <div class="background-icon z-1"></div>
    <?php if (isset($message)): ?>
    <div class="container relative">
        <div class="absolute top-5 right-5 z-1 min-w-[400px]">
            <?php foreach ($message as $item) { ?>
                <div class="rounded-lg p-4 shadow border-2 border-amber-500 bg-amber-100 my-alert">
                    <div class="content flex items-center">
                        <div class="icon bg-amber-500 rounded-full p-2">
                            <svg height="50" viewBox="0 0 512 512" width="50" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#fff"
                                      d="M449.07,399.08,278.64,82.58c-12.08-22.44-44.26-22.44-56.35,0L51.87,399.08A32,32,0,0,0,80,446.25H420.89A32,32,0,0,0,449.07,399.08Zm-198.6-1.83a20,20,0,1,1,20-20A20,20,0,0,1,250.47,397.25ZM272.19,196.1l-5.74,122a16,16,0,0,1-32,0l-5.74-121.95v0a21.73,21.73,0,0,1,21.5-22.69h.21a21.74,21.74,0,0,1,21.73,22.7Z"/>
                            </svg>
                        </div>
                        <h5 class="text-2xl ms-2"><?= $item ?></h5>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="background w-4/5">

        <div href="#" class="h-full w-full flex flex-col items-center bg-transparent border border-teal-500 rounded-lg shadow md:flex-row
             hover:drop-shadow-2xl dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">

                <div class="md:w-2/5 h-full">


                    <form method="post"  action="<?= $this->url('login/check') ?>" class="w-full h-full">
                        <div style="margin:auto" class="flex flex-col justify-center p-4 md:px-7 leading-normal h-full bg-teal-500/70">
                            <div class="w-full">
                                <div style="margin-top: 0px;margin-bottom: 50px" class=" h-full">
                                    <span class="pt-0 text-center text-white font-extrabold sm:text-base md:text-2xl 2xl:text-2xl"><p>سامانه جامع کسب و کار</p>
                   <p class="mt-5"> شرکت صنعتی مهرآباد</p></span>
                                </div>
<!--                                <img style="width:200px;margin:auto"-->
<!--                                     src="--><?php //echo $this->asset('images/logo.png') ?><!--" alt="logo"/>-->
                            </div>
                    <label for="userName" class="sm:mt-5 text-white"> نام کاربری:<em
                                class="text-red-400">*</em></label>
                    <input id="userName" name="userName" type="text"
                           class="ltr border border-white bg-white/50 rounded-full focus:border focus:border-white focus:ring-2 hover:border-2 hover:shadow focus:ring-teal-400"
                           autocomplete="off"/>
                    <label for="password" class="sm:mt-5 text-white"> رمز عبور:<em
                                class="text-red-400">*</em></label>
                    <div class="inline-flex items-center justify-between w-full">
                        <input id="password" name="password" type="password"
                               class="ltr border w-full me-2 border-white bg-white/50 rounded-full focus:border focus:border-white focus:ring-2 hover:border-2 hover:shadow focus:ring-teal-400"
                               autocomplete="off"/>
                        <span><i id="eye" class="fa fa-eye text-white cursor-pointer ms-1"></i></span>
                    </div>
                    <button type="submit" id="loginSubmit" name="submit"
                            class="text-white mt-7 bg-gradient-to-br from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-r focus:ring-4 focus:outline-none
                         focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 font-medium rounded-lg
                          text-sm px-5 py-2.5 text-center me-2 mb-2">
                        ورود به حساب کاربری
                    </button>
<!--                        </div>-->
                        </div>
            </form>

                </div>
            <div class="swiper h-full sm:w-full md:w-3/5 rounded-t-lg md:rounded-none md:rounded-s-lg">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img class="object-cover  max-w-full max-h-full h-full w-auto block align-middle mx-auto"
                             src="<?= $this->asset('images/IMG_2325.JPG') ?>" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img class="object-cover   max-w-full max-h-full h-full w-auto block align-middle mx-auto"
                             src="<?= $this->asset('images/IMG_2624-Photoroom.png') ?>" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img class="object-cover  max-w-full max-h-full h-full w-auto block align-middle mx-auto"
                             src="<?= $this->asset('images/IMG_2623.jpg') ?>" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img class="object-cover  max-w-full max-h-full h-full w-auto block align-middle mx-auto"
                             src="<?= $this->asset('images/IMG_2623.png') ?>" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img class="object-cover  max-w-full max-h-full h-full w-auto block align-middle mx-auto"
                             src="<?= $this->asset('images/_MG_5884-Photoroom.png') ?>" alt="">
                    </div>

                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>
</main>
<?php $this->includeFile('layouts/scripts') ?>
<script type="text/javascript" src="<?php $this->asset('js/auth.js'); ?>"></script>
