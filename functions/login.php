<?php
include('../connection.php');
session_start();

if (isset($_POST['Username'])) {

    $Username = db_quote($_POST['Username']);
    $Password = db_quote($_POST['Password']);

    $CheckAccount = db_select("
            SELECT 
            accountstbl.aUsername,
            accountstbl.aPassword,
            accountstbl.aSaltedPassword,
            accountstbl.aEmpID,
            employeetbl.Position
            FROM accountstbl
            INNER JOIN employeetbl ON accountstbl.aEmpID = employeetbl.EmpID
            WHERE aUsername = " . $Username);

    if (count($CheckAccount)) {
        if (hash('sha512', $Password . $CheckAccount[0]['aSaltedPassword']) == $CheckAccount[0]['aPassword']) {
            if ($CheckAccount[0]['Position'] == "Admin") {
                $_SESSION['EmpID'] = $CheckAccount[0]['aEmpID'];
                $data = array(
                    'Count' => 1,
                    'AccountType' => "Admin"
                );
            } elseif ($CheckAccount[0]['Position'] == "Cashier") {
                $_SESSION['EmpID'] = $CheckAccount[0]['aEmpID'];
                $data = array(
                    'Count' => 1,
                    'AccountType' => "Cashier"
                );
            } elseif ($CheckAccount[0]['Position'] == "Area Manager") {
                $_SESSION['EmpID'] = $CheckAccount[0]['aEmpID'];
                $data = array(
                    'Count' => 1,
                    'AccountType' => "Area Manager"
                );
            } else{
                $data = array(
                    'Count' => 0,
                    'AccountType' => "None"
                );
            }
        } else {
            $data = array(
                'Count' => 0,
                'AccountType' => "None"
            );
        }
    } else {
        $data = array(
            'Count' => 0,
            'AccountType' => "None"
        );
    }
    echo json_encode($data);
}
