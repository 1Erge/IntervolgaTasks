<?php
$array=[2,2,1,0,-24,10,25];
$a = 'Z';


for ($i = 0; $i < count($array); $i++) {//проходим по массиву в обратном порядке
    if (strpos($array[$i], '2') !== false) {//Проверяем наличие цифры 2 в текущем элементе массива
        for ($j = count($array); $j > $i; $j--) {//все последующие элементы сдвигаются на одну позицию вправо
            $array[$j] = $array[$j-1];
        }
        $array[$i+1] = $a;
    }
}


foreach ($array as $key => $item){
    echo "<p> INDEX : $key VALUE : $item"."</p>";
}
    



