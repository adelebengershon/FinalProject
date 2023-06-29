<?	
	Class Contact_Us{
		
	static function insert($info){
			global $db;
			$id=$db->insert('Contact_Us', $info);
			return $id;
	}
	
	function update($id, $info){
		global $db;
		$db->update('Contact_Us', $id, $info, 'contactus_id');//public function update($table_name ,$id ,$info, $p_key = 'id') {
		
	}
	
	function delete($id){
		global $db;
		$db->delete('Contact_Us', $id, 'contactus_id');//public function delete($table_name, $id = 0, $p_key = 'id') 
		
	}
	
	function getOne($id=''){
		global $db;
		return $db->getOneByKey('Contact_Us', $id, 'contactus_id');//public function getOneByKey($table_name, $id = 0, $p_key = 'id', $column_name= '*')
		
	}
	
	function getAll($orderby='',$order_dir='ASC'){
		global $db;
		$sql="SELECT * FROM Contact_Us WHERE 1 ";

		if($orderby){
		  
		$sql .= " ORDER BY ".$orderby ." ". $order_dir; 	
			
		}
		return $db->query($sql);
		
	}
}

?>