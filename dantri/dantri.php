<?php
	require "dbConnect.php";
	require "simple_html_dom.php";
	$html =file_get_html("https://dantri.com.vn/giai-tri.htm");
	$tins =$html->find("[data-boxtype='timelineposition']");
	// echo count($tins);
	foreach($tins as $item){
		//lấy tiêu đề
		$a = $item->find("a",0);
		$title= $a->attr["title"];
		//lấy đường dẫn tiêu đề
		$href= $a->href;
		//lấy ảnh
		$img= $a->find("img",0)->src;
		$image ='image/'.basename($img);
		file_put_contents($image, file_get_contents($img));
		//lấy description
		echo $desc = $item->find("div.mr1 div",0);
		//insert in database
		$tenFile =basename($img);
		$title = htmlentities($title, ENT_QUOTES, "UTF-8");
		$desc = htmlentities($desc, ENT_QUOTES, "UTF-8");
		$qr = "INSERT INTO giaitri VALUES (null, '$title','$desc','$tenFile')";
		mysqli_query($con,$qr);
	}
?>