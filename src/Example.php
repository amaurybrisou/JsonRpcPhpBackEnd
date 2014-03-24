<?php

namespace src;
use Doctrine\DBAL\DBALException,
	src\Arguments,
	src\ExampleException,
	Erol\ContainerAware,
	entity\EntityExample;

class Example extends ContainerAware {

	function my_echo($params){
		return $params;
	}

	function AddExample($params)
	{
		Arguments::check($params);
		$exemple = new EntityExample();
		$exemple->setName($params['name']);

		try {
			$this->em->persist($exemple);
			$this->em->flush();

		} catch(DBALException $e){
			throw ExampleException::raise($e->getCode());
		}

		return array("example_id" => $exemple->getExampleId());
	}
	
}
