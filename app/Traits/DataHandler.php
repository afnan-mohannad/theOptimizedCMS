<?php

namespace App\Traits;

use DateTime;

trait DataHandler{
    public function dateTimeDiffrence($datetime){
        $date1          = new DateTime(str_replace(' ', 'T', $datetime));
        $date2          = new DateTime();
        $diff           = $date1->diff($date2);
        $dif['year']    = $diff->y;
        $dif['month']   = $diff->m;
        $dif['day']     = $diff->d;
        $dif['hour']    = $diff->h;
        $dif['minutes'] = $diff->i;
        $dif['seconds'] = $diff->s;
        if($dif['year'] > 10)
            return [
                'ar' => ' منذ '.$dif['year'] . ' سنة',
                'en' => $dif['year'] . '  Year ago',
                'fr' => $dif['year'] . "Il y'a un an"
            ];
        elseif($dif['year'] > 2)
            return [
                'ar' => ' منذ '.$dif['year'] . ' سنوات',
                'en' => $dif['year'] . ' Years ago',
                'fr' => $dif['year'] . ' Il y a des années'
            ];
        elseif($dif['year'] == 2)
            return [
                'ar' => 'منذ سنتان',
                'en' => 'Two years ago',
                'fr' => 'Il y a deux ans'
            ];
        elseif($dif['year'] == 1)
            return [
                'ar' => 'منذ سنة',
                'en' => 'One year ago',
                'fr' => 'Il y a un an'
            ];
        elseif($dif['month'] > 10)
            return [
                'ar' => ' منذ '.$dif['month'] . ' شهر',
                'en' => $dif['month'] . ' Month ago',
                'fr' => $dif['month'] . ' Il y a un mois'
            ];
        elseif($dif['month'] > 2)
            return [
                'ar' => ' منذ '.$dif['month'] . ' شهور',
                'en' => $dif['month'] . ' Months ago',
                'fr' => $dif['month'] . ' Il y a des mois'
            ];
        elseif($dif['month'] == 2)
            return [
                'ar' => 'منذ شهران',
                'en' => 'Two months ago',
                'fr' => 'Il y a deux mois'
            ];
        elseif($dif['month'] == 1)
            return [
                'ar' => 'منذ شهر',
                'en' => 'One month ago',
                'fr' => 'Il y a un mois'
            ];
        elseif($dif['day'] > 10)
            return [
                'ar' => ' منذ '.$dif['day'] . ' يوم',
                'en' => $dif['day'] . ' Day ago',
                'fr' => $dif['day'] . ' Il y a un jour'
            ];
        elseif($dif['day'] > 2)
            return [
                'ar' => ' منذ '.$dif['day'] . ' أيام',
                'en' => $dif['day'] . ' Days ago',
                'fr' => $dif['day'] . ' Il y a quelques jours'
            ];
        elseif($dif['day'] == 2)
            return [
                'ar' => 'منذ يومان',
                'en' => 'Two days ago',
                'fr' => 'Il y a deux jours'
            ];
        elseif($dif['day'] == 1)
            return [
                'ar' => 'منذ يوم',
                'en' => 'One day ago',
                'fr' => 'Il y a un jour'
            ];
        elseif($dif['hour'] > 10)
            return [
                'ar' => ' منذ '.$dif['hour'] . ' ساعة',
                'en' => $dif['hour'] . ' Hour ago',
                'fr' => $dif['hour'] . ' Une heure avant'
            ];
        elseif($dif['hour'] > 2)
            return [
                'ar' => ' منذ '.$dif['hour'] . ' ساعات',
                'en' => $dif['hour'] . ' Hours ago',
                'fr' => $dif['hour'] . ' Il y a des heures'
            ];
        elseif($dif['hour'] == 2)
            return [
                'ar' => 'ساعتان',
                'en' => 'Two Hours ago',
                'fr' => 'Il ya deux heures'
            ];
        elseif($dif['hour'] == 1)
            return [
                'ar' => 'منذ ساعة',
                'en' => 'One hour ago',
                'fr' => 'Il y a une heure'
            ];
        elseif($dif['minutes'] > 10)
            return [
                'ar' => ' منذ '.$dif['minutes'] . ' دقيقة',
                'en' => $dif['minutes'] . ' Minutes ago',
                'fr' => $dif['minutes'] . ' Il y a une minute'
            ];
        elseif($dif['minutes'] > 2)
            return [
                'ar' => ' منذ '.$dif['minutes'] . ' دقائق',
                'en' => $dif['minutes'] . 'Minutes ago',
                'fr' => $dif['minutes'] . 'Il y a quelques minutes'
            ];
        elseif($dif['minutes'] == 2)
            return [
                'ar' => 'منذ دقيقتان',
                'en' => 'Two minutes ago',
                'fr' => 'Il y a deux minutes'
            ];
        elseif($dif['minutes'] == 1)
            return [
                'ar' => 'منذ دقيقة',
                'en' => 'One minute ago',
                'fr' => 'Il y a une minute'
            ];
        elseif($dif['seconds'] > 10)
            return [
                'ar' => ' منذ '.$dif['seconds'] . ' ثانية',
                'en' => $dif['seconds'] . ' Second ago',
                'fr' => $dif['seconds'] . ' Il y a une seconde'
            ];
        elseif($dif['seconds'] > 2)
            return [
                'ar' => ' منذ '.$dif['seconds'] . ' ثوان',
                'en' => $dif['seconds'] . 'Seconds ago',
                'fr' => $dif['seconds'] . 'Il y a quelques instants'
            ];
        elseif($dif['seconds'] == 2)
            return [
                'ar' => 'منذ ثانيتان',
                'en' => 'Two seconds ago',
                'fr' => 'Il y a deux secondes'
            ];
        elseif($dif['seconds'] == 1)
            return [
                'ar' => 'منذ ثانية',
                'en' => 'One second ago',
                'fr' => 'Il y a une seconde'
            ];
    }
    public function dateTimeFormat($datetime){
        $date = new DateTime(str_replace(' ', 'T', $datetime));
        return $date->format('Y-m-d');
    }
    public function removeElementWithValue($array, $key, $value){
        foreach($array as $subKey => $subArray){
            if($subArray[$key] == $value){
                unset($array[$subKey]);
            }
        }
        return $array;
    }
}
