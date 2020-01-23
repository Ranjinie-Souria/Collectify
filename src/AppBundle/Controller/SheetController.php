<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AudioSheet;
use AppBundle\Entity\Category;
use AppBundle\Entity\Sheet;
use AppBundle\FormType\AudioType;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\SheetRepository;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SheetController extends Controller
{
    /**
     * @Route("/sheet-list", name="list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Sheet');

        $sheets = $repository->findAll();

        return $this->render('Sheet/list.html.twig', array('sheets' => $sheets));
    }

    /**
     * @Route("/sheet/create", name="create")
     */
    public function createAction(Request $request){
        $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Category');
        $categories = $repository->findAll();
        return $this->render('Sheet/Create/create.html.twig', array('categories' => $categories));
    }

    /**
     * @Route("/sheet/create/{catName}", name="createCat")
     */
    public function createInCatAction(Request $request, $catName)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Category');
        $categories = $repository->findAll();
        if (isset($catName) && !empty($catName)) {
            $this->getCatForm($request, $catName);
        }
        return $this->render('Sheet/Create/create.html.twig', array('categories' => $categories));
    }

    public function getCatForm(Request $request, $catName)
    {
        $session = $this->get('session');

        $categorie = sprintf('%sSheet', ucfirst($catName));
        $type = sprintf('%sType::class', ucfirst($catName));

        $categorie = new $categorie();

        $form = $this->createFormBuilder($categorie)
            ->add($catName, $type, array('label' => ' '))
            ->add('submit', SubmitType::class, array('label' => 'Ajouter'))
            ->getForm();
        $form->handleRequest($request);

        if($request->isMethod('post')&&$form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->persist($form->getData());
            $em->flush();
            $session->getFlashBag()->add('flash', 'Objet ajouté !');
            return $this->render('Sheet/message.html.twig');
        }

        return $this->render(':Sheet/Create:create.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/sheet/{id}", name="show")
     */
    public function showAction($id)
    {

        $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Sheet');
        $sheet = $repository->find($id);

        if (!$sheet){
            throw new EntityNotFoundException();
        } // TODO Code très laid, créer une belle fonction getSheet() merci
        elseif ($sheet->getIdcategory() == 1) {
            $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:AudioSheet');
            $sheet = $repository->find($id);
            return $this->render('Sheet/show.html.twig', array('sheet' => $sheet));
        } elseif ($sheet->getIdcategory() == 2) {
            $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:VideoSheet');
            $sheet = $repository->find($id);
            return $this->render('Sheet/show.html.twig', array('sheet' => $sheet));
        } elseif ($sheet->getIdcategory() == 3) {
            $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:ImageSheet');
            $sheet = $repository->find($id);
            return $this->render('Sheet/show.html.twig', array('sheet' => $sheet));
        }
        return $this->render('Sheet/show.html.twig', array('sheet' => $sheet));
    }

    /**
     * @Route("/sheet/delete/{id}/{message}", name="delete")
     */
    public function deleteAction($id, $message)
    {


        $session = $this->get('session');
        if ($message) {
            return $this->render('Sheet/delete.html.twig', array('id' => $id));
        } else {
            $em = $this->getDoctrine()->getManager();
            $sheet = $em->getRepository('AppBundle:Sheet')->find($id);

            if ($sheet != null) {
                $em->remove($sheet);
                $em->flush();
                $session->getFlashBag()->add('flash', 'Objet retiré !');

                return $this->render('Sheet/message.html.twig');
            } else {
                $session->getFlashBag()->add('flash', 'Erreur, objet non trouvé !');
                return $this->render('Sheet/message.html.twig');
            }

        }
    }

    /**
     * @Route("/sheet/edit/{id}", name="edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $sheet = $em->getRepository('AppBundle:Sheet')->find($id);

        $form = $this->createFormBuilder($sheet)
            ->add('name', TextType::class, array('label' => 'Nom :'))
            ->add('type', TextType::class, array('label' => 'Type :'))
            ->add('artist', TextType::class, array('label' => 'Artiste :'))
            ->add('duration', TextType::class, array('label' => 'Durée :'))
            ->add('released', DateType::class, array('label' => 'Date :'))
            ->add('newImg', FileType::class, array('label' => 'Image :', 'required' => false))
            ->add('submit', SubmitType::class, array('label' => 'Modifier'))
            ->getForm();

        $form->handleRequest($request);

        if ($request->isMethod('post') && $form->isValid()) {
            $em->persist($form->getData());
            $em->flush();
            $session = $this->get('session');
            $session->getFlashBag()->add('flash', 'Objet édité !');
            return $this->render('Sheet/message.html.twig');
        }

        return $this->render('Sheet/edit.html.twig', array('form' => $form->createView()));
    }


}
