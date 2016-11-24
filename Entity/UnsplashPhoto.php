<?php
namespace Disjfa\MozaicBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="UnsplashPhotoRepository")
 * @ORM\Table(name="unsplash_images")
 */
class UnsplashPhoto
{
    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="unsplash_id", type="string", nullable=false, unique=true)
     */
    private $unsplashId;

    /**
     * @var DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var int
     * @ORM\Column(name="width", type="integer", nullable=false)
     */
    private $width;

    /**
     * @var int
     * @ORM\Column(name="height", type="integer", nullable=false)
     */
    private $height;

    /**
     * @var string
     * @ORM\Column(name="color", type="string", nullable=false)
     */
    private $color;

    /**
     * @var int
     * @ORM\Column(name="likes", type="integer")
     */
    private $likes;

    /**
     * @var string
     * @ORM\Column(name="url_raw", type="string")
     */
    private $urlRaw;

    /**
     * @var string
     * @ORM\Column(name="url_regular", type="string")
     */
    private $urlRegular;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", nullable=true)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="city", type="string", nullable=true)
     */
    private $city;

    /**
     * @var string
     * @ORM\Column(name="country", type="string", nullable=true)
     */
    private $country;

    /**
     * @var float
     * @ORM\Column(name="latitude", type="float", nullable=true)
     */
    private $latitude;

    /**
     * @var float
     * @ORM\Column(name="longitude", type="float", nullable=true)
     */
    private $longitude;

    /**
     * @var string
     * @ORM\Column(name="link_html", type="string")
     */
    private $linkHtml;

    /**
     * @var UnsplashUser
     * @ORM\ManyToOne(targetEntity="Disjfa\MozaicBundle\Entity\UnsplashUser")
     */
    private $unsplashUser;

    /**
     * UnsplashPhoto constructor.
     * @param UnsplashUser $unsplashUser
     * @param string $unsplashId
     * @param $createdAt
     * @param $width
     * @param $height
     * @param $color
     * @param $likes
     * @param array $urls
     * @param array $links
     */
    public function __construct(UnsplashUser $unsplashUser, $unsplashId, $createdAt, $width, $height, $color, $likes, array $urls, array $links, array $location)
    {
        $this->unsplashUser = $unsplashUser;
        $this->unsplashId = $unsplashId;
        $this->createdAt = new DateTime($createdAt);
        $this->width = $width;
        $this->height = $height;
        $this->color = $color;
        $this->likes = $likes;

        if(array_key_exists('raw', $urls)) {
            $this->urlRaw = $urls['raw'];
        }
        if(array_key_exists('regular', $urls)) {
            $this->urlRegular = $urls['regular'];
        }
        if(array_key_exists('html', $links)) {
            $this->linkHtml = $links['html'];
        }

        if(array_key_exists('title', $location)) {
            $this->title = $location['title'];
        }
        if(array_key_exists('name', $location)) {
            $this->name = $location['name'];
        }
        if(array_key_exists('city', $location)) {
            $this->city = $location['city'];
        }
        if(array_key_exists('country', $location)) {
            $this->country = $location['country'];
        }
        if(array_key_exists('position', $location)) {
            $this->latitude = $location['position']['latitude'];
            $this->longitude = $location['position']['longitude'];
        }
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
    public function getUnsplashId()
    {
        return $this->unsplashId;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return int
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @return string
     */
    public function getUrlRaw()
    {
        return $this->urlRaw;
    }

    /**
     * @return string
     */
    public function getUrlRegular()
    {
        return $this->urlRegular;
    }

    /**
     * @return string
     */
    public function getLinkHtml()
    {
        return $this->linkHtml;
    }

    /**
     * @return UnsplashUser
     */
    public function getUnsplashUser()
    {
        return $this->unsplashUser;
    }
}