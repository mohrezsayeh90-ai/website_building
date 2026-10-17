let persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g];
let arabicNumbers = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];
// const emailReg = /^\w+([.-]?\w+)*@\w+([.-]?\w)*(.\w{2,6})+$/;
// const assets1 = src => {
//
// }
function url(uri)  {
    if (location.protocol == 'https:')  return "https://server-php.fulmengroup.com:3367/mehrabad/" + uri;
    else return "http://server-php.fulmengroup.com:3366/mehrabad/" + uri;
}
function getRandomColor() {
    let letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
        // console.log(color)
    }
    return color;
}



// const getUrlParam = (url, param) => {
//     let address = new URL(url);
//     return  address.searchParams.get(param);
// }



async function ToastPro(text,pos,ersu,reload=0,dir='rtl')
{
    const Toast =Swal.mixin({
        toast: true,
        position: pos,
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
        didClose: (toast) => {
            if(reload==1)   window.location.reload()
        },
    });

    await Toast.fire({
        icon: ersu,
        html: `<p dir="${dir}">${text}</p>`
    });
}
// const formatDate8 = date => {
//     return date.substr(0, 4) + '/' + date.substr(4, 2) + '/' + date.substr(6, 2);
// }

// const formatDate6 = date => {
//     return date.substr(0, 2) + '/' + date.substr(2, 2) + '/' + date.substr(4, 2);
// }
// const formatMonth = date => {
//     return date.substr(0, 4) + '/' + date.substr(4, 2);
// }

function currentDateTime() {
    let time = new Date().toLocaleTimeString('fa-IR'),
        date = new Date().toLocaleDateString('fa-IR', {
            day: '2-digit', month: '2-digit', year: 'numeric'
        })

    return [date, time];
}

// const randomFunc = function (min, max) {
//     return Math.floor(Math.random() * (max - min + 1)) + min;
// }


// function emailRegEx(txt) {
//     return emailReg.test(txt);
// }

const phoneReg = /^(\+\d{1,4}\s?)?\(?\d{3}\)?\d{3}?\d{4}$/; //doesn't accept 0 at first index
function phoneRegEx(txt) {
    return phoneReg.test(txt);
}
function pasRegEx(text){
    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,64}$/.test(text)
}
//Enter prevent Default
// const Enter = window => {
//     window.keydown(function (event) {
//         if (event.keyCode === 13) {
//             event.preventDefault();
//             return false;
//         }
//     })
// };

//Enter Next Input (add class .input-container to input parent)
const nextInput = input => {
    input.on('keydown', function (e) {
        if (e.which === 13) {
            var self = $(this), focusable, next, form = self.parents('.input-container:eq(0)');
            focusable = form.find('input').filter(':visible');
            next = focusable.eq(focusable.index(this) + 1);
            if (next.length) {
                next.focus();
            }
            return false;
        }
    })
};

//Do Async Ajax
function post  (uri, args) {
    let ajax = null;
    $.ajax({
        url: uri,
        type: 'POST',
        data: args,
        async: false,
        success: result => {
            ajax = result;
        }
    });
    return ajax;
}
function get  (uri, args) {
    let ajax = null;
    $.ajax({
        url: uri,
        type: 'GET',
        data: args,
        async: false,
        success: result => {
            ajax = result;
        }
    });
    return ajax;
}
///file sending
// const files = async (uri, args) => {
//     let ajax = null;
//     await $.ajax({
//         url: url(uri), // Upload Script
//         cache: false,
//         contentType: false,//necessary for multiple data formats
//         processData: false,//necessary for multiple data formats
//         data: args,
//         type: 'POST',
//         success: result => {
//             ajax = result;
//         }
//     })
//     return ajax;
// }

function separate(Number) {
    Number += '';
    Number = Number.replace(',', '');
    x = Number.split('.');
    y = x[0];
    z = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(y))
        y = y.replace(rgx, '$1' + ',' + '$2');
    return y + z;
}

