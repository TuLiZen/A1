<?php
//error_reporting(0);
//�ק� php\ php.ini ��702��
//
//�w�����쪺��Ʈ榡
//{prod:"�ӫ~�W��",price:"��"}

//��J=============================================================================
//�w�����쪺��Ʈ榡 (prod"�ӫ~�W��" price"��")
$data = jason_decode(file_get_contents('php://input'));

//�@�}�l���ե�
//echo $data->{"prod"} ;
//echo $data->{"price"};

//�ˬd�A����ơA�Ȯɬٲ�

//��Ʈw�ޮw==================================================================
try {
	$db = new PDO('mysql:host=localhost;dbname=test0329;charset=utf8'
		,'mememe','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err) {
	http_response_code(500);
	echo "failed";
	echo $err->getMessage();  //���ծɭԨϥ�
	exit;
}

$stmt = $db->prepare('insert into moneybook (name,cost) values (?,?)');
$stmt->execute([$_POST['prod'],$_POST['price']]);

//��X======================================================================
$data->("id") = &db->lastInsertId(); //���o�e�@��insert ��id

http_response_code(201);
header("Content-Type","application/json;charset=UTF-8");
echo json_encode($data); //��insert����ƦA�Ǧ^���Τ��