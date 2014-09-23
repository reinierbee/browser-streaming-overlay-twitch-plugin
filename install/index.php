<?php
/**
 * Created by IntelliJ IDEA.
 * User: rboon
 * Date: 22-9-2014
 * Time: 2:43 PM
 */

print_r("Starting installation... \n\n");

passthru("php ../composer.phar install",$output);
passthru("php ../composer.phar update",$output);

print_r($output);
