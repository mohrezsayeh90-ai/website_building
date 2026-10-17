let tabcnt = 0
let selstart
let selend
let cururl = 'prjman'
if (window.location.href.includes('/engineering/')) cururl = 'engineering'
$(document).ready(() => {
    jalaliDatepicker.startWatch()
    let body = $("body"), name = $("#proName"), code = $("#proCode");
    let cnt = $(".colorful-counter"), container = $("#detail_table tbody"),
        len = container.find("tr:not(.total-sum)").length;
    cnt.text(len);
    let scroll1 = $(".scroll1").parents('div:eq(0)')
    if (scroll1.length > 0) {
        let top1 = scroll1[0].getBoundingClientRect().top;
        scroll1.height(`calc(100vh - ${top1 + 10}px)`)
    }
    let elementTable = new DataTable("#elementTable", {
        order: [[0, 'desc']],


    });
    //let top = elementTable[0].getBoundingClientRect().top;
    // new DataTable('#elementTable', {
    //     columns: [{ type: 'numeric' }, null, null, null, ],
    //     layout:{
    //         topStart: 'search',
    //         topEnd: 'pageLength',
    //     }
    // })
    $(".bi-plus-circle").on("click", function () {
        document.querySelector('#detail_table .total-sum').insertAdjacentHTML('beforebegin', `<tr class="text-center">
                         <td class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-1 px-1"></td>
                        <td class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-1 px-1"></td>
                        <td class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-1 px-1"></td>
                        <td class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-1 px-1"></td>
                        <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1"></td>
                        <td class="border border-slate-300 bg-white hover:border-gray-400"></td>
                        <td class="border border-slate-300 bg-white hover:border-gray-400 h-fit"></td>
                        <td class="border border-slate-300 bg-white hover:border-gray-400">
                        </td><td class="border border-slate-300 bg-white hover:border-blue-700">${container.find("tr:not(.total-sum)").length + 1}
                        </td>
                    </tr>`)
        cnt.text(container.find("tr:not(.total-sum)").length);
    })
    $(".bi-plus-circle").on("click", function () {
        document.querySelector('#detail_table .total-sum').insertAdjacentHTML('beforebegin', `<tr class="text-center">
                         <td class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-1 px-1"></td>
                        <td class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-1 px-1"></td>
                        <td class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-1 px-1"></td>
                        <td class="border border-slate-500 bg-gray-400 hover:border-gray-400 py-1 px-1"></td>
                        <td class="border border-slate-500 bg-white hover:border-gray-400 py-1 px-1"></td>
                        <td class="border border-slate-300 bg-white hover:border-gray-400"></td>
                        <td class="border border-slate-300 bg-white hover:border-gray-400 h-fit"></td>
                        <td class="border border-slate-300 bg-white hover:border-gray-400">
                        </td><td class="border border-slate-300 bg-white hover:border-blue-700">${container.find("tr:not(.total-sum)").length + 1}
                        </td>
                    </tr>`)
        cnt.text(container.find("tr:not(.total-sum)").length);
    })

    $('#alltabsMain li').each(function (key, elem) {
        tabcnt++
    })

// for(let i=0;i<tabcnt-1;i++){
//     headerSum(`${i}_0`)
// }

    setTitle(0)
})
$('textarea').on("keydown", function (e) {
    /* ENTER PRESSED*/
    // alert(e.which)
    //alert(e.target.id)
    if (e.keyCode == 13) {
        /* FOCUS ELEMENT */
        let inputs = $(this).parents().parent().eq(0).find("textarea:visible");
        let idx = inputs.index(this);

        if (idx == inputs.length - 1) {
            inputs[0].select()
        } else {
            inputs[idx + 1].focus(); //  handles submit buttons
            inputs[idx + 1].select();
        }

        return false;
    } else if (e.which == 119) {
        try {
            let text = $(`#${currenttext}`).val()
            if (selstart != null && selend != null) {
                let text1 = text.substring(0, selstart) + "\n"
                let text2 = text.substring(selend, text.length)
                // console.log(text)
                // console.log(text1)
                // console.log(text2)
                $(`#${currenttext}`).val(text1 + text2)
            }
        } catch (e) {
            console.log(e)
        }

    }

});
$(document).on('keydown', (ev) => {
    if (ev.keyCode == 27) {
        $('#my-search-list00').css('display', 'none')
        $('#my-search-list01').css('display', 'none')
        $('#my-search-list02').css('display', 'none')
        if (!$(`#mydrpbH_1`).hasClass('hidden')) {
            $(`#mydrpbH_1`).addClass('hidden')
        }
    }
})
$('#elementButId').on('click', async () => {
    if ($('#equipment').val() === '') {
        await ToastPro('Please fill all inputs!', 'top', 'error', 0, 'ltr')
        $('#equipment').focus()
        return
    }
    Swal.fire({
        icon: 'question',
        html: `<h1 dir="ltr">Are you sure about saving data?<h1> `,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then(async (res) => {
        if (res.isConfirmed) {
            await ToastPro('Data has been saved successfully!', 'top', 'success', 0, 'ltr')
            $(`#elementPro`).val(1)

            $('#equipmentForm').submit()
        }
    })
})
$(`button[id^="button_element_edit_"]`).on("click", async (ev) => {
    let eleid = ev.target.id.split("_")[3]
    $('#elementID').val(eleid)
    $(`#elementPro`).val(3)
    let data = ev.target.ariaLabel.split(";;;")
    $('#equipment').val(data[0])
    $('#specification').val(data[1])
    $('#brand').val(data[2])
    $('#clearAll').removeClass('hidden')
})
$('#clearAll').on('click', async () => {
    $('#clearAll').addClass('hidden')
    $('#equipment').val('')
    $('#specification').val('')
    $('#brand').val('')
    $(`#elementPro`).val(0)
    $('#elementID').val(0)
})
$(`button[id^="button_element_del_"]`).on("click", async (ev) => {
    Swal.fire({
        icon: 'question',
        html: '<h3 dir="ltr">Are you sure to delete this item?</h3>',
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then(async (res) => {
        if (res.isConfirmed) {
            let eleid = ev.target.id.split("_")[3]
            $('#elementID').val(eleid)
            await ToastPro('Data has bee deleted successfully!', 'top', 'success', 0, 'ltr')
            $(`#elementPro`).val(2)//delete
            $('#equipmentForm').submit()
        }
    })
})
let s00, s01, s02
let currenttext
let scrollElemm = document.getElementsByClassName("my-vertical-scroll-div ")[0];
$(`textarea[id^="cell_1_"]`).on('keyup', (ev) => {
    s00 = ev.target.id
    currenttext = ev.target.id
    let tmp = s00.split('_')
    if ($('#my-search-list00').css('display') == 'none' && $(`#row_typem_${tmp[2] + '-' + tmp[3]}`).val() != 'Accessories') {
        $('#my-search-list00').css('display', 'block')
        $('#my-search-list00').css('top', $(`#${s00}`).parent().offset().top + $(`#${s00}`).height() - 40 + scrollElemm.scrollTop)
        $('#my-search-list00').css('left', $(`#${s00}`).parent().offset().left)
    } else if ($('#my-search-list10').css('display') == 'none' && $(`#row_typem_${tmp[2] + '-' + tmp[3]}`).val() == 'Accessories') {
        $('#my-search-list10').css('display', 'block')
        $('#my-search-list10').css('top', $(`#${s00}`).parent().offset().top + $(`#${s00}`).height() - 40 + scrollElemm.scrollTop)
        $('#my-search-list10').css('left', $(`#${s00}`).parent().offset().left)
    }
    if (ev.key == "Escape") {
        $('#my-search-list00').css('display', 'none')
        $('#my-search-list01').css('display', 'none')
        $('#my-search-list02').css('display', 'none')
        $('#my-search-list10').css('display', 'none')
        $('#my-search-list11').css('display', 'none')
        $('#my-search-list12').css('display', 'none')
    }

    if ($(`#row_typem_${tmp[2] + '-' + tmp[3]}`).val() != 'Accessories')
        $("#my-search-list00>ul>li").each(function (index, element) {
            //console.log($(element).click());
            $(element).show()
            if (!$(element).html().toLowerCase().includes(ev.target.value.toLowerCase())) {
                $(element).hide()
            }
        })
    else
        $("#my-search-list10>ul>li").each(function (index, element) {
            //console.log($(element).click());
            $(element).show()
            if (!$(element).html().toLowerCase().includes(ev.target.value.toLowerCase())) {
                $(element).hide()
            }
        })
})
$(`textarea[id^="cell_2_"]`).on('keyup', (ev) => {
    s01 = ev.target.id
    currenttext = ev.target.id
    let tmp = s01.split('_')
    if ($('#my-search-list01').css('display') == 'none' && $(`#row_typem_${tmp[2] + '-' + tmp[3]}`).val() != 'Accessories') {
        $('#my-search-list01').css('display', 'block')
        $('#my-search-list01').css('top', $(`#${s01}`).parent().offset().top + $(`#${s01}`).height() - 40 + scrollElemm.scrollTop)
        $('#my-search-list01').css('left', $(`#${s01}`).parent().offset().left)
    } else if ($('#my-search-list11').css('display') == 'none' && $(`#row_typem_${tmp[2] + '-' + tmp[3]}`).val() == 'Accessories') {
        $('#my-search-list11').css('display', 'block')
        $('#my-search-list11').css('top', $(`#${s01}`).parent().offset().top + $(`#${s01}`).height() - 40 + scrollElemm.scrollTop)
        $('#my-search-list11').css('left', $(`#${s01}`).parent().offset().left)
    }
    if (ev.key == "Escape") {
        $('#my-search-list00').css('display', 'none')
        $('#my-search-list01').css('display', 'none')
        $('#my-search-list02').css('display', 'none')
        $('#my-search-list10').css('display', 'none')
        $('#my-search-list11').css('display', 'none')
        $('#my-search-list12').css('display', 'none')
    }

    let cluepro = (";" + $(`#cell_1_${tmp[2] + '_' + tmp[3]}`).val() + ";").toLowerCase()
    //alert(cluepro)
    if ($(`#row_typem_${tmp[2] + '-' + tmp[3]}`).val() != 'Accessories')
        $("#my-search-list01>ul>li").each(function (index, element) {
            //  console.log($(element).attr('aria-label'));

            $(element).show()
            if (!$(element).html().toLowerCase().includes(ev.target.value.toLowerCase()) || (cluepro != ";;" && !$(element).attr('aria-label').toLowerCase().includes(cluepro))) {
                $(element).hide()
            }
        })
    else
        $("#my-search-list11>ul>li").each(function (index, element) {
            //console.log($(element).click());
            $(element).show()
            if (!$(element).html().toLowerCase().includes(ev.target.value.toLowerCase()) || (cluepro != ";;" && !$(element).attr('aria-label').toLowerCase().includes(cluepro))) {
                $(element).hide()
            }
        })
})
$(`textarea[id^="cell_3_"]`).on('keyup', (ev) => {
    s02 = ev.target.id
    currenttext = ev.target.id
    let tmp = s02.split('_')
    if ($('#my-search-list02').css('display') == 'none' && $(`#row_typem_${tmp[2] + '-' + tmp[3]}`).val() != 'Accessories') {
        $('#my-search-list02').css('display', 'block')
        $('#my-search-list02').css('top', $(`#${s02}`).parent().offset().top + $(`#${s02}`).height() - 40 + scrollElemm.scrollTop)
        $('#my-search-list02').css('left', $(`#${s02}`).parent().offset().left)
    } else if ($('#my-search-list12').css('display') == 'none' && $(`#row_typem_${tmp[2] + '-' + tmp[3]}`).val() == 'Accessories') {
        $('#my-search-list12').css('display', 'block')
        $('#my-search-list12').css('top', $(`#${s02}`).parent().offset().top + $(`#${s02}`).height() - 40 + scrollElemm.scrollTop)
        $('#my-search-list12').css('left', $(`#${s02}`).parent().offset().left)
    }
    if (ev.key == "Escape") {
        $('#my-search-list00').css('display', 'none')
        $('#my-search-list01').css('display', 'none')
        $('#my-search-list02').css('display', 'none')
        $('#my-search-list10').css('display', 'none')
        $('#my-search-list11').css('display', 'none')
        $('#my-search-list12').css('display', 'none')
    }

    let cluepro = (";" + $(`#cell_1_${tmp[2] + '_' + tmp[3]}`).val() + ";").toLowerCase()
    if ($(`#row_typem_${tmp[2] + '-' + tmp[3]}`).val() != 'Accessories')
        $("#my-search-list02>ul>li").each(function (index, element) {

            $(element).show()
            if (!$(element).html().toLowerCase().includes(ev.target.value.toLowerCase()) || (cluepro != ";;" && !$(element).attr('aria-label').toLowerCase().includes(cluepro))) {
                $(element).hide()
            }
        })
    else
        $("#my-search-list12>ul>li").each(function (index, element) {
            //console.log($(element).click());
            $(element).show()
            if (!$(element).html().toLowerCase().includes(ev.target.value.toLowerCase()) || (cluepro != ";;" && !$(element).attr('aria-label').toLowerCase().includes(cluepro))) {
                $(element).hide()
            }
        })
})
$("#my-search-list00>ul>li").on('click', (ev) => {
    $(`#${s00}`).val(ev.currentTarget.textContent)
    $(`#${s00}`).focus()
    $('#my-search-list00').css('display', 'none')

    if (!$('#saveAllSheets').hasClass('animate-bounce')) $('#saveAllSheets').addClass('animate-bounce text-red-400')
})
$("#my-search-list01>ul>li").on('click', (ev) => {
    $(`#${s01}`).val(ev.currentTarget.textContent)
    $(`#${s01}`).focus()
    $('#my-search-list01').css('display', 'none')

    if (!$('#saveAllSheets').hasClass('animate-bounce')) $('#saveAllSheets').addClass('animate-bounce text-red-400')
})
$("#my-search-list02>ul>li").on('click', (ev) => {
    $(`#${s02}`).val(ev.currentTarget.textContent)
    $(`#${s02}`).focus()
    $('#my-search-list02').css('display', 'none')
    if (!$('#saveAllSheets').hasClass('animate-bounce')) $('#saveAllSheets').addClass('animate-bounce text-red-400')
})
$("#my-search-list10>ul>li").on('click', (ev) => {
    $(`#${s00}`).val(ev.currentTarget.textContent)
    $(`#${s00}`).focus()
    $('#my-search-list10').css('display', 'none')

    if (!$('#saveAllSheets').hasClass('animate-bounce')) $('#saveAllSheets').addClass('animate-bounce text-red-400')
})
$("#my-search-list11>ul>li").on('click', (ev) => {
    $(`#${s01}`).val(ev.currentTarget.textContent)
    $(`#${s01}`).focus()
    $('#my-search-list11').css('display', 'none')

    if (!$('#saveAllSheets').hasClass('animate-bounce')) $('#saveAllSheets').addClass('animate-bounce text-red-400')
})
$("#my-search-list12>ul>li").on('click', (ev) => {
    $(`#${s02}`).val(ev.currentTarget.textContent)
    $(`#${s02}`).focus()
    $('#my-search-list12').css('display', 'none')
    if (!$('#saveAllSheets').hasClass('animate-bounce')) $('#saveAllSheets').addClass('animate-bounce text-red-400')
})
$(`textarea[id^="cell_2_"]`).on('focus', (ev) => {
    $('#my-search-list00').css('display', 'none')
    $('#my-search-list01').css('display', 'none')
    $('#my-search-list02').css('display', 'none')
    $('#my-search-list10').css('display', 'none')
    $('#my-search-list11').css('display', 'none')
    $('#my-search-list12').css('display', 'none')
})
$(`textarea[id^="cell_1_"]`).on('focus', (ev) => {
    $('#my-search-list00').css('display', 'none')
    $('#my-search-list01').css('display', 'none')
    $('#my-search-list02').css('display', 'none')
    $('#my-search-list10').css('display', 'none')
    $('#my-search-list11').css('display', 'none')
    $('#my-search-list12').css('display', 'none')
})
$(`textarea[id^="cell_3_"]`).on('focus', (ev) => {
    $('#my-search-list00').css('display', 'none')
    $('#my-search-list01').css('display', 'none')
    $('#my-search-list02').css('display', 'none')
    $('#my-search-list10').css('display', 'none')
    $('#my-search-list11').css('display', 'none')
    $('#my-search-list12').css('display', 'none')
})
$(`textarea[id^="cell_4_"]`).on('focus', (ev) => {
    $('#my-search-list00').css('display', 'none')
    $('#my-search-list01').css('display', 'none')
    $('#my-search-list02').css('display', 'none')
    $('#my-search-list10').css('display', 'none')
    $('#my-search-list11').css('display', 'none')
    $('#my-search-list12').css('display', 'none')
})
$(`textarea[id^="cell_4_"]`).on('focus', (ev) => {
    $('#my-search-list00').css('display', 'none')
    $('#my-search-list01').css('display', 'none')
    $('#my-search-list02').css('display', 'none')
    $('#my-search-list10').css('display', 'none')
    $('#my-search-list11').css('display', 'none')
    $('#my-search-list12').css('display', 'none')
})
$(`textarea[id^="cell_6"]`).on('focus', (ev) => {
    $('#my-search-list00').css('display', 'none')
    $('#my-search-list01').css('display', 'none')
    $('#my-search-list02').css('display', 'none')
    $('#my-search-list10').css('display', 'none')
    $('#my-search-list11').css('display', 'none')
    $('#my-search-list12').css('display', 'none')
})
$(`textarea[id^="cell_8_"]`).on('focus', (ev) => {
    $('#my-search-list00').css('display', 'none')
    $('#my-search-list01').css('display', 'none')
    $('#my-search-list02').css('display', 'none')
    $('#my-search-list10').css('display', 'none')
    $('#my-search-list11').css('display', 'none')
    $('#my-search-list12').css('display', 'none')
})
$(`textarea[id^="cell_9_"]`).on('focus', (ev) => {
    $('#my-search-list00').css('display', 'none')
    $('#my-search-list01').css('display', 'none')
    $('#my-search-list02').css('display', 'none')
    $('#my-search-list10').css('display', 'none')
    $('#my-search-list11').css('display', 'none')
    $('#my-search-list12').css('display', 'none')
})
$(`textarea[id^="cell_4_"]`).on('change', (ev) => {
    // let celln="cell_7_"+ev.target.id.split("cell_4_")[1]
    // let cellnn="cell_5_"+ev.target.id.split("cell_4_")[1]
    //
    // let intRegex = /^\d+$/;
    // var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
    // if((intRegex.test(ev.target.value) || floatRegex.test(ev.target.value)) &&
    //     ((intRegex.test($(`#${cellnn}`).val()) || floatRegex.test($(`#${cellnn}`).val()))))
    // {
    //     $(`#${celln}`).html((parseFloat(ev.target.value)*parseFloat($(`#${cellnn}`).val())).toLocaleString(undefined))
    //     headerSum(ev.target.id.split("cell_4_")[1])
    // }
    if (!$('#saveAllSheets').hasClass('animate-bounce')) $('#saveAllSheets').addClass('animate-bounce text-red-400')
})
$(`textarea[id^="cell_5_"]`).on('change', (ev) => {
    let tmp=ev.target.id.split("_")
    let celln = "cell_7_" + ev.target.id.split("cell_5_")[1]
    let cellnn = "cell_6_" + ev.target.id.split("cell_5_")[1]

    let intRegex = /^\d+$/;
    let floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
    if ((intRegex.test(ev.target.value) || floatRegex.test(ev.target.value)) &&
        ((intRegex.test($(`#${cellnn}`).val()) || floatRegex.test($(`#${cellnn}`).val())))) {
        let sum1=parseFloat(ev.target.value) + parseFloat($(`#${cellnn}`).val())
        for(let i=1;i<=5;i++)
        {
            let cellnnn="cell_6"+i+"_" + tmp[2]+"_"+tmp[3]
            if ((intRegex.test($(`#${cellnnn}`).val()) || floatRegex.test($(`#${cellnnn}`).val())))
            {
                sum1+=parseFloat($(`#${cellnnn}`).val())
            }
        }
        $(`#${celln}`).html((sum1).toLocaleString(undefined))
        //  headerSum(ev.target.id.split("cell_5_")[1])
    }
    if (!$('#saveAllSheets').hasClass('animate-bounce')) $('#saveAllSheets').addClass('animate-bounce text-red-400')
})

$(`textarea[id^="cell_6"]`).on('change', (ev) => {
    let tmp=ev.target.id.split("_")
    let celln = "cell_7_" + tmp[2]+"_"+tmp[3]
    let cellnn = "cell_5_" + tmp[2]+"_"+tmp[3]
let cell="cell_6_" + tmp[2]+"_"+tmp[3]
    let intRegex = /^\d+$/;
    let floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
    if ((intRegex.test($(`#${cell}`).val()) || floatRegex.test($(`#${cell}`).val())) &&
        ((intRegex.test($(`#${cellnn}`).val()) || floatRegex.test($(`#${cellnn}`).val())))) {
        let sum1=parseFloat($(`#${cell}`).val()) + parseFloat($(`#${cellnn}`).val())
        for(let i=1;i<=5;i++)
        {
            let cellnnn="cell_6"+i+"_" + tmp[2]+"_"+tmp[3]
            if ((intRegex.test($(`#${cellnnn}`).val()) || floatRegex.test($(`#${cellnnn}`).val())))
            {
                sum1+=parseFloat($(`#${cellnnn}`).val())
            }
        }
        $(`#${celln}`).html((sum1).toLocaleString(undefined))
        //   headerSum(ev.target.id.split("cell_6_")[1])
    }
    if (!$('#saveAllSheets').hasClass('animate-bounce')) $('#saveAllSheets').addClass('animate-bounce text-red-400')
})
$(`textarea[id^="cell_8_"]`).on('change', (ev) => {
    if (!$('#saveAllSheets').hasClass('animate-bounce')) $('#saveAllSheets').addClass('animate-bounce text-red-400')
})
$(`textarea[id^="cell_9_"]`).on('change', (ev) => {
    if (!$('#saveAllSheets').hasClass('animate-bounce')) $('#saveAllSheets').addClass('animate-bounce text-red-400')
})


$(`#saveAllSheets`).on('click', async () => {
    if ($('#saveAllSheets').hasClass('animate-bounce')) $('#saveAllSheets').removeClass('animate-bounce text-red-400')
    let allD = []
    let thiscnt = 0
    for (let i = 0; i < tabcnt - 1; i++) {

        for (let j = 0; j < 100; j++) {

            if ($(`#cell_1_${i}_${j}`).val() != '') {
                allD.push([$(`#prd_ten_${i}`).val(), $(`#cell_1_${i}_${j}`).val(),
                    $(`#cell_2_${i}_${j}`).val(),
                    $(`#cell_3_${i}_${j}`).val(),
                    $(`#cell_4_${i}_${j}`).val(),
                    $(`#cell_5_${i}_${j}`).val(),
                    $(`#cell_6_${i}_${j}`).val(),
                    $(`#cell_7_${i}_${j}`).html(),
                    $(`#cell_8_${i}_${j}`).val(),
                    $(`#cell_9_${i}_${j}`).val(),
                    $(`#row_typem_${i}-${j}`).val(),
                    $(`#cell_61_${i}_${j}`).val(),
                    $(`#cell_62_${i}_${j}`).val(),
                    $(`#cell_63_${i}_${j}`).val(),
                    $(`#cell_64_${i}_${j}`).val(),$(`#cell_65_${i}_${j}`).val(),
                    $(`#cell_61_${i}_${j}`).attr('aria-label'),
                    $(`#cell_62_${i}_${j}`).attr('aria-label'),
                    $(`#cell_63_${i}_${j}`).attr('aria-label'),
                    $(`#cell_64_${i}_${j}`).attr('aria-label'),$(`#cell_65_${i}_${j}`).attr('aria-label'),
                ])

            }

        }
    }

    await $.ajax({
        url: url('prjman/saveAllSheetsDPL'),
        method: "POST",
        data: {
            saveAllSheets: true,
            prjCode: $('#proj_code').val(),
            allData: allD
        }
    }).then(async result => {
        await ToastPro('All data has been saved!', 'top', 'success', 0, 'ltr')
    })

})
let thismenu
$(`button[id^="mydrpb_"]`).on('click', async (ev) => {
    let thisid = ev.target.id.split("_")[1]

    thismenu = `row_typem_${thisid}`
    if ($(`#mydrpbH_1`).hasClass('hidden')) {
        $(`#mydrpbH_1`).removeClass('hidden')
        //alert($(`#${thismenu}`).val())
        //$(`#row_typem`).val($(`#row_typem_${thisid}`).val())
        //  let $radios = $('input:radio[name=radio_1]');
        //  $radios.filter(`[value=${$("#"+thismenu).val()}]`).attr('checked', true);
        switch ($(`#${thismenu}`).val()) {
            case 'VCB':
                $('#radio_4_1').prop('checked', true)

                break
            case 'Accessories':

                $('#radio_4_2').prop('checked', true)

                break;
            case 'Normal':
                $('#radio_4_3').prop('checked', true)

                break;
            case 'Foreign Accessories':
                $('#radio_4_4').prop('checked', true)

                break;
        }

        $(`#mydrpbH_1`).css('top', $(`#${ev.target.id}`).parent().offset().top + $(`#${ev.target.id}`).height() - 40 + scrollElemm.scrollTop)
        $(`#mydrpbH_1`).css('left', $(`#${ev.target.id}`).parent().offset().left)
    } else
        $(`#mydrpbH_1`).addClass('hidden')
})
$(`input[type="radio"][id^="radio_4"]`).on('click', async (ev) => {
    let pos = ev.target.id.split("_")[2]
    let changed = $(`#${thismenu}`).val()
    let tmp = thismenu.split('_')

    switch (pos) {
        case "1":
            $(`#${thismenu}`).val('VCB')
            if ($(`#item_${tmp[2]}`).hasClass('bg-white')) $(`#item_${tmp[2]}`).removeClass('bg-white')
            if ($(`#item_${tmp[2]}`).hasClass('bg-bg-red-200')) $(`#item_${tmp[2]}`).removeClass('bg-red-200')
            if ($(`#item_${tmp[2]}`).hasClass('bg-slate-200')) $(`#item_${tmp[2]}`).removeClass('bg-slate-200')
            $(`#item_${tmp[2]}`).addClass('bg-green-300')
            break
        case "2":
            $(`#${thismenu}`).val('Accessories')
            if ($(`#item_${tmp[2]}`).hasClass('bg-white')) $(`#item_${tmp[2]}`).removeClass('bg-white')
            if ($(`#item_${tmp[2]}`).hasClass('bg-green-300')) $(`#item_${tmp[2]}`).removeClass('bg-green-300')
            if ($(`#item_${tmp[2]}`).hasClass('bg-slate-200')) $(`#item_${tmp[2]}`).removeClass('bg-slate-200')
            $(`#item_${tmp[2]}`).addClass('bg-red-200')
            break
        case "3":
            $(`#${thismenu}`).val('Normal')
            if ($(`#item_${tmp[2]}`).hasClass('bg-bg-red-200')) $(`#item_${tmp[2]}`).removeClass('bg-bg-red-200')
            if ($(`#item_${tmp[2]}`).hasClass('bg-green-300')) $(`#item_${tmp[2]}`).removeClass('bg-green-300')
            if ($(`#item_${tmp[2]}`).hasClass('bg-slate-200')) $(`#item_${tmp[2]}`).removeClass('bg-slate-200')
            $(`#item_${tmp[2]}`).addClass('bg-white')
            break
        case "4":
            $(`#${thismenu}`).val('Foreign Accessories')
            if ($(`#item_${tmp[2]}`).hasClass('bg-bg-red-200')) $(`#item_${tmp[2]}`).removeClass('bg-bg-red-200')
            if ($(`#item_${tmp[2]}`).hasClass('bg-white')) $(`#item_${tmp[2]}`).removeClass('bg-white')
            if ($(`#item_${tmp[2]}`).hasClass('bg-green-300')) $(`#item_${tmp[2]}`).removeClass('bg-green-300')
            $(`#item_${tmp[2]}`).addClass('bg-slate-200')
            break
    }
    if (changed != $(`#${thismenu}`).val()) {
        if (!$('#saveAllSheets').hasClass('animate-bounce')) $('#saveAllSheets').addClass('animate-bounce text-red-400')
        // for (let i = 0; i < tabcnt - 1; i++) {
        //     headerSum(`${i}_0`)
        // }
        await ToastPro(`Type has been set to ${$(`#${thismenu}`).val()} for this row !`, 'top', 'info', 0, 'ltr')
    }
    $(`#mydrpbH_1`).addClass('hidden')
})
$('#reloadAllSheets').on('click', async () => {
    Swal.fire({
        icon: 'question',
        html: `<h1 dir="ltr">Are you sure for reloading data?<h1> `,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then(async (res) => {
        if (res.isConfirmed) {
            location.reload();
        }
    })
})
$('#deletethisRow').on('click', async () => {
    $(`#mydrpbH_1`).addClass('hidden')
    Swal.fire({
        icon: 'question',
        html: `<h1 dir="ltr">Are you sure that you want to delete this row?<h1> `,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then(async (res) => {
        if (res.isConfirmed) {
            if (!$('#saveAllSheets').hasClass('animate-bounce')) $('#saveAllSheets').addClass('animate-bounce text-red-400')
            let tmp = thismenu.split('_')[2].split('-')
            for (let i = parseInt(tmp[1]) + 1; i < 99; i++) {
                $(`#row_typem_${tmp[0] + '-' + String(i - 1)}`).val($(`#row_typem_${tmp[0] + '-' + String(i)}`).val())
                switch ($(`#row_typem_${tmp[0] + '-' + String(i - 1)}`).val()) {
                    case "VCB":

                        if ($(`#item_${tmp[0] + '-' + String(i - 1)}`).hasClass('bg-white')) $(`#item_${tmp[0] + '-' + String(i - 1)}`).removeClass('bg-white')
                        if ($(`#item_${tmp[0] + '-' + String(i - 1)}`).hasClass('bg-bg-red-200')) $(`#item_${tmp[0] + '-' + String(i - 1)}`).removeClass('bg-red-200')
                        if ($(`#item_${tmp[0] + '-' + String(i - 1)}`).hasClass('bg-slate-200')) $(`#item_${tmp[0] + '-' + String(i - 1)}`).removeClass('bg-slate-200')
                        $(`#item_${tmp[0] + '-' + String(i - 1)}`).addClass('bg-green-300')
                        break
                    case "Accessories":

                        if ($(`#item_${tmp[0] + '-' + String(i - 1)}`).hasClass('bg-white')) $(`#item_${tmp[0] + '-' + String(i - 1)}`).removeClass('bg-white')
                        if ($(`#item_${tmp[0] + '-' + String(i - 1)}`).hasClass('bg-green-300')) $(`#item_${tmp[0] + '-' + String(i - 1)}`).removeClass('bg-green-300')
                        if ($(`#item_${tmp[0] + '-' + String(i - 1)}`).hasClass('bg-slate-200')) $(`#item_${tmp[0] + '-' + String(i - 1)}`).removeClass('bg-slate-200')
                        $(`#item_${tmp[0] + '-' + String(i - 1)}`).addClass('bg-red-200')
                        break
                    case "Normal":

                        if ($(`#item_${tmp[0] + '-' + String(i - 1)}`).hasClass('bg-bg-red-200')) $(`#item_${tmp[0] + '-' + String(i - 1)}`).removeClass('bg-bg-red-200')
                        if ($(`#item_${tmp[0] + '-' + String(i - 1)}`).hasClass('bg-green-300')) $(`#item_${tmp[0] + '-' + String(i - 1)}`).removeClass('bg-green-300')
                        if ($(`#item_${tmp[0] + '-' + String(i - 1)}`).hasClass('bg-slate-200')) $(`#item_${tmp[0] + '-' + String(i - 1)}`).removeClass('bg-slate-200')
                        $(`#item_${tmp[0] + '-' + String(i - 1)}`).addClass('bg-white')
                        break
                    case "Foreign Accessories":

                        if ($(`#item_${tmp[0] + '-' + String(i - 1)}`).hasClass('bg-bg-red-200')) $(`#item_${tmp[0] + '-' + String(i - 1)}`).removeClass('bg-bg-red-200')
                        if ($(`#item_${tmp[0] + '-' + String(i - 1)}`).hasClass('bg-green-300')) $(`#item_${tmp[0] + '-' + String(i - 1)}`).removeClass('bg-green-300')
                        if ($(`#item_${tmp[0] + '-' + String(i - 1)}`).hasClass('bg-white')) $(`#item_${tmp[0] + '-' + String(i - 1)}`).removeClass('bg-white')
                        $(`#item_${tmp[0] + '-' + String(i - 1)}`).addClass('bg-slate-200')
                        break
                }
                $(`#cell_1_${tmp[0] + '_' + String(i - 1)}`).val($(`#cell_1_${tmp[0] + '_' + String(i)}`).val())
                $(`#cell_2_${tmp[0] + '_' + String(i - 1)}`).val($(`#cell_2_${tmp[0] + '_' + String(i)}`).val())
                $(`#cell_3_${tmp[0] + '_' + String(i - 1)}`).val($(`#cell_3_${tmp[0] + '_' + String(i)}`).val())
                $(`#cell_4_${tmp[0] + '_' + String(i - 1)}`).val($(`#cell_4_${tmp[0] + '_' + String(i)}`).val())
                $(`#cell_5_${tmp[0] + '_' + String(i - 1)}`).val($(`#cell_5_${tmp[0] + '_' + String(i)}`).val())
                $(`#cell_6_${tmp[0] + '_' + String(i - 1)}`).val($(`#cell_6_${tmp[0] + '_' + String(i)}`).val())
                $(`#cell_7_${tmp[0] + '_' + String(i - 1)}`).html($(`#cell_7_${tmp[0] + '_' + String(i)}`).html())
                $(`#cell_8_${tmp[0] + '_' + String(i - 1)}`).html($(`#cell_8_${tmp[0] + '_' + String(i)}`).html())
                $(`#cell_9_${tmp[0] + '_' + String(i - 1)}`).html($(`#cell_9_${tmp[0] + '_' + String(i)}`).html())
            }
            // for (let i = 0; i < tabcnt - 1; i++) {
            //     headerSum(`${i}_0`)
            // }
            await ToastPro(`Row has been deleted successfully !`, 'top', 'success', 0, 'ltr')
        }
    })
})
$('#insertNewRow').on('click', async () => {
    $(`#mydrpbH_1`).addClass('hidden')
    Swal.fire({
        icon: 'question',
        html: `<h1 dir="ltr">Are you sure that you want to insert new row?<h1> `,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then(async (res) => {
        if (res.isConfirmed) {
            if (!$('#saveAllSheets').hasClass('animate-bounce')) $('#saveAllSheets').addClass('animate-bounce text-red-400')
            let tmp = thismenu.split('_')[2].split('-')
            // console.log(tmp)
            for (let i = 98; i >= parseInt(tmp[1]); i--) {
                //console.log(i)
                $(`#row_typem_${tmp[0] + '-' + String(i + 1)}`).val($(`#row_typem_${tmp[0] + '-' + String(i)}`).val())
                switch ($(`#row_typem_${tmp[0] + '-' + String(i)}`).val()) {
                    case "VCB":

                        if ($(`#item_${tmp[0] + '-' + String(i + 1)}`).hasClass('bg-white')) $(`#item_${tmp[0] + '-' + String(i + 1)}`).removeClass('bg-white')
                        if ($(`#item_${tmp[0] + '-' + String(i + 1)}`).hasClass('bg-bg-red-200')) $(`#item_${tmp[0] + '-' + String(i + 1)}`).removeClass('bg-red-200')
                        if ($(`#item_${tmp[0] + '-' + String(i + 1)}`).hasClass('bg-slate-200')) $(`#item_${tmp[0] + '-' + String(i + 1)}`).removeClass('bg-slate-200')
                        $(`#item_${tmp[0] + '-' + String(i + 1)}`).addClass('bg-green-300')
                        break
                    case "Accessories":

                        if ($(`#item_${tmp[0] + '-' + String(i + 1)}`).hasClass('bg-white')) $(`#item_${tmp[0] + '-' + String(i + 1)}`).removeClass('bg-white')
                        if ($(`#item_${tmp[0] + '-' + String(i + 1)}`).hasClass('bg-green-300')) $(`#item_${tmp[0] + '-' + String(i + 1)}`).removeClass('bg-green-300')
                        if ($(`#item_${tmp[0] + '-' + String(i + 1)}`).hasClass('bg-slate-200')) $(`#item_${tmp[0] + '-' + String(i + 1)}`).removeClass('bg-slate-200')
                        $(`#item_${tmp[0] + '-' + String(i + 1)}`).addClass('bg-red-200')
                        break
                    case "Normal":

                        if ($(`#item_${tmp[0] + '-' + String(i + 1)}`).hasClass('bg-bg-red-200')) $(`#item_${tmp[0] + '-' + String(i + 1)}`).removeClass('bg-bg-red-200')
                        if ($(`#item_${tmp[0] + '-' + String(i + 1)}`).hasClass('bg-green-300')) $(`#item_${tmp[0] + '-' + String(i + 1)}`).removeClass('bg-green-300')
                        if ($(`#item_${tmp[0] + '-' + String(i + 1)}`).hasClass('bg-slate-200')) $(`#item_${tmp[0] + '-' + String(i + 1)}`).removeClass('bg-slate-200')
                        $(`#item_${tmp[0] + '-' + String(i + 1)}`).addClass('bg-white')
                        break
                    case "Foreign Accessories":

                        if ($(`#item_${tmp[0] + '-' + String(i + 1)}`).hasClass('bg-bg-red-200')) $(`#item_${tmp[0] + '-' + String(i + 1)}`).removeClass('bg-bg-red-200')
                        if ($(`#item_${tmp[0] + '-' + String(i + 1)}`).hasClass('bg-white')) $(`#item_${tmp[0] + '-' + String(i + 1)}`).removeClass('bg-white')
                        if ($(`#item_${tmp[0] + '-' + String(i + 1)}`).hasClass('bg-green-300')) $(`#item_${tmp[0] + '-' + String(i + 1)}`).removeClass('bg-green-300')
                        $(`#item_${tmp[0] + '-' + String(i + 1)}`).addClass('bg-slate-200')
                        break
                }
                $(`#cell_1_${tmp[0] + '_' + String(i + 1)}`).val($(`#cell_1_${tmp[0] + '_' + String(i)}`).val())
                $(`#cell_2_${tmp[0] + '_' + String(i + 1)}`).val($(`#cell_2_${tmp[0] + '_' + String(i)}`).val())
                $(`#cell_3_${tmp[0] + '_' + String(i + 1)}`).val($(`#cell_3_${tmp[0] + '_' + String(i)}`).val())
                $(`#cell_4_${tmp[0] + '_' + String(i + 1)}`).val($(`#cell_4_${tmp[0] + '_' + String(i)}`).val())
                $(`#cell_5_${tmp[0] + '_' + String(i + 1)}`).val($(`#cell_5_${tmp[0] + '_' + String(i)}`).val())
                $(`#cell_6_${tmp[0] + '_' + String(i + 1)}`).val($(`#cell_6_${tmp[0] + '_' + String(i)}`).val())
                $(`#cell_7_${tmp[0] + '_' + String(i + 1)}`).html($(`#cell_7_${tmp[0] + '_' + String(i)}`).html())
                $(`#cell_8_${tmp[0] + '_' + String(i + 1)}`).html($(`#cell_8_${tmp[0] + '_' + String(i)}`).html())
                $(`#cell_9_${tmp[0] + '_' + String(i + 1)}`).html($(`#cell_9_${tmp[0] + '_' + String(i)}`).html())
            }
            if ($(`#item_${tmp[0] + '-' + tmp[1]}`).hasClass('bg-bg-red-200')) $(`#item_${tmp[0] + '-' + tmp[1]}`).removeClass('bg-bg-red-200')
            if ($(`#item_${tmp[0] + '-' + tmp[1]}`).hasClass('bg-green-300')) $(`#item_${tmp[0] + '-' + tmp[1]}`).removeClass('bg-green-300')
            $(`#item_${tmp[0] + '-' + tmp[1]}`).addClass('bg-white')
            $(`#row_typem_${tmp[0] + '-' + tmp[1]}`).val('Normal')
            $(`#cell_1_${tmp[0] + '_' + tmp[1]}`).val('')
            $(`#cell_2_${tmp[0] + '_' + tmp[1]}`).val('')
            $(`#cell_3_${tmp[0] + '_' + tmp[1]}`).val('')
            $(`#cell_4_${tmp[0] + '_' + tmp[1]}`).val('0')
            $(`#cell_5_${tmp[0] + '_' + tmp[1]}`).val('0')
            $(`#cell_6_${tmp[0] + '_' + tmp[1]}`).val('0')
            $(`#cell_7_${tmp[0] + '_' + tmp[1]}`).html('0')
            $(`#cell_8_${tmp[0] + '_' + tmp[1]}`).html('')
            $(`#cell_9_${tmp[0] + '_' + tmp[1]}`).html('')
            await ToastPro(`Row has been inserted successfully !`, 'top', 'success', 0, 'ltr')
        }
    })
})
$(`#createmyExcelfile`).on('click', async () => {
    if ($('#saveAllSheets').hasClass('animate-bounce')) $('#saveAllSheets').removeClass('animate-bounce text-red-400')
    let allD = []
    let thiscnt = 0
    for (let i = 0; i < tabcnt - 1; i++) {

        for (let j = 0; j < 100; j++) {

            if ($(`#cell_1_${i}_${j}`).val() != '') {
                allD.push([$(`#prd_ten_${i}`).val(), $(`#cell_1_${i}_${j}`).val(),
                    $(`#cell_2_${i}_${j}`).val(),
                    $(`#cell_3_${i}_${j}`).val(),
                    $(`#cell_4_${i}_${j}`).val(),
                    $(`#cell_5_${i}_${j}`).val(),
                    $(`#cell_6_${i}_${j}`).val(),
                    $(`#row_typem_${i}-${j}`).val()])

            }

        }
    }
    ToastPro('Pdf file created successfully!', 'top', 'success', 0, 'ltr')
    let mdata = []
    for (let i = 0; i < tabcnt - 1; i++) {
        mdata.push($(`#prd_ten_title_${i}`).val())
    }
    await $.ajax({
        url: url('prjman/createProjectDPLPdf'),
        method: "POST",
        data: {
            prjCode: $('#proj_code').val(),
            tabcnt: tabcnt - 1,
            mdata: mdata,
            thisurl: window.location.href
        }
    }).then(async result => {

        window.open(url(JSON.parse(result)), '_blank')
        //setTimeout(async () => window.open(url(JSON.parse(result)[1]), '_blank'), 2000)

    })

})
document.onselectionchange = function () {
    try {
        let inp = document.querySelector(`#${currenttext}`);
        selstart = inp.selectionStart
        selend = inp.selectionEnd
    } catch (e) {
        selstart = null
        selend = null
    }

//alert(inp.selectionStart)
    // document.querySelector("p").innerText = "Start: "+inp.selectionStart+"\nEnd: "+inp.selectionEnd+"\n\nSelected: "+inp.value.substring(inp.selectionStart, inp.selectionEnd);
}

function setTitle(k, l = 0) {
    $('#my-search-list00').css('display', 'none')
    $('#my-search-list01').css('display', 'none')
    $('#my-search-list02').css('display', 'none')
    $('#my-search-list10').css('display', 'none')
    $('#my-search-list11').css('display', 'none')
    $('#my-search-list12').css('display', 'none')
    if (!$('#mydrpbH_1').hasClass('hidden')) $('#mydrpbH_1').addClass('hidden')
    $('#thistabTile').html('DOCUMENT TITLE: ' + $(`#prd_ten_title_${k}`).val())
}


async function signDPL(prjCode) {
    Swal.fire({
        icon: 'question',
        text: `آیا از امضای اسناد DPL پروژه ${prjCode} مطمئن هستید؟`,

        showCancelButton: true,
        cancelButtonText: "انصراف",
        confirmButtonText: "تایید",
        question: '؟'
    }).then(async (result) => {
        if (result.isConfirmed && result.value) {
            await $.ajax({
                url: url('prjman/signDPL'),
                method: "POST",
                data: {

                    prjCode: prjCode
                }
            }).then(async result => {
                await ToastPro(`اسناد با موفقیت توسط کاربر ${JSON.parse(result)} امضاء شد!`, 'top', 'success')
                window.location.href = url(cururl)
            })

        }
    })
}

async function p10000Decision(prjCode) {
    Swal.fire({
        title: `آیا اسناد DPL پروژه ${prjCode} را تایید می نمایید؟`,
        icon: 'question',
        html: `<div style="width:95%" class="flex flex-col  mr-1 ml-4">
         <input type="text" id="denyCauseDPL" class="bg-gray-50 border rtl border-gray-300 text-gray-900 
         text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
          dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="دلایل عدم تایید" required />
          <div class="flex flex-row justify-between pt-10">
          <button onclick="OKButtonDPL('${prjCode}')" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 
          focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 
          dark:hover:bg-green-700 dark:focus:ring-green-800">تایید</button>
<button onclick="denyButtonDPL('${prjCode}')" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 
focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 
dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">عدم تایید</button>
<button onclick="Swal.close()" type="button" class="focus:outline-none text-white bg-yellow-400 
hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 
me-2 mb-2 dark:focus:ring-yellow-900">انصراف</button>
        </div>
        </div>`,

        showDenyButton: false,
        showCancelButton: false,
        showConfirmButton: false,
        showCloseButton: true,
        width: 700,
        question: '؟',
    })
}

async function OKButtonDPL(prjCode) {
    await $.ajax({
        url: url('prjman/DPLAccepted'),
        method: "POST",
        data: {

            prjCode: prjCode
        }, dataType: "html"
    }).then(async result => {
        await ToastPro(`اسناد DPL پروژه با موفقیت تایید شد`, 'top', 'success')
        window.location.href = url(cururl)
    })
}

async function denyButtonDPL(prjCode) {
    if (document.querySelector('#denyCauseDPL').value == '') {
        document.querySelector('#denyCauseDPL').focus()
        let color = document.querySelector('#denyCauseDPL').style.backgroundColor
        document.querySelector('#denyCauseDPL').style.backgroundColor = "red"
        setTimeout(() => {
            document.querySelector('#denyCauseDPL').style.backgroundColor = color
        }, 2000)
        //await ToastPro('لطفا دلایل عدم تایید را قید نمایید','top','info')

    } else {
        await $.ajax({
            url: url('prjman/DPLNotAccepted'),
            method: "POST",
            data: {
                mcause: document.querySelector('#denyCauseDPL').value,
                prjCode: prjCode
            }, dataType: "html"
        }).then(async result => {
            await ToastPro(`اسناد DPL پروژه با موفقیت رد شد`, 'top', 'success')
            window.location.href = url(cururl)
        })
    }

}

function delCol(mah_cod, proj_cod) {

    Swal.fire({
        icon: 'question',
        html: `<h1 dir="ltr">Are you sure for deleting a column?<h1> `,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then(async (res) => {
        if (res.isConfirmed) {
            await $.ajax({
                url: url('prjman/dellastcol'),
                method: "POST",
                data: {

                    prjCode: proj_cod,
                    mah_cod: mah_cod
                }
            }).then(async result => {
                if(JSON.parse(result)=="ok")
                await ToastPro('Job done succefully!', 'top', 'success', 1, 'ltr')
                else
                    await ToastPro('Operation not permmited!', 'top', 'error', 0, 'ltr')
            })
        }
    })
}
function addCol(mah_cod, proj_cod)
{
    Swal.fire({
        text: `Please input a name for column`,
        input: "text",
        inputAttributes: {
            autocapitalize: "off",
            dir:"ltr"
        },
        showCancelButton: true,

        showLoaderOnConfirm: true,
        preConfirm: async (number) => {
            if (number) {

                return number;
            } else {
                Swal.showValidationMessage(`
         <span class="text-sm">Name can not be empty</span>
      `);
            }
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then(async (result) => {
        if (result.isConfirmed && result.value) {
            await $.ajax({
                url: url('prjman/addcoltoend'),
                method: "POST",
                data: {
                    colname:result.value,
                    prjCode: proj_cod,
                    mah_cod: mah_cod
                }
            }).then(async result => {
                if(JSON.parse(result)=="ok")
                await ToastPro('Job done succefully!', 'top', 'success', 1, 'ltr')
                else
                await ToastPro('Operation not permmited!', 'top', 'error', 0, 'ltr')
            })
        }
    })
}
function gototheList()
{
    if($('#saveAllSheets').hasClass('animate-bounce'))
    {
        Swal.fire({
            icon: 'question',
            html: `<h1 dir="ltr">Do you want to save data?<h1> `,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then(async (res) => {
            if (res.isConfirmed) {
                await $(`#saveAllSheets`).trigger('click')
                setTimeout(async ()=>  window.location.href=url('prjman'),3000);
            }
        })
    }
    else
        window.location.href=url('prjman')
}
function gototheList1()
{
    if($('#saveAllSheets').hasClass('animate-bounce'))
    {
        Swal.fire({
            icon: 'question',
            html: `<h1 dir="ltr">Do you want to save data?<h1> `,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then(async (res) => {
            if (res.isConfirmed) {
                await $(`#saveAllSheets`).trigger('click')
                setTimeout(async ()=>  window.location.href=url('engineering'),3000);
            }
        })
    }
    else
        window.location.href=url('engineering')
}
async function changeBOM(type,id,prj_cod){
    let valu=$(`#${id}`).val()
    switch(type){
        case 1:
            await $.ajax({
                url:url('prjman/changeBOM'),
                type:"POST",
                data:{
                    newval:valu,
                    field:'document_no',
                    prj_cod:prj_cod
                },
                dataType:"html"

            })
            break
        case 2:
            await $.ajax({
                url:url('prjman/changeBOM'),
                type:"POST",
                data:{
                    newval:valu,
                    field:'document_date',
                    prj_cod:prj_cod
                },
                dataType:"html"

            })
            break
    }
}