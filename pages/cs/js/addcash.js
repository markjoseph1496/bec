$.getScript("../../dist/js/bootbox.min.js", function(){

});

function noenter(e) {
    e = e || window.event;
    var key = e.keyCode || e.charCode;
    return key !== 13;
}

function addItem() {
    var data = $('#imeisn, #ItemCode, #model_name, #Brand, #UnitPrice');
    var row = $('<tr>');
    for (var i = 0; i < data.length; i++) {
        $('<td>').text(data[i].value).appendTo(row);
    }

    $('<input type="hidden" name="tItemCode[]">').val(data[0].value).appendTo(row);
    $('<input type="hidden" name="timeisn[]">').val(data[1].value).appendTo(row);
    $('<input type="hidden" name="tmodel_name[]">').val(data[2].value).appendTo(row);
    $('<input type="hidden" name="tBrand[]">').val(data[3].value).appendTo(row);
    $('<input type="hidden" name="tUnitPrice[]">').val(data[4].value).appendTo(row);
    row.appendTo('#Items');

    var tPrice = document.getElementsByName('tUnitPrice[]'); //value of unit price on table

    itemCode.value = "";
    imeisn.value = "";
    ModelUnit.value = "";
    brand.value = "";
    UnitPrice.value = "";

    var stPrice = 0;

    for (i = 0; i < tPrice.length; i++) {
        stPrice = parseFloat(stPrice) + parseFloat(tPrice[i].value.replace(/,/g, ''));
    }
    stPrice = accounting.formatNumber(stPrice, 2, ",", ".");
    sPrice.textContent = stPrice;
    hPrice.value = stPrice;

}

function checkImeiSN(e) {
    if (e && e.keyCode == 13) {

        $.ajax({
            type: 'POST',
            url: 'functions/checkimeisn.php',
            data: 'imeisn=' + imeisn.value,
            success: function (data) {
                var result = $.parseJSON(data);
                if (result.Count == 0) {
                    alert("Item doesn't exists");
                    imeisn.value = "";
                } else {
                    itemCode.value = result.rItemCode;
                    ModelUnit.value = result.rModelName;
                    brand.value = result.rBrand;
                    UnitPrice.value = accounting.formatNumber(result.rUnitPrice, 2, ",", ".");
                    var b = arrayImei.indexOf(imeisn.value);
                    if (b == -1) {
                        arrayImei.push(imeisn.value);
                        addItem();
                    }
                    else {
                        imeisn.value = "";
                        bootbox.dialog({
                            message: "I am a custom dialog",
                            title: "Custom title",
                            buttons: {
                                success: {
                                    label: "Success!",
                                    className: "btn-success"
                                },
                                danger: {
                                    label: "Danger!",
                                    className: "btn-danger"
                                },
                                main: {
                                    label: "Click ME!",
                                    className: "btn-primary"
                                }
                            }
                        });
                    }

                }
            }
        })
    }
}