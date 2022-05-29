﻿<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("stockId", $_GET)) {
    $stockId = $_GET["stockId"];
    $query = "select * from Stock natural join Guitar where stockId = $stockId";
    $result = mysqli_query($conn, $query);
    $stock = mysqli_fetch_assoc($result);
    if (!$stock) {
        msg("물품이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>상품 정보 상세 보기</h3>

        <p>
            <label for="stockId">재고 번호</label>
            <input readonly type="text" id="stockId" name="stockId" value="<?= $stock['stockId'] ?>"/>
        </p>

        <p>
            <label for="modelNumber">모델 번호</label>
            <input readonly type="text" id="modelNumber" name="modelNumber" value="<?= $stock['modelNumber'] ?>"/>
        </p>

        <p>
            <label for="guitarType">기타 종류</label>
            <input readonly type="text" id="guitarType" name="guitarType" value="<?= $stock['guitarType'] ?>"/>
        </p>

        <p>
            <label for="description">기타 설명</label>
            <textarea readonly id="description" name="description" rows="10"><?= $stock['description'] ?></textarea>
        </p>

        <p>
            <label for="price">가격</label>
            <input readonly type="number" id="price" name="price" value="<?= $stock['price'] ?>"/>
        </p>
    </div>
<? include "footer.php" ?>