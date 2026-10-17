// function showList(name, array, x, y) {
//     $("#showingList").remove();
//     body.append(`
//     <select id="showingList" name=${name} class='position-absolute bg-light' style='top:${y}px;left:${x}px'>
//     <option>-</option>${array}</select>`)
// }
//
// let body = $("body"), name = $("#name");
// name.on('keyup', async (ev) => {
//     $("#showingList").remove();
//     let xy = ev.target.getBoundingClientRect()
//     let inp = $(ev.target);
//     if (inp.val().length > 0) {
//         let comps = await get(url('supplier/getNames/'), {text: inp.val()}), json = JSON.parse(comps);
//         //console.log(pros)
//         if ($.isArray(json) && json.length > 0) {
//             let arr = ``
//             json.forEach(j => {
//                 arr += `<option value="${j.cod}">${j.nam}</option>`
//             })
//             showList('company', arr, xy.left, xy.bottom);
//         }
//     }
// })
//
//
// body.on('change', "[name=company]", async function () {
//     let edit =document.getElementById('closeEdit');
//     if(edit) edit.remove();
//     let det = await post(url('supplier/getDetails'), {text: $(this).val()}), json =JSON.parse(det);
//     console.log(json)
//     name.val(json.nam) ; $("#supCode").val(json.cod) ; $("#postCode").val(json.post) ; $("#email").val(json.email) ;
//     $("#address").val(json.adres) ; $("#phoneMobile").val(json.mobile) ; $("#phone").val(json.phone) ; $("#idCode").val(json.shenase) ;
//     $("#fax").val(json.fax);
//     json.no ==0 ? $("#real").prop("checked", true) : $("#virtual").prop("checked", true);
//     $("#showingList").remove();
//     $("#submitsupplier").text('ویرایش').prop('name', 'editSupplier');
//     document.getElementById('submitsupplier').insertAdjacentHTML('afterend', `<button type="button" id="closeEdit"
//     class="scale-btn px-3 red-gradient mx-3 rounded border-warning border">
//                                 <i class="fa fa-close"></i>
//                             </button>`)
// })
//
// body.on("click", "#closeEdit", function (){
//     $("#supplierAdd").attr('action', url('supplier/closeEdit')).submit();
//
// })

$(".star-rating").on("click", "i", async function () {
    let target = $(this),
        //card = $(this).parents(".personal-card"),
        // mId = card.attr("id").split("_")[1],
        idx = target.attr("data-index"),
        ic = target.attr("class");
    target.removeClass();
    let res = newScore(idx, ic)
    target.addClass(res[1])
    //console.log(mId)
    //console.log(await post(url("project-manager/dashboard-ajax"), {star: true, guid: mId, score: res[0]}))
    //console.log(typeof res[0])
})

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

