function addItemToOrder(r) {
    var i = r.parentNode.parentNode.rowIndex;
    i--;

    var tItemCode = document.getElementsByName('tItemCode[]');
    var tQty = document.getElementsByName('tQty[]');
    var b = arrayItem.indexOf(tItemCode[i].value);
    if (b == -1) {
        if(tQty[i].value == 0){
            alert('Please enter quantity.');
        }
        else{
            var row = $('<tr>');
            var tModelName = document.getElementsByName('tModelName[]');
            var tColor = document.getElementsByName('tColor[]');
            var tBrand = document.getElementsByName('tBrand[]');
            var tCategory = document.getElementsByName('tCategory[]');
            var tType = document.getElementsByName('tType[]');
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

            $('<input type="hidden" name="oItemCode[]" value=' + tItemCode[i].value + '>').appendTo(row);
            $('<input type="hidden" name="oSRP[]" value=' + tSRP[i].value + '>').appendTo(row);
            $('<input type="hidden" name="oTotalPrice[]" value=' + tTotalPrice + '>').appendTo(row);

            row.appendTo('#ItemsToOrder');

            arrayItem.push(tItemCode[i].value);
            $('#AddItemModal').modal('hide');
            tQty[i].value = 0;
            updateTotal();
        }
    }
    else {
        $('#itemExists').modal('show');
    }

}

function updateTotal(){
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
    ordertable.rows[i + 1].cells[6].innerHTML = tTotalPrice;
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

    $("input").remove(oQty[i - 1], oItemCode[i - 1], oSRP[i - 1], oTotalPrice[i - 1]);
    arrayItem.splice(i, 1);
    ItemsToOrder.deleteRow(i);
    $('#DeleteNotif').show();
    $("#DeleteNotif").fadeTo(5000, 500).slideUp(500, function () {
        
    });
    updateTotal();
}

function PurchaseOrder(){
    if (arrayItem == 0) {
        $('#noItemModal').modal('show');
    }
    else {
        $('#CheckItems').modal('show');
    }
}

function PODetails(r){
    var i = r.parentNode.parentNode.rowIndex;
    i--;
    var PONumber = document.getElementsByName('PONumber[]');
    $.ajax({
        type: 'POST',
        url: 'php/function.php',
        data: 'PONumber=' + PONumber[i].value,
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
}

function CancelOrder(PONumber){
    $('#CheckDelete').modal('show');
    $('#Yes').on('click', function() {
        $.ajax({
            type: 'POST',
            url: 'php/function.php',
            data: 'dPONumber=' + PONumber,
            success: function () {
                window.location.replace("po.php");
            }
        })
    });
}

function logout() {
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        document.location = '../../index.php';
    }
    xhr.open('GET', '../../functions/logout.php', true);
    xhr.send();
}