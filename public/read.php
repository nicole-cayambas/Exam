<?php

if(isset($_POST['submit'])){
    require '../config.php';
    require '../common.php';
    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $sql = 'SELECT *
        FROM student
        WHERE student_name = :student_name';

        $student_name = $_POST['student_name'];

        $statement = $connection -> prepare($sql);
        $statement -> bindParam(':student_name',$student_name, PDO::PARAM_STR);
        $statement -> execute();
        
        $result = $statement -> fetchAll();
    } catch(PDOException $error){
        echo $sql.'<br>'.$error->getMessage();
    }
}
?>
<?php require "templates/header.php"; ?>
<?php if (isset($_POST['submit'])) { if ($result && $statement->rowCount() > 0) { ?>
<h2>Results</h2> 
<table> 
    <thead> 
        <tr> 
            <th>#</th> 
            <th>Student Name</th> 
            <th>Email Address</th> 
            <th>Contact Number</th> 
            <th>Gender</th> 
            <th>Address</th> 
            <th>Date</th> </tr> 
        </thead> 
        <tbody> 
            <?php foreach ($result as $row) { ?> 
                <tr> 
                    <td><?php echo escape($row["student_id"]); ?></td> 
                    <td><?php echo escape($row["student_name"]); ?></td> 
                    <td><?php echo escape($row["email_address"]); ?></td> 
                    <td><?php echo escape($row["contact_number"]); ?></td> 
                    <td><?php echo escape($row["gender"]); ?></td> 
                    <td><?php echo escape($row["address"]); ?></td> 
                    <td><?php echo escape($row["date"]); ?> </td> 
                </tr> <?php } ?> 
            </tbody> 
        </table> 
        <?php } else { ?> > No results found for 
            <?php echo escape($_POST['name']); ?>. <?php } } ?>
<h2>Find user based on name</h2>

<form method="post">
	<label for="student_name">Name</label>
    <input type="text" id="student_name" name="student_name">
    <input type="submit" name="submit" value="View Results">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
</form>

<a href="index.php">Back to homepage</a>

<?php require "templates/footer.php"; ?>