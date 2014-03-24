<?php

namespace entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntityExample
 *
 * @ORM\Table(name="example")
 * @ORM\Entity(repositoryClass="repository\EntityExampleRepository")
 */

class EntityExample
{
    /**
     * @var integer
     *
     * @ORM\Column(name="example_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $example_id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;



    /**
     * Get example_id
     *
     * @return integer
     */
    public function getExampleId()
    {
        return $this->example_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return EntityExample
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    function __string(){
        return "EntityExample : <example_id : " . $this->example_id . 
            " name : " . $this->name . ">";
    }
}
