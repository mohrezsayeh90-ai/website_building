//////////****** DRAG DROP
function dragStart(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
    ev.dataTransfer.effectAllowed = 'copy';
    ev.target.style.cursor = 'grab';
}

function onDrag(ev) {
    ev.preventDefault();
}

let pTable = $("#productsTable"), dropZone = $("#dropZone");
let tbody = $("#productsTable tbody"), pNumber = $("#proLength");


function dropEnd(ev) {
    ev.preventDefault();
    let data = ev.dataTransfer.getData("text");
    let tender = document.getElementById('monCode').innerText, child = data.split('_')[1];
    if (child) {
        Swal.fire({
            text: `چه تعداد از محصول ${child} به مناقصه ${tender} تخصیص یابد؟`,
            input: "text",
            inputAttributes: {
                autocapitalize: "off"
            },
            showCancelButton: true,
            cancelButtonText: "انصراف",
            confirmButtonText: "تایید",
            showLoaderOnConfirm: true,
            preConfirm: async (number) => {
                if (number) {
                    const response = await post(url("tList/assign"), {
                        child: child,
                        parent: tender,
                        number: number
                    })
                    return response;
                } else {
                    Swal.showValidationMessage(`
         <span class="text-sm">تعداد را مشخص نمایید!</span>:Request failed
      `);
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed && result.value) {
                let res = JSON.parse(result.value);
                if (!res) {
                    return Swal.fire({
                        text: `محصول ${child} ازقبل در مناقصه ${tender} وجود دارد!`,
                        icon: 'error',
                        confirmButtonText: 'متوجه شدم!'
                    });
                } else {
                    let len = tbody.find('tr').length;
                   // console.log(len)
                    tbody.append(`
                                  <tr class="bg-white hover:bg-zinc-300">
                                <td class="pr-1 border border-slate-400">${len + 1}</td>
                                <td class="pr-1 border border-slate-400">${res.mah_cod + " : " + res.name}</td>
                                <td class="pr-1 border border-slate-400">${res.tedad}</td>
                                <td class="pr-1 border border-slate-400">
                                    <button class="delete-btn hover:animate-pulse text-red-600 text-2xl" value="${res.id}"><i
                                                class="fa fa-close"></i></button>
                                </td>
                            </tr>`)
                    pNumber.text(len + 1);
                    pTable.hasClass('hidden') && pTable.removeClass('hidden');
                    !dropZone.hasClass('hidden') && dropZone.addClass('hidden');

                }

            }
        });
    }

}

$(document).ready(() => {
    jalaliDatepicker.startWatch();

    new DataTable("#tenderTable", {
        order: [[8, 'desc']],
        paging:false
    });
    let mainT = $("#tenderTable").DataTable()
    let mainTable = $("#tenderTable").DataTable()
    $('.dt-search input')
        .off()
        .on('keyup', function () {
            //console.log(1)
            if (this.value == "") {
                $("#tenderTable>tbody>tr").each(function () {
                    $(this).show()
                })
            }
            else {
                let tmp = this.value.split("+").map(function (item) {
                    return item.trim();
                });

                $("#tenderTable>tbody>tr").each(function () {
                    $(this).show()
                    let hide = false
                    let el=$(this)
                   // console.log(el.html())
                    tmp.forEach(function (item) {

                        if (item!="" && !el.html().toLowerCase().includes(item.toLowerCase())) {
                            hide = true
                            return
                        }

                    })
                    if (hide) $(this).hide()
                })


                // mainTable.draw()
            }

        });
    $('#tenderTable').css('width','100%')
    let startDate = $("#startDate"), endDate = $("#endDate");
    $("#dropdownDefaultRadio input").on("keyup", function (ev) {
        let sdVal = startDate.val().trim(), edVal = endDate.val().trim();
        if (ev.keyCode === 13) {
            if (sdVal || edVal) {
                //  console.log(sdVal, edVal, $("[name=date-radio]:checked").val())
                $.ajax({
                    url: url('tlist/filter/'),
                    method: 'GET',
                    dataType: 'json',
                    data: {q: sdVal, p: edVal, e: $("[name=date-radio]:checked").val()}
                }).done(res => {
                    console.log(res)
                    let trs = ``;
                    $("#removeFilter").show();
                    res.forEach((j, i) => {
                        trs += `<tr class="${i % 2 ? "bg-zinc-100" : "bg-zinc-200"} border-b dark:bg-gray-800 dark:border-gray-700
                    hover:bg-zinc-400 dark:hover:bg-gray-600 text-end">
                        <td class="pl-1 py-2">
                            <div class="flex w-full justify-evenly text-3xl">
                                <button onclick="loseTender('${j.code}')" ${j.status >= 100 || j.status < 2 ? 'disabled' : ''}
                                        type="button" class=" text-red-700 border
                                border-red-700 bg-red-800 focus:ring-4
                                focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center me-2 mb-2 dark:border-red-500
                                dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                    <img src="${url('assets/images/lose.png')}" class="w-7 h-7"
                                         alt="loser icon"/>
                                </button>
                                <button onclick="winTender('${j.code}')" ${j.status >= 100 || j.status < 2 ? 'disabled' : ''}
                                        type="button" class=" text-green-700 border
                                border-green-700 bg-green-800 focus:ring-2
                            focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-1 text-center me-2 mb-2
                            dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
                                    <img src="${url('assets/images/win.png')}" class="w-7 h-7"
                                         alt="winner icon"/>
                                </button>
                                <i onclick="showDocuments('${j.code}')"
                                   id="seeDocuments${j.code}"
                                   data-tooltip-target="tender_asnad${j.code}" class="cursor-pointer mt-1 float-end fa fa-download
                    h-auto relative z-0 rounded-lg transition-all duration-300 hover:scale-150"></i>
                                <div id="tender_asnad${j.code}" role="tooltip"
                                     class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    رویت اسناد مناقصه
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>
                        </td>
                         <td class="text-center ${j.status >= 100 || j.status < 2 ? '' : 'animate-bounce'}  pl-1 py-2">
                            <a target="_self" class="text-black font-medium text-lg hover:animate-pulse
                        text-center"
                               href="${j.status < 2 || j.status >= 100 ? '#' : url("detail/proposal/?q="  + j.id)}"><i
                                        class="fa fa-eye"></i></a></td>
                        <td class="text-center ${j.status >= 100 || j.status < 2 ? '' : 'animate-bounce'} pl-1 py-2">
                            <a target="_self" class="text-black font-medium text-lg hover:animate-pulse
                        text-center"
                               href="${j.status >= 100 || j.status < 2 ? '#' : url("detail/show/?q=" + j.id)}"><i
                                        class="fa fa-eye"></i></a></td>
                        <td class=" text-center pl-1 py-2 ${j.status != 1 ? '' : "animate-bounce"}"><a
                                    target="_self" class="font-medium  text-lg hover:animate-pulse
                                                     text-center"
                                    href="${j.status != 1 ? '#' : url("tList/show/q=" + j.id)}"><i
                                        class="bi bi-boxes"></i></a></td>
                        <td class="ltr text-end pl-1 py-2">${j.completiondate ?? ''}</td>
                        <td colspan="text-end pl-1 py-2">${switchStatus(j.status, j.related_project_code)}</td>
                        <td colspan="text-end pl-1 py-2"><B class="ltr">${j.customercod}</B></td>
                        <td class="ltr text-end pl-1 py-2"><B
                                    class="ltr">${j.trkh}</B></td>
                        <td colspan="text-end pl-1 py-2">${j.code}</td>
                        <td colspan="text-end pl-1 py-2">${j.name}</td>
                        <td colspan="text-end pl-1 py-2">${i + 1}</td>
                    </tr>`;
                    })

                    $("#tenderTable tbody").html(trs);
                })
            }
        }
    })
    $(`input[type="radio"]`).on("change", function (ev) {
        // alert($("[name=date-radio]:checked").val())
        let sdVal = startDate.val().trim(), edVal = endDate.val().trim();
        if (13 === 13) {
            if (sdVal || edVal) {
                //  console.log(sdVal, edVal, $("[name=date-radio]:checked").val())
                $.ajax({
                    url: url('tlist/filter/'),
                    method: 'GET',
                    dataType: 'json',
                    data: {q: sdVal, p: edVal, e: $("[name=date-radio]:checked").val()}
                }).done(res => {
                    //   console.log(res)
                    let trs = ``;
                    $("#removeFilter").show();
                    res.forEach((j, i) => {
                        trs += `<tr class="${i % 2 ? "bg-zinc-100" : "bg-zinc-200"} border-b dark:bg-gray-800 dark:border-gray-700
                    hover:bg-zinc-400 dark:hover:bg-gray-600 text-end">
                        <td class="pl-1 py-2">
                            <div class="flex w-full justify-evenly text-3xl">
                                <button onclick="loseTender('${j.code}')" ${j.status >= 100 || j.status < 2 ? 'disabled' : ''}
                                        type="button" class=" text-red-700 border
                                border-red-700 bg-red-800 focus:ring-4
                                focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center me-2 mb-2 dark:border-red-500
                                dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                    <img src="${url('assets/images/lose.png')}" class="w-7 h-7"
                                         alt="loser icon"/>
                                </button>
                                <button onclick="winTender('${j.code}')" ${j.status >= 100 || j.status < 2 ? 'disabled' : ''}
                                        type="button" class=" text-green-700 border
                                border-green-700 bg-green-800 focus:ring-2
                            focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-1 text-center me-2 mb-2
                            dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
                                    <img src="${url('assets/images/win.png')}" class="w-7 h-7"
                                         alt="winner icon"/>
                                </button>
                                <i onclick="showDocuments('${j.code}')"
                                   id="seeDocuments${j.code}"
                                   data-tooltip-target="tender_asnad${j.code}" class="cursor-pointer mt-1 float-end fa fa-download
                    h-auto relative z-0 rounded-lg transition-all duration-300 hover:scale-150"></i>
                                <div id="tender_asnad${j.code}" role="tooltip"
                                     class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium
                                            text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    رویت اسناد مناقصه
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>
                        </td>
                         <td class="text-center ${j.status >= 100 || j.status < 2 ? '' : 'animate-bounce'}  pl-1 py-2">
                            <a target="_self" class="text-black font-medium text-lg hover:animate-pulse
                        text-center"
                               href="${j.status < 2 || j.status >= 100 ? '#' : url("detail/proposal/?q="  + j.id)}"><i
                                        class="fa fa-eye"></i></a></td>
                        <td class="text-center ${j.status >= 100 || j.status < 2 ? '' : 'animate-bounce'} pl-1 py-2">
                            <a target="_self" class="text-black font-medium text-lg hover:animate-pulse
                        text-center"
                               href="${j.status >= 100 || j.status < 2 ? '#' : url("detail/show/?q=" + j.id)}"><i
                                        class="fa fa-eye"></i></a></td>
                        <td class=" text-center pl-1 py-2 ${j.status != 1 ? '' : "animate-bounce"}"><a
                                    target="_self" class="font-medium  text-lg hover:animate-pulse
                                                     text-center"
                                    href="${j.status != 1 ? '#' : url("tList/show/q=" + j.id)}"><i
                                        class="bi bi-boxes"></i></a></td>
                        <td class="ltr text-end pl-1 py-2">${j.completiondate ?? ''}</td>
                        <td colspan="text-end pl-1 py-2">${switchStatus(j.status, j.related_project_code)}</td>
                        <td colspan="text-end pl-1 py-2"><B class="ltr">${j.customercod}</B></td>
                        <td class="ltr text-end pl-1 py-2"><B
                                    class="ltr">${j.trkh}</B></td>
                        <td colspan="text-end pl-1 py-2">${j.code}</td>
                        <td colspan="text-end pl-1 py-2">${j.name}</td>
                        <td colspan="text-end pl-1 py-2">${i + 1}</td>
                    </tr>`;
                    })

                    $("#tenderTable tbody").html(trs);
                })
            }
        }
    })
    $("#removeFilter").on("click", function () {
        location.reload();
    });

    searchInRow($("#search"), ".product_name, .product_code", $(".product_card"))
    pTable.on('click', '.delete-btn', function () {
        let x = $(this), code = x.val();
        Swal.fire({
            icon: 'error',
            text: `آیا از حذف محصول از  مناقصه اطمینان دارید؟`,
            confirmButtonText: 'حذف شود',
            showCancelButton: true,
            cancelButtonText: 'خیر',
        }).then(async res => {
            if (res.isConfirmed) {
                let res = await get(url(`tList/delete/q=${code}`));
                $('#productsTable>tbody').html('')
                if (res.length > 0) {
                    //  $(this).parents('tr').hide(500).remove();
                    let res1 = JSON.parse(res)
                    let mhtml = ``
                    let cnt = 0
                    res1.forEach((er) => {
                        if (er.mah_cod == null) {
                            pTable.addClass('hidden')
                            pNumber.text(0)
                            return
                        }
                        mhtml += `   <tr class="bg-white hover:bg-zinc-300">
                                    <td class="pr-1 border border-slate-400">${cnt + 1}</td>
                                    <td class="pr-1 border border-slate-400">${er.mah_cod}</td>
                                    <td class="pr-1 border border-slate-400">${er.tedad}</td>
                                    <td class="pr-1 border border-slate-400">
                                        <button class="delete-btn hover:animate-pulse text-red-600 text-2xl"
                                                value="${er.row_id}"><i
                                                    class="fa fa-close"></i></button>
                                    </td>
                                </tr>`
                        cnt++
                    })
                    $('#productsTable>tbody').html(mhtml)
                }

                pNumber.text(pTable.find('tbody tr').length)
                if (pTable.hasClass('hidden')) dropZone.removeClass('hidden');
                // if (pTable.find('tbody tr').length === 0) pTable.addClass('hidden')
                // && dropZone.removeClass('hidden');
            }
        })
    })


})

function switchStatus(st, param = "") {
    let str = "";
    switch (st) {
        case "1":
            str = "<B class=\"ltr\">Making preparations</B>";
            break;
        case "2":
            str = "<B class=\"ltr\">Preparing EPL</B>";
            break;
        case "100":
            str = "<B class=\"ltr text-green-400\">Success-" + param + "</B>";
            break;
        case "101":
            str = "<B class=\"ltr text-red-400\">Failure</B>";
            break;
    }
    return str;
}

async function showDocuments(list = '') {
    let code = $("#monCode").text().trim();
    if (list != '') code = list
    await $.ajax({
        url: url('tlist/documents'),
        method: "POST",
        data: {
            tenderCode: code
        }, dataType: "html"
    }).then(async (result) => {
        let files
        if (result) files = JSON.parse(result)
        else return
        let mhtml = `<div class="bg-white border border-gray-200
                 rounded-lg shadow md:max-w-xl hover:bg-gray-100
                dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 drop-shadow-lg hover:drop-shadow-2xl">
                <div class="w-full bg-this-teal text-white text-center rounded-t-lg p-1">
           
                    <p class="text-lg">${code}</p>
                </div>
                <div class="flex items-start md:flex-row p-5 w-full">
               
                    <div style="text-align: left !important;" class="flex w-full flex-col justify-start leading-normal text-this-gray ps-4 text-sm">`
        files.forEach((file) => {
            mhtml += `<a  target="_blank" class="ltr bg-zinc-200 py-1 px-2 w-full" href=${url('assets/images/tenders/' + file.nam)}>${file.nam}</a>`
        })
        mhtml += ` </div>
                </div>
            </div>`
        Swal.fire({
            title: '',
            html: `<div class="bg-gradient w-100 h-100">
${mhtml}
</div>`,

            showCloseButton: false,
            showConfirmButton: false,
            showClass: {
                popup: `
      animate__animated
      animate__fadeInUp
      animate__faster
    `
            },
            hideClass: {
                popup: `
      animate__animated
      animate__fadeOutDown
      animate__faster
    `
            },

        })
    })
}

async function tender_finalize(tendercod) {
    if (pNumber.text() == '0') return
    Swal.fire({
        html: `<h3>آیا قصد نهایی کردن این مرحله از مناقصه ${tendercod} را دارید؟</h3>`,
        icon: "warning",
        iconHtml: "؟",
        confirmButtonText: "بله",
        cancelButtonText: "خیر",
        showCancelButton: true,
        showCloseButton: true
    }).then(async (res) => {
        if (res.isConfirmed) {
            await $.ajax({
                url: url('tlist/gotostep2'),
                method: "POST",
                data: {
                    tenderCode: tendercod
                }, dataType: "html"
            }).then(async (result) => {
                await ToastPro('عملیات باموفقیت انجام شد!', 'top', 'success')
                window.open(url('tList'), '_self')
            })
        }

    })
}

async function winTender(tendcode) {
    Swal.fire({
        html: `<h4>شما در حال ثبت وضعیت برنده برای مناقصه ${tendcode} هستید، آیا مطمئنید؟</h4>`,
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "بله",
        cancelButtonText: "خیر",
        showCancelButton: true,
        showCloseButton: true
    }).then(async (res) => {
        if (res.isConfirmed) {
            await $.ajax({
                url: url('tlist/winTender'),
                method: "POST",
                data: {
                    tenderCode: tendcode
                }, dataType: "html"
            }).then(async (result) => {
                await ToastPro('عملیات باموفقیت انجام شد!', 'top', 'success')
                location.reload()
            })
        }
    })
}

async function loseTender(tendcode) {
    Swal.fire({
        html: `<h4>شما در حال ثبت وضعیت عدم موفقیت برای مناقصه ${tendcode} هستید، آیا مطمئنید؟</h4>`,
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "بله",
        cancelButtonText: "خیر",
        showCancelButton: true,
        showCloseButton: true
    }).then(async (res) => {
        if (res.isConfirmed) {
            await $.ajax({
                url: url('tlist/loseTender'),
                method: "POST",
                data: {
                    tenderCode: tendcode
                }, dataType: "html"
            }).then(async (result) => {
                await ToastPro('عملیات باموفقیت انجام شد!', 'top', 'success')
                location.reload()
            })
        }
    })
}