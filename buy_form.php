<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";  
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from Stock S inner join Guitar G on S.guitarId = G.guitarId";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('Query Error : ' . mysqli_error());
    }
    ?>
    <form name='buy' action='buy.php' method='POST'>
        <p align='right'> 사용자 ID 입력: <input type='text' name='signInId'></p>
        <table class="table table-striped table-bordered">
            <tr>
                <th>No.</th> 
                <th>기타타입 (P: 합판, T: 탑솔리드 , B: 탑백솔리드, A: 올솔리드)</th>
                <th>기타 모델 번호</th>
                <th>가격</th>
                <th>설명</th>
                <th>선택</th>
            </tr>
            <?
            $row_index = 1;
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>{$row_index}</td>";
                echo "<td>{$row['guitarType']}</td>";
                echo "<td><a href='product_view.php?stockId={$row['stockId']}'>{$row['modelNumber']}</a></td>";
                echo "<td>{$row['price']}</td>";
                echo "<td>{$row['description']}</td>";
                echo "<td width='17%'>
                    <input type='checkbox' name=stockId[] value='{$row['stockId']}'>
                    </td>";
                echo "</tr>";
                $row_index++;
            }
            ?>
            
        </table>
        <div align='center'>
            <input type='submit' class='button primary small' value=구입>
        </div>
    </form>
</div>
<? include("footer.php") ?>