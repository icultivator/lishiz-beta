<?php
/**
 * Created by PhpStorm.
 * User: heidi
 * Date: 2014/12/2
 * Time: 14:59
 */
$ss = 'http://www.test.com/page/{1,90}.html';
preg_match('/(.*)\{(\d?),(\d+)\}(.*)/',$ss,$match);
print_r($match);
//echo $match[1].$match[2];
