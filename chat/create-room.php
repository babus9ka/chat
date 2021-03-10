<?php
require_once __DIR__ . "/vendor/autoload.php";

use App\Connect;
use App\Rooms;



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
            <main>
                <div class="box">          
                    <form style="padding-top: 40px;" class="form" action="create-room.php" method="post">
                        <input name="title"  type="text" placeholder="Name of room">
                        <br>
                        <button name="submit" type="submit">Create</button>
                    </form>
                </div>
                <?php
                if (!is_null($_POST["submit"])) {
                $room =  Rooms::create($_POST["title"]);

                ?>
                    <p style="margin-top: 10px;">
                        <?= $room ? "Комната успешно создана" : "Комната не была создана, произошла ошибка." ?>
                    </p>
                    <?php


                }

                ?>
            </main>
        </div>
    </div>
</body>
</html>

















