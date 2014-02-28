<?php


namespace entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * EntityOccasion
 * @ORM\Table(name="occasion", 
 * uniqueConstraints={@ORM\UniqueConstraint(name="name_idx", columns={"name"})})
 * @ORM\Entity
 */
class EntityOccasion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="occasion_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $occasionId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255, nullable=false)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="venue", type="string", length=50, nullable=false)
     */
    private $venue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=false)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=false)
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=512, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="seats", type="integer", nullable=false)
     */
    private $seats;

    /**
     * @var integer
     *
     * @ORM\Column(name="seats_alloc", type="integer", nullable=false)
     */
    private $seatsAlloc;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="EntityAttendee", inversedBy="occasionFk")
     * @ORM\JoinTable(name="occasionxattendee",
     *   joinColumns={
     *     @ORM\JoinColumn(name="occasion_id_fk", referencedColumnName="occasion_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="attendee_id_fk", referencedColumnName="uid")
     *   }
     * )
     */
    private $attendeeFk;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attendeeFk = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setName($pName){
        $this->name = $pName;
    }

    public function getName(){
        return $this->name;
    }

    public function setSubject($pSubject){
        $this->subject = $pSubject;
    }

    /**
     * Get occasionId
     *
     * @return integer 
     */
    public function getOccasionId()
    {
        return $this->occasionId;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set venue
     *
     * @param string $venue
     * @return EntityOccasion
     */
    public function setVenue($venue)
    {
        $this->venue = $venue;

        return $this;
    }

    /**
     * Get venue
     *
     * @return string 
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return EntityOccasion
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return EntityOccasion
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return EntityOccasion
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set seats
     *
     * @param integer $seats
     * @return EntityOccasion
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;

        return $this;
    }

    /**
     * Get seats
     *
     * @return integer 
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * Set seatsAlloc
     *
     * @param integer $seatsAlloc
     * @return EntityOccasion
     */
    public function setSeatsAlloc($seatsAlloc)
    {
        $this->seatsAlloc = $seatsAlloc;

        return $this;
    }

    /**
     * Get seatsAlloc
     *
     * @return integer 
     */
    public function getSeatsAlloc()
    {
        return $this->seatsAlloc;
    }

    /**
     * Add attendeeFk
     *
     * @param \Entity\EntityAttendee $attendeeFk
     * @return EntityOccasion
     */
    public function addAttendeeFk(\Entity\EntityAttendee $attendeeFk)
    {
        $this->attendeeFk[] = $attendeeFk;

        return $this;
    }

    /**
     * Remove attendeeFk
     *
     * @param \Entity\EntityAttendee $attendeeFk
     */
    public function removeAttendeeFk(\Entity\EntityAttendee $attendeeFk)
    {
        $this->attendeeFk->removeElement($attendeeFk);
    }

    /**
     * Get attendeeFk
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAttendeeFk()
    {
        return $this->attendeeFk;
    }

    /**
     * hasAttendee attendeeFk
     *
     * @param \Entity\EntityAttendee $attendeeFk
     */
    public function hasAttendee(\Entity\EntityAttendee $attendeeFk){
        return $this->attendeeFk->contains($attendeeFk);
    }


    public function toJson(){
        $attendees = array();
        foreach ($this->attendeeFk as $value) {
            $attendees[] = $value->toJson();
        }
        return json_encode(
            array(
                'occasionId' => $this->occasionId, 
                'name' => $this->name,
                'venue' => $this->venue,
                'start_date' => $this->startDate,
                'end_date' => $this->endDate,
                'attendees' => json_encode($attendees)
            )
        );
    }
}
