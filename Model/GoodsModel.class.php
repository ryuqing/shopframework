<?php 

defined('ACC')||exit('ACC Denied');

class GoodsModel extends Model{
	protected $table = 'goods';
	protected $pk = 'goods_id';
	protected $fields = array( 'goods_id','goods_sn','cat_id','brand_id','goods_name','shop_price','market_pric','goods_numbe','click_count','goods_weigh','goods_brief','goods_desc','thumb_img','goods_img','ori_img','is_on_sale','is_delete','is_best','is_new','is_hot','add_time','last_update');
	protected $_auto=array(
							array('is_hot','value','0'),
							array('is_hot','value','0'),
							array('is_hot','value','0'),
							array('add_time','function','time')
							);
	//parm int id return boll
	public function trash($id){
		return $this->update(array('is_delete'=>1),$id);
	}

	public function getGoods(){
		$sql = 'select * from goods where is_delete=0';
		return $this->db->getAll($sql);
	}

	public function getTrash(){
	$sql = 'select * from goods where is_delete=1';
	return $this->db->getAll($sql);
	}

	/*创建商品的货号*/
	public function createSn(){
		$sn='BL'.date('Ymd') . mt_rand(10000,99999);
		$sql = 'select count(*) from '. $this->table . " where goods_sn='".$sn."'";
		return $this->db->getOne($sql)?$this->createSn():$sn;
	}

	/*取出指定条数的新品*/
	public function getNew($n=5){
		$sql = 'select goods_id,goods_name,shop_price,market_price,thumb_img from '.$this->table.' order by add_time limit 5';
		return $this->db->getAll($sql);
	}
}

?>
