<?php

namespace erol;

Class ContainerAware {
	function __construct(){
		global $em, $logger;
		$this->logger = $logger;
		$this->em = $em; 
	}
}

?>