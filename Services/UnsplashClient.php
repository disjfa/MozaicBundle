<?php

namespace Disjfa\MozaicBundle\Services;

use Crew\Unsplash\HttpClient;
use Crew\Unsplash\Photo;
use Disjfa\MozaicBundle\Entity\UnsplashPhoto;
use Disjfa\MozaicBundle\Entity\UnsplashUser;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Routing\RouterInterface;

/**
 * @package UserBundle\GlynnAdminMenu
 */
class UnsplashClient
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param $applicationId
     * @param $secret
     * @param RouterInterface $router
     * @param EntityManagerInterface $entityManager
     *
     * @throws Exception
     */
    public function __construct(string $applicationId, string $secret, RouterInterface $router, EntityManagerInterface $entityManager)
    {
        if (empty($applicationId) || empty($secret)) {
            throw new Exception('No "disjfa_mozaic.unsplash.application_id" or "disjfa_mozaic.unsplash.secret" set in parameters');
        }

        HttpClient::init([
            'applicationId' => $applicationId,
            'secret' => $secret,
            'callbackUrl' => $router->generate('disjfa_mozaic_unsplash_callback', [], 0),
            'utmSource' => 'dimme_mozaic',
        ]);
        $this->entityManager = $entityManager;
    }

    /**
     * @return UnsplashPhoto
     */
    public function random()
    {
        $photo = Photo::random([]);
        return $this->updateOrInsertPhoto($photo);
    }

    /**
     * @param string $unsplashId
     * @return UnsplashPhoto
     */
    public function find(string $unsplashId)
    {
        $photo = Photo::find($unsplashId);
        return $this->updateOrInsertPhoto($photo);
    }

    /**
     * @param Photo $photo
     * @return UnsplashPhoto
     */
    private function updateOrInsertPhoto(Photo $photo)
    {
        $unsplashUser = $this->entityManager->getRepository(UnsplashUser::class)->find($photo->user['id']);
        if (null === $unsplashUser) {
            $unsplashUser = new UnsplashUser($photo->user);
            $this->entityManager->persist($unsplashUser);
        }

        $unsplashPhoto = $this->entityManager->getRepository(UnsplashPhoto::class)->find($photo->id);
        if (null === $unsplashPhoto) {
            $location = isset($photo->location) ? $photo->location : [];
            $unsplashPhoto = new UnsplashPhoto($unsplashUser, $photo->id, $photo->created_at, $photo->width, $photo->height, $photo->color, $photo->likes, $photo->urls, $photo->links, $location);
            $this->entityManager->persist($unsplashPhoto);
        }

        $this->entityManager->flush();
        return $unsplashPhoto;
    }
}