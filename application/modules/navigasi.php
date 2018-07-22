        
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url('index.php/dashboard/page')?>">CRUD - ADMIN</a>
            </div>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav collapse navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <div class="user-info">
                            <div class="image">
                                <img id="nav-photo" width="65" height="65" alt="User" style="border: 2px solid #DDD">
                            </div>
                            <div class="info-container">
                                <div data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <b id="nav-nama"></b>
                                </div>
                                <text id="nav-email"></text>
                            </div>
                        </div>
                        <li>
                            <a href="<?php echo base_url('index.php/dashboard/page')?>">
                                <i class="fa fa-dashboard fa-fw"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('index.php/profil/tampil/user/').$this->session->userdata('id_pengguna')?>">
                                <i class="fa fa-user fa-fw"></i> Profil
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('index.php/tabel/tampil')?>">
                                <i class="fa fa-table fa-fw"></i> Tabel
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('index.php/dashboard/page/logout')?>">
                                <i class="fa fa-sign-out fa-fw"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        