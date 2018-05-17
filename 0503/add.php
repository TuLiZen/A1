<?php
error_reporting(E_ALL ^ E_DEPRECATED);
//預期收到的資料格式
//{prod:"商品名稱",price:"值"}

$data = jason_decode(file_get_contents('php://input'));

//一開始測試用
//echo $data->{"prod"} ;
//echo $data->{"price"};

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

$stmt = $db->prepare('insert into moneybook (name,cost) values (?,?)');
$stmt->execute([$_POST['prod'],$_POST['price']]);

echo "ok";