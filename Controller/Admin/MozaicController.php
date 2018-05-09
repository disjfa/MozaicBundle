<?php

namespace Disjfa\MozaicBundle\Controller\Admin;

use Disjfa\MozaicBundle\Entity\Daily;
use Disjfa\MozaicBundle\Entity\UnsplashPhoto;
use Disjfa\MozaicBundle\Form\Type\AdminDateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin/mozaic")
 */
class MozaicController extends Controller
{
    /**
     * @Route("/daily", name="disjfa_mozaic_admin_mozaic_daily")
     * @param Request $request
     * @return Response
     */
    public function dailyAction(Request $request)
    {
        $form = $this->createForm(AdminDateType::class);
        $form->handleRequest($request);

        return $this->render('@DisjfaMozaic/Admin/Mozaic/daily.html.twig', [
            'form' => $form->createView(),
            'daily' => $this->getDoctrine()->getRepository(Daily::class)->findByMonthAndYear($form->get('date')->getData()),
        ]);
    }

    /**
     * @Route("/photos", name="disjfa_mozaic_admin_mozaic_photos")
     * @return Response
     */
    public function photosAction()
    {
        return $this->render('@DisjfaMozaic/Admin/Mozaic/photos.html.twig', [
            'unsplashPhotos' => $this->getDoctrine()->getRepository(UnsplashPhoto::class)->findAll(),
        ]);
    }

    /**
     * @Route("/show/{unsplashPhoto}", name="disjfa_mozaic_admin_mozaic_show")
     * @param Request $request
     * @return Response
     */
    public function showAction(UnsplashPhoto $unsplashPhoto)
    {
        return $this->render('@DisjfaMozaic/Admin/Mozaic/show.html.twig', [
            'unsplashPhoto' => $unsplashPhoto,
        ]);
    }
}