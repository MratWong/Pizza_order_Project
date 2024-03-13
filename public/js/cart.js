$(document).ready(function() {
    $('.btn-plus').click(function() {
        $parentNode = $(this).parents('tr');
        $price = Number($parentNode.find('#price').text().replace("MMK", ""));
        $qty = Number($parentNode.find('#qty').val());

        $total = $price * $qty;
        $parentNode.find('#total').html($total + " MMK"); //html(`${$total} MMK`)
        finalCalculation();
    })

    $('.btn-minus').click(function() {
        $parentNode = $(this).parents('tr');
        $price = Number($parentNode.find('#price').text().replace("MMK", ""));
        $qty = Number($parentNode.find('#qty').val());

        $total = $price * $qty;
        $parentNode.find('#total').html($total + "MMK");
        finalCalculation();
    })

    function finalCalculation() {
        $subTotal = 0;
        $('#tableId tr').each(function(index, row) {
            $subTotal += Number($(row).find('#total').text().replace('MMK', ''));
        })
        $('#subTotalPrice').html(`${$subTotal} MMK`);
        // $('#finalTotalPrice').html(`${$subTotal+ 2500} MMK`)
        if ($subTotal == 0) {
            $('#finalTotalPrice').html('0 MMK')
        } else {
            $('#finalTotalPrice').html(`${$subTotal+ 2500} MMK`)
        }
    }
})
