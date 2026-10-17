let cuscod=''
let consultcod=''
$(document).ready(() => {
    jalaliDatepicker.startWatch();
//     let firstTab =  $("#styled-identity")
//     firstTab.show()
//     let scroll1 = $(".scroll1").parents('div:eq(0)')
//     if (scroll1.length > 0) {
//         let top1 = scroll1[0].getBoundingClientRect().top ;
//         scroll1.height(`calc(100vh - ${top1 + 10}px)`)
//     }
//     $("#addRisk").on('click', () => {
//         let len = $("#problemsTable tbody tr").length;
//         $("#problemsTable tbody").append(`
//       <tr class="bg-zinc-300">
//                                 <td class="p-1 pr-2 border border-white">${len + 1}</td>
//                                 <td class="p-1 pr-2 border border-white">
//                                    <textarea class="w-full bg-transparent border-0 focus:border focus:border focus:border-teal-500 focus:ring-2 focus:ring-teal-400" rows="1"></textarea>
//                                 </td>
//                                 <td class="p-1 pr-2 border border-white">
//                                    <textarea class="w-full bg-transparent border-0 focus:border focus:border focus:border-teal-500 focus:ring-2 focus:ring-teal-400"  rows="1" parent"></textarea>
//                                 </td>
//                                 <td class="p-1 pr-2 border border-white">
//                                   <textarea class="w-full bg-transparent border-0 focus:border focus:border focus:border-teal-500 focus:ring-2 focus:ring-teal-400" rows="1"></textarea>
//                                 </td>
//                                 <td class="p-1 pr-2 border border-white">
//                                     <textarea class="w-full bg-transparent border-0 focus:border focus:border-teal-500 focus:ring-2 focus:ring-teal-400" rows="1"></textarea>
//                                 </td>
//                             </tr>`)
//     })
//     hided($("#EPL-styled-tab"))
//     hided($("#DPL-styled-tab"))
//     shown($("#identity-styled-tab"))
// function hided(elem){
//         elem.on("click", function (){
//             firstTab.hide()
//         })
// }
//     function shown(elem){
//         elem.on("click", function (){
//             firstTab.show()
//         })
//     }
//     let list_items = $(".list-items");
//     let top11 = list_items[0].getBoundingClientRect().top ;
//     list_items.height(`calc(100vh - ${top11}px)`)
//     // let main_div = $(".main-part")
//     // if (main_div.length > 0) {
//     //     let top2 = main_div[0].getBoundingClientRect().top;
//     //     main_div.height(`calc(100vh - ${top2}px)`)
//     //     console.log(top2)
//     // }
})

let currentinput
$('#customer').on('keyup', (ev)=> {
    currentinput=ev.target.id
    if($('#list00').hasClass('hidden')){
        $('#list00').removeClass('hidden')
        $('#list00').css('top',$('#customer').offset().top-30)
        $('#list00').css('left',$('#customer').offset().left+$('#customer').width()-250)
    }
    $("#list00>ul>li").each(function(index, element){
        //console.log($(element).click());
        $(element).show()
        if(!$(element).html().toLowerCase().includes(ev.target.value.toLowerCase()))
        {
            $(element).hide()
        }
    })
})

$("#list00>ul>li").on('click',(ev)=>{

    $(`#${currentinput}`).focus()

    $(`#${currentinput}`).val(ev.currentTarget.textContent)
    if(currentinput=='customer')
    cuscod=ev.currentTarget.ariaLabel
    else {
        consultcod = ev.currentTarget.ariaLabel
    $('#contactCon').val(ev.currentTarget.title)
    }
    //alert(cuscod)
    $('#list00').addClass('hidden')

})
$('#consultant').on('keyup', (ev)=> {
    currentinput=ev.target.id
    if($('#list00').hasClass('hidden')){
        $('#list00').removeClass('hidden')
        $('#list00').css('top',$('#consultant').offset().top-30)
        $('#list00').css('left',$('#consultant').offset().left+$('#consultant').width()-250)
    }
    $("#list00>ul>li").each(function(index, element){
        //console.log($(element).click());
        $(element).show()
        if(!$(element).html().toLowerCase().includes(ev.target.value.toLowerCase()))
        {
            $(element).hide()
        }
    })
})
$('input').on("keydown", function(e) {
    /* ENTER PRESSED*/
    // alert(e.which)
    if (e.keyCode == 13) {
        /* FOCUS ELEMENT */
        let inputs = $(this).parents().parent().parent().eq(0).find("input");
        let idx = inputs.index(this);

        if (idx == inputs.length - 1) {
            inputs[0].select()
        } else {
            inputs[idx + 1].focus(); //  handles submit buttons
            inputs[idx + 1].select();
        }

        return false;
    }
    // else if(e.which == 119)
    // {
    //     try
    //     {
    //         let text=$(`#${currenttext}`).val()
    //         if(selstart!=null && selend!=null) {
    //             let text1 = text.substring(0, selstart) + "\n"
    //             let text2 = text.substring(selend, text.length)
    //             // console.log(text)
    //             // console.log(text1)
    //             // console.log(text2)
    //             $(`#${currenttext}`).val(text1 + text2)
    //         }
    //     }
    //     catch (e) {
    //         console.log(e)
    //     }
    //
    // }

});
$(document).on('keydown',(ev)=>{
    if (ev.keyCode == 27) {

        if(!$(`#list00`).hasClass('hidden'))
        {
            $(`#list00`).addClass('hidden')
        }
    }
})
$("input").on('focus',(e)=>{
    if(e.target.id!='customer' && e.target.id!='consultant' && !$('#list00').hasClass('hidden'))
    {
        $('#list00').addClass('hidden')
    }
    if(e.target.id!='startDate')
    {
        if($('jdp-container').css('display')=='block')
        {

            $('jdp-container').css('display','none')
        }
    }
})

