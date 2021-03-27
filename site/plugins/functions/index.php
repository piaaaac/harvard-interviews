<?php
/**
 * Die and inspect variable
 */
function kill($var){
  die("<pre>". print_r($var, true));
}

