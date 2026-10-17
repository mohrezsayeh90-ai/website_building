let tabcnt=0
let selstart
let selend
$(document).ready(() => {
    let body = $("body"), name = $("#proName"), code = $("#proCode");
    let cnt = $(".colorful-counter"), container = $("#detail_table tbody"), len = container.find("tr:not(.total-sum)").length;
    cnt.text(len);
    let scroll1 = $(".scroll1").parents('div:eq(0)')
    if (scroll1.length > 0) {
        let top1 = scroll1[0].getBoundingClientRect().top ;
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
        document.querySelector('#detail_table .total-sum').insertAdjacentHTML('beforebegin',`<tr class="text-center">
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
        document.querySelector('#detail_table .total-sum').insertAdjacentHTML('beforebegin',`<tr class="text-center">
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

$('#alltabsMain li').each(function(key,elem){
  tabcnt++
})
for(let i=0;i<tabcnt-1;i++){
    headerSum(`${i}_0`)
}
})
let precolorm
$('textarea').on("keydown", function(e) {
    /* ENTER PRESSED*/
   // alert(e.which)
    if (e.keyCode == 13) {
        if(e.target.id.startsWith("cell_6_") || e.target.id.startsWith("cell_5_"))
        {

            precolorm=$(`#${e.target.id}`).css('background-color')
            let tmp=e.target.id.split("_")

                $.ajax({
                    url:url('detail/controleplprice'),
                    type:"POST",
                    data:{
                        equip:$(`#cell_1_${tmp[2]+"_"+tmp[3]}`).val(),
                        spec:$(`#cell_2_${tmp[2]+"_"+tmp[3]}`).val(),
                        price:e.target.value.replace(',',''),
                        no:e.target.id.startsWith("cell_6_")?'r':'i',
                    },dataType:"html"
                }).then(async res=>{
                    $(`#${e.target.id}`).css('background-color',JSON.parse(res))
                    setTimeout(()=>{
                        $(`#${e.target.id}`).css('background-color',precolorm)
                    },500)
                })

            }



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
    }
    else if(e.which == 119)
    {
        try
        {
            let text=$(`#${currenttext}`).val()
if(selstart!=null && selend!=null) {
    let text1 = text.substring(0, selstart) + "\n"
    let text2 = text.substring(selend, text.length)
    // console.log(text)
    // console.log(text1)
    // console.log(text2)
    $(`#${currenttext}`).val(text1 + text2)
}
        }
        catch (e) {
console.log(e)
        }

    }

});
$(document).on('keydown',(ev)=>{
    if (ev.keyCode == 27) {
        $('#my-search-list00').css('display','none')
        $('#my-search-list01').css('display','none')
        $('#my-search-list02').css('display','none')
        if(!$(`#mydrpbH_1`).hasClass('hidden'))
        {
            $(`#mydrpbH_1`).addClass('hidden')
        }
    }
})
$('#elementButId').on('click', async ()=>{
if($('#equipment').val()==='' )
{
   await  ToastPro('Please fill all inputs!','top','error',0,'ltr')
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
        await  ToastPro('Data has been saved successfully!','top','success',0,'ltr')
        $(`#elementPro`).val(1)

        $('#equipmentForm').submit()
        }
    })
})
$(`button[id^="button_element_edit_"]`).on("click",async (ev)=> {
    let eleid = ev.target.id.split("_")[3]
    $('#elementID').val(eleid)
    $(`#elementPro`).val(3)
    let data=ev.target.ariaLabel.split(";;;")
    $('#equipment').val(data[0])
    $('#specification').val(data[1])
    $('#brand').val(data[2])
    $('#clearAll').removeClass('hidden')
})
$('#clearAll').on('click', async ()=>{
    $('#clearAll').addClass('hidden')
    $('#equipment').val('')
    $('#specification').val('')
    $('#brand').val('')
    $(`#elementPro`).val(0)
    $('#elementID').val(0)
})
$(`button[id^="button_element_del_"]`).on("click",async (ev)=> {
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
            await  ToastPro('Data has bee deleted successfully!','top','success',0,'ltr')
            $(`#elementPro`).val(2)//delete
            $('#equipmentForm').submit()
        }
    })
})


