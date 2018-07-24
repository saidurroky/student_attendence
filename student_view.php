<?php
	 include 'inc/header.php';
	 include 'lib/Student.php';
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
<?php
	//error_reporting(0);
	$stu = new Student();
	$dt = $_GET['dt'];

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$attend = $_POST['attend'];
		$updateattend = $stu ->updateAttendence($dt, $attend);
	}
?>
<?php
	if(isset($updateattend)){
		echo $updateattend;
	}
?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>
					<a class="btn btn-success" href="add.php">Add Student</a>
					<a class="btn btn-info pull-right" href="dateview.php">Back</a>

				</h2>
			</div>
		</div>
		<div class="panel-body">
			<div class="well text-center" style="font-size:30px;">
				<strong>Date:</strong><?php echo $dt;?>
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
				$getdata = $stu ->getAllData($dt);
				if($getdata){
					$i = 0;
					while ($result = $getdata ->fetch_assoc()) {
						$i++;
			?>
					<tr>
						<td><?php echo $i ;?></td>
						<td><?php echo $result['name'] ;?></td>
						<td><?php echo $result['roll'] ;?></td>
						<td>
							<input type="radio" name="attend[<?php echo $result['roll'] ;?>]" value="present"
							 <?php
							 	if($result['attend'] == "present"){ echo "checked"; }
							 ?>>P
							<input type="radio" name="attend[<?php echo $result['roll'] ;?>]" value="absent"<?php
							 	if($result['attend'] == "absent"){ echo "checked"; }
							 ?>>A

						</td>
					</tr>
			<?php } } ?>
					<tr>
					<tr>
						<td colspan="4">
						<input class="btn btn-primary" type="submit" name="submit" value="Update">
					</td>
				</table>
			</form>
		</div>
<?php include 'inc/footer.php'; ?>

