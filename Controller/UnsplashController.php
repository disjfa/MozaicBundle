<?php

namespace Disjfa\MozaicBundle\Controller;

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
