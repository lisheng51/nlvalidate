<?php

namespace BCNL;

/**
 * Description of Algorithm
 *
 * @author Administrator
 */
class Algorithm {

    /**
     * 
     * @param float $lat1
     * @param float $lon1
     * @param float $lat2
     * @param float $lon2
     * @return float
     */
    public function distance(float $lat1 = 0, float $lon1 = 0, float $lat2 = 0, float $lon2 = 0): float {
        $the = $lon1 - $lon2;
        $cal_form = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($the));
        $dist = acos($cal_form);
        $miles = rad2deg($dist) * 60 * 1.1515;
        return ($miles * 1.609344);
    }

    /**
     * 
     * @param int $n
     * @return array
     */
    public function fibonacci(int $n = 0): array {
        $arrResult = [];
        if ($n < 2) {
            $arrResult[] = $n;
            return $arrResult;
        }

        $num1 = 0;
        $num2 = 1;
        for ($counter = 0; $counter < $n; $counter++) {
            $arrResult[] = $num1;
            $num3 = $num2 + $num1;
            $num1 = $num2;
            $num2 = $num3;
        }

        return $arrResult;
    }

}
