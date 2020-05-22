// const base_url = "/mahalemarket/";
$(document).ready(function () {

    updateBasket();

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
    $(".basket-counter").html(JSON.parse(basketData).total_items);
    // $("#basketInfo").html(null);
    // $("#basketInfo").append(generateBasketData(JSON.parse(basketData)));
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
    return new Promise((resolve, reject) => {
        $.get(base_url + "api/v1/basket/get", function (response) {
            if (response.success) {
                localStorage.setItem('my-basket', JSON.stringify(response.data));
                loadBasket();
                resolve();
            } else {
                reject();
            }
        });
    });
}

function getBasketData() {
    return JSON.parse(localStorage.getItem('my-basket'));
}

function removeItem(elem, rowId) {
    let trashIcon = $(elem).html();
    $(elem).html(`<i class="fas fa-spinner-third fa-w-16 fa-spin fa-lg"></i>`);
    $.get(base_url + `api/v1/basket/removeItem?rowId=${rowId}`, function (response) {
        if (response.success) {
            updateBasket();
        }
    });
}

function addToBasket(elem) {
    let parent = $(elem).parent().parent();
    let title = parent.find("[data-title]");
    let price = parent.find("[data-price]");
    let cover = parent.find("[data-cover]");
    let qty = parent.find("[data-qty]");
    const data = {
        id: parent.attr("data-id"),
        title: title.attr("data-title"),
        price: price.attr("data-price"),
        cover: cover.attr("data-cover"),
        qty: qty.val(),
    };

    let basketItems = getBasketData();
    let _qty = (basketItems.items[parent.attr("data-rowId")] === undefined) ? '0' : basketItems.items[parent.attr("data-rowId")].qty.toString();
    if (_qty !== data.qty) {
        $.post(base_url + "api/v1/basket/addItem", data, function (response) {
            if (response.success) {
                updateBasket().then(() => {
                    let basketItems = getBasketData();
                    if (basketItems.items[parent.attr("data-rowId")] !== undefined) {
                        let subtotal = basketItems.items[parent.attr("data-rowId")].subtotal;
                        parent.find(".product-item-total-price").html(new Intl.NumberFormat('en-IN').format(subtotal));
                        animateCSS(parent.find(".product-item-total-price")[0], 'tada');
                    }
                    const element = document.getElementById('setTotalPrice');
                    if (element !== null) {
                        element.innerHTML = new Intl.NumberFormat('en-IN').format(basketItems.total_price);
                        animateCSS(element, 'flash');
                    }
                });
            }
        })
    }
}


const animateCSS = (node, animation, prefix = 'animate__') =>
    // We create a Promise and return it
    new Promise((resolve, reject) => {
        const animationName = `${prefix}${animation}`;
        // const node = document.querySelector(element);
        // console.log(node);
        // animate__animated animate__bounce
        node.classList.add(`${prefix}animated`, animationName);

        // When the animation ends, we clean the classes and resolve the Promise
        function handleAnimationEnd() {
            node.classList.remove(`${prefix}animated`, animationName);
            node.removeEventListener('animationend', handleAnimationEnd);
            resolve('Animation ended');
        }

        node.addEventListener('animationend', handleAnimationEnd);
    });