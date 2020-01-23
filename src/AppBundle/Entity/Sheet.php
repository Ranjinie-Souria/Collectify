<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sheet
 *
 * @ORM\Table(name="sheet")
 * @ORM\Entity
 * @ORM\MappedSuperclass
 */
class Sheet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255)
     */
    protected $img;

    protected $released;

    protected $newImg;
    /**
     * @ORM\Column(name="idcategory", type="integer")
     */
    protected $idcategory;

    /**
     * @return mixed
     */
    public function getReleased()
    {
        return $this->released;
    }

    /**
     * @param mixed $released
     */
    public function setReleased($released)
    {
        $this->released = $released;
    }

    /**
     * @return mixed
     */
    public function getIdcategory()
    {
        return $this->idcategory;
    }

    /**
     * @param mixed $idcategory
     *
     */
    public function setIdcategory($idcategory)
    {
        $this->idcategory = $idcategory;
    }



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Sheet
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set img
     */
    public function setImg($image)
    {
        $img = $_SERVER['DOCUMENT_ROOT'] . '/php/img/' . $this->name . '.png';
        move_uploaded_file($image, $img);
        $this->img = $this->name . '.png';

    }

    /**
     * Get img
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set newImg
     *
     * @param string $newImg
     *
     * @return Sheet
     */
    public function setNewImg($newImg)
    {
        $this->setImg($newImg);

        return $this;
    }

    /**
     * Get newImg
     *
     * @return string
     */
    public function getNewImg()
    {
        return $this->newImg;
    }
}

