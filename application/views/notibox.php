<?php foreach($info as $row){ ?>
			<tr>
			  <i class="fa fa-user-circle"></i> You got a photo Request from <?php echo $row->notify_from; ?></br/>
			  <button class="btn btn-sm btn-success">Accept</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger">Decline</button>
			  
			  </tr>
				
				
			<?php }?>