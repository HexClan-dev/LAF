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


        /** @var LostObject $lost_objects */


        $lost_list = $this->getArrayObject($admStaffLF);


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
     * @Route("/admin/{id}/details", name="show_detailed_submition")
     */
    public function showLostWithDetailsAction(LostObject $lostObject)
    {

        /** @var Person $person */
        $person  = $lostObject->getPerson();



        $lost_obj = $this->getArrayObject($lostObject->getAdmStaffLF());

      //  var_dump($lost_obj); die;

        return $this->render(
            "@User/staff/showDetPerson.html.twig",
            [
                "user"=> $person,
                "lostObject"=> $lost_obj,
                "cnt"=> count($lost_obj)
            ]
        );


    }

    private function getArrayObject(AdmStaffLF $admStaffLF)
    {
        $lost_objects = $admStaffLF->getLostObject();

        $lost_obj = [];

        /** @var LostObject $l */
        foreach ($lost_objects as $l)
        {
            $lost_obj[]=
                [
                    "id"=>$l->getId(),
                    "type"=> $l->getType(),
                    "description"=> $l->getDescription(),
                    "lostPlace"=> $l->getLostPlace(),
                    "lostDate"=> $l->getDate(),
                    "isFound"=> $l->getisFound(),
                    "delivered"=>$l->getDelivered()
                ];
        }

        return $lost_obj;

    }


    /**
     * @param LostObject $lostObject
     * @Route("/admin/{id}/delivered", name="is_lost_object_delivered")
     */

    public function isDeliveredObject(LostObject $lostObject)
    {

        if($lostObject->getDelivered())
            $lostObject->setDelivered(false);
        else $lostObject->setDelivered(true);


        $em = $this->getDoctrine()->getManager();
        $em->flush();


        return $this->redirectToRoute('admin_home_page',
            [ "id"=>$lostObject->getAdmStaffLF()->getId()]
        );


    }




}
