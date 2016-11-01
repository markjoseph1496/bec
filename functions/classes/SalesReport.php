<?php

include_once('classes.php');

class SalesReport{
	// SO ano ba dapat ang mga bagay na papalabasin ko sa isang sales report?
	// Well, I think this class should act as place holder of things to be reported in a sales report.
	
	private $user;

	function __construct(User $user){
		$this->user = $user;
	}

	function generateReport(Report $report){
		if($report->hasRights($user)){
			return $report->generate(); // will return a json data
		}
	}
}


/*

Brand Coordinator of OPPO will ask for sales report

Gano ba kadami ang benta ng oppo brand sa:
Branch A
	Oppo A: 512 itmes sold
	Oppo B: 320 itmes sold
	Oppo C: 1213 itmes sold
	Oppo D: 992 itmes sold
Branch B
Branch C
Branch D
*/