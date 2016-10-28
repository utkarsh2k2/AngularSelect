<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\CategoryType;
use AppBundle\Entity\Category;

class DefaultController extends Controller {

    /**
     * @Route("/", options={"expose"=true}, name="homepage")
     */
    public function indexAction(Request $request) {

        //get the entity manager
        $em = $this->getDoctrine()->getManager();
        
        //Return tags associated with Category id.                                              
        if($request->isXmlHttpRequest()){
            //get the new categoryId recieved on category change(AJAX call)
            $categoryId = $request->request->get('cat_id');            
            //query the database for associated tag objects
            $tags = $this->getDoctrine()->getRepository('AppBundle:Tag')->getTagsByCategory($categoryId);
            //create a new response object and set the tags as content
            return $tags_json = new Response(json_encode($tags));            
        }
        
        //create new category object to pass in the form
        $category = new Category();
        //fetch the already selected category object based on its id (for now the 'id' is HARDCODED)
        $selectedcategory = $em->getRepository('AppBundle:Category')->findOneBy(array('id' => 1));
        //create the form and pass selectedcategory to the CategoryType instance
        $form = $this->createForm(new CategoryType($selectedcategory), $category);

        $form->handleRequest($request);
        
        //After Submission
        if ($form->isValid()) {
            //get the submitted category's id 
            $categoryId = $category->getCategoryname()->getId();
            
            //fetch the category object from database based on the categoryId recieved above
            $cat = $em->getRepository('AppBundle:Category')->findOneBy(array('id' => $categoryId));
            //fetch the associated tags if any
            $related_tags_arr = $cat->getTags()->getValues();
            //remove the tags
            for ($k = 0; $k < count($related_tags_arr); $k++) {
                $cat->removeTag($related_tags_arr[$k]);
            }

            // We need array of tag objects therefore collect it from the 0th index of the getTags function. 
            $selected_tags = $category->getTags()[0];
            if (!empty($selected_tags)) {
                //get the tags as an array of tag objects
                $tags_arr = $selected_tags->getTagname();
                //add the tags to the category object from database($cat)
                foreach ($tags_arr as $tag) {
                    $cat->addTag($tag);
                }
            }
            //persist the category object fetched from database($cat)
            //not the $category
            $em->persist($cat);
            $em->flush();

            return $this->redirectToRoute('successpage');
        }
            //pass the form object to the twig file and render the page
        return $this->render('default/index.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/success", options={"expose"=true}, name="successpage")
     */
    public function successAction(Request $request) {

        return $this->render('default/success.html.twig', array()
        );
    }
}
