<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SecurityController
 * @package App\Controller
 */
class SecurityController extends AbstractController
{

    public function api(){
        return new Response($this->getUser()->getEmail());
    }

    /**
     * @Route("/securityLogout",name="security_logout")
     */
    public function logout(){

    }
}
