<?php
//��J=======================================================================
//�w�����쪺��Ʈ榡(id:��)=======================================================================

//��Ʈw�ާ@===================================================================
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


//�d��=======================================================================
$stmt = $db->prepare('insert into moneybook (name,cost) values (?,?)');
$stmt->execute([$_POST['prod'],$_POST['price']]);

//��X=======================================================================
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
