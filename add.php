<?php
	 include 'inc/header.php';
	 include 'lib/Student.php';
?>
<?php
	$stu = new Student();
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$name = $_POST['name'];
		$roll = $_POST['roll'];

		$insertstd = $stu ->insertStudent($name, $roll);
	}
?>
<?php
	if(isset($insertstd)){
		echo $insertstd;
	}
?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>
					<a class="btn btn-success" href="add.php">Add Student</a>
					<a class="btn btn-info pull-right" href="index.php">Back</a>

				</h2>
			</div>
		</div>
		<div class="panel-body">
			
			<form method="post" action="">
				<div class="form-group">
					<lavel for="name">Student Name</lavel>
					<input class="form-control" type="text" name="name" id="name">
				</div>
				<div class="form-group">
					<lavel for="roll">Student Roll</lavel>
					<input class="form-control" type="text" name="roll" id="roll">
				</div>
				<div class="form-group">
					<input class="btn btn-primary" type="submit" name="submit" value="Add student">
				</div>
			</form>
		</div>
<?php include 'inc/footer.php'; ?>

