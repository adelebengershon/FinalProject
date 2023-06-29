<?	
	Class Agents{
		
		
	static function insert($info){
			global $db;
			$url=$info['agent_firstname']."_".$info['agent_lastname'];
			$info[url_name]=$url;
			$id=$db->insert('Agents',$info);
			return $id;
	}
	
	static function update($id, $info){
		global $db;
		$url=$info['agent_firstname']."_".$info['agent_lastname'];
			$info[url_name]=$url;
		$db->update('Agents', $id, $info, 'agent_id');//public function update($table_name ,$id ,$info, $p_key = 'id') {
		
	}
	
	static function delete($id){
		global $db;
		$db->delete('Agents', $id, 'agent_id');//public function delete($table_name, $id = 0, $p_key = 'id') 
		
	}
	
	static function getOne($id=''){
		global $db;
		return $db->getOneByKey('Agents', $id, 'agent_id');//public function getOneByKey($table_name, $id = 0, $p_key = 'id', $column_name= '*')
		
	}
	
	static function getOnebyURL($url){
		global $db;
		return $db->getOneByKey('Agents', $url, 'url_name');
	}
	
	static function getAll($orderby='',$order_dir='ASC'){
		global $db;
		$sql="SELECT * FROM Agents WHERE 1 ";

		if($orderby){
		  
		$sql .= " ORDER BY ".$orderby ." ". $order_dir; 	
			
		}
		return $db->query($sql);
		
	}
}

?>