<nav class="navbar navbar-expand-lg " style="background-color:#124f62;">
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto custom-navbar" >
        <li class="nav-item active nav-var-special">
                <a class="nav-link dropdown-toggle" href="home" role="button">Main Dashboard</a>
        </li>
      <li class="nav-item nav-var-special">
        <a class="nav-link dropdown-toggle" href="setup_company" role="button">Company Setup</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" onclick="dropdown_toggle_inter(this),clearnotif()" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <i class="fa fa-bell"></i><span class="badge badge-danger notif_count" id="notifbadge"><?php echo $notif_count!=0? $notif_count : ''; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right notif-drop" aria-labelledby="navbarDropdown">
          
          <a class="dropdown-item" href="#">No Notification Found</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" onclick="dropdown_toggle_inter(this)" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{$user_position->name}} <i class="fa fa-caret-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
          
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
        </div>
      </li>
      
    </ul>
    
  </div>
</nav>