<?php

namespace app\models;

/**
 * 常量定义
 *
 * @author hiscaler
 */
class Constant
{
    /**
     * 布尔值
     */
    /** False */
    const BOOLEAN_FALSE = 0;
    /** True */
    const BOOLEAN_TRUE = 1;
    
     /**
     * 状态
     */
    /** 草稿 */
    const STATUS_DRAFT = 0;
    /** 待审核 */
    const STATUS_PENDING = 1;
    /** 发布 */
    const STATUS_PUBLISHED = 2;
    /** 删除 */
    const STATUS_DELETED = 3;

    /**
     * 性别
     */
    /** 女 */
    const SEX_FEMALE = 0;
    /** 男 */
    const SEX_MALE = 1;
    /** 保密 */
    const SEX_UNKNOWN = 2;
    
    /**
     * 图片尺寸
     */
    /** 小图 */
    const IMAGE_SIZE_SMALL = 'small';
    /** 中图 */
    const IMAGE_SIZE_MEDIUM = 'medium';
    /** 大图 */
    const IMAGE_SIZE_LARGE = 'large';
    /** 无损图 */
    const IMAGE_SIZE_ORIGINAL= 'original';
    
    /**
     * 订单付款方式
     */
    /** 支付宝 */
    const ORDER_PAYMENT_ALIPAY = 0;
    /** 微信支付 */
    const ORDER_PAYMENT_WECHATPAY = 1;
    /** 现金余额支付 */
    const ORDER_PAYMENT_CASH_RESERVE = 2;
    
    /**
     * 订单状态
     */
    /** 待审核 */
    const ORDER_STATUS_PENDING = 0;
    /** 未付款 */
    const ORDER_STATUS_UNPAID = 1;
    /** 已付款 */
    const ORDER_STATUS_PAID = 2;
    /** 退款 */
    const ORDER_STATUS_REFUND= 3;
    /** 无效 */
    const ORDER_STATUS_VOID= 10;
    /** 取消 */
    const ORDER_STATUS_CANCEL= 11;
    /** 完成 */
    const ORDER_STATUS_FINISHED= 12;

}
