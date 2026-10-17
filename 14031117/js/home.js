let tickAllNotifications = $('#tickAllNotifications');
// $.ajax({
//     url: url('home/notification'),
//     type: 'POST',
//     dataType: 'json'
// }).done(res => {
//     if (res.length > 0) tickAllNotifications.show()
//     else tickAllNotifications.hide()
// })

$(document).ready(() => {
    new DataTable('#unreadTable00',{
        autoWidth: false,
        order: [[2, 'desc']],
        "width":"100%",
        "responsive":true,
    })
    new DataTable('#allTable00',{
        autoWidth: false,
        order: [[2, 'desc']],

        //
        // "columns": [{
        //     "width": "10%"
        // }, {
        //     "width": "40%"
        // }, {
        //     "width": "20%"
        // }, {
        //     "width": "20%"
        // }, {
        //     "width": "10%"
        // }, {
        //     "width": "10%"
        // }],
        "width":"100%",
        "responsive":true,
    })
    $('.notifications-tabs').hide()

    // setTimeout(()=>{
    //     $('.notifications-tabs').show()
    //     $(`#allNotifications`).trigger('click')
    //     $('#allTable00').css('width','100%')
    //     $(`#unreadNotifications`).trigger('click')
    //     $('#unreadTable00').css('width','100%')
    //
    //
    //
    // },50)

    let notifications_tabs = $('.notifications-tabs'), hideNotificationsContainer = $("#hideNotificationsContainer");
    hideNotificationsContainer.on('click', function () {
        notifications_tabs.hide()
    })

    $('[aria-label="categories_notifications"]').on('click', function () {
        let search0 = $('#dt-search-0'), search1 = $('#dt-search-1'),
            cat = $(this).find(`span[aria-label]`).attr('aria-label'), value = '';
        switch (cat) {
            case 'number_of_elemental_badges':
                value = 'تعاریف پایه';
                break;
            case 'number_of_tender_badges':
                value = 'استعلامات و مناقصات';
                break;
            case 'number_of_project_badges':
                value = 'سامانه پروژه ها';
                break;
            case 'number_of_supply_badges':
                value = 'سامانه تامین';
        }
        search0.val(value), search1.val(value)
        search1.trigger('keyup');
        search0.trigger('keyup');
        notifications_tabs.show()
    })

    let badge_tab = $('.notifications-tabs__list');
    badge_tab.on('click', '.notify_read', function () {
       // alert(1)
        let btn = $(this), info = btn.val(), ol = btn.parents('tbody').attr('aria-label');
        $.ajax({
            url: url('home/seen'),
            type: 'POST',
            data: {q: info},
            dataType: 'json'
        }).done(res => {
            //console.log(res)
            if (res) {
                let badge_number = $(`[aria-label=number_of_${res.cat}_badges]`);
                badge_number.text(Number(badge_number.text().trim()) - 1)
                if (ol === "unread-notifications") {
                    btn.parents('tr').remove();
                    let li = $(`tbody[aria-label=all-notifications] tr[data-id="tr_${info}"]`);
                    li.removeClass('bg-red-200').addClass('bg-white');
                    li.find('.notification-operation').html(`<img class="w-11" src="${url('assets/images/double-check.png')}" alt="خوانده شده"/>`)
                } else if (ol === "all-notifications") {
                    btn.parents('tr').removeClass('bg-red-200').addClass('bg-white');
                    $(`<img class="w-11" src="${url('assets/images/double-check.png')}" alt="خوانده شده"/>`).insertAfter(btn);
                    btn.remove()
                }
            }
        })
    })
    $('#tickAllNotifications').on('click', function () {
        $.ajax({
            url: url('home/seenAll'),
            type: 'POST',
            dataType: 'json'
        }).done(res => {
            $('#loadingStyle').show()
            setTimeout(function () {
                if (res) {
                    window.location.reload();
                }
            }, 2000)
        })
    })

})
