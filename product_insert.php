﻿<?
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$storeId = $_POST['storeId'];
$modelNumber = $_POST['modelNumber'];
$guitarType = $_POST['guitarType'];
$price = $_POST['price'];
$description = $_POST['description'];

$result1 = mysqli_query($conn, "insert into Guitar (modelNumber, price, guitarType, description) VALUES ('$modelNumber',$price,'$guitarType','$description');");
$Id = mysqli_insert_id($conn);
$result2 = mysqli_query($conn, "insert into Stock (storeId, guitarId) values ($storeId, $Id);");

if(!$result1 or !$result2)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 추가되었습니다!');
	echo "<script>location.replace('product_list.php');</script>";

}

?>

