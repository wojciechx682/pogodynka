<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Location;
use App\Repository\MeasurementRepository;

class WeatherController extends AbstractController
{
    //#[Route('/weather', name: 'app_weather')]
    /*public function index(): Response
    {
        return $this->render('weather/city.html.twig', [
            'controller_name' => 'WeatherController',
        ]);
    }*/

    //#[Route('/weather', name: 'app_weather')]
    /*public function cityAction(): Response
    {
        return $this->render('weather/city.html.twig', [
            'controller_name' => 'WeatherController',
        ]);
    }*/

    public function cityAction(Location $city, MeasurementRepository $measurementRepository): Response
    {
        $measurements = $measurementRepository->findByLocation($city);
        return $this->render('weather/city.html.twig', [
            'location' => $city,
            'measurements' => $measurements,
        ]);
    }
}
