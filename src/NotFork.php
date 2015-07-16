<?php
/**
 * This file is part of the TripleI.NotFork
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace TripleI\NotFork;

class NotFork
{
    private $counter = array("1" => 0, "2" => 0, "3" => 0, "4" => 0, "5" => 0);
    private $x_counter = array("1" => 0, "2" => 0, "3" => 0, "4" => 0, "5" => 0);
    private $minus = array("1" => 2, "2" => 7, "3" => 3, "4" => 5, "5" => 2);

    var $string_counter;

    public function run($data)
    {
        $counter = $this->counter;
        $data_array = str_split($data);

        foreach ($data_array as $only_data) {
            if ($only_data != '.') {
                $counter = $this->sortAndAdd($counter, $only_data);
            }
            
            elseif ($only_data === '.') {
                $counter = $this->register($counter);
            }
        }

        $string_counter = $this->arrayToString($counter);
        $this->string_counter = $string_counter;
    }

    public function register($counter)
    {
        $minus = $this->minus;
        $x_counter = $this->x_counter;

        for ($i = 1; $i <= 5; $i++) {
            if ($x_counter[$i] == 0) {
            $counter[$i] = $counter[$i] - $minus[$i];
            }
        }

        foreach ($counter as $keys => $only_counter) {
            if ($only_counter < 0) {
                $counter[$keys] = 0;
            }
        }

        for ($i = 1; $i <= 5; $i++) {
            if ($x_counter[$i] > $counter[$i]) {
                 $counter[$i] = $x_counter[$i];
            }
        }

        return $counter;
    }

    public function sortAndAdd($counter, $only_data)
    {
        $x_counter = $this->x_counter;

        if ($only_data === 'x') {
            $int_data = 1;
        }
        else {
            $int_data = intval($only_data);
        }

        $sort_counter = $counter;
        asort($sort_counter);
        $shift_sort_counter = array_shift($sort_counter);
        $key_arr = array();

        foreach ($counter as $counter_key => $only_counter) {
            if ($shift_sort_counter == $only_counter) {
                $key_arr[] = $counter_key;
            }
        }

        if (count($key_arr) === 1) {
            $counter[$key_arr[0]] += $int_data;

            if ($only_data === 'x') {
                $x_counter[$key_arr[0]] += 1;
            }
        }

        else {
            $sort_key_arr = $key_arr;
            asort($sort_key_arr);
            $shift_key_arr = array_shift($sort_key_arr);
            $counter[$shift_key_arr] += $int_data;

            if ($only_data === 'x') {
                $x_counter[$shift_key_arr] += 1;
            }
        }
        $this->x_counter = $x_counter;
        return $counter;
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
}
