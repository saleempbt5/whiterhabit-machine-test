    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo  site_url('dashboard'); ?>" class="brand-link">
    IDE
      <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><?php echo $user['name'].'('. $user['username'].')';  ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
          <li class="nav-item ">
            <a href="<?php echo  site_url('dashboard'); ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
        
              </p>
            </a>
          
          </li>
          <?php
          
          if(is_array($menu)){
           foreach($menu as $menuitem){ 
             
             $sbmenu = read_submenu($menuitem['id']); 
             $classname = is_array($sbmenu)? ' has-treeview':'';
             $actclass = ($menuitem['id'] == $activeclass)? 'active': "";
             ?>

          <li class="nav-item <?php echo $classname." ".$actclass;  ?> " id="menu-<?php echo $menuitem['id']; ?>">
            <a href="<?php echo  site_url($menuitem['link']); ?>" class="nav-link <?php echo $actclass;  ?>">
              <i class="<?php echo $menuitem['iconclass'];  ?>"></i>
              <p>
              <?php echo  $menuitem['menuname']; ?>
               <?php if(is_array($sbmenu)){ ?>  <i class="right fas fa-angle-left"></i> <?php   }   ?>

              </p>
            </a>
            <?php if(has_childof($menuitem['id'])){  ?>
            <ul class="nav nav-treeview">
            <?php 
                     $sbmenu = array();
                     $sbmenu = read_submenu($menuitem['id']);
                        foreach($sbmenu as $submenuitem){  ?>
              <li class="nav-item" id="submenu2-<?php echo $submenuitem['id']; ?>">
                <a href="<?php echo  site_url($submenuitem['link']); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?php echo  $submenuitem['menuname']; ?></p>
                </a>
              </li>
                            <?php } ?>
            </ul>
            <?php } ?>


          </li>
                        <?php }  
          }
                        ?>
          <li class="nav-header">My Account</li>
          <li class="nav-item">
            <a href="<?php echo site_url('login/logout') ?>" class="nav-link">
              <i class="nav-icon fas fa-unlock text-danger"></i>
              <p>Logout</p>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>