/////////////////////////////////new
let s00,s01,s02
let currenttext
let scrollElemm =document.getElementsByClassName("my-vertical-scroll-div ")[0];
$(`textarea[id^="cell_1_"]`).on('keyup', (ev)=> {
    s00=ev.target.id
    currenttext=ev.target.id
    let tmp=s00.split('_')
if($('#my-search-list00').css('display')=='none' && $(`#row_typem_${tmp[2]+'-'+tmp[3]}`).val()!='Accessories')
{
    $('#my-search-list00').css('display','block')
    $('#my-search-list00').css('top',$(`#${s00}`).parent().offset().top + $(`#${s00}`).height()-40+scrollElemm.scrollTop)
    $('#my-search-list00').css('left',$(`#${s00}`).parent().offset().left)
}
else if($('#my-search-list10').css('display')=='none' && $(`#row_typem_${tmp[2]+'-'+tmp[3]}`).val()=='Accessories'){
    $('#my-search-list10').css('display','block')
    $('#my-search-list10').css('top',$(`#${s00}`).parent().offset().top + $(`#${s00}`).height()-40+scrollElemm.scrollTop)
    $('#my-search-list10').css('left',$(`#${s00}`).parent().offset().left)
}
    if (ev.key == "Escape")
    {
        $('#my-search-list00').css('display','none')
        $('#my-search-list01').css('display','none')
        $('#my-search-list02').css('display','none')
        $('#my-search-list10').css('display','none')
        $('#my-search-list11').css('display','none')
        $('#my-search-list12').css('display','none')
    }

    if($(`#row_typem_${tmp[2]+'-'+tmp[3]}`).val()!='Accessories')
    $("#my-search-list00>ul>li").each(function(index, element){
        //console.log($(element).click());
        $(element).show()
        if(!$(element).html().toLowerCase().includes(ev.target.value.toLowerCase()))
        {
            $(element).hide()
        }
    })
    else
        $("#my-search-list10>ul>li").each(function(index, element){
            //console.log($(element).click());
            $(element).show()
            if(!$(element).html().toLowerCase().includes(ev.target.value.toLowerCase()))
            {
                $(element).hide()
            }
        })
})
$(`textarea[id^="cell_2_"]`).on('keyup', (ev)=> {
    s01=ev.target.id
    currenttext=ev.target.id
    let tmp=s01.split('_')
    if($('#my-search-list01').css('display')=='none' && $(`#row_typem_${tmp[2]+'-'+tmp[3]}`).val()!='Accessories')
    {
        $('#my-search-list01').css('display','block')
        $('#my-search-list01').css('top',$(`#${s01}`).parent().offset().top + $(`#${s01}`).height()-40+scrollElemm.scrollTop)
        $('#my-search-list01').css('left',$(`#${s01}`).parent().offset().left)
    }
    else if($('#my-search-list11').css('display')=='none' && $(`#row_typem_${tmp[2]+'-'+tmp[3]}`).val()=='Accessories'){
        $('#my-search-list11').css('display','block')
        $('#my-search-list11').css('top',$(`#${s01}`).parent().offset().top + $(`#${s01}`).height()-40+scrollElemm.scrollTop)
        $('#my-search-list11').css('left',$(`#${s01}`).parent().offset().left)
    }
    if (ev.key == "Escape")
    {
        $('#my-search-list00').css('display','none')
        $('#my-search-list01').css('display','none')
        $('#my-search-list02').css('display','none')
        $('#my-search-list10').css('display','none')
        $('#my-search-list11').css('display','none')
        $('#my-search-list12').css('display','none')
    }

    let cluepro=(";"+$(`#cell_1_${tmp[2]+'_'+tmp[3]}`).val()+";").toLowerCase()
    //alert(cluepro)
    if($(`#row_typem_${tmp[2]+'-'+tmp[3]}`).val()!='Accessories')
    $("#my-search-list01>ul>li").each(function(index, element){
      //  console.log($(element).attr('aria-label'));

        $(element).show()
        if(!$(element).html().toLowerCase().includes(ev.target.value.toLowerCase()) || (cluepro!=";;" && !$(element).attr('aria-label').toLowerCase().includes(cluepro)))
        {
            $(element).hide()
        }
    })
    else
        $("#my-search-list11>ul>li").each(function(index, element){
            //console.log($(element).click());
            $(element).show()
            if(!$(element).html().toLowerCase().includes(ev.target.value.toLowerCase()) || (cluepro!=";;" && !$(element).attr('aria-label').toLowerCase().includes(cluepro)))
            {
                $(element).hide()
            }
        })
})

/////////////////////////////////////////new


