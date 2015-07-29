<?php 
namespace Admin\Controller;
use Admin\Common\Controller\CommonController;
/**
 * 代理相关设置控制器
 */
class AgentController extends CommonController {

    // 代理规则首页视图
    public function index () {
        $this->express = M('express')->select();
        $this->agentRule = M('agent_rule')->select();
        $this->display();
    }

    // 设置配送规则视图
    public function express () {
        $this->display();
    }

    // 设置配送规则表单处理
    public function expressHandle() {
        $express = $_POST;
        // 处理传递过来的字符串
        $area = explode(',', $express['area']);
        $express['area'] = (int) $area[0];
        $express['areaname'] = $area[1];

        $db = M('express');
        $where = array(
            'area' => I('area', 0, 'intval'),
            'type' => I('type', 0, 'intval')
            );
        // 检查是否已有同地区同类型的配送规则
        $isAreaUnset = $db->where($where)->find();
        if (empty($isAreaUnset)) {
            if (M('express')->add($express)) {
                $this->success('添加规则成功', U(MODULE_NAME.'/Agent/index'));
            } else {
                $this->error('添加规则失败');
            }
        } else {
            $this->error('该地区已有同类型的配送设置');
        }
    }

    // 代理规则设置
    public function agentRule () {
        $this->display();
    }

    // 代理规则设置表单处理
    public function agentRuleHandle() {
        $rule = $_POST;
        $rule['discount'] /= 10;

        if (M('agent_rule')->add($rule)) {
            $this->success('规则添加成功', U(MODULE_NAME.'/Agent/index'));
        } else {
            $this->error('规则添加失败');
        }
    }

}

?>