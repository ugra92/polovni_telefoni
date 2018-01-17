<?php
namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppController extends Controller
{
    /**
    * @Route("/", name="homepage")
    */
    public function homepage()
    {
        return $this->render('layout/homepage.html.twig', array(
        ));
    }

    /**
     * @Route("/user")
     */
    public function user()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }

    /**
     * @Route("/add-admin")
     */
    public function addUser(UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();
        $admin = new User();
        $admin->setEmail('ugra1992@gmail.com');
        $admin->setUsername('admin');
        $admin->setIsActive(1);
        $encoded = $encoder->encodePassword($admin, 'admin');
        $admin->setPassword($encoded);
        $em->persist($admin);
        $em->flush();
        exit;
    }

}