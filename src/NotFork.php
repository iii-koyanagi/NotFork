<?php
/**
 * This file is part of the TripleI.NotFork
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace TripleI\NotFork;

class NotFork
{
    private $counter = ["1" => 0, "2" => 0, "3" => 0, "4" => 0, "5" => 0];
    private $x_counter = ["1" => 0, "2" => 0, "3" => 0, "4" => 0, "5" => 0];
    private $x_memory = ["1" => 0, "2" => 0, "3" => 0, "4" => 0, "5" => 0];
    var $string_counter;

    function __construct() {
        define ("MINUS", serialize (["1" => 2, "2" => 7, "3" => 3, "4" => 5, "5" => 2]));
    }

    public function run($data)
    {
        $orig_counter = $this->counter;
        $data_array = $this->dataToArray($data);
        $counter = $this->branch($orig_counter, $data_array);
        $string_counter = $this->arrayToString($counter);
        $this->string_counter = $string_counter;
        $this->remove();
    }

    public function dataToArray($data)
    {
        $data_array = str_split($data);

        return $data_array;
    }

    public function branch($counter, $data_array)
    {
        foreach ($data_array as $only_data) {
            if ($only_data != '.') {
                $counter = $this->countAndMemForX($counter, $only_data);
            }
            else{
                $counter = $this->register($counter);
            }
        }

        return $counter;
    }

    public function register($counter)
    {
        $minus = unserialize (MINUS);
        $x_counter = $this->x_counter;
        $x_memory = $this->x_memory;

        for ($i = 1; $i <= 5; $i++) {
            if ($x_counter[$i] == 0) {
                $counter[$i] = $counter[$i] - $minus[$i];
            }
            elseif($x_memory[$i] - $minus[$i] < 0) {
                $counter[$i] = $counter[$i] - $x_memory[$i];
                $x_memory[$i] = 0;
                $this->x_memory = $x_memory;
            }
            else {
                $sabun = $x_memory[$i] - $minus[$i];
                $amari = $counter[$i] - $x_memory[$i];
                $new = $sabun + $amari;
                $counter[$i] = $new;
                $x_memory[$i] = $sabun;

                $this->x_memory = $x_memory;
            }
        }
        $this->counterReset($counter);
        $counter = $this->xEqualizer($x_counter, $counter);

        return $counter;
    }

    public function counterReset($counter)
    {
        foreach ($counter as $keys => $only_counter) {
            if ($only_counter < 0) {
                $counter[$keys] = 0;
            }
        }
    }

    public function xEqualizer($x_counter, $counter)
    {
        for ($i = 1; $i <= 5; $i++) {
            if ($x_counter[$i] > $counter[$i]) {
                $counter[$i] = $x_counter[$i];
            }
        }

        return $counter;
    }

    public function countAndMemForX($counter, $only_data)
    {
        $x_counter = $this->x_counter;
        $x_memory = $this->x_memory;

        $int_data = $this->getIntData($only_data);
        $shift_sort_counter = $this->sortAndShift($counter);
        $key_arr = $this->getKeyArr($counter, $shift_sort_counter);

        $val = $this->getVal($key_arr);
        if ($only_data === 'x') {
            if ($x_counter[$val] === 0) {
                $x_memory[$val] = $counter[$val];
                $this->x_memory = $x_memory;
            }
            $x_counter[$val] += 1;
        }
        $counter[$val] += $int_data;
        $this->x_counter = $x_counter;

        return $counter;
    }

    public function getIntData($only_data)
    {
        if ($only_data === 'x') {
            $int_data = 1;
        }
        else {
            $int_data = intval($only_data);
        }

        return $int_data;
    }

    public function sortAndShift($value)
    {
        $value_for_sort = $value;
        asort($value_for_sort);
        $shift_value = array_shift($value_for_sort);

        return $shift_value;
    }

    public function getKeyArr($counter, $shift_sort_counter)
    {
        $key_arr = [];
        foreach ($counter as $counter_key => $only_counter) {
            if ($shift_sort_counter == $only_counter) {
                $key_arr[] = $counter_key;
            }
        }

        return $key_arr;
    }

    public function getVal($key_arr)
    {
        if (count($key_arr) === 1) {
            $val = $key_arr[0];
        }
        else {
            $val = $this->sortAndShift($key_arr);;
        }

        return $val;
    }

    public function arrayToString($counter)
    {
        $string_counter = implode(",", $counter);

        return $string_counter;
    }

    public function getStringCounter()
    {
        return $this->string_counter;
    }

    public function remove()
    {
        $this->counter = ["1" => 0, "2" => 0, "3" => 0, "4" => 0, "5" => 0];
        $this->x_counter = ["1" => 0, "2" => 0, "3" => 0, "4" => 0, "5" => 0];
        $this->x_memory = ["1" => 0, "2" => 0, "3" => 0, "4" => 0, "5" => 0];
    }
}
