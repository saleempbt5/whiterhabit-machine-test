<div class="col-xs-12">
	    <div class="card">
	        <div class="card-head">
	            <div class="card-header">
	            	<h4 class="card-title">All Menus</h4>
		            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        			<div class="heading-elements">
		                <button class="btn btn-primary btn-sm" data-toggle="modal"  data-target="#addmenu"><i class="icon-plus4 white"></i> Add Menu</button>            			
		            </div>
	            </div>
	        </div>
	        <?php if($this->session->flashdata('successmsg')){ ?> 

                     <div class="alert alert-success alert-dismissible fade in mb-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <strong><?php echo $this->session->flashdata('successmsg') ?>!</strong> 
                                </div>

                    <?php } ?>
             <?php if($this->session->flashdata('failuremsg')){ ?> 

                     <div class="alert alert-danger alert-dismissible fade in mb-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <strong><?php echo $this->session->flashdata('failuremsg') ?>!</strong> 
                                </div>

                    <?php } ?>
            <div class="card-body collapse in">
	            <div class="card-block table-responsive">
	                <!-- Task List table -->
	                <table id="menulist" class="table table-white-space table-bordered display " data-controller="<?php echo site_url('menus/') ?>">
                       	<thead>
					            <tr>
					                <th>Menu name</th>
					                <th>Parent</th>
					                <th>Status</th>
					                <th>Action</th>					                
					            </tr>
					        </thead>
					        <tfoot>
					            <tr>
					                <th>Menu name</th>
					                <th>Parent</th>
					                <th>Status</th>
					                <th>Action</th>
					            </tr>
					        </tfoot>
	                </table>

	            </div>

	        </div>
	    </div>
	</div>

	<!-- Add Menu -->        
		<div class="modal fade text-xs-left" id="addmenu"  role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
									  <div class="modal-dialog" role="document">
										<div class="modal-content">
										  <div class="modal-header bg-primary white">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											  <span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel8">ADD MENU</h4>
										  </div>
										   <?php
                     $attributes = array('class' => 'form-horizontal', 'id' => 'menuaddform', 'novalidate' => 'novalidate');
                       echo form_open('menus/savemenuItem',$attributes) ?>
											<div class="modal-body">
											  <div class="form-group">
									              <label for="menuName">Menu Name</label>
									               <input type="text" id="menuName" class="form-control" placeholder="Menu Name" name="menuName" required data-validation-required-message="This field is required">
								                </div>	
                                                <div class="form-group">
									              <label for="companyName">Full URL</label>
									                <input type="text" id="menuUrl" class="form-control" placeholder="Menu URL" name="menuUrl" data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*" data-validation-regex-message="Only Valid URL's">
								                </div>

												<div class="form-group">
									            <label for="parent">Parent</label>
									<select class="select2 form-control" id="parent" name="parent" tabindex="-1">		
									  <option value="0" >NO</option>
								       <?php foreach($menulist as $menu){   ?>
                                              <option value="<?php echo $menu['id'] ?>"><?php echo $menu['name'] ?></option>


								       <?php } ?>
								
							         </select>
								                </div>
                                             <div class="row">
							                 	<div class="col-lg-6 col-md-12">
                                           <div class="form-group">                                    	     
									              <label for="menuName">Menu wieght/order</label>
									               <input type="number" id="wieght" class="form-control" name="wieght" required data-validation-required-message="This field is required">
								                </div>
                                               </div>
                                               <div class="col-lg-6 col-md-12">
                                           <div class="form-group">                                    	     
									              <label for="menuName">Icon Class</label>
									               <input type="text" id="iconclass" class="form-control" name="iconclass"  placeholder="icon-windows">
								                </div>
                                               </div>
                                           </div>

											</div>
											<div class="modal-footer">
												<button type="reset" class="btn btn-warning mr-1" data-dismiss="modal" value="close">
								                	<i class="icon-cross2"></i> Cancel
								                </button>
													<button type="submit" class="btn btn-primary mr-1" value="Submit">
															<i class="icon-check2"></i> Save
													</button>
											</div>
										  <?php echo form_close() ?>
										</div>
									  </div>
									</div>
           

           <!-- Menu Edit  -->

           <div class="modal fade text-xs-left" id="editmenu"  role="dialog" aria-labelledby="myModalLabel8" aria-hidden="true">
									  <div class="modal-dialog" role="document">
										<div class="modal-content">
										  <div class="modal-header bg-primary white">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											  <span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="myModalLabel8">Edit MENU</h4>
										  </div>
										   <?php
                     $attributes = array('class' => 'form-horizontal', 'id' => 'menueditform', 'novalidate' => 'novalidate');
                       echo form_open('menus/EditmenuItem',$attributes) ?>
                                            <input type="hidden" name="edmenuid" value="" id="edmenuid">
											<div class="modal-body">
											  <div class="form-group">
									              <label for="menuName">Menu Name</label>
									               <input type="text" id="edmenuName" class="form-control" placeholder="Menu Name" name="edmenuName" required data-validation-required-message="This field is required">
								                </div>	
                                                <div class="form-group">
									              <label for="companyName">Full URL</label>
									                <input type="text" id="edmenuUrl" class="form-control" placeholder="Menu URL" name="edmenuUrl" data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*" data-validation-regex-message="Only Valid URL's">
								                </div>

												<div class="form-group">
									            <label for="parent">Parent</label>
									<select class="select2 form-control" id="edparent" name="edparent" tabindex="-1">		
									  <option value="0" >NO</option>
								       <?php foreach($menulist as $menu){   ?>
                                              <option value="<?php echo $menu['id'] ?>"><?php echo $menu['name'] ?></option>


								       <?php } ?>
								
							         </select>
								                </div>
                                             <div class="row">
							                 	<div class="col-lg-6 col-md-12">
                                           <div class="form-group">                                    	     
									              <label for="menuName">Menu wieght/order</label>
									               <input type="number" id="edwieght" class="form-control" name="edwieght" required data-validation-required-message="This field is required">
								                </div>
                                               </div>
                                               <div class="col-lg-6 col-md-12">
                                           <div class="form-group">                                    	     
									              <label for="menuName">Icon Class</label>
									               <input type="text" id="ediconclass" class="form-control" name="ediconclass"  placeholder="icon-windows">
								                </div>
                                               </div>
                                           </div>
                                           <div class="row">
							                 	<div class="col-lg-6 col-md-12">
							                 		<div class="form-group">
									            <label for="parent">Status</label>
									<select class="select2 form-control" id="edmenustatus" name="edmenustatus" tabindex="-1">		
									  <option value="1" >ACTIVE</option>
								      <option value="3" >DISABLED</option>
								      <option value="2" >DELETED</option>
							         </select>
								                </div>
							                 	</div>
							                 </div>
                                              
											</div>
											<div class="modal-footer">
												<button type="reset" class="btn btn-warning mr-1" data-dismiss="modal" value="close">
								                	<i class="icon-cross2"></i> Cancel
								                </button>
													<button type="submit" class="btn btn-primary mr-1" value="Submit">
															<i class="icon-check2"></i> Save
													</button>
											</div>
										  <?php echo form_close() ?>
										</div>
									  </div>
									</div>