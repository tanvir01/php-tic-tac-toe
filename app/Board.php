<?php

namespace App;

class Board
{
	private $cells = array(); //the 3x3 grid of cells
 
	public function __construct()
	{
		$row1 = array("_", "_", "_");
 
		$row2 = array("_", "_", "_");
 
		$row3 = array("_", "_", "_");
 
		$this->cells[0] = $row1;
 
		$this->cells[1] = $row2;
 
		$this->cells[2] = $row3;
	}

	public function getCells()
	{
		return $this->cells;
	}
 
	//display the board with moves made so far
	public function display()
	{
		echo "\n";

		for($i = 0; $i < 3; $i++)
		{
			for($j = 0; $j < 3; $j++) { 
				echo $this->cells[$i][$j]."\t";
			}
 
			echo "\n\n";
		}

		echo "\n";
	}
 
	//check if a cell is already occupied or not
	public function checkAvailable($move)
	{
		$i = $move->getRow();
		$j = $move->getColumn();
 		
 		//check input row and column
		$validRowColumn = (($i >= 1 && $i <= 3) && ($j >= 1 && $j <= 3));
 		
 		//check if cell is empty
		if($validRowColumn){
			$validCell = ($this->cells[$i - 1][$j - 1] == "_");
		}else{
			$validCell = false;
		} 
 
        $validMove = ($validRowColumn && $validCell); 
 
        $move->setValid($validMove);
 
		return $move;
	}
 
	//put a 'X' or '0' in a cell if the move is valid
	public function markCell($move, $mark)
	{
		$i = $move->getRow();
		$j = $move->getColumn();
 
		$this->cells[$i - 1][$j - 1] = $mark;
	}
}

