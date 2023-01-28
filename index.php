<?php

require_once "functions.php";
session_start();
$ip = $_SERVER['REMOTE_ADDR'];
$_SESSION['user_ip'] = $ip;
$connect = dbConn();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/table.css">
    <title>Document</title>
</head>
<body>
<main class="form-signin w-100 m-auto">
    <form class="myform">
        <!--        <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
        <h1 class="h3 mb-3 fw-normal">Please enter code</h1>

        <div class="form-floating pole">
            <input type="text" class="form-control" id="floatingInput" placeholder="Code" name="code">
            <label for="floatingInput"><span class="error-mes">Code</span></label>
        </div>

        <button class="w-100 btn btn-lg btn-primary send-code" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
    </form>

    <div id="element">
        <table>
            <tr>
                <th>Code</th>
                <th>Time</th>

            </tr>

            <?php
            $query_insert = "SELECT * FROM `confirmation_code`";
            $data = $connect->prepare($query_insert);
            $data->execute();

            $counter = $data->rowCount();
            if ($counter > 0) {
                while ($res = $data->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?= $res['code']; ?></td>
                        <td><?= $res['time']; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>

        </table>
    </div>
    <button class="w-100 btn btn-lg btn-primary" onclick="show1()">Показать</button>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
</body>
</html>
