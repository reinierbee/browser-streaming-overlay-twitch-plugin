<?php
/**
 * Created by PhpStorm.
 * User: rboon
 * Date: 27-10-14
 * Time: 21:44
 */

use Module\Chat\Message;

header('Content-Type: application/json');

$message = new Message();

$data = $message->getMessages("megamestahd");
echo json_encode($data);