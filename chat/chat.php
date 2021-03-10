<?php
require_once __DIR__ . "/vendor/autoload.php";

use App\Connect;
use App\Rooms;
use App\Message;


if (!Connect::chek()) {
    die("Error connect to database!");
}

if (!Rooms::chekMemberRoom($_GET["room_id"], $_GET["member_id"])){
    die('404');
}

?>


<!DOCTYPE html>
<html lang="en">
<?php require_once 'includes/head.php' ?>
<body>
<?php require_once 'includes/header.php' ?>
    <div class="offer">
        <div class="container">
            <div class="m_box">
                <h1 class="room">Комната: <?=Rooms::get($_GET["room_id"])["title"]?> </h1>
<div class="chat">

    <?php

    $room_id = $_GET["room_id"];
    $messages =  mysqli_query(Connect::db(), "SELECT * FROM `messages` WHERE `room_id` = $room_id" );

    while ($message = mysqli_fetch_assoc($messages)){
        $member_id = $_GET["member_id"];
        $user = mysqli_fetch_assoc(mysqli_query(Connect::db(), "SELECT * FROM `members` WHERE `id` = $member_id"));


        ?>
        <div class=" message_box <?=$message["member_id"] == $member_id ? "owner" : "" ?>" >
            <div>
                <p><b><?=$user["name"] ?></b>

                <div class=" body_message <?=$message["member_id"] == $member_id ? "owner_main" : "not_owner" ?>" ><p><?=$message["body"] ?></p></div>
            </div>
        </div>
        <?php
    }


    ?>


    </div>
            <form action="/chat.php<?="?room_id=" . $_GET["room_id"] . "&member_id=" . $_GET["member_id"]?>" method="post" style="margin-left: 50px; margin-bottom: 50px;">
                <input  name="body" placeholder="Сообщение">
                <input type="hidden" name="room" value="<?=$_GET["room_id"] ?>">
                <input type="hidden" name="member" value="<?=$_GET["member_id"] ?>">
                <button style="background: #00cccc;" name="submit">Отправить</button>
            </form>

                <?php
                    if (!is_null($_POST["submit"])){
                        $message = Message::send($_POST["room"], $_POST["member"], $_POST["body"]);
                        if (!$message) {
                            echo "<p style='margin-top: 20px;'>Ошибка при при отправке сообщения</p>";
                        } else {
                            header('Location: /chat.php?room_id=' . $_GET["room_id"] . '&member_id=' . $_GET["member_id"]);


                        }

                    }

                ?>

            </div>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.chat').animate({
            scrollTop: $('.chat').get(0).scrollHeight
        }, 0);
    });
    setInterval( function () {
        $.ajax({
            url: "/actions/chek_messages.php",
            type:"POST",
            dataType:"html",
            data: {
                room_id: <?=$_GET["room_id"] ?>,
                member_id: <?=$_GET["member_id"] ?>,
            },
            success: function (html) {
                $('.chat').html(html);
            }

        })
    }, 1000);


</script>
</body>
</html>