var ItemsToOrder = document.getElementById("ItemsToOrder");
var sPrice = document.getElementById("sPrice"); //label of total price
var arrayItem = ["0"];
var imeisnArray = ["0"];
var ModalClose = $('.modal-header button');
var lblTotalPrice = document.getElementById("AmountToPay");
var lblAmountTendered = document.getElementById("AmountTendered");
var lblChange = document.getElementById("Change");

var sCash = document.getElementById('Cash');
var sCreditCard = document.getElementById('CreditCard');
var sHomeCredit = document.getElementById('HomeCredit');

$('.modal').on('shown.bs.modal', function () {
    ModalClose.focus();
});

$('.modal').on('hidden.bs.modal', function () {
    $('#ImeiSN').focus();
    ModalClose.focus();
});


function addItemToOrder(r) {
    var i = r.parentNode.parentNode.rowIndex;
    i--;

    var tItemCode = document.getElementsByName('tItemCode[]');
    var tColor = document.getElementsByName('tColor[]');
    var tQty = document.getElementsByName('tQty[]');
    var b = arrayItem.indexOf(tItemCode[i].value + tColor[i].value);
    if (b == -1) {
        if (tQty[i].value == 0) {
            alert('Please enter quantity.');
        }
        else {
            if (tColor[i].value == "") {
                alert('Please select Color.');
            }
            else {
                var row = $('<tr>');
                var tModelName = document.getElementsByName('tModelName[]');
                var tBrand = document.getElementsByName('tBrand[]');
                var tCategory = document.getElementsByName('tCategory[]');
                var tSRP = document.getElementsByName('tSRP[]');

                var tTotalPrice = parseFloat(tSRP[i].value.replace(/,/g, "")) * parseFloat(tQty[i].value.replace(/,/g, ""));
                tTotalPrice = accounting.formatNumber(tTotalPrice, 2, ",", ".");

                $('<td>').text(tItemCode[i].value).appendTo(row);
                $('<td>').text(tModelName[i].value + " (" + tColor[i].value + ")").appendTo(row);
                $('<td>').text(tBrand[i].value).appendTo(row);
                $('<td>').text(tSRP[i].value).appendTo(row);
                $('<td><input type="number" onchange="updateTotalAmount(this);" onkeypress="return noenter(event);" name="oQty[]" max="1000" min="1" class="form-control" style="width: 80px;" value=' + tQty[i].value + '>').appendTo(row);
                $('<td>').text(tTotalPrice).appendTo(row);
                $('<td><a class="btn btn-danger" onclick="deleteItemOrder(this);"><i class="fa fa-trash"></i></a>').appendTo(row);

                $('<input type="hidden" name="oColor[]" value=' + tColor[i].value + '>').appendTo(row);
                $('<input type="hidden" name="oItemCode[]" value=' + tItemCode[i].value + '>').appendTo(row);
                $('<input type="hidden" name="oSRP[]" value=' + tSRP[i].value + '>').appendTo(row);
                $('<input type="hidden" name="oTotalPrice[]" value=' + tTotalPrice + '>').appendTo(row);

                row.appendTo('#ItemsToOrder');

                arrayItem.push(tItemCode[i].value + tColor[i].value);
                $('#AddItemModal').modal('hide');
                tQty[i].value = 0;
                tColor[i].value = "";
                updateTotal();
            }
        }
    }
    else {
        $('#itemExists').modal('show');
    }

}

function updateTotal() {
    var stPrice = 0;
    var tPrice = document.getElementsByName('oTotalPrice[]'); //value of unit price on table

    for (var x = 0; x < tPrice.length; x++) {
        stPrice = parseFloat(stPrice) + parseFloat(tPrice[x].value.replace(/,/g, ''));
    }

    stPrice = accounting.formatNumber(stPrice, 2, ",", ".");
    sPrice.textContent = stPrice;
}

function updateTotalAmount(r) {
    var i = r.parentNode.parentNode.rowIndex;
    i--;
    var stPrice = 0;
    var oSRP = document.getElementsByName('oSRP[]');
    var oQty = document.getElementsByName('oQty[]');
    var ordertable = document.getElementById('ItemsToOrder');
    var tTotalPrice = parseFloat(oSRP[i].value.replace(/,/g, "")) * parseFloat(oQty[i].value.replace(/,/g, ""));

    tTotalPrice = accounting.formatNumber(tTotalPrice, 2, ",", ".");
    document.getElementsByName('oTotalPrice[]')[i].value = tTotalPrice;
    ordertable.rows[i + 1].cells[5].innerHTML = tTotalPrice;
    var tPrice = document.getElementsByName('oTotalPrice[]'); //value of unit price on table

    for (var x = 0; x < tPrice.length; x++) {
        stPrice = parseFloat(stPrice) + parseFloat(tPrice[x].value.replace(/,/g, ''));
    }

    stPrice = accounting.formatNumber(stPrice, 2, ",", ".");
    sPrice.textContent = stPrice;

}

