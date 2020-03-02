<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php include("style.php") ?>
	<title>New Question</title>
</head>
<body>
<?php include("header.php"); ?>
<?php include("../helper/db.php"); ?>

<!--container-->
<div class="container py-3">
	<div class="row">
		<div class="col-10 mx-auto">
			<form action="add_question.php" class="form-group" method="post">
				<div class="card">
					<div class="car-head">
						<h4 class="text-center">New Question</h4>
					</div>
					<div class="card-body">
						<input type="text" name="question" class="form-control">
					</div>
					<div class="card-footer">
						<button type="submit" name="add" class="btn btn-primary float-right">Add</button>
					</div>
				</div>
			</form>
			<?php
			$db_connection = new mysqli($host, $user, $password, $dbname);
			if ($db_connection->connect_errno) {
				echo "Failed to connect to database";
			}

			if (isset($_POST['add'])) {
				$question = $_POST['question'];
				if ($question == ''){
					$message = "Please input question";
				}else{
					$sql = "INSERT INTO questions(question) values('$question')";
					if ($db_connection->query($sql)){
						$message = "Question added successfully";
					}
				}
				if(isset($message)){
					echo $message;
				}
			}
            $db_connection->close();
			
			?>
		</div>
	</div>

	<!--	--><?php
	//	$db_connection = new mysqli($host, $user, $password, $dbname);
	//	if ($db_connection->connect_errno) {
	//		echo "Failed to connect to MySQL: (" . $db_connection->connect_errno . ") " . $db_connection->connect_error;
	//	}else{
	//		echo "SUCCESS";
	//	}
	//	$sql = "INSERT INTO Questions(question) VALUES(\"What is your name?\")";
	//	if ($db_connection->query($sql)){
	//		echo "question INSERTED";
	//	} else {
	//		echo "Error : ". $sql . "<br>". $db_connection->error;
	//	}
	//	$last_id = mysqli_insert_id($db_connection);
	//	$sql = "INSERT INTO Answers(q_id, answer) VALUES($last_id, \"My name is Sokha.\")";
	//	if ($db_connection->query($sql)){
	//		echo "Answer INSERTED";
	//	} else {
	//		echo "Error : ". $sql . "<br>". $db_connection->error;
	//	}
	//	?>
</div>
<?php include("footer.php"); ?>
</body>
</html>