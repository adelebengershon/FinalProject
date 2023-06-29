<?	
	Class Assets{
		
		
	static function insert($info){
			global $db;
			$id=$db->insert('Assets',$info);
			return $id;
	}
	
	static function update($id, $info){
		global $db;
		$db->update('Assets', $id, $info, 'asset_id');//public function update($table_name ,$id ,$info, $p_key = 'id') {
		
	}
	
	static function delete($id){
		global $db;
		$db->delete('Assets', $id, 'asset_id');//public function delete($table_name, $id = 0, $p_key = 'id') 
		
	}
	
	static function getOne($id=''){
		global $db;
		return $db->getOneByKey('Assets', $id, 'asset_id');//public function getOneByKey($table_name, $id = 0, $p_key = 'id', $column_name= '*')
		
	}
	static function getOnebyURL($url){
		global $db;
		return $db->getOneByKey('Assets', $url, 'url_name');
	}

	static function getAll($orderby='',$order_dir='ASC', $featured='', $show_on_slider='', $active='', $tag='', $type='', $buy_price='', $rent_price='', $sale_price='', $agent_id='', $category='', $price_range='', $keywords=''){
		global $db;
		$sql="SELECT *, Categories.category FROM Assets 
		LEFT JOIN Asset_Category ON Asset_Category.asset_id	 = Assets.asset_id
		LEFT JOIN Categories ON  Categories.category_id = Asset_Category.category_id
		WHERE 1 
		
		";
		
		if($featured){
			$sql .= " AND Assets.featured='".$featured."'";
		}
		if($show_on_slider){
			$sql .= " AND Assets.show_on_slider='".$show_on_slider."'";
		}
		if($active){
			$sql .= " AND Assets.active='".$active."'";
		}
		if($tag){
			$sql .= " AND Assets.tag='".$tag."'";
		}
		if($type && $type != 'all'){
			$sql .= " AND Assets.type='".$type."'";
		}
		if($buy_price){
			$sql .= " AND Assets.buy_price='".$buy_price."'";
		}
		if($rent_price){
			$sql .= " AND Assets.rent_price='".$rent_price."'";
		}
		if($sale_price){
			$sql .= " AND Assets.sale_price='".$sale_price."'";
		}
		if($agent_id){
			$sql .= " AND Assets.agent_id='".$agent_id."'";
		}
		if($category && $category!='all'){
			$sql .= " AND Asset_Category.category_id='".$category."'";
		}
		if($price_range && $price_range!='all'){
			switch($price_range){
				case 'to2000000' : $sql .= " AND Assets.buy_price<2000000 AND Asset_Category.category_id= 1" ; break;
				case '2000000to50000000' : $sql .= " AND Assets.buy_price>=2000000 AND Assets.buy_price<5000000 AND Asset_Category.category_id= 1" ; break;
				case '50000001to1000000000' : $sql .= " AND Assets.buy_price>=50000001 AND Assets.buy_price<1000000000 AND Asset_Category.category_id= 1" ; break;
				case '1000000001plus' : $sql .= " AND Assets.buy_price>=1000000001 AND Asset_Category.category_id= 1" ; break;
				case 'to5000' :$sql .= " AND Assets.rent_price<5000 AND Asset_Category.category_id= 2"  ; break;
				case '5000to9000' : $sql .= " AND Assets.rent_price>=5000 AND Assets.rent_price<9000 AND Asset_Category.category_id= 2"; break;
				case '9001to12000' : $sql .= " AND Assets.rent_price>=9001 AND Assets.rent_price<12000 AND Asset_Category.category_id= 2"; break;
				case '12001plus' :  $sql .= " AND Assets.rent_price>=12001 AND Asset_Category.category_id= 2"; break;
				default : break;
			}
		}
		if($keywords){
			$sql .= " AND Assets.title LIKE '%".$keywords."%' OR Assets.location LIKE '%".$keywords."%' OR Assets.description LIKE '%".$keywords."%'";//title location description
		}
		if($orderby){
		  
		$sql .= " ORDER BY ".$orderby ." ". $order_dir; 	
			
		}
		
		$sql .= " Group by Assets.`asset_id`";
		return $db->query($sql);
		
	}
}

?>