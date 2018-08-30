<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Candidate Profiling System
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <!--link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" /-->
  <!--link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet"-->
  <link href="app/assets/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="app/assets/bs4/css/bootstrap.min.css" rel="stylesheet" />
  <link href="app/assets/bs4/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="app/assets/bs4/demo/demo.css" rel="stylesheet" />
</head>

<body>
  <!-- our app will be injected here -->
  <div id="app"></div>
  <!--   Core JS Files   -->
  <script src="app/assets/bs4/js/core/jquery.min.js"></script>
  <script src="app/assets/bs4/js/core/popper.min.js"></script>
  <script src="app/assets/bs4/js/core/bootstrap.min.js"></script>
  <script src="app/assets/bs4/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="app/pages.js"></script>
  <script>





      
      
$(document).ready(function (){
  // will run if 'create product' form was submitted
  $(document).on('submit', '#user-profile-update-form', function() {
      // get form data
    var form_data=$(this).serialize();
      console.log(form_data);
       // submit form data to api
    $.ajax({
        url: "../api/system_user/update.php",
        type : "POST",
        //contentType : 'application/json',
        data : form_data,
        success : function(resp) {
            var data = JSON.parse(resp);
            if(data['flag']){
                var NewFullName = $('#user-profile-update-form input[name="full_name"]').val();
                $('div.author h5.title').html(NewFullName);
                localStorage.setItem("full_name", NewFullName);
                      swal({
                        title: "Profile Updated!",
                        text: "Changes were saved!",
                        buttonsStyling: false,
                        confirmButtonClass: "btn btn-success",
                        type: "success"
                      }).catch(swal.noop);
            }
            
        },
        error: function(xhr, resp, text) {
            // show error to console
            console.log(xhr, "Error: "+resp, text);
        }
    });
      return false;
  });

    $(document).on('click', '#logmeout', function(){
        localStorage.clear();
        pages.login();
    });


});     
      
