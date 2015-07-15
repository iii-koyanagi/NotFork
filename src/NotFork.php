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
    private $minus = array("1" => 2, "2" => 7, "3" => 3, "4" => 5, "5" => 2);

    public function run($data)
    {
        $counter = $this->counter;
        $minus = $this->minus;
        $data_array = str_split($data);

        foreach ($data_array as $key => $only_data) {
            if ($only_data != 'x' and $only_data != '.') {
                $int_data = intval($only_data);

                if ($key < 5) {
                    $counter[$key+1] = $int_data;
                }

                else {
                    $sort_counter = $counter;
                    sort($sort_counter);
                    continue;
                }
            }

            elseif ($only_data === 'x') {
                if ($key < 5) {
                
                }
            }

            elseif ($only_data === '.') {
                if ($key < 5) {
                    $counter[1] = $counter[1] - $minus[1];
                    $counter[2] = $counter[2] - $minus[2];
                    $counter[3] = $counter[3] - $minus[3];
                    $counter[4] = $counter[4] - $minus[4];
                    $counter[5] = $counter[5] - $minus[5];

                    foreach ($counter as $keys => $only_counter) {
                        if ($only_counter < 0) {
                            $counter[$keys] = 0;
                        }
                    }
                }
            }
        }

        var_dump($counter);
    }
}