function deleteItemOrder(r) {
    var i = r.parentNode.parentNode.rowIndex;
    var oQty = document.getElementsByName('oQty[]');
    var oItemCode = document.getElementsByName('oItemCode[]');
    var oSRP = document.getElementsByName('oSRP[]');
    var oTotalPrice = document.getElementsByName('oTotalPrice[]');
    var oColor = document.getElementsByName('oColor[]');

    $("input").remove(oQty[i - 1], oItemCode[i - 1], oSRP[i - 1], oTotalPrice[i - 1], oColor[i - 1]);
    arrayItem.splice(i, 1);
    ItemsToOrder.deleteRow(i);
    new PNotify({
        title: 'Item Deleted',
        type: 'success',
        styling: 'bootstrap3',
        delay: 3000
    });
    updateTotal();
}

function PurchaseOrder() {
    if (arrayItem == 0) {
        $('#noItemModal').modal('show');
    }
    else {
        $('#CheckItems').modal('show');
    }
}

function UpdatePurchaseOrder() {
    if (arrayItem == 0) {
        $('#noItemModal').modal('show');
    }
    else {
        $('#CheckItems').modal('show');
    }
}

function PODetails(PONumber, hash, rnd) {
    $.ajax({
        type: 'POST',
        url: 'php/function.php',
        data: {
            PONumber: PONumber,
            Hash: hash,
            rnd: rnd
        },
        success: function (data) {
            $('#PODetails').html(data);
            $('#PODetails').modal('show');
        }
    })
}

function noenter(e) {
    e = e || window.event;
    var key = e.keyCode || e.charCode;
    return key !== 13;
    $('.modal').modal('hide');
}

function DeletePR(PRNumber) {
    $.ajax({
        type: 'POST',
        url: 'php/function.php',
        data: 'dPONumber=' + PRNumber,
        success: function (data) {
            window.location.replace("po.php?" + data);
        }
    })
}

function logout() {
    var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        document.location = '../../index.php';
    };
    xhr.open('GET', '../../functions/logout.php', true);
    xhr.send();
}

function addItemsToModify() {
    var tItemCode = document.getElementsByName('aItemCode[]');
    for (var i = 0; i < tItemCode.length; i++) {
        var tQty = document.getElementsByName('aQty[]');
        var row = $('<tr>');
        var tModelName = document.getElementsByName('aModelName[]');
        var tColor = document.getElementsByName('aColor[]');
        var tBrand = document.getElementsByName('aBrand[]');
        var tSRP = document.getElementsByName('aSRP[]');

        var tTotalPrice = parseFloat(tSRP[i].value.replace(/,/g, "")) * parseFloat(tQty[i].value.replace(/,/g, ""));
        tTotalPrice = accounting.formatNumber(tTotalPrice, 2, ",", ".");

        $('<td>').text(tItemCode[i].value).appendTo(row);
        $('<td>').text(tModelName[i].value + " (" + tColor[i].value + ")").appendTo(row);
        $('<td>').text(tBrand[i].value).appendTo(row);
        $('<td>').text(tSRP[i].value).appendTo(row);
        $('<td><input type="number" onchange="updateTotalAmount(this);" onkeypress="return noenter(event);" name="oQty[]" max="1000" min="1" class="form-control" style="width: 80px;" value=' + tQty[i].value + '>').appendTo(row);
        $('<td>').text(tTotalPrice).appendTo(row);
        $('<td><a class="btn btn-danger" onclick="deleteItemOrder(this);"><i class="fa fa-trash"></i></a>').appendTo(row);

        $('<input type="hidden" name="oItemCode[]" value=' + tItemCode[i].value + '>').appendTo(row);
        $('<input type="hidden" name="oSRP[]" value=' + tSRP[i].value + '>').appendTo(row);
        $('<input type="hidden" name="oTotalPrice[]" value=' + tTotalPrice + '>').appendTo(row);

        row.appendTo('#ItemsToOrder');

        arrayItem.push(tItemCode[i].value + tColor[i].value);
        updateTotal();
    }
}