$("#submitKoli").on('click',async ()=>{
    if($('#projectName').val()=='')
    {
        $('#projectName').focus()
        let bgcol= $('#projectName').css('background')
        $('#projectName').css('background','orange')
        setTimeout(()=>$('#projectName').css('background', bgcol),1000)
        await ToastPro('موارد ستاره دار باید حتما پر شوند','top','error')

        return
    }
    if($('#manager').val()=='')
    {
        $('#manager').focus()
        let bgcol= $('#manager').css('background')
        $('#manager').css('background','orange')
        setTimeout(()=>$('#manager').css('background', bgcol),1000)
        await ToastPro('موارد ستاره دار باید حتما پر شوند','top','error')

        return
    }
    if($('#startDate').val()=='')
    {
        $('#startDate').focus()
        let bgcol= $('#startDate').css('background')
        $('#startDate').css('background','orange')
        setTimeout(()=>$('#startDate').css('background', bgcol),1000)
        await ToastPro('موارد ستاره دار باید حتما پر شوند','top','error')

        return
    }
    if($('#location').val()=='')
    {
        $('#location').focus()
        let bgcol= $('#location').css('background')
        $('#location').css('background','orange')
        setTimeout(()=>$('#location').css('background', bgcol),1000)
        await ToastPro('موارد ستاره دار باید حتما پر شوند','top','error')

        return
    }
    if($('#duration').val()=='')
    {
        $('#duration').focus()
        let bgcol= $('#duration').css('background')
        $('#duration').css('background','orange')
        setTimeout(()=>$('#duration').css('background', bgcol),1000)
        await ToastPro('موارد ستاره دار باید حتما پر شوند','top','error')

        return
    }
    if($('#insurance').val()=='')
    {
        $('#insurance').focus()
        let bgcol= $('#insurance').css('background')
        $('#insurance').css('background','orange')
        setTimeout(()=>$('#insurance').css('background', bgcol),1000)
        await ToastPro('موارد ستاره دار باید حتما پر شوند','top','error')

        return
    }
    if($('#customer').val()=='')
    {
        $('#customer').focus()
        let bgcol= $('#customer').css('background')
        $('#customer').css('background','orange')
        setTimeout(()=>$('#customer').css('background', bgcol),1000)
        await ToastPro('موارد ستاره دار باید حتما پر شوند','top','error')

        return
    }
    if($('#operator').val()=='')
    {
        $('#operator').focus()
        let bgcol= $('#operator').css('background')
        $('#operator').css('background','orange')
        setTimeout(()=>$('#operator').css('background', bgcol),1000)
        await ToastPro('موارد ستاره دار باید حتما پر شوند','top','error')

        return
    }
    if($('#consultant').val()=='')
    {
        $('#consultant').focus()
        let bgcol= $('#consultant').css('background')
        $('#consultant').css('background','orange')
        setTimeout(()=>$('#consultant').css('background', bgcol),1000)
        await ToastPro('موارد ستاره دار باید حتما پر شوند','top','error')

        return
    }
    Swal.fire({
        html: `<h3>داده ها ذخیره شوند؟</h3>`,
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "بله",
        cancelButtonText: "خیر",
        showCancelButton: true,
        showCloseButton: true
    }).then(async (res) => {
        if(res.isConfirmed) {
            $("#cuscod").val(cuscod)
            $('#consulcod').val(consultcod)
            await ToastPro('پروژه با موفقیت ذخیره شد', 'top', 'success')
            $('#mainProjForm').submit()
        }
    })
})


