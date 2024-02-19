<?php

namespace App\Controller;

use App\Entity\Entrainements;
use App\Entity\Exercices;
use App\Form\EntrainementsType;
use App\Form\EntrainementsSearchType;
use App\Repository\EntrainementsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/entrainements')]
class EntrainementsController extends AbstractController
{
    #[Route('/', name: 'app_entrainements_index', methods: ['GET'])]
    public function index(EntrainementsRepository $entrainementsRepository): Response
    {
        return $this->render('entrainements/index.html.twig', [
            'entrainements' => $entrainementsRepository->findAll(),
        ]);
    }

    #[Route('/buttonNav', name: 'app_entrainements_buttonNav', methods: ['GET'])]
     public function buttonNav(EntrainementsRepository $entrainementsRepository): Response
    {
        return $this->render('entrainements/ButtonNav.html.twig', [
            'entrainements' => $entrainementsRepository->findAll(),
        ]);
    }


    #[Route('/image1', name: 'imagee1', methods: ['GET'])]
    public function image1(): Response
    {
        return $this->render('entrainements/image1.html.twig');
    }

    #[Route('/image2', name: 'imagee2', methods: ['GET'])]
    public function image2(): Response
    {
        return $this->render('entrainements/image2.html.twig');
    }

    #[Route('/imagepertede', name: 'imagee3', methods: ['GET'])]
    public function image3(): Response
    {
        return $this->render('entrainements/image3.html.twig');
    }


    #[Route('/imageperteex', name: 'imagee4', methods: ['GET'])]
    public function image4(): Response
    {
        return $this->render('entrainements/image4.html.twig');
    }




    #[Route('/new', name: 'app_entrainements_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        $entrainement = new Entrainements();
        $form = $this->createForm(EntrainementsType::class, $entrainement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Si le formulaire est soumis et valide, persistez et flush votre entité
            $entityManager->persist($entrainement);
            $entityManager->flush();

            // Redirigez l'utilisateur vers une autre page après la soumission réussie
            return $this->redirectToRoute('app_entrainements_index', [], Response::HTTP_SEE_OTHER);
        }

        // Valider l'entité avec ValidatorInterface si le formulaire a été soumis
        $errors = [];
        if ($form->isSubmitted()) {
            $violations = $validator->validate($entrainement);
            foreach ($violations as $violation) {
                $errors[$violation->getPropertyPath()] = $violation->getMessage();
            }
        }

        // Afficher le formulaire avec les éventuelles erreurs de validation
        return $this->renderForm('entrainements/new.html.twig', [
            'entrainement' => $entrainement,
            'form' => $form,
            'errors' => $errors, // Passer les erreurs au template
        ]);
    }


    #[Route('/search', name: 'app_entrainements_search', methods: ['GET', 'POST'])]
public function search(Request $request, EntityManagerInterface $entityManager): Response
{
    // Use a query builder for flexibility and potential performance improvements
    $queryBuilder = $entityManager->createQueryBuilder();
    $queryBuilder->select('e')
                 ->from(Entrainements::class, 'e');

    $form = $this->createForm(EntrainementsSearchType::class); // Create form without entity
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
       
        $formData = $form->getData();
       
        // Add search criteria dynamically using query builder
        $queryBuilder ->where('e.objectif = :objectif')
                      ->andWhere("e.niveau= :niveau")
                      ->andWhere("e.periode= :periode");
        $queryBuilder->setParameter('objectif', $formData ->getObjectif())
                     ->setParameter('niveau', $formData ->getNiveau())
                     ->setParameter('periode', $formData ->getPeriode());

        $entrainements = $queryBuilder->getQuery()->getResult();

        return $this->render('entrainements/ButtonNav.html.twig', [
            'entrainements' => $entrainements,
        ]);
    }

    return $this->renderForm('entrainements/search.html.twig', [
        'form' => $form,
    ]);
}

