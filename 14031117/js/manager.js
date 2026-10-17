$(document).ready(()=>{
    let top = $("#menuList")[0].getBoundingClientRect().bottom;
   // console.log(top)
    $("#iframeDiv").height(`calc(100% - ${top-60}px`)

})
function reloadIframe()
{
    $("#iframeDiv").attr("src",$("#iframeDiv").attr("src"))

}
$('#tolid1').on('click',()=>{
    $('#MainFrame').attr('src',url('manager/tab3'))
    try{
        $('#tolid2').removeClass('bg-slate-200')
    }
    catch (e) {

    }
    try{
        $('#tolid3').removeClass('bg-slate-200')
    }
    catch (e) {

    }
    try{
        $('#tolid4').removeClass('bg-slate-200')
    }
    catch (e) {

    }
    if(!$('#tolid1').hasClass('bg-slate-200'))$('#tolid1').addClass('bg-slate-200')
})
$('#tolid2').on('click',()=>{
    $('#MainFrame').attr('src',url('manager/tab53'))
    try{
        $('#tolid1').removeClass('bg-slate-200')
    }
    catch (e) {

    }
    try{
        $('#tolid3').removeClass('bg-slate-200')
    }
    catch (e) {

    }
    try{
        $('#tolid4').removeClass('bg-slate-200')
    }
    catch (e) {

    }
    if(!$('#tolid2').hasClass('bg-slate-200'))$('#tolid2').addClass('bg-slate-200')
})