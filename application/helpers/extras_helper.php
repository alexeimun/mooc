<?php

    function Camelize($string)
    {
        $string = pathinfo($string)['filename'];
        $new = '';
        for ($i = 0; $i < strlen($string); $i++)
        {
            if(ctype_upper($string[$i]))
            {
                $new .= ' ' . $string[$i];
            }
            else
            {
                $new .= $string[$i];
            }
        }
        return $new;
    }

    function br($n = 1)
    {
        for ($i = 0; $i < $n; $i++)
        {
            echo '<br>';
        }
    }

    function Telefono($tel)
    {
        if(strlen($tel) == 7)
        {
            return substr($tel, 0, 3) . ' ' . substr($tel, 3, 2) . ' ' . substr($tel, 5, strlen($tel));
        }
        else if(strlen($tel) == 10)
        {
            return substr($tel, 0, 3) . ' ' . substr($tel, 3, 3) . ' ' . substr($tel, 6, 2) . ' ' . substr($tel, 8, strlen($tel));
        }
        else
        {
            return $tel;
        }
    }

    function Ucspecial($txt)
    {
        $txt = str_replace('á', 'Á', $txt);
        $txt = str_replace('é', 'É', $txt);
        $txt = str_replace('í', 'Í', $txt);
        $txt = str_replace('ó', 'Ó', $txt);
        $txt = str_replace('ú', 'Ú', $txt);
        $txt = str_replace('ñ', 'Ñ', $txt);
        return strtoupper($txt);
    }

    function NormalizeAccents($txt)
    {
        $txt = str_replace('á', 'a', $txt);
        $txt = str_replace('é', 'e', $txt);
        $txt = str_replace('í', 'i', $txt);
        $txt = str_replace('ó', 'o', $txt);
        $txt = str_replace('ú', 'u', $txt);
        $txt = str_replace('?', '', $txt);
        $txt = str_replace('¿', '', $txt);
        $txt = str_replace(' ', '_', $txt);
        $txt = str_replace('ñ', 'n', $txt);
        $txt = str_replace('!', '', $txt);
        $txt = str_replace('¡', '', $txt);
        $txt = str_replace(',', '', $txt);
        $txt = str_replace('.', '', $txt);
        $txt = str_replace(';', '', $txt);
        $txt = str_replace(':', '', $txt);
        $txt = str_replace('-', '_', $txt);
        $txt = str_replace('/', '', $txt);
        $txt = str_replace('\\', '', $txt);
        $txt = str_replace('\"', '', $txt);
        $txt = str_replace('\'', '', $txt);
        $txt = str_replace('#', '', $txt);
        $txt = str_replace('$', '', $txt);
        $txt = str_replace('%', '', $txt);
        $txt = str_replace('&', '', $txt);
        $txt = str_replace('(', '', $txt);
        $txt = str_replace(')', '', $txt);
        $txt = str_replace('@', '', $txt);
        $txt = str_replace('+', 'plus', $txt);
        $txt = str_replace('*', '', $txt);
        $txt = str_replace('', '', $txt);
        $txt = str_replace('>', '', $txt);
        $txt = str_replace('<', '', $txt);
        return $txt;
    }

    function CleanSql(&$value)
    {
        if(is_array($value))
        {
            foreach ($value as $key => $val)
            {
                $value[$key] = str_replace('"', '', str_replace("'", '', str_replace("\\", '', str_replace("#", '', $val))));
            }
        }
        else
        {
            return str_replace('"', '', str_replace("'", '', str_replace("\\", '', str_replace("#", '', $value))));
        }
    }

    /**
     * Ask for a condition if-like, e.g. is("$x > 0 && $x + $y >= 30")
     * @param $cond
     * @return string
     */
    function is($cond)
    {
        $eval = false;
        eval('$eval=' . $cond . ";");
        return $eval;
    }