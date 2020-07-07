<!DOCTYPE html>
<html>
<header>
    <title>Courses/StudentInfo</title>
    <link href="style.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</header>
<body>
<h2>Student Info</h2>

<?php

if (isset($_POST)) {
    $cwid = $_POST['CWID'];
    echo "CWID: ";
    echo $cwid;
}

$link = mysql_connect('MariaDB', 'cs332a30', 'lah0uGh7');

if(!$link) {
    echo '<p>Can not connect to DB</p>';
    die("Not able to connect".mysql_error());
}

mysql_select_db("cs332a30", $link);
$result = mysql_query("SELECT FName, LName, C.Title, Grade 
FROM STUDENT S, ERECORD E, SECTION SE, COURSE C 
WHERE S.CWID=$cwid AND S.CWID=E.CWID AND E.SNUM=SE.SNUM AND SE.CNUM=C.CNUM AND E.CNUM = C.CNUM", $link);

echo '<table border="2">
<tr>
<th>Student Name</th>
<th>Course Name</th>
<th>Grade</th>
<tr>';
$n = mysql_num_rows($result);


for($i=0; $i < $n; $i++) {
    echo '<tr>
    <td>', mysql_result($result, $i, "FName"), " ", mysql_result($result, $i, "LName"), '</td>
    <td>', mysql_result($result, $i, "Title"), '</td>
    <td>', mysql_result($result, $i, "Grade"), '</td>
    </tr>';
}
mysql_close($link);
?>

</body>
</html>