<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Item;
use AppBundle\Entity\Vote;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class VoteController extends Controller
{
    /**
     * @Route("/vote/{slug}", name="voteForItem")
     *
     * @param Item $item
     * @return Response
     */
    public function VoteAction(Item $item)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $vote = new Vote();

        $vote->setUser($user);
        $vote->setItem($item);

        $em->persist($vote);
        $em->flush();

        return new Response('voted');

    }
}
