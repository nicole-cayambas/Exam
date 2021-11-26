<?php

if(isset($_POST['submit'])){
    require '../common.php';
    require '../config.php';
    try{
        $connection = new PDO($dsn, $username, $password, $options);
        $new_student = array(
            'student_name' => $_POST['student_name'],
            'email_address' => $_POST['email_address'],
            'contact_number' => $_POST['contact_number'],
            'gender' => $_POST['gender'],
            'address' => $_POST['address'],
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "student",
            implode(", ", array_keys($new_student)),
            ":" . implode(", :", array_keys($new_student))
    );
    
    $statement = $connection->prepare($sql);
    $statement->execute($new_student);

    } catch(PDOException $error){
        echo $sql.'<br>'.$error->getMessage();
    }
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement){ ?>
    <blockquote><?php echo $_POST['student_name']; ?> successfully added.</blockquote>
<?php } ?>

<h2>Add a student</h2> 
<form method="post"> 	
    <label for="student_name">Name</label> 	
    <input type="text" name="student_name" id="student_name"> 	
    <label for="email_address">Email Address</label> 	
    <input type="text" name="email_address" id="email_address"> 	
    <label for="contact_number">Contact Number</label> 	
    <input type="text" name="contact_number" id="contact_number"> 	
    <label for="gender">Gender</label> 	
    <input type="text" name="gender" id="gender"> 	
    <label for="address">Address</label> 	
    <input type="text" name="address" id="address"> 	
    <input type="submit" name="submit" value="Submit"> 
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
</form> 
<a href="index.php">Back to home</a> 
<?php require "templates/footer.php"; ?>