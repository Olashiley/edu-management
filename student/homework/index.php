<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif; ?>
<div class="card card-outline cardprimary w-fluid">
	<div class="card-header">
		<h3 class="card-title">Assingnment</h3>
		<div class="card-tools">
<!--			<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_lesson" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New Assingnment</a>-->
		</div>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-compact table-stripped">
			<colgroup>
				<col width="5%">
				<col width="20%">
				<col width="20%">
				<col width="40%">
				<col width="15%">
			</colgroup>
			<thead>
			
				<tr>
					<th>#</th>
					<th>Topic</th>
					<th>Subject</th>
					<th>Description</th>
                    <th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i =1;
				$academic_year_id= $_settings->userdata('academic_id');
				$student_id= $_settings->userdata('student_id');
				$class_id = $conn->query("SELECT * FROM student_class where academic_year_id = {$academic_year_id} and student_id = '{$student_id}' ");
				if($class_id->num_rows > 0):
				$class_id = $class_id->fetch_array()['class_id'];
				$qry = $conn->query("SELECT l.*,s.subject_code FROM home l inner join subjects s on s.id = l.subject_id where l.academic_year_id = '{$academic_year_id}' and l.id in (SELECT home_id from home_class where class_id = '{$class_id}') ");
				while($row=$qry->fetch_assoc()):
					$desc = html_entity_decode($row['description']);
					$desc = stripslashes($desc);
					$desc = strip_tags($desc);
				?>
				
				<tr>
					<td><?php echo $i++ ?></td>
					<td><?php echo $row['title'] ?></td>
					<td><?php echo $row['subject_code'] ?></td>
					<td><span class="truncate"><?php echo $desc ?></span></td>
                    <td><?php echo $row['hDate'] ?></td>
					<td class="text-center">
						<div class="btn-group">
		                    <button type="button" class="btn btn-default btn-block btn-flat dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown" aria-expanded="false">
		                    	Action
		                      <span class="sr-only">Toggle Dropdown</span>
		                    </button>
		                    <div class="dropdown-menu" role="menu" style="">
	                    	 <a class="dropdown-item action_load" href="./?page=homework/view_assingnment&id=<?php echo $row['id'] ?>">View Assingnment</a>
		                    </div>
		                </div>
					</td>	
				</tr>
				<?php endwhile; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('.new_lesson').click(function(){
			location.href = "./?page=homework/manage_assingnment";
		})
		$('.action_edit').click(function(){
			uni_modal("Edit lesson","./home/manage_assingnment.php?id="+$(this).attr('data-id'));
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