<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AudioSheet
 *
 * @ORM\Table(name="audio_sheet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AudioSheetRepository")
 */
class AudioSheet extends Sheet
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
     * @ORM\Column(name="duration", type="string", length=255)
     */
    protected $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="artist", type="string", length=255)
     */
    protected $artist;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="released", type="datetime")
     */
    protected $released;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=255)
     */
    protected $genre;

    /**
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param string $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
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
     * Set duration
     *
     * @param string $duration
     *
     * @return AudioSheet
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set artist
     *
     * @param string $artist
     *
     * @return AudioSheet
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set released
     *
     * @param \DateTime $released
     *
     * @return AudioSheet
     */
    public function setReleased($released)
    {
        $this->released = $released;

        return $this;
    }

    /**
     * Get released
     *
     * @return \DateTime
     */
    public function getReleased()
    {
        return $this->released;
    }


}

