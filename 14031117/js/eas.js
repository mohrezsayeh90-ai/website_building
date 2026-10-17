let financells = 16
let ctrlz1 = []
let ctrlz2 = []
let ctrlz3 = []
let procinterval
let evpid
let evpvalue
let iteration = 300
let precisionm = 1000
$(document).ready(async () => {
    $('#settings-styled-tab').removeClass("bg-gray-100")
    $('#settings-styled-tab').addClass("bg-gray-500")
    $('#settings-styled-tab').addClass("text-white")
    $('#settings-styled-tab').removeClass("text-black")
    await $.ajax({
        url: url('detail/checkproposal'),
        method: "POST",
        data: {
            mon_cod: $('#mon_cod_main').val()
        }, dataType: "html"
    }).then(async (res) => {
        if (JSON.parse(res) == "0") {
            let dat = [];
            $(`textarea[id^="ps_"]`).each(function (k, l) {
                dat.push({"id": l.id, "value": l.value})
            })
            $(`textarea[id^="extra_data_"]`).each(function (k, l) {
                dat.push({"id": l.id, "value": l.value})
            })
            await $.ajax({
                url: url('detail/createproposal'),
                method: "POST",
                data: {
                    mon_cod: $('#mon_cod_main').val(),
                    dat: dat
                }, dataType: "html"
            })
        } else {
            let result = JSON.parse(res)
            result.forEach((item) => {
                $(`#${item.parameter}`).val(item.pval)
            })
        }
    })
    await $.ajax({
        url: url('detail/geteas'),
        method: "POST",
        data: {
            mon_cod: $('#mon_cod_main').val(),
        }, dataType: "html"
    }).then(async (result) => {
        // alert(result)
        if (result != 'null') {
            let res = JSON.parse(result)
            res.forEach((item) => {
                let mvalue = '0'
                try {
                    if (item.celvalue.length > 0) mvalue = item.celvalue

                    if (!mvalue.includes('%') && /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/.test(mvalue)) $(`#${item.cellid}`).val(parseFloat(mvalue).toLocaleString())
                    else $(`#${item.cellid}`).val(mvalue)
                    if (item.cellid.startsWith('proc1_') && mvalue != "" && !mvalue.endsWith('%')) {
                        $('#' + item.cellid).val(mvalue.replaceAll('%', '') + '%')
                    }
                    if ((item.cellid.startsWith('fin1_0') || item.cellid.startsWith('fin1_3') || item.cellid.startsWith('fin_vcb_1_0') ||
                        item.cellid.startsWith('fin_vcb_1_1')) && mvalue != "" && !mvalue.endsWith('%')) {
                        $('#' + item.cellid).val(mvalue.replaceAll('%', '') + '%')
                    }
                } catch (e) {

                }


            })
            loopinit()
        }
    })
    evpid = "fin1_2"
    evpvalue = $('#' + evpid).val()
    if (evpvalue != "") {
        for (let i = 0; i < financells; i++) {
            $(`#proc1_${i}`).prop('readonly', false)
        }
        for (let i = parseFloat(evpvalue); i < financells; i++) {
            $(`#proc1_${i}`).prop('readonly', true)
            $(`#proc1_${i}`).val('')
        }
        clearInterval(procinterval)
        procinterval = setInterval(() => {
            blinking()
        }, 1000)
    }
    setTimeout(inittab, 500
    )
})

function inittab() {
    if ($(`#celleas_dollar`).val() != '') {
        $(`#celleas_dollar`).val(parseFloat($(`#celleas_dollar`).val().replaceAll(',', '')) + 1000)
        loopinit()
        $(`#celleas_dollar`).val((parseFloat($(`#celleas_dollar`).val().replaceAll(',', '')) - 1000).toLocaleString())
        loopinit()
    }
}

