<?php

namespace JS\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Asidice
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="JS\AppBundle\Entity\AsidiceRepository")
 */
class Asidice
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
     * @ORM\Column(name="descripcionBreve", type="text")
     */
    private $descripcionBreve;


    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     *
     * @ORM\ManyToOne(targetEntity="JS\AppBundle\Entity\Autor", inversedBy="asiDicen")
     * @ORM\JoinColumn(name="autor_id", referencedColumnName="id", nullable=true)
     */
    protected $autor;

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
     * @return Asidice
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
     * @return Asidice
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
     * @return Asidice
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
     * Set autor
     *
     * @param \JS\AppBundle\Entity\Autor $autor
     * @return Asidice
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

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Asidice
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
     * @return Asidice
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
     * Set descripcionBreve
     *
     * @param string $descripcionBreve
     * @return Asidice
     */
    public function setDescripcionBreve($descripcionBreve)
    {
        $this->descripcionBreve = $descripcionBreve;

        return $this;
    }

    /**
     * Get descripcionBreve
     *
     * @return string 
     */
    public function getDescripcionBreve()
    {
        return $this->descripcionBreve;
    }
}
