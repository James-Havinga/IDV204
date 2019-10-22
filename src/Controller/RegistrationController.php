<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RegisterType;
use App\Entity\User;


class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register (Request $req, UserPasswordEncoderInterface $passwordEncoder)
    {
        $form = $this->createForm(RegisterType::class);
        $form->handleRequest($req);

        if ($form->isSubmitted()){
            $data = $form->getData();


            // Assign data to User Entity
            $user = new User();
            $user->setName($data['name']);
            $user->setEmail($data['email']);
            $user->setPassword(
                $passwordEncoder->encodePassword($user, $data['password'])
            );

            $file = $req->files->get('register')['image'];
            
            if ($file) {
                $filename = md5(uniqid()).'.'.$file->guessClientExtension();
                $file->move(
                    $this->getParameter('uploads_dir'), 
                    $filename
                );

                $user->setImage($filename);
               
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('app_login'));
        }
        return $this->render('registration/index.html.twig', [
           'form' => $form->createView(),
        ]);
    }
}
