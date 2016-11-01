<?php 

include('classes.php');

class User{
	public $empid;
	public $firstname;
	public $middlename;
	public $lastname;
	public $initials;
	public $position;
	public $picture;
	public $branchid;
	public $areaid;
	public $brandid;

	/**
	 * Description:
	 * 	Note to developers:
	 * 	  - If you make some changes in the employeetbl, this class should also change!
	 * __construct(String $empid)
	 * $empid = Employee ID
	 *   Creates instance of a user by filling all user information in the field above.
	 */
	public function __construct($empid){
		$employee = GSecureSQL::query("
			SELECT
				*
			FROM `employeetbl`
			WHERE
				`employeetbl`.`EmpID` = ?
		", TRUE, 's', $empid);
		if(!count($employee)){
			return;
		}
		$employee = $employee[0];
		$this->empid = $employee[1];
		$this->firstname = $employee[2];
		$this->middlename = $employee[3];
		$this->lastname = $employee[4];
		$this->initials = $employee[5];
		$this->position = $employee[6];
		$this->picture = $employee[7];
		$this->branchid = $employee[8];
		$this->areaid = $employee[9];
		$this->brandid = $employee[10];
	}
}