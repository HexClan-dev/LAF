<?php
/**
 * Created by PhpStorm.
 * User: whoami
 * Date: 17-08-02
 * Time: 11.32.PD
 */

namespace UserBundle\Security;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Acl\Exception\Exception;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use KnpU\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\DependencyInjection\ContainerInterface;

use UserBundle\Entity\Person;
use UserBundle\Form\LogInForm;


class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{

    private $formfactory;

    private $entity_manager;

    private $route;

    /** @var Person $person  */
    private $person= null;



    public function __construct(FormFactoryInterface $formFactory,EntityManager $em, RouterInterface $router)
    {


        $this->formfactory = $formFactory;

        $this->route = $router;

        $this->entity_manager = $em;


    }



    public function getCredentials(Request $request)
    {


        $isLoginSubmit = $request->getPathInfo()=='/login' && $request->isMethod('POST');

        if(!$isLoginSubmit)
        {
            // user has not submited the form
            return null;
        }

        $form  = $this->formfactory->create(LogInForm::class);
        $form->handleRequest($request);

        $data = $form->getData();

     // $request->getSession()->set(Security::LAST_USERNAME,$data['username']);

        return $data;


    }



    public function getUser($credentials, UserProviderInterface $userProvider)
    {


        $password = $credentials['password'];
        $username = $credentials['username'];

//        return $this->entity_manager->getRepository(Person::class)
//            ->findOneBy(['email'=>$username]);

        $person = $this->entity_manager->getRepository(Person::class)
            ->findOneBy(['email'=>$username,'password'=>$password]);

        $this->person = $person;

        if(!$person)
            throw new Exception("Not found ~/ ,  Soorryyyy");

        return $person;

    }


    public function checkCredentials($credentials, UserInterface $user)
    {

        return true;

    }



    protected function getLoginUrl()
    {

        return new RedirectResponse($this->route->generate('login'));

    }



    protected function getDefaultSuccessRedirectUrl()
    {

        
        if(!$this->person)
        {
            throw new Exception('The user was not found');
        }

        return new RedirectResponse($this->route->generate('user_main_page',['id'=>$this->person->getId()]));


    }

}
