<?php

namespace Disjfa\MozaicBundle\Controller;

use Crew\Unsplash\HttpClient;
use Crew\Unsplash\Photo;
use Disjfa\MozaicBundle\Entity\UnsplashPhoto;
use Disjfa\MozaicBundle\Entity\UnsplashUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/mozaic/unsplash")
 */
class UnsplashController extends Controller
{
    /**
     * @Route("/callback", name="disjfa_mozaic_unsplash_callback")
     */
    public function callbackAction(Request $request)
    {
        // @todo this does nothing
        return $this->render('@DisjfaMozaic/Puzzle/index.html.twig', [
        ]);
    }
}
