<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("style.php") ?>
    <title>New Answer</title>
</head>
<body>
<?php include("header.php"); ?>
<?php include("../helper/db.php"); ?>
<?php
    $db_connection = new mysqli($host, $user, $password, $dbname);
    if ($db_connection->connect_errno) {
        echo "Failed to connect to database";
    }
	// to fetch all questions
    $sql = "SELECT id, question from questions";
    $result = $db_connection->query($sql);
    $questions = [];
    if ($result->num_rows) {
        $options = "<option value=\"0\">Choose a question</option>";
        while ($question = $result->fetch_assoc()) {
            $questions[$question['id']] = $question;
            $options .= "<option value=\"" . $question['id'] . "\">" . $question['question'] . "</option>";
        }
    }
    $db_connection->close();
?>
<!--container-->
<div class="container py-3">
    <div class="row">
        <div class="col-10 mx-auto">
            <form action="add_answer.php" class="form-group" method="post">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">New Answer</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="question" class="col-sm-2 col-form-label">Question</label>
                            <div class="col-sm-10">
                                <select name="question" id="question" class="form-control">
                                    <?php if ($options == "") { ?>
                                        <option value="0">No question</option>
                                    <?php } else {
                                        echo $options;
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="answer" class="col-sm-2 col-form-label">Answer</label>
                            <div class="col-sm-10">
                                <textarea name="answer" id="answer" class="form-control" cols="50" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="add" class="btn btn-primary float-right">Add</button>
                    </div>
                </div>
            </form>
            <?php
			// button add clicked
            if (isset($_POST['add'])) {
                $db_connection = new mysqli($host, $user, $password, $dbname);
                if ($db_connection->connect_errno) {
                    echo "Failed to connect to database";
                }
                $answer = $_POST['answer'];
                $question_id = $_POST['question'];
                if ($question_id == 0 || $answer == "") {
                    $message = "<div class='alert alert-danger' role='alert'>Please choose a question and enter your answer!</div>";
                } else {
                    $sql = "INSERT INTO answers(q_id, answer) values('$question_id', '$answer')";
                    if ($db_connection->query($sql)) {
                        $message = "<div class='alert alert-success' role='alert'>Answer added successfully</div>";
                    }
                }
                if (isset($message)) {
                    echo $message;
                }
                $db_connection->close();
            }
            ?>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>
</body>
</html>