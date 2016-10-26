function addAccount(EmpID, hash, rnd) {
    $.ajax({
        type: 'POST',
        url: 'function/functions.php',
        data: {
            addAccountEmpID: EmpID,
            hashEmpID: hash,
            rnd: rnd
        },
        success: function (data) {
            $('#AddAccount').html(data);
            $('#AddAccount').modal('show');
        }
    });
}

function logout() {
    var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        document.location = '../../index.php';
    };
    xhr.open('GET', '../../functions/logout.php', true);
    xhr.send();
}

function ItemsDetails(ItemCode, hashItemCode, Itemsrnd) {
    $.ajax({
        type: 'POST',
        url: 'function/functions.php',
        data: {
            ItemCode: ItemCode,
            hashItemCode: hashItemCode,
            Itemsrnd: Itemsrnd
        },
        success: function (data) {
            $('#ItemsUpdateModal').html(data);
            $('#ItemsUpdateModal').modal('show');
        }
    });
}

//Dito niya kukunin yung ipinasa galing kay update button tapos ipapasa niya sa functions.php yung tatlong data.
function EmployeeDetails(EmpID, hash, rnd) {
    $.ajax({
        type: 'POST',
        url: 'function/functions.php',
        data: {
            EmpID: EmpID,
            hashEmpID: hash,
            rnd: rnd
        },
        success: function (data) {
            $('#EmployeeUpdateModal').html(data);
            $('#EmployeeUpdateModal').modal('show');
        }
    });
}

function BranchDetails(BranchID, hashBranchID, Branchrnd) {
    $.ajax({
        type: 'POST',
        url: 'function/functions.php',
        data: {
            BranchID: BranchID,
            hash: hashBranchID,
            rand: Branchrnd
        },
        success: function (data) {
            $('#BranchUpdateModal').html(data);
            $('#BranchUpdateModal').modal('show');
        }
    })
}

function BranchDelete(BranchID, hash, rnd) {
    $.ajax({
        type: "POST",
        url: 'function/admin-delete.php',
        data: {
            dBranch: BranchID,
            dhash: hash,
            drnd: rnd
        },
        success: function (data) {
            $('#BranchDeleteModal').html(data);
            $('#BranchDeleteModal').modal('show');
        }
    })
}

function BrandDetails(BrandID, hash, rnd) {
    $.ajax({
        type: 'POST',
        url: 'function/functions.php',
        data: {
            BrandID: BrandID,
            hash: hash,
            rnd: rnd
        },
        success: function (data) {
            $('#BrandUpdateModal').html(data);
            $('#BrandUpdateModal').modal('show');
        }
    })
}

function BrandDelete(BrandID, hash, rnd) {
    $.ajax({
        type: 'POST',
        url: 'function/admin-delete.php',
        data: {
            dBrandID: BrandID,
            dhash: hash,
            drnd: rnd
        },
        success: function (data) {
            $('#BrandDeleteModal').html(data);
            $('#BrandDeleteModal').modal('show');
        }
    })
}

function ColorDetails(ColorID) {
    $.ajax({
        type: 'POST',
        url: 'function/functions.php',
        data: 'ColorID=' + ColorID,
        success: function (data) {
            $('#ColorUpdateModal').html(data);
            $('#ColorUpdateModal').modal(show);
        }
    })
}

function ColorDelete(ColorID) {
    $.ajax({
        type: 'POST',
        url: 'function/admin-delete.php',
        data: 'ColorID=' + ColorID,
        success: function (data) {
            $('#ColorDeleteModal').html(data);
            $('#ColorDeleteModal').modal(show);
        }
    })
}

function AreaDetails(AreaID, hash, rnd) {
    $.ajax({
        type: 'POST',
        url: 'function/functions.php',
        data: {
            AreaID: AreaID,
            hash: hash,
            rnd: rnd
        },
        success: function (data) {
            $('#AreaUpdateModal').html(data);
            $('#AreaUpdateModal').modal(show);
        }
    })
}

function AreaDelete(AreaID, hash, rnd) {
    $.ajax({
        type: "POST",
        url: 'function/admin-delete.php',
        data: {
            dAreaID: AreaID,
            dhash: hash,
            drnd: rnd
        },
        success: function (data) {
            $('#AreaDeleteModal').html(data);
            $('#AreaDeleteModal').modal(show);
        }
    })
}

