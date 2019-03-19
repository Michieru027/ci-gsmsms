<?php
/**
 * Created by PhpStorm.
 * User: EC_Jerome
 * Date: 20/09/2018
 * Time: 11:22 AM
 */
include_once('header.php');

echo (isset($template['body'])) ? $template['body'] : '';

include_once('footer.php');