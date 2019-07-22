  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-sync-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-1">Referral Data</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        MENU
      </div>

      <!-- Nav Item - Tables -->
      <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('admin'); ?>">
          <i class="fas fa-fw fa-users"></i>
          <span>Users</span></a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/referral'); ?>">
          <i class="fas fa-fw fa-user-friends"></i>
          <span>Referrals</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <h2>Welcome, <?php echo $user['name']; ?>!!!</h2>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600">
                  <i class="fas fa-fw fa-user"></i>
                </span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">User List</h1>
          <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
          <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addUserModal">Add User</button>
          <?= $this->session->flashdata('message'); ?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">User DataTables</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Date Created</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Date Created</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php $no = 1;
                    foreach ($users as $row) {
                      ?>
                      <tr>
                        <td><?= $row->name ?></td>
                        <td><?= $row->email ?></td>
                        <td><?= $row->date_created ?></td>
                        <td style="text-align:center">
                          <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editUserModal<?= $row->id; ?>" data-whatever="<?= $row->name ?>"><i class="fa fa-edit fa-lg"></i></button>

                          <div class="modal fade" id="editUserModal<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form class="user" method="post" action="<?= base_url('admin/update'); ?>">
                                    <div class="form-group">
                                      <label for="name" class="col-form-label">Name:</label>
                                      <input type="text" hidden class="form-control" id="id-edit" name="id-edit" value="<?= $row->id ?>">
                                      <input type="text" class="form-control" id="name-edit" name="name-edit" value="<?= $row->name ?>">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>

                          <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $row->id; ?>"><i class="fa fa-trash-alt fa-lg"></i></button>

                          <div class="modal fade" id="deleteModal<?= $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete user</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form class="user" method="post" action="<?= base_url('admin/delete'); ?>">
                                  <div class="modal-body">
                                    Are you sure want to delete user with name <b><?= $row->name ?></b>?
                                    <input type="text" hidden class="form-control" id="id-delete" name="id-delete" value="<?= $row->id ?>">

                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>

                        </td>
                      </tr>
                      <?php $no++;
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Created by Rizky Tria Meditanala 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="user" method="post" action="<?= base_url('admin/adduser'); ?>">
            <div class="form-group">
              <label for="name" class="col-form-label">Name:</label>
              <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name'); ?>" placeholder="ex : Rizky Tria Meditanala">
              <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="email" class="col-form-label">Email:</label>
              <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email'); ?>" placeholder="ex : rizky_tm@gmail.com">
              <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="password1" class="col-form-label">Password:</label>
              <input type="password" class="form-control" id="password1" name="password1">
              <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="password2" class="col-form-label">Repeat Password:</label>
              <input type="password" class="form-control" id="paswword2" name="password2">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>