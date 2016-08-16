<?php
if(isset($_POST['cboBranchCode'])){
    $BranchCode = $_POST['cboBranchCode'];
    $Picture = $_POST['idpicture'];
    $LastName = $_POST['txtLastName'];
    $FirstName = $_POST['txtFirstName'];
    $MiddleName = $_POST['txtMiddleName'];
    $Province = $_POST['cboProvince'];
    $City = $_POST['cboCity'];
    $Barangay  = $_POST['cboBarangay'];
    $Street = $_POST['txtStreet'];
    $Email = $_POST['txtEmail'];
    $MobileNumber = $_POST['txtMobileNo'];
    $CivilStatus = $_POST['cboStatus'];
    $Gender = $_POST['cboGender'];
    $Age = $_POST['txtAge'];
    $Spouse = $_POST['txtSpouse'];
    $Occupation = $_POST['txtOccupation'];
    $NumOfChildren = $_POST['txtNumOfChildren'];
    $ProvinceofSpouse = $_POST['txtProvinceofSpouse'];
    $Religion = $_POST['txtReligion'];
    $Birthdate = $_POST['txtBirthdate'];
    $BirthPlace = $_POST['txtBirthPlace'];
    $Father = $_POST['txtFather'];
    $FOccupation = $_POST['txtFOccupation'];
    $FAddress = $_POST['txtFAddress'];
    $FContactNumber = $_POST['txtFContactNumber'];
    $Mother = $_POST['txtMother'];
    $MAddress = $_POST['txtMAddress'];
    $MContactNumber = $_POST['txtMContactNumber'];


    GSecureSQL::query(
        "INSERT INTO tblemployeeinfo",
        FALSE,
        "sssssssssssissssssssssssss",
        $FirstName,
        $MiddleName,
        $LastName,
        $Province,
        $City,
        $Barangay,
        $Street,
        $Email,
        $MobileNumber,
        $CivilStatus,
        $Gender,
        $Age,
        $Spouse,
        $Occupation,
        $NumOfChildren,
        $ProvinceofSpouse,
        $Religion,
        $Birthdate,
        $BirthPlace,
        $Father,
        $
    );


}