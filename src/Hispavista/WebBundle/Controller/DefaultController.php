<?php

namespace Hispavista\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Hispavista\GeoLocalizationBundle\Client\GeoIpClient;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $data=GeoIpClient::GeolocalizarIP($this->container->get('request')->getClientIp());
        return $this->render('HispavistaWebBundle:Default:index.html.twig',array('geoData'=>$data));
    }
}
