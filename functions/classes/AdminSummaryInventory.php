<?php 

include_once('classes.php');

class AdminSummaryInventory{

	private $user;
	private $has_access;
	public $branch;
	public $brand;

	function __construct(User $user){
		$this->user = $user;
		if($this->user->position == Position::$ADMIN){
			$this->has_access = TRUE;
		}else{
			$this->has_access = FALSE;
			return;
		}

		$this->getBranches();
	}

	function hasAccess(){
		return $has_access;
	}

	function getBrands($branch){
		$brands = new BrandTbl();
		$this->brand = $brands->initialize($branch);
	}

	function getBranchCount(){
		return count($this->branch);
	}

	private function getBranches(){
		$branches = new BranchTbl();
		$this->branch = $branches->initialize();
	}


}