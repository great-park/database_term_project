﻿<?
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$stockId = $_POST[stockId];
$modelNumber = $_POST['modelNumber'];
$guitarType = $_POST['guitarType'];
$storeId = $_POST['storeId'];
$price = $_POST['price'];
$description = $_POST['description'];

$guitarId = mysqli_query($conn,"select guitarId from Stock where stockId = '$stockId';");


$result1 = mysqli_query($conn, "UPDATE Guitar set modelNumber = '$modelNumber' , price = $price , guitarType = '$guitarType' , description = '$description' where guitarId = $stockId;");
$result2 = mysqli_query($conn, "UPDATE Stock set guitarId = $stockId , storeId = $storeId where stockId = $stockId;");


if(!$result1 or !$result2)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<script>location.replace('product_list.php');</script>";
}

?>

