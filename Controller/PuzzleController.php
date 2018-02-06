<?php

namespace Disjfa\MozaicBundle\Controller;

use Crew\Unsplash\Exception as UnsplashException;
use Disjfa\MozaicBundle\Entity\Daily;
use Disjfa\MozaicBundle\Entity\DailyDateTime;
use Disjfa\MozaicBundle\Entity\UnsplashPhoto;
use Disjfa\MozaicBundle\Entity\UserPhoto;
use Disjfa\MozaicBundle\Services\UnsplashClient;
use FOS\UserBundle\Model\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/mozaic")
 */
class PuzzleController extends Controller
{
    /**
     * @var UnsplashClient
     */
    private $unsplashClient;

    public function __construct(UnsplashClient $unsplashClient)
    {
        $this->unsplashClient = $unsplashClient;
    }
    
    /**
     * @Route("/", name="disjfa_mozaic_puzzle_index")
     */
    public function indexAction()
    {
        return $this->render('@DisjfaMozaic/Puzzle/index.html.twig', [
            'lastPhotos' => $this->getDoctrine()->getRepository(Daily::class)->findLatest(),
        ]);
    }

    /**
     * @Route("/my-progress", name="disjfa_mozaic_puzzle_my_progress")
     */
    public function myProgressAction()
    {
        if (false === $this->getUser() instanceof User) {
            return $this->createAccessDeniedException('PLease log in');
        }

        return $this->render('@DisjfaMozaic/Puzzle/my_progress.html.twig', [
            'userPhotos' => $this->getDoctrine()->getRepository(UserPhoto::class)->findByMyPhotos($this->getUser()->getId()),
        ]);
    }

    /**
     * @Route("/daily", name="disjfa_mozaic_puzzle_daily")
     */
    public function daylyAction()
    {
        $today = new DailyDateTime('now');
        $daily = $this->getDoctrine()->getRepository(Daily::class)->findDailyByDate($today);

        if (null === $daily) {
            try {
                $unsplashPhoto = $this->unsplashClient->random();
            } catch (UnsplashException $e) {
                $unsplashPhotos = $this->getDoctrine()->getRepository(UnsplashPhoto::class)->findAll();
                shuffle($unsplashPhotos);
                $unsplashPhoto = current($unsplashPhotos);
            }

            $daily = new Daily($unsplashPhoto, $today);

            $this->getDoctrine()->getManager()->persist($daily);
            $this->getDoctrine()->getManager()->flush($daily);
        }

        $unsplashPhoto = $daily->getUnsplashPhoto();
        return $this->redirectToRoute('disjfa_mozaic_puzzle_photo', ['unsplashPhoto' => $unsplashPhoto->getUnsplashId()]);
    }

    /**
     * @Route("/random", name="disjfa_mozaic_puzzle_random")
     */
    public function randomAction()
    {
        try {
            $unsplashPhoto = $this->unsplashClient->random();
        } catch (UnsplashException $e) {
            $unsplashPhotos = $this->getDoctrine()->getRepository(UnsplashPhoto::class)->findAll();
            shuffle($unsplashPhotos);
            $unsplashPhoto = current($unsplashPhotos);
        }

        return $this->redirectToRoute('disjfa_mozaic_puzzle_photo', ['unsplashPhoto' => $unsplashPhoto->getUnsplashId()]);
    }

    /**
     * @Route("/{unsplashPhoto}", name="disjfa_mozaic_puzzle_photo")
     * @param UnsplashPhoto $unsplashPhoto
     * @return Response
     */
    public function photoAction(UnsplashPhoto $unsplashPhoto)
    {
        return $this->render('@DisjfaMozaic/Puzzle/photo.html.twig', [
            'unsplashPhoto' => $unsplashPhoto,
        ]);
    }
}
