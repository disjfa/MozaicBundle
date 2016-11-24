<?php

namespace Disjfa\MozaicBundle\Twig;

use Disjfa\MozaicBundle\Entity\UnsplashPhoto;
use Twig_Extension;
use Twig_SimpleFilter;

class UnsplashExtension extends Twig_Extension
{
    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter('unsplash_photo_block', array($this, 'unsplashPhotoBlock')),
        );
    }

    public function unsplashPhotoBlock(UnsplashPhoto $unsplashPhoto)
    {
        $outputWidth = 600;
        $outputHeight = $outputWidth / 16 * 9;

        $realWidth = $unsplashPhoto->getWidth();
        $realHeight = $unsplashPhoto->getHeight();

        $blockX = $realWidth / 8;
        $blockY = $realHeight / 8;

        $widthX = $blockX;
        $widthY = $blockX * 16 / 9;

        $params = [
            'w' => $outputWidth,
            'h' => $outputHeight,
            'rect' => implode(',', [
                (int)($blockX*5),
                (int)($blockY*3),
                (int)$widthY,
                (int)$widthX,
            ])
        ];

        return $unsplashPhoto->getUrlRaw() . '?' . http_build_query($params, '&amp;');
    }

    public function getName()
    {
        return 'unsplash_extension';
    }

}