<?php

namespace JS\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JS\AppBundle\Traits\UploadImage;

/**
 * Autor
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="JS\AppBundle\Entity\AutorRepository")
 */
class Autor
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     *
     * @ORM\OneToMany(targetEntity="JS\AppBundle\Entity\Asidice", mappedBy="autor", cascade={"all"}, orphanRemoval=true)
     */
    protected $asiDicen;

    /**
     *
     * @ORM\OneToMany(targetEntity="JS\AppBundle\Entity\Predica", mappedBy="autor", cascade={"all"}, orphanRemoval=true)
     */
    protected $predicas;

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
     * Set nombre
     *
     * @param string $nombre
     * @return Autor
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set foto
     *
     * @param string $foto
     * @return Autor
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->predicas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->devocionales = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Autor
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
     * @return Autor
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

    /**
     * Add predicas
     *
     * @param \JS\AppBundle\Entity\Predica $predicas
     * @return Autor
     */
    public function addPredica(\JS\AppBundle\Entity\Predica $predicas)
    {
        $this->predicas[] = $predicas;

        return $this;
    }

    /**
     * Remove predicas
     *
     * @param \JS\AppBundle\Entity\Predica $predicas
     */
    public function removePredica(\JS\AppBundle\Entity\Predica $predicas)
    {
        $this->predicas->removeElement($predicas);
    }

    /**
     * Get predicas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPredicas()
    {
        return $this->predicas;
    }

    /**
     * Add devocionales
     *
     * @param \JS\AppBundle\Entity\PredicaDevocional $devocionales
     * @return Autor
     */
    public function addDevocionale(\JS\AppBundle\Entity\PredicaDevocional $devocionales)
    {
        $this->devocionales[] = $devocionales;

        return $this;
    }

    /**
     * Remove devocionales
     *
     * @param \JS\AppBundle\Entity\PredicaDevocional $devocionales
     */
    public function removeDevocionale(\JS\AppBundle\Entity\PredicaDevocional $devocionales)
    {
        $this->devocionales->removeElement($devocionales);
    }

    /**
     * Get devocionales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDevocionales()
    {
        return $this->devocionales;
    }

    public function __toString()
    {
        return $this->getId() ? $this->getNombre() : "Nuevo";
    }

    /**
     * Add asiDicen
     *
     * @param \JS\AppBundle\Entity\Asidice $asiDicen
     * @return Autor
     */
    public function addAsiDicen(\JS\AppBundle\Entity\Asidice $asiDicen)
    {
        $this->asiDicen[] = $asiDicen;

        return $this;
    }

    /**
     * Remove asiDicen
     *
     * @param \JS\AppBundle\Entity\Asidice $asiDicen
     */
    public function removeAsiDicen(\JS\AppBundle\Entity\Asidice $asiDicen)
    {
        $this->asiDicen->removeElement($asiDicen);
    }

    /**
     * Get asiDicen
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAsiDicen()
    {
        return $this->asiDicen;
    }
}
