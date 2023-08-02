<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);

?>
<div class="content-wrapper">
    <div class="container-fluid">
        <?php $this->load->view('common/messages.php'); ?>
<!-- this is form for add new and edit record  -->
        <div class="row ">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Edit Applicant Status</div>
                    <div class="card-body" style="width: 95%; margin: 27px auto; border: 1px solid #050579;">
					
                        <form method="post" action="<?php echo site_url('admin/participants/participantstatus/'.(isset($user_id)? @$user_id :'0')) ?>">
                        <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> 
                        <table class="table table-border">
                            <tr>
                                <th style="vertical-align: middle;">Verify Status </th>
                                <td><select name="status_id" class="form-control error" required="1">
                                      <?php $prestatus_id =   isset($result) ? set_value("status_id", @$result ->status_id) : set_value("status_id");
                                      $cos=get_cand_profile_status_list();
                                      foreach($cos as $key_cos =>$value_cos) {
                                        if($key_cos !=1){
                                          ?>
                                          <option value="<?php  echo $key_cos; ?>"
                                          <?php if($prestatus_id  == $key_cos) { echo 'selected'; }  ?>
                                          ><?php  echo $value_cos; ?></option>
                                          <?php
                                      }
                                      }
                                      ?>
                                  </select>
                                        <span class="form_error"><?php echo form_error('status_id'); ?></span></td>
										</tr>
                    		<tr>
                                <th style="vertical-align: middle;">Comment</th>
                                <td>
								<?php $varify_comment =   isset($result) ? set_value("varify_comment", @$result ->varify_comment) : set_value("varify_comment");?>
								  <textarea name="varify_comment" class="form-control" style="width:70%;"><?php echo $varify_comment;?></textarea>
														<span class="form_error"><?php echo form_error('varify_comment'); ?></span></td>
                            </tr>
                                   </table>
                           
                            
                                    <div class="text-center" style="margin-top: 20px">
									  <button type="submit" id="srch" class="btn btn-primary px-5"><i aria-hidden="true" class="fa fa-paper-plane"></i> Save</button>
                                        <a  href="<?php echo site_url('admin/participants/') ?>" type="reset" id="srch" class="btn btn-danger px-5 editLink"><i aria-hidden="true" class="fa fa-paper-plane"></i> Cancel</a>
                                       
                                    </div>

                       
                        </form>
                            </div>
                    </div>
                </div>

                </div>
            </div>
        </div><!-- End Row-->


    </div>
    <!-- End container-fluid-->
</div>
<script>
 $(document).ready(function() {
		if($('#tq').val()!=''){
			var i = $('#tq').val();
		}else{
			var i = 1;
		}

        $('#add').click(function() {
            b = i++;
            $('#dynamic_field').append('<tr id="row' + b + '"><td><strong>' + b + '.</strong></td><td><input type="text" name="degree_diploma[deg][]"  class="form-control" /></td><td><input type="text" name="degree_diploma[year][]" class="form-control" /></td><td><input type="text" name="degree_diploma[sub][]" class="form-control" /></td><td><input type="text" name="degree_diploma[uni][]" class="form-control" /></td><td><input type="text" name="degree_diploma[div][]" class="form-control" style="width:80%; float:left"/> <button type="button" name="remove" id="' + b + '" class="btn btn-danger btn_remove" style="width:16%;  float:right">X</button></td></tr>');
            $('#tq').val(b);
        });
		if($('#tq_work').val()!=''){
			var j = $('#tq_work').val();
		}else{
			var j = 1;
		}

        $('#addwork').click(function() {
            b = j++;
            $('#dynamic_field_work').append('<tr id="rowwork' + b + '"><td><strong>' + b + '.</strong></td><td><input type="text" name="work_experience[organization][]"  class="form-control" /></td><td><input type="text" name="work_experience[post_held][]" class="form-control" /></td><td><input type="text" name="work_experience[pay_scale][]" class="form-control" /></td><td><input type="date" name="work_experience[from_date][]" class="form-control" /></td><td><input type="date" name="work_experience[to_date][]" class="form-control" style="width:80%; float:left"/> <button type="button" name="remove" id="' + b + '" class="btn btn-danger btn_remove_work" style="width:16%;  float:right">X</button></td></tr>');
            $('#tq_work').val(b);
        }); 
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
		 $(document).on('click', '.btn_remove_work', function() {
            var button_id = $(this).attr("id");
            $('#rowwork' + button_id + '').remove();
        });
		$("#categorys").change();
		
			if($("#benchmark_yes").is(":checked")==true){
				document.getElementById('a2').style.display = "block"
			}else{
				document.getElementById('a2').style.display = "none"
			}
		$(document).on('click', '.benchmark', function() {
			if($("#benchmark_yes").is(":checked")==true){
				document.getElementById('a2').style.display = "block"
			}else{
				document.getElementById('a2').style.display = "none"
			}
        });
   
   });
   
		function categories() {
			var categorys=document.getElementById('categorys').value;
			if (categorys == 1) {
              document.getElementById('a1').style.display = "block"
             } else if (categorys == 2) {
               document.getElementById('a1').style.display = "none"
            }
       }
		</script>