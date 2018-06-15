<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>PHP Page</title>
</head>
<body>
    <div>
<?php 

$idErr="";
$nameErr="";

IF($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["empid"])){
        $idErr = "Employee ID Required";
    }else{$idErr = "";}

    if(empty($_POST["empname"])){
        $nameErr = "Name is Required.";
    }else{$nameErr ="";}

}
try
{
    $con = new pdo ("mysql:host=localhost;dbname=schooldb","root","");
    if(isset($_POST['Save'])){
        $empid = $_POST['empid'];
        $empname = $_POST['empname'];
        $email = $_POST['emailid'];
        $mobile = $_POST['mobileno'];

        $insert = $con->prepare("INSERT INTO employees (empid, empname, emailid, mobileno) values(:empid,:empname,:emailid,:mobileno)");

        $insert->bindParam(':empid',$empid);
        $insert->bindParam(':empname',$empname);
        $insert->bindParam(':emailid',$email);
        $insert->bindParam(':mobileno',$mobile);
        $insert->execute();

		$select = $con->prepare("SELECT * FROM employees");
		$select->setFetchMode(PDO::FETCH_ASSOC);
		$select->execute();
		echo '<table width="70%" border="1" cellpadding="5" cellspacing="5">
		<tr>
		<th>Emp ID</th>
		<th>Emp Name</th>
		<th>Emp Email</th>
		<th>Emp Mobileno</th>
		</tr>';
		foreach($select as $row)
		{
			echo '<tr>
			<td>'.$row["empid"].'</td>
			<td>'.$row["empname"].'</td>
			<td>'.$row["emailid"].'</td>
			<td>'.$row["mobileno"].'</td>
			</tr>';
		}

		echo '</table>';
    }

	 if(isset($_POST['show'])){
        $select = $con->prepare("SELECT * FROM employees");
		$select->setFetchMode(PDO::FETCH_ASSOC);
		$select->execute();
		echo '<table width="70%" border="1" cellpadding="5" cellspacing="5">
		<tr>
		<th>Emp ID</th>
		<th>Emp Name</th>
		<th>Emp Email</th>
		<th>Emp Mobileno</th>
		</tr>';
		foreach($select as $row)
		{
			echo '<tr>
			<td>'.$row["empid"].'</td>
			<td>'.$row["empname"].'</td>
			<td>'.$row["emailid"].'</td>
			<td>'.$row["mobileno"].'</td>
			</tr>';
		}

		echo '</table>';
    }

}
catch(PDOException $e)
{
    echo "Error".$e->getMessage();
}

?>
    </div>
   
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<label>Employee ID</label>
<input type="text" name="empid" placeholder="Employee ID" /><span class="error">*<?php echo $idErr ?></span><br/>
<label>Employee Name</label>
<input type="text" name="empname" placeholder="Employee Name" /><span class="error">*<?php echo $nameErr ?></span><br/>
<label>Email</label>
<input type="text" name="emailid" placeholder="Email" /><br/>
<label>Mobile No</label>
<input type="text" name="mobileno" placeholder="Mobile No" /><br/>
<input type="submit" name="Save" value="SAVE"  >

<input type="submit" name="show" value="SHOW"  >
</form>
</body>
</html>
