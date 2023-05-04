<!DOCTYPE html>
<html>
<head>
  <title>Posting</title>
</head>
<body>

<?php
require_once 'connect.php';

if (isset($_POST['rank'])) {
    $dsn = "mysql:host=" . HOST . ";dbname=" . DB;
    $pdo = new PDO($dsn, USER, PASS);

    $givenname = htmlentities($_POST['givenname']);
    $surname = htmlentities($_POST['surname']);
    $sn = htmlentities($_POST['sn']);
    $rank = htmlentities($_POST['rank']);
    $unit = htmlentities($_POST['unit']);

    // prepare the first SQL statement
    $stmt1 = $pdo->prepare("INSERT INTO member (`SN`, `rank`, `surname`, `givenname`) VALUES (?, ?, ?, ?)");
    $stmt1->execute([$sn, $rank, $surname, $givenname]);

    // prepare the second SQL statement
    $stmt2 = $pdo->prepare("INSERT INTO post (`SN`, `unit`) VALUES (?, ?)");
    $stmt2->execute([$sn, $unit]);

    echo "<p>$rank $givenname $surname posted to $unit</p>\n";

    $pdo = null;
}
?>


<form method="post" action="">
 Given Name: <input type="text" name="givenname"><br>
 Family Name: <input type="text" name="surname"><br>
 Service Number: <input type="text" name="sn"><br>
 NATO Rank Code: <input type="text" name="rank"><br>
 Unit: <input type="text" name="unit"><br>
 <input type="submit">
</form>

</body>
</html>