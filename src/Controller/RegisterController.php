<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     * @param UserPasswordEncoderInterface $encoder
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function register(UserPasswordEncoderInterface $encoder,Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class,$user,[
            'action' => $this->generateUrl('register')
        ]);


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
        $file = $request->files->get('user')['profilePicPath'];
            $upload_profile = $this->getParameter('profile_pic');

            $filename = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
              $upload_profile,$filename
            );

        $user->setProfilePicPath($filename);
        $password = $encoder->encodePassword($user,$user->getPlainPassword());
        $user->setPassword($password);
        $entiyMan = $this->getDoctrine()->getManager();
        $entiyMan->persist($user);
        $entiyMan->flush();
        return $this->redirectToRoute('default_index');
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
