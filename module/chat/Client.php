<?php
/**
 * Created by PhpStorm.
 * User: rboon
 * Date: 24-10-14
 * Time: 15:12
 */

namespace Module\Chat;


class Client {

    protected $username;
    protected $color;

    public function __construct(array $config = array())
    {
        return array(
            'username' => 'dummy',
            'color' => '#000000'
        );
    }
} 