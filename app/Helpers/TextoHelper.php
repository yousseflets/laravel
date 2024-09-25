<?php

namespace App\Helpers;

class TextoHelper
{

    public static function mascara($mask, $str)
    {
        $str = str_replace(" ", "", $str);
        $str = str_replace(".", "", $str);
        $str = str_replace("/", "", $str);
        $str = str_replace("-", "", $str);

        for ($i = 0; $i < strlen($str); $i++)
        {
            $mask[strpos($mask, "#")] = $str[$i];
        }

        return $mask;
    }

    public static function mascara2($mask, $str)
    {
        $str = str_replace(" ", "", $str);
        $str = str_replace(".", "", $str);
        $str = str_replace("/", "", $str);
        $str = str_replace("-", "", $str);

        for ($i = 0; $i < strlen($str); $i++)
        {
            $mask[strpos($mask, "0")] = $str[$i];
        }

        return $mask;
    }

    public static function porcentagem($valor)
    {
        return number_format($valor, 2, ',', '.') . ' %';
    }

    public static function numeroSemVirgula($valor)
    {
        return number_format($valor, 0, ',', '.');
    }

    public static function numeroComVirgula($valor, $casas)
    {
        if ($valor === null || $valor === '')
        {
            return null;
        }

        if (is_numeric($valor))
        {
            return number_format($valor, $casas, ',', '.');
        }

        return $valor;
    }

    public static function limparFormatoUuid(string $uuid): string
    {
        return str_replace('-', '', $uuid);
    }

    public static function formatarCEP(string $cep): string
    {
        return substr($cep, 0, 2) . '.' . substr($cep, 2, 3) . '-' . substr($cep, 5, 3);
    }

    public static function limparCEP(string $cep): string
    {
        return str_replace(['.', '-'], '', $cep);
    }

    public static function saveMoney(string $money)
    {
        if ($money != NULL)
        {
            $money = str_replace("R$", "", $money);
            $money = str_replace(" %", "", $money);
            $money = str_replace(" ", "", $money);
            $money = str_replace(".", "", $money);
            $money = str_replace(",", ".", $money);

            if (is_numeric($money))
            {
                return number_format($money, 2, '.', '');
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return NULL;
        }
    }

    public static function cleanNumber(string $txt)
    {
        $txt = preg_replace("/\D/", "", $txt);  // Allow only numeric chars
        return trim($txt);
    }

    public static function showTelefone($telefone)
    {
        //telefone 10 dígitos - celular 11 dígitos
        $c1 = substr($telefone, 0, 2);
        $c2 = '';
        $c3 = '';
        if ($telefone != "")
        {

            if (strlen($telefone) < 11)
            {
                $c2 = substr($telefone, 2, 4);
                $c3 = substr($telefone, 6, 4);
            }
            else
            {
                $c2 = substr($telefone, 2, 5);
                $c3 = substr($telefone, 7, 4);
            }

            return '(' . $c1 . ') ' . $c2 . '-' . $c3;
        }
    }
}
