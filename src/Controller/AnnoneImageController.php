<?php

namespace App\Controller;

use App\Entity\AnnoneImage;
use App\Form\AnnoneImageType;
use App\Repository\AnnoneImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/annone/image")
 */
class AnnoneImageController extends AbstractController
{
    /**
     * @Route("/", name="app_annone_image_index", methods={"GET"})
     */
    public function index(AnnoneImageRepository $annoneImageRepository): Response
    {
        return $this->render('annone_image/index.html.twig', [
            'annone_images' => $annoneImageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_annone_image_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AnnoneImageRepository $annoneImageRepository): Response
    {
        $annoneImage = new AnnoneImage();
        $form = $this->createForm(AnnoneImageType::class, $annoneImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annoneImageRepository->add($annoneImage, true);

            return $this->redirectToRoute('app_annone_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annone_image/new.html.twig', [
            'annone_image' => $annoneImage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_annone_image_show", methods={"GET"})
     */
    public function show(AnnoneImage $annoneImage): Response
    {
        return $this->render('annone_image/show.html.twig', [
            'annone_image' => $annoneImage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_annone_image_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, AnnoneImage $annoneImage, AnnoneImageRepository $annoneImageRepository): Response
    {
        $form = $this->createForm(AnnoneImageType::class, $annoneImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annoneImageRepository->add($annoneImage, true);

            return $this->redirectToRoute('app_annone_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annone_image/edit.html.twig', [
            'annone_image' => $annoneImage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_annone_image_delete", methods={"POST"})
     */
    public function delete(Request $request, AnnoneImage $annoneImage, AnnoneImageRepository $annoneImageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annoneImage->getId(), $request->request->get('_token'))) {
            $annoneImageRepository->remove($annoneImage, true);
        }

        return $this->redirectToRoute('app_annone_image_index', [], Response::HTTP_SEE_OTHER);
    }
}
