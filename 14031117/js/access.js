let dom = $(document);
dom.ready(() => {
    $(".fa-chevron-left").on("click", function () {
        $(this).toggleClass("rotate--90deg");
        $(this).closest("div").siblings(".chevron-target").toggleClass("d-none")
    })
    let accessInput = $(".access-permission");
    accessInput.on("change", function () {
        let pageCon = $(this).siblings(".list-group");
        if (this.checked) {
            pageCon.find('input').prop("checked", true);
            pageCon.removeClass("d-none");
        } else {
            pageCon.find('input').prop("checked", false);
            pageCon.addClass("d-none");
        }
    })

    let name = $("#teamName"), desc = $("#teamDesc"), listGroup = $("#teamListGroup"), divListGroup = $(".list-group"),
        userTeam = $("#userTeam"), userName = $("#userName"), userPas = $("#userPass"), userRole = $("#userRole"),
        search = $("#searchM"),
        mListGroup = $("#memberListGroup"), memberUl = $(".absolute-year--ul"), tHideInp = $("#teamId"),
        uHideInp = $("#userId"),
        mDiv = $("#memberDiv"), searchDiv = $("#searchDiv"), creatUser = $("#createUser"),
        createTeam = $("#createTeam"), singleUsersOL = $(".single-users ol"), teamUsersOl = $(".in-team-users ol");


    ////////////////******* select team

    function resetTeam() {
        name.val('');
        desc.val('');
        tHideInp.val('');
        $("#accordionExample [type = checkbox]").prop("checked", false);
    }

    function resetUser() {
        userPas.val('');
        userName.val('');
        userRole.val('');
        uHideInp.val('');
        $("[name=avaTeam]").prop("checked", false);
        // $("#accordionExample0 [type = checkbox]").prop("checked", false);
    }

    $("#resetTeam").on("click", function () {
        resetTeam();
        $(this).hide() && createTeam.text("ایجاد");
    })
    $("#resetUser").on("click", function () {
        resetUser();
        $(this).hide() && creatUser.text("ایجاد");
    })
    let radioInp = $("[name=teamListGroupRadio]"), teamAccordion = $("#collapseOne")
    /////////*** click team radio button
    dom.on("change", "[name=teamListGroupRadio]", async function (ev) {
        resetTeam();
        let teamId = $(ev.target).attr("id").slice(10);
        // console.log(teamId)
        let exist = await post('auth/access', {getTeamAccess: true, team: teamId}), json = JSON.parse(exist);
        //console.log(json);
        teamAccordion.addClass("show")
        $(".inner-accordion").removeClass("d-none")
        if (json.length > 0) {
            name.val(json[0].nam);
            desc.val(json[0].tozih);
            tHideInp.val(json[0].id);
            $("#createTeam").html("ویرایش").siblings("button").show();
            for (let i = 0; i < json.length; i++) {
                let bigInp = teamAccordion.find(`[value = check${json[i].page_id}]`).parents("ul:eq(0)").siblings("input");
                if (!bigInp.checked) bigInp.prop("checked", true);
                teamAccordion.find(`[value = check${json[i].page_id}]`).prop("checked", true)
            }
        }
    })
    /////////*** click team radio button
    ////////////////******* select team
    /////////******** ACCESS TEAM****////////
    $("#confirmTeamAccess").on("click", async function () {
        let team = $("[name=teamListGroupRadio]:checked"),
            teamId = team.attr("id").slice(10),
            teamName = team.siblings("label").text();
        console.log(userTeam.find(`#avaTeam${teamId}`))
        if (team.length === 0) {
            Swal.fire({icon: "error", text: "یک تیم را انتخاب کنید!", confirmButtonText: "باشه!"});
        } else {
            let pages = [];
            document.querySelectorAll("#collapseOne [type=checkbox]").forEach((val) => {
                if (val.checked) {
                    pages.push(val.value.slice(5));
                }
            })
            let set = await post('auth/access', {addTeamAccess: true, team: teamId, pages: pages});
            if (JSON.parse(set) === "done") {
                Swal.fire({
                    icon: "success",
                    text: "دسترسی ها با موفقیت ایجاد شدند.",
                    showConfirmButton: false,
                    timer: 2000
                });
                createTeam.html("ایجاد").siblings("button").hide();
                if (userTeam.find(`#avaTeam${teamId}`).length === 0) {
                    userTeam.append(` <input type="checkbox" class="form-check-input" id="avaTeam${teamId}"
                 name="avaTeam" value="${teamId}"><label for="avaTeam${teamId}">${teamName}</label><br/>`);
                }
                resetTeam();
            } else {
                Swal.fire({
                    icon: "info",
                    text: "دسترسی های تیم مورد انتخاب حذف شدند.",
                    showConfirmButton: false,
                    timer: 2000
                });
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
            }
        }
    })
    /////////******** ACCESS TEAM****////////
    /////////******** ACCESS MEMBER****////////
    // search.on("keyup", async function () {
    //     let search = await get('auth/access/', {search: true, inpVal: convertToEnNumber($(this).val())});
    //     console.log(search)
    //     let js = JSON.parse(search)
    //     memberUl.parents(".absolute-year").show()
    //     let lis = ``;
    //     js.forEach(json => {
    //         lis += `<li class="li-${json.id}">${json.pNam + " " + json.pFamili + " _" + json.pCod}</li>`
    //     })
    //     memberUl.html(lis)
    // })
    //
    // ///*** add li
    // memberUl.on("click", 'li', function () {
    //     let num = $(this).attr("class").split("-")[1],
    //         nam = $(this).text();
    //     search.val('');
    //     searchDiv.addClass("d-none");
    //     mDiv.html(`<h4 class="form-check-label d-inline-block" id="chooseAccess${num}">${nam}</h4>
    //            <input type="text" class="rounded p-2 mx-3" id="role" placeholder="سمت"/>`)
    //
    //     memberUl.parents(".absolute-year").hide()
    // })
    creatUser.on("click", async function () {
        let team = $("[name=avaTeam]:checked");
        let userVal = userName.val(), pasVal = userPas.val();
        if (userVal.length === 0 || pasVal.length === 0) {
            Swal.fire({icon: "error", text: "ورودی های ستاره دار را پر کنید!", confirmButtonText: "باشه!"});
        } else if (!pasRegEx(userPas.val())) {
            Swal.fire({
                width: '20rem',
                position: "top",
                icon: "error",
                title: "رمز عبور نامعتبر!",
                showConfirmButton: false,
                timer: 2000
            });
        } else if (team.length === 0) {
            Swal.fire({
                position: "top",
                icon: "error",
                title: "حداقل یک تیم باید انتخاب شود!",
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            $.ajax({
                url: url(`access/user`),
                method: 'POST',
                data: {
                    user: userVal.trim(), pass: pasVal.trim(),
                    role: userRole.val().trim(), team: team.val().trim()
                }
            }).done(res => {
                console.log(res)
                let json = JSON.parse(res);
                if (json) Swal.fire({
                    icon: 'success', title: 'موفقیت آمیز!', timer: 2000, showConfirmButton: false, position: "top"
                })

                resetUser()
            })

        }////create stuff


    })
/////////** SEND ACCESS**/////
    let uRadioInp = $("[name=listGroupRadio]"), uAccordion = $("#collapseTwo")
    $("#confirmMemberAccess").on("click", async function () {
        let uRadioInp = $("[name=listGroupRadio]:checked");
        //console.log(uRadioInp)
        if (uRadioInp.parents('ol').attr("id") === "inTeamListGroup") {
            Swal.fire({
                icon: "error",
                text: "فقط برای اعضای مستقل می توانید دسترسی تعیین کنید!",
                confirmButtonText: "باشه!"
            });
        } else if (!uRadioInp.length > 0) {
            Swal.fire({icon: "error", text: "یک عضو مستقل را انتخاب کنید!", confirmButtonText: "باشه!"});
        } else {
            let pages = [];
            let member = uRadioInp.attr("id").slice(11);
            document.querySelectorAll("#collapseTwo [type=checkbox]").forEach((val) => {
                if (val.checked) {
                    pages.push(val.value.slice(6));
                }
            })
            //console.log(pages, member)
            let set = await post('auth/access', {
                addAccessU: true,
                member: member,
                pages: pages
            })
                , jsn = JSON.parse(set);
            //  console.log(jsn)
            if (jsn === "added") {
                resetUser();
                Swal.fire({
                    icon: "success",
                    text: "دسترسی ها با موفقیت ایجاد شدند.",
                    showConfirmButton: false,
                    timer: 2000
                });
            } else Swal.fire({
                icon: "info",
                text: "دسترسی های عضو انتخابی حذف شدند.",
                showConfirmButton: false,
                timer: 2000
            });
        }
        creatUser.html("ایجاد").siblings("button").hide();
    })
/////////** SEND ACCESS**/////
//////// choose member

    dom.on("change", "[name=listGroupRadio]", async function (ev) {
        resetUser();
        let mId = $(ev.target).attr("id").slice(11),
            nam = $(ev.target).siblings("label").text().split("_"),
            nfCode = nam[0].trim() + " " + (nam[nam.length - 1]).trim();
        let exist = await post('auth/access', {getAccessM: true, member: mId}), json = JSON.parse(exist);
        // console.log(json);
        ///*** edit stuff
        uAccordion.addClass("show")
        $(".inner-accordion").removeClass("d-none")
        userName.val(json[0].userName) && userRole.val(json[0].semat) && uHideInp.val(json[0].id)
        && creatUser.html("ویرایش").siblings("button").show();
        if (json[0].tim_id) {////تیک زدن تیم ها در باکس ادیت
            json.forEach(j => {
                $(`#userTeam #avaTeam${j.tim_id}`).prop("checked", true);
            })
        }
        if (json[0].page_id) {//////تیک زدن دسترسی ها
            json.forEach(j => {
                // let bigInp = uAccordion.find(`[value = check0${j.page_id}]`).parents("ul:eq(0)").siblings("input");
                // if (!bigInp.checked) bigInp.prop("checked", true);
                uAccordion.find(`[value = check0${j.page_id}]`).prop("checked", true)
            })
        }
        ///*** edit stuff
        // mAccordion.addClass("show");
        // $(".inner-accordion").removeClass("d-none");
        // searchDiv.addClass('d-none');
        // let smt = json[0].semat ? json[0].semat : ""
        // mDiv.html(`<h4 class="form-check-label d-inline-block" id="chooseAccess${mId}">${nfCode}</h4>
        //        <input type="text" class="rounded p-2 mx-3" id="role" placeholder="سمت" value="${smt}"/>`);
        //
        // // name.val(json[0].nam);
        // // desc.val(json[0].tozih);
        // for (let i = 0; i < json.length; i++) {
        //     let bigInp = mAccordion.find(`[value = check0${json[i].page_id}]`).parents("ul:eq(0)").siblings("input");
        //     if (!bigInp.checked) bigInp.prop("checked", true);
        //     mAccordion.find(`[value = check0${json[i].page_id}]`).prop("checked", true)
        // }
    })

    /////*** delete users
    $("#member-tab-pane").on("click", ".fa-trash", function () {
        let li = $(this).parents("li"), user = li.attr("id").slice(2);
        Swal.fire({
            icon: 'warning',
            text: 'آیا از حذف کاربر و دسترسی های ایشان اطمینان دارید؟',
            showCancelButton: true,
            cancelButtonText: 'انصراف',
            confirmButtonText: 'حذف شود'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let del = await post('auth/access', {delete: true, user: user});
                console.log(del)
                if (del === 'done') location.reload();
            }
        })
    })
    /////*** delete teams
    listGroup.on("click", ".fa-trash", function () {
        let li = $(this).parents("li"), team = li.attr("id").slice(6);
        Swal.fire({
            icon: 'warning',
            text: 'آیا از حذف تیم و دسترسی های آن اطمینان دارید؟',
            showCancelButton: true,
            cancelButtonText: 'انصراف',
            confirmButtonText: 'حذف شود'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let del = await post('auth/access', {deleteTeam: true, team: team});
                console.log(del)
                if (del === 'done') location.reload();
            }
        })
    })
})