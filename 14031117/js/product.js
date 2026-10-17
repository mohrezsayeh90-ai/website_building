
let tableA =$("#equipmentTableA");
let topElements = tableA[0].getBoundingClientRect().top;
tableA.css('height', `calc(100vh - ${topElements})`)



$(document).ready(() => {
    let body = $("body"), name = $("#proName"), code = $("#proCode");
    //let cnt = $(".colorful-counter")
    let  container = $("#productTable tbody");
    //cnt.text(container.find("tr").length);
    let table = $("#equipmentTable");


    let top = table[0].getBoundingClientRect().top;
    let mtequip=new DataTable('#equipmentTable', {
        paging:false,
        scrollCollapse: true,
        scrollY: `calc(100vh - ${top + 100}px)`,
        layout:{
            topStart: 'search',
            topEnd: 'info',
            bottomStart:''
        }
    })
    let mbody=$('#equipmentTable>tbody').html()
   // let allData=mtequip.data
       //alert(allData)
    $('#dt-search-0').addClass("ltr")
    //$('.dt-search').html().find('label').remove()
    //let template = $('.dt-search').html()
     //template=template.replaceAll('Search:','')
    $("#dt-search-0").attr("placeholder", "Search on equipments");
    $('.dt-search>label').remove()
    //$('.dt-search').html(template)
    let widthS=$('#dt-search-0').width()
    $('.dt-search').append(`<button style='margin-right: -${widthS}px;z-index:2' class="clearBut"><i  class='fa fa-close text-gray-200 hover:text-gray-700'></i></button>`)
    $(".clearBut").on('click',()=>{
        $('#dt-search-0').val('')
       // mtequip.data=[]
       // mtequip.data=allData
       //  $('#dt-search-0').focus()
       //  $('#dt-search-0').click()
       //  $('#dt-search-0').change()
       // mtequip.ajax.reload(null, false);
        $('#equipmentTable>tbody').html(mbody);
    })
    table.on('click', 'tbody tr', function () {
        // name.val($(this).find('td[aria-label=name]').text());
        // code.val($(this).find('td[aria-label=code]').text());
    })
    function showList(name, array, x, y) {
        $("#showingList").remove();
        body.append(`
        <select id="showingList" name=${name} class='position-absolute bg-light' style='top:${y}px;left:${x}px;z-index:999'>
        <option>-</option>${array}</select>`)
    }
    let upload = $("#proDoc");
    upload.on("click", function (ev){
        if(!code.val().length>0){
            ev.preventDefault();
            Swal.mixin({
                toast: true,
                position: 'top'
            }).fire({
                icon:'warning', text:'محصولی ایجاد یا انتخاب کنید!',
                confirmButtonText:'باشه!'
            })
        }
    })
    upload.on("change", async function () {
        let form_Data = new FormData;
        if(code.val().length>0){
            for (let i = 0; i < this.files.length; i++) {
                form_Data.append("files[]", this.files[i]);
            }
            form_Data.append("code", code.val());
            $.ajax({
                url: url("product/upload"), // Upload Script
                dataType: 'script',
                cache: false,
                contentType: false,//necessary for multiple data formats
                processData: false,//necessary for multiple data formats
                data: form_Data,
                type: 'POST',
                success: function (res) {
                    if (JSON.parse(res).length > 0)
                        Swal.mixin({
                            toast: true,
                            position: 'top',
                            showConfirmButton: false,
                            timer: 2000
                        }).fire({
                            icon: JSON.parse(res)[1],
                            text: JSON.parse(res)[0]
                        });
                }
            })
        }
    })
    //////****** product name
    name.on('keyup', async (ev) => {
        $("#showingList").remove();
        let xy = ev.target.getBoundingClientRect()
        let inp = $(ev.target);
        if (ev.which === 13) {
            if(code.val().length>0){//////edit
                await get(url('product/setName/'), {name: inp.val(), code:code.val()})
            }else {//create
                let pro = await get(url('product/setName/'), {name: inp.val()}), json = JSON.parse(pro);
                $("#proCode").val(json.code)
            }
        } else {/// for search
            let pros = await get(url('product/getNames/'), {text: inp.val()}), json = JSON.parse(pros);
            //console.log(pros)
            if ($.isArray(json) && json.length > 0) {
                let arr = ``
                json.forEach(j => {
                    arr += `<option value="${j.code}">${j.name}</option>`
                })
                showList('productName', arr, xy.left, xy.bottom);
            }
        }
    })

    body.on('change', "[name=productName]", async function () {
        name.val($(this).find('option:selected').text());
        code.val($(this).val());
        let rows = ``
        let details = await post(url('product/getDetails'), {code: $(this).val()}), json = JSON.parse(details);
        //console.log(details)
        if ($.isArray(json) && json.length > 0) {
            json.forEach((j,i) => {
                rows +=`<tr><td>${i+1}</td><td><input type="text" name="description" autocomplete="off" value="${j.description}"
                                        class="rounded font-small p-1 w-90"></td>
        <td><textarea type="text" rows="1" class="rounded font-small p-1 w-90" name="type">${j.type}</textarea></td>
        <td><input type="text" name="manufacturer" autocomplete="off" value="${j.manufacturer}"
                                        class="rounded font-small p-1 w-90"></td>
        <td> <i class="bi bi-check2-square font-large i-hover-color"></i></td></tr>`
            })
        }
        //console.log(rows)
        container.html(rows)
        cnt.text(json.length)
        $(this).remove();
    })
    //////****** product name
    $(".bi-plus-circle").on("click", function () {
       container.append(`<tr><td>${container.find("tr").length +1}</td><td><input type="text" id="description" name="description" autocomplete="off"
                                        class="rounded font-small p-1 w-90"></td>
        <td><textarea type="text" class="rounded font-small p-1 w-90" id="type" name="type"></textarea></td>
        <td><input type="text" id="manufacturer" name="manufacturer" autocomplete="off"
                                        class="rounded font-small p-1 w-90"></td>
        <td> <i class="bi bi-check2-square font-large i-hover-color"></i></td></tr>`)
        cnt.text(container.find("tr").length);
    })
    //////****** product elements
    let desc = $("[name=description]"), type = $("[name=type]"), manufacturer = $("[name=manufacturer]");
    body.on('keyup', "[name=description]", async (ev) => {/////change on description
        $("#showingList").remove();
        let xy = ev.target.getBoundingClientRect()
        let inp = $(ev.target);
        if (inp.val().length > 0) {
            let pros = await get(url('product/searchDetails/'), {text: inp.val()}), json = JSON.parse(pros);
            //console.log(pros)
            if ($.isArray(json) && json.length > 0) {
                let arr = ``
                json.forEach(j => {
                    arr += `<option data-id="${j.type}" value="${j.manufacturer}">${j.description}</option>`
                })
                showList('productDetail', arr, xy.left, xy.bottom);
                fillTheRow(inp)
            }
        }
    })

    function fillTheRow(elem) {
        body.on('change', "[name=productDetail]", function () {
            let selected = $(this).find('option:selected');
            elem.val(selected.text());
            let type = elem.parents('tr').find("[name=type]"),
                producer = elem.parents('tr').find("[name=manufacturer]");
            type.val('');
            producer.val('');
            type.val(selected.attr("data-id"));
            producer.val(selected.val());
            $(this).remove();
        })
    }

    /////change on type
    body.on('keyup', "[name=type]", async (ev) => {
        $("#showingList").remove();
        let xy = ev.target.getBoundingClientRect()
        let inp = $(ev.target);
        if (inp.val().length > 0) {
            let pros = await get(url('product/searchTypes/'), {text: inp.val()}), json = JSON.parse(pros);
            //console.log(pros)
            if ($.isArray(json) && json.length > 0) {
                let arr = ``
                json.forEach(j => {
                    arr += `<option value="${j.type}">${j.type}</option>`
                })
                showList('productType', arr, xy.left, xy.bottom);
                fillTheInput(inp, 'productType')
            }
        }
    })

    function fillTheInput(elem, name) {
        body.on('change', `[name=${name}]`, function () {
            let selected = $(this).find('option:selected');
            elem.val(selected.text());
            $(this).remove();
        })
    }

    /////change on type
    /////change on manufacturer
    body.on('keyup', "[name=manufacturer]", async (ev) => {
        $("#showingList").remove();
        let xy = ev.target.getBoundingClientRect()
        let inp = $(ev.target);
        if (inp.val().length > 0) {
            let pros = await get(url('product/searchProducers/'), {text: inp.val()}), json = JSON.parse(pros);
            //console.log(pros)
            if ($.isArray(json) && json.length > 0) {
                let arr = ``
                json.forEach(j => {
                    arr += `<option value="${j.manufacturer}">${j.manufacturer}</option>`
                })
                showList('productManufacturer', arr, xy.left, xy.bottom);
                fillTheInput(inp, 'productManufacturer')
            }
        }
    })
    /////change on manufacturer

    ///*** submit row
    body.on("click", '.bi-check2-square', async function () {
        let id = $(this).parents('.row:eq(0)').attr('id'),
            type = $(this).parents('.row:eq(0)').find("[name=type]"),
            producer = $(this).parents('.row:eq(0)').find("[name=manufacturer]"),
            desc = $(this).parents('.row:eq(0)').find("[name=description]");
        if (name.val().length === 0 || code.val().length === 0) {
            Swal.fire({
                icon: 'warning', text: 'محصول را انتخاب کنید', confirmButtonText: 'باشه!'
            })
        } else if (desc.val().length === 0) {
            Swal.fire({
                icon: 'warning', text: 'توصیف محصول نمی تواند خالی باشد!', confirmButtonText: 'باشه!'
            })
        } else {
            if (id) {
                let details = await post(url('product/details'), {
                    desc: desc.val(), type: type.val(), company: producer.val(), code: code.val(), id: id.split("_")[1]
                });
                console.log(details)
            } else {
                let details = await post(url('product/details'), {
                    desc: desc.val(), type: type.val(), company: producer.val(), code: code.val()
                });
                console.log(details)
            }
        }
    })

})
async function addItems(item){
   // alert(item)
    if($('#proCode').val()=='' || $('#proName').val()=='')
    {
        await  ToastPro('کد یا نام محصول مشخص نیست!','top','error',0)
        return
    }
    let retcod=0

    $("#equipmentTableA>tbody>tr").each(async  (key,trm)=>{
       if(trm.id==item.replaceAll(' ','').replaceAll(',','').replaceAll('.',''))
       {
           retcod=1
           await  ToastPro('در لیست موجود است!','top','error',0)
           return
       }
    })

    if(retcod==1)return
let html=` <tr id="${item.replaceAll(' ','').replaceAll(',','').replaceAll('.','')}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <td class="text-left p-2">${item}</td>
                    <td class="fa fa-minus-square ml-5"  onclick="removeItems('${item}')"></td>
                    </tr>`
if($("#equipmentTableA>tbody").html().includes('No data available in table'))
    $("#equipmentTableA>tbody").html(html)
else
    $("#equipmentTableA>tbody").html($("#equipmentTableA>tbody").html()+html)
    // $('#equipmentTableA').dataTable().fnClearTable();
    // $('#equipmentTableA').dataTable().fnDestroy();


}
async function removeItems(item){
$(`#${item.replaceAll(' ','').replaceAll(',','').replaceAll('.','')}`).remove()
}


