<?php

namespace AppBundle\Service;



use AppBundle\Entity\Item;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class ItemFinder
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Find new item to vote for user
     *
     * @param User $user
     * @return array
     */
    public function getItemForUser(User $user)
    {
     $items = $this->em->getRepository('AppBundle:Item')->findAll();
     $results = array();
     foreach ($items as $item){
        $asAlreadyVoted = $this->UserAlreadyVoted($user,$item);
        if (!$asAlreadyVoted){
            $results[] = $item;
        }
     }
     return $results;

    }

    /**
     * Return true if user already voted for that items
     *
     * @param User $user
     * @param Item $item
     * @return bool
     */
    public function UserAlreadyVoted(User $user, Item $item)
    {
        $vote = $this->em->getRepository('AppBundle:Vote')->findBy(['user' => $user, 'item' => $item]);

        if ($vote){
            return true;
        }

        return false;
    }

    /**
     * return an array containg the item with the most votes for each itemCategory
     *
     * @return array
     */
    public function findWinnerForEachCategory(){
        $categories = $this->em->getRepository('AppBundle:ItemCategory')->findAll();

        $winners = array();
        foreach ($categories as $category){
            $items = $this->em->getRepository('AppBundle:Item')->findBy(['category' => $category]);
            /**
             * @var Item $lastObj
             */
            $lastObj = null;
            foreach ($items as $item){

                if (array_key_exists($category->getSlug(),$winners) && count($winners[$category->getSlug()]['1']->getVotes()) > count($item->getVotes())){
                }else{
                    $winners[$category->getSlug()]['1'] = $item;
                }

            }
        }

        return $winners;
    }
}

