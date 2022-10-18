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

    const tblPositions = $("#tbl-positions").DataTable({
        ajax: {
            url: baseURL + '/api/admin/positions',
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
                contextMenu.setAttribute('data-position', d.Position)
            })
        },
        rowId: "id",
        columns: [
            {
                data: null,
                render: function (d, t, r) {
                    const markup = '<p class="text-xs text-secondary mb-0">' + r.Position + '</p>'
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

    let position = ""
    let originalPosition = ""
    let action  = 0


    $("#position").on('input', function () {
        position = this.value
        if(position.trim() == originalPosition.trim()) {
            $("#save-position-btn").attr('disabled', 'disabled')
        } else {
            $("#save-position-btn").removeAttr('disabled')
        }
    })

    $("#btn-add-position").on('click', function () {
        $("#positionModalTitle").text('Add Position')
        action = 0
        $("#positionModal").modal('show')
    })

    $("#save-position-btn").on('click', function () {
        
        $("#save-position-btn").attr('disabled', 'disabled')
        $("#save-position-btn").text('')
        $('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').appendTo("#save-position-btn")

        $("#cancel-position-btn").attr('disabled', 'disabled')
        $(".position-err").text('')
        if(action == 0) {
            const data = new FormData()
            data.append('position', position)
            $.ajax({
                url: baseURL + '/api/admin/addPosition',
                method: 'post',
                data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (res) {
                    $("#save-position-btn").text('Save')
                    $("#save-position-btn").removeAttr('disabled')
                    $("#cancel-position-btn").removeAttr('disabled')
                    if (res.success !== true && res?.duplicate) {
                        $(".position-err").text(res.message)
                    } else if (res.success) {
                        $("#position").val('')
                        position = ""
                        $("#positionModal").modal('hide')
                        tblPositions.ajax.reload()
                        toastr.success(res.message)
                    } else {
                        toastr.error(res.message)
                    }
                }
            })
        } else if(action == 1) {
            const data = {
                id: dataId,
                position: position
            }
            $.ajax({
                url: baseURL + '/api/admin/updatePosition',
                method: 'put',
                data,
                contentType: 'application/x-www-form-urlencoded',
                dataType: 'json',
                success: function (res) {
                    originalPosition = ""
                    $("#save-position-btn").text('Save')
                    $("#save-position-btn").removeAttr('disabled')
                    $("#cancel-position-btn").removeAttr('disabled')
                    if (res.success !== true && res?.duplicate) {
                        $(".position-err").text(res.message)
                    } else if (res.success) {
                        $("#position").val('')
                        position = ""
                        $("#positionModal").modal('hide')
                        tblPositions.ajax.reload()
                        toastr.success(res.message)
                    } else {
                        toastr.error(res.message)
                    }
                }
            })
        }
    })

    $(document).on('click', '#link-update', function () {
        $("#positionModalTitle").text('Update Position')
        dataId = $("#contextmenu").attr('data-id')
        originalPosition = $("#contextmenu").attr('data-position')
        action = 1
        $("#positionModal").modal('show')
        $("#save-position-btn").attr('disabled', 'disabled')
        $("#save-position-btn").text('')
        $('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').appendTo("#save-position-btn")

        $("#cancel-position-btn").attr('disabled', 'disabled')
        $(".position-err").text('')
        $.ajax({
            url: baseURL + '/api/admin/getOnePosition?id=' + dataId,
            method: 'get',
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (res) {
                $("#save-position-btn").text('Save')
                $("#cancel-position-btn").removeAttr('disabled')
                if (res.success != true) {
                    toastr.error(res.message)
                } else {
                    $("#position").val(res.message.Position)
                }
            }
        })
    })

    $('#positionModal').on("shown.bs.modal", function() {
        $("#position").focus()
    });

    $("#cancel-position-btn").on('click', function() {
        $("#position").val('')
    })

    $("#link-delete").on('click', function () {
        dataId = $("#contextmenu").attr('data-id')
        $("#span-position").text($("#contextmenu").attr('data-position'))
        $("#deleteModal").modal('show')
    })

    $("#yes-delete-btn").on('click', function() {
        $("#yes-delete-btn").attr('disabled', 'disabled')
        $("#yes-delete-btn").text('')
        $('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').appendTo("#yes-delete-btn")

        $("#no-delete-btn").attr('disabled', 'disabled')
        const data = {
            id: dataId
        }
        $.ajax({
            url: baseURL + '/api/admin/deletePosition',
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
                    tblPositions.ajax.reload()
                    toastr.success(res.message)
                } else {
                    toastr.error(res.message)
                }
            }
        })
    })
});