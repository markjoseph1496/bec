<?php 

include_once('classes.php');

class BrandCoordinatorReport implements Report{

	function hasRights(User $user){
		if($user->position != "Brand Coordinator"){
			return FALSE;
		}
		return TRUE;
	}

	function generate(){
		
	}
}