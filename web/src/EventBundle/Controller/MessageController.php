<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 23.06.2019
 * Time: 18:55
 */

namespace EventBundle\Controller;


use EventBundle\Form\Models\MessageModel;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use EventBundle\Form\MessageForm;


class MessageController extends CRUDController
{

    public function messageAction(Request $request)
    {

        $messageModal = new MessageModel();
        $messageForm = $this->createForm(MessageForm::class, $messageModal);
        $messageForm->handleRequest($request);

        $this->get('user.security.recover')->sendEmail($this->getUser());

        $this->addFlash('sonata_flash_success', 'Cloned successfully');
//        return new RedirectResponse($this->admin->generateUrl('list'));

        return $this-> render('@Event/Page/view.html.twig', [
            'event' => $event,
            'user' => $user,
            'subscribe_form' => $subscribeForm->createView(),
//                'message' => $message
        ]);
    }
}