// /Automations/?url=edari/saham
function shareHoldersGroup(type) {
    let typ
    switch (type) {
        case "1":
            typ = "چاپ";
            break;
        case "2":
            typ = "نشر";
            break;
        case "3":
            typ = "هردو";
            break;
        case "0":
            typ = "هیچکدام";
            break;

    }
    return typ;
}

//url=tolid/planning

function makeGantt2  (id, series, title,markers)  {
    const chart = JSC.chart(id, {
        defaultCultureName: 'fa-IR',
        debug:false,
        type: 'horizontal column solid',
        // palette: ['#86BBD8', '#758E4F', '#F6AE2D', '#F26419', '#590925' ,'#ff00ff', '#333300', '#999966', '#ff9933', '#990099', '#cc00ff', '#0033cc'],
        /*Make columns overlap.*/
        zAxis_scale_type: 'stacked',
        /*Time Y Axis.*/
        yAxis_scale_type: 'time',
        // legend_position: 'bottom',
        // legend: {
        //     position: 'right bottom',
        //     defaultEntry: {
        //         // Enable checkboxes for each point legend entry.
        //         checkbox_enabled: true,
        //         hoverAction: "none"
        //     },
        //     fill: 'white',
        //     outline_width: 5,
        //     corners: 'round',
        //     template: '%icon %name'
        // },
        // title_label_text: 'Project Beta from %min to %max',
        // toolbar_items_resetZoom_visible: true,
        // zoom: ['5', '0'],
        title_label_text: title,
        toolbar_items_export_position: 'bottom left',
        // toolbar_items_resetZoom_visible = false,
        // toolbar_items_resetZoom_position = 'inside top left',
        // toolbar_items: {
        //     "zoom": {
        //         events_click: function (e) {
        //             // chart.options(getData());
        //             // alert("silam")
        //             chart.zoom(3.1818181818181817);
        //             // getAllData();
        //             console.log(chart.zoom(3.1818181818181817));
        //             // console.log(this.zoom([-5.055, 0]))
        //         }
        //     }
        // },
            defaultSeries: {
                legendEntry_visible: false,
                /* Add a highlight series action for the x axis. This binds the axis tick to a series. */
                firstPoint_xAxisTick_hoverAction: 'highlightSeries'
            },
            defaultPoint: {

                tooltip: '%name %yStart , %yValue<br><b>%zValue</b>',
                outline_width: 0,
                complete_hatch_style: 'none',
                hoverAction: 'highlightSeries'
            },
            yAxis: {
               markers
            },
            // lastPoint: {
            //     xAxisTick: {label: {text: '<b>%name</b>', style: {fontSize: '15px'}}},
            //     outline: {color: 'darkenMore', width: 3},
            // },

        // series: e => {
        //     series.map(val => {
        //         return {points: val} + ",";
        //     })
        // }
        // series: [{points: series[0]}]
        series: series


    });

}

function localDateOption(str) {
    return convertToEnNumber(new Date(str).toLocaleDateString("fa-IR", {
        day: '2-digit', month: '2-digit', year: 'numeric'
    }))
}

function gantt_view_mode(elem) {
    let range = $(elem).attr("id"), view = "";
    switch (range) {
        case "dailyG":
            view = "Day";
            break
        case "monthlyG":
            view = "Month";
            break
        case "yearlyG":
            view = "Year";
            break
        case "weeklyG":
            view = "Week";
    }
    return view;
}

