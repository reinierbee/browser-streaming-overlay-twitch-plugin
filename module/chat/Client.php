<?php
/**
 * Created by PhpStorm.
 * User: rboon
 * Date: 24-10-14
 * Time: 15:12
 */

namespace Module\Chat;


class Client {

    public $clientName;
    public $color;

    public function __construct(array $config = array())
    {
        $this->color = '#000000';
    }
} 