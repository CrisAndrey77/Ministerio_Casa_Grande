<?php

namespace JS\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JS\AppBundle\Traits\UploadImage;

/**
 * CategoriaPredica
 *
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="JS\AppBundle\Entity\CategoriaPredicaRepository")
 */
class CategoriaPredica
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
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string")
     */
    private $slug;

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
     *
     * @ORM\OneToMany(targetEntity="JS\AppBundle\Entity\Predica", mappedBy="categoriaPredica", cascade={"all"}, orphanRemoval=true)
     */
    protected $predicas;

    /**
     *
     * @ORM\OneToMany(targetEntity="JS\AppBundle\Entity\PredicaDevocional", mappedBy="categoriaPredica", cascade={"all"}, orphanRemoval=true)
     */
    protected $devocionales;

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
     * @return CategoriaPredica
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
     * @return CategoriaPredica
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
     * @return CategoriaPredica
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
     * @return CategoriaPredica
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
     * @return CategoriaPredica
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return CategoriaPredica
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return CategoriaPredica
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
