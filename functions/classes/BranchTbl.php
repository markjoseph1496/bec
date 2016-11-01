<?php 

include_once('classes.php');

class BranchTbl{
	public $_count;
	public $BranchID;
	public $BranchCode;
	public $BranchName;
	public $BrandID;
	public $AreaID;

	public function initialize(){
		$rows = GSecureSQL::query("
			SELECT * FROM `branchtbl`
		", TRUE);

		$ret = array();

		foreach($rows as $key => $row){
			array_push($ret, new BranchTbl());
			$ret[$key]->_count = $row[0];
			$ret[$key]->BranchID = $row[1];
			$ret[$key]->BranchCode = $row[2];
			$ret[$key]->BranchName = $row[3];
			$ret[$key]->BrandID = $row[4];
			$ret[$key]->AreaID = $row[5];
		}

		return $ret;
	}
}