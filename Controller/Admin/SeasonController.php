<?php

namespace Disjfa\MozaicBundle\Controller\Admin;

use Disjfa\MozaicBundle\Entity\UnsplashSeason;
use Disjfa\MozaicBundle\Form\Type\AdminSeasonType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @Route("/admin/mozaic_season")
 */
class SeasonController extends Controller
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @Route("", name="disjfa_mozaic_admin_season_index")
     */
    public function indexAction()
    {
        return $this->render('@DisjfaMozaic/Admin/Season/index.html.twig', [
            'seasons' => $this->getDoctrine()->getRepository(UnsplashSeason::class)->findBy([], ['dateSeason' => 'DESC']),
        ]);
    }

    /**
     * @Route("/{unsplashSeason}/show", name="disjfa_mozaic_admin_season_show")
     * @param UnsplashSeason $unsplashSeason
     * @return Response
     */
    public function showAction(UnsplashSeason $unsplashSeason)
    {
        return $this->render('@DisjfaMozaic/Admin/Season/show.html.twig', [
            'unsplashSeason' => $unsplashSeason,
        ]);
    }

    /**
     * @Route("/{unsplashSeason}/edit", name="disjfa_mozaic_admin_season_edit")
     * @param Request $request
     * @param UnsplashSeason $unsplashSeason
     * @return Response
     */
    public function editAction(Request $request, UnsplashSeason $unsplashSeason)
    {
        return $this->handleForm($request, $unsplashSeason);
    }

    /**
     * @Route("/create", name="disjfa_mozaic_admin_season_create")
     */
    public function createAction(Request $request)
    {
        $unsplashSeason = new UnsplashSeason();
        return $this->handleForm($request, $unsplashSeason);
    }

    /**
     * @param Request $request
     * @param UnsplashSeason $unsplashSeason
     * @return Response
     */
    private function handleForm(Request $request, UnsplashSeason $unsplashSeason)
    {
        $form = $this->createForm(AdminSeasonType::class, $unsplashSeason);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($unsplashSeason);
            $entityManager->flush();

            $this->addFlash('success', $this->translator->trans('admin.flash.season_saved', [], 'mozaic'));

            return $this->redirectToRoute('disjfa_mozaic_admin_season_show', [
                'unsplashSeason' => $unsplashSeason->getId(),
            ]);
        }

        return $this->render('@DisjfaMozaic/Admin/Season/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}