$(`textarea[id^="cell_3_"]`).on('keyup', (ev)=> {
    s02=ev.target.id
    currenttext=ev.target.id
    let tmp=s02.split('_')
    if($('#my-search-list02').css('display')=='none'  && $(`#row_typem_${tmp[2]+'-'+tmp[3]}`).val()!='Accessories')
    {
        $('#my-search-list02').css('display','block')
        $('#my-search-list02').css('top',$(`#${s02}`).parent().offset().top + $(`#${s02}`).height()-40+scrollElemm.scrollTop)
        $('#my-search-list02').css('left',$(`#${s02}`).parent().offset().left)
    }
    else if($('#my-search-list12').css('display')=='none'  && $(`#row_typem_${tmp[2]+'-'+tmp[3]}`).val()=='Accessories')
    {
        $('#my-search-list12').css('display','block')
        $('#my-search-list12').css('top',$(`#${s02}`).parent().offset().top + $(`#${s02}`).height()-40+scrollElemm.scrollTop)
        $('#my-search-list12').css('left',$(`#${s02}`).parent().offset().left)
    }
    if (ev.key == "Escape")
    {
        $('#my-search-list00').css('display','none')
        $('#my-search-list01').css('display','none')
        $('#my-search-list02').css('display','none')
        $('#my-search-list10').css('display','none')
        $('#my-search-list11').css('display','none')
        $('#my-search-list12').css('display','none')
    }

    let cluepro=(";"+$(`#cell_1_${tmp[2]+'_'+tmp[3]}`).val()+";").toLowerCase()
if($(`#row_typem_${tmp[2]+'-'+tmp[3]}`).val()!='Accessories')
    $("#my-search-list02>ul>li").each(function(index, element){

        $(element).show()
        if(!$(element).html().toLowerCase().includes(ev.target.value.toLowerCase()) || (cluepro!=";;" && !$(element).attr('aria-label').toLowerCase().includes(cluepro)))
        {
            $(element).hide()
        }
    })
    else
    $("#my-search-list12>ul>li").each(function(index, element){
        //console.log($(element).click());
        $(element).show()
        if(!$(element).html().toLowerCase().includes(ev.target.value.toLowerCase()) || (cluepro!=";;" && !$(element).attr('aria-label').toLowerCase().includes(cluepro)))
        {
            $(element).hide()
        }
    })
})
$("#my-search-list00>ul>li").on('click',(ev)=>{
    $(`#${s00}`).val(ev.currentTarget.textContent)
    $(`#${s00}`).focus()
   $('#my-search-list00').css('display','none')

    if(!$('#saveAllSheets').hasClass('animate-bounce'))$('#saveAllSheets').addClass('animate-bounce text-red-400')
})
$("#my-search-list01>ul>li").on('click',(ev)=>{
    $(`#${s01}`).val(ev.currentTarget.textContent)
    $(`#${s01}`).focus()
    $('#my-search-list01').css('display','none')

    if(!$('#saveAllSheets').hasClass('animate-bounce'))$('#saveAllSheets').addClass('animate-bounce text-red-400')
})
$("#my-search-list02>ul>li").on('click',(ev)=>{
    $(`#${s02}`).val(ev.currentTarget.textContent)
    $(`#${s02}`).focus()
    $('#my-search-list02').css('display','none')
    if(!$('#saveAllSheets').hasClass('animate-bounce'))$('#saveAllSheets').addClass('animate-bounce text-red-400')
})
$("#my-search-list10>ul>li").on('click',(ev)=>{
    $(`#${s00}`).val(ev.currentTarget.textContent)
    $(`#${s00}`).focus()
    $('#my-search-list10').css('display','none')

    if(!$('#saveAllSheets').hasClass('animate-bounce'))$('#saveAllSheets').addClass('animate-bounce text-red-400')
})
$("#my-search-list11>ul>li").on('click',(ev)=>{
    $(`#${s01}`).val(ev.currentTarget.textContent)
    $(`#${s01}`).focus()
    $('#my-search-list11').css('display','none')

    if(!$('#saveAllSheets').hasClass('animate-bounce'))$('#saveAllSheets').addClass('animate-bounce text-red-400')
})
$("#my-search-list12>ul>li").on('click',(ev)=>{
    $(`#${s02}`).val(ev.currentTarget.textContent)
    $(`#${s02}`).focus()
    $('#my-search-list12').css('display','none')
    if(!$('#saveAllSheets').hasClass('animate-bounce'))$('#saveAllSheets').addClass('animate-bounce text-red-400')
})
$(`textarea[id^="cell_2_"]`).on('focus', (ev)=> {
    $('#my-search-list00').css('display','none')
    $('#my-search-list01').css('display','none')
    $('#my-search-list02').css('display','none')
    $('#my-search-list10').css('display','none')
    $('#my-search-list11').css('display','none')
    $('#my-search-list12').css('display','none')
})
$(`textarea[id^="cell_1_"]`).on('focus', (ev)=> {
    $('#my-search-list00').css('display','none')
    $('#my-search-list01').css('display','none')
    $('#my-search-list02').css('display','none')
    $('#my-search-list10').css('display','none')
    $('#my-search-list11').css('display','none')
    $('#my-search-list12').css('display','none')
})
$(`textarea[id^="cell_3_"]`).on('focus', (ev)=> {
    $('#my-search-list00').css('display','none')
    $('#my-search-list01').css('display','none')
    $('#my-search-list02').css('display','none')
    $('#my-search-list10').css('display','none')
    $('#my-search-list11').css('display','none')
    $('#my-search-list12').css('display','none')
})
$(`textarea[id^="cell_4_"]`).on('focus', (ev)=> {
    $('#my-search-list00').css('display','none')
    $('#my-search-list01').css('display','none')
    $('#my-search-list02').css('display','none')
    $('#my-search-list10').css('display','none')
    $('#my-search-list11').css('display','none')
    $('#my-search-list12').css('display','none')
})
$(`textarea[id^="cell_4_"]`).on('focus', (ev)=> {
    $('#my-search-list00').css('display','none')
    $('#my-search-list01').css('display','none')
    $('#my-search-list02').css('display','none')
    $('#my-search-list10').css('display','none')
    $('#my-search-list11').css('display','none')
    $('#my-search-list12').css('display','none')
})
$(`textarea[id^="cell_6_"]`).on('focus', (ev)=> {
    $('#my-search-list00').css('display','none')
    $('#my-search-list01').css('display','none')
    $('#my-search-list02').css('display','none')
    $('#my-search-list10').css('display','none')
    $('#my-search-list11').css('display','none')
    $('#my-search-list12').css('display','none')
})
$(`textarea[id^="cell_4_"]`).on('change', (ev)=> {
    let celln="cell_7_"+ev.target.id.split("cell_4_")[1]
    let celln1="cell_8_"+ev.target.id.split("cell_4_")[1]
    let cellnn="cell_5_"+ev.target.id.split("cell_4_")[1]
    let cellnn1="cell_6_"+ev.target.id.split("cell_4_")[1]

    let intRegex = /^\d+$/;
    var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
    if((intRegex.test(ev.target.value) || floatRegex.test(ev.target.value)) &&
        ((intRegex.test($(`#${cellnn}`).val()) || floatRegex.test($(`#${cellnn}`).val()))))
    {
        $(`#${celln}`).html((parseFloat(ev.target.value.replaceAll(',',''))*parseFloat($(`#${cellnn}`).val().replaceAll(',',''))).toLocaleString(undefined))
        $(`#${celln1}`).html((parseFloat(ev.target.value.replaceAll(',',''))*parseFloat($(`#${cellnn1}`).val().replaceAll(',',''))).toLocaleString(undefined))
        headerSum(ev.target.id.split("cell_4_")[1])
    }
    if(!$('#saveAllSheets').hasClass('animate-bounce'))$('#saveAllSheets').addClass('animate-bounce text-red-400')
})
$(`textarea[id^="cell_5_"]`).on('change', (ev)=> {
    let celln="cell_7_"+ev.target.id.split("cell_5_")[1]
    let cellnn="cell_4_"+ev.target.id.split("cell_5_")[1]
    makeEqualPrice(ev.target.id,ev.target.value)
    let intRegex = /^\d+$/;
    let floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
    if((intRegex.test(ev.target.value) || floatRegex.test(ev.target.value)) &&
        ((intRegex.test($(`#${cellnn}`).val()) || floatRegex.test($(`#${cellnn}`).val()))))
    {
        $(`#${celln}`).html((parseFloat(ev.target.value.replaceAll(',',''))*parseFloat($(`#${cellnn}`).val().replaceAll(',',''))).toLocaleString(undefined))
        headerSum(ev.target.id.split("cell_5_")[1])
    }
    if(!$('#saveAllSheets').hasClass('animate-bounce'))$('#saveAllSheets').addClass('animate-bounce text-red-400')
})

