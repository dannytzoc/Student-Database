<!DOCTYPE html>
<html>
<header>
    <title>Courses</title>
    <link href="style.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</header>
<body>
    <h2>Courses</h2>

    <?php
        if(isset($_POST)) {
            $cnum = $_POST["CNUM"];
            echo "Course Number: ";
            echo $cnum;
        }

        $link = mysql_connect('mariadb', 'cs332a30', 'lah0uGh7');

        if(!$link) 
        {
            echo '<p>Can not connect to DB</p>';
            die('Can not connect to db: '.mysql_error());
        }

        mysql_select_db("cs332a30", $link);
        $result = mysql_query("SELECT S.SNUM, Classroom, Meeting, Start_T, End_T, COUNT(CWID)
        FROM COURSE C, SECTION S, MEETING M, ERECORD E 
        WHERE C.CNUM=$cnum AND C.CNUM=S.CNUM AND S.CNUM=M.CNUM AND S.SNUM = M.SNUM AND S.CNUM = E.CNUM AND S.SNUM =E.SNUM
        GROUP BY S.SNUM", $link);

        echo '<table border="2">
        <tr>
        <th>Section</th>
        <th>Classroom</th>
        <th>Meeting Days</th>
        <th>Time</th>
        <th>Enrolled</th>
        </tr>';

        $n = mysql_num_rows($result);


        for($i=0; $i < $n; $i++) {
            echo '<tr>
            <td>', mysql_result($result, $i, "S.SNUM"),  '</td>
            <td>', mysql_result($result,$i, "Classroom"), '</td>
            <td>', mysql_result($result, $i, "Meeting"), '</td>
            <td>', mysql_result($result, $i, "Start_T")," - ",
            mysql_result($result, $i, "End_T"), '</td>
            <td>', mysql_result($result, $i, "COUNT(CWID)"), '</td>
            </tr>';
        }
        mysql_close($link);
    ?>
</body>
</html>