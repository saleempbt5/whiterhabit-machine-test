
<div class="col-xs-12">
	    <div class="card">
	        <div class="card-head">
	            <div class="card-header">
	            	<h4 class="card-title">All Files</h4>
					<div class="heading-elements" style="float:right">
		                <button class="btn btn-primary btn-sm" data-toggle="modal"  data-target="#addfile"><i class="fas fa-file"></i> Add File</button>            			
		            
					</div>
					
	            </div>
				<div class="col-md-3 mt-3">
					<select class="form-control" id="usersfilter" name="usersfilter">
                          <option value="1">Active</option>
                          <option value="2">Deleted</option>
                        </select>
						</div>
	        </div>
	        <?php if($this->session->flashdata('success')){ ?> 

                    

								<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong><?php echo $this->session->flashdata('success') ?></strong> 
                
                </div>


                    <?php } ?>
					<?php if($this->session->flashdata('error')){ ?> 

                    

                 <div class="alert alert-danger alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong><?php echo $this->session->flashdata('error') ?></strong> 

                      </div>


                    <?php } ?>
            <div class="card-body">
	            <div class="card-block table-responsive">
	                <!-- Task List table -->
	                <table id="filelist" class="table table-bordered table-striped" data-controller="<?php echo site_url('dashboard/') ?>">
                       	<thead>
					           <tr>
					              <th>Sl.No</th>
								  <th>Filename</th>
								  <th>URL</th>
					              <th>Uploaded By</th>
					              <th>Action</th>
								  					                
					            </tr>
					        </thead>
					       
	                </table>

	            </div>

	        </div>
			
	    </div>
	</div>

	<!-- Add User -->        
	<div class="modal fade text-xs-left" id="addfile"  role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
									  <div class="modal-dialog modal-md" role="document">
										<div class="modal-content">
										  <div class="modal-header bg-primary white">
											
											<h4 class="modal-title" id="myModalLabel8">ADD FILE</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											  <span aria-hidden="true">&times;</span>
											</button>
										  </div>
										   <?php
                     $attributes = array('class' => 'form-horizontal', 'id' => 'fileaddform');
                       echo form_open_multipart('dashboard/add_files',$attributes) ?>
											<div class="modal-body">
											   
												<div class="row">
												
													<div class="col-md-6">
												
											  <div class="form-group">
											       
									              <label for="menuName">File Name</label><span class="text-danger">*</span>
												  
									               <input type="text" id="filename" class="form-control" placeholder="Enter Filename" name="filename" required >
												</div></div>
												<div class="col-md-6">
												
                    <div class="form-group">
                      <label>Select a File</label><span class='text-danger'>*</span>
                       <input type="file" class="form-control" name="file" id="file" required/> 
                    </div>

							</div>
								                </div>
												<div class="row">
												<div class="col-md-12">
												<div class="form-group">
                  <label>Select Users</label>
                  <div class="select2-purple">
                    <select class="select2" multiple="multiple" multiple name="users[]" id="users" data-placeholder="Select Users" data-dropdown-css-class="select2-purple" required style="width: 100%;">
                     <?php foreach($users as $user){  ?>
											<option value="<?php echo $user['id']; ?>"><?php echo $user['name']."(".$user['username'] .")"; ?></option>

											<?php } ?>
										
                    </select>
                  </div>
                </div>
                <!-- /.form-group -->
												
			                                    </div>
											
												
												
                                             
											<div class="modal-footer">
												<button type="reset" class="btn btn-warning mr-1" data-dismiss="modal" value="close">
								                	<i class="icon-cross2"></i> Cancel
								                </button>
													<input name="submit" type="submit" class="btn btn-primary mr-1" value="Save">
															
											</div>
										  <?php echo form_close() ?>
										</div>
									  </div>
									</div>
									   </div>

           <!-- user Edit  -->

		 
		   <div class="modal fade text-xs-left" id="editfile"  role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
									  <div class="modal-dialog modal-md" role="document">
										<div class="modal-content">
										  <div class="modal-header bg-primary white">
											
											<h4 class="modal-title" id="myModalLabel8">EDIT USER</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											  <span aria-hidden="true">&times;</span>
											</button>
										  </div>
										   <?php
                     $attributes = array('class' => 'form-horizontal', 'id' => 'usereditform');
                       echo form_open('users/editpost_validation',$attributes) ?>
											<div class="modal-body">
											<div class="row">
											<div class="col-md-6">
											  <div class="form-group">
											<label id="uname"></label>
											</div>
											</div>
											</div>
												<div class="row">
													<div class="col-md-6">
											  <div class="form-group">

									              <label for="menuName">Name</label><span class="text-danger">*</span>
												 
									               <input type="text" id="edituname" class="form-control" placeholder="Enter name" name="edituname" required >
												</div></div>
												<div class="col-md-6">	
                                                <div class="form-group">
												<label for="companyName">Phone Number</label><span class="text-danger">*</span>
									                <input type="number" id="edituphone" class="form-control" placeholder="Enter phone number" name="edituphone" required>
									             
												</div>
												</div>
			                                    </div>
												<div class="form-group">
												<label for="companyName">Email</label><span class="text-danger">*</span>
									                <input type="email" id="edituemail" class="form-control" placeholder="Enter email" name="edituemail" required >
												</div>
												
											
												<div class="row">
												<div class="col-md-6">
                                                <div class="form-group">
									              <label for="companyName">Password</label><span class="text-danger">*</span>
									                <input type="password" id="editupswdid" class="form-control" name="editupswdid" data-rule-userpswdid="true" >
												</div></div>
												<div class="col-md-6">
												<div class="form-group">
									              <label for="companyName">Confirm Password</label><span class="text-danger">*</span>
									                <input type="password" id="editucpswdid" class="form-control"  name="editucpswdid" data-rule-userpswdid="true" data-rule-equalTo="#editupswdid" >
			                                   </div>
												</div>
												<input type="hidden" name="idusr" id="idusr"/>
			                                    </div>
												<div class="form-group">
									              <label for="companyName">Address</label><span class="text-danger">*</span>
									               <textarea class="form-control" id="edituadd" name="edituadd" cols="3" placeholder="Enter address here" required></textarea>
												</div>
												
												
                                             
											<div class="modal-footer">
												<button type="reset" class="btn btn-warning mr-1" data-dismiss="modal" value="close">
								                	<i class="icon-cross2"></i> Cancel
								                </button>
													<input name="submit" type="submit" class="btn btn-primary mr-1" value="Save">
															
											</div>
										  <?php echo form_close() ?>
										</div>
									  </div>
									</div>
									   </div>
      <!-- /user edit-->
