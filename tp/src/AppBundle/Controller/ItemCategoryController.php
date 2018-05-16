<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ItemCategory;
use AppBundle\Service\ItemFinder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ItemCategoryController extends Controller
{
    /**
     * @Route("/item-category/list", name="item_category_list")
     */
   public function listAction(ItemFinder $itemFinder)
   {
       $em = $this->getDoctrine()->getManager();
       $winners = $itemFinder->findWinnerForEachCategory();
       $list = $em->getRepository('AppBundle:ItemCategory')->findAll();

        return $this->render('itemCategory/list.html.twig',['list' => $list, 'winners' => $winners]);
   }

    /**
     * @Route("/item-category/{slug}", name="item_category_detail")
     */
   public function detailAction(ItemCategory $itemCategory, ItemFinder $itemFinder )
   {
       $winners = $itemFinder->findWinnerForEachCategory();
       $listOfItems = $this->getDoctrine()->getRepository('AppBundle:Item')->findBy(['category' => $itemCategory]);
       usort($listOfItems, function($a, $b) {
           return count($a->getVotes() )- count($b->getVotes());
       });
       dump($listOfItems);
       $items = $itemFinder->getItemForUser($this->getUser(),$itemCategory);
       return $this->render('itemCategory/detail.html.twig',['items' => $items,'winners' => $winners,'itemCategory' => $itemCategory,'lines' => $listOfItems]);
   }
}
