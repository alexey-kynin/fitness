<?php

namespace EventBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

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

    public function viewAction($id)
    {
        $eventRepo = $this->getDoctrine()->getRepository('EventBundle:Event');
        $event = $eventRepo->find($id);
        if (!$event){
            throw $this->createNotFoundException("! There is no such thing.");
        }else{
            return $this->render('@Event/Page/view.html.twig', [
                'event' => $event
            ]);
        }

    }
}