$(`textarea[id^="cell_6_"]`).on('change', (ev)=> {
    let celln="cell_8_"+ev.target.id.split("cell_6_")[1]
    let cellnn="cell_4_"+ev.target.id.split("cell_6_")[1]
    makeEqualPrice(ev.target.id,ev.target.value)
    let intRegex = /^\d+$/;
    let floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
    if((intRegex.test(ev.target.value) || floatRegex.test(ev.target.value)) &&
        ((intRegex.test($(`#${cellnn}`).val()) || floatRegex.test($(`#${cellnn}`).val()))))
    {
        $(`#${celln}`).html((parseFloat(ev.target.value.replaceAll(',',''))*parseFloat($(`#${cellnn}`).val().replaceAll(',',''))).toLocaleString(undefined))
        headerSum(ev.target.id.split("cell_6_")[1])
    }
    if(!$('#saveAllSheets').hasClass('animate-bounce'))$('#saveAllSheets').addClass('animate-bounce text-red-400')
})
 function headerSum(id){
    let sum1=0.0
    let sum11=0.0
    let sum2=0.0
    let sum_vcb=0.0

    let celln=id.split("_")[0]
    for(let i=0 ; i<100;i++)
    {
        if($(`#cell_7_${celln}_${i}`).html().replaceAll(',','')!='')
        {
           sum1+= parseFloat($(`#cell_7_${celln}_${i}`).html().replaceAll(',',''))
        }
        if($(`#cell_8_${celln}_${i}`).html().replaceAll(',','')!='')
        {
            sum2+= parseFloat($(`#cell_8_${celln}_${i}`).html().replaceAll(',',''))
        }
        if($(`#row_typem_${celln}-${i}`).val()=='VCB'){
            sum_vcb+= parseFloat($(`#cell_8_${celln}_${i}`).html().replaceAll(',',''))
        }
        if($(`#row_typem_${celln}-${i}`).val()=='Foreign Accessories'){
            sum11+= parseFloat($(`#cell_7_${celln}_${i}`).html().replaceAll(',',''))
        }
    }
    $(`#cell_sum_i_${celln}`).html(sum1.toLocaleString(undefined))
    $(`#cell_sum_r_${celln}`).html(sum2.toLocaleString(undefined))
    $(`#pi_tp_${celln}`).html((sum1-sum11).toLocaleString(undefined))
    $(`#pifor_tp_${celln}`).html((sum11).toLocaleString(undefined))
    $(`#pr_tp_${celln}`).html((sum2-sum_vcb).toLocaleString(undefined))
    $(`#vcb_panir_${celln}`).html(sum_vcb.toLocaleString(undefined))
     sum1=0
     sum11=0
     sum2=0
     sum_vcb=0
     for(let i=0;i<tabcnt-1;i++)
     {
         sum_vcb+=parseFloat($(`#vcb_panir_${i}`).html().replaceAll(',',''))*parseFloat($(`#tedad_${i}`).html().replaceAll(',',''))
         sum2+=parseFloat($(`#pr_tp_${i}`).html().replaceAll(',',''))*parseFloat($(`#tedad_${i}`).html().replaceAll(',',''))
         sum1+=parseFloat($(`#pi_tp_${i}`).html().replaceAll(',',''))*parseFloat($(`#tedad_${i}`).html().replaceAll(',',''))
         sum11+=parseFloat($(`#pifor_tp_${i}`).html().replaceAll(',',''))*parseFloat($(`#tedad_${i}`).html().replaceAll(',',''))
     }
     $(`#vcb_panir`).html(sum_vcb.toLocaleString(undefined))
     $(`#pr_tp`).html(sum2.toLocaleString(undefined))
     $(`#pi_tp`).html(sum1.toLocaleString(undefined))
     $(`#pifor_tp`).html(sum11.toLocaleString(undefined))
}


