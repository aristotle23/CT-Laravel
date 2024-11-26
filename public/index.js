
$( function () {


    $(".edit-btn").on("click", function (e) {
        e.preventDefault();
        const $this = $(this);
        const id = $this.data("id");
        const quantity = $this.data("quantity");
        const name = $this.data("name");
        const price = $this.data("price");

        const productForm = $("#product-form");
        productForm.find("input[name=name]").val(name);
        productForm.find("input[name=quantity]").val(quantity);
        productForm.find("input[name=price]").val(price);

        productForm.find("#cancel-btn").removeClass("d-none")
        productForm.find("#submit-btn").text("Edit")

        let productId = $('<input type="hidden" name="product_id" />').val(id);

        productForm.append(productId);

    })
    $("#product-form #cancel-btn ").on("click", function (e) {
        e.preventDefault();
        const $this = $(this);
        const id = $this.data("id");
        const quantity = $this.data("quantity");
        const name = $this.data("name");
        const price = $this.data("price");

        const productForm = $("#product-form");
        productForm.find("input[name=name]").val("");
        productForm.find("input[name=quantity]").val("");
        productForm.find("input[name=price]").val("");
        productForm.find("#cancel-btn").addClass("d-none")
        productForm.find("#submit-btn").text("Submit")

        productForm.find("input[name=product_id]").remove()

    })


});










