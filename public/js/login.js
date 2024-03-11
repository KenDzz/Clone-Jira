Notiflix.Notify.init({
    position: "right-bottom",
});


document.addEventListener('DOMContentLoaded', function() {
    if (localStorage.getItem('token')) {
        window.location.href = '/dashboard';
    }
});

$(document).ready(function () {

    $('.btn-login').click(function (e) {
        e.preventDefault();
        var formData = new FormData($("#form-login")[0]);
        $.ajax({
            url: "/api/auth/login",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-LOCALIZATION": $('html')[0].lang,
            },
            beforeSend: function () {
                Notiflix.Loading.standard();
            },
            complete: function () {
                Notiflix.Loading.remove();
            },
            success: function (response) {
                if(response['status'] == true){
                    localStorage.setItem('token', response['data']['access_token']);
                    localStorage.setItem('name', response['data']['name']);
                    localStorage.setItem('role', response['data']['role']['id']);
                    localStorage.setItem('id', response['data']['id']);

                    window.location.href = "/dashboard";
                }
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                var resultString = '';
                for (var key in errors['message']) {
                    if (errors['message'].hasOwnProperty(key)) {
                        resultString += key + ": ";
                        var valueArray = errors['message'][key];
                        resultString += valueArray.join(", ") + "\n";
                    }
                }
                Notiflix.Notify.failure(resultString);
            },
        });
    });


});
