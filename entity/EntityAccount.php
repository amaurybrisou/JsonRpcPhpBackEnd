<?php

namespace entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntityAccount
 *
 * @ORM\Table(name="account")
 * @ORM\Entity(repositoryClass="repository\EntityAccountRepository")
 */

class EntityAccount
{
    /**
     * @var integer
     *
     * @ORM\Column(name="accid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $accid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;



    /**
     * Get accid
     *
     * @return integer
     */
    public function getAccid()
    {
        return $this->accid;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return EntityAccount
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
}
