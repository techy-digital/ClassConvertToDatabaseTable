<?php
/**
 * Created by PhpStorm.
 * User: muzaffer
 * Date: 31.01.2019
 * Time: 15:08
 */

define('ROOT_PATH', __DIR__);

include_once ROOT_PATH.'/data/concrete/ExampleDal.php';

$ExampleDatabase = new ExampleDal();
$ExampleDatabase->getMessageToId(1);




