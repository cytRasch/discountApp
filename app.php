<?php
/**
 * Created by PhpStorm.
 * User: akf-sebastianrasch
 * Date: 15.09.16
 * Time: 16:38
 */

session_start();

use AGAN\Api\GenerateDiscount;

include_once (__DIR__ . '/classes/GenerateDiscount.php');


if($_GET['createDiscount']) {

    // new instance of GenerateDiscount
    $submitDiscount = new GenerateDiscount();

} else {

    echo 'no permission';

    exit;
}

