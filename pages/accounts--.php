<?php
  $ROOT_DIR="../";
  include $ROOT_DIR . "templates/header.php";

  $role = $_GET['role'];
  $user_list = account()->list();
?>

<br>

          <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
              <div class="row align-items-center">
                <div class="col-9">
                  <h4 class="fw-semibold mb-8"><?=$role;?></h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a class="text-muted " href="">Account</a></li>
                      <li class="breadcrumb-item" aria-current="page"><?=$role?></li>
                    </ol>
                  </nav>
                </div>
                <div class="col-3">
                  <div class="text-center mb-n5">
                    <img src="../../dist/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="widget-content searchable-container list">
            <!-- --------------------- start Contact ---------------- -->
            <div class="card card-body">
              <div class="row">
                <div class="col-md-4 col-xl-3">
                  <form class="position-relative">
                    <input type="text" class="form-control product-search ps-5" id="input-search" placeholder="Search <?=$role;?>..." />
                    <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                  </form>
                </div>
                <div class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                  <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-info d-flex align-items-center">
                    <i class="ti ti-users text-white me-1 fs-5"></i> Add <?=$role;?>
                  </a>
                </div>
              </div>
            </div>
            <!-- ---------------------
                            end Contact
                        ---------------- -->
            <!-- Modal -->
            <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title">Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="add-contact-box">
                      <div class="add-contact-content">
                        <form id="addContactModalTitle">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3 contact-name">
                                <input type="text" id="c-name" class="form-control" placeholder="Name" />
                                <span class="validation-text text-danger"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3 contact-email">
                                <input type="text" id="c-email" class="form-control" placeholder="Email" />
                                <span class="validation-text text-danger"></span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3 contact-occupation">
                                <input type="text" id="c-occupation" class="form-control" placeholder="Occupation" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3 contact-phone">
                                <input type="text" id="c-phone" class="form-control" placeholder="Phone" />
                                <span class="validation-text text-danger"></span>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button id="btn-add" class="btn btn-success rounded-pill px-4">Add</button>
                    <button id="btn-edit" class="btn btn-success rounded-pill px-4">Save</button>
                    <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal"> Discard </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-body">
              <div class="table-responsive">
                <table class="table search-table align-middle text-nowrap">
                  <thead class="header-item">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    <!-- start row -->

                    <?php
                    $count = 0;
                    foreach ($user_list as $row):
                      $count += 1;
                       ?>

                    <tr class="search-items">
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <div class="user-meta-info">
                              <h6 class="user-name mb-0" data-name="<?=$row->firstName;?> <?=$row->lastName;?>"><?=$count;?>. <?=$row->firstName;?> <?=$row->lastName;?></h6>
                              <span class="user-work fs-3" data-occupation="<?=$row->role;?>"><?=$row->role;?></span>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <span class="usr-email-addr" data-email="<?=$row->email;?>"><?=$row->email;?></span>
                      </td>
                      <td>
                        <span class="usr-ph-no" data-phone="<?=$row->phone;?>"><?=$row->phone;?></span>
                      </td>
                      <td>
                        <div class="action-btn">
                          <a href="javascript:void(0)" class="text-info edit">
                            <i class="ti ti-eye fs-5"></i>
                          </a>
                          <a href="javascript:void(0)" class="text-dark delete ms-2">
                            <i class="ti ti-trash fs-5"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                    <!-- end row -->

                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


          <?php include $ROOT_DIR . "templates/footer.php"; ?>


          <script src="<?=$ROOT_DIR;?>pages/js/accounts.js"></script>
