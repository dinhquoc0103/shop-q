$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    createSliderDataTable();
});

// Create and set slider table using DataTable
function createSliderDataTable(){
    $("#admin-slider-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/sliders/getSliderList",
        columns: [{
                data: "id",
                name: "checkbox",
                orderable: false,
                width: "4%",
                render: function(data, type, row, meta) {
                    return '<input type="checkbox" name="row-checkbox" data-id="' + data + '" id="">';
                }
            },
            // {
            //     data: 'id',
            //     name: 'id',
            //     width: "6%",
            // },
            {
                data: 'name',
                name: 'name',
                width: "22%",
            },
            {
                data: function(row, type, val, meta) {
                    // Get data from two columns to string
                    return row.thumb + '+' + row.name;
                },
                name: 'thumb',
                orderable: false,
                width: "24%",
                render: function(data, type, row, meta) {
                    // String to array separated by plus sign(kí tự)
                    data = data.split('+');
                    return '<img src="' + data[0] + '" alt="' + data[1] + '" width="250px" height="120px">';
                }
            },
            {
                data: 'active',
                name: 'active',
                width: "11%",
                render: function(data, type, row, meta) {
                    var html = '';
                    if (data == 1) {
                        html = '<a href="javascript:void(0)"><i class="fas fa-check-circle text-success"></i></a>';
                    } else {
                        html = '<a href="javascript:void(0)"><i class="fas fa-times-circle text-danger"></i></a>';
                    }

                    return html;
                }
            },
            {
                data: 'numerical_order',
                name: 'numerical_order',
                width: "8%",
            },
            {
                data: 'url',
                name: 'url',
                orderable: false,
                width: "8%",
                render: function(data, type, row, meta) {
                    return '<a href="'+ data +'" >Đến liên kết</a>'
                }
            },
            {
                data: 'updated_at',
                name: 'updated_at',
                width: "10%",
                render: function (data, type, row, meta){
                    let date = new Date(data);
                    return date.toLocaleString();
                }
            },
            {
                data: "id",
                name: "action",
                orderable: false,
                width: "10%",
                render: function(data, type, row, meta) {
                    var html = [];
                    html[0] = '<a href="/admin/sliders/edit/' + data + '" title="Chỉnh sửa" class ="btn btn-primary btn-sm"><i class = "far fa-edit"></i></a> ';
                    html[1] = '<a href="javascript:void(0)" title="Xóa" onclick="deteleSlider(' + data + ')" class ="btn btn-danger btn-sm btn-delete"> <i class = "far fa-trash-alt"></i></a>';
                    return '<div>' + html[0] + html[1] + '</div>';
                }
            }
        ],
        lengthMenu: [
            [2, -1],
            [2, "All"]
        ],
        language: {
            lengthMenu: "Hiển thị _MENU_ slider",
            search: "Tìm kiếm",
            zeroRecords: "Không tìm thấy kết quả phù hợp",
            info: "Hiển thị _START_ đến _END_ slider của tổng _TOTAL_ slider",
            infoEmpty: "Không có slider nào",
            infoFiltered:   "(lọc từ tổng _MAX_ slider )",
            paginate: {
                next: "Tiếp",
                previous: "Trước"
            }
        },
    }).on("draw", function (){
        // Each time redraw the table, main checkbox won't checked
        $("input[name=main-checkbox]").prop("checked", false);
    });;
}

// Delete slider
function deteleSlider(id) {
    $.confirm({
        title: 'Xóa slider',
        content: 'Bạn có chắc muốn xóa chứ?',
        buttons: {
            yes: function() {
                $.ajax({
                    type: 'DELETE',
                    dataType: 'JSON',
                    data: { 'id': id },
                    url: "/admin/sliders/delete",
                    success: function(result) {
                        if (result.message === true) {
                            $("#admin-slider-table").DataTable().ajax.reload();
                            $.alert({
                                title: 'Thành công',
                                content: 'Xóa slider thành công!',
                            });
                        }
                        else{
                            $.confirm({
                                title: 'Cảnh báo!',
                                content: 'Có vấn đề xảy ra khi xóa. Xin hãy kiểm tra lại!!',
                                type: 'red',
                                typeAnimated: true,
                                buttons: {
                                    tryAgain: {
                                        text: 'Thử lại',
                                        btnClass: 'btn-red',
                                        action: function() {}
                                    },
                                }
                            });
                        }
                    },
                    error(xhr, status, error) {
                        console.log(error);
                    }
                });
            },
            no: function() {},
        }
    });
}


// Delete multiple sliders
function deleteMultipleSliders(){
    let checkedRowNumber = $("input[name=row-checkbox]:checked").length;
    if( checkedRowNumber > 0){
        $.confirm({
            title: 'Xóa sản phẩm',
            content: 'Bạn có chắc muốn xóa '+ checkedRowNumber +' slider này chứ?',
            buttons: {
                yes: function() {
                    let arrayOfID = [];
                    $("input[name=row-checkbox]").each(function (){
                        if(this.checked){
                            arrayOfID.push($(this).data("id"));
                        }
                    });

                    $.ajax({
                        type: "POST",
                        dataType: "JSON",
                        data: {"array_of_id": arrayOfID},
                        url: "/admin/sliders/deleteMultiple",
                        success: function (result){
                            if (result.message === true) {
                                $("#admin-slider-table").DataTable().ajax.reload();
                                $.alert({
                                    title: 'Thành công',
                                    content: 'Xóa '+ checkedRowNumber +' slider thành công!',
                                });
                            }
                            else{
                                $.confirm({
                                    title: 'Cảnh báo!',
                                    content: 'Có vấn đề xảy ra khi xóa. Xin hãy kiểm tra lại!!',
                                    type: 'red',
                                    typeAnimated: true,
                                    buttons: {
                                        tryAgain: {
                                            text: 'Thử lại',
                                            btnClass: 'btn-red',
                                            action: function() {}
                                        },
                                    }
                                });
                            }
                        },
                        error(xhr, status, error) {
                            console.log(error);
                        }
                    });
                },
                no: function() {},
            }
        });
    }
    else{
        $.confirm({
            title: 'Chú ý!',
            content: 'Chưa có slider nào được chọn để xóa!!',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Thử lại',
                    btnClass: 'btn-red',
                    action: function() {}
                },
            }
        });
    }
}