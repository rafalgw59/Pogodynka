<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\MeasurementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{

    public function cityAction($country,$city, MeasurementRepository $measurementRepository): Response
    {

        $measurements = $measurementRepository->findByLocation($city, $country);

        return $this->render('weather/city.html.twig', [
            'city' => $city,
            'country' => $country,
            'measurements' => $measurements,
        ]);
    }
}
