<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SecurityController
 * @package App\Controller
 */
class SecurityController extends AbstractController
{

    public function api(){

    }

    /**
     * @Route("/securityLogout",name="security_logout")
     */
    public function logout(){

    }
}
