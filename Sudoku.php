<?php
class Sudoku
{
    public $SudokuTable = array();

    public function __construct()
    {
        $this->fillNull();
        $this->fillTable();
    }

    private function fillNull()
    {
        for($y = 0; $y < 9; $y++)
            for($x = 0; $x< 9; $x++)
                $this->SudokuTable[$y][$x] = null;
    }

    public static function getUniqueSudoku()
    {
        return new Sudoku();
    }

    private function fillTable()
    {
        $numbers = array(1,2,3,4,5,6,7,8,9);
        while(count($numbers) > 0)
        {
            $num = $numbers[rand(0,count($numbers) - 1)];

            $this->fillCells($num);

            $key = array_search($num, $numbers);
            unset($numbers[$key]);
            $numbers = array_values($numbers); // ReIndexing
        }
    }

    private function fillCells($num)
    {
        $selectedCells = $this->getFreeCells();

        if($selectedCells != false)
            foreach ($selectedCells as $cell)
                $this->SudokuTable[$cell[0]][$cell[1]] = $num;
        else
            return $this->fillCells($num);
    }

    private function getFreeCells()
    {
        $selectedCells = array();
        for($square = 1; $square <= 9; $square++)
        {
            $this->selectOneCell($selectedCells,$square);
            if($selectedCells == false)
                return false;
        }
        return $selectedCells;
    }

    private function selectOneCell(&$selectedCells, $square)
    {
        $squareLimits = $this->getRowColLimits($square);

        $possibleCells = array();

        for($y = $squareLimits[0][0]; $y <= $squareLimits[0][1]; $y++)
            for($x = $squareLimits[1][0]; $x <= $squareLimits[1][1]; $x++)
                if($this->SudokuTable[$y][$x] == null)
                {
                    $noProblem = true;
                    foreach ($selectedCells as $cell)
                    {
                        if($cell[0] == $y || $cell[1] == $x)
                        {
                            $noProblem = false;
                        }
                    }

                    if($noProblem)
                    {
                        $possibleCells[] = array($y,$x);
                    }

                }

        // Chose Random Free Cell
        $possibleCells = array_values($possibleCells); // ReIndexing

        if(count($possibleCells) == 0)
        {
            $selectedCells = false;
            return;
        }
        $selectedCells[] = $possibleCells[rand(0,count($possibleCells) - 1)];
    }

    private function getRowColLimits($squareNum)
    {
        $rowStart = null;
        $rowEnd = null;
        $colStart = null;
        $colEnd = null;

        if($squareNum >= 1 && $squareNum<= 3)
        {
            $rowStart = 0;
            $rowEnd = 2;
        }elseif($squareNum >= 4 && $squareNum<= 6)
        {
            $rowStart = 3;
            $rowEnd = 5;
        }else{
            $rowStart = 6;
            $rowEnd = 8;
        }

        if(($squareNum % 3) == 0)
        {
            $colStart = 6;
            $colEnd = 8;
        }elseif(($squareNum % 2) == 0)
        {
            $colStart = 3;
            $colEnd = 5;
        }else{
            $colStart = 0;
            $colEnd = 2;
        }
        return array(array($rowStart,$rowEnd),array($colStart,$colEnd));
    }
}