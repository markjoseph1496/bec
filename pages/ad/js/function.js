function BranchDetails(BranchCode) {
    $.ajax({
        type: 'POST',
        url: 'function/functions.php',
        data: 'dBranchCode=' + BranchCode,
        success: function (data) {
            $('#EditBranchModal').html(data);
            $('#EditBranchModal').modal('show');
        }
    })
}

function DeleteBranch(BranchCode) {
    $('#Yes').on('click', function() {
        $.ajax({
            type: 'POST',
            url: 'function/functions.php',
            data: 'DeleteBranchCode=' + BranchCode,
            success: function () {

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