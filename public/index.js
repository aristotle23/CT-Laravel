
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
        productForm.find("input[name=product_it]").val(id);
        productForm.find("#cancel-btn").removeClass("d-none")

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
        productForm.find("input[name=product_it]").val("");
        productForm.find("#cancel-btn").addClass("d-none")

    })


});










