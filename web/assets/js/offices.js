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
    let dataId = 0

    const tblOffices = $("#tbl-offices").DataTable({
        ajax: {
            url: baseURL + '/api/admin/offices',
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
                contextMenu.setAttribute('data-id', d.ID)
                contextMenu.setAttribute('data-office', d.Office)
            })
        },
        rowId: "id",
        columns: [
            {
                data: null,
                render: function (d, t, r) {
                    const markup = '<p class="text-xs text-secondary mb-0">' + r.Office + '</p>'
                    return markup
                }
            },
            {
                data: null,
                render: function (d, t, r) {
                    const markup = '<img src="' + baseURL + '/files/logos/' + r.Logo + '" height="50" alt="logo"/>'
                    return markup
                }
            },
            {
                data: null,
                render: function (d, t, r) {
                    const created = new Date(r.CreatedOn)
                    return '<span class="text-secondary text-xs font-weight-bold">' + moment(created).fromNow() + '</span>'
                }
            },
            {
                data: null,
                render: function (d, t, r) {
                    let updated
                    updated = moment(new Date(r.UpdatedOn)).fromNow()
                    if (r.UpdatedOn == null) {
                        updated = "Never"
                    }
                    return '<span class="text-secondary text-xs font-weight-bold">' + updated + '</span>'
                }
            },
        ]
    })

    let office = ""
    let originalOffice = ""
    let action = 0


    $("#office").on('input', function () {
        office = this.value
        if (office.trim() == originalOffice.trim()) {
            $("#save-office-btn").attr('disabled', 'disabled')
        } else {
            $("#save-office-btn").removeAttr('disabled')
        }
    })

    $("#logo").on('input', function (e) {
        $("#logo-preview").attr('src', '')
        if (e.target.files.length > 0) {
            $("#save-office-btn").removeAttr('disabled')
            let reader = new FileReader();
            reader.onload = function (event) {
                $("#logo-preview").attr('src', event.target.result)
            };
            reader.readAsDataURL(this.files[0]);
        }
    })


    $("#btn-add-office").on('click', function () {
        $("#officeModalTitle").text('Add Office')
        action = 0
        $("#officeModal").modal('show')
    })

    $("#save-office-btn").on('click', function () {

        $("#save-office-btn").attr('disabled', 'disabled')
        $("#save-office-btn").text('')
        $('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').appendTo("#save-office-btn")

        $("#cancel-office-btn").attr('disabled', 'disabled')
        $(".office-err").text('')
        $(".logo-err").text('')
        if (action == 0) {
            const data = new FormData()
            data.append('office', office)
            data.append('logo', $("#logo")[0]?.files[0])
            $.ajax({
                url: baseURL + '/api/admin/addOffice',
                method: 'post',
                data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (res) {
                    $("#save-office-btn").text('Save')
                    $("#save-office-btn").removeAttr('disabled')
                    $("#cancel-office-btn").removeAttr('disabled')
                    if (res.success !== true && (res?.message?.duplicate != '' || res?.message?.img != '')) {
                        $(".office-err").text(res.message.duplicate)
                        $(".logo-err").text(res.message.img)
                    } else if (res.success !== true && res?.img) {
                        $(".logo-err").text(res.message)
                    } else if (res.success) {
                        $("#office").val('')
                        office = ""
                        $("#officeModal").modal('hide')
                        tblOffices.ajax.reload()
                        toastr.success(res.message)
                    } else {
                        toastr.error(res.message)
                    }
                }
            })
        } else if (action == 1) {
            const data = new FormData()
            data.append('office', office)
            data.append('id', dataId)
            data.append('logo', $("#logo")[0]?.files[0])
            $.ajax({
                url: baseURL + '/api/admin/updateOffice',
                method: 'post',
                data,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (res) {
                    originalOffice = ""
                    $("#save-office-btn").text('Save')
                    $("#save-office-btn").removeAttr('disabled')
                    $("#cancel-office-btn").removeAttr('disabled')
                    if (res.success !== true && (res?.message?.duplicate != '' || res?.message?.img != '')) {
                        $(".office-err").text(res.message.duplicate)
                        $(".logo-err").text(res.message.img)
                    } else if (res.success !== true && res?.img) {
                        $(".logo-err").text(res.message)
                    } else if (res.success) {
                        $("#office").val('')
                        office = ""
                        $("#officeModal").modal('hide')
                        tblOffices.ajax.reload()
                        toastr.success(res.message)
                    } else {
                        toastr.error(res.message)
                    }
                }
            })
        }
    })

    $(document).on('click', '#link-update', function () {
        $("#officeModalTitle").text('Update Office')
        dataId = $("#contextmenu").attr('data-id')
        originalOffice = $("#contextmenu").attr('data-office')
        action = 1
        $("#officeModal").modal('show')
        $("#save-office-btn").attr('disabled', 'disabled')
        $("#save-office-btn").text('')
        $('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').appendTo("#save-office-btn")

        $("#cancel-office-btn").attr('disabled', 'disabled')
        $(".office-err").text('')
        $.ajax({
            url: baseURL + '/api/admin/getOneOffice?id=' + dataId,
            method: 'get',
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (res) {
                $("#save-office-btn").text('Save')
                $("#cancel-office-btn").removeAttr('disabled')
                if (res.success != true) {
                    toastr.error(res.message)
                } else {
                    $("#office").val(res.message.Office)
                    office = res.message.Office
                    $("#logo-preview").attr('src', baseURL + '/files/logos/' + res.message.Logo)
                }
            }
        })
    })

    $('#officeModal').on("shown.bs.modal", function () {
        $("#office").focus()
    });

    $("#cancel-office-btn").on('click', function () {
        $(".office-err").text('')
        $(".logo-err").text('')
        $("#logo-preview").attr('src', '')
    })

    $("#link-delete").on('click', function () {
        dataId = $("#contextmenu").attr('data-id')
        $("#span-office").text($("#contextmenu").attr('data-office'))
        $("#deleteModal").modal('show')
    })

    $("#yes-delete-btn").on('click', function () {
        $("#yes-delete-btn").attr('disabled', 'disabled')
        $("#yes-delete-btn").text('')
        $('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').appendTo("#yes-delete-btn")

        $("#no-delete-btn").attr('disabled', 'disabled')
        const data = {
            id: dataId
        }
        $.ajax({
            url: baseURL + '/api/admin/deleteOffice',
            method: 'delete',
            data,
            contentType: 'application/x-www-form-urlencoded',
            dataType: 'json',
            success: function (res) {
                originalPosition = ""
                $("#yes-delete-btn").text('Yes')
                $("#yes-delete-btn").removeAttr('disabled')
                $("#no-delete-btn").removeAttr('disabled')
                if (res.success) {
                    $("#deleteModal").modal('hide')
                    tblOffices.ajax.reload()
                    toastr.success(res.message)
                } else {
                    toastr.error(res.message)
                }
            }
        })
    })
});