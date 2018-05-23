<?php
namespace Disjfa\MozaicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="unsplash_season_item")
 */
class UnsplashSeasonItem
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
     * @var int
     * @ORM\Column(name="seqnr", type="integer")
     */
    private $seqnr;

    /**
     * @var UnsplashPhoto
     * @ORM\ManyToOne(targetEntity="Disjfa\MozaicBundle\Entity\UnsplashPhoto")
     */
    private $unsplashPhoto;

    /**
     * @var UnsplashSeason
     * @ORM\ManyToOne(targetEntity="Disjfa\MozaicBundle\Entity\UnsplashSeason", inversedBy="items")
     */
    private $unsplashSeason;

    public function __construct(UnsplashSeason $unsplashSeason)
    {
        $this->seqnr = 50;
        $this->unsplashSeason = $unsplashSeason;
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
    public function getTitle(): string
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
     * @return int
     */
    public function getSeqnr(): int
    {
        return $this->seqnr;
    }

    /**
     * @param int $seqnr
     */
    public function setSeqnr(int $seqnr): void
    {
        $this->seqnr = $seqnr;
    }

    /**
     * @return UnsplashPhoto
     */
    public function getUnsplashPhoto()
    {
        return $this->unsplashPhoto;
    }

    /**
     * @param UnsplashPhoto $unsplashPhoto
     */
    public function setUnsplashPhoto(UnsplashPhoto $unsplashPhoto): void
    {
        $this->unsplashPhoto = $unsplashPhoto;
    }

    /**
     * @return UnsplashSeason
     */
    public function getUnsplashSeason(): UnsplashSeason
    {
        return $this->unsplashSeason;
    }
}