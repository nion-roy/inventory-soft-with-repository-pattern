$(document).ready(function () {
    (function ($) {
        // Function to add product to cart
        $(".product_lists").click(function (e) {
            e.preventDefault();
            var productId = $(this).data("product-id");
            var sellingPrice = $(this).data("selling-price");

            $.ajax({
                url: "/admin/add-to-cart",
                method: "POST",
                data: {
                    productId: productId,
                    sellingPrice: sellingPrice,
                },
                success: function (response) {
                    // console.log(response);
                    showProducts();
                    if (response.warningMsg) {
                        toastr.warning(response.warningMsg, "Warning");
                    }
                    // else {
                    //     toastr.success(response.successMsg, "Success");
                    // }
                },
            });
        });
        // Function to add product to cart

        // Function to show products onload
        showProducts();

        function showProducts() {
            $.ajax({
                url: "/admin/product-to-cart",
                type: "GET",
                dataType: "json",
                success: function (response) {
                    $("#subtotal").html("$" + response.subTotal.toFixed(2));
                    $("#quantity").html("(" + response.quantity + ")");
                    $(".grand_total").html("$" + response.total.toFixed(2));
                    $("#tax").html( "$" + (response.tax ? response.tax.toFixed(2) : "0.00") );
                    $("#discount").html( "$" + (response.discount ? response.discount.toFixed(2) : "0.00") );
                    $("#shipping-cost").html( "$" + (response.shipping ? response.shipping.toFixed(2) : "0.00") );
                    $("#total_amount").val(response.total);

                    if (response.products && response.products.length > 0) {
                        var products = response.products;
                        $(".pos-body").empty();
                        products.forEach(function (product) {
                            $(
                                ".pos-body"
                            ).append(`<div class="pos-content d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="product-img">
                                        <img src="/${
                                            product.product.image
                                        }" width="40px" alt="">
                                        <button type="button" class="remove-product" data-cart-id="${
                                            product.id
                                        }"><i class="bx bx-x"></i></button>
                                    </div>
                                    <div class="product-details">
                                        <h4>${product.product.product_name}</h4>
                                        <h5>$${
                                            product.price * product.quantity
                                        }.00</h5>
                                    </div>
                                </div>
                                <div class="product-qty">
                                    <button class="decrement" data-cart-id="${
                                        product.id
                                    }" type="button"><i class="bx bx-minus"></i></button>
                                    <input type="number" class="form-control quantity-input" min="1" name="" id="" data-cart-id="${
                                        product.id
                                    }" value="${product.quantity}">
                                    <button class="increment" data-cart-id="${
                                        product.id
                                    }" type="button"><i class="bx bx-plus"></i></button>
                                </div>
                            </div>`);
                        });

                        // Adding event listener for remove product
                        $(".remove-product").click(function (e) {
                            e.preventDefault();
                            var cartId = $(this).data("cart-id");
                            removeProduct(cartId);
                        });

                        // Adding event listener for increment product
                        $(".increment").click(function (e) {
                            e.preventDefault();
                            var cartId = $(this).data("cart-id");
                            incrementProduct(cartId);
                        });

                        // Adding event listener for decrement product
                        $(".decrement").click(function (e) {
                            e.preventDefault();
                            var cartId = $(this).data("cart-id");
                            decrementProduct(cartId);
                        });

                        $(".quantity-input").on("input", function (e) {
                            e.preventDefault();
                            var cartId = $(this).data("cart-id");
                            var quantity = $(this).val();
                            // alert(cartId);
                            manualProduct(cartId, quantity);
                        });

                        // Enable the "Submit Now" button
                        $(
                            "#paymentNow, #discountButton, #taxButton, #shippingButton"
                        ).prop("disabled", false);
                    } else {
                        $(".pos-body")
                            .addClass("text-center")
                            .html("No products in the cart.");
                        // Disable the "Submit Now" button
                        $(
                            "#paymentNow, #discountButton, #taxButton, #shippingButton"
                        ).prop("disabled", true);
                    }
                },
            });
        }

        //Product Searching, Filtering function
        function fetchProducts() {
            var search = $("#search").val();
            var category = $("#category").val();
            var brand = $("#brand").val();

            var url = "/admin/product-filter";

            $.ajax({
                type: "get",
                url: url,
                data: {
                    search: search,
                    category: category,
                    brand: brand,
                },
                success: function (response) {
                    // console.log(response);
                    showProducts();
                    $("#product__lists").html(response);
                },
            });
        }

        // Trigger fetchProducts on page load
        // fetchProducts();

        // Trigger fetchProducts on input and change events
        $("#search").on("input", fetchProducts);
        $("#category").on("change", fetchProducts);
        $("#brand").on("change", fetchProducts);
        //Product Searching, Filtering function

        // Function to remove product from cart
        function removeProduct(cartId) {
            $.ajax({
                url: "/admin/remove-from-cart",
                method: "get",
                data: {
                    cartId: cartId,
                },
                success: function (response) {
                    showProducts();
                    if (response.warningMsg) {
                        toastr.warning(response.warningMsg, "Warning");
                    }
                },
            });
        }

        // Function to increment quantity product from cart
        function incrementProduct(cartId) {
            $.ajax({
                url: "/admin/product-quantity-increment",
                method: "get",
                data: {
                    cartId: cartId,
                },
                success: function (response) {
                    showProducts();
                    if (response.warningMsg) {
                        toastr.warning(response.warningMsg, "Warning");
                    }
                },
            });
        }

        // Function to decrement quantity product from cart
        function decrementProduct(cartId) {
            $.ajax({
                url: "/admin/product-quantity-decrement",
                method: "get",
                data: {
                    cartId: cartId,
                },
                success: function (response) {
                    showProducts();
                    if (response.warningMsg) {
                        toastr.warning(response.warningMsg, "Warning");
                    }
                },
            });
        }

        // Function to manual quantity product from cart
        function manualProduct(cartId, quantity) {
            $.ajax({
                url: "/admin/product-quantity-manual",
                type: "GET",
                data: {
                    cartId: cartId,
                    quantity: quantity,
                },
                success: function (response) {
                    // console.log(response);
                    showProducts();
                    if (response.warningMsg) {
                        toastr.warning(response.warningMsg, "Warning");
                    }
                },
            });
        }

        // Function to all product remove from cart table
        $("#reset").click(function (e) {
            e.preventDefault();

            $.ajax({
                url: "/admin/cart-reset",
                method: "get",
                success: function (response) {
                    // toastr.success(response.successMsg, "Success");
                    showProducts();
                },
            });
        });

        // Function to calculation
        $("#paying_amount").on("input", function () {
            var totalAmount = parseFloat($("#total_amount").val());
            var payingAmount = parseFloat($("#paying_amount").val());
            var dueAmount = totalAmount - payingAmount;
            if (payingAmount) {
                $("#due_amount").val(dueAmount);
            } else {
                $("#due_amount").val(totalAmount);
            }
        });
        // Function to calculation

        // Function to order
        $("#paymentNow").click(function (e) {
            e.preventDefault();

            // Clear previous error messages
            $(".is-invalid").removeClass("is-invalid");
            $(".invalid-feedback").remove();

            var formData = {
                customer_id: $("#customer_id").val(),
                total_amount: $("#total_amount").val(),
                paying_amount: $("#paying_amount").val(),
                due_amount: $("#due_amount").val(),
                payment_type: $("#payment_type").val(),
                payment_note: $("#payment_note").val(),
                sale_note: $("#sale_note").val(),
            };

            $.ajax({
                url: "/admin/order",
                type: "POST",
                data: formData,
                success: function (response) {
                    // alert("Order successful!"); .
                    window.location.href = response.redirect_url;
                },
                error: function (xhr, status, error) {
                    var errors = xhr.responseJSON;
                    $.each(errors.errors, function (key, value) {
                        $("#" + key).addClass("is-invalid");
                        $("#" + key).after(
                            '<span class="invalid-feedback text-danger">' +
                                value[0] +
                                "</span>"
                        );
                    });
                },
            });
        });
        // Function to order

        // Add new customer
        $("#customer").click(function (e) {
            e.preventDefault();

            // Clear previous error messages
            $(".is-invalid").removeClass("is-invalid");
            $(".invalid-feedback").empty();

            var formData = {
                name: $("#name").val(),
                email: $("#email").val(),
                contact: $("#contact").val(),
                address: $("#address").val(),
                status: $("#status").val(),
            };

            $.ajax({
                url: "/admin/customer",
                type: "POST",
                data: formData,
                success: function (response) {
                    // console.log(response);
                    localStorage.setItem(
                        "successMessage",
                        "New customer added successfull.."
                    );
                    window.location.href = window.location.href;
                },
                error: function (xhr, status, error) {
                    var errors = xhr.responseJSON;
                    $.each(errors.errors, function (key, value) {
                        $("#" + key).addClass("is-invalid");
                        $("#" + key).after(
                            '<span class="invalid-feedback text-danger">' +
                                value[0] +
                                "</span>"
                        );
                    });
                },
            });
        });
        // Add new customer

        //Order now button disabled when not selected any customer
        $("#customer_id").change(function () {
            var id = $(this).val();
            if (id) {
                $("#orderNow").prop("disabled", false);
                $("#orderNow").html('<i class="bx bx-cart me-1"></i>Order Now');
            } else {
                $("#orderNow").prop("disabled", true);
                $("#orderNow").html("Selected Customer");
            }
        });
        //Order now button disabled when not selected any customer

        //Add tax with product
        $("#taxButton, .product_lists").on("click", function () {
            var taxValue = $("#order_tax").val();
            // alert(taxID);
            $.ajax({
                type: "GET",
                url: "/admin/cart-tax",
                data: {
                    taxValue: taxValue,
                },
                success: function (response) {
                    $("#orderTax").modal("hide");
                    showProducts();
                    // console.log(response);
                },
            });
        });
        //Add tax with product

        //Add discount price with product
        $("#discountButton, .product_lists").on("click", function () {
            var discountType = $("#discount_type").val();
            var discountValue = $("#discount_value").val();
            // alert(discountType + discountValue);
            $.ajax({
                type: "GET",
                url: "/admin/cart-discount",
                data: {
                    discountType: discountType,
                    discountValue: discountValue,
                },
                success: function (response) {
                    $("#orderDiscount").modal("hide");
                    showProducts();
                    // console.log(response);
                },
            });
        });
        //Add discount price with product

        //Add shipping price with product
        $("#shippingButton, .product_lists").on("click", function () {
            var shippingType = $("#shipping_type").val();
            var shippingValue = $("#shipping_price").val();
            // alert(shippingType + shippingValue);
            $.ajax({
                type: "GET",
                url: "/admin/cart-shipping-charge",
                data: {
                    shippingType: shippingType,
                    shippingValue: shippingValue,
                },
                success: function (response) {
                    $("#orderShipping").modal("hide");
                    showProducts();
                    // console.log(response);
                },
            });
        });
        //Add shipping price with product

        var successMessage = localStorage.getItem("successMessage");
        if (successMessage) {
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 1000,
            };
            toastr.success(successMessage, "Success");
            localStorage.removeItem("successMessage");
        }
    })(jQuery);
});
