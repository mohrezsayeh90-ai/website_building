$(document).ready(() => {
    function showList(name, array, x, y) {
        $("#showingList").remove();
        body.append(`
        <select id="showingList" name=${name} class='position-absolute bg-light' style='top:${y}px;left:${x}px'>
        <option>-</option>${array}</select>`)
    }

    let body = $("body"), name = $("#name");
    name.on('keyup', async (ev) => {
        $("#showingList").remove();
        let xy = ev.target.getBoundingClientRect()
        let inp = $(ev.target);
        if (inp.val().length > 0) {
            let comps = await get(url('customer/getNames/'), {text: inp.val()}), json = JSON.parse(comps);
            //console.log(pros)
            if ($.isArray(json) && json.length > 0) {
                let arr = ``
                json.forEach(j => {
                    arr += `<option value="${j.cod}">${j.nam}</option>`
                })
                showList('company', arr, xy.left, xy.bottom);
            }
        }
    })


    body.on('change', "[name=company]", async function () {
        let edit =document.getElementById('closeEdit');
        if(edit) edit.remove();
        let det = await post(url('customer/getDetails'), {text: $(this).val()}), json =JSON.parse(det);
        console.log(json)
        name.val(json.nam) ; $("#cusCode").val(json.cod) ; $("#postCode").val(json.post) ; $("#email").val(json.email) ;
        $("#address").val(json.adres) ; $("#phoneMobile").val(json.mobile) ; $("#phone").val(json.phone) ; $("#idCode").val(json.shenase) ;
        $("#fax").val(json.fax);
        json.no ==0 ? $("#real").prop("checked", true) : $("#virtual").prop("checked", true);
        $("#showingList").remove();
        $("#submitCustomer").text('ویرایش').prop('name', 'editCustomer');
        document.getElementById('submitCustomer').insertAdjacentHTML('afterend', `<button type="button" id="closeEdit" 
        class="scale-btn px-3 red-gradient mx-3 rounded border-warning border">
                                    <i class="fa fa-close"></i>
                                </button>`)
    })

    body.on("click", "#closeEdit", function (){
        $("#customerAdd").attr('action', url('customer/closeEdit')).submit();

    })

})
$("#submitInfo").on('click',async ()=> {
    if ($('#cusCode').val() === '' ||
        $('#name').val() === '' || $('#eName').val() === '' || $('#address').val() === '' || $('#phone1').val() === '' ||
        $('#email').val() === '' || $('#postCode').val() === '' || $('#identitiy').val() === '') {
        await ToastPro('موارد ستاره دار نمی توانند خالی باشند!', 'top', 'error')
        return
    }
    if ($('#cusCode').val().length < 8 || !$('#cusCode').val().startsWith('MOT-')){
        await ToastPro('ساختار کد مشتری غلط است!', 'top', 'error')
        $('#cusCode').focus()
        return
    }
    if ($('#email').val().length <5 || !$('#email').val().includes('@')){
        await ToastPro('آدرس ایمیل نادرست است!', 'top', 'error')
        $('#email').focus()
        return
    }
    if ($('#phone1').val().length <11){
        await ToastPro('شماره تلفن غلط است!', 'top', 'error')
        $('#phone1').focus()
        return
    }
    if ($('#identitiy').val().length <10 || $('#identitiy').val().length >11){
        await ToastPro('کد / شناسه ملی غلط است!', 'top', 'error')
        $('#identitiy').focus()
        return
    }
    if ($('#postCode').val().length!=10){
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
            $('#customerAdd').submit()
        }
        })

})
$('#customersList').on('click',async ()=>{
    if(!$('#clearAllfields').hasClass('hidden'))return
    await $.ajax({
        url: window.location.href,
        method: "POST",
        data: {
                getallcustomers:true
        }, dataType: "html"
    }).then(async (result) => {
        let myresult=JSON.parse(result)
        let mhtml=`<div  class="container text-sm">
            <table class=" display compact  "
                   id="customersTable">
                <thead class="text-white uppercase dark:bg-gray-700 dark:text-gray-400 bg-this-teal">
                <tr>
<!--                    <th scope="col" class="pr-6 pl-1 py-3 text-end">Date</th>-->
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3">کد کارفرما</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">نام کارفرما</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">نام انگلیسی</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">شماره تلفن</th>
                    <th  style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">کد / شناسه ملی</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">لوگو</th>
                    <th  style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">عملیات</th>
                </tr>
                </thead>
                <tbody class="text-this-gray text-center">`
  myresult.forEach((row)=>{
     mhtml+= `<tr className="bg-zinc-100 border-b dark:bg-gray-800 ltr dark:border-gray-700 hover:bg-zinc-400 dark:hover:bg-gray-600">
<td>${row.cod}</td>
<td>${row.nam}</td>
<td>${row.ename}</td>
<td>${row.phone}</td>
<td>${row.shenase}</td>`
         if(!row.logo)mhtml+=`<td></td>`
         else
             mhtml+=`<td><img style="width:60px" src="${url('assets/images/customers/'+row.logo)}"></td>`

                 mhtml+=` <td align="center">
                                <button onclick="editCustomer('${row.cod}')" id="button_customers_edit_${row.cod}" type="button"
                                        class="text-yellow-700 font-medium rounded-full hover:animate-pulse
                                                     text-center me-5 mb-2 fa fa-edit"></button>
                                <button ${row.disabled} onclick="delCustomer('${row.cod}')" id="button_customers_del_${row.cod}" type="button"
                                        class="text-red-600 font-medium rounded-full hover:animate-pulse
                                                     text-center me-2 mb-2 fa fa-close"></button>
                        </tr>
</tr>
`
  })
        mhtml+=`</tbody>
            </table>
        </div>
        <script>

</script>
`
        Swal.fire({
            title: '',
            html:`<div class="bg-gradient w-100 h-100">
${mhtml}
</div>`,
            width:1300,
            showCloseButton: false,
            showConfirmButton:false,
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
                new DataTable("#customersTable", {
                    order: [[0, 'desc']],
                });

            },
            didClose:()=>{
                $('#name').focus()
            }
        })
    })

})
async function editCustomer(cusCod){
    Swal.close()
    $('#clearAllfields').removeClass('hidden')
    await $.ajax({
        url: window.location.href,
        method: "POST",
        data: {
            editCustomer: true,
            cusCod:cusCod
        }, dataType: "html"
    }).then(async (result) => {
        let mdata=JSON.parse(result)
        $('#editCustomers').val(1)
        $('#cusCode').val(mdata.cod)
        $('#name').val(mdata.nam)
        $('#eName').val(mdata.ename)
        $('#address').val(mdata.adres)
        $('#phone1').val(mdata.phone)
        $('#phone2').val(mdata.mobile)
        $('#email').val(mdata.email)
        $('#postCode').val(mdata.post)
        $('#identitiy').val(mdata.shenase)
        $('#fax').val(mdata.fax)
        $('#connector').val(mdata.gobetween)
        if(mdata.no==1)
            $('#cusType2').prop('checked',true)
            else
            $('#cusType1').prop('checked',true)
        $('#cusRole1').prop('checked',false)
        $('#cusRole2').prop('checked',false)
        if(mdata.cusrole==1)
        {
            $('#cusRole1').prop('checked',true)

        }
        else if(mdata.cusrole==2)
        {
            $('#cusRole2').prop('checked',false)
        }
        else if(mdata.cusrole==3)
        {
            $('#cusRole1').prop('checked',true)
            $('#cusRole2').prop('checked',true)
        }
    })
}
async function delCustomer(cusCod){
    Swal.fire({
        html: `<h3>آیا مطمئنید می خواهید مشتری ${cusCod} را حذف نمایید؟</h3>`,
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "بله",
        cancelButtonText: "خیر",
        showCancelButton: true,
        showCloseButton: true
    }).then(async (res) => {
        if (res.isConfirmed) {
            await $.ajax({
                url: window.location.href,
                method: "POST",
                data: {
                    delCustomer: true,
                    cusCod:cusCod
                }, dataType: "html"
            }).then(async (result) => {
                await ToastPro('کارفرما با موفقیت حذف شد!', 'top', 'success',1)
            })
        }
    })
}
$('#clearAllfields').on('click', async ()=>{
  location.reload()
})
$('input[type="text"]').on("keydown", function(e) {
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