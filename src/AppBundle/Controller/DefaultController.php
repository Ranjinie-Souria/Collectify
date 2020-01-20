<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonDecode;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->forward('AppBundle:Sheet:list');
    }

    /**
     * @Route("/country", name="country")
     */
    public function countryAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        //$em->persist($country);
        $em->flush();


        return $this->forward('AppBundle:Sheet:list');
    }



}
