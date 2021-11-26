<?php
/**
  * Use an HTML form to edit an entry in the
  * students table.
  *
  */
require "../config.php";
require "../common.php";
if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $student =[
      "student_id"        => $_POST['student_id'],
      "student_name" => $_POST['student_name'],
      "email_address"     => $_POST['email_address'],
      "contact_number"     => $_POST['contact_number'],
      "gender"       => $_POST['gender'],
      "address"  => $_POST['address'],
      "date"      => $_POST['date']
    ];

    $sql = "UPDATE student
            SET student_id = :student_id,
            student_name = :student_name,
            email_address = :email_address,
            contact_number = :contact_number,
              gender = :gender,
              address = :address,
              date = :date
            WHERE student_id = :student_id";

  $statement = $connection->prepare($sql);
  $statement->execute($student);
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['student_id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $student_id = $_GET['student_id'];
    $sql = "SELECT * FROM student WHERE student_id = :student_id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':student_id', $student_id);
    $statement->execute();

    $student = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
  <?php echo escape($_POST['student_name']); ?> successfully updated.
<?php endif; ?>

<h2>Edit a student</h2>

<form method="post">
    <?php foreach ($student as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'student_id' ? 'readonly' : null); ?>>
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
