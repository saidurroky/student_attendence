<?php
	 include 'inc/header.php';
	 include 'lib/Student.php';
?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>
					<a class="btn btn-success" href="add.php">Add Student</a>
					<a class="btn btn-info pull-right" href="index.php">Take Attendence</a>

				</h2>
			</div>
		</div>
		<div class="panel-body">
			
			<form method="post" action="">
				<table class="table table-striped">
					<tr>
						<th width="30%">Serial</th>
						<th width="50%">Attendence Date</th>
						<th width="20%">Action</th>
					</tr>
			<?php 
				$stu = new Student();
				$getdate = $stu ->getDateList();
				if($getdate){
					$i = 0;
					while ($result = $getdate ->fetch_assoc()) {
						$i++;
			?>
					<tr>
						<td><?php echo $i ;?></td>
						<td><?php echo $result['att_time'] ;?></td>
						<td><a class="btn btn-info" href="student_view.php?dt=<?php echo $result['att_time'] ;?>">View</a></td>
					</tr>
			<?php } } ?>
					
				</table>
			</form>
		</div>
<?php include 'inc/footer.php'; ?>