$(`#saveAllSheets`).on('click',async ()=>{
    if($('#saveAllSheets').hasClass('animate-bounce'))$('#saveAllSheets').removeClass('animate-bounce text-red-400')
    let allD=[]
    let thiscnt=0
    for(let i=0;i<tabcnt-1;i++)
    {

        for(let j=0;j<100;j++)
        {

           if ($(`#cell_1_${i}_${j}`).val()!='')
           {
               allD.push([$(`#prd_ten_${i}`).val(),$(`#cell_1_${i}_${j}`).val(),
               $(`#cell_2_${i}_${j}`).val(),
               $(`#cell_3_${i}_${j}`).val(),
               $(`#cell_4_${i}_${j}`).val().replaceAll(',','').replaceAll('،',''),
               $(`#cell_5_${i}_${j}`).val().replaceAll(',','').replaceAll('،',''),
               $(`#cell_6_${i}_${j}`).val().replaceAll(',','').replaceAll('،',''),
                $(`#row_typem_${i}-${j}`).val()])

           }

        }
    }
//console.log(allD)
  // return
    await $.ajax({
        url: window.location.href,
        method: "POST",
        data: {
            saveAllSheets:true,
            tenderCode:$('#tender_code').val(),
            allData:allD
        }
    }).then(async result=> {
        await  ToastPro('All data has been saved!','top','success',0,'ltr')
    })

})
let thismenu
$(`button[id^="mydrpb_"]`).on('click',async (ev)=>{
    let thisid=ev.target.id.split("_")[1]

    thismenu=`row_typem_${thisid}`
    if($(`#mydrpbH_1`).hasClass('hidden'))
    {
        $(`#mydrpbH_1`).removeClass('hidden')
        //alert($(`#${thismenu}`).val())
        //$(`#row_typem`).val($(`#row_typem_${thisid}`).val())
        //  let $radios = $('input:radio[name=radio_1]');
        //  $radios.filter(`[value=${$("#"+thismenu).val()}]`).attr('checked', true);
        switch ($(`#${thismenu}`).val())
        {
            case 'VCB':
                $('#radio_4_1').prop('checked',true)

                break
            case 'Accessories':

                $('#radio_4_2').prop('checked',true)

                break;
            case 'Normal':
                $('#radio_4_3').prop('checked',true)

                break;
            case 'Foreign Accessories':
                $('#radio_4_4').prop('checked',true)

                break;
        }

        $(`#mydrpbH_1`).css('top',$(`#${ev.target.id}`).parent().offset().top + $(`#${ev.target.id}`).height()-40+scrollElemm.scrollTop)
        $(`#mydrpbH_1`).css('left',$(`#${ev.target.id}`).parent().offset().left)
    }
    else
        $(`#mydrpbH_1`).addClass('hidden')
})
$(`input[type="radio"][id^="radio_4"]`).on('click',async (ev)=>{
    let pos=ev.target.id.split("_")[2]
    let changed=$(`#${thismenu}`).val()
    let tmp=thismenu.split('_')

    switch(pos)
    {
        case "1":
            $(`#${thismenu}`).val('VCB')
            if($(`#item_${tmp[2]}`).hasClass('bg-white'))$(`#item_${tmp[2]}`).removeClass('bg-white')
            if($(`#item_${tmp[2]}`).hasClass('bg-bg-red-200'))$(`#item_${tmp[2]}`).removeClass('bg-red-200')
            if($(`#item_${tmp[2]}`).hasClass('bg-slate-200'))$(`#item_${tmp[2]}`).removeClass('bg-slate-200')
            $(`#item_${tmp[2]}`).addClass('bg-green-300')
            break
        case "2":
            $(`#${thismenu}`).val('Accessories')
            if($(`#item_${tmp[2]}`).hasClass('bg-white'))$(`#item_${tmp[2]}`).removeClass('bg-white')
            if($(`#item_${tmp[2]}`).hasClass('bg-green-300'))$(`#item_${tmp[2]}`).removeClass('bg-green-300')
            if($(`#item_${tmp[2]}`).hasClass('bg-slate-200'))$(`#item_${tmp[2]}`).removeClass('bg-slate-200')
            $(`#item_${tmp[2]}`).addClass('bg-red-200')
            break
        case "3":
            $(`#${thismenu}`).val('Normal')
            if($(`#item_${tmp[2]}`).hasClass('bg-bg-red-200'))$(`#item_${tmp[2]}`).removeClass('bg-bg-red-200')
            if($(`#item_${tmp[2]}`).hasClass('bg-green-300'))$(`#item_${tmp[2]}`).removeClass('bg-green-300')
            if($(`#item_${tmp[2]}`).hasClass('bg-slate-200'))$(`#item_${tmp[2]}`).removeClass('bg-slate-200')
            $(`#item_${tmp[2]}`).addClass('bg-white')
            break
        case "4":
            $(`#${thismenu}`).val('Foreign Accessories')
            if($(`#item_${tmp[2]}`).hasClass('bg-bg-red-200'))$(`#item_${tmp[2]}`).removeClass('bg-bg-red-200')
            if($(`#item_${tmp[2]}`).hasClass('bg-white'))$(`#item_${tmp[2]}`).removeClass('bg-white')
            if($(`#item_${tmp[2]}`).hasClass('bg-green-300'))$(`#item_${tmp[2]}`).removeClass('bg-green-300')
            $(`#item_${tmp[2]}`).addClass('bg-slate-200')
            break
    }
    if(changed!=$(`#${thismenu}`).val()) {
        if(!$('#saveAllSheets').hasClass('animate-bounce'))$('#saveAllSheets').addClass('animate-bounce text-red-400')
        for (let i = 0; i < tabcnt - 1; i++) {
            headerSum(`${i}_0`)
        }
        await ToastPro(`Type has been set to ${$(`#${thismenu}`).val()} for this row !`, 'top', 'info', 0, 'ltr')
    }
    $(`#mydrpbH_1`).addClass('hidden')
})
$('#reloadAllSheets').on('click',async ()=>{
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
$('#deletethisRow').on('click',async ()=>{
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
            if(!$('#saveAllSheets').hasClass('animate-bounce'))$('#saveAllSheets').addClass('animate-bounce text-red-400')
            let tmp=thismenu.split('_')[2].split('-')
            for(let i=parseInt(tmp[1])+1 ; i<99;i++)
            {
            $(`#row_typem_${tmp[0]+'-'+String(i-1)}`).val($(`#row_typem_${tmp[0]+'-'+String(i)}`).val())
                switch($(`#row_typem_${tmp[0]+'-'+String(i-1)}`).val())
                {
                    case "VCB":

                        if($(`#item_${tmp[0]+'-'+String(i-1)}`).hasClass('bg-white'))$(`#item_${tmp[0]+'-'+String(i-1)}`).removeClass('bg-white')
                        if($(`#item_${tmp[0]+'-'+String(i-1)}`).hasClass('bg-bg-red-200'))$(`#item_${tmp[0]+'-'+String(i-1)}`).removeClass('bg-red-200')
                        if($(`#item_${tmp[0]+'-'+String(i-1)}`).hasClass('bg-slate-200'))$(`#item_${tmp[0]+'-'+String(i-1)}`).removeClass('bg-slate-200')
                        $(`#item_${tmp[0]+'-'+String(i-1)}`).addClass('bg-green-300')
                        break
                    case "Accessories":

                        if($(`#item_${tmp[0]+'-'+String(i-1)}`).hasClass('bg-white'))$(`#item_${tmp[0]+'-'+String(i-1)}`).removeClass('bg-white')
                        if($(`#item_${tmp[0]+'-'+String(i-1)}`).hasClass('bg-green-300'))$(`#item_${tmp[0]+'-'+String(i-1)}`).removeClass('bg-green-300')
                        if($(`#item_${tmp[0]+'-'+String(i-1)}`).hasClass('bg-slate-200'))$(`#item_${tmp[0]+'-'+String(i-1)}`).removeClass('bg-slate-200')
                        $(`#item_${tmp[0]+'-'+String(i-1)}`).addClass('bg-red-200')
                        break
                    case "Normal":

                        if($(`#item_${tmp[0]+'-'+String(i-1)}`).hasClass('bg-bg-red-200'))$(`#item_${tmp[0]+'-'+String(i-1)}`).removeClass('bg-bg-red-200')
                        if($(`#item_${tmp[0]+'-'+String(i-1)}`).hasClass('bg-green-300'))$(`#item_${tmp[0]+'-'+String(i-1)}`).removeClass('bg-green-300')
                        if($(`#item_${tmp[0]+'-'+String(i-1)}`).hasClass('bg-slate-200'))$(`#item_${tmp[0]+'-'+String(i-1)}`).removeClass('bg-slate-200')
                        $(`#item_${tmp[0]+'-'+String(i-1)}`).addClass('bg-white')
                        break
                    case "Foreign Accessories":

                        if($(`#item_${tmp[0]+'-'+String(i-1)}`).hasClass('bg-bg-red-200'))$(`#item_${tmp[0]+'-'+String(i-1)}`).removeClass('bg-bg-red-200')
                        if($(`#item_${tmp[0]+'-'+String(i-1)}`).hasClass('bg-green-300'))$(`#item_${tmp[0]+'-'+String(i-1)}`).removeClass('bg-green-300')
                        if($(`#item_${tmp[0]+'-'+String(i-1)}`).hasClass('bg-white'))$(`#item_${tmp[0]+'-'+String(i-1)}`).removeClass('bg-white')
                        $(`#item_${tmp[0]+'-'+String(i-1)}`).addClass('bg-slate-200')
                        break
                }
            $(`#cell_1_${tmp[0]+'_'+String(i-1)}`).val($(`#cell_1_${tmp[0]+'_'+String(i)}`).val())
            $(`#cell_2_${tmp[0]+'_'+String(i-1)}`).val($(`#cell_2_${tmp[0]+'_'+String(i)}`).val())
            $(`#cell_3_${tmp[0]+'_'+String(i-1)}`).val($(`#cell_3_${tmp[0]+'_'+String(i)}`).val())
            $(`#cell_4_${tmp[0]+'_'+String(i-1)}`).val($(`#cell_4_${tmp[0]+'_'+String(i)}`).val())
            $(`#cell_5_${tmp[0]+'_'+String(i-1)}`).val($(`#cell_5_${tmp[0]+'_'+String(i)}`).val())
            $(`#cell_6_${tmp[0]+'_'+String(i-1)}`).val($(`#cell_6_${tmp[0]+'_'+String(i)}`).val())
            $(`#cell_7_${tmp[0]+'_'+String(i-1)}`).html($(`#cell_7_${tmp[0]+'_'+String(i)}`).html())
            $(`#cell_8_${tmp[0]+'_'+String(i-1)}`).html($(`#cell_8_${tmp[0]+'_'+String(i)}`).html())
            }
            for (let i = 0; i < tabcnt - 1; i++) {
                headerSum(`${i}_0`)
            }
            await ToastPro(`Row has been deleted successfully !`, 'top', 'success', 0, 'ltr')
        }
    })
})

