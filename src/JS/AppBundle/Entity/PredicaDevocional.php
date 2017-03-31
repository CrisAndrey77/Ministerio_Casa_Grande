<?php

namespace JS\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PredicaDevocional
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="JS\AppBundle\Entity\PredicaDevocionalRepository")
 */
class PredicaDevocional
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
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInicio", type="datetime")
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFinal", type="datetime")
     */
    private $fechaFinal;

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
     * @ORM\ManyToOne(targetEntity="JS\AppBundle\Entity\CategoriaPredica", inversedBy="devocionales")
     * @ORM\JoinColumn(name="categoriapredica_id", referencedColumnName="id", nullable=true)
     */
    protected $categoriaPredica;

    /**
     *
     * @ORM\ManyToOne(targetEntity="JS\AppBundle\Entity\Autor", inversedBy="devocionales")
     * @ORM\JoinColumn(name="autor_id", referencedColumnName="id", nullable=true)
     */
    protected $autor;

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
     * @return PredicaDevocional
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
     * @return PredicaDevocional
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
     * Set categoriapredicaId
     *
     * @param integer $categoriapredicaId
     * @return PredicaDevocional
     */
    public function setCategoriapredicaId($categoriapredicaId)
    {
        $this->categoriapredicaId = $categoriapredicaId;

        return $this;
    }

    /**
     * Get categoriapredicaId
     *
     * @return integer 
     */
    public function getCategoriapredicaId()
    {
        return $this->categoriapredicaId;
    }

    /**
     * Set autorId
     *
     * @param integer $autorId
     * @return PredicaDevocional
     */
    public function setAutorId($autorId)
    {
        $this->autorId = $autorId;

        return $this;
    }

    /**
     * Get autorId
     *
     * @return integer 
     */
    public function getAutorId()
    {
        return $this->autorId;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return PredicaDevocional
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFinal
     *
     * @param \DateTime $fechaFinal
     * @return PredicaDevocional
     */
    public function setFechaFinal($fechaFinal)
    {
        $this->fechaFinal = $fechaFinal;

        return $this;
    }

    /**
     * Get fechaFinal
     *
     * @return \DateTime 
     */
    public function getFechaFinal()
    {
        return $this->fechaFinal;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return PredicaDevocional
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
     * @return PredicaDevocional
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
     * @return PredicaDevocional
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
     * @return PredicaDevocional
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
}
