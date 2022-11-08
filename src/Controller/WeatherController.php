<?php

namespace App\Controller;

use App\Repository\LocationRepository;
use App\Service\HighlanderForecastGenerator;  // <-------------------------

use App\Service\WeatherForecastFetcher;       // <-------------------------
use App\Service\WeatherUtil;       // <-------------------------

use Symfony\Component\HttpFoundation\JsonResponse;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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

    public function cityNameAction($cityName, LocationRepository $locationRepository, MeasurementRepository $measurementRepository): Response
    {
        $location = $locationRepository->findOneBySomeField($cityName); // pobranie lokalizacji po Naziwe Miasta

        // $locationid = $location->getId(); // pobranie ID lokalizacji, które ma taką nazwę miasta

        $measurements = $measurementRepository->findByLocation($location);

        /*return $this->render('weather/location_data.html.twig', [
            'location' => $location,
            'locationid' => $locationid
        ]);*/

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }

    // ###############################################################################################

    /*public function highlanderForecastAction(HighlanderForecastGenerator $highlanderSays): Response
    {
        return new Response(<<<EOT
<html>
    <body>
        Highlander says: <i>{$highlanderSays->getForecast()}</i>
    </body>
</html>
EOT
        );
    }*/

    // ###############################################################################################

    /*#[Route('/weather-for-location/{locationId}')]
    public function weatherForLocationAction(Request $request, WeatherUtil $weatherUtil, $locationId): Response
    {
        //return new JsonResponse($weatherUtil->getWeatherForLocation($locationId, $request->get('start-date'), $request->get('end-date')));

        $location = $weatherUtil->getWeatherForLocation($locationId, $request->get('start-date'), $request->get('end-date'));

        //return $this->render('weather/city.html.twig', [
        //    'location' => $location,
        //    'measurements' => $measurements
        //]);

        //return $this->render('weather/city.html.twig', [
        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $location['measurements']
        ]);

    }*/

    // Ostatnia wersja - w trakcie (DOBRA) - 23:00 :
    // Działa tak jak cityAction() - w kontrolerze

    #[Route('/weather-for-location/{city}')]
    public function weatherForLocationActionn(Request $request, WeatherUtil $weatherUtil, Location $city): Response
    {
        $location = $weatherUtil->getWeatherForLocation($city); # id

        /*return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements
        ]);*/

        return $this->render('weather/city.html.twig', [
            'location' => $city,
            'measurements' => $location['measurements']
        ]);

    }

    #[Route('/weather-for-location-by-name/{cityName}')]
    public function WeatherForLocationByName(Request $request, WeatherUtil $weatherUtil, $cityName): Response
    {
        $location = $weatherUtil->getWeatherForLocationByName($cityName);

        return $this->render('weather/city.html.twig', [
            'location' => $location['location'],
            'measurements' => $location['measurements']
        ]);
    }








}
