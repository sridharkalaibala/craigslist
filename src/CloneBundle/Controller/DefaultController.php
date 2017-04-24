<?php

namespace CloneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


use CloneBundle\Form\Type\FeedType;
use CloneBundle\Document\Feed;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        return $this->render('CloneBundle:Feed:home.html.twig', array());
    }

    /**
     * @Route("/post", name="post")
     */
    public function postAction()
    {
        $form = $this->createForm(new FeedType($this->getParameter('locations'), $this->getParameter('categories')), new Feed(),array(
            'action' => $this->generateUrl('create'),
            'method' => 'POST',
        ));
        return $this->render('CloneBundle:Feed:post.html.twig', array('createForm' => $form->createView()));
    }


    /**
     * @Route("/create", name="create")
     */
    public function createAction(Request $request)
    {
        $session = new Session();
        $dm = $this->get('doctrine.odm.mongodb.document_manager');

        $form = $this->createForm( new FeedType($this->getParameter('locations'), $this->getParameter('categories')),  new Feed());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registration = $form->getData();
            $dm->persist($registration);
            $dm->flush();
            // set flash messages
            $session->getFlashBag()->add('success', 'Your Post Posted Successfully !!!');

          return $this->redirect($this->generateUrl('Details').'?id='.$registration->getId());
        }

        return $this->render('CloneBundle:Feed:post.html.twig', array('createForm' => $form->createView()));
    }

    /**
     * @Route("/getSubCategories", name="getSubCategories")
     */
    public function getSubCategoriesAction(Request $request)
    {

        $categories = $this->getParameter('categories');
        $main_category = $request->query->get('main_category');
        if(!isset($main_category))
            throw new InvalidParameterException('Invalid parameter');
        return new JsonResponse($categories[$main_category]);
    }


    /**
     * @Route("/getData", name="getData")
     */
    public function getDataAction(Request $request)
    {
        $categories = $this->getParameter('categories');
        $categories['feed_locations'] = $this->getParameter('locations');
        return new JsonResponse($categories);
    }

    /**
     * @Route("/list", name="showList")
     */
    public function showList(Request $request)
    {
        $main_category = $request->query->get('main');
        $sub_category = $request->query->get('sub');
        $location = $request->query->get('location');
        $feeds = $this->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('CloneBundle:Feed')
            ->field('main_category')->equals($main_category)
            ->field('sub_category')->equals($sub_category)
            ->field('location')->equals($location)
            ->hydrate(false)
            ->getQuery()
            ->toArray();

        $data = ['main_category'=>$main_category,'sub_category'=>$sub_category, 'feeds'=>$feeds];
        return $this->render('CloneBundle:Feed:list.html.twig', $data);

    }

    /**
     * @Route("/details", name="Details")
     */
    public function showDetails(Request $request)
    {
        $id = $request->query->get('id');
        if(!isset($id))
            throw new InvalidParameterException('Invalid parameter');
        $repository = $this->get('doctrine_mongodb')
            ->getManager()
            ->getRepository('CloneBundle:Feed');
        $feed = $repository->findOneById($id);
        if(!isset($feed))
            throw new  NotFoundHttpException('Details not available');
        $data = ['feed'=>$feed];
        return $this->render('CloneBundle:Feed:details.html.twig', $data);

    }



}
