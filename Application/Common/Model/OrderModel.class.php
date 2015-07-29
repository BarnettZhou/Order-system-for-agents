<?php 
namespace Common\Model;
use Think\Model\RelationModel;
/**
 * 订单模型
 */
class OrderModel extends RelationModel {
    // 定义主表
    protected $tableName = 'order';

    // 定义关联关系
    protected $_link = array(
        'product' => array(
            'mapping_type' => self::HAS_MANY,
            'mapping_table' => 'order_products',
            'foreign_key'  => 'aid',
            'relation_key' => 'pid',
            ),
        );
}
?>