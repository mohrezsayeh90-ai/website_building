'use restrict'

$(document).ready(() => {
    let popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')),
        popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')),
        tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    let scroll_div = $(".my-scroll-parent").parent("div:eq(0)");
    if (scroll_div.length > 0) {
        let top = scroll_div[0].getBoundingClientRect().top;
        scroll_div.height(`calc(100vh - ${top}px)`)
    }

////////********** navigation
    let navigation = $(".sideBarMenu"),
        projectContent = $(".main-div-project"),
        menu_icon = $("#menu_icon");

    adjustMargin();

    // navigation.on("click", "svg, .fa_icon", adjustMargin)
    // menu_icon.on("click", navBarToggle);
    //
    // function adjustMargin() {
    //     if(!navigation.hasClass('md:is-open'))$('.drop_down').addClass('hidden')
    //     projectContent.css("right", navigation.css('width'))
    //     projectContent.css("width", `calc(100% - ${navigation.css('width')}`)
    // }
    //
    // function navBarToggle() {
    //     navigation.toggleClass("md:is-open");
    //     if(navigation.hasClass('md:is-open'))$('.focus_in').removeClass('hidden')
    //     adjustMargin()
    // }
    menu_icon.on("mouseenter", ()=>{
        navigation.removeClass("is-closed").addClass("is-open");
        $('.focus_in').removeClass('hidden');
        adjustMargin()
    });
     navigation.on("mouseenter",()=>{
         if(navigation.hasClass('is-closed')){
             navigation.removeClass("is-closed").addClass("is-open");
             $('.focus_in').removeClass('hidden');
             adjustMargin()
         }
     })
    navigation.on("mouseleave", ()=>{
        navigation.removeClass("is-open").addClass("is-closed");
        adjustMargin()
    });
    function adjustMargin() {
        if(!navigation.hasClass('is-open'))$('.drop_down').addClass('hidden')
        projectContent.css("right", navigation.css('width'))
        projectContent.css("width", `calc(100% - ${navigation.css('width')}`)
    }
////////********** navigation

 //////////////********** Badges *****//////////
    let notificationsLi = $("#notificationsLi"), notificationsList = $("#notificationsList"), userNotificationsBadge =$("#userNotificationsBadge");

    notificationsLi.on('mouseenter', function (){
        notificationsList.show()
    })
    notificationsList.on('mouseleave', function (){
        notificationsList.hide()
    })
getBadges();
   // setInterval(getBadges, 5000);
    function getBadges() {
        $.ajax({
            url: url('home/notification'),
            type: 'POST',
            dataType: 'json',
        }).done(res => {
            let count = res.length, notifs = ``;
            if (count > 0) {
                notificationsLi.append(`<span id="notificationsLi__span" class="absolute left-4 inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold
             bg-red-300 text-red-800 rounded-full">${count}</span>`);
                userNotificationsBadge.append(` <span id="userNotificationsBadge__span" class="absolute bg-red-600 -top-1 
            -right-4 inline-flex items-center justify-center w-4 h-4 ms-2  rounded-full"></span>`)
                res.forEach(j => {
                    notifs += ` <a href="${url('home/badge')}" type="button" class="relative bg-red-200 text-red-800 inline-flex items-center  px-4 py-2 text-sm
        font-medium border-b border-gray-200 rounded hover:bg-amber-50
        focus:z-10 dark:border-gray-600 min-w-60  max-w-sm w-fit shadow
        dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                                        <i class="fa fa-wrench me-1"></i>
                                        <span>${j.descriptions}</span>
                                    </a>`
                })
                notificationsList.html(notifs)
            } else notificationsList.html(`<div class="relative bg-amber-300 text-yellow-700 inline-flex items-center px-4 py-2 text-sm
        font-medium border-b border-gray-200 rounded  min-w-60  max-w-sm w-fit shadow
        dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                                        <span>اعلان جدیدی وجود ندارد!</span>
                                    </div>`)
        })
    }
 //////////////********** Badges *****//////////
    console.log(window.location.href)
    $("#logOutSystem").on('click', function (){
        Swal.fire({
            icon:'warning',
            title:'آیا می خواهید از سامانه خارج شوید؟',
            confirmButtonText:'بله',
            cancelButtonText:'خیر',
            showCloseBtn: true,
            showCancelButton:true
        }).then(res=>{
            if(res.isConfirmed){
                $.ajax({
                    url:url('login/logOut'), type:'get'
                }).done(()=>{
                   // console.log(res)
                    window.location.href=url("login");

                })
            }
        })
    })
})
