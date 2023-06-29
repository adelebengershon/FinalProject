<?	
	Class Asset_Category{
		
		
	static function insert($info){
			global $db;
			$id=$db->insert('Asset_Category',$info);
			return $id;
	}
	
	static function update($id, $info){
		global $db;
		$db->update('Asset_Category', $id, $info);//public function update($table_name ,$id ,$info, $p_key = 'id') {
		
	}
	
	static function delete($category_id='', $asset_id=''){
		global $db;
		$sql="DELETE * FROM Asset_Category WHERE 1 ";
		if($category_id){
			$sql .= " AND Asset_Category.category_id='".$category_id."' ";
		}
		if($asset_id){
			$sql .= " AND Asset_Category.asset_id='".$asset_id."'";
		}
		return $db->query($sql);
		//$db->delete('Asset_Category', $id, 'asset_id');//public function delete($table_name, $id = 0, $p_key = 'id') 
	}
	
	function getOne($id=''){
		global $db;
		return $db->getOneByKey('Asset_Category', $id);//public function getOneByKey($table_name, $id = 0, $p_key = 'id', $column_name= '*')
		
	}
	
	static function getAll($orderby='',$order_dir='ASC', $asset_id=''){
		global $db;
		$sql="SELECT * FROM Asset_Category WHERE 1 ";

		if($orderby){
		  
		$sql .= " ORDER BY ".$orderby ." ". $order_dir; 	
			
		}
		if($asset_id){
			$sql .= " AND Asset_Category.asset_id='".$asset_id."'";
		}
		return $db->query($sql);
		
	}
}

?>