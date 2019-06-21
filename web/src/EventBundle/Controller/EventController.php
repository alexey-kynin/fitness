<?php

namespace EventBundle\Controller;


use CoreBundle\Core\Core;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\ORMException;
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

        $user = $this->getUser();

        return $this->render('@Event/Page/list.html.twig', [
            'events' => $event,
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
                if (is_null($user)){
                    return $this->redirectToRoute('security_login');
                }else{
                    try{
                        $userEvent = $subscribeModal->subscribeUser($user ,$event);
                        $em = Core::em();
                        $em->persist($userEvent);
                        $em->flush();
                        $message = 'Done';
                        return $this->redirectToRoute('event_view', ['id' => $event->getId()]);

                    }catch (DBALException $e) {
                        $message = sprintf('DBALException [%i]: %s', $e->getCode(), $e->getMessage());
                    } catch (\PDOException $e) {
                        $message = sprintf('PDOException [%i]: %s', $e->getCode(), $e->getMessage());
                    } catch (ORMException $e) {
                        $message = sprintf('ORMException [%i]: %s', $e->getCode(), $e->getMessage());
                    } catch (\Exception $e) {
                        $message = sprintf('Exception [%i]: %s', $e->getCode(), $e->getMessage());
                    }
//                    echo $message;
                }
            }

            return $this->render('@Event/Page/view.html.twig', [
                'event' => $event,
                'user' => $user,
                'subscribe_form' => $subscribeForm->createView(),
//                'message' => $message
            ]);
        }
    }


}