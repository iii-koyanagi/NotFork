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
        $x_counter = $this->x_counter;
        $data_array = str_split($data);

        $first = 0;
        foreach ($data_array as $key => $only_data) {
            if ($only_data != 'x' and $only_data != '.') {
                $int_data = intval($only_data);

                if ($first === 0) {
                    $counter[1] += $int_data;
                    $first += 1;
                }

                else {
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
                    }

                    else {
                        $sort_key_arr = $key_arr;
                        asort($sort_key_arr);
                        $shift_key_arr = array_shift($sort_key_arr);

                        $counter[$shift_key_arr] += $int_data;
                    }
                }
            }

            elseif ($only_data === 'x') {
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
                    $x_counter[$key_arr[0]] += 1;
                }

                else {
                    $sort_key_arr = $key_arr;
                    asort($sort_key_arr);
                    $shift_key_arr = array_shift($sort_key_arr);

                    $x_counter[$shift_key_arr] += 1;
                }

            }

            elseif ($only_data === '.') {
                $counter = $this->register($counter);
            }
        }
        $counter = $this->plusXValue($counter, $x_counter);
        $string_counter = $this->arrayToString($counter);

        $this->string_counter = $string_counter;
    }

    public function register($counter)
    {
        $minus = $this->minus;

        for ($i = 1; $i <= 5; $i++) {
            $counter[$i] = $counter[$i] - $minus[$i];
        }

        foreach ($counter as $keys => $only_counter) {
            if ($only_counter < 0) {
                $counter[$keys] = 0;
            }
        }

        return $counter;
    }

    public function plusXValue($counter, $x_counter)
    {
        for ($i = 1; $i <= 5; $i++) {
            $counter[$i] = $counter[$i] + $x_counter[$i];
        }

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
