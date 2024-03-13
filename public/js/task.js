Notiflix.Block.init({
    backgroundColor: "rgba(0,0,0,0.3)",
    svgColor: "#f8f8f8",
    messageMaxLength: 19,
});

let theEditor;

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
            if(data.status == 401){
                logout();
            }
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
            if(data.status == 401){
                logout();
            }
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
            if(data.status == 401){
                logout();
            }
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

function Category(type) {
    let retVal = "";
    switch (type) {
        case 1:
            retVal = "red";
            break;
        case 2:
            retVal = "yellow";
            break;
        case 3:
            retVal = "green";
            break;
    }
    return retVal;
}

function ResetLog() {
    $(".backlog-content").html("");
    $(".backlog-progress").html("");
    $(".backlog-review").html("");
    $(".backlog-done").html("");
}

function AddBackLog(
    categoryType,
    name,
    desc,
    startTime,
    dueTime,
    hoursDifference,
    priority,
    implementor,
    id
) {
    var descShort = desc.substr(0, 10) + ".....";
    $(".backlog-content").append(
        '<li class="el"><div class="task ' +
            Category(categoryType) +
            '"><header><h3>' +
            name +
            " (" +
            priority +
            ')</h3><a href="/task/info/' +
            id +
            '"><span class="icon flaticon-link"></span></a></header><div class="task-content">' +
            descShort +
            '</div><div class="task-estimate"><p>Start Time: ' +
            startTime +
            "</p><p>Estimate Time: " +
            hoursDifference +
            " Hours</p><p>Due Time: " +
            dueTime +
            "</p><p>Implementor:  " +
            implementor +
            "</p></div></div></li>"
    );
}

function AddProgress(
    categoryType,
    name,
    desc,
    startTime,
    dueTime,
    hoursDifference,
    priority,
    implementor,
    id
) {
    var descShort = desc.substr(0, 10) + ".....";
    $(".backlog-progress").append(
        '<li class="el"><div class="task ' +
            Category(categoryType) +
            '"><header><h3>' +
            name +
            " (" +
            priority +
            ')</h3><a href="/task/info/' +
            id +
            '"><span class="icon flaticon-link"></span></a></header><div class="task-content">' +
            descShort +
            '</div><div class="task-estimate"><p>Start Time: ' +
            startTime +
            "</p><p>Estimate Time: " +
            hoursDifference +
            " Hours</p><p>Due Time: " +
            dueTime +
            "</p><p>Implementor:  " +
            implementor +
            "</p></div></div></li>"
    );
}

function AddReview(
    categoryType,
    name,
    desc,
    startTime,
    dueTime,
    hoursDifference,
    priority,
    implementor,
    id
) {
    var descShort = desc.substr(0, 10) + ".....";
    $(".backlog-review").append(
        '<li class="el"><div class="task ' +
            Category(categoryType) +
            '"><header><h3>' +
            name +
            " (" +
            priority +
            ')</h3><a href="/task/info/' +
            id +
            '"><span class="icon flaticon-link"></span></a></header><div class="task-content">' +
            descShort +
            '</div><div class="task-estimate"><p>Start Time: ' +
            startTime +
            "</p><p>Estimate Time: " +
            hoursDifference +
            " Hours</p><p>Due Time: " +
            dueTime +
            "</p><p>Implementor:  " +
            implementor +
            "</p></div></div></li>"
    );
}

function AddDone(
    categoryType,
    name,
    desc,
    startTime,
    dueTime,
    hoursDifference,
    priority,
    implementor,
    id
) {
    var descShort = desc.substr(0, 10) + ".....";
    $(".backlog-done").append(
        '<li class="el"><div class="task ' +
            Category(categoryType) +
            '"><header><h3>' +
            name +
            " (" +
            priority +
            ')</h3><a href="/task/info/' +
            id +
            '"><span class="icon flaticon-link"></span></a></header><div class="task-content">' +
            descShort +
            '</div><div class="task-estimate"><p>Start Time: ' +
            startTime +
            "</p><p>Estimate Time: " +
            hoursDifference +
            " Hours</p><p>Due Time: " +
            dueTime +
            "</p><p>Implementor:  " +
            implementor +
            "</p></div></div></li>"
    );
}

function getDataProject() {
    var pathUrl = window.location.pathname;
    var listPath = pathUrl.split("/");
    var lastItem = listPath.pop();
    $(".project-id-new-task").val(lastItem);
    $(".project-id-new-task-hidden").val(lastItem);
    $.ajax({
        url: "/api/task/" + lastItem,
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
            ResetLog();
            var countBackLog = 0;
            var countProgress = 0;
            var countReview = 0;
            var countDone = 0;
            $.each(response.data, function (i, item) {
                var startTime = new Date(item.start_time * 1000);
                var dueTime = new Date(item.estimate_time * 1000);
                var timeDiffInMilliseconds = dueTime - startTime;
                var hoursDifference = timeDiffInMilliseconds / 1000 / 3600;
                let strUser = "";
                $.each(item.user, function (indexInArray, valueOfElement) {
                    strUser += valueOfElement.info.name + ",";
                });
                switch (item.level.id) {
                    case 1:
                        AddBackLog(
                            item.category.id,
                            item.name,
                            item.describes,
                            startTime,
                            dueTime,
                            Math.round(hoursDifference),
                            item.priority.name,
                            strUser,
                            item.id
                        );
                        countBackLog++;
                        break;
                    case 2:
                        AddProgress(
                            item.category.id,
                            item.name,
                            item.describes,
                            startTime,
                            dueTime,
                            Math.round(hoursDifference),
                            item.priority.name,
                            strUser,
                            item.id
                        );
                        countProgress++;
                        break;
                    case 3:
                        AddReview(
                            item.category.id,
                            item.name,
                            item.describes,
                            startTime,
                            dueTime,
                            Math.round(hoursDifference),
                            item.priority.name,
                            strUser,
                            item.id
                        );
                        countReview++;
                        break;
                    case 4:
                        AddDone(
                            item.category.id,
                            item.name,
                            item.describes,
                            startTime,
                            dueTime,
                            Math.round(hoursDifference),
                            item.priority.name,
                            strUser,
                            item.id
                        );
                        countDone++;
                        break;
                    default:
                        break;
                }
            });

            $(".count-backlog").html("(" + countBackLog + ")");
            $(".count-progress").html("(" + countProgress + ")");
            $(".count-review").html("(" + countReview + ")");
            $(".count-done").html("(" + countDone + ")");
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {});
}

$(document).ready(function () {
    if(localStorage.getItem("role") == 1){
        $(".list-btn-task").html('<button class="btn btn-blue btn-new-task"  data-toggle="modal" data-target="#newTaskModal">New Task  <span class="flaticon-add"></span></button>');
    }

    getDataProject();
    LoadUserNormal();
    LoadCategory();
    LoadLevel();
    LoadPriority();

    $(".btn-save-new-task").click(function (e) {
        e.preventDefault();
        var formData = new FormData($(".form-new-task")[0]);
        formData.append("describes", theEditor.getData());
        $.ajax({
            url: "/api/task/add",
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
                    getDataProject();
                }
            },
            error: function (data) {
                if(data.status == 401){
                    logout();
                }
                console.log(data);
            },
        });
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
                                    xhr.responseType = "json";
                                    const formData = new FormData();
                                    formData.append("upload", file);
                                    xhr.send(formData);
                                    xhr.onload = () => {
                                        if (xhr.status === 200) {
                                            resolve({
                                                default: xhr.response.url,
                                            });
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
