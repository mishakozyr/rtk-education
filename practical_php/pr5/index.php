<?php

require_once 'Kangaroo.php';

$kangaroo = new Kangaroo('Robert');

echo $kangaroo->getName();
$kangaroo->addChildren(2);
echo $kangaroo->getChildren();
echo $kangaroo->getEnergy();
echo $kangaroo->getEndurance();
echo $kangaroo->run();
echo $kangaroo->getEnergy();
echo $kangaroo->getEndurance();
echo $kangaroo->sleep();
echo $kangaroo->getEnergy();
$kangaroo->addChildren(2);
echo $kangaroo->getChildren();
echo $kangaroo->jump();
echo $kangaroo->getEnergy();
echo $kangaroo->getEndurance();
echo $kangaroo->hit();
echo $kangaroo->getEnergy();
echo $kangaroo->getEndurance();
echo $kangaroo->sleep();
echo $kangaroo->getEnergy() ;

echo $kangaroo->getEnergy();

echo $kangaroo->jump();
