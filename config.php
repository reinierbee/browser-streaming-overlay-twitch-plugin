<?php
/**
 * Created by PhpStorm.
 * User: rboon
 * Date: 10-10-14
 * Time: 13:39
 */


use Phergie\Irc\Connection;
$config = array(
    'connections' => array(
        new Connection(array(
            'serverHostname' => 'irc.twitch.tv',
            'username' => 'MegamestaHD',
            'realname' => 'MegamestaHD',
            'nickname' => 'MegamestaHD',
            'password' => ''
        ))
    ),
    'plugins' => array(
        new \Phergie\Irc\Plugin\React\AutoJoin\Plugin(array(

        'channels' => array('#megamestahd'),
        //'keys' => array('key1', 'key2', 'keyN'),

        )),
        new \Phergie\Irc\Plugin\React\Db\Plugin(include("config-database.php")),
        new \Phergie\Irc\Plugin\React\Pong\Plugin()
    )
);

var_dump($config);
return $config;
//return array(
//    // One array per connection, pretty self-explanatory
//    'connections' => array(
//    // Ex: All connection info for the Freenode network
//    array(
//        'host' => 'irc.twitch.tv',
//            'port' => 6667,
//            'username' => 'MegamestaHD',
//            'realname' => 'MegamestaHD',
//            'nick' => 'MegamestaHD',
//            'password' => 'oauth:nlghs1dvo7chnpf1bvs8x1r8gput6n8',
//            // 'transport' => 'ssl' // uncomment to connect using SSL
//        )
//    ),
//
//    // Whitelist of plugins to load
//    'plugins' => array(
//        'AutoJoin'
//    // 'ShortPluginName'
//    // ex: 'AutoJoin' for 'Phergie_Plugin_AutoJoin'
//),
//
//    // If set to true, this allows any plugin dependencies for plugins
//    // listed in the 'plugins' option to be loaded even if they are not
//    // explicitly included in that list
//    'plugins.autoload' => true,
//
//    // Enables shell output describing bot events via Phergie_Ui_Console
//    'ui.enabled' => true,
//);
