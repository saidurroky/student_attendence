<?php
	
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');

	class Student{

		private $db;
		function __construct()
		{
			$this -> db = new Database();
		}

		public function getStudent(){
			$query = "SELECT * FROM tbl_student";
			$result = $this -> db ->select($query);
			return $result;
		}

		public function insertStudent($name, $roll){
			$name = mysqli_real_escape_string($this ->db ->link, $name);
			$roll = mysqli_real_escape_string($this ->db ->link, $roll);

			if($name == "" AND $roll ==""){
				$msg = "<div class='alert alert-danger'><strong>Error </strong>Field must not be empty</div>";
				return $msg;
			}else{
				$insrt_query ="INSERT INTO tbl_student(name, roll) VALUES('$name', '$roll')";
				$insertedrow = $this -> db ->insert($insrt_query);

				$att_query ="INSERT INTO tbl_attendence(roll) VALUES('$roll')";
				$insertedrow = $this -> db ->insert($att_query);

				if($insertedrow){
					$msg = "<div class='alert alert-success'><strong>Success </strong>Student Added</div>";
					return $msg;
				}else{
					$msg = "<div class='alert alert-danger'><strong>Error </strong>Student Not Added</div>";
					return $msg;
				}
			}
		}

		public function insertAttendence($curnt_date, $attend = array()){
			$query ="SELECT DISTINCT att_time FROM tbl_attendence";
			$getdata = $this -> db ->select($query);
			while ($result = $getdata ->fetch_assoc()) {
				$date = $result['att_time'];

				if($curnt_date == $date){
					$msg = "<div class='alert alert-danger'><strong>Error </strong>Attendence already taken today</div>";
					return $msg;
				}
			}

			foreach ($attend as $atn_key => $atn_value) {
				if($atn_value == 'present'){
					$std_query = "INSERT INTO tbl_attendence(roll, attend, att_time) VALUES('$atn_key', 'present', now() ) ";
					$insert_std = $this -> db ->insert($std_query);
				}elseif($atn_value == 'absent'){
					$std_query = "INSERT INTO tbl_attendence(roll, attend, att_time) VALUES('$atn_key', 'absent', now() ) ";
					$insert_std = $this -> db ->insert($std_query);
				}
			}
			if($insert_std){
					$msg = "<div class='alert alert-success'><strong>Success </strong>Attendence Inserted </div>";
					return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error </strong>Attendence Not Inserted</div>";
				return $msg;
			}
		}

		public function getDateList(){
			$query ="SELECT DISTINCT att_time FROM tbl_attendence";
			$getdata = $this -> db ->select($query);
			return $getdata ;
		}

		public function getAllData($dt){
			$query = "SELECT tbl_student.name, tbl_attendence.*
						FROM tbl_student
						INNER JOIN tbl_attendence
						ON tbl_student.roll = tbl_attendence.roll
						WHERE att_time = '$dt'";
			$result = $this -> db ->select($query);
			return $result;
		}

		public function updateAttendence($dt, $attend){
			foreach ($attend as $atn_key => $atn_value) {
				if($atn_value == 'present'){

					$std_query = "UPDATE tbl_attendence
									SET 
										attend = 'present'
									WHERE 
										roll = '$atn_key' AND att_time =  '".$dt."' ";

					$insert_std = $this -> db ->update($std_query);
				}elseif($atn_value == 'absent'){

					$std_query = "UPDATE tbl_attendence
									SET 
										attend = 'absent'
									WHERE 
										roll = '$atn_key' AND att_time =  '".$dt."' ";

					$insert_std = $this -> db ->update($std_query);
				}
			}
			if($insert_std){
					$msg = "<div class='alert alert-success'><strong>Success </strong>Attendence Updated </div>";
					return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error </strong>Attendence Not Updated</div>";
				return $msg;
			}
		}
	}
?>