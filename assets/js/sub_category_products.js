function assignProductMarket({product_id, product_name}) {
    $("#product_id").val(product_id);
    $("#assignProductMarketModalTitle").html(`افزودن محصول <strong class="text-success">${product_name}</strong> به مغازه`);
    $('#assignProductMarket').modal('show');
}