var attrs = ['for', 'id', 'name', 'value'];
function resetAttributeNames(section) {
    var tags = section.find('input, label'), idx = section.index();
    tags.each(function () {
        var $this = $(this);
        $.each(attrs, function (i, attr) {
            var attr_val = $this.attr(attr);
            if (attr_val) {
                if (attr == 'id')
                    $this.attr(attr, attr_val + '_1')
                else
                    $this.attr(attr, attr_val.replace(/_\d+$/, '_' + (idx + 1)))
            }
        })
    })
}

$('.addProduct').click(function (e) {
    e.preventDefault();
    var lastRepeatingGroup = $('.repeatingSection').last();
    var cloned = lastRepeatingGroup.clone(true)
    cloned.insertAfter(lastRepeatingGroup);
    resetAttributeNames(cloned)
    var tags = cloned.find('input,select,textarea'), idx = cloned.index();
    tags.each(function () {
        var $this = $(this);
        $.each(attrs, function (i, attr) {
            var attr_val = $this.attr(attr);
//            if (attr_val) {
//                $this.attr(attr, attr_val.replace(/_\d+$/, '_' + (idx + 1)));
//            }
            if (attr == 'value') {
                $this.attr(attr, '');
                $this.val('');
            }
        })

    })

});

// Delete a repeating section
$('.deletesection').click(function (e) {
    e.preventDefault();
    var current_fight = $(this).parent('div');
    var other_fights = current_fight.siblings('.repeatingSection');
    if (other_fights.length === 0) {
//        alert("Atleast you should have one Product.");
        displayAlert("Atleast you should have one Product.");
        return;
    }
    current_fight.slideUp('slow', function () {
        current_fight.remove();

        var order_sub_total = 0;

        $('.product-price').each(function ()
        {
            qnty = $(this).parent().parent().find('input[name="product_qty[]"]').val();
            total = $(this).val();
            total = Number(total).toFixed(2);
            total = total * qnty;
            order_sub_total = +order_sub_total + +total;
            order_sub_total = Number(order_sub_total).toFixed(2);
        });

        $('#order_sub_total').val(order_sub_total);

        var coupon_id = $('#order_coupon_id').val();

        if (order_sub_total > 0 && coupon_id != '')
        {
            jQuery.ajax({
                url: Discount_Ajax_URL,
                type: "POST",
                dataType: "json",
                data: {coupon_id: coupon_id, sub_total: order_sub_total},
                success: function (response) {
                    if (response.error != "error")
                    {
                        grand_total = Number(response.grand_total).toFixed(2);
                        $('#order_grand_total').val(grand_total);
                    }
                }
            });
        } else
        {
            $('#order_grand_total').val(order_sub_total);
        }

        // reset fight indexes
        other_fights.each(function () {
            resetAttributeNames($(this));
        })

    })
});