<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\AdmStaffLF;
use UserBundle\Entity\LostObject;
use UserBundle\Entity\Person;

class AdmStaffController extends Controller
{


    /**
     * @Route("/admin/{id}", name="admin_home_page")
     */
    public function adminHomeAction(AdmStaffLF $admStaffLF)
    {




        $lost_objects = $admStaffLF->getLostObject();
        $lost_list = [];


        /** @var LostObject $lo */
        foreach ($lost_objects as $lo)
        {
            $lost_list[] = [
                "id"=> $lo->getId(),
                "type"=> $lo->getType(),
                "description"=> $lo->getDescription(),
                "lostPlace"=> $lo->getLostPlace(),
                "lostDate"=> $lo->getDate(),
                "isFound"=>$lo->getisFound()
            ];
        }



        $cnt = count($lost_list);


        return $this->render(
            "@User/staff/homestaff.html.twig",
            [
                "user"=>$admStaffLF,
                "lostObject"=>$lost_list,
                "cnt"=>$cnt
            ]
        );
    }


    /**
     * @param LostObject $lostObject
     * @Route("/admin/{id}/object", name="isFound_lost_object")
     */
    public function isFoundObject(LostObject $lostObject)
    {

        if(!$lostObject->getisFound())
            $lostObject->setIsFound(true);
        else
            $lostObject->setIsFound(false);


        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $adminstaff = $lostObject->getAdmStaffLF();

        return $this->redirectToRoute(
            'admin_home_page',
            ['id'=>$adminstaff->getId()]
        );


    }


    /**
     * @Route("/admin/{id}", name="show_detailed_submition")
     */
    public function showLostWithDetailsAction(LostObject $lostObject)
    {

        /** @var Person $person */
        $person  = $lostObject->getPerson();

        $list_done = $person->getLostObject();

        $lost_obj = [];

        /** @var LostObject $l */
        foreach ($list_done as $l)
        {
            $lost_obj[]=
                [
                    "type"=> $l->getType(),
                    "description"=> $l->getDescription(),
                    "lostPlace"=> $l->getLostPlace(),
                    "lostDate"=> $l->getDate(),
                    "isFound"=> $l->getisFound()
                ];
        }


        return $this->render(
            "@User/staff/showDetPerson.html.twig",
            [
                "user"=> $person,
                "list"=> $lost_obj,
                "cnt"=> count($lost_obj)
            ]
        );


    }





}
