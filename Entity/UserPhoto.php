<?php

namespace Disjfa\MozaicBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="UserPhotoRepository")
 * @ORM\Table(name="user_photos")
 */
class UserPhoto
{
    /**
     * @var string
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var UnsplashPhoto
     * @ORM\ManyToOne(targetEntity="Disjfa\MozaicBundle\Entity\UnsplashPhoto")
     */
    private $unsplashPhoto;

    /**
     * @var DateTime
     * @ORM\Column(name="date_started", type="datetime", nullable=false)
     */
    private $dateStarted;

    /**
     * @var string
     * @ORM\Column(name="user_id", type="string", nullable=true)
     */
    private $userId;

    /**
     * @var DateTime
     * @ORM\Column(name="date_finished", type="datetime", nullable=false)
     */
    private $dateFinished;

    public function __construct(UnsplashPhoto $unsplashPhoto, $userId = null, DateTime $dateStarted, DateTime $dateFinished)
    {
        $this->unsplashPhoto = $unsplashPhoto;
        $this->userId = $userId;
        $this->dateStarted = $dateStarted;
        $this->dateFinished = $dateFinished;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return UnsplashPhoto
     */
    public function getUnsplashPhoto()
    {
        return $this->unsplashPhoto;
    }

    /**
     * @return DateTime
     */
    public function getDateStarted()
    {
        return $this->dateStarted;
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return DateTime
     */
    public function getDateFinished()
    {
        return $this->dateFinished;
    }
}