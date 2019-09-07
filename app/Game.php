<?php

namespace App;

class Game
{
	private static $movesTillNow = 0; //how many moves till now
	private $gameOver; //is game over yet?
	private $winner = null; // 'X' or '0'
 
	public function getGameOver()
	{
		return $this->gameOver;
	}	
 
	public function setGameOver($gameOver)
	{
		$this->gameOver = $gameOver;
	}
 
	public function setMovesTillNow()
	{
		self::$movesTillNow++;
	}
 
	public function getMovesTillNow()
	{
		return self::$movesTillNow;
	}
 
	public function setWinner($winner)
	{
		$this->winner = $winner;
	}
 
	public function getWinner()
	{
		return $this->winner;
	}
 
	//check if the player has won or the game is tie
	public function checkForWinOrTie($board)
	{

		$movesTillNow = $this->getMovesTillNow();
 
		$boardCells = $board->getCells();

		if($movesTillNow<=9){
			
			for ($i=0; $i < 3; $i++) { 
				//check for win : row wise
				if(($boardCells[$i][0]!='_')&&($boardCells[$i][0]==$boardCells[$i][1])&&($boardCells[$i][1]==$boardCells[$i][2])){
				
					//set winner
					($boardCells[$i][0]=='X') ? $this->setWinner('X') : $this->setWinner('O');

					//set game over
					$this->setGameOver(true);
				}

				//check for win : column wise
				if(($boardCells[0][$i]!='_')&&($boardCells[0][$i]==$boardCells[1][$i])&&($boardCells[1][$i]==$boardCells[2][$i])){
				
					//set winner
					($boardCells[0][$i]=='X') ? $this->setWinner('X') : $this->setWinner('O');

					//set game over
					$this->setGameOver(true);
				}
			}

			//check for win : left diagonal
			if(($boardCells[0][0]!='_')&&($boardCells[0][0]==$boardCells[1][1])&&($boardCells[1][1]==$boardCells[2][2])){
				
				//set winner
				($boardCells[0][0]=='X') ? $this->setWinner('X') : $this->setWinner('O');

				//set game over
				$this->setGameOver(true);
			}

			//check for win : right diagonal
			if(($boardCells[0][2]!='_')&&($boardCells[0][2]==$boardCells[1][1])&&($boardCells[1][1]==$boardCells[2][0])){
				
				//set winner
				($boardCells[0][2]=='X') ? $this->setWinner('X') : $this->setWinner('O');

				//set game over
				$this->setGameOver(true);
			}
		}else{
			//set game over
			$this->setGameOver(true);
		}

		/* Rare case */
		//if the game has no winner in the 9th move, then the game is a tie and the game is over
		if(($movesTillNow==9)&&($this->getWinner()==null)){
			//set game over
			$this->setGameOver(true);
		}
	}

	
}
