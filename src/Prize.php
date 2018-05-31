<?php
// +----------------------------------------------------------------------
// | 处理中奖结果
// +----------------------------------------------------------------------
// | 版权所有
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/JZhao1020/prize-sdk
// +----------------------------------------------------------------------

namespace Prize;

/**
 * 数据格式（id：奖项id；prize：奖项名称；v：该奖项中奖概率）：
 * [
 *    ['id' => 1,'prize' => '一等奖', 'v' => 1],
 *    ['id' => 2,'prize' => '二等奖', 'v' => 10],
 *    ['id' => 3,'prize' => '三等奖', 'v' => 100],
 *    ['id' => 4,'prize' => '谢谢参与', 'v' => 1000],
 * ];
 *
 */
class Prize{
    /**
     * 处理获取中奖奖项id
     * @param array $arr
     * @return int|false
     */
    private function get_rand($arr){
        //获取奖项的总概率
        $probability = array_sum($arr);
        if($probability == 0){
            return 0;
        }

        foreach($arr as $key => $val){
            $random = mt_rand(1,$probability);
            if($random <= $val){
                return $key;
            }else{
                $probability -= $val;
            }
        }
    }


    /**
     * 接收数据，处理返回中奖结果
     * @param array $data
     * @param array $field 数据中对应的键名数组
     * @return array|false
     */
    public function init(array $data, $field = array('id','prize','v')){
        if(count($data) <= 0) {
            return false;
        }

        //数据重组成一维数组，随机返回获取奖项id
        $prize = array();
        foreach ($data as $key => $val){
            $prize[$val[$field[0]]] = $val[$field[2]];
        }
        $prize_id = $this->get_rand($prize);
        $result = array(
            $field[0] => $data[$prize_id][$field[0]],
            $field[1] => $data[$prize_id][$field[1]],
            $field[2] => $data[$prize_id][$field[2]],
        );
        return $result;
    }
}