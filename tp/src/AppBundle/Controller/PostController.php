<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Post controller.
 *
 * @Route("post")
 */
class PostController extends Controller
{
    /**
     * Finds and displays a post entity.
     *
     * @Route("/{slug}", name="post_detail")
     * @param Post $post
     * @return Response
     */
    public function showAction(Post $post)
    {
        return $this->render('post/show.html.twig', array(
            'post' => $post,
        ));
    }
}