function newScore(index, icon) {
    // if (index > 1 && index <5) {
    for (let n = 1; n < parseInt(index); n++) {

        $('.star-rating').find('[data-index="' + n + '"]').attr("class", "fa fa-star")

    }
    for (let m = parseInt(index) + 1; m <= 6; m++) {
        $('.star-rating').find('[data-index="' + m + '"]').attr("class", "fa fa-star-o")

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

$("#submitInfo").on('click', async () => {
    if ($('#supCode').val() === '' ||
        $('#name').val() === '' || $('#eName').val() === '' || $('#address').val() === '' || $('#phone1').val() === '' ||
        $('#email').val() === '' || $('#postCode').val() === '' || $('#identity').val() === '') {
        await ToastPro('موارد ستاره دار نمی توانند خالی باشند!', 'top', 'error')
        return
    }
    if ($('#supCode').val().length < 8 || !$('#supCode').val().startsWith('SUP-')) {
        await ToastPro('ساختار کد مشتری غلط است!', 'top', 'error')
        $('#supCode').focus()
        return
    }
    if ($('#email').val().length < 5 || !$('#email').val().includes('@')) {
        await ToastPro('آدرس ایمیل نادرست است!', 'top', 'error')
        $('#email').focus()
        return
    }
    if ($('#phone1').val().length < 11) {
        await ToastPro('شماره تلفن غلط است!', 'top', 'error')
        $('#phone1').focus()
        return
    }
    if ($('#identity').val().length < 10 || $('#identity').val().length > 11) {
        await ToastPro('کد / شناسه ملی غلط است!', 'top', 'error')
        $('#identity').focus()
        return
    }
    if ($('#postCode').val().length != 10) {
        await ToastPro('کد پستی نادرست است!', 'top', 'error')
        $('#postCode').focus()
        return
    }
    Swal.fire({
        html: "<h3>آیا مایل به ثبت اطلاعات(تغییرات) می باشید؟</h3>",
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "بله",
        cancelButtonText: "خیر",
        showCancelButton: true,
        showCloseButton: true
    }).then(async (res) => {
        if (res.isConfirmed) {
            $('#supplierAdd').submit()
        }
    })

})
$('#suppliersList').on('click', async () => {
    if (!$('#clearAllFields').hasClass('hidden')) return
    await $.ajax({
        url: url('supplier/getAll'),
        method: "POST",
        dataType: "html"
    }).then(async (result) => {
        let myResult = JSON.parse(result)
        let mhtml = `<div  class="container text-sm">
            <table class=" display compact" style="text-align:center !important"
                   id="suppliersTable">
                <thead class="text-white uppercase dark:bg-gray-700 dark:text-gray-400 bg-this-teal">
                <tr>
                    <th scope="col" style="text-align:center !important">کد کارفرما</th>
                    <th scope="col" style="text-align:center !important">نام کارفرما</th>
                    <th scope="col" style="text-align:center !important">نام انگلیسی</th>
                    <th scope="col" style="text-align:center !important">شماره تلفن</th>
                    <th  scope="col" style="text-align:center !important">کد / شناسه ملی</th>
                    <th scope="col" style="text-align:center !important">لوگو</th>
                    <th  scope="col" style="text-align:center !important">عملیات</th>
                </tr>
                </thead>
                <tbody class="text-this-gray">`
        myResult.forEach((row) => {
            mhtml += `<tr class="bg-zinc-100 border-b dark:bg-gray-800 ltr dark:border-gray-700 hover:bg-zinc-400 dark:hover:bg-gray-600">
<td>${row.cod}</td>
<td>${row.nam}</td>
<td>${row.eName}</td>
<td>${row.phone}</td>
<td>${row.shenase}</td>`
            if (!row.logo) mhtml += `<td></td>`
            else
                mhtml += `<td><img style="width:60px" src="${url('assets/images/suppliers/' + row.logo)}"></td>`

            mhtml += ` <td align="center">
                                 <button onclick="delsupplier('${row.cod}')" id="button_suppliers_del_${row.cod}" type="button"
                                        class="text-red-600 font-medium rounded-full hover:animate-pulse
                                                     text-center me-2 mb-2 fa fa-close"></button>
                                <button onclick="editSupplier('${row.cod}')" id="button_suppliers_edit_${row.cod}" type="button"
                                        class="text-yellow-700 font-medium rounded-full hover:animate-pulse
                                                     text-center me-5 mb-2 fa fa-edit"></button>
                              
                        </tr>
</tr>
`
        })
        mhtml += `</tbody>
            </table>
        </div>
        <script>

</script>
`
        Swal.fire({
            title: '',
            html: `<div class="bg-gradient w-100 h-100">
${mhtml}
</div>`,
            width: 1300,
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
            didOpen: () => {
                new DataTable("#suppliersTable", {
                    order: [[0, 'desc']],
                    columnDefs: {className: 'dt-center', targets: '_all'}

                });

            },
            didClose: () => {
                $('#name').focus()
            }
        })
    })

})


async function editSupplier(supCod) {
    Swal.close()
    $('#clearAllFields').removeClass('hidden')
    await $.ajax({
        url: url('supplier/edit'),
        method: "POST",
        data: {
            supCod: supCod
        }, dataType: "html"
    }).then(async (result) => {
        let mData = JSON.parse(result)
        $('#editSupplier').val(1)
        $('#supCode').val(mData.cod)
        $('#name').val(mData.nam)
        $('#eName').val(mData.eName)
        $('#address').val(mData.adres)
        $('#phone1').val(mData.phone)
        $('#phone2').val(mData.mobile)
        $('#email').val(mData.email)
        $('#postCode').val(mData.post)
        $('#identity').val(mData.shenase)
        $('#fax').val(mData.fax)
        $('#shaba').val(mData.accountno)
        $('#score').val(mData.score)
        proScore(mData.score)
        if (mData.no == 1)
            $('#supType2').prop('checked', true)
        else
            $('#supType1').prop('checked', true)


    })
}

async function delsupplier(supCod) {
    Swal.fire({
        html: `<h3>آیا مطمئنید می خواهید مشتری ${supCod} را حذف نمایید؟</h3>`,
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "بله",
        cancelButtonText: "خیر",
        showCancelButton: true,
        showCloseButton: true
    }).then(async (res) => {
        if (res.isConfirmed) {
            await $.ajax({
                url: url('supplier/delete'),
                method: "POST",
                data: {
                    supCod: supCod
                }, dataType: "html"
            }).then(async (result) => {
                await ToastPro('کارفرما با موفقیت حذف شد!', 'top', 'success', 1)
            })
        }
    })
}

$('#clearAllFields').on('click', async () => {
    location.reload();
})
$('input[type="text"]').on("keydown", function (e) {
    /* ENTER PRESSED*/
    // alert(e.which)
    if (e.keyCode == 13) {
        /* FOCUS ELEMENT */
        let inputs = $(this).parents().parent().eq(0).find("input[type=\"text\"]");
        let idx = inputs.index(this);

        if (idx == inputs.length - 1) {
            inputs[0].select()
        } else {
            inputs[idx + 1].focus(); //  handles submit buttons
            inputs[idx + 1].select();
        }

        return false;
    }


});
$('#star>i').on('click', () => {
    setTimeout(() => {
        let score = 0
        $('#star>i').each(function (k, elem) {
            let ss = Array.from(elem.classList);

            if (ss.includes('fa-star')) score += 20
            if (ss.includes('fa-star-half-o')) score += 10
        })
        $('#score').val(score)
        if (score <= 40) $('#star').attr('class', 'text-2xl ltr text-red-400')
        else if (score <= 60) $('#star').attr('class', 'text-2xl ltr text-amber-400')
                else if (score <= 80) $('#star').attr('class', 'text-2xl ltr text-green-400 ')
        else $('#star').attr('class', 'text-2xl ltr text-green-500')
    }, 200)
})

function proScore(score) {
    console.log(typeof score)
    if (score == null || score === '0') {
        $('#star').attr('class', 'text-2xl ltr text-red-400')
        $('#star>i').each(function (k, elem) {
            elem.className = "fa fa-star-o"
        })
    }
    else if (score === '10') {
        $('#star').attr('class', 'text-2xl ltr text-red-400')
        $('#star>i').each(function (k, elem) {
            if (k === 0) {
                elem.className = "fa fa-star-half-o"

            } else {
                elem.className = "fa fa-star-o"
            }

        })
    }
    else if (score === '20') {
        $('#star').attr('class', 'text-2xl ltr text-red-400')
        $('#star>i').each(function (k, elem) {
            if (k === 0) {
                elem.className = "fa fa-star"

            } else {
                elem.className = "fa fa-star-o"
            }

        })
    }
    else if (score === '30') {
        $('#star').attr('class', 'text-2xl ltr text-red-400')
        $('#star>i').each(function (k, elem) {
            if (k === 0) {
                elem.className = "fa fa-star"

            }
            else if (k === 1) {
                elem.className = "fa fa-star-half-o"

            }
            else {
                elem.className = "fa fa-star-o"
            }

        })
    }

    else if (score === '40') {
        $('#star').attr('class', 'text-2xl ltr text-red-400')
        $('#star>i').each(function (k, elem) {
            if (k <2 ) {
                elem.className = "fa fa-star"

            } else {
                elem.className = "fa fa-star-o"
            }

        })
    }
    else if (score === '50') {
        $('#star').attr('class', 'text-2xl ltr text-amber-400')
        $('#star>i').each(function (k, elem) {
            if (k < 2) {
                elem.className = "fa fa-star"

            }
            else if (k === 2) {
                elem.className = "fa fa-star-half-o"

            }
            else {
                elem.className = "fa fa-star-o"
            }

        })
    }
    else if (score ==='60') {
        $('#star').attr('class', 'text-2xl ltr text-amber-400')
        $('#star>i').each(function (k, elem) {
            if(k<3) {
                elem.className = "fa fa-star"

            }

            else{
                elem.className = "fa fa-star-o"
            }

        })
    }
    else if (score === '70') {
        $('#star').attr('class', 'text-2xl ltr text-green-400')
        $('#star>i').each(function (k, elem) {
            if(k<3) {
                elem.className = "fa fa-star"

            }
            else if(k===3)elem.className = "fa fa-star-half-o"
            else{
                elem.className = "fa fa-star-o"
            }

        })
    }
    else if (score === '80') {
        $('#star').attr('class', 'text-2xl ltr text-green-400')
        $('#star>i').each(function (k, elem) {
            if(k<4) {
                elem.className = "fa fa-star"

            }

            else{
                elem.className = "fa fa-star-o"
            }

        })
    }
    else if (score === '90') {
        $('#star').attr('class', 'text-2xl ltr text-green-500')
        $('#star>i').each(function (k, elem) {
            if(k<4) {
                elem.className = "fa fa-star"

            }
            else if(k===4)elem.className = "fa fa-star-half-o"
            else{
                elem.className = "fa fa-star-o"
            }

        })
    }
    else{
        $('#star').attr('class', 'text-2xl ltr text-green-500')
        $('#star>i').each(function (k, elem) {

                elem.className = "fa fa-star"


        })
    }
}
$('#shaba').on('keyup',()=>{
    $('#shabacnt').html($('#shaba').val().length)
})
