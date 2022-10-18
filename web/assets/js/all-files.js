$(function () {

    const contextMenu = document.querySelector('#contextmenu')
    const contextBackdrop = document.querySelector('#contextbackdrop')
    const docEvents = ['click']
    const oid = $("#tbl-drive").attr('data-id')
    let dataId = 0
    let fileExt = ""

    const closeContext = () => {
        contextMenu.style.display = 'none'
        contextBackdrop.style.display = 'none'
        contextMenu.style.zIndex = -1
        contextBackdrop.style.zIndex = -1
    }
    tblMyDrive = $("#tbl-drive")?.DataTable({
        ajax: {
            url: baseURL + '/api/file/all-files?id=' + oid,
            method: 'get',
            dataSrc: function (e) {
                return e
            }
        },

        createdRow: function (r, d, i) {
            $(r).addClass('row-context c-pointer')
            r.addEventListener('click', f => {
                $("#detailsModalTitle").text(r.children[1].textContent.trim() + r.children[0].textContent.trim())
                $("#detailsModal").modal('show')
            })
            r.addEventListener('contextmenu', f => {
                f.preventDefault()
                let py = $(r).offset().top - scrollY
                if (($(r).offset().top - scrollY) + 260 > innerHeight) {
                    py = py - 200
                }
                const x = f.pageX
                const y = f.pageY
                contextMenu.style.display = 'block'
                contextBackdrop.style.display = 'block'
                contextMenu.style.left = x + 'px'
                contextMenu.style.top = py + 'px'
                contextBackdrop.style.zIndex = 100
                contextMenu.style.zIndex = 100
                contextMenu.setAttribute('data-id', r.id)
                dataId = r.id
                fileExt = d.filetype
                contextMenu.setAttribute('data-typeid', d.FileTypeID)
                contextMenu.setAttribute('data-filename', d.FileName)
            })
        },
        rowId: "ID",
        columns: [
            {
                data: null,
                render: function (d, t, r) {
                    const avatar = r.pic
                    let fAvatar = '<img src="' + baseURL + '/files/avatars/' + avatar + '" class="rounded-circle" height="22" alt="" loading="lazy" />'
                    const name = r.fullname.toString().substr(0, 1)
                    if (avatar == null) {
                        fAvatar = '<div data-mdb-toggle="tooltip" title="' + r.fullname + '"class="avatar-letter-' + name.toLowerCase() + '">' + name.toUpperCase() + '</div>'
                    }
                    const markup = '\
                        <div div class="d-flex px-2 py-1" >\
                            <div class="d-flex flex-column align-items-center">\
                                '+ fAvatar + '\
                                <small>'+ r.fullname + '</small>\
                            </div>\
                        </div>\
                    '
                    return markup
                }
            },
            {
                data: null,
                render: function (d, t, r) {
                    const markup = '\
                        <div div class="d-flex px-2 py-1" >\
                            <div class="d-flex align-items-center">\
                                <img src="" alt="" width="20">\
                                    <p class="text-xs text-secondary mb-0">'+ r.filetype + '</p>\
                            </div>\
                        </div>\
                    '
                    return markup
                }
            },
            {
                data: null,
                render: function (d, t, r) {
                    return '<h6>' + r.FileName + '</h6>'
                }
            },
            {
                data: null,
                render: function (d, t, r) {
                    const size = r.FileSize / (1024 * 1024)
                    const markup = '<p class="text-xs text-secondary mb-0">' + size.toFixed(2) + ' MiB</p>'
                    return markup
                }
            },
            {
                data: null,
                render: function (d, t, r) {
                    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    const uploadedOn = moment(new Date(r.CreatedOn)).format('MMM DD YYYY')
                    const formattedDate = uploadedOn
                    return '<span class="text-secondary text-xs font-weight-bold">' + formattedDate + '</span>'
                }
            },
            {
                data: null,
                render: function (d, t, r) {
                    console.log
                    const stat = r.IsShared == 1 ? 'Shared' : 'Not Shared'
                    const clr = r.IsShared == 1 ? 'success' : 'danger'
                    const markup = '<span class="badge badge-' + clr + ' text-xs font-weight-bold">' + stat + '</span>'
                    return markup
                }
            }
        ]
    })

    docEvents.forEach(event => {
        document.addEventListener(event, e => {
            if (e.target.parentElement?.className !== 'context-link') {
                closeContext()
            }
        })
    })

    let fileId = 0
    let typeid = 0
    let previousFilename = ""

    $("#link-rename").on('click', function () {
        const id = $("#contextmenu").attr('data-id')
        const filetypeid = $("#contextmenu").attr('data-typeid')
        fileId = id
        typeid = filetypeid
        closeContext()
        $.ajax({
            url: baseURL + '/api/file/filename?id=' + id + '&typeid=' + filetypeid,
            method: 'get',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (res) {
                if (res?.filename) {
                    previousFilename = res.filename
                    $("#renameModal #filename-txt").val(res.filename)
                    $("#renameModal").modal('show')
                } else {
                    alert('An error occured! Please try again.')
                }
            }
        })
    })

    $("#link-download").on('click', function () {
        const id = $("#contextmenu").attr('data-id')
        fileId = id
        closeContext()
        $.ajax({
            url: baseURL + '/api/file/verify-download?id=' + id + '&oid=' + oid,
            method: 'get',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (res) {
                if (res.success && res.message == 'Can download') {
                    let a = $("<a>")
                        .attr("href", baseURL + '/api/file/download?id=' + id + '&oid=' + oid,)
                        .appendTo("body");
                    a[0].click();
                    a.remove();
                } else if (res.success && res.message == 'Shared') {

                } else {
                    toastr.error(res.message)
                }
            }
        })
    })

    $(document).on('input', "#renameModal #filename-txt", function () {
        if (this.value.trim() == previousFilename.trim()) {
            $("#rename-btn").attr('disabled', true)
        } else {
            $("#rename-btn").removeAttr('disabled')
        }
    })

    $("#rename-btn").on('click', function () {
        const filename = $("#renameModal #filename-txt").val()
        const data = {
            id: fileId,
            oid: oid,
            filename: filename,
            typeid: typeid
        }

        $.ajax({
            url: baseURL + '/api/file/filename',
            method: 'put',
            data: data,
            dataType: 'json',
            contentType: 'application/x-www-form-urlencoded',
            success: function (res) {
                if (res.success) {
                    toastr.success(res.message)
                    tblMyDrive.ajax.reload()
                    $("#renameModal").modal('hide')
                } else {
                    toastr.error(res.message)
                }
            }
        })
    })

    const reloadShared = () => {
        $("#s-cont div").remove()
        $.ajax({
            url: baseURL + '/api/search-shared?fid=' + dataId,
            dataType: 'json',
            success: function (r) {
                if (r.length > 0) {
                    $("#shared-container").show()
                } else {
                    $("#shared-container").hide()
                }
                r.forEach(res => {
                    const avatar = res.pic
                    let fAvatar = '<img src="' + baseURL + '/files/avatars/' + avatar + '" class="rounded-circle" height="22" alt="" loading="lazy" />'
                    const name = res.fullname == null ? res.username.toString().substr(0, 1) : res.fullname.toString().substr(0, 1)
                    if (avatar == null) {
                        fAvatar = '<div class="avatar-letter-' + name.toLowerCase() + '">' + name.toUpperCase() + '</div>'
                    }

                    var container = $(
                        '<div class="d-flex align-items-center justify-content-between border mb-2 p-2"><div class="d-flex align-items-center">' + fAvatar + '<div><p class="m-0 p-0 ps-3 fw-2"><strong>' + res.fullname + '</strong></p></div></div><a id="' + res.id + '" class="text-info c-pointer remove-access-btn"><small>Remove access</small></a></div>'
                    );

                    $(container).appendTo('#s-cont')
                })
            },
        })
    }

    $("#link-share").on('click', function () {
        $("#shareModal #orig-filename").text($(contextMenu).attr('data-filename') + fileExt)
        closeContext()
        reloadShared()
        $("#shareModal").modal('show')
    })

    $("#search-share-txt").on('change', function () {
        if ($(this).val().length > 0) {
            $("#share-btn").removeAttr('disabled')
        } else {
            $("#share-btn").attr('disabled', true)

        }
    })

    $("#search-share-txt").select2({
        dropdownParent: $("#shareModal"),
        placeholder: "Type First Name, Last Name or Email here",
        ajax: {
            url: baseURL + '/api/search',
            data: function (params) {
                var query = {
                    user: params.term,
                    fid: dataId
                }
                return query;
            },
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            email: item.email,
                            username: item.username,
                            pic: item.pic,
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
    function formatDisplay(repo) {
        if (repo.loading) {
            return repo.text;
        }

        const avatar = repo.pic
        let fAvatar = '<img src="' + baseURL + '/files/avatars/' + avatar + '" class="rounded-circle" height="22" alt="" loading="lazy" />'
        const name = repo.fullname == null ? repo.username.toString().substr(0, 1) : repo.fullname.toString().substr(0, 1)
        if (avatar == null) {
            fAvatar = '<div class="avatar-letter-' + name.toLowerCase() + '">' + name.toUpperCase() + '</div>'
        }

        var $container = $(
            '<div class="d-flex align-items-center">' + fAvatar + '<div><p class="m-0 p-0 ps-3 fw-2"><strong>' + repo.fullname + '</strong></p></div></div>'
        );

        return $container;
    }

    function formatRepoSelection(repo) {
        const avatar = repo.pic
        let fAvatar = '<img src="' + baseURL + '/files/avatars/' + avatar + '" class="rounded-circle" height="22" alt="" loading="lazy" />'
        const name = repo.fullname == null ? repo.username.toString().substr(0, 1) : repo.fullname.toString().substr(0, 1)
        if (avatar == null) {
            fAvatar = '<div class="avatar-letter-' + name.toLowerCase() + '">' + name.toUpperCase() + '</div>'
        }

        var $container = $(
            '<div class="d-flex align-items-center">' + fAvatar + '<div><small class="text-muted ps-2">' + repo.fullname + '</small></div></div>'
        );

        return $container;
    }

    $("#share-btn").click(function () {
        const fileId = dataId
        const userIdArr = $("#search-share-txt").val()

        $("#share-btn").text('')
        $('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').appendTo("#share-btn")
        const data = new FormData()
        data.append('fid', fileId)
        data.append('uids', userIdArr)
        $("#share-btn").attr('disabled', 'disabled')
        $("#close-share-btn").attr('disabled', 'disabled')
        $.ajax({
            url: baseURL + '/api/file/share',
            method: 'post',
            data,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (res) {
                $("#share-btn").text('Share')
                $("#close-share-btn").removeAttr('disabled')
                if (res.success) {
                    $("#search-share-txt").empty()
                    tblMyDrive.ajax.reload()
                    $("#shareModal").modal('hide')
                    toastr.success(res.message)
                } else {
                    toastr.error(res.message)
                }
            }
        })

    })

    $(document).on('click', '.remove-access-btn', function () {
        const id = this.id
        const data = {
            id: id,
            fid: dataId
        }

        $.ajax({
            url: baseURL + '/api/file/share',
            method: 'delete',
            data,
            contentType: 'application/x-www-form-urlencoded',
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    reloadShared()
                    if (!res?.shared) {
                        tblMyDrive.ajax.reload()
                    }
                    toastr.success(res.message)
                } else {
                    toastr.error(res.message)
                }
            }
        })
    })


});