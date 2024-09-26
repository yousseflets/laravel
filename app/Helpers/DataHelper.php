<?php

namespace App\Helpers;

use DateTime;

class DataHelper {


    public static function sqlParaPtBr($data)
    {
        return implode('/', array_reverse(explode('-', $data)));
    }

    public static function ptBrParaSql($data)
    {
        return implode('-', array_reverse(explode('/', $data)));
    }

    public static function showDate($txt)
    {
        if ($txt == "0000-00-00" || $txt == "NULL" || $txt == "")
          {
              return "N/A";
          }
          else
          {
              $datetime = explode(" ", $txt);
              $date = explode("-", $datetime[0]);
              return $date[2] . "/" . $date[1] . "/" . $date[0];  // DD/MM/YYYY
          }
    }

    public static function showDateTime($txt)
    {
         if ($txt == "0000-00-00" || $txt == "NULL" || $txt == ""){
             return "N/A";
        }else{
            $datetime = explode(" ", $txt);
            $date = explode("-", $datetime[0]);
            $hora = explode(":", $datetime[1]);

            return $date[2] . "/" . $date[1] . "/" . $date[0] . " " . $hora[0] . ":" . $hora[1];
        }
    }


    public static function saveDate($date)
    {
        if ($date)
        {
            settype($date, "string");
            $date = str_replace("-", "/", $date);
            LIST( $day, $month, $year ) = explode('/', $date);
            $newdate = "$year-$month-$day";
            return $newdate;
        }
    }


    /**
     * @param int $tipo 1: Quinta-feira, Janeiro 14, 2021
     * @param DateTime|null $data
     * @return string
     */
    public static function dataPorExtenso($tipo = 1, DateTime $data = null)
    {
        if(!$data) $data = new DateTime('now');

        if($tipo == 1){
            $diaSemana = self::traduzirDiaSemana($data->format('l'));
            $diaMes = self::traduzirMes($data->format('F'));

            return $diaSemana . ', ' . $diaMes . ' ' . $data->format('d, Y');
        }

        return self::traduzirMes($data->format('F'));
    }

    private static function traduzirDiaSemana($diaSemana) : string
    {
        switch ($diaSemana) {
            case 'Monday':
                return 'Segunda-feira';
                break;
            case 'Tuesday':
                return 'Terça-feira';
                break;
            case 'Wednesday':
                return 'Quarta-feira';
                break;
            case 'Thursday':
                return 'Quinta-feira';
                break;
            case 'Friday':
                return 'Sexta-feira';
                break;
            case 'Saturday':
                return 'Sábado';
                break;
            case 'Sunday':
                return 'Domingo';
                break;
        }
    }

    private static function traduzirMes($mes): string
    {
        switch ($mes){
            case 'January':
                return 'Janeiro';
                break;
            case 'February':
                return 'Fevereiro';
                break;
            case 'March':
                return 'Março';
                break;
            case 'April':
                return 'Abril';
                break;
            case 'May':
                return 'Maio';
                break;
            case 'June':
                return 'Junho';
                break;
            case 'July':
                return 'Julho';
                break;
            case 'August':
                return 'Agosto';
                break;
            case 'September':
                return 'Setembro';
                break;
            case 'October':
                return 'Outubro';
                break;
            case 'November':
                return 'Novembro';
                break;
            case 'December':
                return 'Dezembro';
                break;
        }
    }

}
