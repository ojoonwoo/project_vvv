<?
	include_once "./header.php";

    if ($_SESSION['ss_vvv_way'] == "kakao")
    {
        session_destroy();
        echo "<script src='//developers.kakao.com/sdk/js/kakao.min.js'></script>";
        echo "<script>Kakao.init('ff013671b5f7b01d59770657a8787952');</script>";
        echo "<script>Kakao.Auth.logout();location.href='./index.php';</script>";
    }else if ($_SESSION['ss_vvv_way'] == "facebook"){
        session_destroy();        
        echo "<script>location.href='./index.php';</script>";
    }
?>