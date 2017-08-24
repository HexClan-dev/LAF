<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use UserBundle\Entity\Person;
use UserBundle\Form\LogInForm;

class SecurityController extends Controller
{

    /**
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @Route("/login", name="login")
     */


    public function loginformCreateAction(Request $request)
    {

        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastusername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LogInForm::class , ['username'=> $lastusername] );


        $isLoginSubmit = $request->getPathInfo()=='/login' && $request->isMethod('POST');

        if($isLoginSubmit)
        {

            $form->handleRequest($request);

            $data = $form->getData();


            // $request->getSession()->set(Security::LAST_USERNAME,$data['username']);
//
//            var_dump($data);
//            die;

            $em = $this->getDoctrine()->getManager();
            $person = $em->getRepository(Person::class)
                ->getWithUsernameAndThePassword($data['username'], $data['password']);



            if($person)
            {

                # firewall name  -> secured_area
                $token = new UsernamePasswordToken($person, $data, 'secured_area', $person->getRoles());
                $this->get('security.token_storage')->setToken($token);

                // If the firewall name is not main, then the set value would be instead:
                // $this->get('session')->set('_security_XXXFIREWALLNAMEXXX', serialize($token));
                $this->get('session')->set('_security_secured_area', serialize($token));

                // Fire the login event manually
                $event = new InteractiveLoginEvent($request, $token);
                $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);


                return $this->forward('UserBundle:userRole:userHome', array( 'id'=>$person->getId()));
//                return $this->route->generate('user_main_page',['id'=>$person->getId()]);

            }

        }





        return $this->render(
            "@User/login/login.htlm.twig",
            [
                'last_username' => $lastusername,
                'error'         => $error,
                'form'=>$form->createView()
            ]
        );


    }


    /**
     * @Route("/login_check", name="login_check")
     */

    public function checkAction()
    {

    }

    
    /**
     * @Route("/logout",name="logout")
     */

    public function logoutAction()
    {
        throw new \Exception('This should not be reached!');
    }


}
