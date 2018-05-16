<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Entity\User;
use AppBundle\Service\ItemFinder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request,ItemFinder $itemFinder)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $securityContext = $this->container->get('security.authorization_checker');
        $items = null;
        $last5UserVotes = null;
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY') or $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            $items = $itemFinder->getItemForUser($user);
            shuffle($items);
            $last5UserVotes = $em->getRepository('AppBundle:Vote')->findLast5VoteForUser($user);
        }

        $lastVotes = $em->getRepository('AppBundle:Vote')->findXLastVotes(10);
        return $this->render('default/index.html.twig', ['items' => $items,'lastVotes' => $lastVotes,'lastUserVotes' => $last5UserVotes]);
    }

    /**
     * @Route("/search", name="searchhp", defaults={"word" = false})
     * @Route("/search/{word}", name="search")
     */
    public function searchAction(Request $request, $word)
    {
        $em = $this->getDoctrine()->getManager();
        $news = [];

        if ($word) {
            $news = $this->getDoctrine()->getRepository('AppBundle:Post')->search($word);
        }else{
            $news = $em->getRepository("AppBundle:Post")->findBy(['enable' => true]);
        }
        $searchForm = $this->createFormBuilder()
            ->add('word', TextType::class, ['label' => 'Recherche'])
            ->add('submit', SubmitType::class, ['label' => 'Envoyer'])
        ->getForm();

        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $data = $searchForm->getData();
            $news = $this->getDoctrine()->getRepository('AppBundle:Post')->search($data['word']);
        }

        // replace this example code with whatever you need
        return $this->render('default/search.html.twig', [
            'news' => $news,
            'form' => $searchForm->createView(),
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    
    /**
     * @Route("/presentation", name="presentation_page")
     */
    public function presentationPageAction()
    {
        $message = 'Bienvenue sur la page de présentation';

        return $this->render('default/presentation.html.twig', ['message' => $message]);
    }
}
