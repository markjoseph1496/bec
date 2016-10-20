<?php
include('../connection.php');
include('../functions/encryption.php');
session_start();

if (isset($_POST['Username'])) {

    $Username = db_quote($_POST['Username']);
    $Password = db_quote($_POST['Password']);

    $rnd = rand(0,9999);

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
                $_SESSION['rnd'] = $rnd;
                $_SESSION['hashEmpID'] = encrypt_decrypt_rnd('encrypt', $CheckAccount[0]['aEmpID'], $rnd);
                $_SESSION['EmpID'] = $CheckAccount[0]['aEmpID'];
                $data = array(
                    'Count' => 1,
                    'AccountType' => $CheckAccount[0]['Position']
                );
            } elseif ($CheckAccount[0]['Position'] == "OIC") {
                $_SESSION['rnd'] = $rnd;
                $_SESSION['hashEmpID'] = encrypt_decrypt_rnd('encrypt', $CheckAccount[0]['aEmpID'], $rnd);
                $_SESSION['EmpID'] = $CheckAccount[0]['aEmpID'];
                $data = array(
                    'Count' => 1,
                    'AccountType' => $CheckAccount[0]['Position']
                );
            } elseif ($CheckAccount[0]['Position'] == "Area Manager") {
                $_SESSION['rnd'] = $rnd;
                $_SESSION['hashEmpID'] = encrypt_decrypt_rnd('encrypt', $CheckAccount[0]['aEmpID'], $rnd);
                $_SESSION['EmpID'] = $CheckAccount[0]['aEmpID'];
                $data = array(
                    'Count' => 1,
                    'AccountType' => $CheckAccount[0]['Position']
                );
            } elseif ($CheckAccount[0]['Position'] == "Brand Coordinator") {
                $_SESSION['rnd'] = $rnd;
                $_SESSION['hashEmpID'] = encrypt_decrypt_rnd('encrypt', $CheckAccount[0]['aEmpID'], $rnd);
                $_SESSION['EmpID'] = $CheckAccount[0]['aEmpID'];
                $data = array(
                    'Count' => 1,
                    'AccountType' => $CheckAccount[0]['Position']
                );
            } elseif ($CheckAccount[0]['Position'] == "Cashier") {
                $_SESSION['rnd'] = $rnd;
                $_SESSION['hashEmpID'] = encrypt_decrypt_rnd('encrypt', $CheckAccount[0]['aEmpID'], $rnd);
                $_SESSION['EmpID'] = $CheckAccount[0]['aEmpID'];
                $data = array(
                    'Count' => 1,
                    'AccountType' => $CheckAccount[0]['Position']
                );
            }
            else{
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
