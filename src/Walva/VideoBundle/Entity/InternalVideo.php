<?php

namespace Walva\VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InternalVideo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Walva\VideoBundle\Entity\InternalVideoRepository")
 */
class InternalVideo extends AbstractVideo
{

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(
     *      targetEntity="Walva\VideoBundle\Entity\Source",
     *      cascade={"all"},
     *      mappedBy="video"
     *      )
     */
    private $sources;
    
    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return parent::getId();
    }

    /**
     * Set sources
     *
     * @param \stdClass $sources
     * @return InternalVideo
     */
    public function setSources($sources)
    {
        $this->sources = $sources;
    
        return $this;
    }

    /**
     * Get sources
     *
     * @return \stdClass 
     */
    public function getSources()
    {
        return $this->sources;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sources = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add sources
     *
     * @param \Walva\VideoBundle\Entity\Source $sources
     * @return InternalVideo
     */
    public function addSource(\Walva\VideoBundle\Entity\Source $sources)
    {
        $this->sources[] = $sources;
    
        return $this;
    }

    /**
     * Remove sources
     *
     * @param \Walva\VideoBundle\Entity\Source $sources
     */
    public function removeSource(\Walva\VideoBundle\Entity\Source $sources)
    {
        $this->sources->removeElement($sources);
    }
    
    
}