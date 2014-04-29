<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hispavista\WebBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class AdminMenuBuilder extends ContainerAware{
    
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        // create root item
        $menu = $factory->createItem('root');
        // set id for root item, and class for nice twitter bootstrap style
        $menu->setChildrenAttributes(array('id' => 'main_navigation', 'class' => 'nav'));

        // add links $menu
        $menu->addChild('Usuarios', array('route'=>'Hispavista_WebBundle_User_list'));

        return $menu;
    }
}
