$(function () {
    const contextMenu = document.querySelector('#contextmenu')
    const contextBackdrop = document.querySelector('#contextbackdrop')
    const docEvents = ['click']

    docEvents.forEach(event => {
        document.addEventListener(event, e => {
            if (e.target.parentElement?.className !== 'context-link') {
                contextMenu.style.display = 'none'
                contextBackdrop.style.display = 'none'
                contextMenu.style.zIndex = -1
                contextBackdrop.style.zIndex = -1
            }
        })
    })

    let dataStat = 0
    let dataId = 0

    const tblUsers = $("#tbl-users").DataTable({
        ajax: {
            url: baseURL + '/api/admin/users',
            method: 'get',
            dataSrc: function (e) {
                return e
            }
        },

        createdRow: function (r, d, i) {
            $(r).addClass('row-context c-pointer')
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
                contextMenu.setAttribute('data-stat', d.isactive)
                dataStat = d.isactive
                dataId = r.id
                if (d.isactive == 1) {
                    $("#link-enable-disable i").removeClass('fa-user-check')
                    $("#link-enable-disable i").addClass('fa-user-lock')
                    $("#link-enable-disable span").text('Disable Account')
                } else {
                    $("#link-enable-disable i").removeClass('fa-user-lock')
                    $("#link-enable-disable i").addClass('fa-user-check')
                    $("#link-enable-disable span").text('Enable Account')
                }
            })
        },
        rowId: "id",
        columns: [
            {
                data: null,
                render: function (d, t, r) {
                    const avatar = r.pic
                    let fAvatar = '<img src="' + baseURL + '/files/logos/' + avatar + '" class="rounded-circle" width="50" alt="" loading="lazy" title="' + r.office + '" />'
                    const markup = '\
                        <div div class="d-flex align-items-center justify-content-center px-2 py-1" >\
                            <div class="d-flex flex-column align-items-center justify-content-center">\
                                '+ fAvatar + '\
                                '+ r.position + '\
                            </div>\
                        </div>\
                    '
                    return markup
                }
            },
            {
                data: null,
                render: function (d, t, r) {
                    const name = r.fullname == null ? "" : r.fullname
                    const markup = '\
                                    <p class="text-xs text-secondary mb-0">'+ name + '</p>\
                    '
                    return markup
                }
            },
            {
                data: null,
                render: function (d, t, r) {
                    const stat = r.isactive == 1 ? '<small class="badge badge-success">Active</small>' : r.isactive == -1 ? '<small class="badge badge-warning">Inactive</small>' : '<small class="badge badge-danger">Disabled</small>'
                    return '<p class="text-xs text-secondary mb-0">' + r.username + '</p>' + stat
                }
            },
            {
                data: null,
                render: function (d, t, r) {
                    const markup = '<p class="text-xs text-secondary mb-0">' + r.tpassword + '</p>'
                    return markup
                }
            },
            {
                data: null,
                render: function (d, t, r) {
                    const markup = '<p class="text-xs text-secondary mb-0">' + r.email + '</p>'
                    return markup
                }
            },
            {
                data: null,
                render: function (d, t, r) {
                    const markup = '<p class="text-xs text-secondary mb-0">' + r.mobile + '</p>'
                    return markup
                }
            },
            {
                data: null,
                render: function (d, t, r) {
                    let lastAccess
                    lastAccess = moment(new Date(r.lastaccess)).fromNow()
                    if (r.lastaccess == null) {
                        lastAccess = "Never"
                    }
                    return '<span class="text-secondary text-xs font-weight-bold">' + lastAccess + '</span>'
                }
            },
            {
                data: null,
                render: function (d, t, r) {
                    let lastLogin
                    if (r.lastlogin == null) {
                        lastLogin = "Never"
                    } else {
                        lastLogin = moment(new Date(r.lastlogin)).fromNow()
                    }

                    return '<span class="text-secondary text-xs font-weight-bold">' + lastLogin + '</span>'
                }
            },
            {
                data: null,
                render: function (d, t, r) {
                    const created = new Date(r.created)
                    return '<span class="text-secondary text-xs font-weight-bold">' + moment(created).fromNow() + '</span>'
                }
            },
            {
                data: null,
                render: function (d, t, r) {
                    let updated
                    updated = moment(new Date(r.updated)).fromNow()
                    if (r.updated == null) {
                        updated = "Never"
                    }
                    return '<span class="text-secondary text-xs font-weight-bold">' + updated + '</span>'
                }
            },
        ]
    })

    let username = ""
    let firstname = ""
    let lastname = ""
    let email = ""
    let position = ""
    let office = ""
    let mobile = ""
    let access = ""
    let action = 0

    $("#firstname").on('input', function () {
        firstname = this.value
    })
    $("#lastname").on('input', function () {
        lastname = this.value
    })
    $("#username").on('input', function () {
        username = this.value
    })
    $("#email").on('input', function () {
        email = this.value
    })
    $("#position").on('input', function () {
        position = this.value
    })
    $("#office").on('input', function () {
        office = this.value
    })
    $("#mobile").on('input', function () {
        mobile = this.value
    })
    $("#access").on('input', function () {
        access = this.value
    })

    $("#btn-add-user").on('click', function () {
        $("#userModalTitle").text('Add User')
        action = 0
        $("#userModal").modal('show')
    })

    $("#save-user-btn").on('click', function () {
        const data = new FormData()
        data.append('firstname', firstname)
        data.append('lastname', lastname)
        data.append('username', username)
        data.append('email', email)
        data.append('position', position)
        data.append('mobile', mobile)
        data.append('office', office)
        data.append('access', access)
        $("#save-user-btn").attr('disabled', 'disabled')
        $("#save-user-btn").text('')
        $('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').appendTo("#save-user-btn")

        $("#cancel-user-btn").attr('disabled', 'disabled')
        $(".firstname-err").text('')
        $(".lastname-err").text('')
        $(".username-err").text('')
        $(".email-err").text('')
        $(".position-err").text('')
        $(".office-err").text('')
        $(".mobile-err").text('')
        $(".access-err").text('')
        let uri = ""
        if (action == 0) {
            uri = baseURL + '/api/admin/addUser'
        } else if (action == 1) {
            uri = baseURL + '/api/admin/updateUser'
            data.append('id', dataId)
        }
        $.ajax({
            url: uri,
            method: 'post',
            data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (res) {
                $("#save-user-btn").text('Save')
                $("#save-user-btn").removeAttr('disabled')
                $("#cancel-user-btn").removeAttr('disabled')
                if (res.success !== true && (res.message?.email || res.message?.position || res.message?.office || res.message?.mobile || res.message?.access)) {
                    $(".email-err").text(res.message.email)
                    $(".position-err").text(res.message.position)
                    $(".office-err").text(res.message.office)
                    $(".mobile-err").text(res.message.mobile)
                    $(".access-err").text(res.message.access)
                } else if (res.success) {
                    $("#firstname").val('')
                    $("#lastname").val('')
                    $("#username").val('')
                    $("#email").val('')
                    $("#position").val('')
                    $("#office").val('')
                    $("#mobile").val('')
                    $("#access").val('')
                    email = ""
                    position = ""
                    office = ""
                    mobile = ""
                    access = ""
                    $("#userModal").modal('hide')
                    tblUsers.ajax.reload()
                    toastr.success(res.message)
                } else {
                    toastr.error(res.message)
                }
            }
        })
    })

    $(document).on('click', '#link-enable-disable', function () {
        let url = ""

        if (dataStat == 1) {
            url = baseURL + '/api/admin/disable'
            $("#loadingModal #stat").text('Disabling account')
        } else {
            url = baseURL + '/api/admin/enable'
            $("#loadingModal #stat").text('Enabling account')
        }
        $("#loadingModal").modal('show')

        const data = {
            id: dataId
        }
        $.ajax({
            url,
            data,
            method: 'put',
            dataType: 'json',
            contentType: 'application/x-www-form-urlencoded',
            success: function (res) {
                $("#loadingModal").modal('hide')
                if (res.success) {
                    tblUsers.ajax.reload()
                    toastr.success(res.message)
                } else {
                    toastr.error(res.message)
                }
            },
            error: function (err) {
                $("#loadingModal").modal('hide')
                toastr.error('An error occured. Please try again.')
            }
        })
    })

    $("#link-edit-user").on('click', function () {
        $.ajax({
            url: baseURL + '/api/admin/getOneUser.php?id=' + dataId,
            method: 'get',
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (res) {
                action = 1

                $("#userModalTitle").text('Update User Account')
                $("#firstname").attr('disabled', 'disabled')
                $("#lastname").attr('disabled', 'disabled')
                $("#username").attr('disabled', 'disabled')
                email = res.email
                position = res.position
                office = res.office
                mobile = res.mobile
                access = res.access
                $("#firstname").val(res.firstname)
                $("#lastname").val(res.lastname)
                $("#username").val(res.username)
                $("#email").val(res.email)
                $("#mobile").val(res.mobile)
                $("#position").val(res.position).trigger('change')
                $("#office").val(res.office).trigger('change')
                $("#access").val(res.access).trigger('change')
                $("#userModal").modal('show')
            },
        })
    })

    $("#cancel-user-btn").on('click', function () {
        $("#firstname").removeAttr('disabled')
        $("#lastname").removeAttr('disabled')
        $("#username").removeAttr('disabled')
        $("#firstname").val('')
        $("#lastname").val('')
        $("#username").val('')
        $("#email").val('')
        $("#position").val('')
        $("#office").val('')
        $("#mobile").val('')
        $("#access").val('')
        username = ""
        firstname = ""
        lastname = ""
        email = ""
        position = ""
        office = ""
        mobile = ""
        access = ""
    })

    $("#show-info").on('click', function () {
        $("#infoModal").modal('show')
    })
});