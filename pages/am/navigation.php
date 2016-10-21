<?php
include('../../connection.php');
include_once('../../functions/encryption.php');
session_start();
$hashEMPID = $_SESSION['hashEmpID'];
$EmpID = $_SESSION['EmpID'];
$rnd = $_SESSION['rnd'];

if (encrypt_decrypt_rnd('decrypt', $hashEMPID, $rnd) == $EmpID) {
    $checkAccount = db_select("
    SELECT 
    employeetbl.Firstname,
    employeetbl.Lastname,
    employeetbl.Position,
    employeetbl.Initials,
    areatbl.AreaID,
    areatbl.Area
    FROM employeetbl
    LEFT JOIN areatbl ON employeetbl.AreaID = areatbl.AreaID
    WHERE EmpID =" . db_quote($EmpID));

    if ($checkAccount === false) {
        session_destroy();
        header('location: ../../index.php?error');
    } else {
        if ($checkAccount[0]['Position'] != "Area Manager") {
            session_destroy();
            header('location: ../../index.php');
        } else {
            $FirstName = $checkAccount[0]['Firstname'];
            $LastName = $checkAccount[0]['Lastname'];
            $AreaID = $checkAccount[0]['AreaID'];
            $Area = $checkAccount[0]['Area'];
            $Initials = $checkAccount[0]['Initials'];
            $AccountType = $checkAccount[0]['Position'];
            $FullName = $FirstName . " " . $LastName;


            $getPurchaseRequestPending = db_select("SELECT * FROM `purchaserequeststbl` WHERE `Status` = 'Pending' AND `BranchCode` IN (SELECT `BranchCode` FROM `branchtbl` WHERE `AreaID` = " . db_quote($AreaID) . ")");
            $getPurchaseRequestApproved = db_select("SELECT * FROM `purchaserequeststbl` WHERE `Status` = 'Approved' OR `Status` = 'On Going' AND `isBCApproved` = '1' AND `BranchCode` IN (SELECT `BranchCode` FROM `branchtbl` WHERE `AreaID` = " . db_quote($AreaID) . ")");
        }
    }

} else {
    session_destroy();
    header('location: ../../index.php');
}
?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="" class="site_title"><span>Berlein Electronics</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="../../img/man-icon.png" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2><?= @ $FullName ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <br/>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3><?= @ $Area . " - " . $checkAccount[0]['Position'] ?></h3>
                <ul class="nav side-menu">
                    <li>
                        <a><i class="fa fa-bar-chart"></i> Sales Report</span></a>
                    </li>
                    <li>
                        <a href="st.php"><i class="fa fa-area-chart"></i> Sales Transactions</span></a>
                    </li>
                    <li>
                        <a><i class="fa fa-line-chart"></i> Staff Performance</span></a>
                    </li>
                    <li>
                        <a><i class="fa fa-credit-card"></i> Purchase Requests <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="po.php">Pending <span class="label label-danger pull-right"><?= @count($getPurchaseRequestPending); ?></span></a></li>
                            <li><a href="onprocess.php">On Process <span class="label label-danger pull-right"><?= @count($getPurchaseRequestApproved); ?></span></a></li>
                            <li><a href="reportpr.php">Reports</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                       aria-expanded="false">
                        <img src="../../img/man-icon.png" alt=""><?php echo $FullName ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="javascript:;"> Account Settings</a></li>
                        <li><a data-toggle="modal" data-target="#LogoutModal"><i class="fa fa-sign-out pull-right"></i> Log Out</a data></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->

<!-- Log out Modal -->
<div class="modal fade" id="LogoutModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-dark">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Log out</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to log out?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-dark" onclick="logout();">Log out</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->