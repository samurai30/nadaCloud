<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\PostImages;
use App\Entity\User;
use App\Form\PostType;
use App\Repository\PostImagesRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    /**
     * PostController constructor.
     * @param FlashBagInterface $flashBag
     */
    public function __construct(FlashBagInterface $flashBag)
    {
        $this->flashBag = $flashBag;
    }

    /**
     * @Route("/PostIndex", name="Post_Index")
     */
    public function Posts(UserRepository $userRepository,PostRepository $postRepository,PostImagesRepository $imagesRepository){

        return $this->render('post/post.html.twig',[
            'posts' => $postRepository->findAll(),
        ]);
    }

    /**
     * @Route("/UserPost/{username}", name="User_Post")
     * @param User $userPost
     * @param PostRepository $postRepository
     * @return \Symfony\Component\HttpFoundation\Response

     */
    public function UserPost(User $userPost,PostRepository $postRepository){

        return $this->render('post/userPost.html.twig',[
            'posts' => $postRepository->findBy(['User'=>$userPost]),
            'user' => $userPost
        ]);

    }
    /**
     * @Route("/post_add", name="post_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response

     */
    public function PostRegister(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class,$post,[
            'action' => $this->generateUrl('post_add')
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $this->getUser();
            $username = $user->getUsername();
            $enty = $this->getDoctrine()->getManager();
            $files = $request->files->get('post')['Images'];
            $upload = $this->getParameter('post_images');
            $uploadPath = $upload.'/'.$username;
            foreach ($files as $file){
                $filename = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($uploadPath,$filename);
                $images = new PostImages();
                $images->setPost($post);
                $images->setImagePath($filename);
                $enty->persist($images);
            }
            $post->setUser($user);


            $enty->persist($post);
            $enty->flush();
            $this->flashBag->add('notice', 'Post Added');
            return $this->redirectToRoute('default_index');
        }
        return $this->render('post/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/deletePost/{id}", name="deletePost")
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deletePost(Post $post){
       $em= $this->getDoctrine()->getManager();
       $em->remove($post);
       $em->flush();

        $this->flashBag->add('notice', 'Post Delete');

        return $this->redirectToRoute('default_index');
    }

}
