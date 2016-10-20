function logout() {
    var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        document.location = '../../index.php';
    };
    xhr.open('GET', '../../functions/logout.php', true);
    xhr.send();
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

function RejectRequest(PRNumber) {
    var hashPRNumber = $('#hashPRNumber').val();
    $.ajax({
        type: 'POST',
        url: 'php/function.php',
        data: {
            rejectedPRNumber: PRNumber,
            hashPRNumber: hashPRNumber
        },
        success: function (data) {
            window.location.replace("pending.php?" + data);
        }
    })
}

function addItemsToModify() {
    var tItemCode = document.getElementsByName('aItemCode[]');
    for (var i = 0; i < tItemCode.length; i++) {
        var tQty = document.getElementsByName('aQty[]');
        var row = $('<tr>');
        var tModelName = document.getElementsByName('aModelName[]');
        var tBrand = document.getElementsByName('aBrand[]');
        var tCategory = document.getElementsByName('aCategory[]');
        var tSRP = document.getElementsByName('aSRP[]');

        var tTotalPrice = parseFloat(tSRP[i].value.replace(/,/g, "")) * parseFloat(tQty[i].value.replace(/,/g, ""));
        tTotalPrice = accounting.formatNumber(tTotalPrice, 2, ",", ".");

        $('<td>').text(tItemCode[i].value).appendTo(row);
        $('<td>').text(tModelName[i].value).appendTo(row);
        $('<td>').text(tBrand[i].value).appendTo(row);
        $('<td>').text(tSRP[i].value).appendTo(row);
        $('<td>').text(tQty[i].value).appendTo(row);
        $('<td>').text(tTotalPrice).appendTo(row);
        $('<td>' +
            '<select class="form-control" name="Remarks[]" required>' +
            '<option value="" selected="selected">- Select one -</option>' +
            '<option value="PO to SP" >PO to SP</option>' +
            '<option value="Ship to Branch" >Ship To Branch</option>' +
            '</select>'
        ).appendTo(row);

        $('<input type="hidden" name="oItemCode[]" value=' + tItemCode[i].value + '>').appendTo(row);
        $('<input type="hidden" name="oSRP[]" value=' + tSRP[i].value + '>').appendTo(row);
        $('<input type="hidden" name="oTotalPrice[]" value=' + tTotalPrice + '>').appendTo(row);

        row.appendTo('#ItemsToOrder');

        arrayItem.push(tItemCode[i].value);
        updateTotal();
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

function SubmitPurchaseRequest() {
    if (arrayItem == 0) {
        $('#noItemModal').modal('show');
    }
    else {
        $('#CheckItems').modal('show');
    }
}