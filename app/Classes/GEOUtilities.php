<?php

namespace App\Classes;

trait GEOUtilities
{
    protected $earth_radius = 6372795;

    /**
     * @param $fA
     * @param $lA
     * @param $fB
     * @param $lB
     * @return float|int
     */
    public function mathDist($fA, $lA, $fB, $lB)
    {
        // перевести координаты в радианы
        $lat1 = $fA * M_PI / 180;
        $lat2 = $fB * M_PI / 180;
        $long1 = $lA * M_PI / 180;
        $long2 = $lB * M_PI / 180;

// косинусы и синусы широт и разницы долгот
        $cl1 = cos($lat1);
        $cl2 = cos($lat2);
        $sl1 = sin($lat1);
        $sl2 = sin($lat2);
        $delta = $long2 - $long1;
        $cdelta = cos($delta);
        $sdelta = sin($delta);

// вычисления длины большого круга
        $y = sqrt(pow($cl2 * $sdelta, 2) + pow($cl1 * $sl2 - $sl1 * $cl2 * $cdelta, 2));
        $x = $sl1 * $sl2 + $cl1 * $cl2 * $cdelta;

//
        $ad = atan2($y, $x);
        $dist = $ad * $this->earth_radius;

        return $dist;

    }

    /**
     * @param $fA
     * @param $lA
     * @param $fB
     * @param $lB
     * @return float
     */
    public function calculateTheDistance($fA, $lA, $fB, $lB)
    {
        try {
            $content = file_get_contents("http://www.yournavigation.org/api/1.0/gosmore.php?flat=$fA&flon=$lA&tlat=$fB&tlon=$lB&v=motorcar&fast=1&layer=mapnik&format=geojson");
        } catch (\Exception $e) {
            //     return $this->calculateTheDistance($fA, $lA, $fB, $lB);
        }

        $tmp_coords = [[0,0]];
        $tmp =  $this->mathDist($fA, $lA, $fB, $lB)/1000;

        return ($tmp<10?$tmp+2:$tmp+7);//floatval(min(json_decode($content)->properties->distance, 20) ?? 0);

    }

    public function calculateTheDistanceWithRoute($fA, $lA, $fB, $lB)
    {
        try {
            $content = file_get_contents("http://www.yournavigation.org/api/1.0/gosmore.php?flat=$fA&flon=$lA&tlat=$fB&tlon=$lB&v=motorcar&fast=1&layer=mapnik&format=geojson");
        } catch (\Exception $e) {


        }

        try {
            $tmp_coords = [];
            foreach (json_decode($content)->coordinates as $coords) {
                array_push($tmp_coords, [$coords[1], $coords[0]]);
            }
        } catch (\Exception $e) {

        }

        $tmp_coords = [[0,0]];
        $tmp =  $this->mathDist($fA, $lA, $fB, $lB)/1000;
        return [
            "distance" =>($tmp<10?$tmp+2:$tmp+7),//floatval(min(json_decode($content)->properties->distance, 20) ?? 0),
            "coordinates" => $tmp_coords,
        ];

    }

    public function getCoordsByAddress($address)
    {
        $data = null;
        try {
            $address = mb_strpos(mb_strtolower($address), "украина") !== false ? $address : "Украина, $address";
            $data = YandexGeocodeFacade::setQuery($address ?? '')->load();

            $data = $data->getResponse();
        } catch (Exception $e) {
            Log::error(sprintf("%s:%s %s",
                $e->getLine(),
                $e->getFile(),
                $e->getMessage()
            ));
        }

        return [
            "latitude" => !is_null($data) ? $data->getLatitude() : 0,
            "longitude" => !is_null($data) ? $data->getLongitude() : 0
        ];
    }
}
