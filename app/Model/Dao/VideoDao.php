<?php declare(strict_types=1);


namespace App\Model\Dao;

use App\Model\Entity\Video;
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
 * 视频数据
 * Class VideoDao
 * @package App\Model\Dao
 * @Bean()
 */
class VideoDao
{
    /**
     * 获取所有用户信息
     * @return Collection
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function getVideos()
    {

        $Videos = Video::all();

        return $Videos;
    }

    /**
     * 获取指定用户信息
     * @param int $id
     * @return  object|Builder|Model|null
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function getVideo(int $id)
    {

        return Video::where('id', '=', $id)->first();
    }

    /**
     * 获取根据用户名获取视频信息
     * @param string $name
     * @return object|Builder|Model|null
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function getVideoByName(string $name)
    {
        $Video =  Video::where('name', '=', $name)->first();
        return $Video;
    }


    /**
     * 获取视频列表
     * @param int $type
     * @return object|Builder|Model|null
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function getVideoByType(int $type)
    {
        $Video =  Video::where('type', '=', $type)->get();
        return $Video;
    }




    /**
     * 创建用户
     * @param array $userInfo
     * @return string
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function createVideo(array $userInfo): string
    {
        return DB::table('video')->insertGetId($userInfo);
    }

    /**
     * 更新用户信息
     * @param int $id
     * @param array $VideoInfo
     * @return int
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function updateVideo(int $id, array $VideoInfo)
    {
        $ret = Video::where('id', $id)->update($VideoInfo);
        return $ret;
    }
}
