<?php
require_once __DIR__ . "/vendor/autoload.php";
use App\Rooms;
use App\Connect;

if (!Connect::chek()) {
    die("Error connect to database!");
}

?>


<!DOCTYPE html>
<html lang="en">
    <?php require 'includes/head.php' ?>
<body>
<?php require 'includes/header.php' ?>
    <div class="offer">
        <div class="container">
            <h1>List of rooms:</h1>
            <main style="display:flex; flex-wrap: wrap" >
                <?php
                $rooms = mysqli_query(Connect::db(), "SELECT * FROM `rooms`");

                while ($room = mysqli_fetch_assoc($rooms)){

                ?>

                <div style="margin: 20px;" class="box">
                    <h2><?=$room["title"] ?></h2>
                    
                    <?php
                    $room_id = $room["id"];
                        $members = mysqli_query(Connect::db(), "SELECT * FROM `members` WHERE `room_id` = $room_id");
                    ?>
                    <p>members:<?= mysqli_num_rows($members) ?> </p>
                    <form class="form" action="/" method="post">
                        <input type="hidden" name="id" value="<?=$room['id']?>">
                        <input type="text" name="username" placeholder = "Your name">
                        <br>
                        <button name="submit_<?=$room['id']?>">Connect</button>
                    </form>

                    <?php
                        if (!is_null($_POST["submit_" . $room["id"]])){
                            $member = Rooms::addMember($_POST["username"], $_POST["id"]);
                                if ($member) {
                                    header('Location: /chat.php?room_id=' . $room["id"] . '&member_id=' . $member);
                                } else {
                                    echo "<p style='margin-top: 20px;'>Ошибка при переходe в комнату</p>";
                                }
                        }
                    ?>

                </div>
            <?php
        }

        ?>

            </main>
        </div>
    </div>
</body>
</html>