<?php declare(strict_types=1);


namespace App\Model\Dao;

use ReflectionException as ReflectionExceptionAlias;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\DB;
use Swoft\Db\Eloquent\Builder;
use Swoft\Db\Eloquent\Collection;
use Swoft\Db\Eloquent\Model;
use Swoft\Db\Exception\DbException;
use App\Model\Entity\Group;

/**
 * 机器人数据
 * Class GroupDao
 * @package App\Model\Dao
 * @Bean()
 */
class GroupDao
{
    /**
     * 获取所有用户信息
     * @return Collection
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function getGroups()
    {

        $Groups = Group::all();

        return $Groups;
    }

    /**
     * 获取指定用户信息
     * @param int $id
     * @return  object|Builder|Model|null
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function getGroup(int $id)
    {

        return Group::where('id', '=', $id)->first();
    }

    /**
     * 获取根据用户名获取视频信息
     * @param string $name
     * @return object|Builder|Model|null
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function getGroupByName(string $name)
    {
        $Group =  Group::where('name', '=', $name)->first();
        return $Group;
    }

    /**
     * 创建用户
     * @param array $userInfo
     * @return string
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function createGroup(array $userInfo): string
    {
        return DB::table('Group')->insertGetId($userInfo);
    }

    /**
     * 更新用户信息
     * @param int $id
     * @param array $GroupInfo
     * @return int
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function updateGroup(int $id, array $GroupInfo)
    {
        $ret = Group::where('id', $id)->update($GroupInfo);
        return $ret;
    }
}