var Dashboard = {
    "Chart":{
        "init":function(){
            Dashboard.Chart.CandidateProfileStatus();
        },
        "CandidateProfileStatus":function(){
            var ctx = document.getElementById('chartProfileStatus').getContext("2d"),
                ProfileStatus = ["Active", "In-Process", "Hired", "Blacklisted"];
                myChart = new Chart(ctx, {
                  type: 'pie',
                  data: {
                    labels: ProfileStatus,
                    datasets: [{
                      label: "Emails",
                      pointRadius: 0,
                      pointHoverRadius: 0,
                      backgroundColor: [
                        '#e3e3e3',
                        '#4acccd',
                        '#25c681',
                        '#fcc468'
                      ],
                      borderWidth: 0,
                      data: [542, 480, 430,300]
                    }]
                  },
                  options: {

                    legend: {
                      display: true
                    },

                    tooltips: {
                      enabled: true
                    },

                    scales: {
                      yAxes: [{

                        ticks: {
                          display: false
                        },
                        gridLines: {
                          drawBorder: false,
                          zeroLineColor: "transparent",
                          color: 'rgba(255,255,255,0.05)'
                        }

                      }],

                      xAxes: [{
                        barPercentage: 1.6,
                        gridLines: {
                          drawBorder: false,
                          color: 'rgba(255,255,255,0.1)',
                          zeroLineColor: "transparent"
                        },
                        ticks: {
                          display: false,
                        }
                      }]
                    },
                  }
                });
        }
    }
}      
      
  var UserProfilePicture = '../img/user_profile/'+localStorage.getItem('profile_picture');
  var pages = {
    "login":function(){
    $('body').addClass("login-page");
    //Navbar
    app_html='';
    app_html+='<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">';
        app_html+='<div class="container">';
         app_html+=' <div class="navbar-wrapper">';
            app_html+='<a class="navbar-brand" href="#">Candidate Profiling System</a>';
          app_html+='</div>';
        app_html+='</div>';
    app_html+=' </nav>';
    //End Navbar

    app_html +='  <div class="wrapper wrapper-full-page ">';
    app_html +='    <div class="full-page section-image" filter-color="blue">';
    app_html +='      <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->';
    app_html +='      <div class="content">';
    app_html +='        <div class="container">';
    app_html +='          <div class="col-lg-4 col-md-6 ml-auto mr-auto">';
    app_html +='            <form class="form" id="login-form" method="" action="">';
    app_html +='              <div class="card card-login">';
    app_html +='                <div class="card-header ">';
    app_html +='                  <div class="card-header ">';
    app_html +='                    <h3 class="header text-center">Login</h3>';
    app_html +='                  </div>';
    app_html +='                </div>';
    app_html +='                <div class="card-body ">';
    app_html +='                  <div class="input-group">';
    app_html +='                    <div class="input-group-prepend">';
    app_html +='                      <span class="input-group-text">';
    app_html +='                        <i class="nc-icon nc-single-02"></i>';
    app_html +='                      </span>';
    app_html +='                    </div>';
    app_html +='                    <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" required>';
    app_html +='                  </div>';
    app_html +='                  <div class="input-group">';
    app_html +='                    <div class="input-group-prepend">';
    app_html +='                      <span class="input-group-text">';
    app_html +='                        <i class="nc-icon nc-key-25"></i>';
    app_html +='                      </span>';
    app_html +='                    </div>';
    app_html +='                    <input type="password" name="password" placeholder="Password" class="form-control" required>';
    app_html +='                  </div>';
    app_html +='                  <div class="form-text text-danger text-center font-weight-bold" id="login-notice"></div>';
    app_html +='                  <br/>';
    app_html +='                  <div class="form-group">';
    app_html +='                    <div class="form-check">';
    app_html +='                      <label class="form-check-label">';
    app_html +='                        <input class="form-check-input" type="checkbox" value="" checked="">';
    app_html +='                        <span class="form-check-sign"></span>';
    app_html +='                        Stay logged in';
    app_html +='                      </label>';
    app_html +='                    </div>';
    app_html +='                  </div>';
    app_html +='                </div>';
    app_html +='                <div class="card-footer">';
    app_html +='                  <button type="submit" class="btn btn-outline-primary btn-round btn-block mb-3 log-me-in">Let\'s go</button>';
    app_html +='                </div>';
    app_html +='              </div>';
    app_html +='            </form>';
    app_html +='          </div>';
    app_html +='        </div>';
    app_html +='      </div>';
    app_html +='    </div>';
    app_html +='  </div>';
    $("#app").html(app_html);
    $page = $('.full-page');
    image_src = 'app/assets/bs4/img/bg/ben-white.jpg';

    if (image_src !== undefined) {
      image_container = '<div class="full-page-background" style="background-image: url(' + image_src + ') "/>';
      $page.append(image_container);
    }
        },"dashboard":function(){
       $('body').removeClass("login-page");
                // app html
                var html = "";
                html += pages.sidebar();
                // inject to 'app' in index.html
                $("#app").html(html);
var html = "";
html +='        <div class="row">';
html +='          <div class="col-lg-6 col-md-8 col-sm-8">';
html +='            <div class="card">';
html +='              <div class="card-header">';
html +='                <h5 class="card-title">Candidate Profile Status</h5>';
html +='                <p class="card-category">Last Campaign Performance</p>';
html +='              </div>';
html +='              <div class="card-body ">';
html +='                <div class="row">';
html +='<canvas id="chartProfileStatus" class="ct-chart ct-perfect-fourth chartjs-render-monitor" width="299" height="196" style="display: block; width: 299px; height: 196px;"></canvas>';
html +='                </div>';
html +='              </div>';
html +='            </div>';
html +='          </div>';
html +='          <div class="col-lg-3 col-md-6 col-sm-6">';
html +='            <div class="card card-stats">';
html +='              <div class="card-body ">';
html +='                <div class="row">';
html +='                  <div class="col-5 col-md-4">';
html +='                    <div class="icon-big text-center icon-warning">';
html +='                      <i class="nc-icon nc-money-coins text-success"></i>';
html +='                    </div>';
html +='                  </div>';
html +='                  <div class="col-7 col-md-8">';
html +='                    <div class="numbers">';
html +='                      <p class="card-category">Revenue</p>';
html +='                      <p class="card-title">$ 1,345';
html +='                        </p><p>';
html +='                    </p></div>';
html +='                  </div>';
html +='                </div>';
html +='              </div>';
html +='              <div class="card-footer ">';
html +='                <hr>';
html +='                <div class="stats">';
html +='                  <i class="fa fa-calendar-o"></i> Last day';
html +='                </div>';
html +='              </div>';
html +='            </div>';
html +='          </div>';
html +='          <div class="col-lg-3 col-md-6 col-sm-6">';
html +='            <div class="card card-stats">';
html +='              <div class="card-body ">';
html +='                <div class="row">';
html +='                  <div class="col-5 col-md-4">';
html +='                    <div class="icon-big text-center icon-warning">';
html +='                      <i class="nc-icon nc-vector text-danger"></i>';
html +='                    </div>';
html +='                  </div>';
html +='                  <div class="col-7 col-md-8">';
html +='                    <div class="numbers">';
html +='                      <p class="card-category">Errors</p>';
html +='                      <p class="card-title">23';
html +='                        </p><p>';
html +='                    </p></div>';
html +='                  </div>';
html +='                </div>';
html +='              </div>';
html +='              <div class="card-footer ">';
html +='                <hr>';
html +='                <div class="stats">';
html +='                  <i class="fa fa-clock-o"></i> In the last hour';
html +='                </div>';
html +='              </div>';
html +='            </div>';
html +='          </div>';
html +='          <div class="col-lg-3 col-md-6 col-sm-6">';
html +='            <div class="card card-stats">';
html +='              <div class="card-body ">';
html +='                <div class="row">';
html +='                  <div class="col-5 col-md-4">';
html +='                    <div class="icon-big text-center icon-warning">';
html +='                      <i class="nc-icon nc-favourite-28 text-primary"></i>';
html +='                    </div>';
html +='                  </div>';
html +='                  <div class="col-7 col-md-8">';
html +='                    <div class="numbers">';
html +='                      <p class="card-category">Followers</p>';
html +='                      <p class="card-title">+45K';
html +='                        </p><p>';
html +='                    </p></div>';
html +='                  </div>';
html +='                </div>';
html +='              </div>';
html +='              <div class="card-footer ">';
html +='                <hr>';
html +='                <div class="stats">';
html +='                  <i class="fa fa-refresh"></i> Update now';
html +='                </div>';
html +='              </div>';
html +='            </div>';
html +='          </div>';
html +='        </div>';
                $("#app_content").html(html);
            Dashboard.Chart.init();
                (function() {
                isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;
                if (isWindows) {
                  // if we are on windows OS we activate the perfectScrollbar function
                  $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                  $('html').addClass('perfect-scrollbar-on');
                } else {
                  $('html').addClass('perfect-scrollbar-off');
                }
              })();
        },"content":{
            "load":function(title,html){
                $('a.navbar-brand').html(title);
                $('#app_content').html(html);
            },
            "load_icon":function(title,html){
                $('#app_content').html('<span class="nc-icon nc-bank nc-icon-spin"/>Loading');
            }
        },"user_profile":{
            "view":function(e){
                pages.content.load_icon();
var html = '';
html +='       <div class="row">';
html +='          <div class="col-md-6">';
html +='            <div class="card card-user">';
html +='              <div class="image">';
html +='                <img src="app/assets/bs4/img/bg/rawpixel-com.jpg" alt="...">';
html +='              </div>';
html +='              <div class="card-body" style="min-height:auto;">';
html +='                <div class="author">';
html +='                  <a href="#">';
html +='                    <img class="avatar border-gray" src="'+UserProfilePicture+'" alt="No image">';
html +='                    <h5 class="title">'+localStorage.getItem('full_name')+'</h5>';
html +='                  </a>';
html +='                  <p class="description">'+localStorage.getItem('username')+'</p>';
html +='                </div>';
html +='              </div>';
html +='              <div class="card-footer">';
html +='                <hr>';
html +='                <form id="user-profile-update-form" class="horizontal">';
//Username
html +='                  <div class="row">';
html +='                    <label class="col-md-3 col-form-label">Username</label>';
html +='                    <div class="col-md-9">';
html +='                       <div class="form-group">';
html +='                           <input type="text" class="form-control" name="username" placeholder="Username" value="'+localStorage.getItem('username')+'" disabled="" autocomplete="off">';
html +='                       </div>';
html +='                    </div>';
html +='                  </div>';
//Password
html +='                  <div class="row">';
html +='                    <label class="col-md-3 col-form-label">Password</label>';
html +='                    <div class="col-md-9">';
html +='                       <div class="form-group">';
html +='                           <input type="password" class="form-control" name="password" placeholder="Password (Fill in to change password)">';
html +='                       </div>';
html +='                    </div>';
html +='                  </div>';
//Full Name
html +='                  <div class="row">';
html +='                    <label class="col-md-3 col-form-label">Full Name</label>';
html +='                    <div class="col-md-9">';
html +='                       <div class="form-group">';
html +='                           <input type="text" class="form-control" name="full_name" placeholder="Full Name" value="'+localStorage.getItem('full_name')+'" required autocomplete="off">';
html +='                       </div>';
html +='                    </div>';
html +='                  </div>';
html +='                <div class="row">';
html +='                    <label class="col-md-3"></label>';
html +='                    <div class="col-md-9">';
html +='                        <button type="submit" class="btn btn-info btn-round">Update Profile</button>';
html +='                    </div>';
html +='                </div>';
html +='                <input type="hidden" name="user_id" value="'+localStorage.getItem('user_id')+'">';
html +='                </form>';
html +='              </div>';
html +='            </div>';
html +='          </div>';
html +='        </div>';
                pages.content.load($(e).html(),html);
            }
        },"sidebar":function(){
                      var sidebar = '';
sidebar += '  <div class="wrapper ">';
sidebar += '    <div class="sidebar" data-color="brown" data-active-color="danger">';
sidebar += '      <!--';
sidebar += '        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"';
sidebar += '    -->';
sidebar += '      <div class="logo">';
sidebar += '        <a href="#" class="simple-text logo-mini">';
sidebar += '          <div class="logo-image-small">';
sidebar += '            <img src="app/assets/images/optimus-and-conexus-logo.png">';
sidebar += '          </div>';
sidebar += '        </a>';
sidebar += '        <a href="#" class="simple-text logo-normal">';
sidebar += '          <div class="logo-image-big">';
sidebar += '            CPS';
sidebar += '          </div>';
sidebar += '        </a>';
sidebar += '      </div>';
sidebar += '      <div class="sidebar-wrapper">';
sidebar += '        <div class="user">';
sidebar += '          <div class="photo">';
sidebar += '            <img src="../img/user_profile/'+localStorage.getItem('profile_picture')+'" />';
sidebar += '          </div>';
sidebar += '          <div class="info">';
sidebar += '            <a data-toggle="collapse" href="#collapseExample" class="collapsed">';
sidebar += '              <span>';
sidebar +=                 localStorage.getItem('username');
sidebar += '                <b class="caret"></b>';
sidebar += '              </span>';
sidebar += '            </a>';
sidebar += '            <div class="clearfix"></div>';
sidebar += '            <div class="collapse" id="collapseExample">';
sidebar += '              <ul class="nav">';
sidebar += '                <li>';
sidebar += '                  <a href="#">';
sidebar += '                    <span class="sidebar-mini-icon">MP</span>';
sidebar += '                    <span class="sidebar-normal" onClick="pages.user_profile.view(this)">My Profile</span>';
sidebar += '                  </a>';
sidebar += '                </li>';
sidebar += '                <!--li>';
sidebar += '                  <a href="#">';
sidebar += '                    <span class="sidebar-mini-icon">S</span>';
sidebar += '                    <span class="sidebar-normal">Settings</span>';
sidebar += '                  </a>';
sidebar += '                </li-->';
sidebar += '                <li>';
sidebar += '                  <a href="#">';
sidebar += '                    <span class="sidebar-mini-icon">LO</span>';
sidebar += '                    <span class="sidebar-normal" id="logmeout">Log out</span>';
sidebar += '                  </a>';
sidebar += '                </li>';
sidebar += '              </ul>';
sidebar += '            </div>';
sidebar += '          </div>';
sidebar += '        </div>';
sidebar += '        <ul class="nav">';
sidebar += '          <li>';
sidebar += '            <a onClick="pages.dashboard()">';
sidebar += '              <i class="nc-icon nc-bank"></i>';
sidebar += '              <p>Dashboard</p>';
sidebar += '            </a>';
sidebar += '          </li>';

/*
sidebar += '          <li>';
sidebar += '            <a data-toggle="collapse" href="#pagesExamples">';
sidebar += '              <i class="nc-icon nc-book-bookmark"></i>';
sidebar += '              <p>';
sidebar += '                Pages';
sidebar += '                <b class="caret"></b>';
sidebar += '              </p>';
sidebar += '            </a>';
sidebar += '            <div class="collapse " id="pagesExamples">';
sidebar += '              <ul class="nav">';
sidebar += '                <li>';
sidebar += '                  <a href="../examples/pages/timeline.html">';
sidebar += '                    <span class="sidebar-mini-icon">T</span>';
sidebar += '                    <span class="sidebar-normal"> Timeline </span>';
sidebar += '                  </a>';
sidebar += '                </li>';
sidebar += '                <li>';
sidebar += '                  <a href="../examples/pages/login.html">';
sidebar += '                    <span class="sidebar-mini-icon">L</span>';
sidebar += '                    <span class="sidebar-normal"> Login </span>';
sidebar += '                  </a>';
sidebar += '                </li>';
sidebar += '                <li>';
sidebar += '                  <a href="../examples/pages/register.html">';
sidebar += '                    <span class="sidebar-mini-icon">R</span>';
sidebar += '                    <span class="sidebar-normal"> Register </span>';
sidebar += '                  </a>';
sidebar += '                </li>';
sidebar += '                <li>';
sidebar += '                  <a href="../examples/pages/lock.html">';
sidebar += '                    <span class="sidebar-mini-icon">LS</span>';
sidebar += '                    <span class="sidebar-normal"> Lock Screen </span>';
sidebar += '                  </a>';
sidebar += '                </li>';
sidebar += '                <li>';
sidebar += '                  <a href="../examples/pages/user.html">';
sidebar += '                    <span class="sidebar-mini-icon">UP</span>';
sidebar += '                    <span class="sidebar-normal"> User Profile </span>';
sidebar += '                  </a>';
sidebar += '                </li>';
sidebar += '              </ul>';
sidebar += '            </div>';
sidebar += '          </li>';
*/

            
sidebar += '        </ul>';
sidebar += '      </div>';
sidebar += '    </div>';
sidebar += '    <div class="main-panel">';
sidebar += '      <!-- Navbar -->';
sidebar += '      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">';
sidebar += '        <div class="container-fluid">';
sidebar += '          <div class="navbar-wrapper">';
sidebar += '            <div class="navbar-minimize">';
sidebar += '              <button id="minimizeSidebar" class="btn btn-icon btn-round">';
sidebar += '                <i class="nc-icon nc-minimal-right text-center visible-on-sidebar-mini"></i>';
sidebar += '                <i class="nc-icon nc-minimal-left text-center visible-on-sidebar-regular"></i>';
sidebar += '              </button>';
sidebar += '            </div>';
sidebar += '            <div class="navbar-toggle">';
sidebar += '              <button type="button" class="navbar-toggler">';
sidebar += '                <span class="navbar-toggler-bar bar1"></span>';
sidebar += '                <span class="navbar-toggler-bar bar2"></span>';
sidebar += '                <span class="navbar-toggler-bar bar3"></span>';
sidebar += '              </button>';
sidebar += '            </div>';
sidebar += '            <a class="navbar-brand">Dashboard</a>';
sidebar += '          </div>';
sidebar += '          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">';
sidebar += '            <span class="navbar-toggler-bar navbar-kebab"></span>';
sidebar += '            <span class="navbar-toggler-bar navbar-kebab"></span>';
sidebar += '            <span class="navbar-toggler-bar navbar-kebab"></span>';
sidebar += '          </button>';
sidebar += '          <div class="collapse navbar-collapse justify-content-end" id="navigation">';
sidebar += '            <!--form>';
sidebar += '              <div class="input-group no-border">';
sidebar += '                <input type="text" value="" class="form-control" placeholder="Search...">';
sidebar += '                <div class="input-group-append">';
sidebar += '                  <div class="input-group-text">';
sidebar += '                    <i class="nc-icon nc-zoom-split"></i>';
sidebar += '                  </div>';
sidebar += '                </div>';
sidebar += '              </div>';
sidebar += '            </form-->';
sidebar += '            <ul class="navbar-nav">';
sidebar += '              <!--li class="nav-item">';
sidebar += '                <a class="nav-link btn-magnify" href="#pablo">';
sidebar += '                  <i class="nc-icon nc-layout-11"></i>';
sidebar += '                  <p>';
sidebar += '                    <span class="d-lg-none d-md-block">Stats</span>';
sidebar += '                  </p>';
sidebar += '                </a>';
sidebar += '              </li-->';
sidebar += '              <li class="nav-item btn-rotate dropdown">';
sidebar += '                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
sidebar += '                  <i class="nc-icon nc-bell-55"></i>';
sidebar += '                  <p>';
sidebar += '                    <span class="d-lg-none d-md-block">Some Actions</span>';
sidebar += '                  </p>';
sidebar += '                </a>';
sidebar += '                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">';
sidebar += '                  <a class="dropdown-item" href="#">Action</a>';
sidebar += '                  <a class="dropdown-item" href="#">Another action</a>';
sidebar += '                  <a class="dropdown-item" href="#">Something else here</a>';
sidebar += '                </div>';
sidebar += '              </li>';
sidebar += '              <!--li class="nav-item">';
sidebar += '                <a class="nav-link btn-rotate" href="#pablo">';
sidebar += '                  <i class="nc-icon nc-settings-gear-65"></i>';
sidebar += '                  <p>';
sidebar += '                    <span class="d-lg-none d-md-block">Account</span>';
sidebar += '                  </p>';
sidebar += '                </a>';
sidebar += '              </li-->';
sidebar += '            </ul>';
sidebar += '          </div>';
sidebar += '        </div>';
sidebar += '      </nav>';
sidebar += '      <div class="content" id="app_content"></div>';
sidebar += '      <!-- End Navbar -->';
sidebar += '      <!-- <div class="panel-header">';
return sidebar;
                    }
                }
  </script>
  <script src="app/app.js"></script>


  <script src="app/assets/bs4/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="app/assets/bs4/js/plugins/moment.min.js"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="app/assets/bs4/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="app/assets/bs4/js/plugins/sweetalert2.min.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="app/assets/bs4/js/plugins/jquery.validate.min.js"></script>
  <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="app/assets/bs4/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="app/assets/bs4/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="app/assets/bs4/js/plugins/bootstrap-datetimepicker.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
  <script src="app/assets/bs4/js/plugins/jquery.dataTables.min.js"></script>
  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="app/assets/bs4/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="app/assets/bs4/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="app/assets/bs4/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="app/assets/bs4/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Bootstrap Table -->
  <script src="app/assets/bs4/js/plugins/nouislider.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!--script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script-->
  <!-- Chart JS -->
  <script src="app/assets/bs4/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="app/assets/bs4/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="app/assets/bs4/js/paper-dashboard.min.js" type="text/javascript"></script>
  <!-- login scripts -->
<script src="app/system_user/login.js"></script>
</body>

</html>
