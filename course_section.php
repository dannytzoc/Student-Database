<!DOCTYPE html>
<html>
      <header>
           <title>Student Grades</title>
            <link href="style.css" rel="stylesheet"/>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            </header>

<body>


<h2>Student Grades</h2>

<?php
 if(isset($_POST))  {
    $cno = $_POST['CNUM'];
    $sno = $_POST['SNUM']; 
    echo " Course: ";
    echo $cno;
    echo " Section: ";
    echo $sno;
 }

$link = mysql_connect("mariadb",'cs332a30','lah0uGh7'); 

if(!$link) { 
    echo '<p>Can not connect to DB</p>';
    die('Could not connect'.mysql_error());
}

mysql_select_db("cs332a30",$link);
$result = mysql_query(
    "SELECT Grade, COUNT(DISTINCT CWID) 
     FROM COURSE C, SECTION S, ERECORD E
     WHERE C.CNUM = $cno AND S.SNUM = $sno AND C.CNUM = S.CNUM AND S.CNUM = E.CNUM AND S.SNUM = E.SNUM
     GROUP BY Grade",$link); 
 
 

echo '<table border="2"> 
    <tr>
         <th>Letter Grades</th>
          <th>Number of Students</th>
         </tr>';
         $n = mysql_num_rows($result);

        for($i=0;$i < $n; $i++)
        {
          echo '<tr>  
                <td>', mysql_result($result,$i,"Grade"),'</td>
                <td>', mysql_result($result,$i,"COUNT(CWID)")+1,'</td> 
              </tr>';
          } 
 
 
 echo '</table>';
 mysql_close($link)
 ?>
 </body>
</html>