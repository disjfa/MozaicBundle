<?php

namespace Disjfa\MozaicBundle\Menu;

use App\Menu\ConfigureMenuEvent;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class MozaicMenuListener
{
    /**
     * @param ConfigureMenuEvent $event
     */
    public function onMenuConfigure(ConfigureMenuEvent $event)
    {
        try {
            $menu = $event->getMenu();
            $mozaicMenu = $menu->addChild('Mozaic puzzle', [
                'route' => 'disjfa_mozaic_puzzle_index'
            ])->setExtra('icon', 'fa-puzzle-piece');
            $mozaicMenu->addChild('Puzzles', ['route' => 'disjfa_mozaic_puzzle_index'])->setExtra('icon', 'fa-puzzle-piece');
            $mozaicMenu->addChild('Random', ['route' => 'disjfa_mozaic_puzzle_random'])->setExtra('icon', 'fa-random');
            $mozaicMenu->addChild('Daily', ['route' => 'disjfa_mozaic_puzzle_daily'])->setExtra('icon', 'fa-calendar');
        } catch (RouteNotFoundException $e) {
            // routing.yml not set up
            return;
        }
    }
}