function loopinit() {
    let k = 0
    $(`#celleas_22_2`).val('')
    while ((k < iteration && (isNaN($(`#celleas_22_2`).val()) || $(`#celleas_22_2`).val() == '' ||
        Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))))
        >= Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    )) && Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
        //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
        //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
        $(`#celleas_22_2`).val(Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
        $(`#cellfincashcum1_${financells - 2}`).html($(`#celleas_22_2`).val())
        allProcessing()
        k++
    }
    let kk = 0
    $(`#celleas_22_5`).val('')
    while ((kk < iteration && (isNaN($(`#celleas_22_5`).val()) || $(`#celleas_22_5`).val() == '' ||
        Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
        >= Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    )) && Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
        $(`#celleas_22_5`).val(Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
        $(`#cellfin_forcashcum1_${financells - 2}`).html($(`#celleas_22_5`).val())
        allProcessing()
        kk++
    }
    let kkk = 0
    $(`#celleas_22_8`).val('')
    while ((kkk < iteration && (isNaN($(`#celleas_22_8`).val()) || $(`#celleas_22_8`).val() == '' ||
        Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
        >= Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    )) && Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
        //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
        //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
        $(`#celleas_22_8`).val(Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
        $(`#cellfin_vcbcashcum1_${financells - 2}`).html($(`#celleas_22_8`).val())
        allProcessing()
        kkk++
    }

    $(`#cellfin_vcbcashcum1_${financells - 1}`).html("Epochs")
    $(`#cellfin_vcbcashcum2_${financells - 1}`).html((k).toLocaleString())
    $(`#cellfincashcum1_${financells - 1}`).html("Epochs")
    $(`#cellfincashcum2_${financells - 1}`).html((k).toLocaleString())
    $(`#cellfin_forcashcum1_${financells - 1}`).html("Epochs")
    $(`#cellfin_forcashcum2_${financells - 1}`).html((kk).toLocaleString())
    try {
        let mdollar=Math.round(isNaN(parseFloat($(`#celleas_dollar`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_dollar`).val().replaceAll(',', '')))
        $(`td[id^="celleas_rowsum_"]`).each(async function (k, l) {
            let ymp = l.id.split("_")[2]
            let rowsum = 0.0
            for (let kl = 2; kl <= 11; kl += 3) {
                if (kl != 5)
                    rowsum += Math.round(isNaN(parseFloat($(`#celleas_${ymp}_${kl}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_${ymp}_${kl}`).val().replaceAll(',', '')))
                else
                    rowsum += Math.round(isNaN(parseFloat($(`#celleas_${ymp}_${kl}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_${ymp}_${kl}`).val().replaceAll(',', ''))*mdollar)
            }
            $(`#${l.id}`).html(rowsum.toLocaleString())
        })
    } catch (e) {

    }
}

$(`textarea[id^=ps_]`).on('change', async (item) => {
    await $.ajax({
        url: url('detail/setparameter'),
        method: "POST",
        data: {
            mon_cod: $('#mon_cod_main').val(),
            parameter: item.target.id,
            pval: item.target.value
        }, dataType: "html"
    })
})
$(`textarea[id^=extra_data_]`).on('change', async (item) => {
    await $.ajax({
        url: url('detail/setparameter'),
        method: "POST",
        data: {
            mon_cod: $('#mon_cod_main').val(),
            parameter: item.target.id,
            pval: item.target.value
        }, dataType: "html"
    })
})
async function setYearlyP(tab, year) {
    Swal.fire({
        icon: 'question',
        html: '<div dir="auto">Are you sure for updating yearly initiale variables?</div>',
        reverseButtons: true,
        showCancelButton: true,
        showConfirmButton: true,
    }).then(async (result) => {
        if (result.isConfirmed) {
            $(`#${tab} textarea`).each(async function (cnt, l) {

                await $.ajax({
                    url: url('detail/setparametery'),
                    method: "POST",
                    data: {
                        year: year,
                        parameter: l.id,
                        pval: l.value
                    }, dataType: "html"
                })
            })
            await ToastPro('All variables has been reinitialized!', 'top', 'success', 0, 'ltr')
        }
    })
}

async function controlSheet(sheetC, mon_cod) {
    //alert(sheetC)
    if (sheetC == "controlSheet1") {
        //alert(2)
        for (let i = 1; i <= 6; i++) {
            if ($(`#pcs_${i}_1`).val() == '') {

                $(`#pcs_${i}_1`).css('background-color', 'red')
                setTimeout(() => {
                    $(`#pcs_${i}_1`).css('background-color', 'transparent')
                }, 2000)
                await ToastPro('Some inputs are blank!', 'center', 'success', 0, 'ltr')
                return
            }
            if ($(`#pcs_${i}_2`).val() == '') {
                $(`#pcs_${i}_2`).css('background-color', 'red')
                setTimeout(() => {
                    $(`#pcs_${i}_2`).css('background-color', 'transparent')
                }, 2000)
                await ToastPro('Some inputs are blank!', 'center', 'success', 0, 'ltr')
                return
            }
            if ($(`#pcs_${i}_4`).val() == '') {
                $(`#pcs_${i}_4`).css('background-color', 'red')
                setTimeout(() => {
                    $(`#pcs_${i}_4`).css('background-color', 'transparent')
                }, 2000)
                await ToastPro('Some inputs are blank!', 'center', 'success', 0, 'ltr')
                return
            }
        }
        for (let i = 1; i <= 3; i++) {
            if ($(`#pcl_${i}_2`).val() == '') {

                $(`#pcl_${i}_2`).css('background-color', 'red')
                setTimeout(() => {
                    $(`#pcl_${i}_2`).css('background-color', 'transparent')
                }, 2000)
                await ToastPro('Some inputs are blank!', 'center', 'success', 0, 'ltr')
                return
            }
            if ($(`#pcl_${i}_3`).val() == '') {

                $(`#pcl_${i}_3`).css('background-color', 'red')
                setTimeout(() => {
                    $(`#pcl_${i}_3`).css('background-color', 'transparent')
                }, 2000)
                await ToastPro('Some inputs are blank!', 'center', 'success', 0, 'ltr')
                return
            }

        }
        if ($(`#pclcc_1`).val() == '') {

            $(`#pclcc_1`).css('background-color', 'red')
            setTimeout(() => {
                $(`#pclcc_1`).css('background-color', 'transparent')
            }, 2000)
            await ToastPro('Some inputs are blank!', 'center', 'success', 0, 'ltr')
            return
        }
        if ($(`#pclcc_2`).val() == '') {

            $(`#pclcc_2`).css('background-color', 'red')
            setTimeout(() => {
                $(`#pclcc_2`).css('background-color', 'transparent')
            }, 2000)
            await ToastPro('Some inputs are blank!', 'center', 'success', 0, 'ltr')
            return
        }
        if ($(`#pclcc_4`).val() == '' || $(`#pclcc_4`).val() == '0') {

            $(`#pclcc_4`).css('background-color', 'red')
            setTimeout(() => {
                $(`#pclcc_4`).css('background-color', 'transparent')
            }, 2000)
            await ToastPro('Some inputs are blank!', 'center', 'success', 0, 'ltr')
            return
        }
    }
    if (sheetC == "controlSheet2") {
        if ($('#celleas_dollar').val() == "" || $('#celleas_17_3').val() == "" || $('#celleas_18_3').val() == "" || $('#celleas_20_3').val() == "" || $('#celleas_21_3').val() == ""
            || $('#celleas_28_3').val() == "" || $('#celleas_28_6').val() == "" || $('#celleas_28_9').val() == "" || $('#celleas_28_12').val() == "") {

            await ToastPro('Some inputs are blank!', 'center', 'success', 0, 'ltr')
            return
        }
    }
    if (sheetC == "controlSheet3") {
        if ($('#fin1_0').val() == "" || $('#fin1_1').val() == "" || $('#fin1_2').val() == "" || $('#fin1_3').val() == "" || $('#fin_vcb_1_1').val() == ""
            || $('#fin_vcb_1_2').val() == "" || $('#fin_for_1_0').val() == "" || $('#fin_for_1_1').val() == "" || $('#fin_for_1_2').val() == "") {

            await ToastPro('Some inputs are blank!', 'center', 'success', 0, 'ltr')
            return
        } else {
            for (let i = 0; i < $('#fin1_2').val(); i++) {
                if ($(`#proc1_${i}`).val() == '') {
                    $(`#proc1_${i}`).css('background-color', 'red')
                    setTimeout(() => {
                        $(`#proc1_${i}`).css('background-color', 'transparent')
                    }, 2000)
                    await ToastPro('Some inputs are blank!', 'center', 'success', 0, 'ltr')
                    return
                }
            }
        }
    }

    Swal.fire({
        icon: 'question',
        html: '<div dir="auto">Have you controlled all jobs?</div>',
        reverseButtons: true,
        showCancelButton: true,
        showConfirmButton: true,
    }).then(async (result) => {
        if (result.isConfirmed) {
            $(`#${sheetC}`).css('display', 'none')
            await $.ajax({
                url: url('detail/controlsheets'),
                method: "POST",
                data: {
                    mon_cod: mon_cod,
                    sheetC: sheetC
                }, dataType: "html"
            })
            allProcessing()
            await ToastPro('Control of this sheet has been done completely!', 'top', 'success', 0, 'ltr')
        }
    })
}

function setBackColor(tab) {
    if ($('#settings-styled-tab').hasClass("bg-gray-500")) {
        $('#settings-styled-tab').removeClass("bg-gray-500")
        $('#settings-styled-tab').addClass("bg-gray-100")
        $('#settings-styled-tab').removeClass("text-white")
        $('#settings-styled-tab').addClass("text-black")
    }
    if ($('#materials-styled-tab').hasClass("bg-gray-500")) {
        $('#materials-styled-tab').removeClass("bg-gray-500")
        $('#materials-styled-tab').addClass("bg-gray-100")
        $('#materials-styled-tab').removeClass("text-white")
        $('#materials-styled-tab').addClass("text-black")
    }
    if ($('#processing-styled-tab').hasClass("bg-gray-500")) {
        $('#processing-styled-tab').removeClass("bg-gray-500")
        $('#processing-styled-tab').addClass("bg-gray-100")
        $('#processing-styled-tab').removeClass("text-white")
        $('#processing-styled-tab').addClass("text-black")
    }
    if ($('#eas-styled-tab').hasClass("bg-gray-500")) {
        $('#eas-styled-tab').removeClass("bg-gray-500")
        $('#eas-styled-tab').addClass("bg-gray-100")
        $('#eas-styled-tab').removeClass("text-white")
        $('#eas-styled-tab').addClass("text-black")
    }
    if ($('#financial-styled-tab').hasClass("bg-gray-500")) {
        $('#financial-styled-tab').removeClass("bg-gray-500")
        $('#financial-styled-tab').addClass("bg-gray-100")
        $('#financial-styled-tab').removeClass("text-white")
        $('#financial-styled-tab').addClass("text-black")
    }
    switch (tab) {
        case 0:
            $('#settings-styled-tab').removeClass("bg-gray-100")
            $('#settings-styled-tab').addClass("bg-gray-500")
            $('#settings-styled-tab').addClass("text-white")
            $('#settings-styled-tab').removeClass("text-black")
            break
        case 1:
            $('#materials-styled-tab').removeClass("bg-gray-100")
            $('#materials-styled-tab').addClass("bg-gray-500")
            $('#materials-styled-tab').addClass("text-white")
            $('#materials-styled-tab').removeClass("text-black")
            break
        case 2:
            $('#processing-styled-tab').removeClass("bg-gray-100")
            $('#processing-styled-tab').addClass("bg-gray-500")
            $('#processing-styled-tab').addClass("text-white")
            $('#processing-styled-tab').removeClass("text-black")
            break
        case 3:
            $('#eas-styled-tab').removeClass("bg-gray-100")
            $('#eas-styled-tab').addClass("bg-gray-500")
            $('#eas-styled-tab').addClass("text-white")
            $('#eas-styled-tab').removeClass("text-black")
            break
        case 4:
            $('#financial-styled-tab').removeClass("bg-gray-100")
            $('#financial-styled-tab').addClass("bg-gray-500")
            $('#financial-styled-tab').addClass("text-white")
            $('#financial-styled-tab').removeClass("text-black")
            break
    }
}

$('textarea').on("keydown", function (e) {
    /* ENTER PRESSED*/
    // alert(e.which)
    if (e.keyCode == 13) {
        /* FOCUS ELEMENT */
        let inputs = $(this).parents().parent().eq(0).find("textarea");
        let idx = inputs.index(this);

        if (idx == inputs.length - 1) {
            inputs[0].select()
        } else {
            inputs[idx + 1].focus(); //  handles submit buttons
            inputs[idx + 1].select();
        }

        return false;
    } else if (e.ctrlKey && e.keyCode == 90) {
        if (ctrlz1.length > 0)
            try {
                $(`#${ctrlz1[ctrlz1.length - 1].id}`).val(ctrlz1[ctrlz1.length - 1].value)
                $.ajax({
                    url: url('detail/easpcs'),
                    method: "POST",
                    data: {
                        value: ctrlz1[ctrlz1.length - 1].value,
                        id: ctrlz1[ctrlz1.length - 1].id,
                        mon_cod: $('#mon_cod_main').val(),
                    },
                    dataType: "html"
                })
                $(`#${ctrlz1[ctrlz1.length - 1].id}`).css("background-color", "red")
                setTimeout(() => {
                    $(`#${ctrlz1[ctrlz1.length - 1].id}`).css("background-color", ctrlz1[ctrlz1.length - 1].color)
                    ctrlz1.pop()
                    // let k = 0
                    // $(`#celleas_22_2`).val('')
                    // while ((k < iteration && (isNaN($(`#celleas_22_2`).val()) || $(`#celleas_22_2`).val() == '' ||
                    //     Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))))
                    //     >= Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
                    // )) && Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
                    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
                    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
                    //     $(`#celleas_22_2`).val(Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
                    //     $(`#cellfincashcum1_${financells - 2}`).html($(`#celleas_22_2`).val())
                    //     allProcessing()
                    //     k++
                    // }
                    //
                    //
                    // let kk = 0
                    // $(`#celleas_22_5`).val('')
                    // while ((kk < iteration && (isNaN($(`#celleas_22_5`).val()) || $(`#celleas_22_5`).val() == '' ||
                    //     Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
                    //     >= Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
                    // )) && Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
                    //     $(`#celleas_22_5`).val(Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
                    //     $(`#cellfin_forcashcum1_${financells - 2}`).html($(`#celleas_22_5`).val())
                    //     allProcessing()
                    //     kk++
                    // }
                    // let kkk = 0
                    // $(`#celleas_22_8`).val('')
                    // while ((kkk < iteration && (isNaN($(`#celleas_22_8`).val()) || $(`#celleas_22_8`).val() == '' ||
                    //     Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
                    //     >= Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
                    // )) && Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
                    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
                    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
                    //     $(`#celleas_22_8`).val(Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
                    //     $(`#cellfin_vcbcashcum1_${financells - 2}`).html($(`#celleas_22_8`).val())
                    //     allProcessing()
                    //     kkk++
                    // }
                    //
                    // $(`#cellfin_vcbcashcum1_${financells - 1}`).html("Epochs")
                    // $(`#cellfin_vcbcashcum2_${financells - 1}`).html((k).toLocaleString())
                    // $(`#cellfincashcum1_${financells - 1}`).html("Epochs")
                    // $(`#cellfincashcum2_${financells - 1}`).html((k).toLocaleString())
                    // $(`#cellfin_forcashcum1_${financells - 1}`).html("Epochs")
                    // $(`#cellfin_forcashcum2_${financells - 1}`).html((kk).toLocaleString())
                    loopinit()
                }, 500)

            } catch (e) {

            }

    } else if (!e.ctrlKey) {
        try {
            if (ctrlz1.length == 0 || ctrlz1[ctrlz1.length - 1].id != e.target.id) {
                ctrlz1.push({
                    "id": e.target.id,
                    "value": e.target.value,
                    "color": $(`#${e.target.id}`).css('background-color')
                })
                // console.log(ctrlz1)
            }
        } catch (e) {

        }

    }

});

// function sumPIPFOR() {
//
// }

$('textarea[id^="cell_ai_"]').on('change', async (ev) => {
    if (!/^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/.test(ev.target.value)) {
        ev.target.value = '0';
        return
    }
    let key = ev.target.id.split('_')[2]

    if (parseFloat(ev.target.value.replaceAll(',', '')) > parseFloat($(`#pi_tp_${key}`).attr('aria-label').replaceAll(',', ''))) {
        ev.target.value = '0';
        $(`#pi_tp_${key}`).html($(`#pi_tp_${key}`).attr('aria-label'))
        sumPIPFOR()
        return
    }
    await $.ajax({
        url: url('detail/setpifor'),
        method: "POST",
        data: {
            value: ev.target.value,
            mon_cod: ev.target.ariaLabel.split('_')[0],
            mah_cod: ev.target.ariaLabel.split('_')[1],
        },
        dataType: "html"

    })
    $(`#pi_tp_${key}`).html(parseFloat($(`#pi_tp_${key}`).attr('aria-label')) - parseFloat(ev.target.value.replaceAll(',', '')))
    sumPIPFOR()
    // let k = 0
    // $(`#celleas_22_2`).val('')
    // while ((k < iteration && (isNaN($(`#celleas_22_2`).val()) || $(`#celleas_22_2`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_2`).val(Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfincashcum1_${financells - 2}`).html($(`#celleas_22_2`).val())
    //     allProcessing()
    //     k++
    // }
    //
    //
    // let kk = 0
    // $(`#celleas_22_5`).val('')
    // while ((kk < iteration && (isNaN($(`#celleas_22_5`).val()) || $(`#celleas_22_5`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     $(`#celleas_22_5`).val(Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_forcashcum1_${financells - 2}`).html($(`#celleas_22_5`).val())
    //     allProcessing()
    //     kk++
    // }
    // let kkk = 0
    // $(`#celleas_22_8`).val('')
    // while ((kkk < iteration && (isNaN($(`#celleas_22_8`).val()) || $(`#celleas_22_8`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_8`).val(Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_vcbcashcum1_${financells - 2}`).html($(`#celleas_22_8`).val())
    //     allProcessing()
    //     kkk++
    // }
    //
    // $(`#cellfin_vcbcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_vcbcashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfincashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfincashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfin_forcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_forcashcum2_${financells - 1}`).html((kk).toLocaleString())
    loopinit()
})

function sumPIPFOR() {
    let sumi = 0;
    let sumfor = 0;
    $('td[id^="pi_tp_"]').each(function (k, l) {

        sumi += parseFloat(l.innerText.replaceAll(',', ''))
    })
    $('textarea[id^="cell_ai_"]').each(function (k, l) {

        sumfor += parseFloat(l.value.replaceAll(',', ''))
    })
    $('#pi_tp').html(sumi.toLocaleString())
    $('#pfor_tp').html(sumfor.toLocaleString())
}

$('textarea').on("focus", function (e) {
    /* ENTER PRESSED*/
    // alert(e.which)

    /* FOCUS ELEMENT */
    let inputs = $(this).parents().parent().eq(0).find("textarea");
    let idx = inputs.index(this);
    if (/^\d+$/.test(inputs[idx].value.replaceAll(',', '').replaceAll('،', ''))) inputs[idx].value = inputs[idx].value.replaceAll(',', '').replaceAll('،', '')
    inputs[idx].select();

});
$('textarea').on("blur", function (e) {
    /* ENTER PRESSED*/
    // alert(e.which)

    /* FOCUS ELEMENT */
    let inputs = $(this).parents().parent().eq(0).find("textarea");
    let idx = inputs.index(this);
    //console.log(inputs[idx].value)
    try {
        if (/^\d+$/.test(inputs[idx].value)) inputs[idx].value = parseInt(inputs[idx].value).toLocaleString()
    } catch (e) {

    }
    if (e.target.id.startsWith('proc1_') && e.target.value != "" && !e.target.value.endsWith('%')) {
        $('#' + e.target.id).val(e.target.value.replaceAll('%', '') + '%')
    }
    if ((e.target.id.startsWith('fin1_0') || e.target.id.startsWith('fin1_3') || e.target.id.startsWith('fin_vcb_1_0') ||
        e.target.id.startsWith('fin_vcb_1_1')) && e.target.value != "" && !e.target.value.endsWith('%')) {
        $('#' + e.target.id).val(e.target.value.replaceAll('%', '') + '%')
    }
});
$('textarea[id^="pcs_"]').on('change', async (ev) => {
    if (!/^\d*[0-9](|.\d*[0-9]|,\d*[0-9]|\d*[0-9]%|)?$/.test(ev.target.value)) {
        ev.target.value = '0';
        return
    }
    await $.ajax({
        url: url('detail/easpcs'),
        method: "POST",
        data: {
            value: ev.target.value,
            id: ev.target.id,
            mon_cod: $('#mon_cod_main').val(),
        },
        dataType: "html"
    })
    if (1 == 1) {

        // let k = 0
        // $(`#celleas_22_2`).val('')
        // while ((k < iteration && (isNaN($(`#celleas_22_2`).val()) || $(`#celleas_22_2`).val() == '' ||
        //     Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))))
        //     >= Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
        // )) && Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
        //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
        //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
        //     $(`#celleas_22_2`).val(Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
        //     $(`#cellfincashcum1_${financells - 2}`).html($(`#celleas_22_2`).val())
        //     allProcessing()
        //     k++
        // }
        //
        //
        // let kk = 0
        // $(`#celleas_22_5`).val('')
        // while ((kk < iteration && (isNaN($(`#celleas_22_5`).val()) || $(`#celleas_22_5`).val() == '' ||
        //     Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
        //     >= Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
        // )) && Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
        //     $(`#celleas_22_5`).val(Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
        //     $(`#cellfin_forcashcum1_${financells - 2}`).html($(`#celleas_22_5`).val())
        //     allProcessing()
        //     kk++
        // }
        // let kkk = 0
        // $(`#celleas_22_8`).val('')
        // while ((kkk < iteration && (isNaN($(`#celleas_22_8`).val()) || $(`#celleas_22_8`).val() == '' ||
        //     Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
        //     >= Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
        // )) && Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
        //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
        //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
        //     $(`#celleas_22_8`).val(Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
        //     $(`#cellfin_vcbcashcum1_${financells - 2}`).html($(`#celleas_22_8`).val())
        //     allProcessing()
        //     kkk++
        // }
        //
        // $(`#cellfin_vcbcashcum1_${financells - 1}`).html("Epochs")
        // $(`#cellfin_vcbcashcum2_${financells - 1}`).html((k).toLocaleString())
        // $(`#cellfincashcum1_${financells - 1}`).html("Epochs")
        // $(`#cellfincashcum2_${financells - 1}`).html((k).toLocaleString())
        // $(`#cellfin_forcashcum1_${financells - 1}`).html("Epochs")
        // $(`#cellfin_forcashcum2_${financells - 1}`).html((kk).toLocaleString())
        loopinit()
    }
})
$('textarea[id^="pcw-lts"]').on('change', async (ev) => {
    if (!/^\d*[0-9](|.\d*[0-9]|,\d*[0-9]|)?$/.test(ev.target.value)) {
        ev.target.value = '0';
        return
    }
    await $.ajax({
        url: url('detail/easpcs'),
        method: "POST",
        data: {
            value: ev.target.value,
            id: ev.target.id,
            mon_cod: $('#mon_cod_main').val(),
        },
        dataType: "html"
    })
    // let k = 0
    // $(`#celleas_22_2`).val('')
    // while ((k < iteration && (isNaN($(`#celleas_22_2`).val()) || $(`#celleas_22_2`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_2`).val(Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfincashcum1_${financells - 2}`).html($(`#celleas_22_2`).val())
    //     allProcessing()
    //     k++
    // }
    //
    //
    // let kk = 0
    // $(`#celleas_22_5`).val('')
    // while ((kk < iteration && (isNaN($(`#celleas_22_5`).val()) || $(`#celleas_22_5`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     $(`#celleas_22_5`).val(Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_forcashcum1_${financells - 2}`).html($(`#celleas_22_5`).val())
    //     allProcessing()
    //     kk++
    // }
    // let kkk = 0
    // $(`#celleas_22_8`).val('')
    // while ((kkk < iteration && (isNaN($(`#celleas_22_8`).val()) || $(`#celleas_22_8`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_8`).val(Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_vcbcashcum1_${financells - 2}`).html($(`#celleas_22_8`).val())
    //     allProcessing()
    //     kkk++
    // }
    //
    // $(`#cellfin_vcbcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_vcbcashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfincashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfincashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfin_forcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_forcashcum2_${financells - 1}`).html((kk).toLocaleString())
    loopinit()
})
$('textarea[id^="pcl-"]').on('change', async (ev) => {
    if (!/^\d*[0-9](|.\d*[0-9]|,\d*[0-9]|\d*[0-9]%|)?$/.test(ev.target.value)) {
        ev.target.value = '0';
        return
    }
    await $.ajax({
        url: url('detail/easpcs'),
        method: "POST",
        data: {
            value: ev.target.value,
            id: ev.target.id,
            mon_cod: $('#mon_cod_main').val(),
        },
        dataType: "html"
    })

    // let k = 0
    // $(`#celleas_22_2`).val('')
    // while ((k < iteration && (isNaN($(`#celleas_22_2`).val()) || $(`#celleas_22_2`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_2`).val(Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfincashcum1_${financells - 2}`).html($(`#celleas_22_2`).val())
    //     allProcessing()
    //     k++
    // }
    //
    //
    // let kk = 0
    // $(`#celleas_22_5`).val('')
    // while ((kk < iteration && (isNaN($(`#celleas_22_5`).val()) || $(`#celleas_22_5`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     $(`#celleas_22_5`).val(Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_forcashcum1_${financells - 2}`).html($(`#celleas_22_5`).val())
    //     allProcessing()
    //     kk++
    // }
    // let kkk = 0
    // $(`#celleas_22_8`).val('')
    // while ((kkk < iteration && (isNaN($(`#celleas_22_8`).val()) || $(`#celleas_22_8`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_8`).val(Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_vcbcashcum1_${financells - 2}`).html($(`#celleas_22_8`).val())
    //     allProcessing()
    //     kkk++
    // }
    //
    // $(`#cellfin_vcbcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_vcbcashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfincashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfincashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfin_forcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_forcashcum2_${financells - 1}`).html((kk).toLocaleString())
    loopinit()
})
$('textarea[id^="pclcc-"]').on('change', async (ev) => {
    if (!/^\d*[0-9](|.\d*[0-9]|,\d*[0-9]|\d*[0-9]%|)?$/.test(ev.target.value)) {
        ev.target.value = '0';
        return
    }
    await $.ajax({
        url: url('detail/easpcs'),
        method: "POST",
        data: {
            value: ev.target.value,
            id: ev.target.id,
            mon_cod: $('#mon_cod_main').val(),
        },
        dataType: "html"
    })

    // let k = 0
    // $(`#celleas_22_2`).val('')
    // while ((k < iteration && (isNaN($(`#celleas_22_2`).val()) || $(`#celleas_22_2`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_2`).val(Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfincashcum1_${financells - 2}`).html($(`#celleas_22_2`).val())
    //     allProcessing()
    //     k++
    // }
    //
    //
    // let kk = 0
    // $(`#celleas_22_5`).val('')
    // while ((kk < iteration && (isNaN($(`#celleas_22_5`).val()) || $(`#celleas_22_5`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     $(`#celleas_22_5`).val(Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_forcashcum1_${financells - 2}`).html($(`#celleas_22_5`).val())
    //     allProcessing()
    //     kk++
    // }
    // let kkk = 0
    // $(`#celleas_22_8`).val('')
    // while ((kkk < iteration && (isNaN($(`#celleas_22_8`).val()) || $(`#celleas_22_8`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_8`).val(Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_vcbcashcum1_${financells - 2}`).html($(`#celleas_22_8`).val())
    //     allProcessing()
    //     kkk++
    // }
    //
    // $(`#cellfin_vcbcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_vcbcashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfincashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfincashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfin_forcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_forcashcum2_${financells - 1}`).html((kk).toLocaleString())
    loopinit()

})
$('textarea[id^="celleas_"]').on('change', async (ev) => {
    //alert(ev.target.value)
    // if (!/^\d*[0-9](|.\d*[0-9]|,\d*[0-9]|\d*[0-9]%|)?$/.test(ev.target.value)) {
    //     ev.target.value = '0';
    //     return
    // }
    await $.ajax({
        url: url('detail/easpcs'),
        method: "POST",
        data: {
            value: ev.target.value,
            id: ev.target.id,
            mon_cod: $('#mon_cod_main').val(),
        },
        dataType: "html"
    })

    // let k = 0
    // $(`#celleas_22_2`).val('')
    // while ((k < iteration && (isNaN($(`#celleas_22_2`).val()) || $(`#celleas_22_2`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_2`).val(Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfincashcum1_${financells - 2}`).html($(`#celleas_22_2`).val())
    //     allProcessing()
    //     k++
    // }
    //
    //
    // let kk = 0
    // $(`#celleas_22_5`).val('')
    // while ((kk < iteration && (isNaN($(`#celleas_22_5`).val()) || $(`#celleas_22_5`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     $(`#celleas_22_5`).val(Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_forcashcum1_${financells - 2}`).html($(`#celleas_22_5`).val())
    //     allProcessing()
    //     kk++
    // }
    // let kkk = 0
    // $(`#celleas_22_8`).val('')
    // while ((kkk < iteration && (isNaN($(`#celleas_22_8`).val()) || $(`#celleas_22_8`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_8`).val(Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_vcbcashcum1_${financells - 2}`).html($(`#celleas_22_8`).val())
    //     allProcessing()
    //     kkk++
    // }
    //
    // $(`#cellfin_vcbcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_vcbcashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfincashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfincashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfin_forcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_forcashcum2_${financells - 1}`).html((kk).toLocaleString())
    loopinit()
})

function blinking() {
    let summ = 0;
    for (let i = 0; i < parseFloat(evpvalue); i++) {
        if ($(`#proc1_${i}`).val() == "") {
            //console.log($(`#proc1_${i}`).css("background-color"))
            if ($(`#proc1_${i}`).css("background-color") == "red" || $(`#proc1_${i}`).css("background-color") == "rgb(255, 0, 0)") {
                $(`#proc1_${i}`).css("background-color", "transparent")
            } else {
                $(`#proc1_${i}`).css("background-color", "red")
            }
        } else {
            if ($(`#proc1_${i}`).css("background-color") == "red" || $(`#proc1_${i}`).css("background-color") == "rgb(255, 0, 0)") {
                $(`#proc1_${i}`).css("background-color", "transparent")

            }
            summ += parseFloat($(`#proc1_${i}`).val().replaceAll('%', ''))
        }
    }
    //   console.log(summ)
    if (summ != 100) {
        if ($('#Procurement').hasClass('bg-green-200')) {
            $('#Procurement').removeClass('bg-green-200')
            $('#Procurement').addClass('bg-red-200')
        } else if ($('#Procurement').hasClass('bg-red-200')) {
            $('#Procurement').removeClass('bg-red-200')
            $('#Procurement').addClass('bg-green-200')
        }
    } else {
        if ($('#Procurement').hasClass('bg-red-200')) {
            $('#Procurement').removeClass('bg-red-200')
            $('#Procurement').addClass('bg-green-200')
        }
    }
}

$('textarea[id^="fin1_"]').on('change', async (ev) => {
    //alert(ev.target.value)
    // if (!/^\d*[0-9](|.\d*[0-9]|,\d*[0-9]|\d*[0-9]%|)?$/.test(ev.target.value)) {
    //     ev.target.value = '0';
    //     return
    // }
    if (ev.target.id == "fin1_2") {
        evpid = ev.target.id
        evpvalue = ev.target.value
        for (let i = 0; i < financells; i++) {
            $(`#proc1_${i}`).prop('readonly', false)
        }
        for (let i = parseFloat(evpvalue); i < financells; i++) {
            $(`#proc1_${i}`).prop('readonly', true)
            $(`#proc1_${i}`).val('')
            await $.ajax({
                url: url('detail/easpcs'),
                method: "POST",
                data: {
                    value: $(`#proc1_${i}`).val(),
                    id: 'proc1_' + i,
                    mon_cod: $('#mon_cod_main').val(),
                },
                dataType: "html"
            })
            $(`#proc1_${i}`).css('background-color', 'transparent')
        }
        clearInterval(procinterval)
        procinterval = setInterval(() => {
            blinking()
        }, 1000)
    }
    await $.ajax({
        url: url('detail/easpcs'),
        method: "POST",
        data: {
            value: ev.target.value,
            id: ev.target.id,
            mon_cod: $('#mon_cod_main').val(),
        },
        dataType: "html"
    })
    // let k = 0
    // $(`#celleas_22_2`).val('')
    // while ((k < iteration && (isNaN($(`#celleas_22_2`).val()) || $(`#celleas_22_2`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_2`).val(Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfincashcum1_${financells - 2}`).html($(`#celleas_22_2`).val())
    //     allProcessing()
    //     k++
    // }
    //
    //
    // let kk = 0
    // $(`#celleas_22_5`).val('')
    // while ((kk < iteration && (isNaN($(`#celleas_22_5`).val()) || $(`#celleas_22_5`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     $(`#celleas_22_5`).val(Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_forcashcum1_${financells - 2}`).html($(`#celleas_22_5`).val())
    //     allProcessing()
    //     kk++
    // }
    // let kkk = 0
    // $(`#celleas_22_8`).val('')
    // while ((kkk < iteration && (isNaN($(`#celleas_22_8`).val()) || $(`#celleas_22_8`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_8`).val(Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_vcbcashcum1_${financells - 2}`).html($(`#celleas_22_8`).val())
    //     allProcessing()
    //     kkk++
    // }
    //
    // $(`#cellfin_vcbcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_vcbcashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfincashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfincashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfin_forcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_forcashcum2_${financells - 1}`).html((kk).toLocaleString())
    loopinit()
})
$('textarea[id^="proc1_"]').on('change', async (ev) => {
    //alert(ev.target.value)
    // if (!/^\d*[0-9](|.\d*[0-9]|,\d*[0-9]|\d*[0-9]%|)?$/.test(ev.target.value)) {
    //     ev.target.value = '0';
    //     return
    // }
    await $.ajax({
        url: url('detail/easpcs'),
        method: "POST",
        data: {
            value: ev.target.value,
            id: ev.target.id,
            mon_cod: $('#mon_cod_main').val(),
        },
        dataType: "html"
    })
    // let k = 0
    // $(`#celleas_22_2`).val('')
    // while ((k < iteration && (isNaN($(`#celleas_22_2`).val()) || $(`#celleas_22_2`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_2`).val(Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfincashcum1_${financells - 2}`).html($(`#celleas_22_2`).val())
    //     allProcessing()
    //     k++
    // }
    //
    //
    // let kk = 0
    // $(`#celleas_22_5`).val('')
    // while ((kk < iteration && (isNaN($(`#celleas_22_5`).val()) || $(`#celleas_22_5`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     $(`#celleas_22_5`).val(Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_forcashcum1_${financells - 2}`).html($(`#celleas_22_5`).val())
    //     allProcessing()
    //     kk++
    // }
    // let kkk = 0
    // $(`#celleas_22_8`).val('')
    // while ((kkk < iteration && (isNaN($(`#celleas_22_8`).val()) || $(`#celleas_22_8`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_8`).val(Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_vcbcashcum1_${financells - 2}`).html($(`#celleas_22_8`).val())
    //     allProcessing()
    //     kkk++
    // }
    //
    // $(`#cellfin_vcbcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_vcbcashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfincashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfincashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfin_forcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_forcashcum2_${financells - 1}`).html((kk).toLocaleString())
    loopinit()
})
$('textarea[id^="fin_for_"]').on('change', async (ev) => {
    //alert(ev.target.value)
    // if (!/^\d*[0-9](|.\d*[0-9]|,\d*[0-9]|\d*[0-9]%|)?$/.test(ev.target.value)) {
    //     ev.target.value = '0';
    //     return
    // }
    await $.ajax({
        url: url('detail/easpcs'),
        method: "POST",
        data: {
            value: ev.target.value,
            id: ev.target.id,
            mon_cod: $('#mon_cod_main').val(),
        },
        dataType: "html"
    })

    // let k = 0
    // $(`#celleas_22_2`).val('')
    // while ((k < iteration && (isNaN($(`#celleas_22_2`).val()) || $(`#celleas_22_2`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_2`).val(Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfincashcum1_${financells - 2}`).html($(`#celleas_22_2`).val())
    //     allProcessing()
    //     k++
    // }
    //
    //
    // let kk = 0
    // $(`#celleas_22_5`).val('')
    // while ((kk < iteration && (isNaN($(`#celleas_22_5`).val()) || $(`#celleas_22_5`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     $(`#celleas_22_5`).val(Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_forcashcum1_${financells - 2}`).html($(`#celleas_22_5`).val())
    //     allProcessing()
    //     kk++
    // }
    // let kkk = 0
    // $(`#celleas_22_8`).val('')
    // while ((kkk < iteration && (isNaN($(`#celleas_22_8`).val()) || $(`#celleas_22_8`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_8`).val(Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_vcbcashcum1_${financells - 2}`).html($(`#celleas_22_8`).val())
    //     allProcessing()
    //     kkk++
    // }
    //
    // $(`#cellfin_vcbcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_vcbcashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfincashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfincashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfin_forcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_forcashcum2_${financells - 1}`).html((kk).toLocaleString())
    loopinit()
})
$('textarea[id^="fin_vcb_"]').on('change', async (ev) => {
    //alert(ev.target.value)
    // if (!/^\d*[0-9](|.\d*[0-9]|,\d*[0-9]|\d*[0-9]%|)?$/.test(ev.target.value)) {
    //     ev.target.value = '0';
    //     return
    // }
    await $.ajax({
        url: url('detail/easpcs'),
        method: "POST",
        data: {
            value: ev.target.value,
            id: ev.target.id,
            mon_cod: $('#mon_cod_main').val(),
        },
        dataType: "html"
    })

    // let k = 0
    // $(`#celleas_22_2`).val('')
    // while ((k < iteration && (isNaN($(`#celleas_22_2`).val()) || $(`#celleas_22_2`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_2`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_2`).val(Math.abs(parseFloat($(`#cellfincashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfincashcum1_${financells - 2}`).html($(`#celleas_22_2`).val())
    //     allProcessing()
    //     k++
    // }
    //
    //
    // let kk = 0
    // $(`#celleas_22_5`).val('')
    // while ((kk < iteration && (isNaN($(`#celleas_22_5`).val()) || $(`#celleas_22_5`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_5`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     $(`#celleas_22_5`).val(Math.abs(parseFloat($(`#cellfin_forcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_forcashcum1_${financells - 2}`).html($(`#celleas_22_5`).val())
    //     allProcessing()
    //     kk++
    // }
    // let kkk = 0
    // $(`#celleas_22_8`).val('')
    // while ((kkk < iteration && (isNaN($(`#celleas_22_8`).val()) || $(`#celleas_22_8`).val() == '' ||
    //     Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))))
    //     >= Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))) / precisionm
    // )) && Math.abs(parseFloat($(`#celleas_22_8`).val().replaceAll(',', '')) - Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', '')))) != 0) {
    //     //alert(parseFloat($(`#celleas_22_2`).val().replaceAll(',',''))-Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))))
    //     //alert(Math.abs(parseFloat($(`#cellfincashcum2_${financells-2}`).html().replaceAll(',',''))).toLocaleString())
    //     $(`#celleas_22_8`).val(Math.abs(parseFloat($(`#cellfin_vcbcashcum2_${financells - 2}`).html().replaceAll(',', ''))).toLocaleString())
    //     $(`#cellfin_vcbcashcum1_${financells - 2}`).html($(`#celleas_22_8`).val())
    //     allProcessing()
    //     kkk++
    // }
    //
    // $(`#cellfin_vcbcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_vcbcashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfincashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfincashcum2_${financells - 1}`).html((k).toLocaleString())
    // $(`#cellfin_forcashcum1_${financells - 1}`).html("Epochs")
    // $(`#cellfin_forcashcum2_${financells - 1}`).html((kk).toLocaleString())
    loopinit()
})

function allProcessing() {

    let sumcoff = 0;
    /////first_processing    PC Staff
    for (let i = 1; i <= 7; i++) {
        if ($(`#pcs_${i}_1`).val() != '' && $(`#pcs_${i}_2`).val() != '' && $(`#pcs_b`).val() != '' && $(`#pcs_b`).val() != '0') {
            $(`#pcs_${i}_3`).html((parseFloat($(`#pcs_${i}_1`).val().replaceAll(',', '')) * parseFloat($(`#pcs_${i}_2`).val().replaceAll(',', '')) * 176 * 12).toLocaleString())
            if ($(`#pcs_${i}_4`).val() != '') {
                $(`#pcs_${i}_5`).html((parseFloat($(`#pcs_${i}_3`).html().replaceAll(',', '')) * (1 + parseFloat($(`#pcs_${i}_4`).val().replaceAll('%', '')) / 100)).toLocaleString())
                $(`#pcs_${i}_6`).html(Math.round(10000 * parseFloat($(`#pcs_${i}_5`).html().replaceAll(',', '')) / parseFloat($(`#pcs_b`).val().replaceAll(',', ''))) / 100 + '%')
                sumcoff += Math.round(10000 * parseFloat($(`#pcs_${i}_5`).html().replaceAll(',', '')) / parseFloat($(`#pcs_b`).val().replaceAll(',', ''))) / 100
            }
        }
        $('#pcs_sum').html(String(Math.round(100 * sumcoff) / 100) + '%')
    }
    /////second_processing PC Work
    let pcswtot1 = 0;
    $(`td[id^="pcw-lts-1-"]`).each(function (k, l) {
        pcswtot1 += parseFloat(l.innerText)
    })
    $('#pcw-sum1').html(pcswtot1.toLocaleString())
    for (let j = 2; j < 8; j++) {
        let pcswtot2 = 0;
        let cnt = 1
        $(`textarea[id^="pcw-lts-${j}-"]`).each(function (k, l) {
            let tmp = l.id.split('-')[3]
            if (l.value != '') {
                pcswtot2 += parseFloat(l.value.replace(',', '')) * parseFloat($('#pcw-lts-1-' + tmp).html().replaceAll(',', ''))
            }
        })
        $(`#pcw-sum${j}`).html(pcswtot2.toLocaleString())
    }
    try {
        $('#pcl-1-1').html((parseFloat($('#pcw-sum2').html().replaceAll(',', '')) + parseFloat($('#pcw-sum3').html().replaceAll(',', ''))).toLocaleString())
    } catch (e) {

    }
    try {
        $('#pcl-2-1').html(parseFloat($('#pcw-sum4').html().replaceAll(',', '')).toLocaleString())
    } catch (e) {

    }
    try {
        $('#pcl-3-1').html((parseFloat($('#pcw-sum5').html().replaceAll(',', '')) + parseFloat($('#pcw-sum6').html().replaceAll(',', '')) + parseFloat($('#pcw-sum7').html().replaceAll(',', ''))).toLocaleString())
    } catch (e) {

    }
    ////third_processing Line
    sumcoff = 0;
    /////first_processing    PC Staff
    for (let i = 1; i <= 3; i++) {
        if ($(`#pcl-${i}-2`).val() != '' && $(`#pcl-${i}-3`).val() != '' && $(`#pcs_b`).val() != '' && $(`#pcs_b`).val() != '0') {
            $(`#pcl-${i}-4`).html(Math.round((parseFloat($(`#pcl-${i}-1`).html().replaceAll(',', '')) * parseFloat($(`#pcl-${i}-2`).val().replaceAll(',', '')) *
                (1 + parseFloat($(`#pcl-${i}-3`).val().replaceAll('%', '')) / 100))).toLocaleString())
            sumcoff += parseFloat($(`#pcl-${i}-4`).html().replaceAll(',', ''))


        }
        $('#pcl-sum').html(sumcoff.toLocaleString())
    }
    /////init cross check
    if ($(`#pclcc-1`).val() != '' && $(`#pclcc-2`).val() != '' && $(`#pcs_b`).val() != '' && $(`#pcs_b`).val() != '0') {
        $(`#pclcc-3`).html((parseFloat($(`#pclcc-1`).val().replaceAll(',', '')) * parseFloat($(`#pclcc-2`).val().replaceAll(',', '')) * 176 * 12).toLocaleString())
        if ($(`#pclcc-4`).val() != '') {
            $(`#pclcc-5`).html(Math.round(parseFloat($(`#pclcc-3`).html().replaceAll(',', '')) *
                (1 + parseFloat($(`#pclcc-4`).val().replaceAll('%', '')) / 100)).toLocaleString())
        }
    }
    /////before eas
    //mat pro init

    $('#celleas_10_2').val(Math.round((parseFloat($('#pr_tp').html().replaceAll(',', '') == '' ? 0 : $('#pr_tp').html().replaceAll(',', '')) +
        (parseFloat($('#pi_tp').html().replaceAll(',', '') == '' ? 0 : $('#pi_tp').html().replaceAll(',', '')) * parseFloat($(`#celleas_dollar`).val().replaceAll(',', '')))) / 1000).toLocaleString())
    $('#celleas_10_5').val((Math.round(100 * parseFloat($('#pfor_tp').html().replaceAll(',', '') == '' ? 0 : $('#pfor_tp').html().replaceAll(',', ''))) / 100000).toLocaleString())
    $('#celleas_10_8').val((Math.round(parseFloat($('#vcb_panir').html().replaceAll(',', '') == '' ? 0 : $('#vcb_panir').html().replaceAll(',', '')) / 1000)).toLocaleString())
    if (!$('#celleas_10_2').hasClass('bg-yellow-200')) {
        $('#celleas_10_2').removeClass('bg-transparent')
        $('#celleas_10_2').addClass('bg-yellow-200')
    }
    if (!$('#celleas_10_5').hasClass('bg-yellow-200')) {
        $('#celleas_10_5').removeClass('bg-transparent')
        $('#celleas_10_5').addClass('bg-yellow-200')
    }
    if (!$('#celleas_10_8').hasClass('bg-yellow-200')) {
        $('#celleas_10_8').removeClass('bg-transparent')
        $('#celleas_10_8').addClass('bg-yellow-200')
    }
    if (!$('#celleas_34_2').hasClass('bg-yellow-200')) {
        $('#celleas_34_2').removeClass('bg-transparent')
        $('#celleas_34_2').addClass('bg-yellow-200')
    }
    if (!$('#celleas_34_5').hasClass('bg-yellow-200')) {
        $('#celleas_34_5').removeClass('bg-transparent')
        $('#celleas_34_5').addClass('bg-yellow-200')
    }
    if (!$('#celleas_34_8').hasClass('bg-yellow-200')) {
        $('#celleas_34_8').removeClass('bg-transparent')
        $('#celleas_34_8').addClass('bg-yellow-200')
    }
    if (!$('#celleas_34_11').hasClass('bg-yellow-200')) {
        $('#celleas_34_11').removeClass('bg-transparent')
        $('#celleas_34_11').addClass('bg-yellow-200')
    }
    $('#celleas_6_2').val($('#pcl-sum').html())
    for (let i = 0; i < 6; i++) {
        $(`#celleas_${i}_3`).val($(`#pcs_${i + 1}_6`).html())
        $(`#celleas_${i}_6`).val($(`#pcs_${i + 1}_6`).html())
        $(`#celleas_${i}_9`).val($(`#pcs_${i + 1}_6`).html())
    }
    $(`#celleas_7_3`).val($(`#pcs_7_6`).html() ?? 0)
    $(`#celleas_7_6`).val($(`#pcs_7_6`).html() ?? 0)
    $(`#celleas_7_9`).val($(`#pcs_7_6`).html() ?? 0)
    for (let i = 2; i <= 11; i += 3) {
        let ss = 0
        let ssf = 0
        ss += isNaN(parseFloat($(`#celleas_6_${i}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_6_${i}`).val().replaceAll(',', ''))
        ss += isNaN(parseFloat($(`#celleas_8_${i}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_8_${i}`).val().replaceAll(',', ''))
        ss += isNaN(parseFloat($(`#celleas_10_${i}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_10_${i}`).val().replaceAll(',', ''))
        ss += isNaN(parseFloat($(`#celleas_22_${i}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_22_${i}`).val().replaceAll(',', ''))
        // alert(ss)
        for (let j = 0; j <= 28; j++) {
            if (j != 6 && j != 22 && j != 26 && (j < 8 || j > 16))
                ssf += isNaN(parseFloat($(`#celleas_${j}_${i + 1}`).val().replaceAll('%', '')) / 100) ? 0 : parseFloat($(`#celleas_${j}_${i + 1}`).val().replaceAll('%', '')) / 100
        }
        //alert(ssf)
        if (i != 5) $(`#celleas_30_${i}`).val(Math.round(ss / (1 - ssf)).toLocaleString())
        else $(`#celleas_30_${i}`).val((Math.round(1000 * ss / (1 - ssf)) / 1000).toLocaleString())
    }
    if (!$('#celleas_28_3').hasClass('bg-yellow-200')) {
        $('#celleas_28_3').removeClass('bg-transparent')
        $('#celleas_28_3').addClass('bg-yellow-200')
    }
    if (!$('#celleas_28_6').hasClass('bg-yellow-200')) {
        $('#celleas_28_6').removeClass('bg-transparent')
        $('#celleas_28_6').addClass('bg-yellow-200')
    }
    if (!$('#celleas_28_9').hasClass('bg-yellow-200')) {
        $('#celleas_28_9').removeClass('bg-transparent')
        $('#celleas_28_9').addClass('bg-yellow-200')
    }
    if (!$('#celleas_28_12').hasClass('bg-yellow-200')) {
        $('#celleas_28_12').removeClass('bg-transparent')
        $('#celleas_28_12').addClass('bg-yellow-200')
    }

    ////////fill eas step 1

    for (let i = 2; i <= 11; i += 3) {
        let ssf = ''

        ssf = isNaN(parseFloat($(`#celleas_30_${i}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_30_${i}`).val().replaceAll(',', ''))

        // ss+=isNaN(parseFloat($(`#celleas_8_${i}`).val().replaceAll(',','')))?0:parseFloat($(`#celleas_8_${i}`).val().replaceAll(',',''))
        // ss+=isNaN(parseFloat($(`#celleas_10_${i}`).val().replaceAll(',','')))?0:parseFloat($(`#celleas_10_${i}`).val().replaceAll(',',''))
        // ss+=isNaN(parseFloat($(`#celleas_22_${i}`).val().replaceAll(',','')))?0:parseFloat($(`#celleas_22_${i}`).val().replaceAll(',',''))
        for (let j = 0; j <= 28; j++) {
            let ss

            ss = isNaN(parseFloat($(`#celleas_${j}_${i + 1}`).val().replaceAll('%', ''))) ? 0 : parseFloat($(`#celleas_${j}_${i + 1}`).val().replaceAll('%', ''))

            if (ss > 0.0) {
                if (i != 5) $(`#celleas_${j}_${i}`).val(Math.round(ssf * ss / 100.0).toLocaleString())
                else $(`#celleas_${j}_${i}`).val((Math.round(1000 * (ssf * ss / 100.0)) / 1000).toLocaleString())
            } else if (ss == 0 && (j < 6 || j == 7 || j == 11 || (j >= 17 && j <= 21) || (j <= 25 && j >= 23) || j == 28)) {
                $(`#celleas_${j}_${i}`).val('')
                $(`#celleas_${j}_${i}`).val('')
            }
        }

    }

    let sum92 = 0;
    let sum95 = 0;
    let sum98 = 0;
    let sum911 = 0;
    for (let i = 0; i < 9; i++) {
        sum92 += isNaN(parseFloat($(`#celleas_${i}_2`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_${i}_2`).val().replaceAll(',', ''))
        sum95 += isNaN(parseFloat($(`#celleas_${i}_5`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_${i}_5`).val().replaceAll(',', ''))
        sum98 += isNaN(parseFloat($(`#celleas_${i}_8`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_${i}_8`).val().replaceAll(',', ''))
        sum911 += isNaN(parseFloat($(`#celleas_${i}_11`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_${i}_11`).val().replaceAll(',', ''))
    }
    $(`#celleas_9_2`).val(sum92.toLocaleString())
    $(`#celleas_9_5`).val(sum95.toLocaleString())
    $(`#celleas_9_8`).val(sum98.toLocaleString())
    $(`#celleas_9_11`).val(sum911.toLocaleString())
    //console.log(Math.round((parseFloat($('#pr_tp').html().replaceAll(',',''))+(parseFloat($('#pi_tp').html().replaceAll(',',''))*parseFloat($(`#celleas_dollar`).val().replaceAll(',',''))))/1000))
    // console.log((parseFloat($('#pi_tp').html().replaceAll(',',''))*parseFloat($(`#celleas_dollar`).val().replaceAll(',',''))))

    for (let i = 2; i <= 11; i += 3) {
        let ss10 = 0

        ss10 += isNaN(parseFloat($(`#celleas_10_${i}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_10_${i}`).val().replaceAll(',', ''))
        ss10 += isNaN(parseFloat($(`#celleas_11_${i}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_11_${i}`).val().replaceAll(',', ''))
        $(`#celleas_12_${i}`).val(ss10.toLocaleString())
    }


    for (let i = 2; i <= 11; i += 3) {
        let ss = 0

        ss += isNaN(parseFloat($(`#celleas_9_${i}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_9_${i}`).val().replaceAll(',', ''))
        ss += isNaN(parseFloat($(`#celleas_12_${i}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_12_${i}`).val().replaceAll(',', ''))
        for (let j = 13; j <= 15; j++) {
            ss += isNaN(parseFloat($(`#celleas_${j}_${i}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_${j}_${i}`).val().replaceAll(',', ''))
        }
        $(`#celleas_16_${i}`).val(ss.toLocaleString())
    }
    //////financial pro start
    /////proc 1
    let celleasmain = parseFloat($('#celleas_30_2').val().replaceAll(',', ''))
    let finan1 = 0
    let finan2 = 0
    let finan3 = 0
    ///reset
    for (let i = 0; i < financells; i++)
        for (let j = 0; j < 6; j++)
            $(`#cellfin_${j}_${i}`).html('')
    for (let i = 0; i < financells; i++)

        $(`#cellfincash_${i}`).html('')
    for (let i = 0; i < financells; i++)
        $(`#cellfincashcum1_${i}`).html('')
    for (let i = 0; i < financells; i++)
        $(`#cellfincashcum2_${i}`).html('')


    for (let i = 0; i < financells; i++)
        for (let j = 0; j < 6; j++)
            $(`#cell_fin_for_${j}_${i}`).html('')
    for (let i = 0; i < financells; i++)
        $(`#cellfin_forcash_${i}`).html('')
    for (let i = 0; i < financells; i++)
        $(`#cellfin_forcashcum1_${i}`).html('')
    for (let i = 0; i < financells; i++)
        $(`#cellfin_forcashcum2_${i}`).html('')
    for (let i = 0; i < financells; i++)
        if ($(`#cell_fin_for_0_${i}`).hasClass('bg-red-400')) $(`#cell_fin_for_0_${i}`).removeClass('bg-red-400')

    for (let i = 0; i < financells; i++)
        for (let j = 0; j < 6; j++)
            $(`#cellfin_vcb_${j}_${i}`).html('')
    for (let i = 0; i < financells; i++)
        $(`#cellfin_vcbcash_${i}`).html('')
    for (let i = 0; i < financells; i++)
        $(`#cellfin_vcbcashcum1_${i}`).html('')
    for (let i = 0; i < financells; i++)
        $(`#cellfin_vcbcashcum2_${i}`).html('')
    for (let i = 0; i < financells; i++)
        if ($(`#cellfin_vcb_0_${i}`).hasClass('bg-red-400')) $(`#cellfin_vcb_0_${i}`).removeClass('bg-red-400')

    if ($('#fin1_0').val() != '') {
        let tmpfin00 = isNaN(parseFloat($(`#fin1_0`).val().replaceAll('%', ''))) ? 0 : parseFloat($(`#fin1_0`).val().replaceAll('%', ''))
        let materialp1 = isNaN(parseFloat($(`#celleas_12_2`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_12_2`).val().replaceAll(',', ''))
        let tmpfin02 = isNaN(parseFloat($(`#celleas_9_2`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_9_2`).val().replaceAll(',', ''))
        let tmpfin03 = isNaN(parseFloat($(`#celleas_18_2`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_18_2`).val().replaceAll(',', ''))
        let tmpfin04 = isNaN(parseFloat($(`#celleas_20_2`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_20_2`).val().replaceAll(',', ''))
        let tmpfin05 = isNaN(parseFloat($(`#celleas_21_2`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_21_2`).val().replaceAll(',', ''))
        let tmpfin06 = isNaN(parseFloat($(`#celleas_27_2`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_27_2`).val().replaceAll(',', ''))
        let tmpfin09 = isNaN(parseFloat($(`#fin1_3`).val().replaceAll('%', ''))) ? 0 : parseFloat($(`#fin1_3`).val().replaceAll('%', ''))


        $("#cellfin_0_0").html(Math.round(parseFloat($('#celleas_30_2').val().replaceAll(',', '')) * parseFloat(tmpfin00) / 100.0).toLocaleString())
        for (let i = 0; i < financells; i++) {

            if ($(`#proc1_${i}`).val() != '') {
                let tmpfin01 = isNaN(parseFloat($(`#proc1_${i}`).val().replaceAll('%', ''))) ? 0 : parseFloat($(`#proc1_${i}`).val().replaceAll('%', ''))
                //alert(tmpfin01)
                // alert(materialp1*parseFloat(tmpfin01)/100.0)
                $(`#cellfin_1_${i}`).html("-" + Math.round(materialp1 * parseFloat(tmpfin01) / 100.0).toLocaleString())
            } else {
                $(`#cellfin_1_${i}`).html("")
            }
            if ($('#fin1_2').val() != '' && i < parseFloat($('#fin1_2').val())) {
                $(`#cellfin_2_${i}`).html("-" + Math.round(tmpfin02 / parseFloat($('#fin1_2').val().replaceAll(',', ''))).toLocaleString())
                $(`#cellfin_3_${i}`).html("-" + Math.round((tmpfin03 + tmpfin04 + tmpfin05 + tmpfin06) / parseFloat($('#fin1_2').val().replaceAll(',', ''))).toLocaleString())
            }
            if ($('#fin1_2').val() != '' && $('#fin1_1').val() != '' && i == parseFloat($('#fin1_2').val()) + parseFloat($('#fin1_1').val())) {
                let tmpfin07 = isNaN(parseFloat($(`#cellfin_0_0`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#cellfin_0_0`).val().replaceAll(',', ''))
                $(`#cellfin_5_${i}`).html(Math.round(celleasmain - tmpfin07).toLocaleString())
            }
            if ($('#fin1_2').val() != '' && $('#fin1_1').val() != '' && $('#fin1_3').val() != '' && i < parseFloat($('#fin1_2').val()) + parseFloat($('#fin1_1').val())) {
                let cashflow = 0
                for (let j = 0; j < 6; j++) {
                    // alert($(`#cellfin_${j}_${i}`).html())
                    // alert(parseFloat($(`#cellfin_${j}_${i}`).html().replaceAll(',','')))
                    let tmpfin08 = isNaN(parseFloat($(`#cellfin_${j}_${i}`).html().replaceAll(',', ''))) ? 0.0 : parseFloat($(`#cellfin_${j}_${i}`).html().replaceAll(',', ''))
                    // alert(tmpfin08)
                    cashflow += tmpfin08
                }
                //alert(cashflow)
                $(`#cellfincash_${i}`).html(cashflow.toLocaleString())
                if (i < parseFloat($('#fin1_2').val()) + parseFloat($('#fin1_1').val())) {
                    if (i == 0) {

                        $(`#cellfincashcum1_${i}`).html(cashflow.toLocaleString())
                        $(`#cellfincashcum2_${i}`).html(Math.round(cashflow * tmpfin09 / 100.0).toLocaleString())
                        finan1 += Math.round((cashflow) * tmpfin09 / 100.0)
                    } else {
                        let tmpfin10 = isNaN(parseFloat($(`#cellfincashcum1_${i - 1}`).html().replaceAll(',', ''))) ? 0.0 :
                            parseFloat($(`#cellfincashcum1_${i - 1}`).html().replaceAll(',', ''))
                        $(`#cellfincashcum1_${i}`).html(Math.round((cashflow + tmpfin10)).toLocaleString())
                        $(`#cellfincashcum2_${i}`).html(Math.round((cashflow + tmpfin10) * tmpfin09 / 100.0).toLocaleString())
                        finan1 += Math.round((cashflow + tmpfin10) * tmpfin09 / 100.0)
                    }
                }
            }
        }
    }
    //alert(finan1)

    if (!$(`#cellfincashcum1_${financells - 2}`).hasClass('bg-orange-200')) $(`#cellfincashcum1_${financells - 2}`).addClass('bg-orange-200')
    if (!$(`#cellfincashcum2_${financells - 2}`).hasClass('bg-orange-200')) $(`#cellfincashcum2_${financells - 2}`).addClass('bg-orange-200')
    $(`#cellfincashcum1_${financells - 2}`).html($(`#celleas_22_2`).val())
    $(`#cellfincashcum2_${financells - 2}`).html(finan1.toLocaleString())
    //if($(`#celleas_22_2`).val()=='' || $(`#celleas_22_2`).val()!==$(`#cellfincashcum2_${financells-2}`).html())$(`#celleas_22_2`).val(Math.abs(finan1).toLocaleString())
    //foreign
    finan1 = 0
    $('#fin_for_1_3').val($('#fin1_2').val())
    $('#fin_for_1_4').val($('#fin1_1').val())
    let totalfor = 0;
    let delayed = 0

    for (let i = 0; i < 5; i++) {
        let tmpfinfor00 = isNaN(parseFloat($(`#fin_for_1_${i}`).val().replaceAll(',', ''))) ? 0.0 : parseFloat($(`#fin_for_1_${i}`).val().replaceAll(',', ''))
        totalfor += tmpfinfor00
        if (i < 3) delayed += tmpfinfor00
    }
    $(`#fin_for_1_5`).val(totalfor.toLocaleString())

    for (let i = 0; i < Math.round(delayed); i++)
        if (!$(`#cell_fin_for_0_${i}`).hasClass('bg-red-400')) $(`#cell_fin_for_0_${i}`).addClass('bg-red-400')
    $(`#cell_fin_for_0_0`).html("-" + $(`#celleas_10_5`).val())
    if ($('#fin_for_1_0').val() != '') {
        let tmpfin00 = isNaN(parseFloat($(`#fin1_0`).val().replaceAll('%', ''))) ? 0 : parseFloat($(`#fin1_0`).val().replaceAll('%', ''))
        let materialp1 = isNaN(parseFloat($(`#celleas_12_5`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_12_5`).val().replaceAll(',', ''))
        let cell95 = isNaN(parseFloat($(`#celleas_9_5`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_9_5`).val().replaceAll(',', ''))
        let tmpfin03 = isNaN(parseFloat($(`#celleas_18_5`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_18_5`).val().replaceAll(',', ''))
        let tmpfin04 = isNaN(parseFloat($(`#celleas_20_5`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_20_5`).val().replaceAll(',', ''))
        let tmpfin05 = isNaN(parseFloat($(`#celleas_21_5`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_21_5`).val().replaceAll(',', ''))
        let tmpfin06 = isNaN(parseFloat($(`#celleas_27_5`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_27_5`).val().replaceAll(',', ''))
        let tmpfin09 = isNaN(parseFloat($(`#fin1_3`).val().replaceAll('%', ''))) ? 0 : parseFloat($(`#fin1_3`).val().replaceAll('%', ''))
        $(`#cell_fin_for_4_${delayed}`).html((Math.round(10000 * parseFloat($('#celleas_30_5').val().replaceAll(',', '')) * parseFloat(tmpfin00) / 100.0) / 10000).toLocaleString())
        for (let i = 0; i < financells; i++) {


            if ($('#fin_for_1_3').val() != '' && i >= delayed && i < parseFloat($('#fin_for_1_3').val()) + delayed) {
                $(`#cell_fin_for_1_${i}`).html("-" + (Math.round(10000 * cell95 / parseFloat($('#fin_for_1_3').val())) / 10000).toLocaleString())
                //$(`#cellfin_2_${i}`).html("-"+Math.round(tmpfin02/parseFloat($('#fin1_2').val().replaceAll(',',''))).toLocaleString())
                $(`#cell_fin_for_2_${i}`).html("-" + (Math.round(10000 * (tmpfin03 + tmpfin04 + tmpfin05 + tmpfin06) / parseFloat($('#fin1_2').val().replaceAll(',', ''))) / 10000).toLocaleString())
            }
            if ($('#fin1_2').val() != '' && $('#fin1_1').val() != '' && i == parseFloat($('#fin1_2').val()) + parseFloat($('#fin1_1').val()) + delayed) {
                let tmpfin07 = isNaN(parseFloat($(`#cell_fin_for_4_${delayed}`).html().replaceAll(',', ''))) ? 0 : parseFloat($(`#cell_fin_for_4_${delayed}`).html().replaceAll(',', ''))
                //alert(tmpfin07)
                let totalfinfor = isNaN(parseFloat($('#celleas_30_5').val().replaceAll(',', ''))) ? 0 : parseFloat($('#celleas_30_5').val().replaceAll(',', ''))
                //alert(totalfinfor)
                $(`#cell_fin_for_5_${i}`).html((Math.round(100 * (totalfinfor - tmpfin07)) / 100).toLocaleString())
            }
            //////checkpoint
            if ($('#fin_for_1_3').val() != '' && $('#fin_for_1_4').val() != '' && i <= parseFloat($('#fin_for_1_3').val()) + parseFloat($('#fin_for_1_4').val()) + delayed) {
                let cashflow = 0
                for (let j = 0; j < 6; j++) {
                    // alert($(`#cellfin_${j}_${i}`).html())
                    // alert(parseFloat($(`#cellfin_${j}_${i}`).html().replaceAll(',','')))
                    let tmpfin08 = isNaN(parseFloat($(`#cell_fin_for_${j}_${i}`).html().replaceAll(',', ''))) ? 0.0 : parseFloat($(`#cell_fin_for_${j}_${i}`).html().replaceAll(',', ''))
                    // alert(tmpfin08)
                    //    if(i < parseFloat($('#fin_for_1_3').val()) + parseFloat($('#fin_for_1_4').val()) + delayed)
                    cashflow += tmpfin08
                }
                //alert(cashflow)
                $(`#cellfin_forcash_${i}`).html(cashflow.toLocaleString())
                if (i <= parseFloat($('#fin_for_1_4').val()) + parseFloat($('#fin_for_1_3').val()) + delayed) {
                    if (i == 0) {

                        $(`#cellfin_forcashcum1_${i}`).html(cashflow.toLocaleString())
                        $(`#cellfin_forcashcum2_${i}`).html((cashflow * tmpfin09 / 100.0).toLocaleString())
                        finan1 += Math.round(10000 * (cashflow) * tmpfin09 / 100.0) / 10000.0
                    } else {
                        let tmpfin10 = isNaN(parseFloat($(`#cellfin_forcashcum1_${i - 1}`).html().replaceAll(',', ''))) ? 0.0 :
                            parseFloat($(`#cellfin_forcashcum1_${i - 1}`).html().replaceAll(',', ''))
                        $(`#cellfin_forcashcum1_${i}`).html(((cashflow + tmpfin10)).toLocaleString())
                        $(`#cellfin_forcashcum2_${i}`).html(((cashflow + tmpfin10) * tmpfin09 / 100.0).toLocaleString())
                        ///checkpoint
                        if (i < parseFloat($('#fin_for_1_3').val()) + parseFloat($('#fin_for_1_4').val()) + delayed)
                            finan1 += Math.round(10000 * (cashflow + tmpfin10) * tmpfin09 / 100.0) / 10000.0
                    }
                }
            }
        }
    }
    if (!$(`#cellfin_forcashcum1_${financells - 2}`).hasClass('bg-orange-200')) $(`#cellfin_forcashcum1_${financells - 2}`).addClass('bg-orange-200')
    if (!$(`#cellfin_forcashcum2_${financells - 2}`).hasClass('bg-orange-200')) $(`#cellfin_forcashcum2_${financells - 2}`).addClass('bg-orange-200')
    $(`#cellfin_forcashcum1_${financells - 2}`).html($(`#celleas_22_5`).val())
    $(`#cellfin_forcashcum2_${financells - 2}`).html(finan1.toLocaleString())

    ///////////////////vcb

    finan1 = 0
    $('#fin_vcb_1_0').val($('#fin1_0').val())
    $('#fin_vcb_1_3').val($('#fin1_2').val())
    $('#fin_vcb_1_4').val($('#fin1_1').val())
    if ($('#fin_vcb_1_2').val() != '') {
        // alert((parseFloat($('#fin_vcb_1_3').val())+parseFloat($('#fin_vcb_1_4').val())+parseFloat($('#fin_vcb_1_2').val())).toLocaleString())
        $('#fin_vcb_1_total').html((parseFloat($('#fin_vcb_1_3').val()) + parseFloat($('#fin_vcb_1_4').val()) + parseFloat($('#fin_vcb_1_2').val())).toLocaleString())
    }
    let totalvcb = 0;
    delayed = 2
    let installment = isNaN(parseFloat($(`#fin_vcb_1_1`).val().replaceAll('%', ''))) ? 0 : parseFloat($(`#fin_vcb_1_1`).val().replaceAll('%', ''))
    for (let i = 0; i < 2; i++)
        if (!$(`#cellfin_vcb_0_${i}`).hasClass('bg-red-400')) $(`#cellfin_vcb_0_${i}`).addClass('bg-red-400')
    $(`#cellfin_vcb_0_0`).html("-" + Math.round(parseFloat($(`#celleas_10_8`).val().replaceAll(',', '')) * installment / 100).toLocaleString())
    let mandeh = parseFloat($(`#celleas_10_8`).val().replaceAll(',', '')) - Math.round(parseFloat($(`#celleas_10_8`).val().replaceAll(',', '')) * installment / 100)
    if ($('#fin_vcb_1_2').val() != '' && $('#fin_vcb_1_2').val() != '0') {
        let cnt = parseFloat($('#fin_vcb_1_2').val())
        let install = Math.round(mandeh / cnt)
        //alert(cnt)
        for (let i = 0; i < cnt; i++)
            $(`#cellfin_vcb_0_${i + 1}`).html("-" + install.toLocaleString())
    }
    if ($('#fin_vcb_1_0').val() != '') {
        let tmpfin00 = isNaN(parseFloat($(`#fin1_0`).val().replaceAll('%', ''))) ? 0 : parseFloat($(`#fin1_0`).val().replaceAll('%', ''))
        let materialp1 = isNaN(parseFloat($(`#celleas_12_8`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_12_8`).val().replaceAll(',', ''))
        let cell98 = isNaN(parseFloat($(`#celleas_9_8`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_9_8`).val().replaceAll(',', ''))
        let tmpfin03 = isNaN(parseFloat($(`#celleas_18_8`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_18_8`).val().replaceAll(',', ''))
        let tmpfin04 = isNaN(parseFloat($(`#celleas_20_8`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_20_8`).val().replaceAll(',', ''))
        let tmpfin05 = isNaN(parseFloat($(`#celleas_21_8`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_21_8`).val().replaceAll(',', ''))
        let tmpfin06 = isNaN(parseFloat($(`#celleas_27_8`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_27_8`).val().replaceAll(',', ''))
        let tmpfin09 = isNaN(parseFloat($(`#fin1_3`).val().replaceAll('%', ''))) ? 0 : parseFloat($(`#fin1_3`).val().replaceAll('%', ''))
        $(`#cellfin_vcb_3_2`).html((Math.round(parseFloat($('#celleas_30_8').val().replaceAll(',', '')) * parseFloat(tmpfin00) / 100.0)).toLocaleString())
        for (let i = 0; i < financells; i++) {


            if ($('#fin_vcb_1_3').val() != '' && i >= delayed && i < parseFloat($('#fin_vcb_1_3').val()) + delayed) {
                $(`#cellfin_vcb_1_${i}`).html("-" + (Math.round(cell98 / parseFloat($('#fin_vcb_1_3').val()))).toLocaleString())
                //$(`#cellfin_2_${i}`).html("-"+Math.round(tmpfin02/parseFloat($('#fin1_2').val().replaceAll(',',''))).toLocaleString())
                $(`#cellfin_vcb_2_${i}`).html("-" + (Math.round((tmpfin03 + tmpfin04 + tmpfin05 + tmpfin06) / parseFloat($('#fin1_2').val().replaceAll(',', '')))).toLocaleString())
            }
            if ($('#fin1_2').val() != '' && $('#fin1_1').val() != '' && i == parseFloat($('#fin1_2').val()) + parseFloat($('#fin1_1').val()) + delayed) {
                let tmpfin07 = isNaN(parseFloat($(`#cellfin_vcb_3_${delayed}`).html().replaceAll(',', ''))) ? 0 : parseFloat($(`#cellfin_vcb_3_${delayed}`).html().replaceAll(',', ''))
                //alert(tmpfin07)
                let totalfinfor = isNaN(parseFloat($('#celleas_30_8').val().replaceAll(',', ''))) ? 0 : parseFloat($('#celleas_30_8').val().replaceAll(',', ''))
                //alert(totalfinfor)
                $(`#cellfin_vcb_4_${i}`).html((Math.round((totalfinfor - tmpfin07))).toLocaleString())
            }
            ///////checkpoint
            if ($('#fin_vcb_1_3').val() != '' && $('#fin_vcb_1_4').val() != '' && i <= parseFloat($('#fin_vcb_1_3').val()) + parseFloat($('#fin_vcb_1_4').val()) + delayed) {
                let cashflow = 0
                for (let j = 0; j < 5; j++) {
                    // alert(j)
                    // alert($(`#cellfin_${j}_${i}`).html())
                    // alert(parseFloat($(`#cellfin_${j}_${i}`).html().replaceAll(',','')))
                    let tmpfin08 = isNaN(parseFloat($(`#cellfin_vcb_${j}_${i}`).html().replaceAll(',', ''))) ? 0.0 : parseFloat($(`#cellfin_vcb_${j}_${i}`).html().replaceAll(',', ''))
                    // alert(tmpfin08)
                    // if(i < parseFloat($('#fin_vcb_1_3').val()) + parseFloat($('#fin_vcb_1_4').val()) + delayed)
                    cashflow += tmpfin08
                }
                //alert(cashflow)
                $(`#cellfin_vcbcash_${i}`).html(cashflow.toLocaleString())
                if (i <= parseFloat($('#fin_vcb_1_4').val()) + parseFloat($('#fin_vcb_1_3').val()) + delayed) {
                    if (i == 0) {

                        $(`#cellfin_vcbcashcum1_${i}`).html(cashflow.toLocaleString())
                        $(`#cellfin_vcbcashcum2_${i}`).html((cashflow * tmpfin09 / 100.0).toLocaleString())
                        finan1 += Math.round((cashflow) * tmpfin09 / 100.0)
                    } else {
                        let tmpfin10 = isNaN(parseFloat($(`#cellfin_vcbcashcum1_${i - 1}`).html().replaceAll(',', ''))) ? 0.0 :
                            parseFloat($(`#cellfin_vcbcashcum1_${i - 1}`).html().replaceAll(',', ''))
                        $(`#cellfin_vcbcashcum1_${i}`).html(((cashflow + tmpfin10)).toLocaleString())
                        $(`#cellfin_vcbcashcum2_${i}`).html(((cashflow + tmpfin10) * tmpfin09 / 100.0).toLocaleString())
                        /////checkpoint
                        if (i < parseFloat($('#fin_vcb_1_3').val()) + parseFloat($('#fin_vcb_1_4').val()) + delayed)
                            finan1 += Math.round((cashflow + tmpfin10) * tmpfin09 / 100.0)
                    }
                }
            }
        }
    }
    if (!$(`#cellfin_vcbcashcum1_${financells - 2}`).hasClass('bg-orange-200')) $(`#cellfin_vcbcashcum1_${financells - 2}`).addClass('bg-orange-200')
    if (!$(`#cellfin_vcbcashcum2_${financells - 2}`).hasClass('bg-orange-200')) $(`#cellfin_vcbcashcum2_${financells - 2}`).addClass('bg-orange-200')
    $(`#cellfin_vcbcashcum1_${financells - 2}`).html($(`#celleas_22_8`).val())
    $(`#cellfin_vcbcashcum2_${financells - 2}`).html(finan1.toLocaleString())
    ///////financial pro end

    for (let i = 2; i <= 11; i += 3) {
        let ss = 0


        for (let j = 16; j <= 25; j++) {
            ss += isNaN(parseFloat($(`#celleas_${j}_${i}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_${j}_${i}`).val().replaceAll(',', ''))
        }
        $(`#celleas_26_${i}`).val(ss.toLocaleString())
    }
    for (let i = 2; i <= 11; i += 3) {
        let ss = 0


        for (let j = 26; j <= 28; j++) {
            ss += isNaN(parseFloat($(`#celleas_${j}_${i}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_${j}_${i}`).val().replaceAll(',', ''))
        }
        $(`#celleas_29_${i}`).val(ss.toLocaleString())
    }
    for (let i = 2; i <= 11; i += 3) {
        let ss = 0


        for (let j = 30; j <= 32; j++) {
            ss += isNaN(parseFloat($(`#celleas_${j}_${i}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_${j}_${i}`).val().replaceAll(',', ''))
        }
        $(`#celleas_33_${i}`).val(ss.toLocaleString())
    }
    for (let i = 2; i <= 11; i += 3) {
        let c1
        let c2
        c1 = isNaN(parseFloat($(`#celleas_33_${i}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_33_${i}`).val().replaceAll(',', ''))
        c2 = isNaN(parseFloat($(`#celleas_12_${i}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_12_${i}`).val().replaceAll(',', ''))

        if (c2 != 0) $(`#celleas_34_${i}`).val((Math.round(100.0 * c1 / c2) / 100.0).toLocaleString(undefined, {minimumFractionDigits: 2}))
        else $(`#celleas_34_${i}`).val('1.00')
    }
    let euroc
    euroc = isNaN(parseFloat($(`#celleas_dollar`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_dollar`).val().replaceAll(',', ''))
    let fineuro
    fineuro = isNaN(parseFloat($(`#celleas_33_5`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_33_5`).val().replaceAll(',', ''))
    $(`#celleas_35_5`).val(Math.round(euroc * fineuro).toLocaleString())
    let tsellp = 0
    let tsellcoff = 0

    tsellp += isNaN(parseFloat($(`#celleas_33_2`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_33_2`).val().replaceAll(',', ''))
    tsellp += isNaN(parseFloat($(`#celleas_35_5`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_35_5`).val().replaceAll(',', ''))
    tsellp += isNaN(parseFloat($(`#celleas_33_8`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_33_8`).val().replaceAll(',', ''))
    tsellp += isNaN(parseFloat($(`#celleas_33_11`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_33_11`).val().replaceAll(',', ''))
    $('#tsellp').html(tsellp.toLocaleString())
    //alert($(`#pclcc-5`).html())

    let crosscheck = isNaN(parseFloat($(`#pclcc-5`).html().replaceAll(',', ''))) ? 0 : parseFloat($(`#pclcc-5`).html().replaceAll(',', ''))
    let budget = isNaN(parseFloat($(`#pcs_b`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#pcs_b`).val().replaceAll(',', ''))
    //alert(budget)
    if (budget > 0) $(`#pclcc-cross`).html((Math.round(tsellp * crosscheck / budget)).toLocaleString())
    tsellcoff += isNaN(parseFloat($(`#celleas_10_2`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_10_2`).val().replaceAll(',', ''))
    tsellcoff += isNaN(parseFloat($(`#celleas_10_8`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_10_8`).val().replaceAll(',', ''))
    tsellcoff += isNaN(parseFloat($(`#celleas_10_11`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_10_11`).val().replaceAll(',', ''))
    let tmp00 = isNaN(parseFloat($(`#celleas_10_5`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_10_5`).val().replaceAll(',', ''))
    tsellcoff += tmp00 * euroc
    $('#tsellcoff').html((Math.round(100.0 * tsellp / tsellcoff) / 100).toLocaleString())
    if ($('#controlSheet1').css('display') == "none" && $('#controlSheet2').css('display') == "none" && $('#controlSheet3').css('display') == "none") {
        let summat = 0
        $('#mat_price').val('')
        $('#mat_tedad').val('')
        let mycoff = [1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0]
        for (let i = 2; i <= 11; i += 3) {
            let c1
            let c2
            c1 = isNaN(parseFloat($(`#celleas_33_${i}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_33_${i}`).val().replaceAll(',', ''))
            c2 = isNaN(parseFloat($(`#celleas_12_${i}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#celleas_12_${i}`).val().replaceAll(',', ''))

            if (c2 != 0) mycoff[i] = c1 / c2;
            else mycoff[i] = 1.0;
        }
        $('td[id^="mat_row_tot_"]').each(function (k, l) {
            let row = l.id.split("_")[3]
            let sumrow = 0
            let coff
            let val
            let tedad
            coff = mycoff[2]
            val = isNaN(parseFloat($(`#pr_tp_${row}`).html().replaceAll(',', ''))) ? 0 : parseFloat($(`#pr_tp_${row}`).html().replaceAll(',', ''))
            sumrow += coff * val
            val = isNaN(parseFloat($(`#pi_tp_${row}`).html().replaceAll(',', ''))) ? 0 : parseFloat($(`#pi_tp_${row}`).html().replaceAll(',', ''))
            sumrow += coff * val * euroc
            coff = mycoff[5]
            val = isNaN(parseFloat($(`#cell_ai_${row}`).val().replaceAll(',', ''))) ? 0 : parseFloat($(`#cell_ai_${row}`).val().replaceAll(',', ''))
            sumrow += coff * val * euroc
            coff = mycoff[8]
            val = isNaN(parseFloat($(`#vcb_panir_${row}`).html().replaceAll(',', ''))) ? 0 : parseFloat($(`#vcb_panir_${row}`).html().replaceAll(',', ''))
            tedad = isNaN(parseFloat($(`#mat_list_tedad_${row}`).html().replaceAll(',', ''))) ? 0 : parseFloat($(`#mat_list_tedad_${row}`).html().replaceAll(',', ''))
            sumrow += coff * val

            summat += sumrow * tedad
            $(`#${l.id}`).html(Math.round(sumrow).toLocaleString())
            $('#mat_price').val($('#mat_price').val() + String(Math.round(sumrow)) + ',')
            $('#mat_tedad').val($('#mat_tedad').val() + $('#mat_list_tedad_' + row).html() + ',')
        })
        let checker = isNaN(parseFloat($(`#tsellp`).html().replaceAll(',', ''))) ? 0 : parseFloat($(`#tsellp`).html().replaceAll(',', ''))
        if (Math.round(summat / 1000) != checker && checker != 0) {
            let klll = summat - checker * 1000.0
            //alert(klll)
            let tedad = isNaN(parseFloat($(`#mat_list_tedad_0`).html().replaceAll(',', ''))) ? 0 : parseFloat($(`#mat_list_tedad_0`).html().replaceAll(',', ''))
            let currentp = isNaN(parseFloat($(`#mat_row_tot_0`).html().replaceAll(',', ''))) ? 0 : parseFloat($(`#mat_row_tot_0`).html().replaceAll(',', ''))
            if (tedad != 0) {
                let epsilon = Math.round(klll / tedad)
                $(`#mat_row_tot_0`).html((currentp - epsilon).toLocaleString())
                summat -= klll
                let summat1 = 0
                $('#mat_price').val('')
                $('td[id^="mat_row_tot_"]').each(function (k, l) {
                    let row = l.id.split("_")[3]
                    let tedadin = isNaN(parseFloat($(`#mat_list_tedad_${row}`).html().replaceAll(',', ''))) ? 0 : parseFloat($(`#mat_list_tedad_${row}`).html().replaceAll(',', ''))
                    let prss = parseFloat($(`#${l.id}`).html().replaceAll(',', ''))
                    summat1 += tedadin * prss
                    $('#mat_price').val($('#mat_price').val() + String(prss) + ',')
                })
                if (summat1 != summat) summat = summat1
            }
        }

        $(`#mat_sum_sell`).html(Math.round(summat).toLocaleString())
        $(`#mat_sum_sell_tax`).html(Math.round(summat / 10).toLocaleString())
        $(`#mat_sum_sell_final`).html((Math.round(summat / 10) + Math.round(summat)).toLocaleString())
    }
}

function openPrint() {
    if ($('#controlSheet1').css('display') == "none" && $('#controlSheet2').css('display') == "none" && $('#controlSheet3').css('display') == "none")
        window.open($('#print_url').val() + '&price=' + $('#mat_price').val() + '&tedad=' + $('#mat_tedad').val(), '_blank')
    else
        ToastPro('Please do all jobs on EAS Sheets!', 'top', 'success', 0, 'ltr')
}