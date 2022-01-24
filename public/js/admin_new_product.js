$("#new_product_file").on("change", function() {
    if ($("#new_product_file")[0].files.length > 4) {
        $("#new_product_file").val([]);
        alert("Môžete vložiť iba 4 obrázky");
    }
});
