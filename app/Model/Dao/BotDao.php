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
use App\Model\Entity\Bot;

/**
 * 机器人数据
 * Class BotDao
 * @package App\Model\Dao
 * @Bean()
 */
class BotDao
{
    /**
     * 获取所有用户信息
     * @return Collection
     * @throws DbException
     */
    public function getBots()
    {
        $Bots = Bot::all();
        return $Bots;
    }

    /**
     * 获取指定用户信息
     * @param int $id
     * @return  object|Builder|Model|null
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function getBot(int $id)
    {

        return Bot::where('id', '=', $id)->first();
    }

    /**
     * 获取根据用户名获取视频信息
     * @param string $name
     * @return object|Builder|Model|null
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function getBotByName(string $name)
    {
        $Bot =  Bot::where('name', '=', $name)->first();
        return $Bot;
    }

    /**
     * 创建用户
     * @param array $userInfo
     * @return string
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function createBot(array $userInfo): string
    {
        return DB::table('bot')->insertGetId($userInfo);
    }

    /**
     * 更新用户信息
     * @param int $id
     * @param array $BotInfo
     * @return int
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function updateBot(int $id, array $BotInfo)
    {
        $ret = Bot::where('id', $id)->update($BotInfo);
        return $ret;
    }
}
