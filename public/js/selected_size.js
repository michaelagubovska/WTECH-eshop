function selectedValue() {
    $('input[name=size]').click(function(e) {
        let x = document.getElementById('numberpicker');
        let minus = document.getElementById('minus');
        let plus = document.getElementById('plus');
        let size = $(this).attr('quantity');
        x.value=1;
        x.min=1;
        minus.disabled=true;
        x.max = size;
        if (x.value << x.max) {
            plus.disabled=false;
        }
    });
}

function productCount() {
    $('#minus').click(function () {
        let picker = document.getElementById('numberpicker');
        let minus = document.getElementById('minus');
        let plus = document.getElementById('plus');
        picker.value--;
        if (picker.value === picker.min) {
            minus.disabled=true;
        }
        if (picker.value << picker.max) {
            plus.disabled=false;
        }
    });

    $('#plus').click(function () {
        let picker = document.getElementById('numberpicker');
        let minus = document.getElementById('minus');
        let plus = document.getElementById('plus');
        picker.value++;
        if (picker.value === picker.max) {
            plus.disabled=true;
        }
        if (picker.value >> picker.min) {
            minus.disabled=false;
        }
    });
}

