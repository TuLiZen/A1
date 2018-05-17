<?php
//error_reporting(0);
//修改 php\ php.ini 中702行
//
//預期收到的資料格式
//{prod:"商品名稱",price:"值"}

//輸入=============================================================================
//預期收到的資料格式 (prod"商品名稱" price"值")
$data = jason_decode(file_get_contents('php://input'));

//一開始測試用
//echo $data->{"prod"} ;
//echo $data->{"price"};

//檢查你的資料，暫時省略

//資料庫操庫==================================================================
try {
	$db = new PDO('mysql:host=localhost;dbname=test0329;charset=utf8'
		,'mememe','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err) {
	http_response_code(500);
	echo "failed";
	echo $err->getMessage();  //測試時候使用
	exit;
}

$stmt = $db->prepare('insert into moneybook (name,cost) values (?,?)');
$stmt->execute([$_POST['prod'],$_POST['price']]);

//輸出======================================================================
$data->("id") = &db->lastInsertId(); //取得前一次insert 的id

http_response_code(201);
header("Content-Type","application/json;charset=UTF-8");
echo json_encode($data); //把insert的資料再傳回給用戶端