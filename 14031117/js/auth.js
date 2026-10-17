$(document).ready(()=>{
    new Swiper(".swiper", {
        autoplay: {
            delay: 10000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        grabCursor: true,
        effect: "coverflow",
        creativeEffect: {
            prev: {
                shadow: true,
                translate: ["-120%", 0, -500],
            },
            next: {
                shadow: true,
                translate: ["120%", 0, -500],
            },
        },
    });
    let pass=$("#password"), name =$("#userName");
    $("#eye").on('click', (function () {
        let type = pass.attr("type");
        if (type === "password") {
            pass.attr("type", "text");
        } else {
            pass.attr("type", "password");
        }
    }))
    $("#logOut").on("click", function (){
        Swal.fire({
            icon:'warning',
            text:'آیا از خروج از حساب کاربری خود اطمینان دارید؟',
            showCancelButton:true,
            cancelButtonText:'انصراف',
            confirmButtonText:'بله'
        }).then(async (result) => {
            if (result.isConfirmed) {
                window.location.href=url("auth/loginModel");
            }
        })
    })

    $("#loginSubmit").on("click", ()=>{
        if(pass.val() === '123' && name.val() === 'admin'){
            window.location.href = url('home')
        }
    })
})