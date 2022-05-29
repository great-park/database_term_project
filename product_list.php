<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from Stock S inner join Guitar G on S.guitarId = G.guitarId";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query .= " where modelNumber like '%$search_keyword%';";
    }
    $result = mysqli_query($conn, $query);
    if (!$result) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
    	<thead>
        <tr>
            <th>No.</th>
            <th>기타타입 (P: 합판, T: 탑솔리드 , B: 탑백솔리드, A: 올솔리드)</th>
            <th>기타 모델 번호</th>
            <th>가격</th>
            <th>설명</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['guitarType']}</td>";
            echo "<td><a href='product_view.php?stockId={$row['stockId']}&guitarId={$row['guitarId']}'>{$row['modelNumber']}</a></td>";
            echo "<td>{$row['price']}</td>";
            echo "<td>{$row['description']}</td>";
            echo "<td width='20%'> 
                <a href='product_form.php?guitarId={$row['guitarId']}&stockId={$row['stockId']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['stockId']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(stockId) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "product_delete.php?stockId=" + stockId;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
