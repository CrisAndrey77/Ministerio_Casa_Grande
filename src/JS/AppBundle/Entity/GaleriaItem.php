<?php

namespace JS\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JS\AppBundle\Traits\UploadImage;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * GaleriaItem
 * @ORM\HasLifecycleCallbacks()

 * @ORM\Table()
 * @ORM\Entity(repositoryClass="JS\AppBundle\Entity\GaleriaItemRepository")
 */
class GaleriaItem
{

    use UploadImage;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255, nullable=true)
     */
    private $video;

    /**
     * @var integer
     *
     * @ORM\Column(name="posicion", type="integer")
     */
    private $posicion;

    /**
     *
     * @ORM\ManyToOne(targetEntity="JS\AppBundle\Entity\Galeria", inversedBy="items")
     * @ORM\JoinColumn(name="galeria_id", referencedColumnName="id", nullable=true)
     */
    protected $galeria;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", name="updated_at")
     */
    protected $updatedAt;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return GaleriaItem
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set video
     *
     * @param string $video
     * @return GaleriaItem
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return string 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set posicion
     *
     * @param integer $posicion
     * @return GaleriaItem
     */
    public function setPosicion($posicion)
    {
        $this->posicion = $posicion;

        return $this;
    }

    /**
     * Get posicion
     *
     * @return integer 
     */
    public function getPosicion()
    {
        return $this->posicion;
    }

    /**
     * Set galeria
     *
     * @param \JS\AppBundle\Entity\Galeria $galeria
     * @return GaleriaItem
     */
    public function setGaleria(\JS\AppBundle\Entity\Galeria $galeria = null)
    {
        $this->galeria = $galeria;

        return $this;
    }

    /**
     * Get galeria
     *
     * @return \JS\AppBundle\Entity\Galeria 
     */
    public function getGaleria()
    {
        return $this->galeria;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return GaleriaItem
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return GaleriaItem
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