function AddItem(e) {
    if (e && e.keyCode == 13) {
        var ImeiSN = $('#ImeiSN').val();
        var Qty = document.getElementById('rQty');
        if (ImeiSN.replace(/ /g, '') == "") {
            $('#NoItem').modal('show');
            $('#ImeiSN').val("");
            $('#ImeiSN').focus();
        } else {
            if (imeisnArray.length <= Qty.value) {
                $.ajax({
                    type: 'POST',
                    url: 'php/validate.php',
                    data: 'ImeiSN=' + ImeiSN,
                    success: function (data) {
                        if (data == false) {
                            $('#ImeiSN').val("");
                            $('#itemExists').modal('show');
                            $('#itemExists').on('hidden.bs.modal', function () {
                                $('#ImeiSN').val("");
                                $('#ImeiSN').focus();
                            });
                        }
                        else if (data == true) {
                            var b = imeisnArray.indexOf(ImeiSN);
                            if (b == -1) {
                                addToReceiving();
                            } else {
                                $('#ImeiSN').val("");
                                $('#itemExists').modal('show');
                                $('#itemExists').on('hidden.bs.modal', function () {
                                    $('#ImeiSN').val("");
                                    $('#ImeiSN').focus();
                                });
                            }
                        }
                        else {
                            $('#ErrorModal').modal('show');
                            $('#ErrorModal').on('hidden.bs.modal', function () {
                                $('#ImeiSN').val("");
                                $('#ImeiSN').focus();
                            });
                        }
                    }
                });
            }
            else {
                $('#ImeiSN').val("");
                $('#itemLimit').modal('show');
            }
        }
    }
}

function addToReceiving() {
    var ItemCode = document.getElementById('rItemCode');
    var ItemName = document.getElementById('rItemName');
    var ItemColor = document.getElementById('rColor');
    var Brand = document.getElementById('rBrand');
    var IMEISN = document.getElementById('ImeiSN');

    var row = $('<tr>');

    $('<td>').text(ItemCode.value).appendTo(row);
    $('<td>').text(ItemName.value + " (" + ItemColor.value + ")").appendTo(row);
    $('<td>').text(Brand.value).appendTo(row);
    $('<td>').text(IMEISN.value).appendTo(row);
    $('<td><a class="btn btn-danger" onclick="deleteItemReceived(this);"><i class="fa fa-trash"></i></a>').appendTo(row);

    $('<input type="hidden" name="_ImeiSN[]" value=' + IMEISN.value + '>').appendTo(row);


    row.appendTo('#ItemsToOrder');
    imeisnArray.push(IMEISN.value);
    UpdateLabels();
    IMEISN.value = "";
}

function UpdateLabels() {
    var Qty = document.getElementById('rQty');
    var Received = document.getElementById('rReceived');
    var sQty = document.getElementById('sQty');
    var IMEISN = document.getElementById('ImeiSN');

    sQty.textContent = imeisnArray.length - 1 + parseInt(Received.value) + " / " + Qty.value;


}

function deleteItemReceived(r) {
    var i = r.parentNode.parentNode.rowIndex;

    var IMEISN = document.getElementsByName('_ImeiSN[]');

    $("input").remove(IMEISN[i - 1]);
    ItemsToOrder.deleteRow(i);
    imeisnArray.splice(i, 1);

    UpdateLabels();

}

function ReceiveItems() {
    if (imeisnArray == 0) {
        $('#noItemModal').modal('show');
    }
    else {
        $('#CheckItems').modal('show');
    }
}

function addSaleItem(e) {
    if (e && e.keyCode == 13) {
        var ImeiSN = $('#ImeiSN').val();
        var b = imeisnArray.indexOf(ImeiSN);
        if (b == -1) {
            $.ajax({
                type: 'POST',
                url: 'php/validate.php',
                data: 'sImeiSN=' + ImeiSN,
                success: function (data) {
                    var result = $.parseJSON(data);
                    if (result.Count == "1") {
                        $('#ItemCode').val(result.ItemCode);
                        $('#ModelName').val(result.ModelName);
                        $('#Description').val(result.Description);
                        $('#SRP').val(result.SRP);
                        $('#Category').val(result.Category);
                        $('#ItemColor').val(result.Color);

                        AddItemsToSales();
                    }
                    else if (result.Count == "0") {
                        $('#ImeiSN').val("");
                        $('#itemDontExists').modal('show');
                        $('#itemDontExists').on('hidden.bs.modal', function () {
                            $('#ImeiSN').val("");
                            $('#ImeiSN').focus();
                        });
                    }
                    else {
                        $('#ErrorModal').modal('show');
                        $('#ErrorModal').on('hidden.bs.modal', function () {
                            $('#ImeiSN').val("");
                            $('#ImeiSN').focus();
                        });
                    }
                }
            });
        } else {
            $('#ImeiSN').val("");
            $('#itemExists').modal('show');
            $('#itemExists').on('hidden.bs.modal', function () {
                $('#ImeiSN').val("");
                $('#ImeiSN').focus();
            });
        }
    }
}

