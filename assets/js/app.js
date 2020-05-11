const base_url = "http://localhost:7000/mahalemarket/";
$(document).ready(function () {

    loadBasket();

    $(".plusCounter").click(function (e) {
        let elem = $(e.target).parent().find("input[data-qty]");
        elem.val(parseInt(elem.val()) + 1)
    });
    $(".minusCounter").click(function (e) {
        let elem = $(e.target).parent().find("input[data-qty]");
        if (elem.val() > 1) {
            elem.val(parseInt(elem.val()) - 1);
        }
    });
});

function loadBasket() {
    let basketData = localStorage.getItem('my-basket');
    console.log(basketData);
    $(".basket-counter").html(JSON.parse(basketData).total_items);
    $("#basketInfo").html(null);
    $("#basketInfo").append(generateBasketData(JSON.parse(basketData)));
}

function generateBasketData({items}) {
    let html = ``;
    if (items.length === undefined) {
        $.each(items, function (index, value) {
            html += `<div class="card mb-3">
        <div  class="card-body align-items-center p-0">
            <img data-cover="" class="product-cover-sm" src="${value.cover}" alt="${value.name}">
            <div class="product-info">
                <h1 class="product-title-sm">${value.name}</h1>
                <h1 class="product-price-sm">${new Intl.NumberFormat('en-IN').format(value.price)}<span>تومان</span></h1>
            </div>
            <div class="product-addCart" style="width: 50px">
                <button onclick="removeItem(this,'${value.rowid}')" class="btn btn-light w-100 text-center" style="font-size: 20px"><i class="fal fa-trash text-danger"></i></button>
            </div>
        </div>
    </div>`;
        });
    } else {
        html = `<div class="w-100 text-center text-danger">سبد خرید خالی است</div>`;
    }
    return html;
}

function updateBasket() {
    $.get(base_url + "api/v1/basket/get", function (response) {
        response = JSON.parse(response);
        localStorage.setItem('my-basket', JSON.stringify(response.data));
        loadBasket();
    })
}

function removeItem(elem, rowId) {
    let trashIcon = $(elem).html();
    $(elem).html(`<i class="fas fa-spinner-third fa-w-16 fa-spin fa-lg"></i>`)
    $.get(base_url + `api/v1/basket/removeItem?rowId=${rowId}`, function (response) {
        response = JSON.parse(response);
        if (response.success) {
            updateBasket();
            $(elem).html(trashIcon);
        }
    });
}

function addToBasket(elem) {
    let id = $(elem).parent().parent().find("[data-id]");
    let title = $(elem).parent().parent().find("[data-title]");
    let price = $(elem).parent().parent().find("[data-price]");
    let cover = $(elem).parent().parent().find("[data-cover]");
    let qty = $(elem).parent().parent().find("[data-qty]");
    const data = {
        id: id.attr("data-id"),
        title: title.attr("data-title"),
        price: price.attr("data-price"),
        cover: cover.attr("data-cover"),
        qty: qty.val(),
    };
    $.post(base_url + "api/v1/basket/addItem", data, function (response) {
        response = JSON.parse(response);
        if (response.success) {
            updateBasket();
        }
    })
}