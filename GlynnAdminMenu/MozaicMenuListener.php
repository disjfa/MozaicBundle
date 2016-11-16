<?php

namespace Disjfa\MozaicBundle\GlynnAdminMenu;

use Doctrine\ORM\EntityManagerInterface;
use GlyynnAdminBundle\Menu\ConfigureMenuEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use UserBundle\Entity\User;

/**
 * Class MediaMenuListener
 * @package UserBundle\GlynnAdminMenu
 */
class MozaicMenuListener
{
    /**
     * @param ConfigureMenuEvent $event
     */
    public function onMenuConfigure(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();
        $mozaicMenu = $menu->addChild('Mozaic puzzle', [
            'route' => 'disjfa_mozaic_puzzle_index'
        ])->setExtra('icon', 'fa-puzzle-piece');
        $mozaicMenu->addChild('Puzzles', ['route' => 'disjfa_mozaic_puzzle_index'])->setExtra('icon', 'fa-puzzle-piece');
        $mozaicMenu->addChild('Random', ['route' => 'disjfa_mozaic_puzzle_random'])->setExtra('icon', 'fa-random');
    }
}