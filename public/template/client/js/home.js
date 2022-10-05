$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function loadMoreProducts() {
    var page = $("#page").val();
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        data: { 'page': page },
        url: '/home/loadMoreProducts',
        success: function(result) {
            if (result.message === true) {
                $("#new-product").append(result.html);
                $("#page").val(parseInt(page) + 1);
            } 
            else {
                $("#btn-load-more").fadeOut(1000);
                $("#block-load-more").html('<p>Đã hết sản phẩm mới</p>');
            }
        },
        error: function(xhr, status, error) {

        }
    });
}