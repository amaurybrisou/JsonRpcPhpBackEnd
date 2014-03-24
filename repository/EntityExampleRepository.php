<?php

namespace repository;

use Doctrine\ORM\EntityRepository;


class EntityExempleRepository extends EntityRepository {
	public function FunctionName($value='')
	{
		//access EntityManager like this 
		$em = $this->em;
	}
}