<?php

namespace Src\Models;

use DateTime;
use IntlDateFormatter;

class News{

    public $id;
    public $id_user;
    public $id_category;
    public $created_at;
    public $title;
    public $subject;
    public $body;
    public $cover;


    public function getBody(){

        $body = html_entity_decode($this->body);

        return $body;
    }

    public function getFormattedDate(){
        $created_at = date("Y-m-d", strtotime($this->created_at));

        $date = new DateTime($created_at);

        $formatter = new IntlDateFormatter(
          'pt_BR',
           IntlDateFormatter::FULL,
           IntlDateFormatter::NONE,
           'America/Sao_Paulo',          
           IntlDateFormatter::GREGORIAN
         );
        
        $formatter->setPattern("e 'de' MMMM 'de' Y");
        return $formatter->format($date);
    }

    public function getTimeItWasCreated(){
        $dateNow = new DateTime('now');
        $creationDate = new DateTime($this->created_at);
        $interval = $dateNow->diff($creationDate);

        $year = $interval->y;
        $month = $interval->m;
        $day = $interval->d;
        $hour = $interval->h;
        $minute = $interval->i;
        $second = $interval->s;

        if($year){
            if($year >= 1){
                return $year . " anos";
            }else{
                return $year . " ano";
            }
        }elseif($month){
            if($month >= 1){
                return $month . " mêses";
            }else{
                return $month . " mês";
            }
        }elseif($day){
            if($day <= 1){
                return $day . " dia";
            }else{
                return $day . " dias";
            }
        }
        elseif($hour){
            return $hour . " h";
        }elseif($minute){
            return $minute . " min";
        }elseif($second){
            return $second . " s";
        }
    }

}
