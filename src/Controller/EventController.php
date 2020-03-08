<?php

namespace App\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

use App\Form\EventType;
use App\Entity\Event;

/**
 * Class EventController
 * @package App\Controller
 * @Route("/api/v1/event", name="api.v1.event.")
 */
class EventController extends FOSRestController
{
    /**
     * @Rest\Get("/events", name="show")
     * @return Response
     */
    public function index()
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();
        return $this->render('event/index.html.twig', ['events'=>$events]);
        return $this->handleView($this->view($events));
    }

    /**
     * @Rest\Post("/add", name="create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $event = new Event();
        
        $form = $this->createForm(EventType::class);
        $data = json_decode($request->getContent(), true);

        $event->setName($data['name']);
        $event->setDescription($data['description']);

        $form->submit($data);

        // check if form has been submitted
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->handleView($this->view(['status'=>'ok', Response::HTTP_CREATED]));
        }

        return $this->handleView($this->view($form->getErrors()));

    }

    /**
     * @Rest\Get("/view/{id}", name="single")
     * @param Event $event
     * @return Response
     */
    public function single(Event $event)
    {
        return $this->handleView($this->view($event, 200, ['Content-Tpe'=>'application/json']));
    }

    /**
     * @Rest\Put("/view/{id}/edit", name="edit")
     * @param Request $request
     * @return Response
     */
    public function edit(Request $request)
    {

        $event = new Event();

        $post_data = json_decode($request->getContent(), true);

        $event->setId($request->get('id'));
        $event->setName($request->get('name'));
        $event->setDescription($request->get('description'));


        $em = $this->getDoctrine()->getManager();
        $em->refresh($event);
        $em->flush();


        return $this->handleView($this->view(['status'=>'success', Response::HTTP_CREATED])); // @TODO Look up code for this
    }

    
}
