<?php

namespace App\Controller;
use App\Entity\Adresse;
use App\Entity\Nuance;
use App\Form\AdresseType;
use App\Form\NuanceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
            -> findBy(array(), array('nom'=>'ASC'));

        return $this -> render('/transport/listeAdresses.html.twig', array('listeAdresses' => $listeAdresse));
    }

    /**
     * @Route("/adresse/{id}", name="editAdresse")
     */
    public function editAdresse(Adresse $adresse, Request $request){
        $form = $this -> createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($adresse);
            $em -> flush();
            $this -> addFlash('info', 'l\'adresse "'.$adresse->getNom().'" a été mise à jour');
            return $this -> redirectToRoute('editAdresse', ['id'=> $adresse->getId()]);
        }

        return $this -> render('/transport/editAdresse.html.twig', ['form' => $form -> createView(), 'adresse'=>$adresse]);

    }

    /**
     * @Route("/ajout/adresse", name="ajoutAdresse")
     */
    public function ajoutAdresse(Request $request){
        $adresse = new Adresse();
        $form = $this -> createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($adresse);
            $em -> flush();
            $this -> addFlash('info', 'l\'adresse "'.$adresse->getNom().'" a été crée');
            return $this -> redirectToRoute('adresses');
        }

        return $this -> render('transport/ajoutAdresse.html.twig', ['form' => $form -> createView(), 'adresse'=>$adresse]);

    }

    /**
     * @Route("/delete/adresse/{id}", name="deleteAdresse")
     */
    public function deleteAdresse(Adresse $adresse, Request $request){
        if (null === $adresse)
        {
            throw new NotFoundHttpException("Cette adresse n'existe pas.");
        }

        $em = $this->getDoctrine()->getManager();
        $em -> remove($adresse);
        $this -> addFlash('info', 'l\'adresse "'.$adresse->getNom().'" a été supprimée');
        $em -> flush();

        return $this -> redirectToRoute('adresses');
    }

}

