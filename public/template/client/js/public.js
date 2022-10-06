$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var sizeArray = ["M", "L", "XL", "XXL"];
// const btnAddToCart = document.getElementById("add-to-cart");
// const productId = btnAddToCart.dataset.id;
// btnAddToCart.removeAttribute("data-id");




$(document).ready(function() {
    // Add to cart
    $("#add-product-detail").on('click', "#add-to-cart", function() {
        let id = $(this).data("id");
        let price = $(this).data("price");
        let size =  $("#select-size").val();
        if(!sizeArray.includes(size)){
            let index = $("#select-size").prop('selectedIndex');
            size = sizeArray[index];
        }
        let quantity = $("input.quantity").val();

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            data: {
                'id': id,
                'price': price,
                'size': size,
                'quantity': quantity
            },
            url: '/cart/addToCart',
            success: function(result) {
                $(".icon-header-noti").attr('data-notify', result.totalProductInCart);
                $(".header-cart-content").html(result.yourCartHtml);
                swal(result.productName, "Thêm Vào Giỏ Hàng Thành Công !", "success");          
            },
            error: function(xhr, status, error) {
                alert(error);
            }
        });
    });


    // Delete product in cart
    $("#cart-index").on("click", ".btn-delete-product", function (){
        let id = $(this).data("id");
        let size = $(this).data("size");
        
        $.ajax({
            type: "POST",
            dataType: "JSON",
            data: {
                "id" : id,
                "size" : size
            },
            url: "/cart/delete",
            success: function(result) {
                if(result.message === true){
                    $("#" + id + "-" + size).fadeOut(800);
                    $("#total-price").text(result.totalPrice + "Đ");
                    $(".icon-header-noti").attr('data-notify', result.totalProductsInCart);
                    $(".header-cart-content").html(result.yourCartHtml); 
                    if(parseInt(result.totalPrice) === 0){
                        $("#cart-index").html(result.emptyCartHtml);
                        $("html, body").animate({scrollTop: 50}, 1200);
                    }
                }
                else{
                    swal("Lỗi", "Có vấn đề khi xóa. Xin hãy thử lại !", "error").then((value) => {
                        window.location.reload();
                    });      
                }
            },
            error: function(xhr, status, error) {
                alert(error);
            }
        });
    });

    // Changing quantity product in Cart Index
    $("#cart-index .table-shopping-cart").on("click", ".btn-num-product-down, .btn-num-product-up", function (){
        
        let quantity = $(this).siblings(".num-product").val();
        let id = $(this).parents(".column-4").siblings(".column-6").children(".btn-delete-product").data("id");
        let size = $(this).parents(".column-4").siblings(".column-6").children(".btn-delete-product").data("size");
        if(quantity < 1){
            $(this).siblings(".num-product").val(1);   
            quantity = 1; 
        }

        // Must assign selector to another variable when you want to use it in success function
        var $this = $(this); // example: var x = $(this) => x is "this". If wanna use, $x. Or assign $x = $(this) => using $x
        $.ajax({
            type: "POST",
            dataType: "JSON",
            data: {
                "id" : id,
                "size" : size,
                "quantity" : quantity
            },
            url: "/cart/changeProductQuantity",
            success: function(result) {
                if(result.message === true){
                    $("#total-price").text(result.totalPrice + "Đ");
                    $this.parents(".column-4").siblings(".column-5").text(result.intoMoney + "đ");
                    $(".header-cart-content").html(result.yourCartHtml);
                }
                else{
                    swal("Lỗi", "Có vấn đề khi thêm số lượng. Xin hãy thử lại !", "error").then((value) => {
                        window.location.reload();
                    });  
                }
            },
            error: function(xhr, status, error) {
                alert(error);
            }
        });
    });

});