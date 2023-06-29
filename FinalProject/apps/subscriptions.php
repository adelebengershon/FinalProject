<?	
	Class Subscriptions{
		
		
	static function insert($info){
			global $db;
			$id=$db->insert('Subscriptions',$info);
			return $id;
	}
	
	function update($id, $info){
		global $db;
		$db->update('Subscriptions', $id, $info, 'subscription_id');//public function update($table_name ,$id ,$info, $p_key = 'id') {
		
	}
	
	function delete($id){
		global $db;
		$db->delete('Subscriptions', $id, 'subscription_id');//public function delete($table_name, $id = 0, $p_key = 'id') 
		
	}
	
	function getOne($id=''){
		global $db;
		return $db->getOneByKey('Subscriptions', $id, 'subscription_id');//public function getOneByKey($table_name, $id = 0, $p_key = 'id', $column_name= '*')
		
	}
	
	static function getAll($orderby='',$order_dir='ASC'){
		global $db;
		$sql="SELECT * FROM Subscriptions WHERE 1 ";

		if($orderby){
		  
		$sql .= " ORDER BY ".$orderby ." ". $order_dir; 	
			
		}
		return $db->query($sql);
		
	}
}

?>