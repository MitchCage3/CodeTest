<?php
/**
 * @author Clark Tomlinson  <fallen013@gmail.com>
 * @since 7/16/14, 9:18 AM
 * @link http://www.clarkt.com
 * @copyright Clark Tomlinson © 2014
 *
 */

namespace OC;


/**
 * Class MatrixParser
 *
 * @package OC
 */
class MatrixParser
{

    /**
     * @var array
     */
    public $matrixArr = [];

    /**
     * Parses a provided plaintext matrix into an array
     *
     * @param $matrix
     *
     * @return array
     */
    public function parseMatrix($matrix)
    {

        // First lets get the matrix lines into an array
        $lines = explode(PHP_EOL, $matrix);

        // Now lets convert each line into an array itself
        foreach ($lines as $key => $line) {
            $this->matrixArr[$key] = explode(' ', $line);
        }

        // Return the matrix as an array
        return $this->matrixArr;

    }

    /**
     * Multiples numbers in all directions to get largest product
     *
     * @param array $matrix
     *
     * @return int|mixed
     */
    public function findLargestProduct(array $matrix = [])
    {
        /*
         * Check if the provided matrix is empty.
         * If so use the internally stored matrix array if it exists.
         * If not throw exception.
         */

        if (empty($matrix)) {
            if (empty($this->matrixArr)) {
                throw new \InvalidArgumentException('Provided Matrix Array and internal array both where empty');
            }
            $matrix = $this->matrixArr;
        }


        /*
         * Count the number of rows and columns
         * and subtract 1 so our iterator doesn't overstep
         */
        $rows = count($matrix) - 1;
        $columns = count($matrix[1]) - 1;
        $greatest = 0;


        // Loop over both rows and columns at the same time (messy but best within time constraint)
        for ($row = 0; $row <= $rows; $row ++) {
            for ($column = 0; $column <= $columns; $column ++) {

                // Left and Right
                if ($column < $columns - 3) {
                    $greatest = max(
                        $greatest,
                        $matrix[$row][$column] * $matrix[$row][$column + 1] * $matrix[$row][$column + 2] * $matrix[$row][$column + 3]
                    );
                }

                // Up and Down
                if ($row < $rows - 3) {
                    $greatest = max(
                        $greatest,
                        $matrix[$row][$column] * $matrix[$row + 1][$column] * $matrix[$row + 2][$column] * $matrix[$row + 3][$column]
                    );

                    // Diagonally down right
                    if ($column < $columns - 3) {
                        $greatest = max(
                            $greatest,
                            $matrix[$row][$column] * $matrix[$row + 1][$column + 1] * $matrix[$row + 2][$column + 2] * $matrix[$row + 3][$column + 3]
                        );
                    }

                    // Diagonally down left
                    if ($column > 3) {
                        $greatest = max(
                            $greatest,
                            $matrix[$row][$column] * $matrix[$row + 1][$column - 1] * $matrix[$row + 2][$column - 2] * $matrix[$row + 3][$column - 3]
                        );
                    }
                }

            }
        }

        // Return the int of the greatest product
        return $greatest;

    }

} 