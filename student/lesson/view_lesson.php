<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif; ?>
<?php
$id = isset($_GET['id']) ? $_GET['id']: '';
if(!empty($id)){
    $qry = $conn->query("SELECT l.*,CONCAT(f.firstname,' ',f.middlename,' ',f.lastname) as fname, CONCAT(s.subject_code,' - ',s.description) as subj FROM lessons l inner join faculty f on f.faculty_id = l.faculty_id inner join subjects s on s.id = l.subject_id where l.id = $id");
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
</style>
<div class="card card-outline cardprimary w-fluid">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($title) ? $title : '' ?></h3>
	</div>
	<div class="card-body">
        <div class="w-100">
            <div class="col-md-12">
                <span class="truncate float-right" style="max-width:calc(50%);font-size:13px !important;font-weight:bold">Subject: <?php echo $subj ?></span>
            </div>
        </div>
        <br>
        <h5>Lesson Files</h5>
    <hr>

    <?php
$qry = $conn->query("SELECT ppt_path FROM lessons WHERE id = $id");
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
        <h5>Description</h5>
        <hr>
        <div>
        <?php echo html_entity_decode($description) ?>
        </div>
        <hr>
        <div class="w-100">
            <div class="col-md-12">
            <span class="float-right"><b>Prepared By: </b><?php echo $fname ?></span>
            </div>
        </div>
        </div>
    </div>
</div>