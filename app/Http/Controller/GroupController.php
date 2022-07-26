<?php declare(strict_types=1);


namespace App\Http\Controller;


use App\Exception\ApiException;
use App\Exception\AuthException;
use App\Helper\ReturnHelper;
use App\Http\Middleware\AuthMiddleware;
use App\Model\Data\GroupData;
use App\Model\Logic\AccountLogic;
use ReflectionException;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\Exception\DbException;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Validator\Annotation\Mapping\Validate;
use Swoft\Validator\Annotation\Mapping\ValidateType;

/**
 * 群组
 * Class GroupController
 * @Middleware(AuthMiddleware::class)
 * @Controller(prefix="/group")
 */
class GroupController
{

    /**
     * @Inject()
     * @var GroupData
     */
    private $groupData;


    /**
     * @Inject()
     * @var AccountLogic
     */
    protected $accountLogic;

    /**
     * 获取所有视频
     * @RequestMapping(route="/group", method={RequestMethod::GET}, params={"3", "获取所有视频"})
     * @OA\Get(
     *     path="/group",
     *     tags={"Group"},
     *     summary="获取所有广告信息",
     *     operationId="getGroups",
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="4xx, 客户端错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="5xx, 服务器错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     * )
     */
    public function getGroup(): array
    {
        $Groups = $this->groupData->getGroups();
        var_dump($Groups);
        return ReturnHelper::format('success', 200, $Groups);
    }

    /**
     * 获取指定用户信息
     * @RequestMapping(route="{id}", method={RequestMethod::GET}, params={"3", "获取指定链接id"})
     * @OA\Get(
     *     path="/group/{id}",
     *     tags={"Group"},
     *     summary="获取指定用户信息",
     *     operationId="getGroup",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="用户唯一标识",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         )
     *     ),
     *     security={
     *         {"token": {}},
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
     *             type="string",
     *             @OA\Property(
     *                 property="msg",
     *                 type="string",
     *                 description="提示信息",
     *              ),
     *             @OA\Property(
     *                 property="uid",
     *                 type="string",
     *                 description="用户ID",
     *              ),
     *              @OA\Property(
     *                 property="role_id",
     *                 type="string",
     *                 description="角色ID",
     *              ),
     *              @OA\Property(
     *                 property="nickname",
     *                 type="string",
     *                 description="用户昵称",
     *              ),
     *              @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 description="邮箱",
     *              ),
     *              @OA\Property(
     *                 property="phone",
     *                 type="string",
     *                 description="手机",
     *              ),
     *              @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 description="账号状态",
     *              ),@OA\Property(
     *                 property="create_time",
     *                 type="string",
     *                 description="创建时间",
     *              ),
     *              @OA\Property(
     *                 property="update_time",
     *                 type="string",
     *                 description="更新时间",
     *              ),
     *              @OA\Property(
     *                 property="login_name",
     *                 type="string",
     *                 description="登录账号名称",
     *              ),
     *              @OA\Property(
     *                 property="ip",
     *                 type="string",
     *                 description="IP地址",
     *              ),
     *              @OA\Property(
     *                 property="role_ids",
     *                 type="string",
     *                 description="账号角色集合",
     *              ),
     *              example={"msg":"success","data":{"uid":1,"nickname":"test","email":"11@qq.com","phone":"1381385438","status":1,"create_uid":1,"create_time":"2019-08-02 11:58:41","update_time":"2019-08-09 18:04:36","login_name":"test","ip":"192.168.23.1","role_ids":{1,2}}}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="4xx, 客户端错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="5xx, 服务器错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     * )
     * @param int $id
     * @return array
     * @throws ApiException
     */
    public function getUser(int $id)
    {

        $Groups = $this->groupData->getGroup($id);

        if ($Groups) {
            return ReturnHelper::format('success', 200, $Groups);
        } else {
            throw new ApiException('id error or not exists', 400);
        }
    }

    /**
     * 创建机器人
     * @RequestMapping(route="/group", method={RequestMethod::POST}, params={"3", "创建机器人"})
     * @Validate(validator="GroupValidator", params={"name","property_key","username"})
     * @OA\Post(
     *     path="/group",
     *     tags={"Group"},
     *     summary="创建用户",
     *     operationId="createGroup",
     *     security={
     *         {"token": {}},
     *     },
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  required={
     *                              "nickname",
     *                              "email",
     *                              "phone",
     *                              "identity",
     *                              "credential",
     *                              "role_ids",
     *                          },
     *                  @OA\Property(
     *                      property="nickname",
     *                      type="string",
     *                      description="用户昵称",
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      type="string",
     *                      format="email",
     *                      description="用户邮箱",
     *                  ),
     *                  @OA\Property(
     *                      property="phone",
     *                      type="string",
     *                      description="用户手机",
     *                  ),
     *                  @OA\Property(
     *                      property="identity",
     *                      type="string",
     *                      description="用户登录名称(必须唯一)",
     *                  ),
     *                  @OA\Property(
     *                      property="credential",
     *                      type="string",
     *                      format="password",
     *                      description="用户登录密码",
     *                  ),
     *                  @OA\Property(
     *                      property="role_ids",
     *                      type="array",
     *                      description="用户规则集合",
     *                      @OA\Items(
     *                          type="integer",
     *                      ),
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
     *             type="string",
     *             @OA\Property(
     *                 property="msg",
     *                 type="string",
     *                 description="提示信息",
     *              ),
     *             @OA\Property(
     *                 property="data",
     *                 type="string",
     *                 description="true为创建成功",
     *              ),
     *              example={"msg":"success","data":true}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="4xx, 客户端错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="5xx, 服务器错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     * )
     * @param Request $request
     * @return array
     * @throws ApiException
     */
    public function createGroup(Request $request)
    {
        $uGroupInfo = $request->post();
        $uGroupInfo['key'] = $uGroupInfo['property_key'];
        unset($uGroupInfo['property_key']);
        $ret = $this->groupData->createGroup($uGroupInfo);

        if ($ret) {
            $result = ReturnHelper::format('success', 200, $ret);
        } else {
            $result = ReturnHelper::format('create Group error', 400, $ret);
        }

        return $result;
    }

