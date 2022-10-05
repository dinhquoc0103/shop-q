$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    /* Upload image */
    $("#upload").change(function() {
        const formHidden = new FormData($("#form-hidden")[0]);
        const form = new FormData();
        form.append('file', $(this)[0].files[0]);
        form.append('archive-folder-name', formHidden.get('archive-folder-name'));

        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'JSON',
            data: form,
            url: '/admin/upload/store',
            success: function(result) {
                if (result.message == false) {
                    alert('error upload');
                } else {
                    $("#show-image").html('<img src="' + result.path + '" width="250px" height="120px">');
                    $("#thumb").val(result.path);
                }
            },
            error: function(xhr, status, error) {
                // console.log(error);
            }

        });
    });

    /* Check all checkbox */
    $("#check-all").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    // Check all row checkbox when check main checkbox
    $("input[name=main-checkbox]").click(function (){
        $("input[name=row-checkbox]").prop("checked", this.checked);
    });

    // Checking if all row checkbox checked, main checkbox will checked
    $(document).on("click", "input[name=row-checkbox]", function (){
        if($("input[name=row-checkbox]").length == $("input[name=row-checkbox]:checked").length){
            $("input[name=main-checkbox]").prop("checked", true);
        }
        else{
            $("input[name=main-checkbox]").prop("checked", false);
        }
    });


});

/* Delete menu */
// function removeRow(id, url, tableName) {
//     $.confirm({
//         title: 'Xóa',
//         content: 'Bạn có chắc muốn xóa chứ?',
//         buttons: {
//             yes: function() {
//                 $.ajax({
//                     type: 'DELETE',
//                     dataType: 'JSON',
//                     data: { 'id': id },
//                     url: url,
//                     success: function(result) {
//                         if (result.message === true) {
//                             if (tableName == "menu") {
//                                 result.arrayIdDelete.forEach(e => {
//                                     $("#menu-" + e).hide();
//                                 });
//                             } else {
//                                 var rowId = "#" + tableName + "-" + id;
//                                 $(rowId).hide();
//                             }
//                         }
//                     },
//                     error(xhr, status, error) {

//                         if (tableName == "menu") {
//                             $.confirm({
//                                 title: 'Cảnh báo!',
//                                 content: 'Hãy xóa hết sản phẩm trước khi xóa menu!!!',
//                                 type: 'red',
//                                 typeAnimated: true,
//                                 buttons: {
//                                     tryAgain: {
//                                         text: 'Thử lại',
//                                         btnClass: 'btn-red',
//                                         action: function() {}
//                                     },
//                                 }
//                             });
//                         }
//                     }
//                 });
//             },
//             no: function() {},
//         }
//     });
// }

/* Delete multiple row */
// function deleteMultipleRow(url) {
//     var form = new FormData($("#admin-form")[0]);

//     $.ajax({
//         processData: false,
//         contentType: false,
//         type: 'POST',
//         dataType: 'JSON',
//         data: form,
//         url: url,
//         success: function(result) {
//             if (result.message === true) {
//                 result.arrayId.forEach(e => {
//                     $("#" + result.tableName + "-" + e).fadeOut("slow");
//                     $("#check-all").prop('checked', false);
//                 });
//             } else {
//                 alert("sai cmnr");
//             }
//         },
//         error: function(xhr, status, error) {
//             // console.log(error);
//         }

//     });
// }








