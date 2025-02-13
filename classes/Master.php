<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function save_academic(){
		extract($_POST);
		
		$data="";
		foreach ($_POST as $key => $value) {
			if(!in_array($key, array('id')) && !is_numeric($key)){
				if(!empty($data)) $data .= ", ";
				$data .= " {$key} = '{$value}' ";
			}
		}
		$chk = $this->conn->query("SELECT * FROM academic_year where sy = '$sy' ".((!empty($id))? " and id != {$id}" : ''));
		if($chk->num_rows > 0){
			return 2; 
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO academic_year set $data";
		}else{
			$sql = "UPDATE academic_year set $data where id = $id";
		}
		$save = $this->conn->query($sql);
		if($save){
			if($status == 1){
				$id = empty($id) ? $this->conn->insert_id : $id;
				$this->conn->query("UPDATE academic_year set status = 0 where id != $id");
				$this->settings->set_userdata('academic_id',$id);
				$this->settings->set_userdata('academic_sy',$sy);
			}
			$this->settings->set_flashdata('success'," Academic Year Successfully saved.");
			return 1;
		}else{
			$resp['err']= "error saving data";
			$resp['sql']=$sql;
			return json_encode($resp);
		}
	}
	public function delete_academic(){
		extract($_POST);

		$delete = $this->conn->query("DELETE FROM academic_year where id = $id");
		if($delete)
			return 1;
	}

	public function save_department(){
		extract($_POST);
		
		$data="";
		foreach ($_POST as $key => $value) {
			if(!in_array($key, array('id')) && !is_numeric($key)){
				if(!empty($data)) $data .= ", ";
				$data .= " {$key} = '{$value}' ";
			}
		}
		$chk = $this->conn->query("SELECT * FROM department where department = '$department' ".((!empty($id))? " and id != {$id}" : ''));
		if($chk->num_rows > 0){
			return 2; 
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO department set $data";
		}else{
			$sql = "UPDATE department set $data where id = $id";
		}
		$save = $this->conn->query($sql);
		if($save){
			$this->settings->set_flashdata('success'," Department Successfully saved.");
			return 1;
		}else{
			$resp['err']= "error saving data";
			$resp['sql']=$sql;
			return json_encode($resp);
		}
	}
	public function delete_department(){
		extract($_POST);

		$delete = $this->conn->query("DELETE FROM department where id = $id");
		if($delete)
			return 1;
	}
	
	public function save_course(){
		extract($_POST);
		
		$data="";
		foreach ($_POST as $key => $value) {
			if(!in_array($key, array('id')) && !is_numeric($key)){
				if(!empty($data)) $data .= ", ";
				$data .= " {$key} = '{$value}' ";
			}
		}
		$chk = $this->conn->query("SELECT * FROM course where course = '$course' ".((!empty($id))? " and id != {$id}" : ''));
		if($chk->num_rows > 0){
			return "SELECT * FROM course ".((!empty($id))? " where id != {$id}" : ''); 
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO course set $data";
		}else{
			$sql = "UPDATE course set $data where id = $id";
		}
		$save = $this->conn->query($sql);
		if($save){
			$this->settings->set_flashdata('success'," Course Successfully saved.");
			return 1;
		}else{
			$resp['err']= "error saving data";
			$resp['sql']=$sql;
			return json_encode($resp);
		}
	}
	public function delete_course(){
		extract($_POST);

		$delete = $this->conn->query("DELETE FROM course where id = $id");
		if($delete)
			return 1;
	}

	public function save_subject(){
		extract($_POST);
		
		$data="";
		foreach ($_POST as $key => $value) {
			if(!in_array($key, array('id')) && !is_numeric($key)){
				if(!empty($data)) $data .= ", ";
				$data .= " {$key} = '{$value}' ";
			}
		}
		$chk = $this->conn->query("SELECT * FROM subjects where subject_code = '$subject_code' ".((!empty($id))? " and id != {$id}" : ''));
		if($chk->num_rows > 0){
			return 2; 
			exit;
		}

		if(empty($id)){
			$sql = "INSERT INTO subjects set $data";
		}else{
			$sql = "UPDATE subjects set $data where id = $id";
		}
		$save = $this->conn->query($sql);
		if($save){
			$this->settings->set_flashdata('success'," Subject Successfully saved.");
			return 1;
		}else{
			$resp['err']= "error saving data";
			$resp['sql']=$sql;
			return json_encode($resp);
		}
	}
	public function delete_subject(){
		extract($_POST);

		$delete = $this->conn->query("DELETE FROM subjects where id = $id");
		if($delete)
			return 1;
	}
