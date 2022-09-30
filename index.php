<?php
function resize($image=array(), $dest){
		$image_vide=imagecreate(412, 682);
		$bg=imagecolorallocate($image_vide, 0, 0, 0);
		$c_ligne=1;
		$c_colonne=1;
		for($i=0; $i<count($image); $i++){
			$gd_image=imagecreatefromjpeg($image[$i]);
			$sizes=getimagesize($image[$i]);
			$im=imagecopyresampled($image_vide, $gd_image, $c_colonne, $c_ligne, 0, 0, 100 , 100 , $sizes[0], $sizes[1]);
			//imagecopyresampled(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
			$c_colonne+=102;
			if($c_colonne>400){
				$c_colonne=1;
				$c_ligne+=107;
			}
		}
		imagejpeg($image_vide, 'images/finale/all'.$dest.'.jpeg', 100);

	}
if(isset($_POST['submit'])){
	
	if($_FILES['images']['size']!=0){
		$images=$_FILES['images'];
	for($i=0; $i<count($_FILES['images']['name']); $i++){
	
		move_uploaded_file($_FILES['images']['tmp_name'][$i], 'images/'.$_FILES['images']['name'][$i]);
		
	}
	$all_image=glob('images/*.*', GLOB_BRACE);

	resize($all_image, 'image');
	//move_uploaded_file(filename, destination)
}
}
?>
<div>
	<form method="post" action="" enctype="multipart/form-data">
		<input type="file" name="images[]" multiple="">
		<br>
		<input type="submit" name="submit" value="envoyer">
	</form>
</div>