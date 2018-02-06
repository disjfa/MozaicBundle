<?php

namespace Disjfa\MozaicBundle\Menu;

use App\Menu\ConfigureMenuEvent;

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