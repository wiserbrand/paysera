<?php
namespace Payment\Helper;

class DateHelper {
    public static function getLastMonday(\DateTime $date = null) {
        if (!$date) {
            $date = new \DateTime();
        } else {
            $date = clone $date;
        }
        
        $date->setTime(0, 0, 0);
        
        if ($date->format('N') == 1) {
            return $date;
        } else {
            return $date->modify('last monday');
        }
    }
}