// const frappeGantt = (tagId, tasks, url, view_mode) => {
//     if (tasks.length > 0) {
//         return new Gantt(tagId, tasks, {
//             // on_click: task => {
//             //     console.log(task);
//             // },
//             on_date_change: (task, start, end) => {
//                 $.ajax({
//                     url: url,
//                     type: "POST",
//                     async: false,
//                     data: {
//                         id: task.id,
//                         strt: localDateOption(start),
//                         end: localDateOption(end),
//                         gantt_date: true
//                     },
//                     success: function () {
//                         $(".popup-wrapper .tDate").html(localDateOption(start) + "-" + localDateOption(end))
//                     }
//                 })
//             },
//             on_progress_change: (task, progress) => {
//                 // console.log(task.id, progress);
//                 $.ajax({
//                     url: url,
//                     type: "POST",
//                     async: false,
//                     data: {
//                         id: task.id,
//                         prgs: progress,
//                         gantt_prgs: true
//                     },
//                     success: function () {
//                         $(".popup-wrapper .tProgress").html(progress + "% پیشرفت")
//                     }
//                 })
//             },
//             // on_view_change: (mode) => {
//             //     console.log(mode);
//             // },
//             view_modes: ['Day', "Week", "Month", "Year"],
//             // language:'fa',
//             view_mode: view_mode,
//             custom_popup_html:
//                 function (task) {
//                     // the task object will contain the updated
//                     // dates and progress value
//                     const end_date = new Date(task.start).toLocaleDateString('fa-IR');
//                     const start_date = new Date(task.end).toLocaleDateString('fa-IR');
//                     return `
//           <div class="title"><b>${task.name}<b/></div>
//           <div class="subtitle">
//                 <p class="mb-2 tDate">${start_date} - ${end_date}</p>
//                 <p class="mb-0 tProgress">${task.progress != null ? task.progress : ""}% پیشرفت</p>
//           </div>
//              `;
//                 }
//
//         });
//     }
// }

// const sahafiType = path => {
//     let type
//     switch (path) {
//         case "1":
//             type = "کلبوس 1";
//             break;
//         case "2":
//             type = "کلبوس 2";
//             break;
//         case "3":
//             type = "سی تی";
//             break;
//         case "4":
//             type = "آلگرو";
//             break;
//         case "5":
//             type = "مولرمارتینی";
//             break;
//         case "6":
//             type = "هانر";
//             break;
//     }
//     return type
// }


function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

// function dayOfWeek(val){
//
//     let day = new Date().toString().substring(0,3);
//     function wichDay(){
//
//     }
//     // console.log(day)
//     switch (day){
//         case "Mon" :
//             return "دوشنبه"
//             break;
//         case "Tue" :
//             return "سه شنبه"
//             break;
//         case "Wen" :
//             return "چهارشنبه"
//             break;
//         case "Thu" :
//             return "پنجشنبه"
//             break;
//         case "Fri" :
//             return "جمعه"
//             break;
//         case "Sat" :
//             return "شنبه"
//             break;
//         case "Sun" :
//             return "یکشنبه"
//             break;
//
//     }
//     // console.log(switch (day))
//     let date = new Date().toLocaleDateString('fa-IR');
//     $(val).text(date +''+day);
// }


function dayOfWeek  () {
    let date = new Date().toString();
    // console.log(date)
    let day = date.substring(0, 3),
        faDay
    // console.log(day)
    switch (day) {
        case "Mon" :
            faDay = "دوشنبه"
            break;
        case "Tue" :
            faDay = "سه شنبه"
            break;
        case "Wed" :
            faDay = "چهارشنبه"
            break;
        case "Thu" :
            faDay = "پنجشنبه"
            break;
        case "Fri" :
            faDay = "جمعه"
            break;
        case "Sat" :
            faDay = "شنبه"
            break;
        case "Sun" :
            faDay = "یکشنبه"
            break;

    }
    return faDay;
}

// console.log(dayOfWeek())
// function dateInput(val) {
//     let date = new Date().toLocaleDateString('fa-IR');
//     $(val).val(dayOfWeek() + " " + date);
// }
//
// function dateDiv(val) {
//     let date = new Date().toLocaleDateString('fa-IR');
//     $(val).text(dayOfWeek() + " " + date);
// }

