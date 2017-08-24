<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\LostObject;
use UserBundle\Entity\Person;

class DefaultController extends Controller
{


    /**
     * @Route("/user",name="home_new_test")
     * @return Response
     */
    public function homeActions()
    {
/*
        $sccontent = $this->container->get('security.context');
        $user = $sccontent->getToken()->getUser();

        var_dump($user); die;

        $person = $this->getDoctrine()->getManager()->getRepository('UserBundle:Person')->findOneBy(['email'=>$user]);

        $lostObjects = $person->getLostObject();


        $listLost = [];



        foreach ($lostObjects as $lost) {
            $listLost[] = [
                "id" => $lost->getId(),
                "type" => $lost->getType(),
                "description" => $lost->getDescription(),
                "lostPlace" => $lost->getLostPlace(),
                "lostDate" => $lost->getDate(),
                "isFound" => $lost->getisFound(),
                "delivered"=>$lost->getDelivered()
            ];
        }

        $cnt = count($listLost);
        return $this->render("UserBundle:user:details.html.twig",
            [
                "lostObject"=>$listLost,
                "user"=>$person,
                "cnt"=>$cnt
            ]);*/

        die;
    }

}
