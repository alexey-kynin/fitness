<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Form\AdminLoginForm;

final class AdminController extends Controller
{
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

//        $form = $this->createForm(AdminLoginForm::class, [
//            'email' => $authenticationUtils->getLastUsername()
//        ]);
//        $form = $this->createForm(AdminLoginForm::class);

        return $this->render('@User/security/adminlogin.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
//            'form' => $form->createView(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    public function logoutAction()
    {
        // Left empty intentionally because this will be handled by Symfony.
    }

    public function checkAction(Request $request) {
        // do something
    }
}