    /**
     * 重置密码
     * @RequestMapping(route="{uid}/password", method={RequestMethod::PUT}, params={"3", "重置密码"})
     * @OA\Put(
     *     path="/group/{uid}/password",
     *     tags={"group"},
     *     summary="重置密码",
     *     operationId="resetCredential",
     *     @OA\Parameter(
     *         name="uid",
     *         in="path",
     *         description="重置密码",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         )
     *     ),
     *     security={
     *         {"token": {}},
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
     *             type="string",
     *             @OA\Property(
     *                 property="msg",
     *                 type="string",
     *                 description="提示信息",
     *              ),
     *             @OA\Property(
     *                 property="data",
     *                 type="string",
     *                 description="重置成功的账号ID",
     *              ),
     *              example={"msg":"success","data":1}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="4xx, 客户端错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="5xx, 服务器错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     * )
     * @param int $uid
     * @return array
     * @throws ApiException
     * @throws ReflectionException
     * @throws ContainerException
     * @throws DbException
     * @throws AuthException
     */
    public function resetCredential(int $uid)
    {
        $ret = $this->accountLogic->resetPwd($uid);

        if ($ret) {
            return ReturnHelper::format('success', 200, $ret);
        } else {
            throw new ApiException('account error or not exists', 400);
        }
    }

    /**
     * 修改用户信息
     * @RequestMapping(route="{id}", method={RequestMethod::PUT}, params={"3", "修改视频"})
     * @Validate(validator="GroupValidator", fields={"name", "link","describe"})
     * @OA\Put(
     *     path="/group/{id}",
     *     tags={"Group"},
     *     summary="修改视频",
     *     operationId="editGroup",
     *     security={
     *         {"token": {}},
     *     },
     *     @OA\Parameter(
     *         name="uid",
     *         in="path",
     *         description="账号唯一标识",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         )
     *     ),
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  required={
     *                              "nickname",
     *                              "email",
     *                              "phone",
     *                              "role_ids"
     *                          },
     *                  @OA\Property(
     *                      property="nickname",
     *                      type="string",
     *                      description="用户昵称",
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      type="string",
     *                      format="email",
     *                      description="用户邮箱",
     *                  ),
     *                  @OA\Property(
     *                      property="phone",
     *                      type="string",
     *                      description="用户手机",
     *                  ),
     *                  @OA\Property(
     *                      property="role_ids",
     *                      type="array",
     *                      description="用户规则集合",
     *                      @OA\Items(
     *                          type="integer",
     *                      ),
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功",
     *         @OA\JsonContent(
     *             type="string",
     *             @OA\Property(
     *                 property="msg",
     *                 type="string",
     *                 description="提示信息",
     *              ),
     *             @OA\Property(
     *                 property="data",
     *                 type="string",
     *                 description="true为创建成功",
     *              ),
     *              example={"msg":"success","data":true}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="4xx, 客户端错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="5xx, 服务器错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     * )
     * @param Request $request
     * @param int $id
     * @return array
     * @throws ApiException
     */
    public function editGroup(Request $request, int $id)
    {
        $fields   = [
            "name",
            "link",
            "describe",
        ];
        $GroupInfo = [];
        foreach ($fields as $field) {
            $GroupInfo[$field] = $request->post($field);
        }

        $ret = $this->groupData->updateGroup($id, $GroupInfo);
        if ($ret) {
            return ReturnHelper::format('success', 200, $ret);
        } else {
            throw new ApiException('Group info error', 400);
        }
    }

    /**
     * 设置用户状态
     * @RequestMapping(route="{id}/status", method={RequestMethod::PUT}, params={"3", "设置状态"})
     * @Validate(validator="groupValidator", fields={"status"}, type=ValidateType::GET)

     *     @OA\Response(
     *         response=400,
     *         description="4xx, 客户端错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="5xx, 服务器错误",
     *         @OA\JsonContent(ref="#/components/schemas/ReturnBody")
     *     ),
     * )
     * @param Request $request
     * @param int $id
     * @return array
     * @throws ApiException
     */
    public function setStatus(Request $request, int $id)
    {
        $status['status'] = (int)$request->query('status');

        $ret = $this->groupData->updateGroup($id, $status);

        if ($ret) {
            return ReturnHelper::format('success', 200, $ret);
        } else {
            throw new ApiException('menu id error or status error', 400);
        }
    }
}
