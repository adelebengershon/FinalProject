<?  /*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

	$title='Bootstrap Realestate';
	$page_description='Real Estate';
	$page_keywords='real estate';
	include_once "../application.php";
	include_once "../includes/header.php";
	?>
<div class="container wrapper">

	<h3>Assets</h3>
	<br/> 
	<?
	switch($_REQUEST['action'])//$_REQUEST works for both : $_GET + $_POST
	{
		case 'add' : add_Asset(); break;
		case 'insert' : insert_Asset(); break;
		case 'edit' : edit_Asset($_REQUEST['id']); break;
		case 'save_edit' : save_Asset($_REQUEST, ); break;
		case 'delete' : delete_Asset($_REQUEST['id']); break;
		default : show_List(); break;
	}	
?>
<?
	function show_List()
	{
		$assets = Assets::getAll();
		?>
		<input type="button" onclick="location.href='index.php';" value="Go Back" />
			<h5>All existing assets:</h5>
				<table>
						<thead>
							<tr>
								<?
								foreach ($assets[0] as $key=>$value)//getting the title of each row
								{
									echo "<td>".$key."</td>";
								}
								?>
							</tr>
						</thead>
						<tbody>
							<?
							foreach ($assets as $asset)//getting the title of each row
							{
								echo "<tr>";
								foreach($asset as $value)
								{
									echo "<td>".$value."</td>";
								}
								echo "<td><a href='".parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)."?action=edit&id=".$asset['asset_id']."'>Edit</td></a>";
								echo "<td id='delete'><a onclick='confirm_delete(".$asset['asset_id'].");'>Delete</a></td>";
								echo "</tr>";
							}
							?>
						</tbody>
					</table>
					<button onclick = "window.location.href='http://adelebengershon.com/Adele_Ben-Gershon/aaaFinalProject/admin/assets.php?action=add';" >
						Add a new Asset
					</button>
	<?}//closing showlist()
	
	function uploadImg($id)
	{		
	global $config;
	    
		//php lesson 4- for adding images
		print_r($_FILES);//printing array of the uploaded file, showing name,type,tmp-name,size
		
		$uploadOK = true;
		$target_dir = $config->filepath."images/asset_img/";
		echo $target_dir;
		$imgType=$_FILES['assetImg']['type'];
		if($imgType!='image/gif' && $imgType!='image/jpeg' && $imgType!='image/png' && ($_FILES['assetImg']['size']) < 0){
			echo "You can only upload an Image(.gif/.jpg/.png)";
			$uploadOK=false;				
		}
		switch ($imgType) 
		{
			case 'image/gif' : $imgtype='.gif';break;
			case 'image/jpeg' : $imgtype='.jpg'; break;
			case 'image/png' : $imgtype='.png';break;
		}
		if(($_FILES['assetImg']['size']) > 500000000)
		{
			echo "You can only upload an Image with max size of 500000000 B";
			$uploadOK=false;	
		}
		if($uploadOK)
		{
			$locationAndName=$target_dir.$id.$imgtype;
			move_uploaded_file($_FILES['assetImg']['tmp_name'], $locationAndName);
			$info['img_name']=$id.$imgtype;
			Assets::update($id, $info);
			echo "Image succesfully uploaded";
		}	
	}
	function insert_Asset()
	{
		//asset_id	title	location	agent_id	buy_price	rent_price	sale_price	type	kitchen	bedroom	parking	living_room	description	show_on_slider	featured	tag	active	url_name	

		if($_POST["title"])
			$info["title"]=$_POST["title"];
		if($_POST["location"])
			$info["location"]=$_POST["location"];
		if($_POST["agent_id"])
			$info["agent_id"]=$_POST["agent_id"];
		if($_POST["buy_price"])
			$info["buy_price"]=$_POST["buy_price"];
		if($_POST["rent_price"])
			$info["rent_price"]=$_POST["rent_price"];
		if($_POST["sale_price"])
			$info["sale_price"]=$_POST["sale_price"];
		if($_POST["type"])
			$info["type"]=$_POST["type"];
		if($_POST["kitchen"])
			$info["kitchen"]=$_POST["kitchen"];
		if($_POST["bedroom"])
			$info["bedroom"]=$_POST["bedroom"];
		if($_POST["parking"])
			$info["parking"]=$_POST["parking"];
		if($_POST["living_room"])
			$info["living_room"]=$_POST["living_room"];
		if($_POST["description"])
			$info["description"]=$_POST["description"];
		if($_POST["show_on_slider"])
			$info["show_on_slider"]=$_POST["show_on_slider"];
		if($_POST["featured"])
			$info["featured"]=$_POST["featured"];
		if($_POST["tag"])
			$info["tag"]=$_POST["tag"];
		if($_POST["active"])
			$info["active"]=$_POST["active"];
		if($_POST["url_name"])
			$info["url_name"]=$_POST["url_name"];
		
		if($_POST["buy"])
			$arr["buy"]=$_POST["buy"];
		if($_POST["rent"])
			$arr["rent"]=$_POST["rent"];
		if($_POST["sale"])
			$arr["sale"]=$_POST["sale"];
		
		if($info) $id = Assets::insert($info);
		if($arr && $id){
			foreach($arr as $catid){
				$cat['asset_id']=$id;
				$cat['category_id']=$catid;
				Asset_Category::insert($cat);
			}
		}
		if($id)
		{
			$message = "Succesfully added another asset";
			uploadImg($id);
		}
		
		echo $message;
		show_List();
	}
		
		function add_Asset()
		{
			$Agents=Agents::getAll();
		?>
			<h2>Add an asset</h2>
				<form method="post" action="assets.php" enctype="multipart/form-data">
					<input type ="hidden" name="action" value="insert"/>
					<input type="hidden" name="title"/>
					<br/><label>Title </label>
					<br/><input type="text" name="title"/>
					<br/><label>Location </label>
					<br/><input type="text" name="location"/>
					<br/><label>Agent </label>
					<br/><select name="agent_id">
						<?foreach($Agents as $agent)
						{?>
							<option value="<?echo $agent['agent_id']?>">
							<?echo $agent['agent_firstname']." ".$agent['agent_lastname'];?>
							</option>
						<?}?>
					</select> 
					<br/><label>Buy Price </label>
					<br/><input type="decimal" name="buy_price"/>
					<br/><label>Rent Price </label>
					<br/><input type="decimal" name="rent_price"/>
					<br/><label>Sale Price </label>
					<br/><input type="decimal" name="sale_price"/>
					<br/><label>Type </label>
					<br/><select name="type">
					  <option value="Apartment">Apartment</option>
					  <option value="Building">Building</option>
					  <option value="Office Space">Office Space</option>
					</select>
					<br/><label>Amount of Kitchens </label>
					<br/><input type="number" name="kitchen"/>
					<br/><label>Amount of Bedrooms </label>
					<br/><input type="number" name="bedroom"/>
					<br/><label>Amount of Parking </label>
					<br/><input type="number" name="parking"/>
					<br/><label>Amount of Living Rooms </label>
					<br/><input type="number" name="living_room"/>
					<br/><label>Description </label>
					<br/><textarea name="description" class="textara"></textarea>
					<br/><label>Show on slider: </label>
					<input type="radio" name="show_on_slider" value="Y">Yes
					<input type="radio" name="show_on_slider" value="N">No
					<br/><label>Show in Featured: (Only if has a buy price)</label>
					<input type="radio" name="featured" value="Y">Yes
					<input type="radio" name="featured" value="N">No
					<br/><label>Tag</label>
					<br/><select name="tag">
						<option value="Null"></option>
						<option value="New">New</option>
						<option value="Sold">Sold</option>
					</select>
					<br/><label>Choose Categories:</label>
					</br><input type="checkbox" name="buy" value="1">
					<label for="buy"> Buy</label><br>
					<input type="checkbox" name="rent" value="2">
					<label for="rent"> Rent</label><br>
					<input type="checkbox" name="sale" value="3">
					<label for="sale"> Sale</label>
					
					<br/><label>Active</label>
					<input type="radio" name="active" value="Y">Yes
					<input type="radio" name="active" value="N">No
					<br/><label>URL-Name </label>
					<br/><input type="text" name="url_name"/>
					
					<br/><label>Select an image to upload:</label>
					<br/><input type="file" name="assetImg">
					
					<br/>
					<br/>
					<br/><input type="submit" value="Add Asset"/>
				</form>	
				<button onclick = "window.location.href='http://adelebengershon.com/Adele_Ben-Gershon/aaaFinalProject/admin/assets.php';" >
						Cancel
				</button>
			<?
	}//closing addAgent()
			?>	
<?
function edit_Asset($id)
	{
		$asset = Assets::getOne($id);
		$Agents=Agents::getAll();
		$agentexist=Agents::GetOne($asset['agent_id']);
		$categories=Asset_Category::GetAll('','',$id);
		//print_r($categories);
		?>
			<div>
				<h4>Edit Asset</h4>
				<form method="post" action="assets.php" enctype="multipart/form-data" id="editAsset">
					<input type="hidden" name="action" value="save_edit"/>
					<input type="hidden" name="asset_id" value="<?  echo $asset['asset_id']?>"/>
										
					<br/><label>Title </label>
					<br/><input type="text" name="title" value="<? echo $asset['title']?>"/>
					<br/><label>Location </label>
					<br/><input type="text" name="location" value="<? echo $asset['location']?>"/>
					
					<br/><label>Agent </label>
					<br/><select name="agent_id">
						<?foreach($Agents as $agent)
						{?>
							<option value="<?echo $agent['agent_id']?>" <?if($agent['agent_id'] == $asset['agent_id']) echo 'selected';?>>
							<?echo $agent['agent_firstname']." ".$agent['agent_lastname'];?>
							</option>
						<?}?>
					</select>
									
					<br/><label>Buy Price </label>
					<br/><input type="decimal" name="buy_price" value="<? echo $asset['buy_price']?>"/>
					<br/><label>Rent Price </label>
					<br/><input type="decimal" name="rent_price" value="<? echo $asset['rent_price']?>"/>
					<br/><label>Sale Price </label>
					<br/><input type="decimal" name="sale_price" value="<? echo $asset['sale_price']?>"/>
					<br/><label>Type </label>
					<br/><select name="type" value="<? echo $asset['type']?>">
					  <option value="Apartment" <?if($asset['type'] == 'Apartment') echo 'selected';?>>Apartment</option>
					  <option value="Building" <?if($asset['type'] == 'Building') echo 'selected';?> >Building</option>
					  <option value="Office Space" <?if($asset['type'] == 'Office Space') echo 'selected';?> >Office Space</option>
					</select>
					<br/><label>Amount of Kitchens </label>
					<br/><input type="number" name="kitchen" value="<? echo $asset['kitchen']?>"/>
					<br/><label>Amount of Bedrooms </label>
					<br/><input type="number" name="bedroom" value="<? echo $asset['bedroom']?>"/>
					<br/><label>Amount of Parking </label>
					<br/><input type="number" name="parking" value="<? echo $asset['parking']?>"/>
					<br/><label>Amount of Living Rooms </label>
					<br/><input type="number" name="living_room" value="<? echo $asset['living_room']?>"/>
					<br/><label>Description </label>
					<br/><textarea name="description" class="textara"><? echo $asset['description']?></textarea>
					<br/><label>Image Name </label>
					<br/><input type="text" name="img_name" value="<? echo $asset['img_name']?>"/>
					<!---->
					<br/><label>Show on slider: </label>
					<input type="radio" name="show_on_slider" value="Y" <?if ($asset['show_on_slider'] == 'Y') echo 'checked';?>>Yes
					<input type="radio" name="show_on_slider" value="N" <?if ($asset['show_on_slider'] == 'N') echo 'checked';?> >No
					<br/><label>Show in Featured: </label>
					<input type="radio" name="featured" value="Y" <?if ($asset['featured'] == 'Y') echo 'checked';?> >Yes
					<input type="radio" name="featured" value="N" <?if ($asset['featured'] == 'N') echo 'checked';?> >No
					<br/><label>Tag</label>
					<br/><select name="tag">
						<option value="Null" ></option>
						<option value="New" <?if($asset['tag'] == 'New') echo 'selected';?>>New</option>
						<option value="Sold" <?if($asset['tag'] == 'Sold') echo 'selected';?> >Sold</option>
					</select>
					<br/><label>Choose Categories:</label>
					</br><input type="checkbox" name="buy" value="1" <?if ($categories[0]['category_id'] == '1' || $categories[1]['category_id'] == '1' || $categories[2]['category_id'] == '1') echo 'checked';?>><?//$categories[0] points to the first record that was returned, and that's what you need to check.?>
					<label for="buy"> Buy</label><br>
					<input type="checkbox" name="rent" value="2" <?if ($categories[0]['category_id'] == '2' || $categories[1]['category_id'] == '2' || $categories[2]['category_id'] == '2') echo 'checked';?>>
					<label for="rent"> Rent</label><br>
					<input type="checkbox" name="sale" value="3" <?if ($categories[0]['category_id'] == '3' || $categories[1]['category_id'] == '3' || $categories[2]['category_id'] == '3') echo 'checked';?>>
					<label for="sale"> Sale</label>
					
					<br/><label>Active</label>
					<input type="radio" name="active" value="Y" <?if ($asset['active'] == 'Y') echo 'checked';?> >Yes
					<input type="radio" name="active" value="N" <?if ($asset['active'] == 'N') echo 'checked';?> >No
					<br/><label>URL-Name </label>
					<br/><input type="text" name="url_name" value="<? echo $asset['url_name']?>"/>
					
					<input type="submit" value="Save">
				</form>
			</div>
<?
	}//closing editAgent
	
	function save_Asset($data)
	{
		$arr['title']=$data['title'];
		$arr['location']=$data['location'];
		$arr['agent_id']=$data['agent_id'];
		$arr['buy_price']=$data['buy_price'];
		$arr['rent_price']=$data['rent_price'];
		$arr['sale_price']=$data['sale_price'];
		$arr['type']=$data['type'];
		$arr['kitchen']=$data['kitchen'];
		$arr['bedroom']=$data['bedroom'];
		$arr['parking']=$data['parking'];
		$arr['living_room']=$data['living_room'];
		$arr['description']=$data['description'];
		$arr['show_on_slider']=$data['show_on_slider'];
		$arr['featured']=$data['featured'];
		$arr['tag']=$data['tag'];
		$arr['active']=$data['active'];
		$arr['url_name']=$data['url_name'];
		
		
		if($data["buy"])
			$arrl["buy"]=$data["buy"];
		if($data["rent"])
			$arrl["rent"]=$data["rent"];
		if($data["sale"])
			$arrl["sale"]=$data["sale"];

		//No need to check each one, just delete all and then add, what is needed.
		/*$allAssetCat = Asset_Category::getAll('','',$data['asset_id']);
		echo "allAssetCat: \t";
		print_r($allAssetCat);
		foreach($allAssetCat as $aac){
			if($aac['category_id']!=$arrl["buy"] && $aac['category_id']!=$arrl["rent"] && $aac['category_id']!=$arrl["sale"]){
				Asset_Category::delete($aac['category_id'],$data['asset_id']);
			}
		}	*/
		
		Asset_Category::delete('',$data['asset_id']);//deleting all from this asset_id
		
		if($arrl){
			foreach($arrl as $catid){
				$cat['category_id']=$catid;
				$cat['asset_id']=$data['asset_id'];
				//bcs i deleted all, no need to check:
				/*foreach($allAssetCat as $aac){//Array ( [category_id] => 1 [asset_id] => 1 )
					if($cat['category_id']!=$aac['category_id'] && $cat['asset_id']==$aac['asset_id']){
						$acid=Asset_Category::insert($cat);
					}
				}*/
				Asset_Category::insert($cat);//each one inserting to db
			}			
		}
		
		if(Assets::update($data['asset_id'], $arr))
		{
			echo"</br>The changes were updated";
			
		}
		show_List();
	}//closing 
	
	function delete_Asset($id){
		Assets::delete($id);
		Asset_Category::delete($id);
		echo "<br/>The entry was deleted";
		show_List();
	}
	?>
</div><!--closing contaienr-->
<?
		include "../includes/footer.php";
?>
<script>
		function confirm_delete(id){
			var confirm_it=confirm("Are you sure to delete this entry?");
			if(confirm_it)
				window.location.href="http://adelebengershon.com/Adele_Ben-Gershon/aaaFinalProject/admin/assets.php?action=delete&id="+id;
			else return false;	
		}
		
		
	$(document).ready(function(){
		$(".active").removeClass("active");
		$("#navAdmin").addClass("active");
	});
	</script>