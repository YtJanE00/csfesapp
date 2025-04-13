toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-bottom-left"
};
$(document).ready(function() {
    $('#addsign').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: signatoryCreateRoute,
            type: "POST",
            data: formData,
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    console.log(response);
                    $(document).trigger('signAdded');
                    $('input[name="lname"]').val('');
                    $('input[name="fname"]').val('');
                    $('input[name="mname"]').val('');
                    $('#modal-addsign').modal('hide');
                } else {
                    toastr.error(response.message);
                    console.log(response);
                }
            },
            error: function(xhr, status, error, message) {
                var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
                toastr.error(errorMessage);
            }
        });
    });

    var dataTable = $('#signatoryTable').DataTable({
        "ajax": {
            "url": signatoryReadRoute,
            "type": "GET",
        },
        destroy: true,
        info: true,
        responsive: true,
        lengthChange: true,
        searching: true,
        paging: true,
        "columns": [
            {
                data: null,
                render: function(data, type, row) {
                    var firstname = data.fname;
                    var middleInitial = data.mname ? data.mname.substr(0, 1) + '.' : '';
                    var lastNameWithExt = data.lname;

                    // Check if ext exists and is not 'N/A' or null
                    if (data.ext && data.ext !== 'N/A' && data.ext !== null) {
                        lastNameWithExt += ' ' + data.ext;
                    }

                    return firstname + ' ' + middleInitial + ' ' + lastNameWithExt;
                }
            },
            {data: 'role'},
            {data: 'dept'},
            {
                data: 'id',
                render: function(data, type, row) {
                    if (type === 'display') {
                        var dropdown = '<div class="d-inline-block">' +
                            '<a class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                            '<div class="dropdown-menu">' +
                            '<a href="#" class="dropdown-item btn-signedit" data-id="' + row.id + '" data-lname="' + row.lname + '" data-fname="' + row.fname + '" data-mname="' + row.mname + '" data-role="' + row.role + '" data-rank="' + row.rank + '" data-campus="' + row.campus + '">' +
                            '<i class="fas fa-pen"></i> Edit' +
                            '</a>' +
                            '<button type="button" value="' + data + '" class="dropdown-item cat-delete">' +
                            '<i class="fas fa-trash"></i> Delete' +
                            '</button>' +
                            '</div>' +
                            '</div>';
                        return dropdown;
                    } else {
                        return data;
                    }
                },
            },
        ],
        "createdRow": function (row, data, index) {
            $(row).attr('id', 'tr-' + data.id); 
        }
    });
    $(document).on('signAdded', function() {
        dataTable.ajax.reload();
    });
});

$(document).on('click', '.btn-signedit', function() {
    var id = $(this).data('id');
    var LName = $(this).data('lname');
    var FName = $(this).data('fname');
    var MName = $(this).data('mname');
    var role = $(this).data('role');
    var rank = $(this).data('rank');
    var campus = $(this).data('campus');
    
    $('#editSignId').val(id);
    $('#editSignLname').val(LName);
    $('#editSignFname').val(FName);
    $('#editSignMname').val(MName);
    $('#editSignRole').val(role);
    $('#editSignRank').val(rank);
    $('#editSignCampus').val(campus);
    $('#editSignModal').modal('show');
});

$('#editSignForm').submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
        url: signatureUpdateRoute,
        type: "POST",
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.success) {
                toastr.success(response.message);
                $('#editSignModal').modal('hide');
                $(document).trigger('signAdded');
            } else {
                toastr.error(response.message);
            }
        },
        error: function(xhr, status, error, message) {
            var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
            toastr.error(errorMessage);
        }
    });
});

$(document).on('click', '.cat-delete', function(e) {
    var id = $(this).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to recover this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: signatureDeleteRoute.replace(':id', id),
                success: function(response) {
                    $("#tr-" + id).delay(1000).fadeOut();
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Successfully Deleted!',
                        icon: 'warning',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    if(response.success) {
                        toastr.success(response.message);
                        console.log(response);
                    }
                }
            });
        }
    })
});