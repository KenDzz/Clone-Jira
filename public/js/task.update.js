Notiflix.Block.init({
    backgroundColor: "rgba(0,0,0,0.3)",
    svgColor: "#f8f8f8",
    messageMaxLength: 19,
});

let theEditor;
let urlBack = "";

var controlSelect = new TomSelect("#select-user", {
    create: false,
    valueField: "id",
    labelField: "title",
    searchField: "title",
});

var controlSelectCategory = new TomSelect("#select-category", {
    create: false,
    valueField: "id",
    labelField: "title",
    searchField: "title",
});

var controlSelectLevel = new TomSelect("#select-level", {
    create: false,
    valueField: "id",
    labelField: "title",
    searchField: "title",
});

var controlSelectPriority = new TomSelect("#select-priority", {
    create: false,
    valueField: "id",
    labelField: "title",
    searchField: "title",
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
            });
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {});
}

function LoadCategory() {
    $.ajax({
        url: "/api/category",
        method: "get",
        dataType: "json",
        headers: {
            "X-LOCALIZATION": $("html")[0].lang,
            Authorization: "Bearer " + localStorage.getItem("token"),
        },
        beforeSend: function () {},
        complete: function () {},
        error: function (data) {
            var errors = $.parseJSON(data.responseText);
            Notiflix.Notify.failure(errors["message"]);
        },
    })
        .done(function (response) {
            $("#select-category").html("");
            $.each(response.data, function (i, item) {
                controlSelectCategory.addOption({
                    id: item.id,
                    title: item.name,
                });
            });
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {});
}

function LoadLevel() {
    $.ajax({
        url: "/api/level",
        method: "get",
        dataType: "json",
        headers: {
            "X-LOCALIZATION": $("html")[0].lang,
            Authorization: "Bearer " + localStorage.getItem("token"),
        },
        beforeSend: function () {},
        complete: function () {},
        error: function (data) {
            var errors = $.parseJSON(data.responseText);
            Notiflix.Notify.failure(errors["message"]);
        },
    })
        .done(function (response) {
            $("#select-level").html("");
            $.each(response.data, function (i, item) {
                controlSelectLevel.addOption({
                    id: item.id,
                    title: item.name,
                });
            });
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {});
}

function LoadPriority() {
    $.ajax({
        url: "/api/priority",
        method: "get",
        dataType: "json",
        headers: {
            "X-LOCALIZATION": $("html")[0].lang,
            Authorization: "Bearer " + localStorage.getItem("token"),
        },
        beforeSend: function () {},
        complete: function () {},
        error: function (data) {
            var errors = $.parseJSON(data.responseText);
            Notiflix.Notify.failure(errors["message"]);
        },
    })
        .done(function (response) {
            $("#select-priority").html("");
            $.each(response.data, function (i, item) {
                controlSelectPriority.addOption({
                    id: item.id,
                    title: item.name,
                });
            });
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {});
}

function getDataTask() {
    var pathUrl = window.location.pathname;
    var listPath = pathUrl.split("/");
    var lastItem = listPath.pop();
    $(".task-id").val(lastItem);
    $(".task-id-hidden").val(lastItem);
    $.ajax({
        url: "/api/task/info/" + lastItem,
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
            var errors = $.parseJSON(data.responseText);
            Notiflix.Notify.failure(errors["message"]);
        },
    })
        .done(function (response) {
            var dataTask = response.data;
            $("#task-name").val(dataTask.name);
            controlSelectCategory.addItem(dataTask.category.id);
            controlSelectLevel.addItem(dataTask.level.id);
            controlSelectPriority.addItem(dataTask.priority.id);
            $.each(dataTask.user, function (indexInArray, valueOfElement) {
                controlSelect.addItem(valueOfElement.user_id);
            });
            if(localStorage.getItem("role") != 1){
                $("#task-name").prop('disabled', true);
                controlSelectCategory.disable();
                controlSelectLevel.disable();
                controlSelectPriority.disable();
                controlSelect.disable();
                $("#estimate-date").prop('disabled', true);
            }
            if(localStorage.getItem("role") == 1){
                theEditor.setData(dataTask.describes);
            }else{
                $(".form-editor").css("display", "none");
                $(".content-desc").html("<label>Describes</label>"+dataTask.describes);
            }
            var startTime = new Date(dataTask.start_time * 1000);
            var dueTime = new Date(dataTask.estimate_time * 1000);
            urlBack = "/task/" + dataTask.project.id;
            $('input[name="datetimes"]').daterangepicker({
                timePicker: true,
                startDate: startTime,
                endDate: dueTime,
                locale: {
                    format: "M/DD/YYYY hh:mm A",
                },
            });
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {});
}

function UpdateLevelTask(type) {
    $.ajax({
        url: "/api/task/level/update",
        method: "post",
        dataType: "json",
        data: {
            id: $(".task-id-hidden").val(),
            level_id: $("#select-level").val(),
            type: type
        },
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
            if (response["status"] == false) {
                Notiflix.Notify.failure(response["data"]["message"]);
            } else {
                window.location.href = urlBack;
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
}

$(document).ready(function () {
    LoadUserNormal();
    LoadCategory();
    LoadLevel();
    LoadPriority();
    getDataTask();


    if(localStorage.getItem("role") == 1){
        $(".list-btn-update-task").append('<button class="btn btn-blue btn-update-task">Save Task  <span class="flaticon-save"></span></button><button class="btn btn-blue btn-delete-task">Delete Task</button>');
    }

    $(document).on("click", ".btn-delete-task", function () {
        var idDeleteTask = $(".task-id-hidden").val();
        $.ajax({
            url: "/api/task/delete/" + idDeleteTask,
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
                    window.location.href = urlBack;
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

    $(".btn-update-task").click(function (e) {
        e.preventDefault();
        var formData = new FormData($(".form-update-task")[0]);
        formData.append("describes", theEditor.getData());

        $.ajax({
            url: "/api/task/update",
            method: "post",
            data: formData,
            contentType: false,
            processData: false,
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
                console.log(response);
                if (response["data"] == false) {
                    Notiflix.Notify.failure("Lỗi! Vui lòng thử lại sau");
                } else {
                    Notiflix.Notify.success("Cập nhật thành công");
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

    $(".btn-next-task").click(function (e) {
        e.preventDefault();
        UpdateLevelTask(1);
    });

    $(".btn-previous-task").click(function (e) {
        e.preventDefault();
        UpdateLevelTask(0);
    });
});

var editor = CKEDITOR.ClassicEditor.create(document.querySelector("#editor"), {
    // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
    toolbar: {
        items: [
            "exportPDF",
            "exportWord",
            "|",
            "findAndReplace",
            "selectAll",
            "|",
            "heading",
            "|",
            "bold",
            "italic",
            "strikethrough",
            "underline",
            "code",
            "subscript",
            "superscript",
            "removeFormat",
            "|",
            "bulletedList",
            "numberedList",
            "todoList",
            "|",
            "outdent",
            "indent",
            "|",
            "undo",
            "redo",
            "-",
            "fontSize",
            "fontFamily",
            "fontColor",
            "fontBackgroundColor",
            "highlight",
            "|",
            "alignment",
            "|",
            "link",
            "insertImage",
            "blockQuote",
            "insertTable",
            "mediaEmbed",
            "codeBlock",
            "htmlEmbed",
            "|",
            "specialCharacters",
            "horizontalLine",
            "pageBreak",
            "|",
            "textPartLanguage",
            "|",
            "sourceEditing",
        ],
        shouldNotGroupWhenFull: true,
    },
    // Changing the language of the interface requires loading the language file using the <script> tag.
    // language: 'es',
    list: {
        properties: {
            styles: true,
            startIndex: true,
            reversed: true,
        },
    },
    ckfinder: {
        uploadUrl: "/api/images/upload",
    },
    // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
    heading: {
        options: [
            {
                model: "paragraph",
                title: "Paragraph",
                class: "ck-heading_paragraph",
            },
            {
                model: "heading1",
                view: "h1",
                title: "Heading 1",
                class: "ck-heading_heading1",
            },
            {
                model: "heading2",
                view: "h2",
                title: "Heading 2",
                class: "ck-heading_heading2",
            },
            {
                model: "heading3",
                view: "h3",
                title: "Heading 3",
                class: "ck-heading_heading3",
            },
            {
                model: "heading4",
                view: "h4",
                title: "Heading 4",
                class: "ck-heading_heading4",
            },
            {
                model: "heading5",
                view: "h5",
                title: "Heading 5",
                class: "ck-heading_heading5",
            },
            {
                model: "heading6",
                view: "h6",
                title: "Heading 6",
                class: "ck-heading_heading6",
            },
        ],
    },
    // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
    placeholder: "Welcome to CKEditor 5!",
    // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
    fontFamily: {
        options: [
            "default",
            "Arial, Helvetica, sans-serif",
            "Courier New, Courier, monospace",
            "Georgia, serif",
            "Lucida Sans Unicode, Lucida Grande, sans-serif",
            "Tahoma, Geneva, sans-serif",
            "Times New Roman, Times, serif",
            "Trebuchet MS, Helvetica, sans-serif",
            "Verdana, Geneva, sans-serif",
        ],
        supportAllValues: true,
    },
    // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
    fontSize: {
        options: [10, 12, 14, "default", 18, 20, 22],
        supportAllValues: true,
    },
    // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
    // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
    htmlSupport: {
        allow: [
            {
                name: /.*/,
                attributes: true,
                classes: true,
                styles: true,
            },
        ],
    },
    // Be careful with enabling previews
    // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
    htmlEmbed: {
        showPreviews: true,
    },
    // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
    link: {
        decorators: {
            addTargetToExternalLinks: true,
            defaultProtocol: "https://",
            toggleDownloadable: {
                mode: "manual",
                label: "Downloadable",
                attributes: {
                    download: "file",
                },
            },
        },
    },
    // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
    mention: {
        feeds: [
            {
                marker: "@",
                feed: [
                    "@apple",
                    "@bears",
                    "@brownie",
                    "@cake",
                    "@cake",
                    "@candy",
                    "@canes",
                    "@chocolate",
                    "@cookie",
                    "@cotton",
                    "@cream",
                    "@cupcake",
                    "@danish",
                    "@donut",
                    "@dragée",
                    "@fruitcake",
                    "@gingerbread",
                    "@gummi",
                    "@ice",
                    "@jelly-o",
                    "@liquorice",
                    "@macaroon",
                    "@marzipan",
                    "@oat",
                    "@pie",
                    "@plum",
                    "@pudding",
                    "@sesame",
                    "@snaps",
                    "@soufflé",
                    "@sugar",
                    "@sweet",
                    "@topping",
                    "@wafer",
                ],
                minimumCharacters: 1,
            },
        ],
    },
    // The "super-build" contains more premium features that require additional configuration, disable them below.
    // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
    removePlugins: [
        // These two are commercial, but you can try them out without registering to a trial.
        // 'ExportPdf',
        // 'ExportWord',
        "CKBox",
        "CKFinder",
        "EasyImage",
        // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
        // Storing images as Base64 is usually a very bad idea.
        // Replace it on production website with other solutions:
        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
        // 'Base64UploadAdapter',
        "RealTimeCollaborativeComments",
        "RealTimeCollaborativeTrackChanges",
        "RealTimeCollaborativeRevisionHistory",
        "PresenceList",
        "Comments",
        "TrackChanges",
        "TrackChangesData",
        "RevisionHistory",
        "Pagination",
        "WProofreader",
        // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
        // from a local file system (file://) - load this site via HTTP server if you enable MathType
        "MathType",
    ],
})
    .then((editor) => {
        if (editor) {
            theEditor = editor;
            theEditor.plugins.get("FileRepository").createUploadAdapter = (
                loader
            ) => {
                return {
                    upload: () => {
                        return loader.file
                            .then((file) => {
                                return new Promise((resolve, reject) => {
                                    const xhr = new XMLHttpRequest();
                                    xhr.open(
                                        "POST",
                                        "/api/images/upload",
                                        true
                                    );
                                    xhr.setRequestHeader(
                                        "Authorization",
                                        "Bearer " +
                                            localStorage.getItem("token")
                                    );
                                    xhr.setRequestHeader(
                                        "X-LOCALIZATION",
                                        $("html")[0].lang
                                    );
                                    xhr.responseType = 'json';
                                    const formData = new FormData();
                                    formData.append("upload", file);
                                    xhr.send(formData);
                                    xhr.onload = () => {
                                        if (xhr.status === 200) {

                                            resolve({ default: xhr.response.url });
                                        } else {
                                            reject("Upload failed");
                                        }
                                    };
                                });
                            })
                            .catch((error) => {
                                console.error(
                                    "Error during file upload:",
                                    error
                                );
                                throw error;
                            });
                    },
                };
            };
        }
    })
    .catch((error) => {
        console.error(error);
    });
