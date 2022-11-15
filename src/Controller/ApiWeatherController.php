<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\LocationRepository;
use App\Repository\MeasurementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\WeatherUtil; // <----

// http://pogodynka.localhost:46693 /api/weather.json?name=Szczecin

class ApiWeatherController extends AbstractController
{
    /**
     * @return Response
     * @Route("/api/weather.json", name="api_weather_jsonn")
     */
    public function weatherJsonAction(Request $request, LocationRepository $locationRepository, MeasurementRepository $measurementRepository, WeatherUtil $weatherUtil): Response
    {
        $locationName = $request->get('name', null);
        if (! $locationName) {
            throw new BadRequestException("Missing location name.");
        }

        $responseArray = [
            'success' => true,
        ];

        /** @var Location $location */
            //$location = $locationRepository->findOneByName($locationName);
        //$location = $locationRepository->findOneBySomeField($locationName); // pobranie lokalizacji po Naziwe Miasta

        $location = $weatherUtil->getWeatherForLocationByName($locationName);

        if (! $location) {
            throw new NotFoundHttpException("Location $locationName not found.");
        }

        $responseArray['location'] = [

            /*'id' => $location->getId(),

            'city' => $location->getCity(),
            'country' => $location->getCountry(),
            'latitude' => $location->getLatitude(),
            'longitude' => $location->getLongitude(),*/

            'id' => $location['id'],
            'name' => $location['name'],
            //'name' => $location->getCity(),
            'country' => $location['country'],
            'latitude' => $location['latitude'],
            'longitude' => $location['longitude'],
            /*'latitude' => $location->getLatitude(),
            'longitude' => $location->getLongitude(),*/
        ];

        //$measurements = $measurementRepository->findByLocation($location);

        $measurements = $location['measurements'];

        $responseArray['measurements'] = $measurements;

        /*if ($measurements) {
            $responseArray['measurements'] = [];

            foreach ($measurements as $measurement) {
                $responseArray['measurements'][$measurement->getDate()->format('Y-m-d')] = [
                    'date' => $measurement->getDate()->format('Y-m-d'),
                    'celsius' => $measurement->getCelsius(),
                ];
            }
        }*/

        //return $this->json($responseArray);
        return new JsonResponse($responseArray);
    }
}