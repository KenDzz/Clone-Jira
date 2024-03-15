Notiflix.Block.init({
    backgroundColor: "rgba(0,0,0,0.3)",
    svgColor: "#f8f8f8",
    messageMaxLength: 19,
});

var selectStatus = new TomSelect("#select-status",{
	create: true,
	sortField: {
		field: "text",
		direction: "asc"
	}
});


new TomSelect("#select-status-new",{
	create: true,
	sortField: {
		field: "text",
		direction: "asc"
	}
});

var controlSelect = new TomSelect('#select-user',{
    create: false,
	valueField: 'id',
	labelField: 'title',
	searchField: 'title',
});

var controlSelectUpdate = new TomSelect('#select-user-update',{
    create: false,
	valueField: 'id',
	labelField: 'title',
	searchField: 'title',
});


function LoadUserNormal() {
    $.ajax({
        url: "/api/auth/user/normal",
        method: "get",
        dataType: "json",
        headers: {
            "X-LOCALIZATION": $("html")[0].lang,
            Authorization: "Bearer " + localStorage.getItem("token"),
        },
        beforeSend: function () {},
        complete: function () {},
        error: function (data) {
            if(data.status == 401){
                logout();
            }
            var errors = $.parseJSON(data.responseText);
            Notiflix.Notify.failure(errors["message"]);
        },
    })
        .done(function (response) {
            $("#select-user").html("");
            $.each(response.data, function (i, item) {
                controlSelect.addOption({
                    id: item.id,
                    title: item.name,
                });
                controlSelectUpdate.addOption({
                    id: item.id,
                    title: item.name,
                });
            });
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {});
}

function LoadListProject() {
    $.ajax({
        url: "/api/v1/projects",
        method: "get",
        dataType: "json",
        headers: {
            "X-LOCALIZATION": $("html")[0].lang,
            Authorization: "Bearer " + localStorage.getItem("token"),
        },
        beforeSend: function () {
            Notiflix.Block.dots(".dashboard");
        },
        complete: function () {
            Notiflix.Block.remove(".dashboard");
        },
        error: function (data) {
            if(data.status == 401){
                logout();
            }
            var errors = $.parseJSON(data.responseText);
            Notiflix.Notify.failure(errors["message"]);
        },
    })
        .done(function (response) {
            $(".list-project").html("");
            $.each(response.data, function (i, item) {
                const date = new Date(item.created_at * 1000);
                var checkActive = '<span class="badge badge-pill badge-success ml-2">'+item.status+'</span>';
                var listBtn = '';
                if(localStorage.getItem("role") == 0){
                    listBtn = '<div class="col-sm-6"><a href="#" class="btn btn-primary w-100 btn-update-project">Update</a></div><div class="col-sm-6"><a href="#" class="btn btn-danger w-100 btn-delete-project">Delete</a></div>';
                }
                $(".list-project").append(
                    '<div class="col-xl-3 col-sm-6 project-detail mt-3" attr-id="' +
                        item.id +
                        '"><div class="card bg-light p-2" ><div class="card-body"><h5 class="card-title">' +
                        item.name +
                        checkActive +
                        ' </h5><p class="card-text">' +
                        item.describes +
                        '</p><div class="member mt-2"><p class="card-text">Project creation date:</p>'+
                        date.toLocaleString()
                        +'</div><div class="row list-btn-action"><div class="col-sm-6"><a href="task/'+item.id+'" class="btn btn-primary w-100">Go Tasks</a></div>'+listBtn+'</div></div></div></div>'
                );
            });
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {});
}



$(document).ready(function () {

    if(localStorage.getItem("role") == 0){
        $(".list-btn-dashboard").html('<button class="btn btn-blue" data-toggle="modal" data-target="#newProjectModal">New Project <span class="flaticon-add"></span></button>');
    }

    LoadListProject();
    LoadUserNormal();
    $("#isexit-update-project").on("change", function () {
        if ($(this).is(":checked")) {
            $("#value-isexit-project").attr("value", 1);
        } else {
            $("#value-isexit-project").attr("value", 0);
        }
    });

    $(document).on("click", ".btn-update-form-project", function () {
        var formData = new FormData($(".form-update-project")[0]);
        formData.append('_method', 'PATCH');
        $.ajax({
            url: "/api/v1/projects/"+$("#id-update-project").val(),
            method: "post",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-LOCALIZATION": $("html")[0].lang,
                Authorization: "Bearer " + localStorage.getItem("token"),
            },
            beforeSend: function () {
                Notiflix.Loading.standard();
            },
            complete: function () {
                Notiflix.Loading.remove();
            },
            success: function (response) {
                if (response["status"] == true) {
                    LoadListProject();
                }
            },
            error: function (data) {
                if(data.status == 401){
                    logout();
                }
                var errors = $.parseJSON(data.responseText);
                var resultString = "";
                for (var key in errors["message"]) {
                    if (errors["message"].hasOwnProperty(key)) {
                        resultString += key + ": ";
                        var valueArray = errors["message"][key];
                        resultString += valueArray.join(", ") + "\n";
                    }
                }
                Notiflix.Notify.failure(resultString);
            },
        });
    });

    $(document).on("click", ".btn-update-project", function () {
        var idProject = $(this)
            .closest(".project-detail")
            .attr("attr-id");
        $("#updateProjectModal").modal("toggle");
        $(".form-update-project")[0].reset();
        $.ajax({
            url: "/api/v1/projects/" + idProject,
            method: "get",
            headers: {
                "X-LOCALIZATION": $("html")[0].lang,
                Authorization: "Bearer " + localStorage.getItem("token"),
            },
            beforeSend: function () {
                Notiflix.Block.dots(".dashboard");
            },
            complete: function () {
                Notiflix.Block.remove(".dashboard");
            },
            success: function (response) {
                if (response["status"] == true) {
                    $("#id-update-project").val(response["data"]["id"]);
                    $("#name-update-project").val(response["data"]["name"]);
                    $("#describes-update-project").html(
                        response["data"]["describes"]
                    );
                    controlSelectUpdate.clear();
                    $.each(response["data"]['member'], function (i, item) {
                        console.log(item.user_id);
                        controlSelectUpdate.addItem(item.user_id);
                    });
                    selectStatus.addItem(response["data"]["status"]);
                }
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                var resultString = "";
                for (var key in errors["message"]) {
                    if (errors["message"].hasOwnProperty(key)) {
                        resultString += key + ": ";
                        var valueArray = errors["message"][key];
                        resultString += valueArray.join(", ") + "\n";
                    }
                }
                Notiflix.Notify.failure(resultString);
            },
        });
    });

    $(document).on("click", ".btn-delete-project", function () {
        var idDeleteProject = $(this)
            .closest(".project-detail")
            .attr("attr-id");
        console.log(idDeleteProject);
        $.ajax({
            url: "/api/v1/projects/" + idDeleteProject,
            method: "delete",
            dataType: "json",
            headers: {
                "X-LOCALIZATION": $("html")[0].lang,
                Authorization: "Bearer " + localStorage.getItem("token"),
            },
            beforeSend: function () {
                Notiflix.Block.dots(".dashboard");
            },
            complete: function () {
                Notiflix.Block.remove(".dashboard");
            },
            success: function (response) {
                if (response["data"] == false) {
                    Notiflix.Notify.failure("Lỗi! Vui lòng thử lại sau");
                } else {
                    Notiflix.Notify.success("Xóa thành công");
                    LoadListProject();
                }
            },
            error: function (data) {
                if(data.status == 401){
                    logout();
                }
                var errors = $.parseJSON(data.responseText);
                var resultString = "";
                for (var key in errors["message"]) {
                    if (errors["message"].hasOwnProperty(key)) {
                        resultString += key + ": ";
                        var valueArray = errors["message"][key];
                        resultString += valueArray.join(", ") + "\n";
                    }
                }
                Notiflix.Notify.failure(resultString);
            },
        });
    });

    $(".btn-new-project").click(function (e) {
        e.preventDefault();
        var formData = new FormData($(".form-new-project")[0]);
        $.ajax({
            url: "/api/v1/projects",
            method: "post",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-LOCALIZATION": $("html")[0].lang,
                Authorization: "Bearer " + localStorage.getItem("token"),
            },
            beforeSend: function () {
                Notiflix.Loading.standard();
            },
            complete: function () {
                Notiflix.Loading.remove();
            },
            success: function (response) {
                console.log(response);
                if (response["status"] == true) {
                    LoadListProject();
                    $("#newProjectModal").modal("toggle");
                    $(".form-new-project")[0].reset();
                    controlSelect.clear();
                }
            },
            error: function (data) {
                if(data.status == 401){
                    logout();
                }
                var errors = $.parseJSON(data.responseText);
                var resultString = "";
                for (var key in errors["message"]) {
                    if (errors["message"].hasOwnProperty(key)) {
                        resultString += key + ": ";
                        var valueArray = errors["message"][key];
                        resultString += valueArray.join(", ") + "\n";
                    }
                }
                Notiflix.Notify.failure(resultString);
            },
        });
    });
});
