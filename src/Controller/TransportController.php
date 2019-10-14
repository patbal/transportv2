<?php

namespace App\Controller;
use App\Entity\Adresse;
use App\Entity\Nuance;
use App\Form\NuanceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class TransportController extends AbstractController
{
    /**
     * @Route("/form", name="form")
     */
    public function testForm(Request $request)
    {

        $nuance = new Nuance();
        $form = $this -> createForm(NuanceType::class, $nuance);
        $form->handleRequest($request);
		$em = $this -> getDoctrine() -> getManager();

		if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($nuance);
            $em -> flush();
            $this -> addFlash('notice', 'nuance recorded');
            return $this -> redirectToRoute('form');
        }

		return $this -> render('/transport/form.html.twig', array('form' => $form -> createView()));
    }

    /**
     * @Route("/", name="index")
     */
    public function index(){
        $a = 'Transport|Controller';
        return $this->render('/transport/index.html.twig', [
            'controller_name' => $a,

        ]);
    }

    /**
     * @Route("/adresses", name="adresses")
     */
    public function viewAdresses(){
        $listeAdresse = $this
            -> getDoctrine()
            -> getManager()
            -> getRepository(Adresse::class)
            -> findAll();

        return $this -> render('/transport/listeAdresses.html.twig', array('listeAdresses' => $listeAdresse));
    }

}

