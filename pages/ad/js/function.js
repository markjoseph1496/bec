function addAccount(EmpID, hash, rnd){
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
function EmployeeDetails(EmpID,hash,rnd) {
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

function BranchDetails(BranchCode, hashBranchCode, Branchrnd) {
    $.ajax({
        type: 'POST',
        url: 'function/functions.php',
        data: {
            BranchCode: BranchCode,
            hashBranchCode: hashBranchCode,
            Branchrnd: Branchrnd
        },
        success: function (data) {
            $('#BranchUpdateModal').html(data);
            $('#BranchUpdateModal').modal('show');
        }
    })
}

function BrandDetails(BrandID) {
    $.ajax({
        type: 'POST',
        url: 'function/functions.php',
        data: 'BrandID=' + BrandID,
        success: function (data) {
            $('#BrandUpdateModal').html(data);
            $('#BrandUpdateModal').modal(show);
        }
    })
}

function BrandDelete(BrandID) {
    $.ajax({
        type: 'POST',
        url: 'function/admin-delete.php',
        data: 'BrandID=' +BrandID,
        success: function (data) {
            $('#BrandDeleteModal').html(data);
            $('#BrandDeleteModal').modal(show);
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

function AreaDetails(AreaID) {
    $.ajax({
        type: 'POST',
        url: 'function/functions.php',
        data: 'AreaID=' + AreaID,
        success: function (data) {
            $('#AreaUpdateModal').html(data);
            $('#AreaUpdateModal').modal(show);
        }
    })
}

function AreaDelete(AreaID) {
    $.ajax({
        type: "POST",
        url: 'function/admin-delete.php',
        data: 'AreaID=' + AreaID,
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
function EmployeeDelete(EmpID,hashEmpID,rnd) {
    $('#EmpID').val(EmpID);
    $('#hashEmpID').val(hashEmpID);
    $('#rnd').val(rnd);
}

function BranchDelete(BranchCode,hashBranchCode,Branchrnd) {
    $('#BranchCode').val(BranchCode);
    $('#hashBranchCode').val(hashBranchCode);
    $('#Branchrnd').val(Branchrnd);
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
    else if (Position == "OIC") {
        $('#DivArea').hide();
        $('#DivBranch').show();
        $('#DivBrand').hide();
    }
    else if (Position == "Cashier") {
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
    else if (Position == "Cashier") {
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