function AddItemsToSales() {
    var IMEISN = document.getElementById('ImeiSN');
    var ItemCode = document.getElementById('ItemCode');
    var ModelName = document.getElementById('ModelName');
    var Description = document.getElementById('Description');
    var SRP = document.getElementById('SRP');
    var Category = document.getElementById('Category');
    var ItemColor = document.getElementById('ItemColor');

    SRP.value = accounting.formatNumber(SRP.value, 2, ",", ".");

    var row = $('<tr>');

    $('<td><a onclick="DeleteSales(this)" class="glyphicon glyphicon-remove red"></a><a onclick="EditSales(this)" class="glyphicon glyphicon-edit"></a>').appendTo(row);
    if (Category.value == "Unit") {
        $('<td>' +
            '<b>' + ModelName.value + " (" + ItemColor.value + ")" + '</b>' +
            '<i>' +
            '<br>Description: ' + Description.value + '' +
            '<br>IMEI: ' + IMEISN.value + '<br>' +
            '</i>').appendTo(row);
        $('<td align="right">').text(SRP.value).appendTo(row);
        $('<td align="center">').text("1").appendTo(row);
        $('<td align="right">').text(SRP.value).appendTo(row);
    } else {
        $('<td>' +
            '<b>' + ModelName.value + '</b>' +
            '<i>' +
            '<br>Description: ' + Description.value + '' +
            '</i>').appendTo(row);
        $('<td align="right">').text(SRP.value).appendTo(row);
        $('<td align="center">').text("1").appendTo(row);
        $('<td align="right">').text(SRP.value).appendTo(row);
    }

    $('<input type="hidden" name="sIMEISN[]">').val(IMEISN.value).appendTo(row);
    $('<input type="hidden" name="sSRP[]">').val(SRP.value).appendTo(row);
    $('<input type="hidden" name="sQty[]">').val("1").appendTo(row);
    $('<input type="hidden" name="sTotal[]">').val(SRP.value).appendTo(row);

    row.appendTo('#ItemsToOrder');
    imeisnArray.push(IMEISN.value);
    IMEISN.value = "";
    updateTotalSales();
}

function NumericOnly(e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
        // Allow: Ctrl+A, Command+A
        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
        // Allow: home, end, left, right, down, up
        (e.keyCode >= 35 && e.keyCode <= 40)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
}

function ConvertToMoney() {
    if ($('#Cash').length == 0) {
        Cash.value = "0.00";
    }
    if ($('#HomeCredit').length == 0) {
        Cash.value = "0.00";
    }
    if ($('#CreditCard').length == 0) {
        Cash.value = "0.00";
    }

    $('#Cash').val(accounting.formatNumber($('#Cash').val(), 2, ",", "."));
    $('#CreditCard').val(accounting.formatNumber($('#CreditCard').val(), 2, ",", "."));
    $('#HomeCredit').val(accounting.formatNumber($('#HomeCredit').val(), 2, ",", "."));

    updateAmountTendered();

}

function aModeOfPayment() {
    if ($('#ModeOfPayment').val() == "Cash") {
        $('#DivCash').show();
        $('#divCreditCard').hide();
        $('#divHomeCredit').hide();
    }
    else if ($('#ModeOfPayment').val() == "Credit Card") {
        $('#DivCash').hide();
        $('#divCreditCard').show();
        $('#divHomeCredit').hide();
    }
    else if ($('#ModeOfPayment').val() == "Home Credit") {
        $('#DivCash').hide();
        $('#divCreditCard').hide();
        $('#divHomeCredit').show();
    }
    else if ($('#ModeOfPayment').val() == "HomeCredit Credit Card") {
        $('#DivCash').hide();
        $('#divCreditCard').show();
        $('#divHomeCredit').show();
    }
    else if ($('#ModeOfPayment').val() == "Cash CreditCard") {
        $('#DivCash').show();
        $('#divCreditCard').show();
        $('#divHomeCredit').hide();
    }
    else if ($('#ModeOfPayment').val() == "Cash Home Credit") {
        $('#DivCash').show();
        $('#divCreditCard').hide();
        $('#divHomeCredit').show();
    }
    else if ($('#ModeOfPayment').val() == "Cash CreditCard Home Credit") {
        $('#DivCash').show();
        $('#divCreditCard').show();
        $('#divHomeCredit').show();
    }
    else {
        $('#DivCash').hide();
        $('#divCreditCard').hide();
        $('#divHomeCredit').hide();
    }

    $('#Cash').val("0.00");
    ClearCreditCard();
    ClearHomeCredit();
    updateAmountTendered();
}

