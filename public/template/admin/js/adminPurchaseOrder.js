$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    createPurchaseOrderDataTable();


    $("#admin-purchase-order-table").on("change", "#purchase-order-status-select", function (){
        let status = $(this).val();
        let id = $('#admin-purchase-order-table').DataTable().row($(this).parents("tr")).data().id;
     
        
        
        $.ajax({
            type: "POST",
            dataType: "JSON",
            data: {
                "id" : id,
                "status": status,
            },
            url: "/admin/purchaseOrders/changePurchaseOrderStatus",
            success: function (result){
                if (result.message === true) {
                    $.alert({
                        title: 'Thành công',
                        content: 'Thay đổi trạng thái đơn hàng thành công',
                    });
                }
                else{
                    $.confirm({
                        title: 'Cảnh báo!',
                        content: 'Có vấn đề xảy ra khi Thay đổi trạng thái. Xin hãy kiểm tra lại!!',
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
    });
});


// Create and set product table using DataTable
function createPurchaseOrderDataTable(){
    $("#admin-purchase-order-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/purchaseOrders/getPurchaseOrderList",
        columns: [
            // {
            //     data: "id",
            //     name: "checkbox",
            //     orderable: false,
            //     width: "2%",
            //     render: function(data, type, row, meta) {
            //         return '<input type="checkbox" name="row-checkbox" data-id="' + data + '" id="">';
            //     }
            // },
            // {
            //     data: 'id',
            //     name: 'id',
            //     width: "6%",
            // },
            {
                data: 'name',
                name: 'name',
                width: "15%",
            },
            {
                data: "code",
                name: 'code',
                width: "15%",
            },
            {
                data: "total_price",
                name: 'total_price',
                width: "10%",
                render: function(data, type, row, meta) {
                    // Return numbers to money format
                    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(data);
                }
            },
            {
                data: 'phone_number',
                name: 'phone_number',
                width: "10%",
            },
            {
                data: 'email',
                name: 'email',
                width: "15%",
            },
            {
                data: 'address',
                name: 'address',
                width: "15%",
            },
            {
                data: 'status',
                name: 'status',
                width: "20%",
                render: function(data, type, row, meta) {
                    let arrayStatus = [
                        "Chờ xác nhận",
                        "Đã xác nhận",
                        "Đang chuẩn bị hàng",
                        "Đang vận chuyển",
                        "Giao hàng thành công",
                        "Hủy đơn",
                    ];
                    let html = ' <div class="form-group"><select style="width: auto" class="form-control" id="purchase-order-status-select">'
                    arrayStatus.forEach((element, index) => {
                        if(data == index){
                            html += '<option value='+index+' selected>'+element+'</option>';
                        }
                        else{
                            html += '<option value='+index+' >'+element+'</option>';
                        }
                    });
                    html += '</select></div>';
                    
                    return html;
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
                    let html = '<a href="/admin/purchaseOrders/detail/' + data + '" title="Xem chi tiết đơn hàng" class ="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a> ';
                    return '<div>' + html + '</div>';
                }
            }
        ],
        lengthMenu: [
            [5, 10, -1],
            [5, 10, "All"]
        ],
        language: {
            lengthMenu: "Hiển thị _MENU_ đơn đặt hàng",
            search: "Tìm kiếm",
            zeroRecords: "Không tìm thấy kết quả phù hợp",
            info: "Hiển thị _START_ đến _END_ đơn đặt hàng của tổng _TOTAL_ đơn đặt hàng",
            infoEmpty: "Không có đơn đặt hàng nào",
            infoFiltered:   "(lọc từ tổng _MAX_ đơn đặt hàng )",
            paginate: {
                next: "Tiếp",
                previous: "Trước"
            }
        },
    })
    // .on("draw", function (){
    //     // Each time redraw the table, main checkbox won't checked
    //     $("input[name=main-checkbox]").prop("checked", false);
    // });
}