/*
    #[Route('/search', name: 'app_entrainements_search', methods: ['GET', 'POST'])]
    public function search(Request $request, EntityManagerInterface $entityManager): Response
    {   
        $entrainement = new Entrainements();
        $form = $this->createForm(EntrainementsSearchType::class,$entrainement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             // Get form data
        $formData = $form->getData();

        // Build an array of search criteria
        $criteria = [];

        // Check if each field has a value and add it to the search criteria
        if (!empty($formData.niveau)) {
            $criteria['niveau'] = $formData['niveau'];
        }
        if (!empty($formData.objectif)) {
            $criteria['objectif'] = $formData['objectif'];
        }
        // Add more conditions as needed for other fields

        // Perform search based on form data
        $entrainements = $entityManager->getRepository(Entrainements::class)->findBy($criteria);


            // Render search results
            return $this->render('entrainements/show.html.twig', [
                'entrainements' => $entrainements,
            ]);
        }

        return $this->renderForm('entrainements/search.html.twig', [

            'form' => $form,
        ]);
    }
*/


    #[Route('/{id}/assign-exercises', name: 'app_exercices_index', methods: ['GET'])]
    public function assignExercisesToEntrainement(Entrainements $entrainement): Response
    //(Request $request, EntityManagerInterface $entityManager, int $id): Response

    {
       // $exercises = $this->getDoctrine()->getRepository(Exercice::class)->findAll();

        return $this->render('entrainements/assign_exercises_to_entrainement.html.twig', [
            'entrainement' => $entrainement,
           // 'exercises' => $exercises,
        ]);
    }

    
    #[Route('/{id}/ee', name: 'app_entrainements_show2', methods: ['GET'])]
    public function show2(Entrainements $entrainement): Response
    {
         $exercises = $this->getDoctrine()->getRepository(Exercices::class)->findAll();
        return $this->render('entrainements/assign_exercises_to_entrainement.html.twig', [
            'entrainement' => $entrainement,
            'exercises' => $exercises,
        ]);
    }

    #[Route('/{id}/listExercices', name: 'app_entrainements_listExercices', methods: ['GET'])]
    public function listExercices(Entrainements $entrainement): Response
    {
     
        return $this->render('entrainements/listExercice.html.twig', [
            'entrainement' => $entrainement,
             
        ]);
    }


/**
 * @Route("/assign-exercises/{id}", name="assign_exercises")
 */
public function assignExercises(Request $request, EntityManagerInterface $entityManager, $id): Response
{
    $entrainement = $entityManager->getRepository(Entrainements::class)->find($id);

    if (!$entrainement) {
        throw $this->createNotFoundException('Entrainement not found');
    }

    if ($request->isMethod('POST')) {
        $exerciseIds = $request->request->get('exercises', []);

        foreach ($exerciseIds as $exerciseId) {
            $exercise = $entityManager->getRepository(Exercices::class)->find($exerciseId);

            if ($exercise) {
                $entrainement->addExercice($exercise);
            }
        }

        $entityManager->flush();

        return $this->redirectToRoute('app_entrainements_show2', ['id' => $entrainement->getId()]);
    }

    $exercises = $entityManager->getRepository(Exercices::class)->findAll();

    return $this->render('entrainements/assign_exercises.html.twig', [
        'entrainement' => $entrainement,
        'exercises' => $exercises,
    ]);
}
    

    #[Route('/{id}', name: 'app_entrainements_show', methods: ['GET'])]
    public function show(Entrainements $entrainement): Response
    {
        return $this->render('entrainements/show.html.twig', [
            'entrainement' => $entrainement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_entrainements_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Entrainements $entrainement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EntrainementsType::class, $entrainement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_entrainements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('entrainements/edit.html.twig', [
            'entrainement' => $entrainement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_entrainements_delete', methods: ['POST'])]
    public function delete(Request $request, Entrainements $entrainement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entrainement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($entrainement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_entrainements_index', [], Response::HTTP_SEE_OTHER);
    }
}
