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
     * @Route("/")
     */
    public function indexAction()
    {
        HttpClient::init([
            'applicationId' => 'ee739aa7747ac4951e2d07c6be0ee6b1f9d472c4f11e02937428f6b5d45972a1',
            'secret' => 'fc73b8022130e6c19ffa349cd51813847573a0fc889bd2d2ff899c645fd9ba9e',
            'callbackUrl' => $this->generateUrl('disjfa_mozaic_unsplash_callback'),
        ]);

        $em = $this->getDoctrine()->getManager();
        $unsplashUserRepository = $em->getRepository(UnsplashUser::class);
        $unsplashPhotoRepository = $em->getRepository(UnsplashPhoto::class);

        $photos = Photo::curated(1);
        foreach ($photos as $photo) {

            $unsplashUser = $unsplashUserRepository->find($photo->user['id']);
            if (null === $unsplashUser) {
                $unsplashUser = new UnsplashUser($photo->user);

                $em->persist($unsplashUser);
            }

            $unsplashPhoto = $unsplashPhotoRepository->find($photo->id);
            if (null === $unsplashPhoto) {
                $unsplashPhoto = new UnsplashPhoto($unsplashUser, $photo->id, $photo->created_at, $photo->width, $photo->height, $photo->color, $photo->likes, $photo->urls, $photo->links);
                $em->persist($unsplashPhoto);
            }

        }
        $em->flush();
        dump($photos);
        exit;
        //$photos = $batch->photos($page, $per_page);
        return $this->render('DisjfaMozaicBundle:Puzzle:index.html.twig', [
            'columns' => $columns,
        ]);
    }

    /**
     * @Route("/callback", name="disjfa_mozaic_unsplash_callback")
     */
    public function callbackAction(Request $request)
    {
        dump($request);
        exit;

        return $this->render('DisjfaMozaicBundle:Puzzle:index.html.twig', [
            'columns' => $columns,
        ]);
    }
}
