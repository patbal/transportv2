<?php

namespace App\Controller;
use App\Entity\CouleurComplete;
use App\Entity\Teinte;
use App\Form\CouleurCompleteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class TransportController extends AbstractController
{
    /**
     * @Route("/form", name="form")
     */
    public function testForm(Request $request)
    {

        $couleur = new couleurComplete();
        $form = $this -> createForm(CouleurCompleteType::class, $couleur);
        $form->handleRequest($request);
		$em = $this -> getDoctrine() -> getManager();

		if ($form->isSubmitted() && $form->isValid())
        {

            return $this -> redirectToRoute('index');
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
     * @Route("/data/{couleur}", name="teinteRequest")
     */
    public function teinteRequest($couleur){
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Teinte::class)->findBy(['couleur'=>$couleur]);
        foreach ($rep as $elm){
            $vals[] = $elm->getTeinte();
        }


        return new JsonResponse($vals);
    }

}

