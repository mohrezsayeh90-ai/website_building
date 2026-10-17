//////****** product name
name.on('keyup', async (ev) => {
    let inp = $(ev.target);
    if (ev.which === 13) {
        // if(code.val().length>0){//////edit
        //     await get(url('product/setName/'), {name: inp.val(), code:code.val()})
        // }else {//create
        let tend = await get(url('tender/setName/'), {name: inp.val()}), json = JSON.parse(tend);
        $("#tenCode").val(json.code)
        // }
    }
})

let table = $("#tendersTable");
table.on('click', 'tbody tr', function () {
    name.val($(this).find('td[aria-label=name]').text());
    code.val($(this).find('td[aria-label=code]').text());
})

let scroll_div = $(".my-scroll-parent").parent("div:eq(0)");
if (scroll_div.length > 0) {
    let top = scroll_div[0].getBoundingClientRect().top;
    scroll_div.height(`calc(100vh - ${top + 10}px)`)
}
// $(".show-details").on("click", function () {
//     let details = post(url('tList/details'), {code: $(this).attr('id')}), json = JSON.parse(details), trs = ``;
//     json[0].forEach((j, i) => {
//         trs += `<tr><td class="bg-my-gray">${i + 1}</td><td class="bg-my-gray">${j.description}</td>
//         <td class="bg-my-gray">${j.type}</td><td class="bg-my-gray">${j.manufacturer}</td></tr>`
//     })
//     let table = `<table class="table-auto font-small ltr">
//     <thead>
//     <tr>
//     <th class="bg-bright-teal" scope='col'>row</th><th class="bg-bright-teal" scope='col'>description</th>
//     <th class="bg-bright-teal" scope='col'>type</th><th class="bg-bright-teal" scope='col'>manufacturer</th>
//     </tr>
//     </thead>
//     <tbody>${trs}</tbody>
//     </table>`;
//     let extensions = ["png", "jpeg", "jpg", "gif"];
//     let files = `<p class="pt-2">اسناد مربوطه</p><div class="flex flex-wrap flex-row items-center file-display">`;
//     json[1].forEach(j => {
//         if (j.type === "pdf") {
//             files += ` <a class="ml-2" href="${assets("images/products/" + j.nam)}" target="_blank">
//                                     <iframe src="${assets("images/products/" + j.nam)}"
//                                            width="100" height="100"></iframe>
//                                 </a>`
//         } else if (extensions.includes(j.type)) {
//             files += `<a class="ml-2" href="${assets("images/products/" + j.nam)}" target="_blank">
//                                     <img src="${assets("images/products/" + j.nam)}"
//                                          width="100" height="100" alt="اسناد مربوطه"/>
//                                 </a>`
//         }
//     })
//     files += `</div>`
//     Swal.fire({
//         title: `جزئیات محصول ${$(this).val()}`,
//         html: table + files,
//         showCloseButton: false,
//         showCancelButton: false,
//         confirmButtonText: `<i class="fa fa-close"></i>`
//     });
// })
let target = document.querySelector('h2[aria-label]')
target = target ? target.innerText : null;
// $(".show-docs").on("click", function () {
//     let details = post(url('tList/document'), {code: target}), json = JSON.parse(details);
//     let extensions = ["png", "jpeg", "jpg", "gif"];
//     let files = `<div class="flex flex-wrap flex-row align-center file-display">`;
//     let tit = json.length > 0 ? `اسناد مربوط به مناقصه${json[0].mon_cod}` : 'سندی وجود ندارد!!';
//     json.forEach(j => {
//         if (j.type === "pdf") {
//             files += ` <a href="${assets("images/tenders/" + j.nam)}" target="_blank">
//                                     <iframe src="${assets("images/tenders/" + j.nam)}"
//                                            width="100" height="100"></iframe>
//                                 </a>`
//         } else if (extensions.includes(j.type)) {
//             files += `<a href="${assets("images/tenders/" + j.nam)}" target="_blank">
//                                     <img src="${assets("images/tenders/" + j.nam)}"
//                                          width="100" height="100" alt="اسناد مربوطه"/>
//                                 </a>`
//         } else {
//             files += `<a href="${assets("images/office.png")}" target="_blank">
//                                     <img src='${assets('images/office.png')}'
//                                          width="100" height="100" alt="اسناد مربوطه"/>
//                                 </a>`
//         }
//     })
//     files += `</div>`
//     console.log(files)
//     Swal.fire({
//         title: tit,
//         html: files,
//         showCloseButton: false,
//         showCancelButton: false,
//         confirmButtonText: `<i class="fa fa-close"></i>`
//     });
// })
// let pic = $('.card_image img'), file = $("#file"), src1 = pic.attr('src'), src2 = assets('images/tender.png');
//
// pic.on('mouseenter', function () {
//     $(this).attr('src', src2);
// })
// pic.on('mouseleave', function () {
//     $(this).attr('src', src1);
// })
// pic.on('click', function () {
//     file.trigger('click');
// })
// file.on('change', function () {
//     let form_Data = new FormData;
//     form_Data.append("file", this.files[0]);
//     form_Data.append('t', target);
//     $.ajax({
//         url: url("tList/upload"),
//         dataType: 'script',
//         cache: false,
//         contentType: false,
//         processData: false,
//         data: form_Data,
//         type: 'POST',
//         success: function (res) {
//             //console.log(res)
//             let json = JSON.parse(res);
//             pic.attr('src', assets(`images/tenders/${json}`));
//             pic.on('mouseleave', function () {
//                 $(this).attr('src', assets(`images/tenders/${json}`));
//             })
//         }
//     })
// })