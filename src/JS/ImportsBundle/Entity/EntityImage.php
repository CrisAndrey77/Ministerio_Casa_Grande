<?php

namespace JS\ImportsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * 
 * Rasgo para la inclusion de una imagen a una entidad. Esto permite evitar la 
 * replicacion del mismo codigo siempre que se necesite agregar una única imagen.
 * 
 * IMPORTANTE: No sobreescribir las variables o funciones declaradas en este TRAIT,
 * ya que se generan errores ya que no funciona igual que un extends tiene un comportamiento
 * similar. Lo mensiono porque Doctrine Tiende a replicar las funciones y 
 * variables mapeados en la entidad que utiliza el trait. Esto quiere decir
 * que si se utilizar el comando console doctrine:generate:entities LumenXXXXBundle
 * la variable image y todas las funciones que tengan "@ORM/XXXX", seran mapeadas
 * a la clase que importe el trait y esto genera errores por replicacion de variables
 * y las funciones declaradas en el trait no se llamen en tiempo de ejecución.
 *
 * @author leonardo
 */

trait EntityImage
{

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $image;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * ORM\Column(type="string", length=255, nullable=true)
     */
//    public $path;
    
    private $tempPath;

    public function getAbsolutePath()
    {
        return null === $this->image ? null : $this->getUploadRootDir() . '/' . $this->image;
    }

    public function getWebPath()
    {
        return null === $this->image ? null : $this->getUploadDir() . '/' . $this->image;
    }

    public function getUploadRootDir()
    {
        // the absolute directory imagen where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    public function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/' . IMAGE_PATH;
    }

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image imagen
        if (isset($this->image))
        {
            // store the old name to delete after the update
            $this->tempPath = $this->image;
            $this->image = null;
        } else
        {
            $this->image = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    final public function preUploadEntityImage()
    {
        if (null !== $this->getFile())
        {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->image = $filename . '.' . $this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    final public function uploadEntityImage()
    {
        if (null === $this->getFile())
        {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->image);

        // check if we have an old image
        if (isset($this->tempPath))
        {
            // delete the old image
            @unlink($this->getUploadRootDir() . '/' . $this->tempPath);
            // clear the temp image imagen
            $this->tempPath = null;
        }

        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    final public function removeUploadEntityImage()
    {
        if ($file = $this->getAbsolutePath())
        {
            if ($this->image)
            {
                unlink($file);
            }
        }
    }

    public $fotoUrl;

    public function getFotoUrl()
    {
        return $this->fotoUrl;
    }

    public function getPictureName()
    {
        return $this->image;
    }

//    public function setPath($path)
//    {
//        $this->path = $path;
//
//        return $this;
//    }
//
//    public function getPath()
//    {
//        return $this->path;
//    }

}
