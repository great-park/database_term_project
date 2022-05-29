<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수


$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("orderId", $_GET)) {
    $orderId = $_GET["orderId"];
    $query = "select orderId, signInId, userName, userPhoneNumber, address from Orders O
				inner join User U on O.userId = U.userId
				inner join Stock S on O.stockId = S.stockId
				inner join Guitar G on S.guitarId = G.guitarId
    			where orderId = $orderId";
    $result = mysqli_query($conn, $query);
    $buy = mysqli_fetch_assoc($result);
    if (!$buy) {
        msg("주문 이력이 없습니다.");
    }
}

?>
    <div class="container fullwidth">

        <h3>주문 정보 상세 보기</h3>

        <p>
            <label for="orderId">주문 번호</label>
            <input readonly type="text" name="orderId" value="<?= $buy['orderId'] ?>"/>
        </p>

        <p>
            <label for="signInId">주문자 아이디</label>
            <input readonly type="text" name="signInId" value="<?= $buy['signInId'] ?>"/>
        </p>

        <p>
            <label for="userName">주문자 이름</label>
            <input readonly type="text"  name="userName" value="<?= $buy['userName'] ?>"/>
        </p>

        <p>
            <label for="userPhoneNumber">주문자 전화번호</label>
            <input readonly type="text" name="userPhoneNumber" value="<?= $buy['userPhoneNumber'] ?>"/>
        </p>
        <p>
            <label for="address">주문자 주소</label>
            <input readonly type="text" name="address" value="<?= $buy['address'] ?>"/>
        </p>
    </div>
    

    
<? include("footer.php") ?>