// function previousDate(){
//     let date = new Date(year,month,date -1);
//     return date;
//     console.log(date)
// }
function dateFormatterInput(id) {
    let element = $(id);
    try {
        element.unbind('keyup')
    } catch (e) {

    }
    element.bind('keyup', function (ev) {
        let input = element.val();
        let out = input.replace(/\D/g, '');
        // console.log(out);
        let len = out.length;

        switch (len) {
            case 6 :
                out = out.substring(0, 2) + '/' + out.substring(2, 4) + '/' + out.substring(4);
                break;
            case 8 :
                out = out.substring(0, 4) + '/' + out.substring(4, 6) + '/' + out.substring(6);
                break;
        }

        element.val(out)
    });

}


function onlyDigit(id) {
    $(id).each(function () {
        $(this).on('keyup', function () {
            let val = fixNumbers1($(this).val()).replace(/\D/g, '');
            $(this).val(val);
        })
    })
}

function valuePriceFormatter(x) {
    return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
}

//Add . from right
// function valuePriceFormatter(Val) {
//     let out,val = String(Val);
//     switch (val.length) {
//         case 5 :
//             out = val.substring(0, 2) + ',' + val.substring(2);
//             break;
//         case 6 :
//             out = val.substring(0, 3) + ',' + val.substring(3);
//             break;
//         case 7 :
//             out = val.substring(0, 1) + ',' + val.substring(1, 4) + ',' + val.substring(4);
//             break;
//         case 8 :
//             out = val.substring(0, 2) + ',' + val.substring(2, 5) + ',' + val.substring(5);
//             break;
//         case 9 :
//             out = val.substring(0, 3) + ',' + val.substring(3, 6) + ',' + val.substring(6);
//             break;
//         case 10 :
//             out = val.substring(0, 1) + ',' + val.substring(1, 4) + ',' + val.substring(4, 7) + ',' + val.substring(7);
//             break;
//         case 11 :
//             out = val.substring(0, 2) + ',' + val.substring(2, 5) + ',' + val.substring(5, 8) + ',' + val.substring(8);
//             break;
//         default:
//             out=val;
//     }
//     return out;
// }

function priceFormatter(id) {
    $(id).on('keyup', function () {
        let input = $(id).val();
        let text = fixNumbers1(input).replace(/\D/g, '');
        // console.log(text);
        return $(id).val(valuePriceFormatter(text));
    })
}


    fixNumbers1 = function (str) {
        if (typeof str === 'string') {
            for (var i = 0; i < 10; i++) {
                str = str.replace(persianNumbers[i], i).replace(arabicNumbers[i], i);
            }
        }
        return str;
    };

function checkInput(id) {
    let k = 0;
    $(id).each(function () {
        if (this.value.length === 0) {
            k += 1;
            this.classList.add("invalid:border-red-500");
            $(this).on('change', function () {
                $(this).removeClass("border-danger");
            })
        }
    })
    return k !== 0
}

function checkRadioInput(id) {
    let k = 0;
    console.log($(id))
    if (!$(id + ":checked").length > 0) {
        $(id).each(function () {
            k += 1;
            $(this).siblings("label:eq(0)").addClass("border border-danger p-2 rounded")
        })
    }
    return k !== 0
}

function showPass(id) {
    $(id).click(function () {
        let type = $("#password").attr("type");
        if (type === "password") {
            $("#password").attr("type", "text");
        } else {
            $("#password").attr("type", "password");
        }
    })
}

function openModal(id) {
    return $(id).removeClass('d-none');
}

function closeModal(id) {
    return $(id).addClass("d-none");
}

function inputWidth(address) {
    let labels = $(address);
    labels.each(function () {
        let label = $(this).find("label");
        let width = (label.text().length + 2) + "ch";
        let input = $(this).find("input");
        input.width(width);

        $(this).on("change", "input", function () {
            let val = $(this).val();
            // console.log(val)
            if (val.length > 0) {
                // alert("hi")
                $(this).width((val.length + 1) + "ch");
                $(this).css("border", "none");
            }
        })
    })

}

