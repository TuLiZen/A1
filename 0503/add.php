<?php
error_reporting(E_ALL ^ E_DEPRECATED);
//�w�����쪺��Ʈ榡
//{prod:"�ӫ~�W��",price:"��"}

$data = jason_decode(file_get_contents('php://input'));

//�@�}�l���ե�
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
	echo $err->getMessage();  //�u��@�ɤ��o�˰�
	echo '<a href="list.php">�^��C��</a>';
	exit;
}

$stmt = $db->prepare('insert into moneybook (name,cost) values (?,?)');
$stmt->execute([$_POST['prod'],$_POST['price']]);

echo "ok";