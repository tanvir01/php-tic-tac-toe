<?php

require __DIR__ . '/vendor/autoload.php';

use App\Move;
use App\Player;
use App\Board;
use App\Game;

echo "Welcome to Tic-Tac-Toe\n\n";
echo "Choose Opponent\n";
echo "1)Human\n";
echo "2)Computer\n";
echo "\n";

//take input from user for opponent
$userInput = readline("Enter Number (1 or 2): ");

//verify user input
while(($userInput!='1')&&($userInput!='2')){
	echo "Invalid Input!\n";
	//take input from user for opponent
	$userInput = readline("Enter Number (1 or 2): ");
}

//set opponent for user (Player 1 - X)
$opponent = ($userInput=='1') ? 'HUMAN' : 'COMPUTER';

echo "\n----- New Game Started -----\n\n";

//instantiate a new game
$game = new Game();

//instantiate a new board
$board = new Board();
$board->display();

//create player 1 instance
$player1 = new Player();
$player1->setPlayerMark('X');

//create player 2 instance
$player2 = new Player();
$player2->setPlayerMark('O');

//start the game : turn by turn (Player 1 goes first, then Player 2)
do {

	//ask player 1 for move inputs
	$player1->askInputForMove($board,$game);
	//if game is not over, then player 2 will make move 
	if(!$game->getGameOver()){
		//check opponent(Player 2 - O) is HUMAN or COMPUTER
		if($opponent=='HUMAN'){
			//ask player 2 for move inputs
			$player2->askInputForMove($board,$game);
		}else{
			echo "Player 2 (O) is thinking......\n";
			// delaying execution of the script for 1 second 
			sleep(1); 
			//generate random move for player 2
			$player2->makeRandomMove($board,$game);
		}
	}

} while (!$game->getGameOver());

//declare win or tie
if($game->getWinner()=='X'){
	echo "Player 1 (X) won"."\n\n";
}elseif ($game->getWinner()=='O') {
	echo "Player 2 (O) won"."\n\n";
}else{
	echo "The game is a tie"."\n\n";
}

echo "----- GAME OVER -----\n\n";
