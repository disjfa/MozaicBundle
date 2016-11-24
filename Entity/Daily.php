<?php
namespace Disjfa\MozaicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="DailyRepository")
 * @ORM\Table(name="mozaic_daily")
 */
class Daily
{
    /**
     * @var UnsplashPhoto
     * @ORM\ManyToOne(targetEntity="Disjfa\MozaicBundle\Entity\UnsplashPhoto")
     */
    private $unsplashPhoto;

    /**
     * @ORM\Id
     * @ORM\Column(name="date_daily", type="string", nullable=false)
     */
    private $dateDaily;

    public function __construct(UnsplashPhoto $unsplashPhoto, DailyDateTime $dateDaily)
    {
        $this->unsplashPhoto = $unsplashPhoto;
        $this->dateDaily = (string) $dateDaily;
    }

    /**
     * @return UnsplashPhoto
     */
    public function getUnsplashPhoto()
    {
        return $this->unsplashPhoto;
    }

}