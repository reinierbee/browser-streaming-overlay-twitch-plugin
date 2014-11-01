<?php
/**
 * Created by PhpStorm.
 * User: rboon
 * Date: 24-10-14
 * Time: 15:08
 */


namespace Module\Chat;

class Message {

    public $client;
    public $message;
    public $target;

    public function __construct(array $config = array())
    {
        $this->client = new Client();
    }
}