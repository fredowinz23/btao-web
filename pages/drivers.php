<?php
  $ROOT_DIR="../";
  include $ROOT_DIR . "templates/header.php";

  $driver_list = driver()->list();
?>
      <div class="widget-content searchable-container list">
        <!-- --------------------- start Contact ---------------- -->
        <div class="card card-body">
          <div class="row">
            <div class="col-md-4 col-xl-3">
              <form class="position-relative">
                <input type="text" class="form-control product-search ps-5" id="input-search" placeholder="Search Driver..." />
                <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
              </form>
            </div>
            <div class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
              <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-info d-flex align-items-center">
                <i class="ti ti-users text-white me-1 fs-5"></i> Add Driver
              </a>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title">Driver</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="process.php?action=driver-save" id="addContactModalTitle" method="post">
              <div class="modal-body">
                <div class="add-contact-box">
                  <div class="add-contact-content">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="mb-3 contact-name">
                          <input type="hidden" name="Id" id="c-id"/>
                          <input type="text" name="firstName" id="c-firstname" class="form-control" placeholder="First Name" required/>
                          <span class="validation-text text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="mb-3 contact-name">
                          <input type="text" name="lastName" id="c-lastname" class="form-control" placeholder="Last Name" required/>
                          <span class="validation-text text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="mb-3 contact-name">
                          <input type="text" name="middleInitial" id="c-middleInitial" class="form-control" placeholder="M.I." required/>
                          <span class="validation-text text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="mb-3 contact-name">
                          <input type="text" name="address" id="c-address" class="form-control" placeholder="Address" required/>
                          <span class="validation-text text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3 contact-name">
                          <input type="date" name="birthday" id="c-birthday" class="form-control" placeholder="Birthday" required/>
                          <span class="validation-text text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3 contact-name">
                          <input type="text" name="licenseNumber" id="c-licenseNumber" class="form-control" placeholder="License Number" required/>
                          <span class="validation-text text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3 contact-name">
                          <input type="text" name="plateNumber" id="c-plateNumber" class="form-control" placeholder="Plate Number" required/>
                          <span class="validation-text text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3 contact-name">
                          <input type="text" name="color" id="c-color" class="form-control" placeholder="Color" required/>
                          <span class="validation-text text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3 contact-name">
                          <input type="text" name="brand" id="c-brand" class="form-control" placeholder="Brand" required/>
                          <span class="validation-text text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3 contact-name">
                          <input type="text" name="model" id="c-carModel" class="form-control" placeholder="Model" required/>
                          <span class="validation-text text-danger"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button name="form-type" value="add" id="btn-add" class="btn btn-success rounded-pill px-4">Add</button>
                <button name="form-type" value="edit" id="btn-edit" class="btn btn-success rounded-pill px-4">Save</button>
                <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal"> Discard </button>
              </div>
            </form>
            </div>
          </div>
        </div>
        <div class="card card-body">
          <div class="table-responsive">
            <table class="table search-table align-middle text-nowrap">
              <thead class="header-item">
                <th>Full Name</th>
                <th>License #</th>
                <th>Plate #</th>
                <th width="10%">Action</th>
              </thead>
              <tbody>
                <!-- start row -->

                <?php
                $count = 0;
                foreach ($driver_list as $row):
                  $count += 1;
                   ?>

                <tr class="search-items">
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="ms-3">
                        <div class="user-meta-info">
                          <h6 class="user-name mb-0"
                           data-id="<?=$row->Id;?>"
                           data-firstName="<?=$row->firstName;?>"
                           data-lastName="<?=$row->lastName;?>"
                           data-middleInitial="<?=$row->middleInitial;?>"
                           data-address="<?=$row->address;?>"
                           data-birthday="<?=$row->birthday;?>"
                           data-licenseNumber="<?=$row->licenseNumber;?>"
                           data-plateNumber="<?=$row->plateNumber;?>"
                           data-color="<?=$row->color;?>"
                           data-brand="<?=$row->brand;?>"
                           data-carModel="<?=$row->model;?>"
                          ><?=$count;?>. <?=$row->firstName;?> <?=$row->middleInitial;?>. <?=$row->lastName;?></h6>
                        </div>
                      </div>
                    </div>
                  </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="ms-3">
                          <div class="user-meta-info">
                            <h6 class="mb-0"><?=$row->licenseNumber;?></h6>
                          </div>
                        </div>
                      </div>
                    </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <div class="user-meta-info">
                              <h6 class="mb-0"><?=$row->plateNumber;?></h6>
                            </div>
                          </div>
                        </div>
                      </td>
                  <td>
                    <div class="action-btn">
                      <a href="driver-violation.php?driverId=<?=$row->Id;?>" class="edit btn btn-sm btn-success">
                        Violation
                      </a>
                      <a href="javascript:void(0)" class="edit btn btn-sm btn-primary">
                        View
                      </a>
                      <a href="process.php?action=driver-delete&Id=<?=$row->Id?>" class="btn btn-danger btn-sm">
                        Delete
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

      <script src="<?=$ROOT_DIR;?>pages/js/drivers.js"></script>
