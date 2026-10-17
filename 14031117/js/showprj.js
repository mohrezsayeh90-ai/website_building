$(document).ready(()=>{
    jalaliDatepicker.startWatch();
    $('textarea').on("keydown", function(e) {
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
        }


    });
    $('textarea').on("focus", function(e) {
        /* ENTER PRESSED*/
        // alert(e.which)

            /* FOCUS ELEMENT */
            let inputs = $(this).parents().parent().eq(0).find("textarea");
            let idx = inputs.index(this);
            if(/^\d+$/.test(inputs[idx].value.replaceAll(',','').replaceAll('،','')))inputs[idx].value=inputs[idx].value.replaceAll(',','').replaceAll('،','')
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
            if(/^\d+$/.test(inputs[idx].value))inputs[idx].value=parseInt(inputs[idx].value).toLocaleString()
        }
        catch (e) {

        }



    });
    sumallFin()
})
$('#createmyExcelfileprj').on('click',async ()=>{

     ToastPro('لطفا منتظر بمانید تا فایل آماده شود','top','info')
    await $.ajax({
        url: url('prjman/pdfCreate'),
        method: "POST",
        data: {

            thisurl: window.location.href+'&margin=100',

        }
    }).then(async result=> {
       if(result)
       {
           window.open(url(JSON.parse(result)),'_blank')

       }
    })
})
$(`textarea`).on('change' , async(ev)=>{

    if(!$('#saveAllSheetsprj').hasClass('animate-bounce'))$('#saveAllSheetsprj').addClass('animate-bounce text-red-400')
})
$(`textarea[id^="risk_"]`).on('change' , async(ev)=>{

    if(!$('#saveAllSheetsprj').hasClass('animate-bounce'))$('#saveAllSheetsprj').addClass('animate-bounce text-red-400')
})
$(`textarea[id^="fin_3"]`).on('change' , async(ev)=>{
    let currow=ev.target.id.split("_3_")[1]
    if($(`#fin_3_${currow}`).val()!='' && $(`#fin_4_${currow}`).val()!='')
    {
        try{
            $(`#fin_5_${currow}`).val((parseFloat($(`#fin_3_${currow}`).val().replaceAll(',',''))*parseFloat($(`#fin_4_${currow}`).val().replaceAll(',',''))).toLocaleString())
        }
        catch (e) {

        }

    }
    sumallFin()
    if(!$('#saveAllSheetsprj').hasClass('animate-bounce'))$('#saveAllSheetsprj').addClass('animate-bounce text-red-400')
})
$(`textarea[id^="fin_4"]`).on('change' , async(ev)=>{
    let currow=ev.target.id.split("_4_")[1]
    if($(`#fin_3_${currow}`).val()!='' && $(`#fin_4_${currow}`).val()!='')
    {
        try{
            $(`#fin_5_${currow}`).val((parseFloat($(`#fin_3_${currow}`).val().replaceAll(',',''))*parseFloat($(`#fin_4_${currow}`).val().replaceAll(',',''))).toLocaleString())
        }
        catch (e) {

        }

    }
    if(!$('#saveAllSheetsprj').hasClass('animate-bounce'))$('#saveAllSheetsprj').addClass('animate-bounce text-red-400')



    sumallFin()
})