// function inputBorder(address){
//     $(address).each(function (){
//         let input = $(this).find("input");
//         console.log(input.val());
//         if(input.val()){
//             input.width((input.val().length + 1) + "ch");
//             input.css("border", "none");
//         }else {
//             input.css("border", "1px solid rgba(255, 255, 255, 0.4)");
//         }
//     })
// }

function borderNoneInput(address) {
    let inputs = $(address);
    inputs.each(function () {
        $(this).on("change", function () {
            $(this).css("border", "none")
        })
    })
}

//get the position of top and left
function getOffsetTo(el, con) {
    // const rect = $(el)[0].getBoundingClientRect();
    return {
        //rect.left rect.top
        left: $(el).pageX + $(con).scrollLeft(),
        top: $(el).pageY + $(con).scrollTop()
    };
}

function getOffset(el) {
    const rect = $(el)[0].getBoundingClientRect();
    return {
        left: rect.left + window.scrollX,
        top: rect.top + window.scrollY
    };
}

//  if (!selector.is(ev.target) && selector.has(ev.target).length === 0) for hiding element on click outside it and its children
function hideOnClick(doc, elem) {
    $(doc).mouseup(function (ev) {
        ev.stopPropagation();
        //باید داخل ایونت قبلی بنویسی ینی وقتی رو اینپوت کلیک شد
        //|| ev.target.parentElement.className.substring(0,3) !=="jdp"
        if ((!elem.is(ev.target) && elem.has(ev.target).length === 0)) {
            elem.hide();
        }
    })
}

function jdpHideOnClick(doc, elem) {
    $(doc).mouseup(function (ev) {
        //باید داخل ایونت قبلی بنویسی ینی وقتی رو اینپوت کلیک شد
        if ((!elem.is(ev.target) && elem.has(ev.target).length === 0) || ev.target.parentElement.className.substring(0, 3) !== "jdp") {
            elem.addClass("d-none");
        }
    })
}

function showTrash(){
    $(".trash-container").on('mouseenter', function (){
        $(this).find('.trash-can').show();
    })
}
function hideTrash(){
    $(".trash-container").on('mouseleave', function (){
        $(this).find('.trash-can').hide();
    })
}
////for owl carousel smart length
function getLoop(items) {
    return $(".radial-Gradient-gold").length >= items;
}
//delete element on delete icon click
function deleteElement() {

    $(".trash-can i").each(function () {
        $(this).on("click", function () {
            let container = $(this).closest(".trash-container");
            container.siblings("br:eq(0)").remove();
            container.remove();
        })
    })
}


//shows the alerts under each other
function alertContainerPlural(msg) {
    $(".alert-container").show().append(msg);
    setTimeout(function () {
        $(".alert-container").hide()
    }, 10000)
}

function alertContainer(msg) {
    $(".alert-container").show().html(msg);
    setTimeout(function () {
        $(".alert-container").hide()
    }, 2500)
}

//inp is search input , elem is the list that wanted to be searched through it
function searchTemplate(inp, elem) {
    inp.on("keyup", function (event) {
        event.stopPropagation();
        let filter = $(this).val().replace("ی", "ي").replace("ک", "ك");
        let count = 0;
        elem.each(function () {
            //hide if there is no match
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).hide();
                // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).show();
                count++;
            }
        });
    })
}

//برحسب یک آیتم در یک ردیف جستجو می کند(فیلترینگ برحسب یک ایتم)
//pattern:input ,elem:search through them,parent:the row
function generalSearchTemplate(pattern, elem, parent, evType) {
    pattern.off(evType);
    pattern.on(evType, function (event) {
        event.stopPropagation();
        let filter = "";
        evType === "change" || evType === "keyup" || evType === "input" ? filter = $(this).val().trim() : filter = $(this).text().trim();
        // console.log(filter)
        let count = 0;
        $.each(elem, function () {
            console.log($(this).text().trim(), filter)
            //hide if there is no match
            if ($(this).text().trim().search(new RegExp(filter, "i")) < 0) {
                $(this).parents(parent).hide();
                // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).parents(parent).show();
                count++;
            }
        });
    })
}

