<?php

namespace EventBundle\Controller;


use CoreBundle\Core\Core;
use EventBundle\Form\Models\SubscribeToEventModel;
use EventBundle\Form\SubscribeToEventForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class EventController extends Controller
{
    public function listAction()
    {
        $eventRepo = $this->getDoctrine()->getRepository('EventBundle:Event');
        $event = $eventRepo->findAll();
        return $this->render('@Event/Page/list.html.twig', [
            'events' => $event
        ]);
    }

    public function viewAction($id, Request $request)
    {
        $eventRepo = $this->getDoctrine()->getRepository('EventBundle:Event');
        $event = $eventRepo->find($id);
        if (!$event){
            throw $this->createNotFoundException("! There is no such thing.");
        }else{
            $user = $this->getUser();

            $subscribeModal = new SubscribeToEventModel();
            $subscribeForm = $this->createForm(SubscribeToEventForm::class, $subscribeModal);
            $subscribeForm->handleRequest($request);
            if($subscribeForm->isSubmitted()){
                $userEvent = $subscribeModal->subscribeUser($user ,$event);
                $em = Core::em();
                $em->persist($userEvent);
                $em->flush();
            }

            return $this->render('@Event/Page/view.html.twig', [
                'event' => $event,
                'subscribe_form' => $subscribeForm->createView()
            ]);
        }
    }


}