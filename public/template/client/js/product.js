$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function (){
    // Pagination without reload page
    $(document).on("click", ".pagination a", function (e){
        e.preventDefault();
        
        let url = $(this).attr("href");
        let page = url.split("page=")[1];
        let sortBy = $("select#collection-sorted-by").val();
        let filterPrice = $("select#collection-filter-price").val();

        // Fecth data by page
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: url + "&sortBy=" + sortBy,
            success: function (result){
                $("#list-product").html(result.htmlProductsPagination);
                
                if(sortBy !== "default" && filterPrice !== "default"){
                    history.pushState({page: page}, '', "?page="+page+"&sortBy="+sortBy+"&price="+filterPrice)
                }
                else if(sortBy !== "default" && filterPrice == "default"){
                    history.pushState({page: page}, '', "?page="+page+"&sortBy="+sortBy)
                }
                else if(sortBy == "default" && filterPrice !== "default"){
                    history.pushState({page: page}, '', "?page="+page+"&price="+filterPrice)
                }
                else{
                    // Save current url + parameter page (I do it because pagination ajax have not ?page=... )
                    history.pushState({page: page}, '', "?page="+page)
                }

                // Go to or replace this url in history to the url on chrome
                // history.go(page);

                $("html, body").animate({scrollTop: 50}, 1200);
            },
            error: function (xhr, status, error){
                console.log(error);
            }
        });
    });


    // Sorted by
    $("select#collection-sorted-by").change(function() {
        let sortBy = $(this).val();
        let filterPrice = $("select#collection-filter-price").val();
        var url = setDefaultUrl();
        if(filterPrice !== "default"){
            if(sortBy !== "default"){
                url = url + "?page=1&sortBy=" + sortBy + "&price=" + filterPrice;
                history.pushState({page: 1}, '', "?page=1&sortBy=" + sortBy + "&price=" + filterPrice);
            }
            else{
                url = url + "?page=1&price=" + filterPrice;
                history.pushState({page: 1}, '', "?page=1&price=" + filterPrice);
            }
        }
        else{
            if(sortBy !== "default"){
                url = url + "?page=1&sortBy=" + sortBy;
                history.pushState({page: 1}, '', "?page=1&sortBy=" + sortBy);
            }
            else{
                url = url + "?page=1";
                history.pushState({page: 1}, '', "?page=1");
            }
        } 

        $.ajax({
            type: "GET",
            dataType: "JSON",   
            url: url,
            success: function (result){
                $("#list-product").html(result.htmlProductsPagination);
            },
            error: function (xhr, status, error){
                console.log(error);
            }
        });
    });

    // Filter price
    $("select#collection-filter-price").change(function (){
        let filterPrice = $(this).val();
        let sortBy = $("select#collection-sorted-by").val();
        var url = setDefaultUrl();

        if(sortBy !== "default"){            
            if(filterPrice !== "default"){
                url = url + "?page=1&sortBy=" + sortBy + "&price=" + filterPrice;
                history.pushState({page: 1}, '', "?page=1&sortBy=" + sortBy + "&price=" + filterPrice);
            }
            else{
                url = url + "?page=1&sortBy=" + sortBy;
                history.pushState({page: 1}, '', "?page=1&sortBy=" + sortBy);
            }
        }
        else{
       
            if(filterPrice !== "default"){
                url = url + "?page=1&price=" + filterPrice;
                history.pushState({page: 1}, '', "?page=1&price=" + filterPrice);
            }
            else{
                url = url + "?page=1"
                history.pushState({page: 1}, '',"?page=1");
            }
        }  
        
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: url,
            success: function (result){
                console.log(result);
                $("#list-product").html(result.htmlProductsPagination);
                // history.go(1);
            },
            error: function (xhr, status, error){
                console.log(error);
            }

        });
    });
});

/* Set localStorage url have not query string 
    (Ex: http://127.0.0.1:8001/collection/men(right))
    (Ex: http://127.0.0.1:8001/collection/men?page=&sortBy="price-asc"(wrong)) */
function setDefaultUrl(){
    let url = window.location.href;
    return url.split('?')[0];
}