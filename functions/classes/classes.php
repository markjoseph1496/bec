<?php 

if(!defined('HELPER_PHP')){
	include_once('helper.php');
}

if(!class_exists('GSecureSqlConfig')){
	include_once('GSecureSQLConfig.php');
}

if(!class_exists('GSecureSQL')){
	include_once('GSecureSQL.php');
}

if(!class_exists('SalesReport')){
	include_once('SalesReport.php');
}

if(!class_exists('User')){
	include_once('User.php');
}

if(!interface_exists('Report')){
	include_once('Report.php');
}

if(!class_exists('BrandCoordinatorReport')){
	include_once('BrandCoordinatorReport.php');
}

if(!class_exists('Authentication')){
	include_once('Authentication.php');
}

if(!class_exists('AdminSummaryInventory')){
	include_once('AdminSummaryInventory.php');
}

if(!class_exists('Position')){
	include_once('Position.php');
}

if(!class_exists('BranchTbl')){
	include_once('BranchTbl.php');
}

if(!class_exists('BrandTbl')){
	include_once('BrandTbl.php');
}