<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookingRepository;
use App\Entity\Booking;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\AdminBookingType;

class AdminBookingController extends AbstractController
{
    /**
     * @Route("/admin/bookings", name="admin_bookings_index")
     */
    public function index(BookingRepository $repo)
    {
        return $this->render('admin/booking/index.html.twig', [
            'bookings' => $repo->findAll()
        ]);
    }

    /**
     * Permet de modifier une réservation
     *
     * @Route("/admin/bookings/{id}/edit", name="admin_bookings_edit")
     *
     * @return Response
     */
    public function edit(Booking $booking, Request $request, ObjectManager $manager){
        $form = $this->createForm(AdminBookingType::class, $booking);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $booking->setAmount(0);

            $manager->persist($booking);
            $manager->flush();

            $this->addFlash(
                "success",
                "La réservation n°<strong>{$booking->getId()}</strong> a été modifiée avec succès."
            );

            return $this->redirectToRoute('admin_bookings_index');
        }

        return $this->render('admin/booking/edit.html.twig',[
            'booking' => $booking,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet de suppriomer une réservation
     *
     * @Route("/admin/bookings/{id}/delete", name="admin_bookings_delete")
     *
     * @param Booking $booking
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Booking $booking, ObjectManager $manager) {
        $manager->remove($booking);
        $manager->flush();

        $this->addFlash(
            "success",
            "La réservation de <strong>{$booking->getBooker()->getFullName()}</strong> a bien été supprimée."
        );

        return $this->redirectToRoute('admin_bookings_index');
    }
}
