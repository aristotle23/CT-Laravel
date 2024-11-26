
$( function () {


    $("#product-list ").on("click",".edit-btn", function (e) {
        e.preventDefault();
        const $this = $(this);
        const id = $this.data("id");
        const quantity = $this.data("quantity");
        const name = $this.data("name");
        const price = $this.data("price");

        const productForm = $("#product-form");
        productForm.find("input[name=product_id]").remove()
        productForm.find("input[name=name]").val(name);
        productForm.find("input[name=quantity]").val(quantity);
        productForm.find("input[name=price]").val(price);

        productForm.find("#cancel-btn").removeClass("d-none")
        productForm.find("#submit-btn").text("Edit")

        let productId = $('<input type="hidden" name="product_id" />').val(id);

        productForm.prepend(productId);


    })
    $("#product-form #cancel-btn ").on("click", function (e) {
        e.preventDefault();
        resetForm()
    })

    $("#product-form").on("submit",function (e) {
        e.preventDefault();
        const $this = $(this);
        axios.post('/api/product', document.querySelector('#product-form'), {
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(function({data}){
            if(data.data.product_id){
                updateTable(data)
            }else{
                addToTable(data)
            }
            updateTotal()
            resetForm()
            console.log(data)
        })

    })


});
function resetForm(){
    const productForm = $("#product-form");
    productForm.find("input[name=name]").val("");
    productForm.find("input[name=quantity]").val("");
    productForm.find("input[name=price]").val("");
    productForm.find("#cancel-btn").addClass("d-none")
    productForm.find("#submit-btn").text("Submit")
    productForm.find("input[name=product_id]").remove()
}

function updateTable({data}){
    const productRow = $(".edit-btn").filter(function(index){
        return $(this).data("id") === data.id
    }).parent().parent()
    productRow.find(".product-name").text(data.name)
    productRow.find(".product-quantity").text(data.quantity)
    productRow.find(".product-price").text(data.price)
    productRow.find(".total-value").text(data.total_value)

    console.log(productRow.find(".product_name"))
    console.log(data.name)
}

function addToTable({data}){
    const productList = $("#product-list tbody")
    const productRow = $("<tr>");
    productRow.append($("<td>").addClass("product-name").text(data.name));
    productRow.append($("<td>").addClass("product-quantity").text(data.quantity));
    productRow.append($("<td>").addClass("product-price").text(data.price));
    productRow.append($("<td>").addClass("product-time").text(data.date_time));
    productRow.append($("<td>").addClass("total-value").text(data.total_value));
    productRow.append($("<td>").append('<button  data-id="'+data.id+'" data-name="'+data.name+'" data-quantity="'+data.quantity+'" ' +
        'data-price="'+data.price+'" class="btn btn-primary float-sm-end edit-btn">Edit</button>'));

    productList.prepend(productRow)
}
function td(text, className){
    return $("<td>").addClass(className).text(text);
}
function updateTotal(){
    var total = 0
    $("#product-list .total-value").each(function(index){
        total += +$(this).text() || 0;
    })
    $("#total b").text(total);
}









