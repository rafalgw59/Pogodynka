<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\MeasurementRepository;
use App\Service\WeatherUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{

    public function cityAction($country,$city, WeatherUtil $weatherUtil): Response
    {

        $result = $weatherUtil->getWeatherForCountryAndCity($country, $city);

        return $this->render('weather/city.html.twig', [
            'city' => $city,
            'country' => $country,
            'location' => $result['location'],
            'measurements' => $result['measurements'],
        ]);
    }
}
