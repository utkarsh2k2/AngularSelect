<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\CategoryType;
use AppBundle\Entity\Category;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();            
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('successpage');
        }

        return $this->render('default/index.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/success", name="successpage")
     */
    public function successAction(Request $request) {

        return $this->render('default/success.html.twig', array()
        );
    }

}