$('#projectList').on('click',async ()=>{
    if(!$('#clearAllfieldsProj').hasClass('hidden'))return
    await $.ajax({
        url: url('project/getAllProjects'),
        method: "POST",
        data: {
            getallprojects:true
        }, dataType: "html"
    }).then(async (result) => {
        if(!result)return
        let myresult=JSON.parse(result)
        let mhtml=`<div  class="container text-sm">
            <table class=" display compact  "
                   id="projectsTable">
                <thead class="text-white uppercase dark:bg-gray-700 dark:text-gray-400 bg-this-teal">
                <tr>
<!--                    <th scope="col" class="pr-6 pl-1 py-3 text-end">Date</th>-->
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3">کد قرارداد</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">موضوع پروژه</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">تاریخ شروع</th>
                    <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">مجری کارفرما</th>
                     <th style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">مدیر پروژه</th>
                    <th  style="text-align: center !important" scope="col" class="pr-6 pl-1 py-3 text-end">عملیات</th>
                </tr>
                </thead>
                <tbody class="text-this-gray text-center">`
        myresult.forEach((row)=>{
            mhtml+= `<tr className="bg-zinc-100 border-b dark:bg-gray-800 ltr dark:border-gray-700 hover:bg-zinc-400 dark:hover:bg-gray-600">
<td>${row.proj_code}</td>
<td>${row.proj_name}</td>
<td>${row.proj_start_date}</td>
`
            mhtml+=`<td>${row.proj_executer}</td>`
            mhtml+=`<td>${row.proj_manager}</td>`
            mhtml+=` <td align="center">
                                <button onclick="editProject('${row.proj_code}')" id="button_prodject_edit_${row.proj_code}" type="button"
                                        class="text-yellow-700 font-medium rounded-full hover:animate-pulse
                                                     text-center me-5 mb-2 fa fa-edit"
                                                               >

                                </button>
                                <button onclick="delProject('${row.proj_code}')" id="button_prodject_del_${row.proj_code}" type="button"
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
                new DataTable("#projectsTable", {
                    order: [[0, 'desc']],


                });

            },
            didClose:()=>{
                $('#projectName').focus()
            }
        })
    })

})
async function editProject(projCod){
    $('#projectList').css('display','none')
    Swal.close()
    $('#clearAllfieldsProj').removeClass('hidden')
    await $.ajax({
        url: url('project/getaprojectdata'),
        method: "POST",
        data: {
            projCod:projCod
        }, dataType: "html"
    }).then(async (result) => {
        if (!result) {
            $('#clearAllfieldsProj').addClass('hidden')
            $('#projectList').css('display', 'block')
        }
        let data=JSON.parse(result)

        $('#projectName').val(data[0].proj_name);
        $('#contract').val(data[0].proj_code);
        $('#manager').val(data[0].proj_manager);
        $('#contact').val(data[0].proj_manager_email);
        $('#startDate').val(data[0].proj_start_date);
        $('#location').val(data[0].proj_delivery_place);
        $('#duration').val(data[0].proj_duration);
        $('#insurance').val(data[0].project_warranty_duration);
        $('#cuscod').val(data[0].proj_customer);
        cuscod=data[0].proj_customer
        $('#consulcod').val(data[0].proj_consultant);
        consultcod=data[0].proj_consultant
        $('#operator').val(data[0].proj_executer);
        $('#contactCus').val(data[0].proj_contact_no);
        $('#penalty').val(data[0].proj_late_payment_penalty);
        $("#list00>ul>li").each(function(index, element){
            //console.log($(element).click());
           if($(element).attr('aria-label')==data[0].proj_customer)
           {
               $('#customer').val($(element).html());
               return
           }
        })
        $("#list00>ul>li").each(function(index, element){
            //console.log($(element).click());
            if($(element).attr('aria-label')==data[0].proj_consultant)
            {
                $('#consultant').val($(element).html());
                $('#contactCon').val($(element).attr('title'));
                return
            }
        })
        if(data[0].proj_include_training==1)$('#checkbox-item-11').prop('checked', true);
        if(data[0].proj_include_installation_supervision==1)$('#checkbox-item-12').prop('checked', true);
        if(data[0].proj_include_installation==1)$('#checkbox-item-13').prop('checked', true);
        if(data[0].proj_include_transport==1)$('#checkbox-item-14').prop('checked', true);
        $('#updateProj').val(1)

    })
}
async function delProject(projCod){
    Swal.fire({
        html: `<h3>آیا مطمئنید می خواهید پروژه ${projCod} را حذف نمایید؟</h3>`,
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "بله",
        cancelButtonText: "خیر",
        showCancelButton: true,
        showCloseButton: true
    }).then(async (res) => {
        if (res.isConfirmed) {
            await $.ajax({
                url: url('project/deletethisproject'),
                method: "POST",
                data: {

                    projCod:projCod
                }, dataType: "html"
            }).then(async (result) => {
                await ToastPro('پروژه با موفقیت حذف شد!', 'top', 'success',1)
            })
        }
    })
}
$('#clearAllfieldsProj').on('click', ()=>{
  location.reload()
})