<?php
namespace Disjfa\MozaicBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="UnsplashSeasonRepository")
 * @ORM\Table(name="unsplash_season")
 */
class UnsplashSeason
{
    /**
     * @var string
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var DateTime
     * @ORM\Column(name="date_season", type="datetime")
     */
    private $dateSeason;

    /**
     * @var bool
     * @ORM\Column(name="public", type="boolean")
     */
    private $public;

    /**
     * @var UnsplashSeasonItem[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Disjfa\MozaicBundle\Entity\UnsplashSeasonItem", mappedBy="unsplashSeason")
     */
    private $items;

    public function __construct()
    {
        $this->dateSeason = new DateTime();
        $this->public = false;
        $this->title = '';
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return DateTime
     */
    public function getDateSeason(): DateTime
    {
        return $this->dateSeason;
    }

    /**
     * @param DateTime $dateSeason
     */
    public function setDateSeason(DateTime $dateSeason): void
    {
        $this->dateSeason = $dateSeason;
    }

    /**
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->public;
    }

    /**
     * @param bool $public
     */
    public function setPublic(bool $public): void
    {
        $this->public = $public;
    }

    /**
     * @return UnsplashSeasonItem[]|ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }
}