<?php

// +----------------------------------------------------------------------
// | H1CMS © OpenSource CMS
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.h1cms.com All rights reserved.
// | Copyright (c) 2014-2016 嘉兴领格信息技术有限公司，并保留所有权利。
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Allen <allen@getw.com>
// +----------------------------------------------------------------------

namespace system\model;

use getw\DB;
use getw\db\ActiveRecord;

/**
 * Class User
 *
 */
class User extends ActiveRecord
{

    public static function tableName(){
        return 'users';
    }

    public static function primaryKey(){
        return 'id';
    }


    /**
     *
     * @param string $username
     * @return User
     */
    public static function findByUsername($username)
    {
        $query = DB::query('select * from {users} where username=:username', ['username' => $username]);
        return $query->fetchObject(__CLASS__);
    }

    /**
     *
     * @param int $uid
     * @return User
     */
    public static function findByUid($uid)
    {
        $query = DB::query('select * from {users} where id=:id', ['id' => $uid]);
        return $query->fetchObject(__CLASS__);
    }

    /**
     *
     * @param string $email
     * @return User
     */
    public static function findByEmail($email)
    {
        $query = DB::query('select * from {users} where email=:email', ['email' => $email]);
        return $query->fetchObject(__CLASS__);
    }

    public function getUserProfile()
    {
        return DB::query('select * from {users_profile} where uid=:uid', ['uid' => $this->id])->fetchObject();
    }

    public function getUserRoles()
    {
        return DB::query('select * from {users_roles} where uid=:uid', ['uid' => $this->id])->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getUserRoleIds()
    {
        return DB::query('select role_id from {users_roles} where uid=:uid', ['uid' => $this->id])->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function getUserRoleNames()
    {
        return DB::query('select ur.role_id,r.title from {users_roles} ur 
                          left join {roles} r on ur.role_id=r.id 
                          where uid=:uid', ['uid' => $this->id])->fetchAll(\PDO::FETCH_KEY_PAIR);
    }

    public function remove($uid)
    {
        db_delete('users', ['id' => $uid]);
        db_delete('users_profile', ['uid' => $uid]);
        db_delete('users_roles', ['uid' => $uid]);
    }
}
