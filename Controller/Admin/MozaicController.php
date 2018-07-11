<?php

namespace Disjfa\MozaicBundle\Controller\Admin;

use Crew\Unsplash\Exception;
use Disjfa\MozaicBundle\Entity\Daily;
use Disjfa\MozaicBundle\Entity\UnsplashPhoto;
use Disjfa\MozaicBundle\Form\Type\AdminDateType;
use Disjfa\MozaicBundle\Form\Type\SearchType;
use Disjfa\MozaicBundle\Services\UnsplashClient;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
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
     * @var Paginator
     */
    private $paginator;
    /**
     * @var UnsplashClient
     */
    private $unsplashClient;

    public function __construct(PaginatorInterface $paginator, UnsplashClient $unsplashClient)
    {
        $this->paginator = $paginator;
        $this->unsplashClient = $unsplashClient;
    }

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
     * @param Request $request
     * @return Response
     */
    public function photosAction(Request $request)
    {
        $unsplashPhotos = $this->getDoctrine()->getRepository(UnsplashPhoto::class)->findAllPaginated($this->paginator, $request->query->getInt('page', 1), $request->query->getInt('limit', 16));

        return $this->render('@DisjfaMozaic/Admin/Mozaic/photos.html.twig', [
            'unsplashPhotos' => $unsplashPhotos,
        ]);
    }

    /**
     * @Route("/search", name="disjfa_mozaic_admin_mozaic_search")
     * @param Request $request
     * @return Response
     */
    public function searchAction(Request $request)
    {
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);
        $unsplashPhoto = null;
        if ($form->isSubmitted() && $form->isValid()) {
            $unsplashId = $form->get('unsplashId')->getData();

            try {
                $unsplashPhoto = $this->unsplashClient->find($unsplashId);
            } catch (Exception $e) {
                $this->addFlash('warning', $e->getMessage());
            }
        }

        return $this->render('@DisjfaMozaic/Admin/Mozaic/search.html.twig', [
            'form' => $form->createView(),
            'unsplashPhoto' => $unsplashPhoto,
        ]);
    }

    /**
     * @Route("/show/{unsplashPhoto}", name="disjfa_mozaic_admin_mozaic_show")
     * @param UnsplashPhoto $unsplashPhoto
     * @return Response
     */
    public function showAction(UnsplashPhoto $unsplashPhoto)
    {
        return $this->render('@DisjfaMozaic/Admin/Mozaic/show.html.twig', [
            'unsplashPhoto' => $unsplashPhoto,
        ]);
    }
}