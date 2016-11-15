<?php

namespace Disjfa\MozaicBundle\Controller;

use Disjfa\MozaicBundle\Entity\UnsplashPhoto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/mozaic")
 */
class PuzzleController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $unsplashPhotos = $this->getDoctrine()->getRepository(UnsplashPhoto::class)->findAll();
        return $this->render('DisjfaMozaicBundle:Puzzle:index.html.twig', [
            'unsplashPhotos' => $unsplashPhotos,
        ]);
    }

    /**
     * @Route("/{unsplashPhoto}")
     */
    public function photoAction(UnsplashPhoto $unsplashPhoto)
    {

        $image = $unsplashPhoto->getUrlRaw();
        $width = $unsplashPhoto->getWidth();
        //$height = 3264;
        $height = $width / 16 * 9;

        $w = 1040;
        $h = $w / 16 * 9;

        $columns = [];
        $colY = 6;
        $colX = 5;

        $realWidth = floor($width / $colX);
        $realHeight = floor($height / $colY);

        $blockWidth = floor($w / $colX);
        $blockHeight = floor($h / $colY);

        for ($i = 0; $i < $colX; $i++) {
            for ($j = 0; $j < $colY; $j++) {
                if (isset($columns[$i][$j])) {
                    continue;
                }

                $sizeX = mt_rand(1, 3);
                $sizeX = $i + $sizeX > $colX ? $colX - $i : $sizeX;
                $maxX = $sizeX;
                $sizeY = mt_rand(1, 3);
                $sizeY = $j + $sizeY > $colY ? $colY - $j : $sizeY;
                $maxY = $sizeY;

                for ($mx = $i; $mx < $i + $sizeX; $mx++) {
                    if (isset($columns[$mx])) {
                        $maxX = $mx - $i < $maxX ? $mx - $i + 1 : $maxX;
                    }
                    for ($my = $j; $my < $j + $sizeY; $my++) {
                        if (isset($columns[$mx][$my])) {
                            $maxY = $my - $j < $maxY ? $my - $j + 1 : $maxY;
                        }
                    }
                }
                $sizeX = $maxX;
                $sizeY = $maxY;
                for ($mx = $i; $mx < $i + $sizeX; $mx++) {
                    for ($my = $j; $my < $j + $sizeY; $my++) {
                        $columns[$mx][$my] = false;
                    }
                }

                $iWidth = floor($blockWidth * $sizeX) + ($sizeX * 2);
                $iHeight = floor($blockHeight * $sizeY) + ($sizeY * 2);

                $params = [
                    'w' => $iWidth,
                    'h' => $iHeight,
                    'rect' => implode(',', [
                        $i * $realWidth,
                        $j * $realHeight,
                        $realWidth * $sizeX,
                        $realHeight * $sizeY
                    ])
                ];

                $columns[$i][$j] = [
                    'image' => $image . '?' . http_build_query($params, '&amp;'),
                    'styles' => [
                        'left' => $i * $blockWidth,
                        'top' => $j * $blockHeight,
                        'width' => $iWidth,
                        'height' => $iHeight,
                        'x' => $sizeX,
                        'y' => $sizeY,
                    ],
                ];
            }
            ksort($columns[$i]);
        }
        ksort($columns);

        return $this->render('DisjfaMozaicBundle:Puzzle:photo.html.twig', [
            'columns' => $columns,
        ]);
    }
}
