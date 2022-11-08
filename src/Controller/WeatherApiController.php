<?php

namespace App\Controller;

use App\Repository\LocationRepository;
use App\Repository\MeasurementRepository;
use App\Service\WeatherUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherApiController extends AbstractController
{



    #[Route('/weather/api', name: 'app_weather_api', methods: ['GET','POST'])]
    public function weatherJsonAction(Request $request,WeatherUtil $weatherUtil): Response
    {
        /* todo */
        $payload = $request->toArray();
        $result = $weatherUtil->getWeatherForCountryAndCity($payload['country'],$payload['city']);

        $res = [];
        if($payload['type']=='json'){
            foreach ($result as $weather){
                $res=[ "celsius"=>$weather->getTemperature(),
                        "humidity"=>$weather->getHumidity(),
                        "uv_index"=>$weather->getUvIndex(),
                        "wind_speed"=>$weather->getWindSpeed(),
                        "wind_direction"=>$weather->getWindDirection(),
                        "date"=>$weather->getDate()->format('Y-m-d'),

                    ];

            }
            return new JsonResponse($res);
        }
        elseif ($payload['type']=='csv'){
            $csv="";
            foreach ($result as $weather){
                $res=[ "celsius"=>$weather->getTemperature(),
                    "humidity"=>$weather->getHumidity(),
                    "uv_index"=>$weather->getUvIndex(),
                    "wind_speed"=>$weather->getWindSpeed(),
                    "wind_direction"=>$weather->getWindDirection(),
                    "date"=>$weather->getDate()->format('Y-m-d'),

                ];
                $csv .= implode(',',$res)."\n";


            }

//            foreach ($res as $line){
//                $csv .= "{$line['celsius']},{$line['humidity']},{$line['uv_index']},{$line['wind_speed']},{$line['wind_direction']},{$line['date']},\n";
//            }


            return new Response($csv);
        }


    }
    //#[Route('/weather/api/{type}', name: 'app_weather_api_csvson', methods: ['GET','POST'])]
    public function weatherTwigAction(Request $request,WeatherUtil $weatherUtil,$type,$country,$city): Response{
        //$payload = $request->toArray();
        $result = $weatherUtil->getWeatherForCountryAndCity($country,$city);

        return $this->render("weather_api/weather.{$type}.twig",[
            "country"=>$country,
            "city"=>$city,
            "weathers"=>$result,
        ]);

    }



}