function CategoryDetails(CategoryID) {
    $.ajax({
        type: 'POST',
        url: 'function/functions.php',
        data: 'CategoryID=' + CategoryID,
        success: function (data) {
            $('#CategoryUpdateModal').html(data);
            $('#CategoryUpdateModal').modal(show);
        }
    })
}

function CategoryDelete(CategoryID) {
    $.ajax({
        type: 'POST',
        url: 'function/admin-delete.php',
        data: 'CategoryID=' + CategoryID,
        success: function (data) {
            $('#CategoryDeleteModal').html(data);
            $('#CategoryDeleteModal').modal(show);
        }
    })
}
// Dito niya yun ipapasa yung Button Delete Iseset niya yung data sa input papunta kay employee.php dun sa DeleteModal
function EmployeeDelete(EmpID, hashEmpID, rnd) {
    $('#EmpID').val(EmpID);
    $('#hashEmpID').val(hashEmpID);
    $('#rnd').val(rnd);
}

function DeleteAccount(EmpID, hashEmpID, rnd) {
    $.ajax({
        type: 'POST',
        url: 'function/admin-delete.php',
        data: {
            dEmpID: EmpID,
            dhashEmpID: hashEmpID,
            drnd: rnd
        },
        success: function (data) {
            if (data == "True") {
                window.location.href = "employee.php?deleted";
            } else {
                window.location.href = "employee.php?deleted?error";
            }
        }

    })
}

function ItemsDelete(ItemCode, hashItemCode, Itemsrnd) {
    $('#ItemCode').val(ItemCode);
    $('#hashItemCode').val(hashItemCode);
    $('#Itemsrnd').val(Itemsrnd);
}

function BranchAndArea(Position) {
    if (Position == "Brand Coordinator") {
        $('#DivArea').hide();
        $('#DivBranch').hide();
        $('#DivBrand').show();
    }
    else if (Position == "Auditor") {
        $('#DivArea').hide();
        $('#DivBranch').hide();
        $('#DivBrand').hide();
    }
    else if (Position == "Area Manager") {
        $('#DivArea').show();
        $('#DivBranch').hide();
        $('#DivBrand').hide();
    }
    else if (Position == "OIC" || Position == "Cashier" || Position == "Sales Clerk") {
        $('#DivArea').hide();
        $('#DivBranch').show();
        $('#DivBrand').hide();
    }
    else {
        $('#DivArea').hide();
        $('#DivBranch').hide();
        $('#DivBrand').hide();
    }
}

function BranchAndAreaModal(Position) {
    if (Position == "Brand Coordinator") {
        $('#DivAreaModal').hide();
        $('#DivBranchModal').hide();
        $('#DivBrandModal').show();
    }
    else if (Position == "Auditor") {
        $('#DivAreaModal').hide();
        $('#DivBranchModal').hide();
        $('#DivBrandModal').hide();
    }
    else if (Position == "Area Manager") {
        $('#DivAreaModal').show();
        $('#DivBranchModal').hide();
        $('#DivBrandModal').hide();
    }
    else if (Position == "OIC") {
        $('#DivAreaModal').hide();
        $('#DivBranchModal').show();
        $('#DivBrandModal').hide();
    }
    else if (Position == "OIC" || Position == "Cashier" || Position == "Sales Clerk") {
        $('#DivAreaModal').hide();
        $('#DivBranchModal').show();
        $('#DivBrandModal').hide();
    }
    else {
        $('#DivAreaModal').hide();
        $('#DivBranchModal').hide();
        $('#DivBrandModal').hide();
    }
}

function UpdateConvertToMoney() {
    if ($('#EditSRP').length == 0) {
        EditSRP.value = "0.00";
    }
    if ($('#EditDP').length == 0) {
        EditDP.value = "0.00";
    }

    $('#EditSRP').val(accounting.formatNumber($('#EditSRP').val(), 2, ",", "."));
    $("#EditDP").val(accounting.formatNumber($('#EditDP').val(), 2, ",", "."));
}

function NumberConvertToMoney() {
    if ($('#SRP').length == 0) {
        SRP.value = "0.00";
    }
    if ($('#DP').length == 0) {
        DP.value = "0.00";
    }

    $('#SRP').val(accounting.formatNumber($('#SRP').val(), 2, ",", "."));
    $('#DP').val(accounting.formatNumber($('#DP').val(), 2, ",", "."));
}
