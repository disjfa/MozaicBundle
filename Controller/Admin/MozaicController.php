<?php

namespace Disjfa\MozaicBundle\Controller\Admin;

use Disjfa\MozaicBundle\Entity\Daily;
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
     * @Route("", name="disjfa_mozaic_admin_mozaic_index")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(AdminDateType::class);
        $form->handleRequest($request);

        return $this->render('@DisjfaMozaic/Admin/Mozaic/index.html.twig', [
            'form' => $form->createView(),
            'daily' => $this->getDoctrine()->getRepository(Daily::class)->findByMonthAndYear($form->get('date')->getData()),
        ]);
    }
}