﻿<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "product_insert.php";

if (array_key_exists("stockId", $_GET)) {
    $stockId = $_GET["stockId"];
    $query =  " select * from Stock S inner join Guitar G on S.guitarId = G.guitarId where stockId = $stockId";
    $result = mysqli_query($conn, $query);
    $stock = mysqli_fetch_array($result);
    if(!$stock) {
        msg("물품이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "product_modify.php";
}

$store = array();

$query = "select * from Store";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)) {
    $store[$row['storeId']] = $row['storeName'];
}
?>
    <div class="container">
        <form name="product_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="stockId" value="<?=$stock['stockId']?>"/>
            <h3>재고 정보 <?=$mode?></h3>
            <p>
                <label for="storeId">상점</label>
                <select name="storeId" id="storeId">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($store as $id => $name) {
                            if($id == $stock['storeId']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="modelNumber">모델 번호</label>
                <input type="text" placeholder="모델 번호 입력" id="modelNumber" name="modelNumber" value="<?=$stock['modelNumber']?>"/>
            </p>
            <p>
                <label for="guitarType">기타 종류 입력</label>
                <textarea placeholder="기타타입 (P: 합판, T: 탑솔리드 , B: 탑백솔리드, A: 올솔리드) " id="guitarType" name="guitarType" rows="10"><?=$stock['guitarType']?></textarea>
            </p>
            <p>
                <label for="price">가격</label>
                <input type="number" placeholder="정수로 입력" id="price" name="price" value="<?=$stock['price']?>" />
            </p>
            <p>
                <label for="description">기타 설명</label>
                <input type="text" placeholder="설명을 입력해주세요" id="description" name="description" value="<?=$stock['description']?>" />
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("storeId").value == "-1") {
                        alert ("상점을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("modelNumber").value == "") {
                        alert ("기타의 모델 번호를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("guitarType").value == "") {
                        alert ("기타의 종류를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("price").value == "") {
                        alert ("가격을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("description").value == "") {
                        alert ("기타의 설명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("guitarType").value !="P"){
                		if(document.getElementById("guitarType").value !="T"){
                			if(document.getElementById("guitarType").value !="B"){
                				if(document.getElementById("guitarType").value !="A"){
                					alert ("기타의 종류는 P,T,B,A 중 하나로 입력해주세요"); return false;
                			}
                		}
                	}
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>