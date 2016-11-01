<?php 

include_once('classes.php');

interface Report{
	function hasRights(User $user);
	function generate();
}