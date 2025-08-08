<?php
namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/employes')]
class EmployeController extends AbstractController
{
    #[Route('', name: 'app_employes')]
    public function index(EntityManagerInterface $em): Response
    {
        $employes = $em->getRepository(Employe::class)->findBy([], ['name' => 'ASC']);
        return $this->render('employe/index.html.twig', compact('employes'));
    }

    #[Route('/{id}/edit', name: 'employe_edit')]
    public function edit(Request $request, Employe $employe, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('app_employes');
        }

        return $this->render('employe/edit.html.twig', [
            'employe' => $employe,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/employes/{id}/delete', name: 'employe_delete', methods: ['POST'])]
    public function delete(Request $request, Employe $employe, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $employe->getId(), $request->request->get('_token'))) {
            $em->remove($employe);
            $em->flush();
        }

        return $this->redirectToRoute('app_employes');
    }
}
