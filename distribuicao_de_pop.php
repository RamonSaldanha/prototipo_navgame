<?php

function distribui_inteiros($numero, $caixas) {
    echo "Distribuindo o número:  $numero em $caixas caixas.";
    $div = floor($numero / $caixas);
    $sobra = $numero - ($caixas * $div);

    for ($i = 1; $i <= $caixas; $i++) {
        $caixa[$i] = $div;
        if($sobra > 0){
            $caixa[$i]++;
        }
        $sobra--;
    }

    return $caixa;
}

$resultado1 = distribui_inteiros(6, 5);
$resultado2 = distribui_inteiros(3, 5);
$resultado3 = distribui_inteiros(23, 20);  
