 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>     -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php if($this->userdata['roleid']=='2'){
                echo $dbsts['total'];
              }
              else{
                echo $mysts['total'];
              }
                ?></h3>
                
                
                <p>Total Works</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php if($this->userdata['roleid']=='2'){
                echo site_url('works/index/all');
                
              }
              else{
                echo site_url('myworks/index/all');
              }
                ?>" class="small-box-footer more"  >More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- /col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php if($this->userdata['roleid']=='2'){
                echo $dbsts['wrkcomplete'];
              }
              else{
                echo $mysts['mywrkcomplete'];
              }
                ?></h3>

                <p>Completed</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php if($this->userdata['roleid']=='2'){
                echo site_url('works/index/2');
              }
              else{
                echo site_url('myworks/index/2');
              }
                ?>" class="small-box-footer more">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php if($this->userdata['roleid']=='2'){
                echo $dbsts['wrkassign'];
              }
              else{
                echo $mysts['mywrkassign'];
              }
                ?></h3>

                <p>Assigned</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php if($this->userdata['roleid']=='2'){
                 echo site_url('works/index/0');
              }
              else{
                echo site_url('myworks/index/0');
              }
                ?>" class="small-box-footer more">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php if($this->userdata['roleid']=='2'){
                echo $dbsts['wrkprogress'];
              }
              else{
                echo $mysts['mywrkprogress'];
              }
                ?></h3>

                <p>On progress</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?php if($this->userdata['roleid']=='2'){
                 echo site_url('works/index/1');
              }
              else{
                echo site_url('myworks/index/1');
              }
                ?>" class="small-box-footer more">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
          <!-- /.Left col -->
          </section>