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
        }
    }
}
