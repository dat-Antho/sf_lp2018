<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ItemCategoryController extends Controller
{
    /**
     * @Route("/item-category/list", name="item_category_list")
     */
   public function listAction()
   {
       $em = $this->getDoctrine()->getManager();
       $list = $em->getRepository('AppBundle:ItemCategory')->findAll();

        return $this->render('itemCategory/list.html.twig');
   }
}
