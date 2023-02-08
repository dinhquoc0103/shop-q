$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/* Set localStorage url have not query string 
    (Ex: http://127.0.0.1:8001/collection/men(right))
    (Ex: http://127.0.0.1:8001/collection/men?page=&sortBy="price-asc"(wrong)) */
function createUrl(queryParams) {
    const params = new URLSearchParams(queryParams);
    const defaultUrl = window.location.href.split('?')[0];

    const newUrl = defaultUrl + "?" + params.toString();

    return newUrl;
}


$(document).ready(function () {
    // Pagination without reload page
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();

        const page = $(this).attr("href").split("page=")[1];
        const sortBy = $("select#collection-sorted-by").val();
        const filterPrice = $("select#collection-filter-price").val();

        const queryParams = Object.assign({},
            page > 0 ? { page } : null,
            sortBy !== "default" ? { sortBy } : null,
            filterPrice !== "default" ? { price: filterPrice } : null,
        );

        const url = createUrl(queryParams);

        // Fecth data by page
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: url,
            success: function (result) {
                $("#list-product").html(result.htmlProductsPagination);

                window.history.pushState({}, '', url);

                $("html, body").animate({ scrollTop: 50 }, 1200);
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    });


    // Sorted by
    $("select#collection-sorted-by").change(function (e) {
        const sortBy = $(this).val();
        const filterPrice = $("select#collection-filter-price").val();

        const queryParams = Object.assign({},
            { page: 1 },
            sortBy !== "default" ? { sortBy } : null,
            filterPrice !== "default" ? { price: filterPrice } : null,
        );

        const url = createUrl(queryParams);

        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: url,
            success: function (result) {
                $("#list-product").html(result.htmlProductsPagination);
                window.history.pushState({}, '', url);
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    });

    // Filter price
    $("select#collection-filter-price").change(function () {
        const filterPrice = $(this).val();
        const sortBy = $("select#collection-sorted-by").val();

        const queryParams = Object.assign({},
            { page: 1 },
            filterPrice !== "default" ? { price: filterPrice } : null,
            sortBy !== "default" ? { sortBy } : null,
        );

        const url = createUrl(queryParams);

        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: url,
            success: function (result) {
                $("#list-product").html(result.htmlProductsPagination);
                window.history.pushState({}, '', url);
            },
            error: function (xhr, status, error) {
                console.log(error);
            }

        });
    });
});

