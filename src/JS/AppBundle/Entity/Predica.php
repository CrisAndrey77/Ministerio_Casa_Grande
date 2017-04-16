<?php

namespace JS\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 *  Predica
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="JS\AppBundle\Entity\PredicaRepository")
 */
class Predica
{
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
     *
     * @ORM\ManyToOne(targetEntity="JS\AppBundle\Entity\CategoriaPredica", inversedBy="predicas")
     * @ORM\JoinColumn(name="categoriapredica_id", referencedColumnName="id", nullable=true)
     */
    protected $categoriaPredica;
    /**
     *
     * @ORM\ManyToOne(targetEntity="JS\AppBundle\Entity\Autor", inversedBy="predicas")
     * @ORM\JoinColumn(name="autor_id", referencedColumnName="id", nullable=true)
     */
    protected $autor;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

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
     * Set nombre
     *
     * @param string $nombre
     * @return Predica
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Predica
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Predica
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Predica
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
     * @return Predica
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
     * Set categoriaPredica
     *
     * @param \JS\AppBundle\Entity\CategoriaPredica $categoriaPredica
     * @return Predica
     */
    public function setCategoriaPredica(\JS\AppBundle\Entity\CategoriaPredica $categoriaPredica = null)
    {
        $this->categoriaPredica = $categoriaPredica;

        return $this;
    }

    /**
     * Get categoriaPredica
     *
     * @return \JS\AppBundle\Entity\CategoriaPredica 
     */
    public function getCategoriaPredica()
    {
        return $this->categoriaPredica;
    }

    /**
     * Set autor
     *
     * @param \JS\AppBundle\Entity\Autor $autor
     * @return Predica
     */
    public function setAutor(\JS\AppBundle\Entity\Autor $autor = null)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get autor
     *
     * @return \JS\AppBundle\Entity\Autor 
     */
    public function getAutor()
    {
        return $this->autor;
    }

    public function __construct()
    {
        $this->fecha  = new \DateTime('NOW');
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Predica
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
