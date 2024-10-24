<?php

namespace App\Controller;

use App\Repository\LocationRepository;
use App\Service\WeatherUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    #[Route('/weather/{country}/{city}', name: 'app_weather')]
    public function city(string $country, string $city, LocationRepository $locationRepository, WeatherUtil $util): Response
    {
        $location =  $locationRepository->findOneBy([
            'country' => $country,
            'city' => $city,
        ]);

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $util->getWeatherForLocation($location),
        ]);
    }

}
