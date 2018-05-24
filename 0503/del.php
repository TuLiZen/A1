<?php
//輸入=======================================================================
//預期收到的資料格式(id:值)=======================================================================

//資料庫操作===================================================================
try {
	$db = new PDO('mysql:host=localhost;dbname=test0329;charset=utf8'
		,'mememe','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err) {
	echo "ERROR:";
	echo $err->getMessage();  //真實世界不這樣做
	echo '<a href="list.php">回到列表</a>';
	exit;
}


//查詢=======================================================================
$stmt = $db->prepare('insert into moneybook (name,cost) values (?,?)');
$stmt->execute([$_POST['prod'],$_POST['price']]);

//輸出=======================================================================
$data=array();

while($row=$stmt->fetch()){
	$data[]=(object)[
		'prod'=>$row['name']
		'price'=>$row['coat']
		'id'=>$row['m_id']
	];
}

http_response_code(200);
header("Content-Cype: application/json;charset=UTF-8");
echo json_encode($data);
