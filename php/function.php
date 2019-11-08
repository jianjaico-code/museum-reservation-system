<?php 
    class DatabaseController{

        function addTimeSched($conn, $data){
            $from = $conn->real_escape_string($data['from']);
            $to = $conn->real_escape_string($data['to']);
            
            $check = "SELECT * FROM time_sched WHERE time_from = '$from' AND time_to = '$to'";
			$res = mysqli_query($conn,$check);
			$data = mysqli_fetch_array($res, MYSQLI_NUM);
			if($data[0] > 1) {
				return false;
			}
			else{
				$insertData = "INSERT INTO time_sched VALUES (null, '$from','$to', 1)";
                $conn->query($insertData);
                echo "<script>location.replace('index.php');</script>";
                return true;
			}

        }

        function addReservation($conn, $data, $key){
            $date = $conn->real_escape_string($data['date']);
            $time = $conn->real_escape_string($data['time']);
            
            $check = "SELECT * FROM reservation_schedule WHERE reservation_date = '$date' AND time_id = '$time'";
			$res = mysqli_query($conn,$check);
            $verification = mysqli_fetch_array($res, MYSQLI_NUM);
			if($verification[0] > 1) {
				return 2;
			}
			else{
                date_default_timezone_set('Asia/Manila');
                $dToday = date("Y-m-d");
                $dToday=date('Y-m-d', strtotime($dToday));
                $dateToSave = date('Y-m-d', strtotime($date));
                if ($dToday <= $dateToSave){
                    $insertData = "INSERT INTO reservation_schedule VALUES (null, '$key','$time', '$date', 2)";
                    $conn->query($insertData);
                    header('Location: success.php');
                    return 1;
                }
                else{ return 3;}
            }
        }

        function getTimeSched($conn){
            $check = "SELECT
                time_id,
                status,
                TIME_FORMAT(time_from, '%h:%i %p') time_from,
                TIME_FORMAT(time_to, '%h:%i %p') time_to 
                FROM time_sched";
			$result = $conn->query($check);
			return $result;
        }

        function getAllReservation($conn){
            $check = "SELECT reservation_schedule.reservation_id as resu, TIME_FORMAT(time_sched.time_from, '%h:%i %p') time_from, TIME_FORMAT(time_sched.time_to, '%h:%i %p') time_to, user.user_firstname, user.user_lastname, user.user_id, reservation_schedule.reservation_date, reservation_schedule.status, reservation_batch.reservation_id, COUNT(reservation_batch.reservation_id) as batchCount
                FROM reservation_schedule
                INNER JOIN user on reservation_schedule.user_id = user.user_id
                INNER JOIN time_sched on reservation_schedule.time_id = time_sched.time_id
                LEFT JOIN reservation_batch on reservation_schedule.reservation_id = reservation_batch.reservation_id GROUP BY reservation_schedule.reservation_id";
            $result = $conn->query($check);
			return $result;
        }

        function getGroupedBatch($conn){
            $check = "SELECT reservation_schedule.reservation_id, COUNT(*) AS counter, user.user_id, reservation_schedule.reservation_date, TIME_FORMAT(time_sched.time_from, '%h:%i %p') time_from, TIME_FORMAT(time_sched.time_to, '%h:%i %p') time_to, reservation_schedule.status
                FROM reservation_batch
                INNER JOIN reservation_schedule ON reservation_batch.reservation_id = reservation_schedule.reservation_id
                INNER JOIN time_sched ON reservation_schedule.time_id = time_sched.time_id
                INNER JOIN user ON reservation_schedule.user_id = user.user_id
                GROUP BY reservation_batch.reservation_id DESC";
            $result = $conn->query($check);
            return $result;
        }

        function addPerson($conn, $data, $key){
            $Name = $conn->real_escape_string($data['Name']);
            $Middlename = $conn->real_escape_string($data['Middlename']);
            $Lastname = $conn->real_escape_string($data['Lastname']);
            $Age = $conn->real_escape_string($data['Age']);
            $Gender = $conn->real_escape_string($data['Gender']);
            $Key = $conn->real_escape_string($key);

            $check = "SELECT * FROM reservation_batch WHERE Name = '$Name' AND Middlename = '$Middlename' AND Lastname = '$Lastname' AND reservation_id = '$Key'";
			$res = mysqli_query($conn,$check);
			$data = mysqli_fetch_array($res, MYSQLI_NUM);
			if($data[0] > 1) {
				return false;
			}
			else{
				$insertData = "INSERT INTO reservation_batch VALUES (null, '$Key', '$Name','$Middlename', '$Lastname', '$Age', '$Gender')";
                $conn->query($insertData);
                header("Refresh: 0;");
			}
        }

        function updatePerson($conn, $data){
            $Name = $conn->real_escape_string($data['Name']);
            $Middlename = $conn->real_escape_string($data['Middlename']);
            $Lastname = $conn->real_escape_string($data['Lastname']);
            $Age = $conn->real_escape_string($data['Age']);
            $Gender = $conn->real_escape_string($data['Gender']);
            $id = $conn->real_escape_string($data['id']);

            $q = "UPDATE reservation_batch SET Name = '$Name', Middlename = '$Middlename', Lastname = '$Lastname', Age = '$Age', Gender = '$Gender' WHERE batch_id = '$id'";
            $conn->query($q);
            header("Refresh: 0");
        }

        function removePerson($conn, $data){
            $id = $conn->real_escape_string($data['id']);
            $delete = "DELETE FROM reservation_batch WHERE batch_id = '$id'";
            $conn->query($delete);
            header("Refresh: 0");
        }

        function getBatch($conn, $key){
            $check = "SELECT * FROM reservation_batch WHERE reservation_id = '$key'";
            $result = $conn->query($check);
			return $result;
        }

        function login($conn, $data){
            $username = $conn->real_escape_string($data['email']);
			$password = $conn->real_escape_string($data['password']);

			$login = "SELECT * FROM user WHERE user_email = '$username' AND user_pass = '$password'";
            $result = $conn->query($login);
            
            if ($result -> num_rows > 0) {
				$data = $result -> fetch_object();
				
				$type = $data->user_type;
				if($type == 1){
					$_SESSION['access'] = 1;
					$_SESSION['email'] = $data->user_email;
					$_SESSION['userID'] = $data->user_id;
					header('Location: admin/');
				}
				else{
					$_SESSION['access'] = 1;
					$_SESSION['email'] = $data->user_email;
                    $_SESSION['userID'] = $data->user_id;
					header('Location: index.php');
				}
			}
        }

        function signup($conn, $data){
            $email = $conn->real_escape_string($data['Email']);
            $password = $conn->real_escape_string($data['Password']);
            $Fistname = $conn->real_escape_string($data['Fistname']);
            $Middlename = $conn->real_escape_string($data['Middlename']);
            $Lastname = $conn->real_escape_string($data['Lastname']);

            $check = "SELECT * FROM user WHERE user_email = '$email'";
            $rs = mysqli_query($conn,$check);
            $data = mysqli_fetch_array($rs, MYSQLI_NUM);
            if($data[0] > 1) {
                return false;
			}
			else{
				$insertData = "INSERT INTO user VALUES (null, '$Fistname','$Middlename', '$Lastname', '$email', '$password', 2)";
                $conn->query($insertData);
                return true;
			}
        }

        function inactivateSchedule($conn, $post){
			$id = $conn->real_escape_string($post['data']);
			$q = "UPDATE reservation_schedule SET status = 2 WHERE reservation_id = '$id'";
            $conn->query($q);
            echo "<script>location.replace('index.php');</script>";
		}

		function activateSchedule($conn, $post){
			$id = $conn->real_escape_string($post['data']);
			$q = "UPDATE reservation_schedule SET status = 1 WHERE reservation_id = '$id'";
            $conn->query($q);
            echo "<script>location.replace('index.php');</script>";
        }
        
        function inactiveTime($conn, $post){
            $id = $conn->real_escape_string($post['data']);
			$q = "UPDATE time_sched SET status = 2 WHERE time_id = '$id'";
            $conn->query($q);
            echo "<script>location.replace('index.php');</script>";
        }

        function activeTime($conn, $post){
            $id = $conn->real_escape_string($post['data']);
			$q = "UPDATE time_sched SET status = 1 WHERE time_id = '$id'";
            $conn->query($q);
            echo "<script>location.replace('index.php');</script>";
        }
    }