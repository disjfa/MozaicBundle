<?php

namespace Disjfa\MozaicBundle\Controller;

use Disjfa\MozaicBundle\Entity\UnsplashSeason;
use Disjfa\MozaicBundle\Entity\UnsplashSeasonItem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/mozaic-season")
 */
class SeasonController extends Controller
{
    /**
     * @Route("", name="disjfa_mozaic_season_index")
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('@DisjfaMozaic/Season/index.html.twig', [
            'seasons' => $this->getDoctrine()->getRepository(UnsplashSeason::class)->findPublicSeasons(),
        ]);
    }

    /**
     * @Route("/{unsplashSeason}", name="disjfa_mozaic_season_show")
     *
     * @param UnsplashSeason $unsplashSeason
     *
     * @return Response
     */
    public function showAction(UnsplashSeason $unsplashSeason)
    {
        $this->denyAccessUnlessGranted('view', $unsplashSeason);

        return $this->render('@DisjfaMozaic/Season/show.html.twig', [
            'unsplashSeason' => $unsplashSeason,
        ]);
    }

    /**
     * @Route("/{unsplashSeason}/{unsplashSeasonItem}", name="disjfa_mozaic_season_item")
     *
     * @param UnsplashSeason     $unsplashSeason
     * @param UnsplashSeasonItem $unsplashSeasonItem
     *
     * @return Response
     */
    public function itemAction(UnsplashSeason $unsplashSeason, UnsplashSeasonItem $unsplashSeasonItem)
    {
        $unsplashPhoto = $unsplashSeasonItem->getUnsplashPhoto();
        if (null === $this->getUser()) {
            $myPhotos = [];
            $myLike = false;
        } else {
            $userId = $this->getUser()->getId();
            $myPhotos = $unsplashPhoto->getUserPhotoByUser($userId);
            $myLike = $unsplashPhoto->getLikeByUser($userId);
        }

        return $this->render('@DisjfaMozaic/Puzzle/photo.html.twig', [
            'unsplashSeason' => $unsplashSeason,
            'unsplashSeasonItem' => $unsplashSeasonItem,
            'unsplashPhoto' => $unsplashPhoto,
            'myPhotos' => $myPhotos,
            'myLike' => $myLike,
        ]);
    }
}
