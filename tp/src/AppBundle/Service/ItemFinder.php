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
}