$('input').on('change', async(ev)=>{
    if(!$('#saveAllSheetsprj').hasClass('animate-bounce'))$('#saveAllSheetsprj').addClass('animate-bounce text-red-400')
})
function sumallFin() {
let sumall=0
    $(`textarea[id^="fin_5"]`).each(function(key,element){
        if($(element).val()!='')
        {
            try
            {
                sumall+=parseFloat($(element).val().replaceAll(',',''))
            }
            catch (e) {

            }
        }

    })
    $('#tintotal2').html(sumall.toLocaleString())
    sumall=0
    $(`textarea[id^="fin_3"]`).each(function(key,element){
        if($(element).val()!='')
        {
            try
            {
                sumall+=parseFloat($(element).val().replaceAll(',',''))
            }
            catch (e) {

            }
        }

    })
    $('#finqtyTot').html(sumall.toLocaleString())
}
$('#saveAllSheetsprj').on('click',async ()=>{
    let data=[]
    $("textarea, input").each(function(key,element){

           if(element.id.includes('checkbox'))
               if($(`#${element.id}`).prop("checked"))element.value=100
               else element.value=-100
           data.push({"id":element.id,"value":element.value})

    })
    await $.ajax({
        url: url('prjman/prjsaveAll'),
        method: "POST",
        data: {

            data: data,
            prjCode:$('#proj_code').html()
        }
    }).then(async result=> {

if(result){
    ToastPro('داده ها با موفقیت ذخیره شدند','top','success')
    if($('#saveAllSheetsprj').hasClass('animate-bounce'))$('#saveAllSheetsprj').removeClass('animate-bounce text-red-400')
}


    })

})
Dropzone.autoDiscover = false;
let myDropzone = new Dropzone("#my-dropzone", {
    maxFilesize: 100, //mb
    maxFiles: 20,
    acceptedFiles: "image/*,application/pdf,.doc,.docx,.xls,.xlsx",  //exactly this line
});
async function signProjectID(prjCode){
    Swal.fire({
        icon: 'question',
        text: `آیا از امضای پروژه ${prjCode} مطمئن هستید؟`,

        showCancelButton: true,
        cancelButtonText: "انصراف",
        confirmButtonText: "تایید",
        question:'؟'
    }).then(async (result) => {
        if (result.isConfirmed && result.value) {
            await $.ajax({
                url: url('prjman/signPrj'),
                method: "POST",
                data: {

                    prjCode:prjCode
                }
            }).then(async result=> {
                await  ToastPro(`سند با موفقیت توسط کاربر ${JSON.parse(result)} امضاء شد!`,'top','success',1)
            })

        }
    })
}
async function p3000Decision(prjCode)
{
    Swal.fire({
        title: `آیا شناسنامه پروژه ${prjCode} را تایید می نمایید؟`,
        icon: 'question',
        html:`<div style="width:95%" class="flex flex-col  mr-1 ml-4">
         <input type="text" id="denyCause" class="bg-gray-50 border rtl border-gray-300 text-gray-900 
         text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
          dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="دلایل عدم تایید" required />
          <div class="flex flex-row justify-between pt-10">
          <button onclick="OKButton('${prjCode}')" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 
          focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 
          dark:hover:bg-green-700 dark:focus:ring-green-800">تایید</button>
<button onclick="denyButton('${prjCode}')" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 
focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 
dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">عدم تایید</button>
<button onclick="Swal.close()" type="button" class="focus:outline-none text-white bg-yellow-400 
hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 
me-2 mb-2 dark:focus:ring-yellow-900">انصراف</button>
        </div>
        </div>`,

        showDenyButton: false,
        showCancelButton: false,
        showConfirmButton:false,
        showCloseButton:true,
        width:700,
        question: '؟',
    })
}
async function OKButton(prjCode){
    await $.ajax({
        url: url('prjman/prjAccepted'),
        method: "POST",
        data: {

            prjCode:prjCode
        }, dataType: "html"
    }).then(async result=> {
        await  ToastPro(`شناسنامه پروژه با موفقیت تایید شد`,'top','success')
        window.location.href=url('prjman')
    })
}
async function denyButton(prjCode){
if(document.querySelector('#denyCause').value=='')
{
    document.querySelector('#denyCause').focus()
    let color=document.querySelector('#denyCause').style.backgroundColor
    document.querySelector('#denyCause').style.backgroundColor="red"
setTimeout(()=>{
    document.querySelector('#denyCause').style.backgroundColor=color
},2000)
    //await ToastPro('لطفا دلایل عدم تایید را قید نمایید','top','info')

}
else{
    await $.ajax({
        url: url('prjman/prjNotAccepted'),
        method: "POST",
        data: {
            mcause:document.querySelector('#denyCause').value,
            prjCode:prjCode
        }, dataType: "html"
    }).then(async result=> {
        await  ToastPro(`شناسنامه پروژه با موفقیت رد شد`,'top','success')
      window.location.href=url('prjman')
    })
}

}
