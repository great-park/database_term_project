<?
include "config.php";
include "util.php";
?>

<div class="container">

    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    
    $signInId = $_POST['signInId'];
    $userId = mysqli_query($conn,"select userId from User where signInId = $signInId");
    $available_insert = check_id($conn, $signInId);
    if ($available_insert){
    	foreach($_POST['stockId'] as $stockId){
            $query = "insert into Orders (orderWhen, userId, stockId) VALUES ('2022-05-05',1,$stockId)";
        	mysqli_query($conn, $query);
        }
        s_msg('주문이 완료되었습니다');
        echo "<script>location.replace('buy_list.php');</script>";
    }
    else{
        msg('등록되지 않은 아이디 입니다.');
    }
    ?>

</div>

