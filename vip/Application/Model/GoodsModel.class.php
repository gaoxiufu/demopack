<?php
/**
 * Description of GoodsModel
 *
 * @author Administrator
 */
class GoodsModel extends Model {
    //声明方法 读取数据列表
    public function getList($fields="*",$pageIndex=1,$pageSize=2){
        //获取所有数据
        return $this->getPage($fields,$pageIndex,$pageSize);
    }
    //书写方法获取总的条数
    public function getRecordsCount(){
        return $this->getCount();
    }
}