$(`#createmyExcelfile`).on('click',async ()=>{
    if($('#saveAllSheets').hasClass('animate-bounce'))$('#saveAllSheets').removeClass('animate-bounce text-red-400')
    let allD=[]
    let thiscnt=0
    for(let i=0;i<tabcnt-1;i++)
    {

        for(let j=0;j<100;j++)
        {

            if ($(`#cell_1_${i}_${j}`).val()!='')
            {
                allD.push([$(`#prd_ten_${i}`).val(),$(`#cell_1_${i}_${j}`).val(),
                    $(`#cell_2_${i}_${j}`).val(),
                    $(`#cell_3_${i}_${j}`).val(),
                    $(`#cell_4_${i}_${j}`).val(),
                    $(`#cell_5_${i}_${j}`).val(),
                    $(`#cell_6_${i}_${j}`).val(),
                    $(`#row_typem_${i}-${j}`).val()])

            }

        }
    }
   // url('detail/createTenderExcel')
    await $.ajax({
        url: url('detail/createTenderExcel'),
        method: "POST",
        data: {
            tenderCode:$('#tender_code').val(),
            allData:allD
        }
    }).then(async result=> {

        window.open(url(JSON.parse(result)[0]),'_blank')
        setTimeout(async () => window.open(url(JSON.parse(result)[1]), '_blank'), 2000)
        await  ToastPro('Excel file created successfully!','top','success',0,'ltr')
    })

})
$(`#createmyPdffile`).on('click',async ()=>{
    //alert(1)
    if($('#saveAllSheets').hasClass('animate-bounce'))$('#saveAllSheets').removeClass('animate-bounce text-red-400')
    ToastPro('Pdf file is going to be created. Please wait','top','success',0,'ltr')
    let mdata=[]
    for(let i=0;i<tabcnt-1;i++)
    {
        mdata.push($(`#prd_ten_title_${i}`).val())
    }
    mdata.push('Materials List')
    await $.ajax({
        url: url('detail/createmyPdffile'),
        method: "POST",
        data: {
            mdata:mdata,
            tabcnt:tabcnt,
            thisurl:window.location.href
        }
    }).then(async result=> {

        window.open(url(JSON.parse(result)),'_blank')
        //setTimeout(async () => window.open(url(JSON.parse(result)[1]), '_blank'), 2000)

    })

})
document.onselectionchange = function() {
    try
    {
        let inp = document.querySelector(`#${currenttext}`);
        selstart=inp.selectionStart
        selend=inp.selectionEnd
    }
    catch (e) {
        selstart=null
        selend=null
    }

//alert(inp.selectionStart)
   // document.querySelector("p").innerText = "Start: "+inp.selectionStart+"\nEnd: "+inp.selectionEnd+"\n\nSelected: "+inp.value.substring(inp.selectionStart, inp.selectionEnd);
}
$('#insertNewRow').on('click',async ()=>{
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
            if(!$('#saveAllSheets').hasClass('animate-bounce'))$('#saveAllSheets').addClass('animate-bounce text-red-400')
            let tmp=thismenu.split('_')[2].split('-')
            // console.log(tmp)
            for(let i=98 ; i>=parseInt(tmp[1]);i--)
            {
                //console.log(i)
                $(`#row_typem_${tmp[0]+'-'+String(i+1)}`).val($(`#row_typem_${tmp[0]+'-'+String(i)}`).val())
                switch($(`#row_typem_${tmp[0]+'-'+String(i)}`).val())
                {
                    case "VCB":

                        if($(`#item_${tmp[0]+'-'+String(i+1)}`).hasClass('bg-white'))$(`#item_${tmp[0]+'-'+String(i+1)}`).removeClass('bg-white')
                        if($(`#item_${tmp[0]+'-'+String(i+1)}`).hasClass('bg-bg-red-200'))$(`#item_${tmp[0]+'-'+String(i+1)}`).removeClass('bg-red-200')
                        if($(`#item_${tmp[0]+'-'+String(i+1)}`).hasClass('bg-slate-200'))$(`#item_${tmp[0]+'-'+String(i+1)}`).removeClass('bg-slate-200')
                        $(`#item_${tmp[0]+'-'+String(i+1)}`).addClass('bg-green-300')
                        break
                    case "Accessories":

                        if($(`#item_${tmp[0]+'-'+String(i+1)}`).hasClass('bg-white'))$(`#item_${tmp[0]+'-'+String(i+1)}`).removeClass('bg-white')
                        if($(`#item_${tmp[0]+'-'+String(i+1)}`).hasClass('bg-green-300'))$(`#item_${tmp[0]+'-'+String(i+1)}`).removeClass('bg-green-300')
                        if($(`#item_${tmp[0]+'-'+String(i+1)}`).hasClass('bg-slate-200'))$(`#item_${tmp[0]+'-'+String(i+1)}`).removeClass('bg-slate-200')
                        $(`#item_${tmp[0]+'-'+String(i+1)}`).addClass('bg-red-200')
                        break
                    case "Normal":

                        if($(`#item_${tmp[0]+'-'+String(i+1)}`).hasClass('bg-bg-red-200'))$(`#item_${tmp[0]+'-'+String(i+1)}`).removeClass('bg-bg-red-200')
                        if($(`#item_${tmp[0]+'-'+String(i+1)}`).hasClass('bg-green-300'))$(`#item_${tmp[0]+'-'+String(i+1)}`).removeClass('bg-green-300')
                        if($(`#item_${tmp[0]+'-'+String(i+1)}`).hasClass('bg-slate-200'))$(`#item_${tmp[0]+'-'+String(i+1)}`).removeClass('bg-slate-200')
                        $(`#item_${tmp[0]+'-'+String(i+1)}`).addClass('bg-white')
                        break
                    case "Foreign Accessories":

                        if($(`#item_${tmp[0]+'-'+String(i+1)}`).hasClass('bg-bg-red-200'))$(`#item_${tmp[0]+'-'+String(i+1)}`).removeClass('bg-bg-red-200')
                        if($(`#item_${tmp[0]+'-'+String(i+1)}`).hasClass('bg-white'))$(`#item_${tmp[0]+'-'+String(i+1)}`).removeClass('bg-white')
                        if($(`#item_${tmp[0]+'-'+String(i+1)}`).hasClass('bg-green-300'))$(`#item_${tmp[0]+'-'+String(i+1)}`).removeClass('bg-green-300')
                        $(`#item_${tmp[0]+'-'+String(i+1)}`).addClass('bg-slate-200')
                        break
                }
                $(`#cell_1_${tmp[0]+'_'+String(i+1)}`).val($(`#cell_1_${tmp[0]+'_'+String(i)}`).val())
                $(`#cell_2_${tmp[0]+'_'+String(i+1)}`).val($(`#cell_2_${tmp[0]+'_'+String(i)}`).val())
                $(`#cell_3_${tmp[0]+'_'+String(i+1)}`).val($(`#cell_3_${tmp[0]+'_'+String(i)}`).val())
                $(`#cell_4_${tmp[0]+'_'+String(i+1)}`).val($(`#cell_4_${tmp[0]+'_'+String(i)}`).val())
                $(`#cell_5_${tmp[0]+'_'+String(i+1)}`).val($(`#cell_5_${tmp[0]+'_'+String(i)}`).val())
                $(`#cell_6_${tmp[0]+'_'+String(i+1)}`).val($(`#cell_6_${tmp[0]+'_'+String(i)}`).val())
                $(`#cell_7_${tmp[0]+'_'+String(i+1)}`).html($(`#cell_7_${tmp[0]+'_'+String(i)}`).html())
                $(`#cell_8_${tmp[0]+'_'+String(i+1)}`).html($(`#cell_8_${tmp[0]+'_'+String(i)}`).html())
            }
            if($(`#item_${tmp[0]+'-'+tmp[1]}`).hasClass('bg-bg-red-200'))$(`#item_${tmp[0]+'-'+tmp[1]}`).removeClass('bg-bg-red-200')
            if($(`#item_${tmp[0]+'-'+tmp[1]}`).hasClass('bg-green-300'))$(`#item_${tmp[0]+'-'+tmp[1]}`).removeClass('bg-green-300')
            $(`#item_${tmp[0]+'-'+tmp[1]}`).addClass('bg-white')
            $(`#row_typem_${tmp[0]+'-'+tmp[1]}`).val('Normal')
            $(`#cell_1_${tmp[0]+'_'+tmp[1]}`).val('')
            $(`#cell_2_${tmp[0]+'_'+tmp[1]}`).val('')
            $(`#cell_3_${tmp[0]+'_'+tmp[1]}`).val('')
            $(`#cell_4_${tmp[0]+'_'+tmp[1]}`).val('0')
            $(`#cell_5_${tmp[0]+'_'+tmp[1]}`).val('0')
            $(`#cell_6_${tmp[0]+'_'+tmp[1]}`).val('0')
            $(`#cell_7_${tmp[0]+'_'+tmp[1]}`).html('0')
            $(`#cell_8_${tmp[0]+'_'+tmp[1]}`).html('0')

            await ToastPro(`Row has been inserted successfully !`, 'top', 'success', 0, 'ltr')
        }
    })
})
$('textarea').on("focus", function(e) {
    /* ENTER PRESSED*/
    // alert(e.which)

    /* FOCUS ELEMENT */
    let inputs = $(this).parents().parent().eq(0).find("textarea");
    let idx = inputs.index(this);
    if(/^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/.test(inputs[idx].value.replaceAll(',','').replaceAll('،','')))inputs[idx].value=inputs[idx].value.replaceAll(',','').replaceAll('،','')
    inputs[idx].select();

});
$('textarea').on("blur", function(e) {
    /* ENTER PRESSED*/
    // alert(e.which)

    /* FOCUS ELEMENT */
    let inputs = $(this).parents().parent().eq(0).find("textarea");
    let idx = inputs.index(this);
    //console.log(inputs[idx].value)
    try
    {
        if(/^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/.test(inputs[idx].value))inputs[idx].value=parseFloat(inputs[idx].value).toLocaleString()
    }
    catch (e) {

    }



});
function setTitle(k,l=0)
{
    if(l!=0)$('#summ').addClass('hidden')
    else if($('#summ').hasClass('hidden') || l==0){
        $('#summ').removeClass('hidden')
        headerSum(k+'_0')
    }
    $('#my-search-list00').css('display','none')
    $('#my-search-list01').css('display','none')
    $('#my-search-list02').css('display','none')
    $('#my-search-list10').css('display','none')
    $('#my-search-list11').css('display','none')
    $('#my-search-list12').css('display','none')
    if(!$('#mydrpbH_1').hasClass('hidden'))$('#mydrpbH_1').addClass('hidden')
    $('#thistabTile').html('DOCUMENT TITLE: '+$(`#prd_ten_title_${k}`).val())
}

