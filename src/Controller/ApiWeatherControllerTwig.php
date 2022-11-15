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

// http://pogodynka.localhost:46693/api/weather-twig.json?name=Szczecin

class ApiWeatherControllerTwig extends AbstractController
{
    /**
     * @return Response
     * @Route("/api/weather.json", name="api_weather_json")
     */
    public function weatherJsonAction(Request $request, LocationRepository $locationRepository, MeasurementRepository $measurementRepository): Response
    {
        /* todo */

        return $this->json([]);
    }
    /**
     * @return Response
     * @Route("/api/weather-twig.{_format}", name="api_weather_json")
     */
    public function weatherTwigAction(Request $request, LocationRepository $locationRepository, MeasurementRepository $measurementRepository, $_format, WeatherUtil $weatherUtil): Response
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
        //$location = $locationRepository->findOneBySomeField($locationName);      // <------

        // Wykorzystując serwis :

        $location = $weatherUtil->getWeatherForLocationByName($locationName);

        if (! $location) {
            throw new NotFoundHttpException("Location $locationName not found.");
        }

        /*return $this->render('weather/city.html.twig', [
            'location' => $location['location'],
            'measurements' => $location['measurements']
        ]);*/

        $responseArray['location'] = [
            'id' => $location['id'],
            'name' => $location['name'],
            //'name' => $location->getCity(),
            'country' => $location['country'],
            'latitude' => $location['latitude'],
            'longitude' => $location['longitude'],
        ];

        //$measurements = $measurementRepository->findByLocation($location);

        /*$measurements = $location['measurements'][];

        if ($measurements) {
            $responseArray['measurements'] = [];

            foreach ($measurements as $measurement) {
                $responseArray['measurements'][$measurement->getDate()->format('Y-m-d')] = [
                    'date' => $measurement->getDate()->format('Y-m-d'),
                    'celsius' => $measurement->getCelsius(),
                ];
            }
        }*/

        $response = $this->render("api_weather/weather_twig.{$_format}.twig", [
            'locationName' => $locationName,
            'location' => $location,
            //'measurements' => $measurements,
            'measurements' => $location['measurements']
        ]);

        /*$measurements = $location['measurements'];
        $responseArray['measurements'] = $measurements;*/

        //$response = new Response();

        switch ($_format) {
            case 'json':
                $response->headers->set('Content-Type', 'application/json');
                break;
            case 'csv':
                $response->headers->set('Content-Type', 'text/csv');
        }

        return $response;






    }
}