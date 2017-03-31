<?php

namespace JS\AppBundle\Traits;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Created by PhpStorm.
 * User: Jose Segura
 * Date: 20/1/17
 * Time: 11:24 AM
 */
trait UploadImage
{

    // <editor-fold desc="Photo upload methods">

    /**
     * @var string
     * @ORM\Column(name="image", type="string", length=255)
     */
    protected $image = 'default.jpg';

    /**
     * @Assert\File(maxSize="6000000")
     */
    protected $file;

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

        $class = explode('\\', get_called_class());
        $count = count($class) - 1;

        return 'uploads/' . mb_strtolower($class[$count]);
    }

    public function setFile(UploadedFile $file = null)
    {
        $this->setUpdatedAt(new \DateTime());
        $this->file = $file;
        // check if we have an old image imagen
        if (isset($this->photoFileName)) {
            // store the old name to delete after the update
            $this->tempPath      = $this->photoFileName;
            $this->photoFileName = null;
        }
        else {
            $this->photoFileName = 'initial';
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
    public function preUploadEntityImage()
    {

        if (null !== $this->getFile()) {
            $filename    = sha1(uniqid(mt_rand(), true));
            $this->image = $filename . '.' . $this->getFile()->guessExtension();
        }

    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function uploadEntityImage()
    {

        if (null === $this->getFile()) {
            return;
        }

        $this->getFile()->move($this->getUploadRootDir(), $this->image);


        if (isset($this->tempPath) && $this->tempPath !== 'default.jpg') {
            @unlink($this->getUploadRootDir() . '/' . $this->tempPath);
            $this->tempPath = null;
        }

        $this->file = null;

    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUploadEntityImage()
    {
        if (
        $file = $this->getAbsolutePath()
        ) {
            if ($this->image) {
                if ($file != ($this->getUploadRootDir() . '/default.jpg')) {
                    @unlink($file);
                }
            }
        }
    }


    /**
     *
     * @return string
     */
    public function getImagePath()
    {
        return '/' . $this->getUploadDir() . '/' . $this->getImage();
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    // </editor-fold>
}