async function openHistory(key,row)
{
    let equip=$(`#cell_1_${key}_${row}`).val()
    let type=$(`#cell_2_${key}_${row}`).val()
    if(equip=='')return



//         let mhtml=`<div  class="container text-sm">
// <p class="text-center text-xl font-extrabold">${equip} price history</p>
//             <table class=" display compact ltr"
//                    id="equipTable">
//                 <thead class="text-white uppercase dark:bg-gray-700 dark:text-gray-400 bg-this-teal">
//                 <tr>
// <!--                    <th scope="col" class="pr-6 pl-1 py-3 text-end">Date</th>-->
//                     <th style="text-align: center !important;width:5%" scope="col" class="pr-6 pl-1 py-3">ROW</th>
//                     <th style="text-align: center !important;width:40%" scope="col" class="pr-6 pl-1 py-3">TECHNICAL SPECIFICATION</th>
//                     <th style="text-align: center !important;width:15%" scope="col" class="pr-6 pl-1 py-3 text-end">Manufaturer</th>
//                     <th style="text-align: center !important;width:10%" scope="col" class="pr-6 pl-1 py-3 text-end">Date</th>
//                     <th style="text-align: center !important;width:15%" scope="col" class="pr-6 pl-1 py-3 text-end">PRICE I </th>
//                     <th  style="text-align: center !important;width:15%" scope="col" class="pr-6 pl-1 py-3 text-end">PRICE RIAL</th>
//                 </tr>
//                 </thead>
//                 <tbody class="text-this-gray text-center">`
//         let cnt=1
//         myresult.forEach((row)=>{
//             mhtml+= `<tr className="bg-zinc-100 border-b dark:bg-gray-800 text-center dark:border-gray-700 hover:bg-zinc-400 dark:hover:bg-gray-600">
// <td>${cnt}</td>
// <td class="text-left">${row.type}</td>
// <td>${row.manufact}</td>
// <td>${row.trkh}</td>
// <td>${parseFloat(row.price_i).toLocaleString()}</td>
// <td>${parseFloat(row.price_r).toLocaleString()}</td>
// </tr>
// `
//             cnt++;
//         })
//         mhtml+=`</tbody>
//             </table>
//         </div>
//         <script>
//
// </script>
// `
        Swal.fire({
            title: '',
            html:`<div class="bg-gradient w-100 h-100">

</div>
<div style="height: 800px" class="overflow-y-scroll ltr">
    <iframe src="${url(`detail/statics/?q=${equip}&qq=${equip.replace(/[^a-zA-Z0-9]/g, '')}&spec=${type.replace(/[^a-zA-Z0-9]/g, '')}`)}" scrolling="yes" width="100%" height="1200">
        <p>Hello</p>
    </iframe>
</div>

`,
            grow:"row",
            reverseButtons:true,
            width:1400,
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
                // new DataTable("#equipTable", {
                //     order: [[0, 'desc']],
                //     pageLength:10
                //
                // });

            },
            didClose:()=>{
                // $('#proName').focus()
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
               setTimeout(async ()=>  window.location.href=url('tList'),3000);
            }
        })
    }
    else
    window.location.href=url('tList')
}
function makeEqualPrice(id,value)
{
    let tmp=id.split("_")
value=parseFloat(String(value).replace(',',''))
    let equip,mtype
    equip=$(`#cell_1_${tmp[2]}_${tmp[3]}`).val()
    mtype=$(`#cell_2_${tmp[2]}_${tmp[3]}`).val()
    for(let i=0;i<tabcnt;i++)
    {
        for(let j=0;j<100;j++){
          if($(`#cell_1_${i}_${j}`).val()==equip && $(`#cell_2_${i}_${j}`).val()==mtype)
          {
              if(tmp[1]==5)
              {
                  $(`#cell_5_${i}_${j}`).val(value.toLocaleString())
              }
              else
              {
                  $(`#cell_6_${i}_${j}`).val(value.toLocaleString())
              }
          }

        }

    }
}
$(`#productExtraction`).on('click',async ()=>{
    Swal.fire({
        icon: 'question',

        html: `<h1 dir="ltr">Do you want to import stored EPL data into your current EPL?<h1> `,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then(async (res) => {
        if (res.isConfirmed) {
           await ToastPro('Please wait!',"top","info",0,'auto')
           await $.ajax({
               url:url('detail/extractEpl'),
               type:"POST",
               data:{
                    tenderCode:$('#tender_code').val(),

               },dataType: "html"
           }).then(async (res)=>{
               await ToastPro("EPl data have been updated successfully!","top","success",1,'auto')
           })


        }
    })
})
