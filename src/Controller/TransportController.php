<?php

namespace App\Controller;
use App\Entity\Adresse;
use App\Entity\Contact;
use App\Entity\Nuance;
use App\Entity\Transport;
use App\Entity\Transporteur;
use App\Form\AdresseType;
use App\Form\ContactType;
use App\Form\NuanceType;
use App\Form\TransporteurType;
use App\Form\TransportType;
use PhpParser\Node\Scalar\String_;
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


// *******************************************
// ADRESSES
// *******************************************
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


// *******************************************
// CONTACTS
// *******************************************
    /**
     * @Route("/contacts", name="contacts")
     */
    public function viewContacts(){
        $listeContact = $this
            -> getDoctrine()
            -> getManager()
            -> getRepository(Contact::class)
            -> findBy(array(), array('nom'=>'ASC'));

        return $this -> render('transport/listeContacts.html.twig', array('listeContacts' => $listeContact));
    }

    /**
     * @Route("/contact/{id}", name="editContact")
     */
    public function editContact(Contact $contact, Request $request){
        $form = $this -> createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($contact);
            $em -> flush();
            $this -> addFlash('info', 'la fiche de "'.$contact->getPrenom().' '.$contact->getNom().'" a été mise à jour');
            return $this -> redirectToRoute('editContact', ['id'=> $contact->getId()]);
        }

        return $this -> render('/transport/editContact.html.twig', ['form' => $form -> createView(), 'contact'=>$contact]);

    }

    /**
     * @Route("/delete/contact/{id}", name="deleteContact")
     */
    public function deleteContact(Contact $contact, Request $request){
        if (null === $contact)
        {
            throw new NotFoundHttpException("Cette personne n'existe pas (dans notre base, hein).");
        }

        $em = $this->getDoctrine()->getManager();
        $em -> remove($contact);
        $this -> addFlash('info', 'la fiche de "'.$contact->getPrenom().' '.$contact->getNom().'" a été supprimée');
        $em -> flush();

        return $this -> redirectToRoute('contacts');
    }

    /**
     * @Route("/ajout/contact", name="ajoutContact")
     */
    public function ajoutContact(Request $request){
        $contact = new Contact();
        $form = $this -> createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($contact);
            $em -> flush();
            $this -> addFlash('info', 'le contact "'.$contact->getPrenom().' '.$contact->getNom().'" a été crée');
            return $this -> redirectToRoute('contacts');
        }

        return $this -> render('transport/ajoutContact.html.twig', ['form' => $form -> createView(), 'contact'=>$contact]);

    }


// *******************************************
// TRANSPORTEURS
// *******************************************
    /**
     * @Route("/ajout/transporteur", name="ajoutTransporteur")
     */
    public function ajoutTransporteur(Request $request){
        $transporteur = new Transporteur();
        $form = $this -> createForm(TransporteurType::class, $transporteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($transporteur);
            $em -> flush();
            $this -> addFlash('info', 'le fournisseur "'.$transporteur->getNom().'" a été crée');
            return $this -> redirectToRoute('transporteurs');
        }

        return $this -> render('transport/ajoutTransporteur.html.twig', ['form' => $form -> createView(), 'transporteur'=>$transporteur]);

    }

    /**
     * @Route("/transporteur/{id}", name="editTransporteur")
     */
    public function editTransporteur(Transporteur $transporteur, Request $request){
        $form = $this -> createForm(TransporteurType::class, $transporteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($transporteur);
            $em -> flush();
            $this -> addFlash('info', 'la fiche "'.$transporteur->getNom().'" a été mise à jour');
            return $this -> redirectToRoute('editTransporteur', ['id'=> $transporteur->getId()]);
        }

        return $this -> render('transport/editTransporteur.html.twig', ['form' => $form -> createView(), 'transporteur'=>$transporteur]);

    }

    /**
     * @Route("/transporteurs", name="transporteurs")
     */
    public function viewTransporteurs(){
        $listeTransporteur = $this
            -> getDoctrine()
            -> getManager()
            -> getRepository(Transporteur::class)
            -> findBy(array(), array('nom'=>'ASC'));

        return $this -> render('transport/listeTransporteurs.html.twig', array('listeTransporteurs' => $listeTransporteur));
    }

    /**
     * @Route("/delete/transporteur/{id}", name="deleteTransporteur")
     */
    public function deleteTransporteur(Transporteur $transporteur, Request $request){
        if (null === $transporteur)
        {
            throw new NotFoundHttpException("Ce fournisseur n'existe pas (dans notre base, hein).");
        }

        $em = $this->getDoctrine()->getManager();
        $em -> remove($transporteur);
        $this -> addFlash('info', 'la fiche  "'.$transporteur->getNom().'" a été supprimée');
        $em -> flush();

        return $this -> redirectToRoute('transporteurs');
    }

    // *******************************************
    // TRANSPORTS
    // *******************************************
    /**
     * @Route("/transports", name="transports")
     */
    public function viewTransports(){
        $listeTransports = $this
            -> getDoctrine()
            -> getManager()
            -> getRepository(Transport::class)
            -> findBy(array(), array('id'=>'DESC'));

        return $this -> render('/transport/listeTransports.html.twig', array('listeTransports' => $listeTransports));
    }

    /**
     * @Route("/ajout/transport/{type}", name="ajoutTransport")
     */
    public function ajoutTransport(Request $request, String $type){
        $transport = new Transport();

        if ($type !== 'course' && $type !== 'location' && $type !== 'transport'){
            throw new NotFoundHttpException("merci de ne pas modifier manuellement l'adresse");
        }

        $transport -> setTypeDemande($type);
        if ($type=='course'){$prefixe = 'CRS';}
        if ($type=='transport'){$prefixe = 'TR';}
        if ($type=='location'){$prefixe = 'RNT';}

        $now = new \DateTime();

        $lastTransport = $this->getDoctrine()->getManager()-> getRepository(Transport::class)->findOneBy([], ['id' => 'desc']);
        $lastId = $lastTransport->getId();
        $newId = $lastId + 1;

        $form = $this -> createForm(TransportType::class, $transport);
        $form->handleRequest($request);
        $numeroDemande = $prefixe.$now->format('Y').$now->format('m').'-'.$newId;

        if ($form->isSubmitted() && $form->isValid())
        {
            $transport->setNumeroDemande($numeroDemande);

            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($transport);
            $em -> flush();
            $this -> addFlash('info', 'le transport "'.$transport->getNumeroDemande().'" a été créé');
            return $this -> redirectToRoute('transports');
        }

        return $this -> render('transport/ajoutTransport.html.twig', ['form' => $form -> createView(), 'transport'=>$transport, 'numeroDemande' => $numeroDemande, 'type' => $type]);

    }

}

