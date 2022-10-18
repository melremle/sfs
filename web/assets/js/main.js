$(function () {
    $("#loader-container").hide()

    let uploadID = 0
    let uploadCounter = 0
    let pendingUploadsArr = []
    let files = []
    let uids = []
    let indexToUpload = 0
    let flieid = ''
    let currentFilesCount = 0

    $(window).bind('beforeunload', function () {
        if (uploadCounter != 0) {
            return 'There is an upload process. Are you sure you want to cancel?';
        }
    });

    $("#btn-upload-file").click(function () {
        $("#frm-upload").trigger('reset')
        $("#uploadModal").modal('show')
    })

    $("#upload-files-btn").on('click', function () {
        currentFilesCount = files.length
        $("#frm-upload").trigger('reset')
        if (files.length > 0) {
            $(".files-err").text("")
            $(".items-selected").remove()
            $('<p id="file-check-files" class="card-text uploaded-file"><span class="imgfile"><span id="filename-span" title="Checking files">Checking files</span></span>\
            </p> ').appendTo('#file-uploads')
            for (let i = 0; i < currentFilesCount; i++) {
                indexToUpload = i

                $("#frm-upload").trigger('submit')
            }
            $("#uploadModal").modal('hide')

        } else {
            $(".files-err").text("No File is chosen")
        }
    })

    $("#cancel-upload-btn").on('click', function () {
        $("#frm-upload").trigger('reset')
        $("#ruser").val(null).trigger('change')
        $("#roffice").val(null).trigger('change')
        $(".items-selected").remove()
    })

    $("#u-file").on('input', function (e) {
        filelength = files.length
        if (e.target.files.length > 0) {
            files.push(...e.target.files)
            for (let i = 0; i < e.target.files.length; i++) {
                $('<p class="items-selected position-relative border ps-2 pe-2 pt-1 pb-1 m-0" style="max-width: max-content;">\
                    '+ e.target.files[i].name + '\
                    <a id="'+ (filelength + i) + '" class="c-pointer remove-item">\
                        <span class="text-danger"><i class="fa-solid fa-times" style="font-size: .9rem;"></i></span>\
                    </a>\
                </p>').appendTo("#items-container")
            }
        }
        let fbuffer = new DataTransfer()
        for (let i = 0; i < files.length; i++) {
            fbuffer.items.add(files[i])
        }
        $("#u-file")[0].files = fbuffer.files
    })

    $(document).on('click', ".remove-item", function () {
        let fbuffer = new DataTransfer()
        $(".items-selected").remove()
        for (let i = 0; i < $("#u-file")[0].files.length; i++) {
            if (this.id != i) {
                fbuffer.items.add($("#u-file")[0].files[i])
            }
        }
        $("#u-file")[0].files = fbuffer.files
        files = fbuffer.files
        for (let i = 0; i < $("#u-file")[0].files.length; i++) {
            $('<p class="items-selected position-relative border ps-2 pe-2 pt-1 pb-1 m-0" style="max-width: max-content;">\
                '+ $("#u-file")[0].files[i].name + '\
                <a id="'+ i + '" class="c-pointer remove-item">\
                    <span class="text-danger"><i class="fa-solid fa-times" style="font-size: .9rem;"></i></span>\
                </a>\
            </p>').appendTo("#items-container")
        }
    })

    let uploadTrigger = []

    $("#frm-upload").submit(function (e) {
        e.preventDefault()
        $("#upload-progress-container").show(200)
        const url = $(this).attr('action')
        const data = new FormData()

        data.append('file', files[indexToUpload])
        data.append('uid', $("#ruser").val().toString())


        $.ajax({
            url: baseURL + '/api/file/filename-check',
            data,
            type: 'POST',
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (res) {
                $("#file-check-files").remove()
                uploadID++
                flieid = '#file-' + uploadID
                if (res.success) {
                    $('<p id="file-' + uploadID + '" class="card-text uploaded-file"><span class="imgfile"><img src="/assets/icons/filetypes/others.png" alt="" width="20"><span id="filename-span" title="' + res.message + res.ext + '">' + res.message + res.ext + '</span></span>\
                        <span class="float-end circular-progress" data-progress="0" style = "--progress: 0deg;" ></span>\
                    </p> ').appendTo('#file-uploads')

                    data.append('filename', res.message)
                    uploadCounter++
                    pendingUploadsArr.push(flieid)
                    let uupid = flieid
                    let idxtoup = indexToUpload
                    let curitemsize = currentFilesCount
                    uploadTrigger.push($.ajax({
                        xhr: function () {
                            let xhr = new XMLHttpRequest()
                            let upid = flieid
                            xhr.upload.addEventListener('progress', function (ev) {

                                if (ev.lengthComputable) {
                                    let percent = ev.loaded / ev.total
                                    percent = parseInt(percent * 100)
                                    let deg = 3.65 * percent
                                    $(upid + ' span.circular-progress').attr('data-progress', deg)
                                    $(upid + ' span.circular-progress').css('--progress', deg + 'deg')

                                    if (percent == 100) {
                                        uploadCounter--
                                        pendingUploadsArr.pop(upid)
                                        uploadTrigger.pop(xhr)
                                        $(upid + ' span.circular-progress').remove()
                                        $('<span class="float-end text-dark"><small>Waiting on response</small></span>').appendTo(upid)
                                    }
                                }
                            }, false)
                            return xhr
                        },
                        url,
                        data,
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function (res) {
                            if (res.success) {
                                $(uupid + ' span.text-dark').remove()
                                files = files.filter((v, i) => i != idxtoup)
                                if (idxtoup == (curitemsize)) {
                                    $("#frm-upload").trigger('reset')
                                }
                                tblMyDrive?.ajax.reload()
                                $('<span class="float-end fs-6 text-success"><i class="fa fa-check-circle" data-mdb-toggle="tooltip" data-mdb-placement="left" title="' + res.message + '"></i></span>').appendTo(uupid)
                            } else {
                                $(uupid + ' span.text-dark').remove()
                                $('<span class="float-end fs-6 text-danger"><i class="fa fa-circle-info" data-mdb-toggle="tooltip" data-mdb-placement="left" title="' + res.message + '"></i></span>').appendTo(uupid)
                            }
                        }
                    }))
                } else {
                    $(flieid + ' span.text-dark').remove()
                    $('<span class="float-end fs-6 text-danger"><i class="fa fa-circle-info" data-mdb-toggle="tooltip" data-mdb-placement="left" title="' + res.message + '"></i></span>').appendTo(flieid)
                }
            }
        })
    })

    $(document).on('click', '.cancelUploads', function () {
        if (uploadCounter != 0) {
            $("#cancelUploadModal").modal('show')
        } else {
            $("#upload-progress-container").hide()
            $("#file-uploads p").remove()
            $("#frm-upload").trigger('reset')
            uploadCounter = 0
            uploadID = 0
            uploadTrigger.splice(0, uploadTrigger.length)
            pendingUploadsArr.splice(0, pendingUploadsArr.length)
        }
    })

    $(document).on('click', '#btn-cancel-upload', function () {
        uploadCounter = 0
        uploadTrigger.forEach(e => {
            e.abort()
        })
        uploadTrigger.splice(0, uploadTrigger.length)
        pendingUploadsArr.forEach(e => {
            $(e + ' span.circular-progress').remove()
            $('<span class="float-end fs-6 text-danger"><i class="fa fa-circle-xmark" data-mdb-toggle="tooltip" data-mdb-placement="left" title="Upload canceled"></i></span>').appendTo(e)
        })
        pendingUploadsArr.splice(0, pendingUploadsArr.length)
        alert('Upload Aborted')
        $("#frm-upload").trigger('reset')
        $("#cancelUploadModal").modal('hide')
    })

    $("#frm-activation").submit(function (e) {
        e.preventDefault()

        $("#activate-btn").attr('disabled', 'disabled')
        $("#activate-btn").text('')
        $('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').appendTo("#activate-btn")
        const url = $(this).attr('action')
        const data = new FormData(this)
        $(".tpassword-err").text('')
        $(".password-err").text('')
        $.ajax({
            url,
            data,
            method: 'post',
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (res) {
                if (res.success == false) {
                    $("#activate-btn").removeAttr('disabled')
                    $(".tpassword-err").text(res?.message.tpassword)
                    $(".password-err").text(res?.message.password)
                } else if (res.success == true) {
                    $(res.message).appendTo("#activationModal .modal-body")
                    $("#activationModal").modal('show')
                }
            }
        })
    })

    let passwordToggle = false
    let tpasswordToggle = false
    $("#pass-toggle").on('click', function () {
        if (passwordToggle) {
            $("#password").attr('type', 'password')
            $(this).attr('title', 'Show Password')
            $("#pass-toggle i").removeClass('fa-eye-slash')
            $("#pass-toggle i").addClass('fa-eye')
            passwordToggle = false
        } else {
            passwordToggle = true
            $(this).attr('title', 'Hide Password')
            $("#pass-toggle i").removeClass('fa-eye')
            $("#pass-toggle i").addClass('fa-eye-slash')
            $("#password").attr('type', 'text')
        }
    })
    $("#tpass-toggle").on('click', function () {
        if (tpasswordToggle) {
            tpasswordToggle = false
            $(this).attr('title', 'Show Password')
            $("#tpass-toggle i").removeClass('fa-eye-slash')
            $("#tpass-toggle i").addClass('fa-eye')
            $("#tpassword").attr('type', 'password')
        } else {
            tpasswordToggle = true
            $(this).attr('title', 'Hide Password')
            $("#tpass-toggle i").removeClass('fa-eye')
            $("#tpass-toggle i").addClass('fa-eye-slash')
            $("#tpassword").attr('type', 'text')
        }
    })

    $("#continue-btn").on('click', function () {
        location.replace(baseURL)
    })
    $("#ruser").select2({
        dropdownParent: $("#uploadModal"),
        placeholder: "Type Recepient's name here",
        ajax: {
            url: baseURL + '/api/getAllUsersPerOffice',
            data: function (params) {
                var query = {
                    officeid: $("#roffice").val().toString()
                }
                return query;
            },
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            fullname: item.fullname,
                            id: item.id
                        }
                    })
                };
            },
        },
        templateResult: formatDisplay,
        templateSelection: formatRepoSelection
    })
    $("#roffice").select2({
        dropdownParent: $("#uploadModal"),
        placeholder: "Type Office(s) here",
    })
    $("#roffice").trigger('change')
    $("#roffice").on('change', function () {
        $("#ruser").val(null).trigger('change')
        if ($("#roffice").val().length > 0) {
            $("#recipient").show(300)
            $("#ruser").removeAttr('disabled')
        } else {
            $("#recipient").hide(300)
            $("#ruser").attr('disabled', 'disabled')
        }
    })

    function formatDisplay(repo) {
        if (repo.loading) {
            return repo.text;
        }
        var $container = $(
            '<div class="d-flex align-items-center"><div><p class="m-0 p-0 ps-3 fw-2"><strong>' + repo.fullname + '</strong></p></div></div>'
        );

        return $container;
    }

    function formatRepoSelection(repo) {
        const name = repo.fullname ?? repo.text
        var $container = $(
            '<div class="d-flex align-items-center"><div><small class="text-muted ps-2">' + name + '</small></div></div>'
        );

        return $container;
    }

});