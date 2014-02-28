<?php


namespace entity;
use Doctrine\ORM\Mapping as ORM;
use object\Eventer;


/**
 * entity\EntityAttendee
 *
 * @ORM\Table(name="attendee", 
 * indexes={
 *  @ORM\Index(name="accid_fk", columns={"accid_fk"})},
 *  uniqueConstraints={@ORM\UniqueConstraint(
 *      name="name_surname_mail_idx",
 *      columns={"name", "surname", "mail"})})
 * @ORM\Entity(repositoryClass="repository\EntityAttendeeRepository")
 */
class EntityAttendee
{
    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $uid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=50, nullable=false)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=10, nullable=false)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=50, nullable=false)
     */
    private $mail;

    /**
     * @var boolean
     *
     * @ORM\Column(name="registered", type="boolean", nullable=false)
     */
    private $registered;

    /**
     * @var entityAccount
     *
     * @ORM\ManyToOne(targetEntity="EntityAccount")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="accid_fk", referencedColumnName="accid")
     * })
     */
    private $accidFk;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="EntityOccasion", mappedBy="attendeeFk")
     */
    private $occasionFk;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->occasionFk = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setUnRegistered();
    }


    /**
     * Get uid
     *
     * @return integer 
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return entityAttendee
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

    /**
     * Set surname
     *
     * @param string $surname
     * @return entityAttendee
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return entityAttendee
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return entityAttendee
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set acccidFk
     *
     * @param \entity\EntityAccount $accidFk
     * @return entityAttendee
     */
    public function setAccidFk(\entity\EntityAccount $accidFk = null)
    {
        $this->accidFk = $accidFk;

        return $this;
    }

    /**
     * Get acccidFk
     *
     * @return \entity\EntityAccount 
     */
    public function getAccidFk()
    {
        return $this->accidFk;
    }

    /**
     * Add occasionFk
     *
     * @param \entity\EntityOccasion $occasionFk
     * @return entityAttendee
     */
    public function addOccasionFk(\entity\EntityOccasion $occasionFk)
    {
        $this->occasionFk[] = $occasionFk;

        return $this;
    }

    /**
     * Remove occasionFk
     *
     * @param \entity\entityOccasion $occasionFk
     */
    public function removeOccasionFk(\entity\EntityOccasion $occasionFk)
    {
        $this->occasionFk->removeElement($occasionFk);
    }

    /**
     * Get occasionFk
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOccasionFk()
    {
        return $this->occasionFk;
    }

    public function setRegistered(){
        $this->registered = true;
    }


    public function setUnRegistered(){
        $this->registered = false;
    }

    public function getRegistered(){
        return $this->registered;
    }

    /**
     * hasOccasion occasionFk
     *
     * @param \Entity\EntityOccasion $occasionFk
     */
    public function hasOccasion(\entity\EntityOccasion $occasionFk){
        return $this->occasionFk->contains($occasionFk);
    }

    public function toJson(){
        return json_encode(
            array(
                'attendee_id' => $this->uid, 
                'name' => $this->name,
                'surname' => $this->surname,
                'tel' => $this->telephone,
                'mail' => $this->mail,
            )
        );
    }
}
