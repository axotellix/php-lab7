
<?php

    // get > form data
    $sort_id    = (int) ( $_POST['task-select'] ?? 0 );
    $array      = $_POST['array'] ?? '';

    // set > sort types
    $SORT_TYPES = [
        'selection sort' => 'selectionSort',
        'bubble sort' => 'bubbleSort',
        'Shell sort' => 'shellSort',
        'Gnome sort' => 'gnomeSort',
        'Quicksort' => 'quickSort',
        'In-built sort' => 'inbuiltSort'
    ];

    // process > form data
    $sort_type = array_keys($SORT_TYPES)[ $sort_id ];
    $array = explode(',', $array);
    $array = array_map('intval', $array);


    // [ FUNCTIONS ]

     // set > iterations counter
    $iter = 0;

     //@ sort > array (Selection sort)
    function selectionSort(&$array, &$iter) {
        // DESCRIPTION
        //  1. find current maximum
        //  2. swap it with last unsorted element

        $iter = 0;  // reset > iteration counter
        
        for( $i = count($array) - 1 ; $i > 0 ; $i-- ) {

            // reset > "max" & its index
            $max = $array[0];
            $ind = 0;

            // find > new "max"
            for( $j = 0 ; $j <= $i ; $j++ ) {
                if( $array[ $j ] > $max ) {
                    $max = $array[ $j ];
                    $ind = $j;  
                }
                $iter++;
            }

            // swap > max & last
            $t = $max;                       // keep > "max"
            $array[ $ind ] = $array[ $i ];   // place > "last" on "max"
            $array[ $i ] = $t;               // place > "max" on "last"

        }

    }
     //@ sort > array (Bubble sort)
    function bubbleSort(&$array, &$iter) {
        // DESCRIPTION
        //  1. check every element in array
        //  2. if there are elements > than current - swap them

        $iter = 0;  // reset > iteration counter

        for( $i = 0 ; $i < count($array) ; $i++ ) {
            for( $j = count($array) - 1 ; $j >= $i + 1 ; $j-- ) {
                if( $array[ $i ] > $array[ $j ] ) {
                    $t = $array[ $i ];               // keep > "max"
                    $array[ $i ] = $array[ $j ];     // place > "min" on "max"
                    $array[ $j ] = $t;               // place > "max" on "min"
                }
                $iter++;
            }
        }

    }
     //@ sort > array (Shell sort)
    function shellSort(&$array, &$iter) {
        // DESCRIPTION
        //  1. check every two elements standing at some step from each other
        //  2. step = ARRAY_LENGTH / n     (n = 2, 4, 8 ...)
        // [ 1 , 3 , 2 , 5 , 4 , 3 , 0 ]

        $iter = 0;  // reset > iteration counter
        $step = round(count($array) / 2);

        while($step > 0) {
            for( $i = $step ; $i < count($array) ; $i++) {
                $temp = $array[$i];
                $j = $i;

                while($j >= $step && $array[ $j - $step ] > $temp) {
                    $array[ $j ] = $array[ $j - $step ];
                    $j -= $step;

                    $iter++;
                }

                $array[ $j ] = $temp;
            }

            $step = round($step/2.2);
        }

    }
     //@ sort > array (Gnome sort)
    function gnomeSort(&$array, &$iter) {
        // DESCRIPTION
        //  0. move the least element left untill it is the least
        //  1. check > if "next" < "current" - swap (current position = prev`s position)
        //  2. repeat > step 1
        //  3. if > "next" > "current" - current position = next`s position

        $iter = $i = 0;  // reset > iteration counters
        $len = count($array) - 1; 

        while( $i < $len ) {
            $pos = abs( $i + ($array[$i+1] <=> $array[$i] ?: 1) );
            if( $array[$i] > $array[$i+1] ) {
                $t = $array[$i];
                $array[$i] = $array[$i+1];
                $array[$i+1] = $t;
            }
            $i = $pos;

            $iter++;
        }
        
    }
     //@ sort > array (Quicksort)
    function quickSort(&$array, &$iter) {
        // DESCRIPTION
        //  0. move > everything less than PIVOT left & everything bigger - right
        //  1. repeat > untill array is no longer than 1

        $iter = 0;  // reset > iteration counter
        $len = count($array); 
        if ($len <= 1) return $array;
        
        $PIVOT = $array[0];           //: using 1 element as a PIVOT
        $less_elems   = array();
        $bigger_elems = array();

        for( $i = 1 ; $i < $len ; $i++ ) {
            if( $array[$i] <= $PIVOT ) $less_elems []= $array[$i];
            else $bigger_elems []= $array[$i];

            $iter++;
        }

        $less_elems   = quickSort($less_elems);
        $bigger_elems = quickSort($bigger_elems);

        $array = array_merge($less_elems, (array) $PIVOT, $bigger_elems);
        return $array;
    
    }
     //@ sort > array (In-built sort)
    function inbuiltSort(&$array, &$iter) {

        sort($array);
        $iter = 1; 

    }

    $start_time = microtime(true);

    $SORT_TYPES[ $sort_type ]( $array , $iter );

    $time = microtime(true) - $start_time;
    
    echo "<pre>";
    var_export($array);
    echo "</pre>";
    echo "<strong>Сортировка завершена.</strong> <br>";
    echo "Затрачено времени: $time мс <br>";
    echo "Проведено итераций: $iter. <br>";

?>