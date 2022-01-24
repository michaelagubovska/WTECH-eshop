$('#continuetoshippingbutton').click(function (e) {
    e.preventDefault();
    $('#carttabs a[href="#shipping"]').tab('show');
})

$('#continuetopaymentbutton').click(function (e) {
    e.preventDefault();
    $('#carttabs a[href="#payment"]').tab('show');
    $('#total_item').val(
        parseFloat($('#price_item').val())+
        parseFloat($('#payment_item').val())+
        parseFloat($('#shipping_item').val())
    );
})

$('#tab_payment_item').click(function (e) {
    $('#total_item').val(
        parseFloat($('#price_item').val())+
        parseFloat($('#payment_item').val())+
        parseFloat($('#shipping_item').val())
    );
})

$('input[name="shippingRadio"]').click(function (e) {
    let selected_shipping = $(this).val();

    $('#shipping_item').val(selected_shipping);

    $('#total_item').val(
        parseFloat($('#price_item').val())+
        parseFloat($('#payment_item').val())+
        parseFloat(selected_shipping)
    );
})

$('input[name="paymentRadio"]').click(function (e) {
    let selected_payment = $(this).val();

    $('#payment_item').val(selected_payment);

    $('#total_item').val(
        parseFloat($('#price_item').val())+
        parseFloat($('#shipping_item').val())+
        parseFloat(selected_payment)
    );


})



// function radio(id){
//     let selected_shipping = document.getElementById(id).attr('value');
//     console.log(selected_shipping);
//     let shipping = document.getElementById("shipping");
//     let price_final = parseFloat(document.getElementById('price').value());
//     let payment_final = parseFloat(document.getElementById('payment').value());
//     let total = parseFloat(document.getElementById('total').value());
//     shipping.val(selected_shipping);
//     shipping.textContent="dax";
//     let shipping_final = parseFloat(selected_shipping);
//
//     total.value = String(price_final + payment_final + total + shipping_final);
// }
