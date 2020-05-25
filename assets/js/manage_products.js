document.getElementById("getCategoryId").addEventListener("change", function (e) {
    let getSubCategoryId = document.getElementById("getSubCategoryId");
    getSubCategoryId.innerHTML = "<option value='' disabled selected >در حال پردازش ...</option>";

    let category_id = e.target.value;
    let request = new XMLHttpRequest();
    request.open("GET", base_url + "api/getSubCategory?category_id=" + category_id);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            let response = JSON.parse(request.response);
            if (response.success === true) {

                if (response.data.subCategories.length > 0) {
                    getSubCategoryId.innerHTML = "";
                    response.data.subCategories.map((value) => {
                        getSubCategoryId.innerHTML += `<option value="${value.id}">${value.title}</option>`
                    });
                } else {
                    getSubCategoryId.innerHTML = "<option value='' disabled selected>نتیجه ای یافت نشد</option>";
                }
            }
        }
    };
});

function assignProductMarket({product_id, product_name}) {
    $("#product_id").val(product_id);
    $("#assignProductMarketModalTitle").html(`افزودن محصول <strong class="text-success">${product_name}</strong> به مغازه`);
    $('#assignProductMarket').modal('show');
}