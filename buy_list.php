<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

?>
<div class="container">
    <table class="table table-striped table-bordered">
        <tr>
            <th>주문 번호</th>
            <th>구입자명</th>
            <th>모델 번호</th>
            <th>가격</th>
        </tr>
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select orderId,userName,modelNumber,price from Orders O
				inner join User U on O.userId = U.userId
				inner join Stock S on O.stockId = S.stockId
				inner join Guitar G on S.guitarId = G.guitarId;";
    $result = mysqli_query($conn, $query);
 
    while($row=mysqli_fetch_array($result)){
        echo "<tr><td><a href='buy_detail.php?orderId={$row[0]}'>$row[0]</td>";
        echo "<td>$row[1]</td>";
        echo "<td>$row[2]</td>";
        echo "<td>$row[3]</td></tr>";
    }
    ?>
    </table>
</div>
    
<?
include "footer.php"
?>
