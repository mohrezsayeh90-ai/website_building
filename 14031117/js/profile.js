$(document).ready(() => {
    const skillTags = document.querySelectorAll('.bg-teal-100');
    skillTags.forEach(tag => {
        tag.addEventListener('mouseover', () => {
            tag.classList.remove('bg-teal-100', 'text-teal-700');
            tag.classList.add('bg-blue-900', 'text-white');
        });
        tag.addEventListener('mouseout', () => {
            tag.classList.remove('bg-blue-900', 'text-white');
            tag.classList.add('bg-teal-100', 'text-teal-700');
        });
    });
    $('#editProfile').on('click', function () {
        let btn = $(this);
        switch ($(this).attr("id")) {
            case "editProfile":
                btn.attr("id", "SaveChange").text('Save Changes');
                $("span[aria-label]").each(function () {
                    // console.log(s)
                    let value = $(this).text().trim(), id = $(this).attr('data-id');
                    let input = ` <input aria-label="virtual-input" id="${id}" name="${id}" type="text" value="${value}"
                       class="ltr md:me-4 border focus:border-0 w-full focus:ring-2 hover:border-teal-400 bg-transparent hover:border focus:ring-teal-400"
                       autocomplete="off"/>`;
                    $(this).before(input)
                    $(this).remove()
                })
                let ul = $("#ulProfile");
                $(".profile-signature").addClass('hidden')
               ul.append(` <li class="">
                <div class="flex items-center">
               <span class="text-teal-700 me-2 mr-2"><i class="fa fa-lock"></i></span>
                     <input aria-label="virtual-input" id="userPassword" type="text" placeholder="تغییر رمز ورود"
                       class="ltr md:me-4 border focus:border-0 w-full focus:ring-2 hover:border-teal-400 bg-transparent hover:border focus:ring-teal-400"
                       autocomplete="off"/>
                       </div>
                       <small class="text-gray-500 mr-4">*حداقل ۶ کاراکتر و ترکیبی
                               از اعداد و حروف انگلیسی بزرگ و کوچک<small/>
                    </li>`)
               ul.after(` <label class="block w-fit mt-4 mr-10 bg-black p-2 text-white text-sm rounded-lg cursor-pointer font-medium
                 dark:text-white" id="userSignatureLabel" for="userSignature">بارگذاری تصویر امضا</label>
                <input class="hidden" accept=".png,.jpg" type="file" id="userSignature" name="files" hidden="">`)
                $('#profileIMG').before(`<div id="ImgDiv" class="rounded-full w-48 h-48 mx-auto mb-4 border-4 border-teal-700 dark:border-blue-900 transition-transform duration-300 hover:scale-105">
                    <label for="personalIMG" class="block leading-10 w-full h-full">Profile Picture</label>
                    <input id="personalIMG" type="file" hidden=""/>
                </div>`).remove();
                break;
            case "SaveChange":
                let pas = $('#userPassword').val();
                let form_Data = new FormData;
                form_Data.append("file", document.getElementById("personalIMG").files[0]);
                form_Data.append("sign", document.getElementById("userSignature").files[0]);
                form_Data.append("data", JSON.stringify({
                    'email': $('#userEmail').val().trim(),
                    'phone': $('#userPhone').val().trim(),
                    'address': $('#userAddress').val().trim(),
                    'password': pas.trim(),
                }));
                if (pas && !pasRegEx(pas)) {
                    Swal.fire({
                        width: '20rem',
                        position: "top",
                        icon: "error",
                        title: "رمز عبور نامعتبر!",
                        showConfirmButton: false,
                        timer: 2000
                    });
                } else {
                    $.ajax({
                        url: url("profile/submit"), // Upload Script
                        dataType: 'script',
                        cache: false,
                        contentType: false,//necessary for multiple data formats
                        processData: false,//necessary for multiple data formats
                        data: form_Data,
                        type: 'POST',
                    }).done(res => {
                        console.log(JSON.parse(res))
                        let jsn = JSON.parse(res);
                        btn.attr("id", "editProfile").text('Edit Profile');
                        $("[aria-label=virtual-input]").each(function () {
                            // console.log(s)
                            let value = $(this).val().trim(), id = $(this).attr('id');
                            let span = ` <span aria-label="data-editable" data-id="${id}">${value}</span>`
                            $(this).before(span)
                            $(this).remove()
                        })
                        $(".profile-signature").removeClass('hidden')
                        $("#ulProfile li:last-child").remove();
                        $("#userSignatureLabel").remove();
                        $("#userSignature").remove();
                        $("#ImgDiv").before(`<img id="profileIMG" src="${url('assets/images/profiles/' + jsn.ax)}"
                         alt="Profile Picture"
                     class="leading-10 text-center rounded-full w-48 h-48 mx-auto mb-4 border-4 border-teal-700 dark:border-blue-900 transition-transform
                      duration-300 hover:scale-105">`).remove();
                        if (jsn.ax) {
                            $("#userProfilePicture").attr("src", url('assets/images/profiles/' + jsn.ax));
                        }
                        if (jsn.signature) {
                            $("#personSignature").attr("src", url('assets/images/signs/' + jsn.signature));
                        }
                    })
                }

        }
    })
})