function updateTotalSales() {
    var sTotalPrice = 0;
    var TotalPrice = document.getElementsByName('sTotal[]');
    for (i = 0; i < TotalPrice.length; i++) {
        sTotalPrice = parseFloat(sTotalPrice) + parseFloat(TotalPrice[i].value.replace(/,/g, ''));
    }

    lblTotalPrice.value = accounting.formatNumber(sTotalPrice, 2, ",", ".");
    ChangeOfCustomer();
    return lblTotalPrice.value;
}

function updateAmountTendered() {

    lblAmountTendered.value = accounting.formatNumber(parseFloat(sCash.value.replace(/,/g, '')) + parseFloat(sCreditCard.value.replace(/,/g, '')) + parseFloat(sHomeCredit.value.replace(/,/g, '')), 2, ",", ".");
    ChangeOfCustomer();
}

function ChangeOfCustomer() {
    var TotalAmountTendered = parseFloat(sCash.value.replace(/,/g, '')) + parseFloat(sCreditCard.value.replace(/,/g, '')) + parseFloat(sHomeCredit.value.replace(/,/g, ''));
    lblChange.value = accounting.formatNumber(parseFloat(TotalAmountTendered - parseFloat(lblTotalPrice.value.replace(/,/g, '')) || 0), 2, ",", ".");
}

function ClearCreditCard() {
    $('#CreditCard').val("0.00");
    $('#CardHolderName').val("");
    $('#CardNumber').val("");
    $('#MID').val("");
    $('#BatchNum').val("");
    $('#ApprCode').val("");
    $('#Terms').val("");
    $('#IDPresented').val("");
}

function ClearHomeCredit() {
    $('#HomeCredit').val("0.00");
    $('#ReferenceNo').val("");
}

function DeleteSales(r) {
    var i = r.parentNode.parentNode.rowIndex;

    var SRP = document.getElementsByName('sSRP[]');
    var QTY = document.getElementsByName('sQty[]');
    var Total = document.getElementsByName('sTotal[]');

    $("input").remove(SRP[i - 1], QTY[i - 1], Total[i - 1]);
    ItemsToOrder.deleteRow(i);
    imeisnArray.splice(i, 1);

    updateTotalSales();

}

function EditSales(r) {
    var i = r.parentNode.parentNode.rowIndex;
    i--;
    var SRP = document.getElementsByName('sSRP[]');
    var QTY = document.getElementsByName('sQty[]');
    var Total = document.getElementsByName('sTotal[]');

    alert(SRP[i].value);
    $('#uItemName').text(SRP[i].value);
    $('#EditItemModal').modal('show');
}

function CheckIfNoChange() {
    var TotalAmountTendered = parseFloat(sCash.value.replace(/,/g, '')) + parseFloat(sCreditCard.value.replace(/,/g, '')) + parseFloat(sHomeCredit.value.replace(/,/g, ''));
    var TotalAmountToPay = parseFloat(updateTotalSales().replace(/,/g, ''));
    var Change = TotalAmountTendered - TotalAmountToPay;
    var sChange = document.getElementById('Change').value;

    if(TotalAmountTendered == 0){
        $('#AmountTenderedModal').modal('show');
    }else{
        if(Change == 0){
            if(Change != sChange){
                $('#ErrorModal').modal('show');
            }else{
                $('#CheckItems').modal('show');
                $('#SubmitPayment').click(function() {
                    document.getElementById('frmSaleItem').submit();
                });
            }
        }else{
            $('#ChangeModal').modal('show');
        }
    }
}

function TransactionDetails(TransactionID, hash, rnd) {
    $.ajax({
        type: 'POST',
        url: 'php/function.php',
        data: {
            TransactionID: TransactionID,
            Hash: hash,
            rnd: rnd
        },
        success: function (data) {
            $('#TDetails').html(data);
            $('#TDetails').modal('show');
        }
    })
}

function ItemDetails(ItemCode, hash, rnd) {
    $.ajax({
        type: 'POST',
        url: 'php/function.php',
        data: {
            vItemCode: ItemCode,
            Hash: hash,
            rnd: rnd
        },
        success: function (data) {
            $('#ViewItemDetails').html(data);
            $('#ViewItemDetails').modal('show');
        }
    })
}