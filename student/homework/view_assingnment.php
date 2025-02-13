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
    
</style>
<div class="card card-outline cardprimary w-fluid">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($title) ? $title : '' ?></h3>
	</div>
    <div class="card card-outline cardprimary w-fluid">
	<div class="card-header">
		
		<div class="card-tools">
			<a class="btn btn-block btn-sm btn-default btn-flat border-primary edit_lesson" href="./?page=homework/manage_assingnment&id=<?php echo $id ?>"><i class="fa fa-plus"></i> Click to enter your Answers</a>
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
        <h5>Description</h5>
        <hr>
        <div>
        <?php echo html_entity_decode($description) ?>
        </div>
        <hr>
        <div class="container-fluid">
        <h5>Questions</h5>
        <hr>
        <div>
        <?php echo html_entity_decode($question) ?>
        </div>
        <hr>
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
            <hr>
        <div>
        
        <label for="" class="control-label" cols="300" rows="10" ><?php echo html_entity_decode($answer) ?></label>
        </div>
        <div class="w-100">
            <div class="col-md-12">
            <span class="float-right"><b>Prepared By: </b><?php echo $fname ?></span>
            </div>
            <div class="card-tools">
			
		</div>
        </div>
            <br>
            
        <div class="w-100">
            <div class="col-md-12">            
             <span class="float-right"><b>Date Sent:  </b><?php echo $hDate ?></span>
            </div>
            <div class="card-tools">
			
		</div>
        </div>
           
           
        </div>
    </div>
</div>

<script>
	$(document).ready(function(){
		$('.new_lesson').click(function(){
			location.href = "./?page=homework/manage_assingnment";
		})
		$('.action_edit').click(function(){
			uni_modal("Edit Answers","./home/manage_assingnment.php?id="+$(this).attr('data-id'));
		})
	
		$('.action_delete').click(function(){
		_conf("Are you sure to delete your |Answer?","delete_home",[$(this).attr('data-id')])
		})
		$('table').dataTable();
	})
	function delete_lesson($id){
		start_loader()
		$.ajax({
			url:_base_url_+'lessones/Master.php?f=delete_home',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					location.reload()
				}
			}
		})
	}
</script>