$.getScript("../../dist/js/bootbox.min.js", function () {

});

function noenter(e) {
    e = e || window.event;
    var key = e.keyCode || e.charCode;
    return key !== 13;
}

function addItem() {
    var data = $('#imeisn, #ItemCode, #model_name, #Brand, #UnitPrice');
    var row = $('<tr>');
    var modalrow = $('<tr>');

    $('<td width="15%">').text(data[0].value).appendTo(row);
    $('<td width="20%">').text(data[1].value).appendTo(row);
    $('<td width="15%">').text(data[2].value).appendTo(row);
    $('<td width="15%">').text(data[3].value).appendTo(row);
    $('<td width="15%">').text(data[4].value).appendTo(row);
    $('<td width="20%"><a class="btn btn-default"><i class="fa fa-pencil-square-o"></i></a> <a onclick="deleteItem(this);" class="btn btn-danger"><i class="fa fa-trash fa-1x"></i></a></td>').appendTo(row);

    $('<input type="hidden" name="tItemCode[]">').val(data[0].value).appendTo(row);
    $('<input type="hidden" name="timeisn[]">').val(data[1].value).appendTo(row);
    $('<input type="hidden" name="tmodel_name[]">').val(data[2].value).appendTo(row);
    $('<input type="hidden" name="tBrand[]">').val(data[3].value).appendTo(row);
    $('<input type="hidden" name="tUnitPrice[]">').val(data[4].value).appendTo(row);
    row.appendTo('#Items');

    $('<td width="20%">').text(data[0].value).appendTo(modalrow);
    $('<td width="20%">').text(data[1].value).appendTo(modalrow);
    $('<td width="20%">').text(data[2].value).appendTo(modalrow);
    $('<td width="20%">').text(data[3].value).appendTo(modalrow);
    $('<td width="20%">').text(data[4].value).appendTo(modalrow);
    modalrow.appendTo('#ModalItems');

    itemCode.value = "";
    imeisn.value = "";
    ModelUnit.value = "";
    brand.value = "";
    UnitPrice.value = "";
    updateTotalPrice();

}

function updateTotalPrice(){
    var tPrice = document.getElementsByName('tUnitPrice[]'); //value of unit price on table
    for (i = 0; i < tPrice.length; i++) {
        stPrice = parseFloat(stPrice) + parseFloat(tPrice[i].value.replace(/,/g, ''));
    }
    stPrice = accounting.formatNumber(stPrice, 2, ",", ".");
    sPrice.textContent = stPrice;
    hPrice.value = stPrice;
    AmountToPay.value = stPrice;
    mPrice.textContent = stPrice;
    stPrice = 0;
    updateBalance();
}

function updateBalance(){
    var TotalAmountTendered = parseFloat(Cash.value.replace(/,/g, "") || 0) + parseFloat(Credit.value.replace(/,/g, "") || 0) + parseFloat(HomeCredit.value.replace(/,/g, "") || 0);
    TotalAmountTendered = accounting.formatNumber(TotalAmountTendered, 2, ",", ".");
    AmountTendered.value = TotalAmountTendered;
    Balance.value = accounting.formatNumber(parseFloat(TotalAmountTendered.replace(/,/g, "")) - parseFloat(AmountToPay.value.replace(/,/g, "")), 2, ",", ".");

}

function ConvertToMoney(){
    if(Cash.value.length == 0){
        Cash.value = "0.00";
    }
    if(Credit.value.length == 0){
        Credit.value = "0.00";
    }
    if(HomeCredit.value.length == 0){
        HomeCredit.value = "0.00";
    }

    Cash.value = accounting.formatNumber(Cash.value, 2, ",", ".");
    Credit.value = accounting.formatNumber(Credit.value, 2, ",", ".");
    HomeCredit.value = accounting.formatNumber(HomeCredit.value, 2, ",", ".");

    TransactionFields();
    updateBalance();
}


function deleteItem(r) {
    var i = r.parentNode.parentNode.rowIndex;
    var timeisn = document.getElementsByName('timeisn[]');
    var tItemCode = document.getElementsByName('tItemCode[]');
    var tmodel_name = document.getElementsByName('tmodel_name[]');
    var tBrand = document.getElementsByName('tBrand[]');
    var tUnitPrice = document.getElementsByName('tUnitPrice[]');

    $("input").remove(timeisn[i - 1], tItemCode[i - 1], tmodel_name[i - 1], tBrand[i - 1], tUnitPrice[i - 1]);
    arrayImei.splice(i, 1);
    DeleteRow.deleteRow(i);
    ModalItems.deleteRow(i);
    updateTotalPrice();
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
                    imeisn.value = "";
                    $('#noItemFromDB').modal('show');
                    $('#noItemFromDB').on('hidden.bs.modal', function () {
                        imeisn.focus();
                    });
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
                        $('#itemExists').modal('show');
                        $('#itemExists').on('hidden.bs.modal', function () {
                            imeisn.focus();
                        });
                    }
                }
            }
        })
    }
}

function ProceedToPayment() {
    if (arrayImei == 0) {
        $('#PaymentDetails').modal('show');
        //$('#noItemModal').modal('show');
        $('#noItemModal').on('hidden.bs.modal', function () {
            imeisn.focus();
        });
    }
    else {
        $('#PaymentDetails').modal('show');
        $('#PaymentDetails').on('shown.bs.modal', function () {
            ORNumber.focus();
        });
    }
}

function TransactionFields() {
    if ($(Credit).val() != "0.00") {
        $('#divCreditCard').show();
    }else{
        $('#divCreditCard').hide();
    }


    if($(HomeCredit).val() != "0.00"){
        $('#divHomeCredit').show();
    }
    else{
        $('#divHomeCredit').hide();
    }
}