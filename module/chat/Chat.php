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

class Chat extends Message {

    protected $db;
    public $limit = 100; // limit the maximum amount of returned messages prevent overloading your system
    protected $log;
    protected $config = array();
    public $session;

    public function __construct(array $config = array())
    {
        $this->log = new Logger('chat');
        $this->log->pushHandler(new StreamHandler(__DIR__.'/../log/chat.log', Logger::DEBUG));

        $this->config = $config;
        if(!empty($config['database'])) {
            $connectionParams = $config['database'];
            $configDb['database'] = new DBAL\Configuration();
            $this->db = DBAL\DriverManager::getConnection($connectionParams, $configDb['database']);

        } else {
            $this->log->addEmergency("no database configured");
            echo "no database configured";
        }
    }

    public function getMessages($target,$limit = null){
        $limit = $this->getLimit($limit);
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('*')
            ->from('event_PRIVMSG','')
            ->where("target = :target")
            ->orderBy('id','ASC')
            ->setFirstResult($limit[0])
            ->setMaxResults($limit[1])
        ;
        $stmt = $this->db->prepare($queryBuilder);
        $stmt->bindValue('target',$target);
        $stmt->execute();

        $this->log->addInfo("Executing query: $queryBuilder");

        return $this->queryDataToMessage($stmt->fetchAll());

    }

    protected function queryDataToMessage(array $messages){

        $newMessages = array();

        foreach ($messages as $key => $value){
            $message = new Message();
            $message->message = $value['message'];
            $message->target = $value['target'];
            $message->id = $value['id'];
            $message->nick->nickname = $value['nick'];
            $newMessages[] = $message;
        }
        return $newMessages;
    }

    public function getRecentMessages($target,$id){
        $limit = $this->getLimit();

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('*')
            ->from('event_PRIVMSG','')
            ->where("target = :target")
            ->andWhere('id > :id')
            ->orderBy('id','ASC')
            ->setFirstResult($limit[0])
            ->setMaxResults($limit[1])
            ->setParameters(array(
                'id' => $id
            ));
        ;
        $stmt = $this->db->prepare($queryBuilder);
        $stmt->bindValue('target',$target);
        $stmt->bindValue('id',$id);
        $stmt->execute();

        $this->log->addInfo("Executing query: $queryBuilder");

        return $this->queryDataToMessage($stmt->fetchAll());
    }

    public function getNewMessages($target,$lastMessage = null,$limit = null){
        if(isset($lastMessage->id) || isset($lastMessage)){
            return $this->getRecentMessages($target,$lastMessage->id);
        } else {
            return $this->getMessages($target,$limit);
        }
    }

    protected function getLimit($limit = null){
        if(isset($limit)){
            return explode(',',$limit);
        } else {
            return array(0, $this->limit);
        }

    }
}