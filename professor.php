<!DOCTYPE html>
<html>
<header>
    <title>Professor's Courses</title>
    <link href="style.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</header>

<body>
    <?php
        if(isset($_POST)) 
        {
            echo "SSN: ";
            $ssn = $_POST['SSN'];
            echo $ssn;
        }
        $link = mysql_connect('mariadb', 'cs332a30', 'lah0uGh7');

        if(!$link) 
        {
            echo '<p>Can not connect to DB</p>';
            die('Could not connect to database:'.mysql_error());
        }
       
        mysql_select_db('cs332a30', $link);
        $result = mysql_query("SELECT  P.Title,Classroom, Meeting, Start_T, End_T
                                FROM PROFESSOR P, SECTION S, COURSE C, MEETING M
                                WHERE P.SSN=$ssn AND P.SSN=S.SSN AND S.CNUM=C.CNUM AND M.CNUM = S.CNUM" , $link);
        
        echo '<table border="2">
        <tr>
        
        <th>Course Title</th>
        <th>Classroom</th>
        <th>Meeting Days</th>
        <th>Time</th>
        </tr>';

        $n = mysql_num_rows($result);
        echo $n;
        for ($i=0; $i <= $n ; $i++) {
            echo '<tr>
                <td>', mysql_result($result, $i, "Title"),'</td>
                <td>', mysql_result($result,$i,"Classroom"), '</td>
                <td>', mysql_result($result,$i,"Meeting"), '</td>
                <td>', mysql_result($result,$i,"Start_T"), " - ", mysql_result($result,$i,"End_T"), '</td>
                </tr>';
        }
        mysql_close($link)
        ?>
</body>
</html>