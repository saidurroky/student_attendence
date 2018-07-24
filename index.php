<?php
	 include 'inc/header.php';
	 include 'lib/Student.php';
?>
<?php
	error_reporting(0);
	$stu = new Student();
	$curnt_date = date('Y-m-d');

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$attend = $_POST['attend'];
		$insertattend = $stu ->insertAttendence($curnt_date, $attend);
	}
?>
<?php
	if(isset($insertattend)){
		echo $insertattend;
	}
?>
<script type="text/javascript">
	$(document).ready(function() {
    	$("form").submit(function() {
    		var roll = true;
    		$(":radio").each(function(){
    			name = $(this).attr("name");
    			if(roll && !$(":radio[name='"+name+"']:checked").length){
    				alert(name + " Roll Missing");
    				$(".alert").show();
    				roll = false;
    			}
    		});
    		return roll;
    	});
});
</script>


		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>
					<a class="btn btn-success" href="add.php">Add Student</a>
					<a class="btn btn-info pull-right" href="dateview.php">View All</a>

				</h2>
			</div>
		</div>
		<div class="panel-body">
			<div class="well text-center" style="font-size:30px;">
				<strong>Date:</strong><?php echo $curnt_date;?>
			</div>
			<form method="post" action="">
				<table class="table table-striped">
					<tr>
						<th width="25%">Serial</th>
						<th width="25%">Student Name</th>
						<th width="25%">Roll Number</th>
						<th width="25%">Attendence</th>

					</tr>
			<?php 
				$getstd = $stu ->getStudent();
				if($getstd){
					$i = 0;
					while ($result = $getstd ->fetch_assoc()) {
						$i++;
			?>
					<tr>
						<td><?php echo $i ;?></td>
						<td><?php echo $result['name'] ;?></td>
						<td><?php echo $result['roll'] ;?></td>
						<td>
							<input type="radio" name="attend[<?php echo $result['roll'] ;?>]" value="present">P
							<input type="radio" name="attend[<?php echo $result['roll'] ;?>]" value="absent">A

						</td>
					</tr>
			<?php } } ?>
					<tr>
						<td colspan="3">
						<input class="btn btn-primary" type="submit" name="submit" value="Submit">
					</td>
					</tr>
				</table>
			</form>
		</div>
<?php include 'inc/footer.php'; ?>

