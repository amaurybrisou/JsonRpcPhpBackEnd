<?php

namespace Erol;

Class ContainerAware {
	function __construct(){
		global $em, $logger;
		$this->logger = $logger;
		$this->em = $em; 
	}
}

?>