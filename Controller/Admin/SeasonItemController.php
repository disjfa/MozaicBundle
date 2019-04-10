<?php

namespace Disjfa\MozaicBundle\Controller\Admin;

use Disjfa\MozaicBundle\Entity\UnsplashSeasonItem;
use Disjfa\MozaicBundle\Form\Type\AdminSeasonItemType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @Route("/admin/mozaic_season/items")
 */
class SeasonItemController extends Controller
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
     * @Route("/{unsplashSeasonItem}/edit", name="disjfa_mozaic_admin_season_item_edit")
     *
     * @param Request            $request
     * @param UnsplashSeasonItem $unsplashSeasonItem
     *
     * @return Response
     */
    public function editAction(Request $request, UnsplashSeasonItem $unsplashSeasonItem)
    {
        return $this->handleForm($request, $unsplashSeasonItem);
    }

    /**
     * @param Request            $request
     * @param UnsplashSeasonItem $unsplashSeasonItem
     *
     * @return Response
     */
    private function handleForm(Request $request, UnsplashSeasonItem $unsplashSeasonItem)
    {
        $form = $this->createForm(AdminSeasonItemType::class, $unsplashSeasonItem);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($unsplashSeasonItem);
            $entityManager->flush();

            $this->addFlash('success', $this->translator->trans('admin.flash.season_item_saved', [], 'mozaic'));

            return $this->redirectToRoute('disjfa_mozaic_admin_season_show', [
                'unsplashSeason' => $unsplashSeasonItem->getUnsplashSeason()->getId(),
            ]);
        }

        return $this->render('@DisjfaMozaic/Admin/SeasonItem/form.html.twig', [
            'form' => $form->createView(),
            'unsplashSeasonItem' => $unsplashSeasonItem,
        ]);
    }
}
