$(document).ready(function () {
    (function ($) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        // Fetch and render products based on search, category, and brand filters
        function fetchProducts() {
            var search = $("#search").val();
            var category = $("#category").val();
            var brand = $("#brand").val();

            $.ajax({
                type: "GET",
                url: "/admin/product-filter",
                data: {
                    search: search,
                    category: category,
                    brand: brand,
                },
                success: function (response) {
                    $("#product__lists").html(response);
                },
            });
        }

        // Fetch initial products on page load
        fetchProducts();

        // Trigger fetchProducts on input and change events
        $("#search").on("input", fetchProducts);
        $("#category").on("change", fetchProducts);
        $("#brand").on("change", fetchProducts);

        // Function to show cart details
        function showCartDetails() {
            $.ajax({
                url: "/admin/product-to-cart",
                type: "GET",
                success: function (response) {
                    $("#subtotal").html("$" + response.subTotal.toFixed(2));
                    $("#quantity").html("(" + response.quantity + ")");
                    $(".grand__total").html("$" + response.total.toFixed(2));
                    $("#tax").html(
                        "$" + (response.tax ? response.tax.toFixed(2) : "0.00")
                    );
                    $("#discount").html(
                        "$" +
                            (response.discount
                                ? response.discount.toFixed(2)
                                : "0.00")
                    );
                    $("#shipping-cost").html(
                        "$" +
                            (response.shipping
                                ? response.shipping.toFixed(2)
                                : "0.00")
                    );
                    $("#total_amount").val(response.total);
                    $(".pos-body").html(response.html);
                },
                error: function (xhr) {
                    toastr.error("Failed to load cart products!", "Error");
                },
            });
        }

        // Add product to cart
        $(document).on("click", ".product_lists", function (e) {
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
                    showCartDetails();
                },
                error: function (xhr) {
                    toastr.error("Something went wrong!", "Error");
                },
            });
        });

        // Event delegation for removing a product
        $(".pos-body").on("click", ".remove-product", function () {
            var cartId = $(this).closest(".pos-content").data("cart-id");
            $.ajax({
                url: "/admin/remove-from-cart/" + cartId,
                type: "DELETE",
                success: function (response) {
                    showCartDetails(); // Display updated cart after removing product
                },
                error: function (xhr) {
                    toastr.error("Failed to remove product!", "Error");
                },
            });
        });

        // Event delegation for incrementing quantity of a product
        $(".pos-body").on("click", ".increment", function () {
            var cartId = $(this).closest(".pos-content").data("cart-id");
            var quantityInput = $(this).siblings(".quantity-input");
            var currentQuantity = parseInt(quantityInput.val());

            $.ajax({
                url: "/admin/product-quantity-increment/" + cartId,
                type: "GET",
                success: function (response) {
                    showCartDetails(); // Display updated cart after incrementing quantity
                },
                error: function (xhr) {
                    toastr.error("Failed to increment quantity!", "Error");
                },
            });
        });

        // Event delegation for decrementing quantity of a product
        $(".pos-body").on("click", ".decrement", function () {
            var cartId = $(this).closest(".pos-content").data("cart-id");
            var quantityInput = $(this).siblings(".quantity-input");
            var currentQuantity = parseInt(quantityInput.val());

            if (currentQuantity > 1) {
                $.ajax({
                    url: "/admin/product-quantity-decrement/" + cartId,
                    type: "GET",
                    success: function (response) {
                        showCartDetails(); // Display updated cart after decrementing quantity
                    },
                    error: function (xhr) {
                        toastr.error("Failed to decrement quantity!", "Error");
                    },
                });
            }
        });

        // Event delegation for manual quantity input change
        $(".pos-body").on("input", ".quantity-input", function () {
            var cartId = $(this).closest(".pos-content").data("cart-id");
            var quantity = $(this).val();

            if (quantity < 1) {
                quantity = 1;
                $(this).val(1);
            }

            $.ajax({
                url: "/admin/product-quantity-manual/" + cartId,
                type: "POST",
                data: {
                    quantity: quantity,
                },
                success: function (response) {
                    // console.log(response);
                    showCartDetails(); // Display updated cart after manually changing quantity
                    if (response.warningMsg) {
                        toastr.warning(response.warningMsg, "Warning");
                    }
                },
                error: function (xhr) {
                    toastr.error("Failed to update quantity!", "Error");
                },
            });
        });

        // Event delegation for resetting the cart
        $("#reset").on("click", function () {
            $.ajax({
                url: "/admin/cart-reset",
                method: "GET",
                success: function (response) {
                    showCartDetails(); // Display updated cart after resetting
                    if (response.warningMsg) {
                        toastr.warning(response.warningMsg, "Warning");
                    }
                },
                error: function (xhr) {
                    toastr.error("Failed to reset cart products!", "Error");
                },
            });
        });

        // Function to enable or disable the "Order Now" button based on customer selection
        $("#customer").change(function () {
            var id = $(this).val();
            if (id) {
                $("#orderNow").prop("disabled", false);
                $("#orderNow").html('<i class="bx bx-cart me-1"></i>Order Now');
            } else {
                $("#orderNow").prop("disabled", true);
                $("#orderNow").html("Selected Customer");
            }
        });

        // Function to handle adding tax, discount, and shipping to the cart
        function handleCartAction(url, modalId) {
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    taxValue: $("#order_tax").val(),
                    discountType: $("#discount_type").val(),
                    discountValue: $("#discount_value").val(),
                    shippingType: $("#shipping_type").val(),
                    shippingValue: $("#shipping_price").val(),
                },
                success: function (response) {
                    $(modalId).modal("hide");
                    showCartDetails(); // Display updated cart after applying action
                },
            });
        }

        $("#taxButton, .product_lists").on("click", function () {
            handleCartAction("/admin/cart-tax", "#orderTax");
        });

        $("#discountButton, .product_lists").on("click", function () {
            handleCartAction("/admin/cart-discount", "#orderDiscount");
        });

        $("#shippingButton, .product_lists").on("click", function () {
            handleCartAction("/admin/cart-shipping-charge", "#orderShipping");
        });

        // Calculation for due amount
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

        // Initial load of cart details
        showCartDetails();

        // Event delegation for customer order and the cart empty
        $("#paymentNow").on("click", function () {
            // Clear previous error messages
            $(".is-invalid").removeClass("is-invalid");
            $(".invalid-feedback").remove();

            var formData = {
                customer_id: $("#customer").val(),
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
                    window.location.href = response.redirect_url;
                    if (response.success) {
                        localStorage.setItem(
                            "successMessage",
                            "Order create successfully."
                        );
                    }
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
        // Event delegation for customer order and the cart empty

        // Add new customer
        $(".new__customer").on("click", function () {
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

        //Toastr notifications show with reload
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

        $(".order-tax").on("click", function () {
            $("#orderTax").modal("show");
        });

        $(".order-shipping").on("click", function () {
            $("#orderShipping").modal("show");
        });

        $(".order-discount").on("click", function () {
            $("#orderDiscount").modal("show");
        });

        // // Reset input values when modals are closed
        // $('#orderTax, #orderShipping, #orderDiscount').on('hidden.bs.modal', function() {
        // 	$(this).find('input[type="text"], input[type="number"]').val('');
        // 	$(this).find('select').prop('selectedIndex', 0);
        // });

        // // Disable selected option in dropdown when modal is shown
        // $('#orderTax, #orderShipping, #orderDiscount').on('shown.bs.modal', function() {
        // 	var selectedOption = $(this).find('select option:selected');
        // 	$(this).find('select option').prop('disabled', false);
        // 	selectedOption.prop('disabled', true);
        // });

        // select 2 and toastr progress js
        toastr.options = {
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 1000,
        };

        $(".form-select").select2({
            theme: "bootstrap-5",
            text: "Select an option",
        });
        //select 2 and toastr progress js
    })(jQuery);
});
