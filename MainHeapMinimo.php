<?php
function shiftUp(&$arreglo,$i){
    $iDad = findDad($i);
    while($i != 1){
        if($arreglo[$i] < $arreglo[$iDad]) {
            $temp = $arreglo[$iDad];
            $arreglo[$iDad]= $arreglo[$i];
            $arreglo[$i] = $temp;
        }
        $i = $iDad;
        $iDad = findDad($i);
    }
}

function shiftDown(&$arreglo,$limit){
    $i = 1;
    while($i < $limit){
        $hijo1 = $i*2;
        $hijo2 = $hijo1+1;
        if($hijo1 < $limit && $hijo2 < $limit){
            if($arreglo[$hijo1] < $arreglo[$hijo2]){
                if($arreglo[$hijo1] < $arreglo[$i]){
                    $temp = $arreglo[$hijo1];
                    $arreglo[$hijo1] = $arreglo[$i];
                    $arreglo[$i] = $temp;
                    $i = $hijo1;
                }else{
                    $i = $limit;
                }
            }else{
                if($arreglo[$hijo2] < $arreglo[$i]){
                    $temp = $arreglo[$hijo2];
                    $arreglo[$hijo2] = $arreglo[$i];
                    $arreglo[$i] = $temp;
                    $i = $hijo2;
                }else{
                    $i = $limit;
                }
            }
        }elseif ($hijo1 < $limit && $hijo2 >= $limit){
            if($arreglo[$hijo1] < $arreglo[$i]){
                $temp = $arreglo[$hijo1];
                $arreglo[$hijo1] = $arreglo[$i];
                $arreglo[$i] = $temp;
                $i = $hijo1;
            }else{
                $i = $limit;
            }
        }elseif ($hijo1 >= $limit && $hijo2 < $limit){
            if($arreglo[$hijo2] < $arreglo[$i]){
                $temp = $arreglo[$hijo2];
                $arreglo[$hijo2] = $arreglo[$i];
                $arreglo[$i] = $temp;
                $i = $hijo2;
            }else{
                $i = $limit;
            }
        }else{$i = $limit;}
    }
}

/*Primer fase del HeapSort, para transformar el arreglo en un Heap máximo*/
function armarHeapMinimo(&$arreglo){
    $inicio = 1;
    while($inicio < count($arreglo)){
        shiftUp($arreglo,$inicio);
        echo "$inicio Shiftup "; printArray($arreglo); echo "\n";
        $inicio = $inicio + 1;
    }
}

function heapSort(&$arreglo){
    armarHeapMinimo($arreglo);
    echo "Arreglo Heap maximo: "; printArray($arreglo);echo "\n";
    $indice = count($arreglo);
    while($indice != 1){
        echo "cambio ".$arreglo[1]." por ".$arreglo[$indice]."\n";
        $temp = $arreglo[$indice];
        $arreglo[$indice] = $arreglo[1];
        $arreglo[1] = $temp;
        
        shiftDown($arreglo,$indice);
        echo "Shiftdown "; printArray($arreglo); echo "\n";
        $indice = $indice - 1;
    }
}

function findDad($i){
    $resultado = 1;
    if($i != 3 && $i != 2 && $i != 1){
        if($i%2 == 0){
            $resultado = $i/2;
        }else{
            $resultado = ($i-1)/2;
        }
    }
    return $resultado;
}

function printArray($arreglo){
    foreach($arreglo as $item){
        echo $item." ";
    }
}


$array = Array();
$array[1] = 10; $array[2] = 1; $array[3] = 5; $array[4] = 23;$array[5] = 12;
$array[6] = 14; $array[7] = 7;
echo "Arreglo original: "; printArray($array);echo "\n";

//armarHeapMinimo($array);
//shiftUp($array, 4);
//echo "Arreglo Heap Minimo: "; printArray($array);echo "\n";

heapSort($array);
echo "Arreglo heap ordenado: "; printArray($array);echo "\n";
