S<?php
try {
	require "../config.php";
	require "../common.php";

	$connection=new PDO($dsn, $username, $password, $options);

	$sql="SELECT * FROM student";

	$statement = $connection->prepare($sql);
  	$statement->execute();
	$result = $statement->fetchAll();


} catch(PDOException $error){
	echo $sql . "<br>" . $error->getMessage();
}
?>


<?php require "templates/header.php"; ?>

<table>
  <thead>
    <tr>
    <th>#</th> 
            <th>Student Name</th> 
            <th>Email Address</th> 
            <th>Contact Number</th> 
            <th>Gender</th> 
            <th>Address</th> 
            <th>Date</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
    <td><?php echo escape($row["student_id"]); ?></td> 
                    <td><?php echo escape($row["student_name"]); ?></td> 
                    <td><?php echo escape($row["email_address"]); ?></td> 
                    <td><?php echo escape($row["contact_number"]); ?></td> 
                    <td><?php echo escape($row["gender"]); ?></td> 
                    <td><?php echo escape($row["address"]); ?></td> 
                    <td><?php echo escape($row["date"]); ?> </td>
  </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php">Bach to homepage</a>
<?php require "templates/footer.php"; ?>
