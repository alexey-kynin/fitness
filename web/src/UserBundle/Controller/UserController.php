<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 31.05.2019
 * Time: 14:06
 */

namespace UserBundle\Controller;


use CoreBundle\Core\Core;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\ChangePasswordForm;
use UserBundle\Form\Models\ChangePasswordModal;

class UserController extends Controller
{
    public function viewAction($id)
    {
        $userRepo = $this->getDoctrine()->getRepository('UserBundle:User');
        $user = $userRepo->find($id);

        if (!$user){
            throw $this->createNotFoundException("No such user.");
        }else{
            return $this->render('@User/user/view.html.twig', [
                'user' => $user
            ]);
        }
    }


    public function recoverPasswordAction(Request $request)
    {
        /**
         * @var User $user
         */
        $user = $this->getUser();
        $userAccount = $user->getAccount();
        if(!$userAccount->getTokenRecover()){
            return $this->redirectToRoute('user');
        }

        $changePasswordModal = new ChangePasswordModal();
        $formChangePassword = $this->createForm(ChangePasswordForm::class, $changePasswordModal);
        $formChangePassword->handleRequest($request);
        if ($formChangePassword->isSynchronized() && $formChangePassword->isValid()){
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $changePasswordModal->password);
            $user->setPassword($password);
            $userAccount->setTokenRecover(null);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_view', ['id' => $user->getId()]);
        }

        return $this->render('@User/security/recover.html.twig', [
            'recover_form' => $formChangePassword->createView()
        ]);
    }
}