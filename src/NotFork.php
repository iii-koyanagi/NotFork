<?php
/**
 * This file is part of the TripleI.NotFork
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace TripleI\NotFork;

class NotFork
{
    private $counter = array("1" => 1, "2" => 2, "3" => 3, "4" => 4, "5" => 5);
    private $x_counter = array("1" => 0, "2" => 0, "3" => 0, "4" => 0, "5" => 0);
    private $minus = array("1" => 2, "2" => 7, "3" => 3, "4" => 5, "5" => 2);

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
                    $shift = array_shift($sort_counter);

                    continue;
                }
            }

//            elseif ($only_data === 'x') {
//                    $x_counter[$key+1] += 1;
//            }
//
//            elseif ($only_data === '.') {
//                    $counter = $this->register($counter);
//            }
        }

        $counter = $this->plusXValue($counter, $x_counter);
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
}
