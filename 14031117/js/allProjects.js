Dropzone.autoDiscover = false;
let mainTable
$(document).ready( ()=>{

    new DataTable("#myDPL", {
        order: [1, 'desc'],
        paging: false,

    });
    new DataTable("#myDPL1", {
        order: [1, 'desc'],
        paging: false,

    });
        mainTable=$('#myDPL').DataTable()
        $('.dt-search input')
            .off()
            .on('keyup', function () {
                //console.log(1)
                if (this.value == "") {
                    $("#myDPL>tbody>tr").each(function () {
                        $(this).show()
                    })
                }
                else {
                    let tmp = this.value.split("+").map(function (item) {
                        return item.trim();
                    });

                    $("#myDPL>tbody>tr").each(function () {
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
            })


    $('#myDPL').css('width','100%')
    $('#myDPL1').css('width','100%')

})

let trig = $("#divTrigger"),  div=$("#divTriggerTarget");
trig.on("click",async function (){
    div.show()
    let request =await $.ajax({
        url:  url('prjman/getCurrentProj'),
        method: "POST",

    }).done(async function(posts) {
        if(posts){
            let projs=JSON.parse(posts)
           // console.log(projs)
            let dddd=new Date()
            dddd.setHours(0,0,0,0)

            let   markers= [

                {
                    value: [new Date(), new Date(dddd.getTime() + 30*3600000)],
                    color: ['orange', 0.5],
                    label_text: 'امروز'
                }
            ]
            let mypoint={
                value:[],
                color:[getRandomColor() ,0.4],
                label_text:''
            }
            var series=[];
            var points=[]
            if(projs.length==0)return
            for(let j=0;j<projs.length;j++)
            {
                //alert(projs[j].f6)
                let color=[getRandomColor() ,0.4]
                //if(projs[j].f0==56)color='green'

                points.push({
                    name:projs[j].proj_name,
                    y:[getdate(projs[j].startDate),getdate(projs[j].endDate)],
                    attributes: {
                        hour1: getdate(projs[j].startDate),
                        hour2: getdate(projs[j].endDate),
                    },
                    z:projs[j].proj_name,
                    color:color
                })
                series.push({
                    name:projs[j].proj_name,
                    points:points
                })
                //if(projs[j].f0==56)color='green'

                points.push({
                    name:projs[j].proj_name+'-واقعی',
                    y:[getdate(projs[j].startDate),getdate(projs[j].realPos)],
                    attributes: {
                        hour1: getdate(projs[j].startDate),
                        hour2: getdate(projs[j].realPos),
                    },
                    z:projs[j].proj_name+'-واقعی',
                    color:'#04ee04'
                })
                series.push({
                    name:projs[j].proj_name+'-واقعی',
                    points:points
                })

            }
            setTimeout(()=>{
                makeGantt2('projectManager',series,'Planner',markers)
            },2000)



        }

    })
})
$("#closeDivTrigger").on("click", function (){
    div.hide()
})
$(document).on('keydown',(ev)=>{
    if (ev.keyCode == 27) {
      let  div=$("#divTriggerTarget");
        div.hide()
    }
})

async function assignTender(prjCode){

    await $.ajax({
        url: url('prjman/getAllowedTenders'),
        method: "POST",
        dataType: "html"
    }).then(async (result) => {
        if(!result)return
        let myresult=JSON.parse(result)
        let mhtml=`<h4>لطفا از فهرست زیر مناقصه مرتبط را انتخاب نمایید</h4><div  class="container text-sm">
            <table class=" display compact  "
                   id="mtenderTable">
                <thead class="text-white uppercase dark:bg-gray-700 dark:text-gray-400 bg-this-teal">
                <tr>
<!--                    <th scope="col" class="pr-6 pl-1 py-3 text-end">Date</th>-->
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3">کد مناقصه</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">موضوع مناقصه</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">تاریخ تکمیل</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">کارفرما</th>
                  
                    <th  style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">عملیات</th>
                </tr>
                </thead>
                <tbody class="text-this-gray text-center">`
        myresult.forEach((row)=>{
            mhtml+= `<tr className="bg-zinc-100 border-b dark:bg-gray-800 ltr dark:border-gray-700 hover:bg-zinc-400 dark:hover:bg-gray-600">
<td>${row.code}</td>
<td>${row.name}</td>
<td dir="ltr">${row.completiondate}</td>
`
            mhtml+=`<td>${row.nam}</td>`

            mhtml+=` <td align="center">
                                <button onclick="asignTender('${prjCode}','${row.code}')"  type="button"
                                        class="text-yellow-700 font-medium rounded-full
                                                     text-center me-5 mt-1 fa fa-check fa-xl hover:scale-150">

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
            width:1200,
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
                new DataTable("#mtenderTable", {
                    order: [[0, 'desc']],


                });

            },
            didClose:()=>{
                $('#projectName').focus()
            }
        })
    })

}
async function asignTender(prjCode,tenderCode) {
   // alert(prjCode)
    //alert(tenderCode)
    Swal.fire({
        html: `<h3>آیا قصد دارید اطلاعات مناقصه ${tenderCode} در پروژه ${prjCode} استخراج شود؟</h3>`,
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "بله",
        cancelButtonText: "خیر",
        showCancelButton: true,
        showCloseButton: true
    }).then(async (res) => {
        await $.ajax({
            url: url('prjman/extractTenderData'),
            method: "POST",
            data: {
                projcode: prjCode,
                tenderCode: tenderCode},
            dataType: "html"
        }).then(async (result) => {
            if (!result) return
            await ToastPro('داده ها با موفقیت استخراج شدند!', 'top', 'success',1)
        })
    })
}
async function openDocContainer(prjCode,prjName){

    await $.ajax({
        url: url('prjman/getProjectAttachment'),
        method: "POST",
        data: {
            prjCod:prjCode
        }, dataType: "html"
    }).then(async (result) => {
        let myresult=JSON.parse(result)
        let mhtml=`<div  class="container text-sm">
            <table class=" display compact  "
                   id="productsTable">
                <thead class="text-white uppercase dark:bg-gray-700 dark:text-gray-400 bg-this-teal">
                <tr>
<!--                    <th scope="col" class="pr-6 pl-1 py-3 text-end">Date</th>-->
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3">شناسه سند</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">نام سند</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">تاریخ اضافه شدن</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">پیش نمایش</th>
                    <th  style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">عملیات</th>
                </tr>
                </thead>
                <tbody class="text-this-gray text-center">`
        myresult.forEach((row)=>{
            mhtml+= `<tr className="bg-zinc-100 border-b dark:bg-gray-800 ltr dark:border-gray-700 hover:bg-zinc-400 dark:hover:bg-gray-600">
<td style="text-align: center !important">${row.id}</td>
<td class="ltr">${row.attachment_name}</td>
<td dir="ltr" style="text-align: center !important">${row.date}</td>
`
            if(!row.attachment_file)mhtml+=`<td></td>`
            else if(row.attachment_file.toLowerCase().endsWith('.jpg') || row.attachment_file.toLowerCase().endsWith('.png') || row.attachment_file.toLowerCase().endsWith('.bmp')
            || row.attachment_file.toLowerCase().endsWith('.tiff'))
                mhtml+=`<td class="cursor-pointer" onclick="window.open('${url('assets/images/projects/'+row.attachment_file)}','_blank')" style="text-align: center !important">
<img style="width:60px;margin: auto" src="${url('assets/images/projects/'+row.attachment_file)}"></td>`
            else if(row.attachment_file.toLowerCase().endsWith('.pdf'))
                mhtml+=`<td class="cursor-pointer" onclick="window.open('${url('assets/images/projects/'+row.attachment_file)}','_blank')" style="text-align: center !important"><embed style="height:90px;width:130px;margin: auto" src="${url('assets/images/projects/'+row.attachment_file)}"/></td>`
            else
                mhtml+=`<td onclick="window.open('${url('assets/images/projects/'+row.attachment_file)}','_blank')" style="text-align: center !important" class="text-3xl cursor-pointer">
                <i class="fa fa-file-text fa-3x"></i></td>`
            mhtml+=` <td align="center">
                                <button onclick="delDocs('${row.id}')" id="button_products_edit_${row.id}" type="button"
                                        class="text-yellow-700 font-medium rounded-full hover:scale-150
                                                     text-center me-5 mb-2 fa fa-close">
                                </button>
                          
                        </td>
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
            title: 'اسناد پروژه-'+prjName,
            html:`<div class="bg-gradient w-100 h-100">
${mhtml}
</div>`,
            width:900,
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
                new DataTable("#productsTable", {
                    order: [[0, 'desc']],


                });

            },
            didClose:()=>{
                $('#proName').focus()
            }
        })
    })
}
async function delDocs(id)
{
    Swal.fire({
        icon: 'question',
        text: `آیا از حذف سند ${id} اطمینان کامل دارید؟`,
        showCancelButton: true,
        cancelButtonText: "انصراف",
        confirmButtonText: "تایید",
        question:'؟'
        }).then(async (result) => {
        if (result.isConfirmed && result.value) {
            await $.ajax({
                url: url('prjman/delDocs'),
                method: "POST",
                data: {

                    id:id
                }
            }).then(async result=> {
                await  ToastPro('سند با موفقیت حذف شد!','top','success',1)
            })

        }
    })
}
async function showProjectLOG(prjCode,prjName){

    await $.ajax({
        url: url('prjman/showProjectLOG'),
        method: "POST",
        data: {
            prjCod:prjCode
        }, dataType: "html"
    }).then(async (result) => {

        let myresult
            if(result)myresult=JSON.parse(result)
        let mhtml=`<div  class="container text-sm">
            <table class=" display compact  "
                   id="productsTable">
                <thead class="text-white uppercase dark:bg-gray-700 dark:text-gray-400 bg-this-teal">
                <tr>
<!--                    <th scope="col" class="pr-6 pl-1 py-3 text-end">Date</th>-->
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3">شناسه واقعه</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">کد فرآیند</th>
                    
                   <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">شرح فعالیت</th>
                   <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">مجری</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">کد کاربر</th>
                    <th  style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">آدرس رایانه</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">تاریخ</th>
                   
                </tr>
                </thead>
                <tbody class="text-this-gray text-center">`
        myresult.forEach((row)=>{
            mhtml+= `<tr className="bg-zinc-100 border-b dark:bg-gray-800 ltr dark:border-gray-700 hover:bg-zinc-400 dark:hover:bg-gray-600">
<td style="text-align: center !important">${row.id}</td>
<td class="ltr">${row.process_step_id}</td>
<td class="rtl">${row.log_descriptions}</td>
<td class="ltr">${row.projects_members}</td>
<td class="ltr">${row.user_id}</td>
<td class="ltr">${row.host}</td>
<td class="ltr">${row.date}</td>


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
            title: 'فهرست وقایع پروژه-'+prjName,
            html:`<div class="bg-gradient w-100 h-100">
${mhtml}
</div>`,
            width:1200,
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
                new DataTable("#productsTable", {
                    order: [[0, 'desc']],


                });

            },
            didClose:()=>{
                $('#proName').focus()
            }
        })
    })
}
async function closePrj(p,k){

    if(parseFloat($(`#prjprg_${k}`).html().replaceAll('%',''))<100)
         await  ToastPro('پروژه هنوز تکمیل نشده است!','top','info')
    Swal.fire({
        icon: 'question',
        text: `آیا از بستن این پروژه مطمئن هستید؟`,
        iconHtml: "؟",
        showCancelButton: true,
        cancelButtonText: "انصراف",
        confirmButtonText: "تایید",
        question:'؟'
    }).then(async (result) => {
        if (result.isConfirmed && result.value) {
            await $.ajax({
                url: url('prjman/closeprj'),
                method: "POST",
                data: {
                    p:p
                }
            }).then(async result=> {
                await  ToastPro('پروژه با موفقیت بسته شد!','top','success',1)
            })

        }
    })
}
