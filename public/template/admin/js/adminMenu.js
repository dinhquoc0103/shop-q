$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    // Create menu datatable
    createMenuDataTable();
    

    let action = $("#parent-id-block").find("#parent-id").data("action");
    var level = $("#menu-level").val();
    if( level > 1){
        $("#parent-id-block").removeClass("d-none").find("#parent-id").prop( "disabled", false);
    }
    else {
        $("#parent-id-block").addClass("d-none").find("#parent-id").prop( "disabled", true);
        
        if(action === "edit"){
            $("#menu-level").prop("disabled", true);
        }
    }

    // When change level 
    $("#menu-level").change(function (){
        let level = $(this).val();
        if(level > 1)
        {   
            $("#parent-id-block").removeClass("d-none").find("#parent-id").prop( "disabled", false);
            $("#parent-id option").not("#parent-id option[value=0]").remove();
            
            let parentLevel = parseInt(level) - 1;
            $.ajax({
                type: "POST",
                dataType: "JSON",
                data: {"parentLevel" : parentLevel},
                url: "/admin/menus/getParentMenuList",
                success: function (result){
                    let html = '';
                    result.parentMenuList.forEach(menu => {
                        html += '<option value="'+menu.id+'">'+menu.name+'</option>';
                    });
                    $("#parent-id").append(html);
                },
                error: function (xhr, status, error){
                    console.log(error);
                }
            });  
        }
        else{
            $("#parent-id-block").addClass("d-none").find("#parent-id").prop( "disabled", true);
        }
    });
});


// Get level and parent id
function getLevelAndParentID(){
    let url = window.location.href;
    let arrayUrl = url.split('/');

    if(arrayUrl.length < 8){
        arrayUrl[7] = 0
    }

    let dataArray = [];
    dataArray[0] = arrayUrl[5]; // Get level
    dataArray[1] = arrayUrl[7]; // Get parent_id
    return dataArray;
}

// Create and set menu table using DataTable
function createMenuDataTable(){

    let levelAndParentID = getLevelAndParentID();
    let level = levelAndParentID[0];
    let parent_id = levelAndParentID[1];
    let nextMenuLevel = parseInt(level) + 1;

    $("#admin-menu-table-"+level).DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/menus/getMenuList/"+level+"/"+parent_id,
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
                width: "20%",
            },
            {
                data: 'active',
                name: 'active',
                width: "5%",
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
                data: 'updated_at',
                name: 'updated_at',
                width: "12%",
                render: function (data, type, row, meta){
                    let date = new Date(data);
                    return date.toLocaleString();
                }
            },
            {
                data: "id",
                name: "action",
                orderable: false,
                width: "12%",
                render: function(data, type, row, meta) {
                    var html = [];
                    html[0] = '<a href="/admin/menus/edit/' + data + '" title="Chỉnh sửa" class ="btn btn-primary btn-sm"><i class = "far fa-edit"></i></a> ';
                    html[1] = '<a href="javascript:void(0)" title="Xóa" onclick="deteleMenu(' + data + ')" class ="btn btn-danger btn-sm btn-delete"> <i class = "far fa-trash-alt"></i></a> ';
                    
                    // Static settings only have 2 menu levels 
                    if(nextMenuLevel < 3){
                        html[2] = '<a href="/admin/menus/'+nextMenuLevel+'/list/'+data+'" data-id="'+data+'" title="Xem danh mục con" class ="btn-next-menu-level btn btn-danger btn-sm "><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    }
                    else{
                        html[2] = '';
                    }

                    return '<div>' + html[0] + html[1] + html[2] + '</div>';
                }
            }
        ],
        lengthMenu: [
            [5, 10, -1],
            [5, 10, "All"]
        ],
        language: {
            lengthMenu: "Hiển thị _MENU_ danh mục",
            search: "Tìm kiếm",
            zeroRecords: "Không tìm thấy kết quả phù hợp",
            info: "Hiển thị _START_ đến _END_ danh mục của tổng _TOTAL_ danh mục",
            infoEmpty: "Không có danh mục nào",
            infoFiltered:   "(lọc từ tổng _MAX_ danh mục)",
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

// Delete menu
function deteleMenu(id) {
    let levelAndParentID = getLevelAndParentID();
    let level = levelAndParentID[0];
    $.confirm({
        title: 'Xóa menu',
        content: 'Bạn có chắc muốn xóa chứ?',
        buttons: {
            yes: function() {
                $.ajax({
                    type: 'DELETE',
                    dataType: 'JSON',
                    data: { 'id': id },
                    url: "/admin/menus/delete",
                    success: function(result) {
                        if (result.message === true) {
                            $("#admin-menu-table-" + level).DataTable().ajax.reload();
                            $.alert({
                                title: 'Thành công',
                                content: 'Xóa menu thành công!',
                            });
                        }
                        else{
                            $.confirm({
                                title: 'Cảnh báo!',
                                content: 'Trước khi xóa. Bạn phải xóa hết sản phẩm thuộc danh mục này hoặc danh mục con của nó!!',
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

// Delete multiple menus
function deleteMultipleMenus(){
    let levelAndParentID = getLevelAndParentID();
    let level = levelAndParentID[0];
    let checkedRowNumber = $("input[name=row-checkbox]:checked").length;
    if( checkedRowNumber > 0){
        $.confirm({
            title: 'Xóa sản phẩm',
            content: 'Bạn có chắc muốn xóa '+ checkedRowNumber +' menu này chứ?',
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
                        url: "/admin/menus/deleteMultiple",
                        success: function (result){
                            if (result.message === true) {
                                $("#admin-menu-table-" + level).DataTable().ajax.reload();
                                $.alert({
                                    title: 'Thành công',
                                    content: 'Xóa '+ checkedRowNumber +' menu thành công!',
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