<pre>
<?php

require_once('Unit.php');
require_once('Army.php');
require_once('Game.php');

$armies = [
    new Army("Армия 1", 3),
    new Army("Армия 2", 3)
];

$first_game = new Game($armies);
echo file_get_contents(Game::LOG_FILE);
