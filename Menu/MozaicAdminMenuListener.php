<?php

namespace Disjfa\MozaicBundle\Menu;

use App\Menu\ConfigureMenuEvent;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class MozaicAdminMenuListener
{
    /**
     * @param ConfigureMenuEvent $event
     */
    public function onMenuConfigure(ConfigureMenuEvent $event)
    {
        try {
            $menu = $event->getMenu();
            $mozaicMenu = $menu->addChild('mozaic', [
                'label' => 'Mozaic puzzle',
                'route' => 'disjfa_mozaic_puzzle_index'
            ])->setExtra('icon', 'fa-puzzle-piece');
            $mozaicMenu->addChild('Puzzles', ['route' => 'disjfa_mozaic_admin_mozaic_index'])->setExtra('icon', 'fa-puzzle-piece');
        } catch (RouteNotFoundException $e) {
            // routing.yml not set up
            return;
        }
    }
}