<?	
	Class Categories{
		
		
	function insert($info){
			global $db;
			$id=$db->insert('Categories',$info);
			return $id;
	}
	
	function update($id, $info){
		global $db;
		$db->update('Categories', $id, $info, 'category_id');//public function update($table_name ,$id ,$info, $p_key = 'id') {
		
	}
	
	function delete($id){
		global $db;
		$db->delete('Categories', $id, 'category_id');//public function delete($table_name, $id = 0, $p_key = 'id') 
		
	}
	
	function getOne($id=''){
		global $db;
		return $db->getOneByKey('Categories', $id, 'category_id');//public function getOneByKey($table_name, $id = 0, $p_key = 'id', $column_name= '*')
		
	}
	
	static function getAll($orderby='',$order_dir='ASC', $asset_id=''){
		global $db;
		$sql="SELECT * FROM Categories 
		LEFT JOIN Asset_Category ON Categories.category_id = Asset_Category.category_id
		WHERE 1 ";
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