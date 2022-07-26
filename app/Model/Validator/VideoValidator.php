<?php declare(strict_types=1);


namespace App\Model\Validator;

use Swoft\Validator\Annotation\Mapping\Email;
use Swoft\Validator\Annotation\Mapping\Enum;
use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\Length;
use Swoft\Validator\Annotation\Mapping\Mobile;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * 视频验证器
 * Class UserValidator
 * @Validator(name="AdvertiseValidator")
 */
class VideoValidator
{
    /**
     * 广告名称
     * @IsString()
     * @var string|null
     */
    protected $name;

    /**
     * 链接
     * @Email()
     * @IsString()
     * @var string|null
     */
    protected $link;


    /**
     * 状态 0：禁用 1：正常
     *
     * @IsInt()
     * @Enum(values={0,1})
     * @var int|null
     */
    protected $status = 1;



}
