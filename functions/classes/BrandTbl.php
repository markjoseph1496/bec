<?php 

include_once('classes.php');

class BrandTbl{

	public $_count;
	public $BrandID;
	public $BrandCode;
	public $Brand;

	public function initialize($branchid){
		if($branchid == "All"){
			return $this->getAll();
		}
		return $this->getSpecific($branchid);
	}

	private function getAll(){
		$rows = GSecureSQL::query("
			SELECT * FROM `brandtbl`
		", TRUE);

		$ret = array();

		foreach($rows as $key => $row){
			array_push($ret, new BrandTbl());
			$ret[$key]->_count = $row[0];
			$ret[$key]->BrandID = $row[1];
			$ret[$key]->BrandCode = $row[2];
			$ret[$key]->Brand = $row[3];
		}

		return $ret;
	}

	private function getSpecific($branchid){
		$rows = GSecureSQL::query("
			SELECT * FROM `brandtbl` WHERE `brandtbl`.`BrandID` = ?
		", TRUE, "s", $branchid);

		$ret = array();

		foreach($rows as $key => $row){
			array_push($ret, new BrandTbl());
			$ret[$key]->_count = $row[0];
			$ret[$key]->BrandID = $row[1];
			$ret[$key]->BrandCode = $row[2];
			$ret[$key]->Brand = $row[3];
		}

		return $ret;
	}
}