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
     *@Route("/user",name="user_show")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $data = $em ->getRepository(Person::class)
            ->getUsersFromDB();


        return $this->render(
            "UserBundle:default:show.html.twig",
               ["list" =>$data]
            );

    }


    /**
     * @Route("/user/{name}/comments", name="show_allComments")
     *
     */
    public function showAllUAction(Person $user)
    {
        /** @var LostObject $comments */

        $comments = $user->getComments();

        $array = array();

        /** @var LostObject $cm */
        foreach ($comments as $cm)
        {
            $array[] = [
                'id'=>$cm->getId(),
                'comment'=>$cm->getText(),
                'date'=>$cm->getDate()
            ];
        }


        return $this->render(
            "UserBundle:default:user_com.html.twig",
            ["comments"=>$array]
        );

    }



}
