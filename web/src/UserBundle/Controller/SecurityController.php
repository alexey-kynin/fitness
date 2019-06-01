<?php

namespace UserBundle\Controller;


use CoreBundle\Core\Core;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use UserBundle\Entity\UserAccount;
use UserBundle\Form\LoginForm;
use UserBundle\Form\RecoverUserForm;
use UserBundle\Form\Models\RecoverUserModel;
use UserBundle\Form\Models\RegisterUserModel;
use UserBundle\Form\RegisterUserForm;


class SecurityController extends Controller
{
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('@User/security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    public function logoutAction()
    {
        throw new \Exception('!!!this should not be reached!');
    }

    public function registerAction(Request $request)
    {
        $registerModal = new RegisterUserModel();
        $registerForm = $this->createForm(RegisterUserForm::class, $registerModal);
        $registerForm->handleRequest($request);
        if ($registerForm->isSubmitted()){
            $user = $registerModal->getUserHandler();

            $em = Core::em();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('security_login');
        }

        return $this->render('@User/security/register.html.twig' ,[
            'register_form' => $registerForm->createView()
        ]);
    }

    public function recoverAction($token, Request $request)
    {
//        $recoverPasswordServices = $this->get('user.security.recover');
//        $recoverPasswordServices->sendEmail();

        if($token){
            /**
             * @var UserAccount $userAccountRecover
             */
            $userAccountRecover = $this->getDoctrine()->getRepository("UserBundle:UserAccount")->findOneByTokenRecover($token);
            if ($userAccountRecover){
                $userPasswordToken = new UsernamePasswordToken($userAccountRecover->getUser(), null, 'our_users' , $userAccountRecover->getUser()->getRoles());
                /** Вставляем в сессию созданный токен */
                $this->get('security.token_storage')->setToken($userPasswordToken);
                return $this->redirectToRoute('user_password_recover');
            }

        }

        $registerModal = new RecoverUserModel();
        $recoverForm = $this->createForm(RecoverUserForm::class, $registerModal);
        $recoverForm->handleRequest($request);
        if($recoverForm->isSubmitted()){
            $email = $registerModal->getEmail();
            $user = $this->getDoctrine()->getRepository('UserBundle:User')->findOneByEmail($email);
            if($user){
                $this->get('user.security.recover')->sendEmail($user);
            }
            return$this->redirectToRoute('recover');
        }

        return $this->render('@User/security/recover.html.twig', [
            'recover_form' => $recoverForm->createView()
        ]);
    }
}