<?php

namespace App\Service;

use App\Repository\LocationRepository;
use App\Repository\MeasurementRepository;

use App\Entity\Location;

class WeatherUtil
{
    private LocationRepository $locationRepository;
    private MeasurementRepository $measurementRepository;

    public function __construct(LocationRepository $locationRepository, MeasurementRepository $measurementRepository) // Konstruktor
    {
        $this->locationRepository = $locationRepository;
        $this->measurementRepository = $measurementRepository;
    }

    //public function getWeatherForLocation($locationId, $dateFrom = null, $dateTo = null): array
    /*public function getWeatherForLocation($locationId, $dateFrom = null, $dateTo = null): array
    {
        $location = $this->locationRepository->find($locationId);

        $measurements = $this->measurementRepository->findByLocation(
            $location,
            $dateFrom ? new \DateTime($dateFrom) : null,
            $dateTo ? new \DateTime($dateTo) : null
        );

        $result = [
            //'name' => $location->getName(),
            'name' => $location->getCity(),
            'country' => $location->getCountry(),
            'measurements' => [],
        ];
        foreach ($measurements as $measurement) {
            $result['measurements'][] = [
                'date' => $measurement->getDate()->format('Y-m-d'),
                'date_timestamp' => $measurement->getDate()->format('U'),
                'celsius' => $measurement->getCelsius(),
            ];
        }

        return $result;
    }*/

    //public function cityAction(Location $city, MeasurementRepository $measurementRepository): Response
    /*public function cityAction(Location $city, MeasurementRepository $measurementRepository): array
    {
        $measurements = $measurementRepository->findByLocation($city);

        return $this->render('weather/city.html.twig', [
            'location' => $city,
            'measurements' => $measurements,
        ]);
    }*/

    /*public function getWeatherForLocation($locationId, $dateFrom = null, $dateTo = null): array
    {
        $location = $this->locationRepository->find($locationId);

        $measurements = $this->measurementRepository->findByLocation(
            $location,
            $dateFrom ? new \DateTime($dateFrom) : null,
            $dateTo ? new \DateTime($dateTo) : null
        );

        $result = [
            //'name' => $location->getName(),
            'city' => $location->getCity(),
            'country' => $location->getCountry(),
            'measurements' => [],
        ];

        foreach ($measurements as $measurement) {
            $result['measurements'][] = [
                'date' => $measurement->getDate()->format('Y-m-d'),
                //'date_timestamp' => $measurement->getDate()->format('U'),
                'celsius' => $measurement->getCelsius(),
                'status' => $measurement->getStatus(),
                'humidity' => $measurement->getHumidity(),
                'sunrise' => $measurement->getSunrise(),
                'sunset' => $measurement->getSunset(),
                'windspeed' => $measurement->getWindspeed(),
            ];
        }


        return $result;
    }*/

    // Pobieranie po ID - Encji (tj w WC) :
    // Dobra - działa - 23:00

    public function getWeatherForLocation(Location $city): array
    {
        $measurements = $this->measurementRepository->findByLocation($city);

        $result = [
            //'name' => $location->getName(),
            //'city' => $location->getCity(),
            //'country' => $location->getCountry(),
            //'measurements' => [],

            'location' => $city,
            'measurements' => $measurements,
        ];

        /*foreach ($measurements as $measurement) {
            $result['measurements'][] = [
                'date' => $measurement->getDate()->format('Y-m-d'),
                //'date_timestamp' => $measurement->getDate()->format('U'),
                'celsius' => $measurement->getCelsius(),
                'status' => $measurement->getStatus(),
                'humidity' => $measurement->getHumidity(),
                'sunrise' => $measurement->getSunrise(),
                'sunset' => $measurement->getSunset(),
                'windspeed' => $measurement->getWindspeed(),
            ];
        }*/

        return $result;
    }

    /*// Ta druga funkcja - do pobierania pogody po nazwie - ma WYKORZYTAĆ FUNKCJĘ PO ENCJI :
    public function getWeatherForLocationnByName($cityName): array
    {
        $location = $this->locationRepository->findOneBySomeField($cityName); // pobiera lokację z rep. na podst. nazwy miasta.

        $locationid = $location->getId();

        //$result = $this->getWeatherForLocationn($location);
        //return $result;

        $measurements = $this->measurementRepository->findByLocation($location);
        $result = [
            //'name' => $location->getName(),
            //'city' => $location->getCity(),
            //'country' => $location->getCountry(),
            //'measurements' => [],
            'location' => $cityName,
            'measurements' => $measurements,
        ];
        return $result;
    }*/

    // v2 - Ta druga funkcja - do pobierania pogody po nazwie - ma WYKORZYTAĆ FUNKCJĘ PO ENCJI :

    public function getWeatherForLocationByName($cityName): array
    {
        $location = $this->locationRepository->findOneBySomeField($cityName); // pobiera lokację z rep. na podst. nazwy miasta.

        $locationid = $location->getId();

        $result = $this->getWeatherForLocation($location);
        return $result;

    }



    // Pobieranie po ID (WC) :
    public function cityAction(Location $city, MeasurementRepository $measurementRepository): Response
    {
        $measurements = $measurementRepository->findByLocation($city);

        return $this->render('weather/city.html.twig', [
            'location' => $city,
            'measurements' => $measurements,
        ]);
    }

    // pobieranie po Naziwe miasta :
    public function cityNameAction($cityName, LocationRepository $locationRepository, MeasurementRepository $measurementRepository): Response
        //public function locationNameAction(Location $city, MeasurementRepository $measurementRepository): Response
    {
        //$measurements = $measurementRepository->findByLocation($city);

        $location = $locationRepository->findOneBySomeField($cityName);

        $locationid = $location->getId();

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







}