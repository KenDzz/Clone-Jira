Notiflix.Notify.init({
    position: "right-bottom",
});

document.addEventListener('DOMContentLoaded', function() {
    // checkAuth();
    if (!localStorage.getItem('token')) {
        window.location.href = '/';
    }
});

// function checkAuth() {
//     $.ajax({
//         url: "/api/auth/me",
//         method: "get",
//         dataType: "json",
//         headers: {
//             "X-LOCALIZATION": $('html')[0].lang,
//             "Authorization": "Bearer " + localStorage.getItem('token'),
//         },
//         beforeSend: function(xhr) {
//         },
//         complete: function () {},
//         error: function (data) {
//             if(data.status == 401){
//                 logout();
//             }
//         },
//     })
//         .done(function (data) {
//         })
//         .fail(function (jqXHR, ajaxOptions, thrownError) {});
// }

function logout() {
    window.localStorage.removeItem('token');
    window.localStorage.removeItem('name');
    window.localStorage.removeItem('role');
    window.location.href = '/';
}


$(document).ready(function () {
    $('.name-account').html(localStorage.getItem('name'));
    $(".btn-logout").click(function (e) {


        $.ajax({
            url: "/api/auth/logout",
            method: "post",
            dataType: "json",
            headers: {
                "X-LOCALIZATION": $('html')[0].lang,
                "Authorization": "Bearer " + localStorage.getItem('token'),
            },
            beforeSend: function(xhr) {
            },
            complete: function () {},
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                Notiflix.Notify.failure(errors['message']);
            },
        })
            .done(function (data) {
                if (data["status"] == true) {
                    logout();
                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {});

    });
});
