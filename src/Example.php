<?php

namespace src;
use Doctrine\DBAL\DBALException,
	Erol\Arguments,
	Erol\JsonRpcException,
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
			throw JsonRpcException::raise($e/** , optional message **/);
		}

		return array("example_id" => $exemple->getExampleId());
	}
	
}