$('#prodSave').on('click',async()=> {
    Swal.fire({
        html: `<h3>داده ها ذخیره شوند؟</h3>`,
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "بله",
        cancelButtonText: "خیر",
        showCancelButton: true,
        showCloseButton: true
    }).then(async (res) => {
        let eq = ''
        if(res.isConfirmed) {
            $("#equipmentTableA>tbody>tr>td").each(async (key, tdm) => {
                if (tdm.innerText) eq += '_;;;_' + tdm.innerText
            })
            if (eq == '') {
                await ToastPro('هیچ موردی به محصول اضافه نکر ده اید', 'top', 'warning')
                return
            }
            $('#assignData').val(eq)

            await ToastPro('اطلاعات با موفقیت ذخیره شد!', 'top', 'success', 1)
            $('#mainprodForm').submit()
        }
    })


})



$('#productsList').on('click',async ()=>{
    if(!$('#clearAllfieldsP').hasClass('hidden'))return
    await $.ajax({
        url: window.location.href,
        method: "POST",
        data: {
            getallproducts:true
        }, dataType: "html"
    }).then(async (result) => {
       // console.log(result)
        if(!result)return
        let myresult=JSON.parse(result)
        let mhtml=`<div  class="container text-sm">
<p class="text-center text-xl font-extrabold">فهرست محصولات</p>
            <table class=" display compact  "
                   id="productsTable">
                <thead class="text-white uppercase dark:bg-gray-700 dark:text-gray-400 bg-this-teal">
                <tr>
<!--                    <th scope="col" class="pr-6 pl-1 py-3 text-end">Date</th>-->
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3">کد محصول</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">نام محصول</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">مدل</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">لوگو</th>
                    <th  style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">عملیات</th>
                </tr>
                </thead>
                <tbody class="text-this-gray text-center">`
        myresult.forEach((row)=>{
            mhtml+= `<tr className="bg-zinc-100 border-b dark:bg-gray-800 ltr dark:border-gray-700 hover:bg-zinc-400 dark:hover:bg-gray-600">
<td>${row.code}</td>
<td>${row.name}</td>
<td>${row.type1}</td>
`
            if(!row.logo)mhtml+=`<td></td>`
            else
                mhtml+=`<td><img style="width:60px" src="${url('assets/images/products/'+row.logo)}"></td>`

            mhtml+=` <td align="center">
                                <button onclick="editProduct('${row.code}')" id="button_products_edit_${row.code}" type="button"
                                        class="text-yellow-700 font-medium rounded-full hover:animate-pulse
                                                     text-center me-5 mb-2 fa fa-edit"
                                                               >
                                                               <button onclick="duplicateProduct('${row.code}')" title="ایجاد محصول مشابه" id="button_products_edit_${row.code}" type="button"
                                        class="text-yellow-700 font-medium rounded-full hover:animate-pulse
                                                     text-center me-5 mb-2 fa fa-copy"
                                                               >

                                </button>
                                <button ${row.disabled} onclick="delProduct('${row.code}')" id="button_products_del_${row.code}" type="button"
                                        class="text-red-600 font-medium rounded-full hover:animate-pulse
                                                     text-center me-2 mb-2 fa fa-close">

                                </button>
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
            width:900,
            showCloseButton: true,
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
                new DataTable("#productsTable", {
                    order: [[0, 'desc']],


                });

            },
            didClose:()=>{
                $('#proName').focus()
            }
        })
    })

})
async function delProduct(prdCod){
    Swal.fire({
        html: `<h3>آیا مطمئنید می خواهید محصول ${prdCod} را حذف نمایید؟</h3>`,
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
                    delProduct: true,
                    prdCod:prdCod
                }, dataType: "html"
            }).then(async (result) => {
                await ToastPro('محصول با موفقیت حذف شد!', 'top', 'success',1)
            })
        }
    })
}
async function duplicateProduct(prdCod){
    Swal.fire({
        html: `<h3>آیا مطمئنید می خواهید یک کپی از محصول ${prdCod} را ایجاد نمایید؟</h3>`,
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "بله",
        cancelButtonText: "خیر",
        showCancelButton: true,
        showCloseButton: true
    }).then(async (res) => {
        if (res.isConfirmed) {
            await $.ajax({
                url: url('product/duplicate'),
                method: "POST",
                data: {

                    prdCod:prdCod
                }, dataType: "html"
            }).then(async (result) => {
                await ToastPro('محصول مشابه با موفقیت ایجاد شد!', 'top', 'success',1)
            })
        }
    })
}
async function editProduct(prdCod){
    Swal.close()
    $('#clearAllfieldsP').removeClass('hidden')

    await $.ajax({
        url: window.location.href,
        method: "POST",
        data: {
            editProduct: true,
            prdCod:prdCod
        }, dataType: "html"
    }).then(async (result) => {
        let mdata=JSON.parse(result)
//console.log(mdata)
        $('#proCode').val(mdata[0].code)
        $('#proName').val(mdata[0].name)
        $('#proVolt').val(mdata[0].voltage)
        $('#proAmp').val(mdata[0].crnt)
        $('#proModel').val(mdata[0].type1)
        $('#proType').val(mdata[0].type2)

        let html=``
        //console.log(mdata[1])
        mdata[1].forEach((er)=>{
        html+=` <tr id="${er.description.replaceAll(' ','').replaceAll(',','').replaceAll('.','')}" 
 class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
<td class="text-left p-2">${er.description}</td>\n' +
                                <td class="fa fa-minus-square ml-5"  onclick="removeItems('${er.description}')"></td></tr>`
    })



        $("#equipmentTableA>tbody").html(html)
    })
}

$('#clearAllfieldsP').on('click', ()=>{
    location.reload()
})
