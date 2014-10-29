<?php
/**
 * Created by PhpStorm.
 * User: rboon
 * Date: 24-10-14
 * Time: 15:08
 */

namespace Module\Chat;

use Doctrine\DBAL;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Message {

    protected $user;
    protected $message;
    protected $db;
    public $limit = 100; // limit the maximum amount of returned messages prevent overloading your system
    protected $log;

    protected $config = array();

    public function __construct(array $config = array())
    {
        $this->log = new Logger('name');
        $this->log->pushHandler(new StreamHandler('./logs/chat.log', Logger::WARNING));

        $this->config = $config;
        if(!empty($config['database'])) {
            $connectionParams = $config['database'];
            $configDb['database'] = new DBAL\Configuration();
            $this->db = DBAL\DriverManager::getConnection($connectionParams, $configDb['database']);

        } else {
            $this->log->addEmergency("no database configured");
            echo "no database configured";
        }
        return array(
            'client' => new Client(),
            'message' => 'fixed blballbal'
        );
    }

    public function getMessages($target,$limit = null){
        $limit = $this->getLimit($limit);
        $sql = "SELECT * FROM event_PRIVMSG WHERE target = '$target' ORDER BY id DESC LIMIT $limit";
        $this->log->addInfo("Executing query: $sql");
        return $this->db->query($sql)->fetchAll();
    }

    protected function getLimit($limit){
        if(isset($limit)){
            return $limit;
        } else {
            return "0," . $this->limit;
        }

    }

    public function getRecentMessages($target,$id){
        $sql = "SELECT * FROM event_PRIVMSG WHERE target = '$target' AND id > '$id'";
        $this->log->addInfo("Executing query: $sql");
        return $this->db->query($sql)->fetchAll();
    }
}