public function save_student(){
		extract($_POST);
		$data="";
		foreach ($_POST as $key => $value) {
			if(!in_array($key, array('id')) && !is_numeric($key)){
				if(!empty($data)) $data .= ", ";
				$data .= " {$key} = '{$value}' ";
			}
		}
		$chk = $this->conn->query("SELECT * FROM students where student_id = '$student_id' ".((!empty($id))? " and id != {$id}" : ''));
		if($chk->num_rows > 0){
			return 2; 
			exit;
		}

		if(empty($id)){
			$data .= ", `password` = '".md5($student_id)."' ";
			$sql = "INSERT INTO students set $data";
		}else{
			if(isset($preset) && $preset == 'on')
			$data .= ", `password` = '".md5($student_id)."' ";
			$sql = "UPDATE students set $data where id = $id";
			$ofid = $this->conn->query("SELECT * FROM students where id = $id ")->fetch_array()['student_id'];
		}

		$save = $this->conn->query($sql);
		if($save){
			$id= empty($id) ? $this->conn->insert_id : $id;
			if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
					$ext = explode('.', $_FILES['img']['name']);
					$fname = 'uploads/Favatar_'.$id.'.'.$ext[1];
					if(is_file('../'.$fname))
						unlink('../'.$fname);
					$move = move_uploaded_file($_FILES['img']['tmp_name'],'../'. $fname);
					if($move){
						$this->conn->query("UPDATE students set avatar = '$fname' where id = $id ");
					}
			}
			
			$this->settings->set_flashdata('success'," Student Successfully saved.");
			return 1;
		}else{
			$resp['err']= "error saving data";
			$resp['sql']=$sql;
			return json_encode($resp);
		}

	}

	public function delete_student(){
		extract($_POST);

		$delete = $this->conn->query("DELETE FROM students where id = $id");
		if($delete)
			return 1;
	}


	public function save_class(){
		extract($_POST);
		
		$data="";
		$data2="";
		foreach ($_POST as $key => $value) {
			if(!in_array($key, array('id')) && !is_numeric($key)){
				if(!empty($data)) $data .= ", ";
				$data .= " {$key} = '{$value}' ";
				if(!empty($data2)) $data2 .= "and ";
				$data2 .= " {$key} = '{$value}' ";
			}
		}
		$chk = $this->conn->query("SELECT * FROM class where $data2 ".((!empty($id))? " and id != {$id}" : ''));
		if($chk->num_rows > 0){
			return 2; 
			exit;
		}

		if(empty($id)){
			$sql = "INSERT INTO class set $data";
		}else{
			$sql = "UPDATE class set $data where id = $id";
		}
		$save = $this->conn->query($sql);
		if($save){
			$this->settings->set_flashdata('success'," Class Successfully saved.");
			return 1;
		}else{
			$resp['err']= "error saving data";
			$resp['sql']=$sql;
			return json_encode($resp);
		}
	}
	public function delete_class(){
		extract($_POST);

		$delete = $this->conn->query("DELETE FROM class where id = $id");
		if($delete)
			return 1;
	}
	public function student_class(){
		extract($_POST);

		$data="";
		foreach ($_POST as $key => $value) {
			if(!in_array($key, array('id')) && !is_numeric($key)){
				if(!empty($data)) $data .= ", ";
				$data .= " {$key} = '{$value}' ";
			}
		}

		if(empty($id)){
			$sql = "INSERT INTO student_class set $data";
		}else{
			$sql = "UPDATE student_class set $data where id = $id";
		}

		$save = $this->conn->query($sql);
		if($save){
			$this->settings->set_flashdata('success'," Student's Class Successfully updated.");
			return 1;
		}else{
			$resp['err']= "error saving data";
			$resp['sql']=$sql;
			return json_encode($resp);
		}

	}
	public function load_class_subject(){
		extract($_POST);
		$delete = $this->conn->query("DELETE FROM class_subjects where class_id = '$class_id' and academic_year_id = '$academic_year_id' ");
		$data = "";
		foreach ($subject_id as $key => $valuu) {
			if(!empty($data)) $data .= ", ";
			$data .= " ('$class_id','$academic_year_id','{$subject_id[$key]}') ";
		}
		$sql = "INSERT INTO class_subjects (class_id,academic_year_id,subject_id) VALUES $data ";
		// echo $sql;exit;
		$save = $this->conn->query($sql);
		if($save){
			$this->settings->set_flashdata('success'," Class Subject Loads Successfully saved.");
			return 1;
		}else{
			$resp['err']= "error saving data";
			$resp['sql']=$sql;
			return json_encode($resp);
		}
	}

	public function save_faculty(){
		extract($_POST);
		$data="";
		foreach ($_POST as $key => $value) {
			if(!in_array($key, array('id')) && !is_numeric($key)){
				if(!empty($data)) $data .= ", ";
				$data .= " {$key} = '{$value}' ";
			}
		}
		$chk = $this->conn->query("SELECT * FROM faculty where faculty_id = '$faculty_id' ".((!empty($id))? " and id != {$id}" : ''));
		if($chk->num_rows > 0){
			return 2; 
			exit;
		}

		if(empty($id)){
			$data .= ", `password` = '".md5($faculty_id)."' ";
			$sql = "INSERT INTO faculty set $data";
		}else{
			if(isset($preset) && $preset == 'on')
			$data .= ", `password` = '".md5($faculty_id)."' ";
			$sql = "UPDATE faculty set $data where id = $id";
			$ofid = $this->conn->query("SELECT * FROM faculty where id = $id ")->fetch_array()['faculty_id'];
		}

		$save = $this->conn->query($sql);
		if($save){
			$id= empty($id) ? $this->conn->insert_id : $id;
			if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
					$ext = explode('.', $_FILES['img']['name']);
					$fname = 'uploads/Favatar_'.$id.'.'.$ext[1];
					if(is_file('../'.$fname))
						unlink('../'.$fname);
					$move = move_uploaded_file($_FILES['img']['tmp_name'],'../'. $fname);
					if($move){
						$this->conn->query("UPDATE faculty set avatar = '$fname' where id = $id ");
					}
			}
			if(isset($ofid)){
				$this->conn->query("UPDATE class_subjects_faculty set faculty_id = '$faculty_id' where faculty_id = $ofid ");
				$this->conn->query("UPDATE lessons set faculty_id = '$faculty_id' where faculty_id = $ofid ");

			}
			$this->settings->set_flashdata('success'," Subject Successfully saved.");
			return 1;
		}else{
			$resp['err']= "error saving data";
			$resp['sql']=$sql;
			return json_encode($resp);
		}

	}

	public function delete_faculty(){
		extract($_POST);

		$delete = $this->conn->query("DELETE FROM faculty where id = $id");
		if($delete)
			return 1;
	}
	public function load_faculty_subj(){
		extract($_POST);
		$delete = $this->conn->query("DELETE FROM class_subjects_faculty where faculty_id = '$faculty_id' and academic_year_id = '$academic_year_id' ");
		$data = "";
		foreach ($class_subj as $key => $valuu) {
			$ex = explode("_", $class_subj[$key]);
			$class_id = $ex[0];
			$subject_id = $ex[1];
			if(!empty($data)) $data .= ", ";
			$data .= " ('$academic_year_id','$faculty_id','$class_id','$subject_id') ";
		}
		$sql = "INSERT INTO class_subjects_faculty (academic_year_id,faculty_id,class_id,subject_id) VALUES $data ";
		// echo $sql;exit;
		$save = $this->conn->query($sql);
		if($save){
			$this->settings->set_flashdata('success'," Faculty Class Loads Successfully saved.");
			return 1;
		}else{
			$resp['err']= "error saving data";
			$resp['sql']=$sql;
			return json_encode($resp);
		}
	}

	public function save_lesson() {
    extract($_POST);
    $data = "";

    // Prepare SQL data
    foreach($_POST as $k => $v) {
        if(!in_array($k, array('id', 'class_ids'))) {
            $v = $this->conn->real_escape_string($v);
            if(!empty($data)) $data .= ", ";
            if($k == 'description') $v = addslashes(htmlentities($v));
            $data .= " `{$k}` = '$v' ";
        }
    }

    // Insert or Update Query
    if(empty($id)) {
        $sql = "INSERT INTO lessons SET $data";
    } else {
        $sql = "UPDATE lessons SET $data WHERE id = $id";
    }

    // Execute Query with Error Checking
    $save = $this->conn->query($sql) or die("Error: " . $this->conn->error);
    
    if($save) {
        $id = (empty($id)) ? $this->conn->insert_id : $id;

        // Fix DELETE SQL Statement
        $this->conn->query("DELETE FROM lesson_class WHERE lesson_id = $id");

        // Insert class_id mapping
        if (!empty($class_ids)) {
            $data = "";
            foreach ($class_ids as $key => $value) {
                if (!empty($data)) $data .= ", ";
                $data .= "('$id', '{$class_ids[$key]}')";
            }
            $sql2 = $this->conn->query("INSERT INTO lesson_class (lesson_id, class_id) VALUES $data") or die("Error: " . $this->conn->error);
        }

        // File Upload Handling (For PDF & DOCX)
        if(isset($_FILES['lesson_file']) && count($_FILES['lesson_file']['tmp_name']) > 0) {
            $baseDir = '../uploads/lessons';
            $lessonDir = "$baseDir/lesson_$id";

            // Ensure directory exists
            if (!is_dir($baseDir)) mkdir($baseDir, 0777, true);
            if (!is_dir($lessonDir)) mkdir($lessonDir, 0777, true);
            else {
                // Delete existing files in lesson folder
                $files = scandir($lessonDir);
                foreach ($files as $file) {
                    if (!in_array($file, array('.', '..'))) {
                        unlink("$lessonDir/$file");
                    }
                }
            }

            // Allowed file types and MIME types
            $allowedTypes = ['pdf', 'docx', 'mp4', 'mov', 'avi'];
    $allowedMimeTypes = [
        'pdf' => 'application/pdf',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'mp4' => 'video/mp4',
        'mov' => 'video/quicktime',
        'avi' => 'video/x-msvideo'
    ];

            // Upload and move files
            $uploadedFiles = [];
            foreach ($_FILES['lesson_file']['tmp_name'] as $k => $tmp_name) {
                if (!empty($tmp_name)) {
                    $fileName = $_FILES['lesson_file']['name'][$k];
                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $fileMime = mime_content_type($tmp_name);

                    // Validate file extension and MIME type
                    if (in_array($fileExt, $allowedTypes) && in_array($fileMime, $allowedMimeTypes)) {
                        // Sanitize file name to prevent directory traversal
                        $sanitizedFileName = preg_replace('/[^a-zA-Z0-9\-\._]/', '_', $fileName);
                        $destination = "$lessonDir/$sanitizedFileName";

                        // Ensure the file name is unique
                        $counter = 1;
                        while (file_exists($destination)) {
                            $sanitizedFileName = pathinfo($fileName, PATHINFO_FILENAME) . "_$counter." . $fileExt;
                            $destination = "$lessonDir/$sanitizedFileName";
                            $counter++;
                        }

                        // Move uploaded file
                        if (move_uploaded_file($tmp_name, $destination)) {
                            $uploadedFiles[] = $destination;
                        }
                    }
                }
            }

            // Save file path in the database
            if (!empty($uploadedFiles)) {
                $filePath = implode(',', $uploadedFiles);
                $this->conn->query("UPDATE lessons SET ppt_path = '$filePath' WHERE id = '$id'") or die("File Path Error: " . $this->conn->error);
            }
        }

        $this->settings->set_flashdata('success', "Lesson Successfully saved.");
        return $id;
    } else {
        return json_encode([
            'sql1' => $sql,
            'sql2' => $sql2 ?? null
        ]);
    }
}
public function delete_lesson(){
    // Validate the ID
    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        die("Invalid ID.");
    }

    $id = intval($_POST['id']); // Convert to integer

    // Debugging: Print the ID
    echo "Deleting record with ID: $id<br>";

    // Use prepared statements to prevent SQL injection
    $stmt = $this->conn->prepare("DELETE FROM lessons WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $this->conn->error);
    }

    $stmt->bind_param('i', $id); // Bind the ID as an integer

    // Execute the query
    if ($stmt->execute()) {
        return 1;
    } else {
        die("Delete failed: " . $stmt->error); // Debugging
    }
}
    

    public function save_home() {
    extract($_POST);
    $data = "";

    // Prepare SQL data
    foreach($_POST as $k => $v) {
        if(!in_array($k, array('id', 'class_ids'))) {
            $v = $this->conn->real_escape_string($v);
            if(!empty($data)) $data .= ", ";
            if($k == 'description') $v = addslashes(htmlentities($v));
            $data .= " `{$k}` = '$v' ";
        }
    }

    // Insert or Update Query
    if(empty($id)) {
        $sql = "INSERT INTO home SET $data";
    } else {
        $sql = "UPDATE home SET $data WHERE id = $id";
    }

    // Execute Query with Error Checking
    $save = $this->conn->query($sql) or die("Error: " . $this->conn->error);
    
    if($save) {
        $id = (empty($id)) ? $this->conn->insert_id : $id;

        // Fix DELETE SQL Statement
        $this->conn->query("DELETE FROM home_class WHERE home_id = $id");

        // Insert class_id mapping
        if (!empty($class_ids)) {
            $data = "";
            foreach ($class_ids as $key => $value) {
                if (!empty($data)) $data .= ", ";
                $data .= "('$id', '{$class_ids[$key]}')";
            }
            $sql2 = $this->conn->query("INSERT INTO home_class (home_id, class_id) VALUES $data") or die("Error: " . $this->conn->error);
        }

        // File Upload Handling (For PDF & DOCX)
        if(isset($_FILES['home_file']) && count($_FILES['home_file']['tmp_name']) > 0) {
            $baseDir = '../uploads/doc';
            $lessonDir = "$baseDir/assignment_$id";

            // Ensure directory exists
            if (!is_dir($baseDir)) mkdir($baseDir, 0777, true);
            if (!is_dir($lessonDir)) mkdir($lessonDir, 0777, true);
            else {
                // Delete existing files in lesson folder
                $files = scandir($lessonDir);
                foreach ($files as $file) {
                    if (!in_array($file, array('.', '..'))) {
                        unlink("$lessonDir/$file");
                    }
                }
            }

            // Allowed file types and MIME types
            $allowedTypes = ['pdf', 'docx', 'mp4', 'mov', 'avi'];
    $allowedMimeTypes = [
        'pdf' => 'application/pdf',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'mp4' => 'video/mp4',
        'mov' => 'video/quicktime',
        'avi' => 'video/x-msvideo'
    ];

            // Upload and move files
            $uploadedFiles = [];
            foreach ($_FILES['home_file']['tmp_name'] as $k => $tmp_name) {
                if (!empty($tmp_name)) {
                    $fileName = $_FILES['home_file']['name'][$k];
                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $fileMime = mime_content_type($tmp_name);

                    // Validate file extension and MIME type
                    if (in_array($fileExt, $allowedTypes) && in_array($fileMime, $allowedMimeTypes)) {
                        // Sanitize file name to prevent directory traversal
                        $sanitizedFileName = preg_replace('/[^a-zA-Z0-9\-\._]/', '_', $fileName);
                        $destination = "$lessonDir/$sanitizedFileName";

                        // Ensure the file name is unique
                        $counter = 1;
                        while (file_exists($destination)) {
                            $sanitizedFileName = pathinfo($fileName, PATHINFO_FILENAME) . "_$counter." . $fileExt;
                            $destination = "$lessonDir/$sanitizedFileName";
                            $counter++;
                        }

                        // Move uploaded file
                        if (move_uploaded_file($tmp_name, $destination)) {
                            $uploadedFiles[] = $destination;
                        }
                    }
                }
            }

            // Save file path in the database
            if (!empty($uploadedFiles)) {
                $filePath = implode(',', $uploadedFiles);
                $this->conn->query("UPDATE home SET ppt_path = '$filePath' WHERE id = '$id'") or die("File Path Error: " . $this->conn->error);
            }
        }

        $this->settings->set_flashdata('success', "Assignment Successfully saved.");
        return $id;
    } else {
        return json_encode([
            'sql1' => $sql,
            'sql2' => $sql2 ?? null
        ]);
    }
}
public function delete_home(){
		extract($_POST);

		$delete = $this->conn->query("DELETE FROM home where id = $id");
		if($delete)
			return 1;
	}


    public function save_admin(){
		extract($_POST);
		$data="";
		foreach ($_POST as $key => $value) {
			if(!in_array($key, array('id')) && !is_numeric($key)){
				if(!empty($data)) $data .= ", ";
				$data .= " {$key} = '{$value}' ";
			}
		}
		$chk = $this->conn->query("SELECT * FROM users where admin_id = '$admin_id' ".((!empty($id))? " and id != {$id}" : ''));
		if($chk->num_rows > 0){
			return 2; 
			exit;
		}

		if(empty($id)){
			$data .= ", `password` = '".md5($admin_id)."' ";
			$sql = "INSERT INTO users set $data";
		}else{
			if(isset($preset) && $preset == 'on')
			$data .= ", `password` = '".md5($admin_id)."' ";
			$sql = "UPDATE users set $data where id = $id";
			$ofid = $this->conn->query("SELECT * FROM users where id = $id ")->fetch_array()['admin_id'];
		}

		$save = $this->conn->query($sql);
		if($save){
			$id= empty($id) ? $this->conn->insert_id : $id;
			if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
					$ext = explode('.', $_FILES['img']['name']);
					$fname = 'uploads/Favatar_'.$id.'.'.$ext[1];
					if(is_file('../'.$fname))
						unlink('../'.$fname);
					$move = move_uploaded_file($_FILES['img']['tmp_name'],'../'. $fname);
					if($move){
						$this->conn->query("UPDATE users set avatar = '$fname' where id = $id ");
					}
			}
			
			$this->settings->set_flashdata('success'," Admin Successfully saved.");
			return 1;
		}else{
			$resp['err']= "error saving data";
			$resp['sql']=$sql;
			return json_encode($resp);
		}

	}

	public function delete_admin(){
		extract($_POST);

		$delete = $this->conn->query("DELETE FROM users where id = $id");
		if($delete)
			return 1;
	}
}



