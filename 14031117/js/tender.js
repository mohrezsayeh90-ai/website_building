$(document).ready(async ()=>{
    $('#default-modal').removeClass('hi' +
        'dden')
    new DataTable("#tendersTableAAA", {
        order: [[0, 'desc']],
    });
    $('#default-modal').addClass('hidden')
    jalaliDatepicker.startWatch();
    $(".button_tenders_edit").on("click", editCustomer)
    async function editCustomer(cusCod){
        let code = $(this).val();
        $('#tendersList').click()
        $('#clearAllfieldsT').removeClass('hidden');
        $('#tendersList').css('display','none')
        await $.ajax({
            url: url('tender/edit'),
            method: "POST",
            data: {
                code:code
            }
        }).then(result=> {
            //console.log(result)
            let data=JSON.parse(result);
            $('#option').val(1)
            $('#tenCode').val(data.code)
            $('#tenName').val(data.name)
            $('#tenDate').val(data.trkh)
            $('#tenDocDate').val(data.due_date)
            $('#tenCus').val(data.nam)
            $(`span[data-hs-combo-box-search-text="${data.nam}"]`).siblings('span').removeClass('hidden');
        })
    }
})
$('#clearAllfieldsT').on('click', async ()=>{

  location.reload()
})
$('#savetenderData').on('click',async ()=>{

    if($('#tenCode').val()=='' || $('#tenName').val()=='' || $('#tenDate').val()=='' || $('#tenDocDate').val()=='' || $('#tenCus').val()=='')
    {
        await ToastPro('همه ورودیها پر شوند!', 'top', 'error')
        return
    }
    if(!$('#clearAllfieldsT').hasClass('hidden'))$('#clearAllfieldsT').addClass('hidden')
    $('#tendersList').css('display','block')
    await ToastPro('اطلاعات بروز شد!', 'top', 'success')
    $('#tenderForm').submit()
})


async function delthisTender(tendercode)
{
    $('#tendersList').click()
    Swal.fire({
        html: `<h3>آیا مطمئنید می خواهید مناقصه ${tendercode} را حذف نمایید؟</h3>`,
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
                    delTender: true,
                    tenderCode:tendercode
                }, dataType: "html"
            }).then(async (result) => {
                await ToastPro('مناقصه با موفقیت حذف شد!', 'top', 'success',1)
            })
        }
    })
}