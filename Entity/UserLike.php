<?php

namespace Disjfa\MozaicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Entity(repositoryClass="UserLikeRepository")
 * @ORM\Table(name="unsplash_user_likes", uniqueConstraints={@UniqueConstraint(name="user_like", columns={"unsplash_photo_id", "user_id"})})
 */
class UserLike
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
     * @ORM\ManyToOne(targetEntity="Disjfa\MozaicBundle\Entity\UnsplashPhoto", inversedBy="userLikes")
     */
    private $unsplashPhoto;

    /**
     * @var bool
     * @ORM\Column(name="liked", type="boolean")
     */
    private $liked;

    /**
     * @var string
     * @ORM\Column(name="user_id", type="string", nullable=true)
     */
    private $userId;

    public function __construct(UnsplashPhoto $unsplashPhoto, $userId, bool $liked)
    {
        $this->unsplashPhoto = $unsplashPhoto;
        $this->userId = $userId;
        $this->liked = $liked;
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
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return bool
     */
    public function isLiked(): bool
    {
        return $this->liked;
    }

    /**
     * @param bool $liked
     */
    public function setLiked(bool $liked): void
    {
        $this->liked = $liked;
    }
}