$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save_academic':
		echo $Master->save_academic();
	break;
	case 'delete_academic':
		echo $Master->delete_academic();
	break;
	case 'save_department':
		echo $Master->save_department();
	break;
	case 'delete_department':
		echo $Master->delete_department();
	break;

	case 'save_course':
		echo $Master->save_course();
	break;
	case 'delete_course':
		echo $Master->delete_course();
	break;

	case 'save_subject':
		echo $Master->save_subject();
	break;
	case 'delete_subject':
		echo $Master->delete_subject();
	break;
	case 'save_student':
		echo $Master->save_student();
	break;
	case 'delete_student':
		echo $Master->delete_student();
	break;
	case 'save_class':
		echo $Master->save_class();
	break;
	case 'delete_class':
		echo $Master->delete_class();
	break;
	case 'student_class':
		echo $Master->student_class();
	break;	
	case 'load_class_subject':
		echo $Master->load_class_subject();
	break;		
	case 'save_faculty':
		echo $Master->save_faculty();
	break;
	case 'delete_faculty':
		echo $Master->delete_faculty();
	break;
	case 'faculty_class':
		echo $Master->load_faculty_subj();
	break;	
	case 'save_lesson':
		echo $Master->save_lesson();
	break;
    case 'save_admin':
		echo $Master->save_admin();
	break;
    case 'delete_admin':
		echo $Master->delete_admin();
	break;
    case 'save_home':
		echo $Master->save_home();
	break;
    case 'delete_home':
		echo $Master->delete_home();
	break;
	default:
		// echo $sysset->index();
		break;
}