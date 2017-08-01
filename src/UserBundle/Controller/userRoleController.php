<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\LostObject;
use UserBundle\Entity\Person;
use UserBundle\Form\addLostObject;

class userRoleController extends Controller
{


    /**
     * @Route("/user/{id}" , name="user_main_page")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function userHomeAction(Person $person)
    {

        $lostObjects = $person->getLostObject();

        $listLost = [];

        /** @var LostObject $lost */
        foreach ($lostObjects as $lost) {
            $listLost[] = [
                "id" => $lost->getId(),
                "type" => $lost->getType(),
                "description" => $lost->getDescription(),
                "lostPlace" => $lost->getLostPlace(),
                "lostDate" => $lost->getDate(),
                "isFound" => $lost->getisFound()
            ];
        }

        $cnt = count($listLost);
        return $this->render("UserBundle:user:details.html.twig",
            [
                "lostObject"=>$listLost,
                "user"=>$person,
                "cnt"=>$cnt
            ]);
    }


    /**
     * @Route("/user/{id}/addNew" , name="add_Lost_Object")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function userAddLOAction(Request $request , Person $person)
    {

        $form = $this->createForm(addLostObject::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var LostObject $lsobj */
            $lsobj  = $form->getData();

            $lsobj->setPerson($person);

            $em = $this->getDoctrine()->getManager();
            $em->persist($lsobj);
            $em->flush();

            $this->addFlash("success","The Form was saved");

            $redir =  $this->redirectToRoute('user_main_page',[ "id"=> $person->getId() ]);

            return $redir;
        }


        return $this->render(
            "UserBundle:user:form_add.html.twig",
        [
            "form"=>$form->createView(),
            "user"=>$person
        ]
        );

    }


    /**
     *@Route("/user/{id}/edit", name="edit_lost_form")
     */
    public function userEditAction(LostObject $lsObject, Request $request)
    {

        $form = $this->createForm(addLostObject::class, $lsObject);

        $form->handleRequest($request);

        /** @var Person $person */
        $person = $lsObject->getPerson();

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var LostObject $lost */
            $lost = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash("success","The Form was saved");

            $redir =  $this->redirectToRoute('user_main_page',[ "id"=> $person->getId() ]);

            return $redir;
        }





        return $this->render(
            "UserBundle:user:form_add.html.twig",
            [
                "form"=>$form->createView(),
                "user"=>$person
            ]
        );


    }


    /**
     * @param LostObject $lostObject
     * @Route("/user/{id}/delete", name="delete_lost_form")
     */

    public function deleteLostObjects(LostObject $lostObject)
    {


        /** @var Person $person */
        $person  = $lostObject->getPerson();

        $em = $this->getDoctrine()->getManager();

        $del = $em->getRepository('UserBundle:LostObject')
            ->DeleteLOSTOBJwithId($lostObject);


        return $this->redirectToRoute("user_main_page",['id'=>$person->getId()]);

    }




}