/// میان تمام ایتم های یک ردیف جستجو میکند
function searchInRow(pattern, elem, parent, evType = "keyup") {
    pattern.off(evType);

    pattern.on(evType, function (event) {
        event.stopPropagation();
        let filter = "";
        filter = convertToEnNumber($(this).val().trim());
        //console.log(filter)
        $.each(parent, function () {
            $(this).show();
            let count = 0;
            $.each($(this).find(elem), function () {
                if ($(this).text().replaceAll("ي", "ی").toLowerCase().includes(filter) > 0 || $(this).text().includes(filter) > 0) {
                    count++;
                    return false;

                }

            })

            if (count === 0 && filter !== "") $(this).hide();
        });
    })
}

//jalali to georgian
function jalaliToGeorg(myDate) {

    myDate = myDate.split("/");

    JalaliDate = {
        g_days_in_month: [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
        j_days_in_month: [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29]
    };

    // JalaliDate.jalaliToGregorian = function (j_y, j_m, j_d) {
    let j_y = parseInt(myDate[0]);
    let j_m = parseInt(myDate[1]);
    let j_d = parseInt(myDate[2]);
    var jy = j_y - 979;
    var jm = j_m - 1;
    var jd = j_d - 1;

    var j_day_no = 365 * jy + parseInt(jy / 33) * 8 + parseInt((jy % 33 + 3) / 4);
    for (var i = 0; i < jm; ++i) j_day_no += JalaliDate.j_days_in_month[i];

    j_day_no += jd;

    var g_day_no = j_day_no + 79;

    var gy = 1600 + 400 * parseInt(g_day_no / 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */
    g_day_no = g_day_no % 146097;

    var leap = true;
    if (g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */
    {
        g_day_no--;
        gy += 100 * parseInt(g_day_no / 36524); /* 36524 = 365*100 + 100/4 - 100/100 */
        g_day_no = g_day_no % 36524;

        if (g_day_no >= 365) g_day_no++;
        else leap = false;
    }

    gy += 4 * parseInt(g_day_no / 1461); /* 1461 = 365*4 + 4/4 */
    g_day_no %= 1461;

    if (g_day_no >= 366) {
        leap = false;

        g_day_no--;
        gy += parseInt(g_day_no / 365);
        g_day_no = g_day_no % 365;
    }

    for (var i = 0; g_day_no >= JalaliDate.g_days_in_month[i] + (i == 1 && leap); i++)
        g_day_no -= JalaliDate.g_days_in_month[i] + (i == 1 && leap);
    var gm = i + 1;
    var gd = g_day_no + 1;

    gm = gm < 10 ? "0" + gm : gm;
    gd = gd < 10 ? "0" + gd : gd;

    return [gy.toString(), gm.toString(), gd.toString()];


}


//pass georgian date
function toTimeStamp(j_y, j_m, j_d) {
    var newDate = new Date(j_y, (j_m) - 1, j_d);
    return newDate.getTime()
}

//date difference base on days
function dateDiffer(sd, fd) {
    let start = new Date(jalaliToGeorg(sd).join("-"))
    let end = new Date(jalaliToGeorg(fd).join("-"))
    return Math.floor((end - start) / (1000 * 60 * 60 * 24))
}

//add days to specified date
Date.prototype.addDays = function (days) {
    this.setDate(this.getDate() + parseInt(days));
    return this;
}

function convertToEnNumber(str) {


    // const
    //     persianNumbers1 = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g];
    // const arabicNumbers1 = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];
   // console.log(str)
    const fixNumbers = function (str) {
        if (typeof str === 'string') {
            //  console.log(str)
            for (let i = 0; i < 10; i++) {
                str = str.replaceAll(persianNumbers[i], i).replaceAll(arabicNumbers[i], i);

            }
        }
        return str;
    };
    return fixNumbers(str)
}

function zeroDateFormat(date, option = null) {
    //let date=  new Date().toLocaleDateString('fa-IR');
    let sd = date.replace(/[-.]/g, "/").split(`/`)
//return md
    return convertToEnNumber(sd[0] + `/` + ("00" + sd[1]).substring(("00" + sd[1]).length - 2) + `/` + ("00" + sd[2]).substring(("00" + sd[2]).length - 2))
}


function modifyTime(elem) {
    //elem is value of input
    return (("00" + elem).slice(-2));
}

function formatTime(a, b) {
    if ($(a).val() !== "") {
        let h = ("00" + $(a).val()).slice(-2);
        let m = ("00" + $(b).val()).slice(-2);
        return h + ":" + m;
    } else {
        return "";
    }
}

function hourToTimeStamp(hour) {
    let time_stamp = hour.split(":");
    return (parseInt(time_stamp[0]) * 3600.0) + (parseInt(time_stamp[1]) * 60.0);
}

function timeStampToHour(timeStamp) {
    let total = timeStamp / 3600.0;
    let hour = Math.floor(total);
    let minute = modifyTime(Math.floor((total - hour) * 60));
    return hour + ":" + minute;
}

function searchStringInArray(str, strArray) {
    let index;
    for (let j = 0; j < strArray.length; j++) {
        if (strArray[j].match(str)) index = j;
    }
    return index
}

function getdate(m1, option = 1) {
    return new Date(parseInt(1718915400000.0 + parseFloat(m1) * 3600000.0)).toLocaleDateString("en-US") + " " +
        new Date(parseInt(1718915400000.0 + parseFloat(m1) * 3600000.0)).toLocaleTimeString("en-US");

    var hours = date.getHours();

// Minutes part from the timestamp
    var minutes = "0" + date.getMinutes();

// Seconds part from the timestamp
    var seconds = "0" + date.getSeconds();

// Will display time in 10:30:23 format
    var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
    if (option == 1) return date.getMonth() + "/" + date.getDay() + "/" + date.getFullYear() + " " + formattedTime
    if (option == 2) return date.getDay() + "/" + date.getMonth() + "/" + date.getFullYear() + " " + formattedTime
}
function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}
// const makeDataTable= id=> {
//     new DataTable(id, {
//         pagination: false,
//         paging: false,
//         info: false,
//         layout: {
//             topStart: 'search',
//             topEnd: {
//                 buttons: [{
//                     extend: 'excel',
//                     text: 'xlsx',
//                 }]
//             }
//         },
//         language: {
//             emptyTable: "رکوردی موجود نیست!",
//             infoEmpty: "",
//             search: "",
//             searchPlaceholder: "جستجو...",
//             // "infoFiltered": "(filtered from _MAX_ total records)",
//             bLengthChange: false, //thought this line could hide the LengthMenu
//         }
//     })
// }
function iconScore(icon) {
    let score, newIcon
    switch (icon) {
        case "fa fa-star":
            score = 2;
            newIcon = "fa fa-star-half-o"
            break;
        case "fa fa-star-half-o":
            score = 1;
            newIcon = "fa fa-star"
            break;
        case "fa fa-star-o":
            score = 0;
            newIcon = "fa fa-star-half-o"
            break;

    }
    return [score, newIcon];
}

// console.log(iconScore("fa fa-star-half-o"))

function newScore(id, index, icon) {
    // if (index > 1 && index <5) {
    for (let n = 1; n < parseInt(index); n++) {

        $('#card_' + id + ' .star-rating').find('[data-index="' + n + '"]').attr("class", "fa fa-star")

    }
    for (let m = parseInt(index) + 1; m <= 6; m++) {
        $('#card_' + id + ' .star-rating').find('[data-index="' + m + '"]').attr("class", "fa fa-star-o")

    }
    // }
    let x, newIcon = iconScore(icon)[1];
    if (icon === "fa fa-star") {
        x = (index - 1) * 2 + iconScore(icon)[0] - 1
    } else {
        x = (index - 1) * 2 + iconScore(icon)[0] + 1;
    }

    return [x, newIcon];
}