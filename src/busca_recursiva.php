<?php 

function busca($arvore, $chave, $count = 0, $separador = ',') {

    $key = current($chave);
    $total_key = count($chave);

    $return = '';

    if (!is_array($arvore)) {
        return null;
    }

    foreach ($arvore as $k => $value) {
        if (is_int($k)) {
            // QUANDO O $K E UM INTEIRO E CONSIDERADO QUE A $arvore E UM
            // VETOR. COM ISSO E RODADO UM LOOP EM CIMA DA $arvore PARA
            // PEGAR TODAS AS POSSIBILIDADES.
            foreach ($arvore as $xx) {
                $return .= busca($xx, $chave, $count, $separador) . $separador;
            }

            return rtrim($return, $separador);
        }

        if ($k == $key) {
            if ($total_key == 1) {
                return $value;
            } else {
                if ($total_key > 1) {
                    unset($chave[$count]);
                    $count++;
                }

                return busca($value, $chave, $count, $separador);
            }
        }
    }

    return null;
}

$json = file_get_contents("data.json", true);

$json_convert = json_decode($json, true);

$ret = busca(
    $json_convert,
    [
        'fields',
        'components',
        'fields',
        'fixVersions',
        'name'
    ]
);

print_r($ret);
echo "\n\n";

