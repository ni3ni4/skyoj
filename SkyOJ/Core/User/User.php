<?php namespace SkyOJ\Core\User;
use \SkyOJ\Core\Permission\UserLevel;
class User extends \SkyOJ\Core\CommonObject
{
    protected static $table = 'account'; 
    protected static $prime_key = 'uid';

    public static function getGuestData(){
        return [
            'username'=>'Guest',
            'uid'=>0,
            'level' => UserLevel::GUEST
        ];
    }

    public function afterLoad()
    {
        $this->sqldata['uid'] = (int)$this->uid;
        $this->sqldata['level'] = (int)$this->level;
        return true;
    }

    public function getObjLevel():int
    {
        return $this->level-1;
    }

    function isAdmin()
    {
        return $this->level >= UserLevel::ADMIN;
    }

    function isUser()
    {
        return $this->level >= UserLevel::USER;
    }

    function isLogin()
    {
        return $this->level >= UserLevel::GUEST;
    }

    function testStisfyPermission(int $owner,int $minReqlevel):bool
    {
        $ownLevel = (int)(self::fetchColByPrimeID($owner,'level')[0]);
        return  $this->level > $ownLevel ||
                $this->level > $minReqlevel ||
                $this->uid == $owner;

    }
}