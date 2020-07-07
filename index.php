<html>
<body>
<?php
// username and password need to be replaced by your username and password
$link = mysql_connect('mariadb', 'cs332a30', 'lah0uGh7');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully<p>';

mysql_select_db("cs332a30",$link);
$query = "SELECT * FROM PROFESSOR";
$result = mysql_query($query,$link);

printf("SSN: %s<br>\n", mysql_result($result,0,"ssn"));
printf("NAME: %s<br>\n", mysql_result($result,0,"name"));
printf("Salary: %s<br>\n", mysql_result($result,0,"salary"));
mysql_close($link);
?>
<link rel="stylesheet" href = "style.css">

<h2>Professor Queries</h2>
<form  action="professor.php" method="post">
Enter the social security number: 
<input type="text" name="SSN" />
<input type="submit" />
</form>

<form action="course_section.php" method="post">
Enter Course Number: 
<input type="text" name="CNUM" />
<br>
Enter Section Number: 
<input type="text" name="SNUM" />
<br>
<input type="submit" />
</form>


<h2>Student Queries</h2>
<form action="course.php" method="post">
Enter course number: 
<input type="text" name="CNUM" />
<input type="submit" />
</form>

<form action="cwid.php" method="post">
Enter Campus ID: 
<input type="text" name="CWID" />
<input type="submit" />
</form>
</body>
</html>