<?php

namespace CloneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="hello")
     */
    public function indexAction()
    {
        return new JsonResponse(array('hello' => 'world!'));
    }

}
