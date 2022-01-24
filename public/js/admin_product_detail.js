function selectedPhoto() {
    $('select[id=product_images_detail]').click(function(e) {
        let path = $(this).val();
        let img = document.getElementById('detail_photo');
        img.src = window.location.origin+"/"+path;
    });

    $('input[name=admin_size]').click(function(e) {
        $('#product_quantity_detail').val($(this).attr('quantity'));
    });
}
