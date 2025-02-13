<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif; ?>
<?php
$id = isset($_GET['id']) ? $_GET['id']: '';
if(!empty($id)){
    $qry = $conn->query("SELECT l.*,CONCAT(f.firstname,' ',f.middlename,' ',f.lastname) as fname, CONCAT(s.subject_code,' - ',s.description) as subj FROM home l inner join faculty f on f.faculty_id = l.faculty_id inner join subjects s on s.id = l.subject_id where l.id = $id");
    foreach($qry->fetch_array() as $k =>$v){
        if(!is_numeric($k)){
            $$k = $v;
        }
    }
    $description = stripslashes($description);
}
?>
<style>
#carousel_holder{
display: inline-flex;
justify-content:center;
background: #2f2e2e;
}    
#lesson_slides{
    width:calc(50%);
}
.carousel-control-prev {
    left: calc(-30%);
}
.carousel-control-next {
    right: calc(-30%);
}
    .pdf-container {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 20px;
    background: #f9f9f9;
}

.docx-container {
    padding: 10px;
    background: #eef;
    border-left: 5px solid #007bff;
}

</style>
<div class="card card-outline cardprimary w-fluid">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($title) ? $title : '' ?></h3>
		<div class="card-tools">
			<a class="btn btn-block btn-sm btn-default btn-flat border-primary edit_assignment" href="./?page=homework/manage_assignment&id=<?php echo $id ?>"><i class="fa fa-plus"></i> Edit Assignment</a>
		</div>
	</div>
	<div class="card-body">
        <div class="w-100">
            <div class="col-md-12">
                <span class="truncate float-right" style="max-width:calc(50%);font-size:13px !important;font-weight:bold">Subject: <?php echo $subj ?></span>
            </div>
        </div>
        <br>
       <div class="container-fluid">
    <h5>Assignment Files</h5>
    <hr>

    <?php
$qry = $conn->query("SELECT ppt_path FROM home WHERE id = $id");
$row = $qry->fetch_assoc();
$files = (!empty($row['ppt_path'])) ? explode(',', $row['ppt_path']) : [];

if (!empty($files)) {
    foreach ($files as $file) {
        $fileExt = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if ($fileExt == 'pdf') {
            echo "<a href='$file'>Download PDF</a><br>";
        } elseif ($fileExt == 'docx') {
            echo "<a href='$file'>Download DOCX</a><br>";
        } elseif (in_array($fileExt, ['mp4', 'mov', 'avi'])) {
            echo "<video controls width='300'><source src='$file' type='video/$fileExt'></video><br>";
        }
    }
} else {
    echo "No files uploaded.";
}
?>
</div>
        
        <br>
        <div class="container-fluid">
        <h5>Notes</h5>
        <hr>
        <div>
        <strong><?php echo html_entity_decode($description) ?></strong>
        </div>
        <hr>
        <br>
        <div class="container-fluid">
        <h5>Questions</h5>
        <hr>
        <div>
        <?php echo html_entity_decode($question) ?>
        </div>
        <hr>

        <section>
        <div class="w-100">
        <h6>This is visible to:</h6>
        <hr>
        <?php 
        $class = $conn->query("SELECT cs.*,d.department,CONCAT(co.course,' ',c.level,'-',c.section) as class,s.subject_code,s.description FROM class_subjects_faculty cs inner join class c on c.id = cs.class_id inner join subjects s on s.id = cs.subject_id inner join department d on d.id = c.department_id inner join course co on co.id = c.course_id where cs.faculty_id = '{$faculty_id}' and cs.academic_year_id = '{$academic_year_id}' and cs.class_id in (SELECT class_id FROM home_class where home_id = $id ) group by cs.class_id ");
        while($row = $class->fetch_assoc()):
        ?>
        <span class="badge badge-primary m-1" style="font-size:12px"><?php echo $row['class'] ?></span>
        <?php endwhile; ?>
        </div>
        </section>
        <hr>
        <div class="w-100">
            <div class="col-md-12">
            <span class="float-right"><b>Prepared By: </b><?php echo $fname ?></span>
            </div>
        </div>
        </div>
    </div>
</div>