<?php
/**
 * Retorna os feriados do respetivo ano
 * https://store.services.sapo.pt/pt/cat/catalog/utility/free-api-holiday
 * @param $ano
 * @return array
 */
function feriados($ano)
{

    $context = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));

    $url = 'http://services.sapo.pt/Holiday/GetAllHolidays?year=' . $ano;

    $xml = file_get_contents($url, false, $context);

    $xml = simplexml_load_string($xml);

    $f_regionais = array();

    $f_nacionais = array();

    $f_municipais = array();


    foreach ($xml as $x) {

        foreach ($x as $x1) {
            if ($x1->Type == 'National') {
                $f_nacionais[] = array(
                    'nome' => (string) $x1->Name,
                    'data' => substr($x1->Date, 0, -9)
                );

            } elseif ($x1->Type == 'Regional') {

                $f_regionais[] = array(
                    'nome' => (string)$x1->Name,
                    'data' => substr($x1->Date, 0, -9)
                );

            } elseif ($x1->Type == 'Municipal') {

                $f_municipais[] = array(
                    'nome' => (string)$x1->Name,
                    'data' => substr($x1->Date, 0, -9),
                    'municipio' => (string)$x1->Municipality->Name
                );

            }

        }

    }

    return array(
        'FeriadosNacionais' => $f_nacionais,
        'FeriadosRegionais' => $f_regionais,
        'FeriadosMunicipais' => $f_municipais
    );

}

$feriados = feriados(2017);

echo '<pre>';
print_r($feriados);
echo '</pre>';
