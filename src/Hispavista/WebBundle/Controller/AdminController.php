<?php

namespace Hispavista\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Hispavista\GeoLocalizationBundle\Client\GeoIpClient;

class AdminController extends Controller {

    public function indexAction() {
        return $this->render('HispavistaWebBundle:Admin:base.html.twig');
    }
}
