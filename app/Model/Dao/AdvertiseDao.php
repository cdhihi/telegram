<?php declare(strict_types=1);


namespace App\Model\Dao;

use App\Model\Entity\Advertise;
use ReflectionException as ReflectionExceptionAlias;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\DB;
use Swoft\Db\Eloquent\Builder;
use Swoft\Db\Eloquent\Collection;
use Swoft\Db\Eloquent\Model;
use Swoft\Db\Exception\DbException;
use Swoft\Stdlib\Collection as StdlibCollection;

/**
 * 广告数据
 * Class AdvertiseDao
 * @package App\Model\Dao
 * @Bean()
 */
class AdvertiseDao
{
    /**
     * 获取所有用户信息
     * @return Collection
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function getAdvertises()
    {
        $Advertises = Advertise::all();
        return $Advertises;
    }

    /**
     * 获取指定用户信息
     * @param int $id
     * @return  object|Builder|Model|null
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function getAdvertise(int $id)
    {
        return Advertise::where('id', '=', $id)->first();
    }


    /**
     * 获取根据用户名获取广告信息
     * @param string $name
     * @return object|Builder|Model|null
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function getAdvertiseByName(string $name)
    {
        $Advertise =  Advertise::where('name', '=', $name)->first();
        return $Advertise;
    }

    /**
     * 创建用户
     * @param array $userInfo
     * @return string
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function createAdvertise(array $userInfo): string
    {
        return DB::table('advertise')->insertGetId($userInfo);
    }

    /**
     * 更新用户信息
     * @param int $id
     * @param array $advertiseInfo
     * @return int
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function updateAdvertise(int $id, array $advertiseInfo)
    {
        $ret = Advertise::where('id', $id)->update($advertiseInfo);
        return $ret;
    }
}
