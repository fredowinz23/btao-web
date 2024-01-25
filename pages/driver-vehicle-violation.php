<?php
  $ROOT_DIR="../";
  include $ROOT_DIR . "templates/header.php";

  $referenceId = $_GET["referenceId"];
  $type = $_GET["type"];
  if ($type=="Driver") {
    $driver = driver()->get("Id=$referenceId");
  }
  if ($type=="Vehicle") {
    $vehicle = vehicle()->get("Id=$referenceId");
  }


  $status = get_query_string("status", "Pending");

  $driver_penalty_list = driver_penalty()->list("referenceId=$referenceId and type='$type' and status='$status'");
  $violation_list = violation()->list();


  $pendingActive = "";
  $paidActive = "";

  if ($status=="Pending") {
    $pendingActive = "active";
  }
  if ($status=="Paid") {
    $paidActive = "active";
  }
?>


          <div class="widget-content searchable-container list">
            <div class="card card-body">
              <div class="row">
                <div class="col-md-4 col-xl-3">
                </div>
                <div class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                  <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-info d-flex align-items-center">
                    <i class="ti ti-users text-white me-1 fs-5"></i> Add Violation
                  </a>
                </div>
              </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="violationModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title">Violation Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="process.php?action=driver-violation-add" id="addContactModalTitle" method="post">
                  <div class="modal-body">
                    <input type="hidden" name="referenceId" value="<?=$referenceId;?>">
                    <input type="hidden" name="type" value="<?=$type;?>">

                      <b>Check violations:</b>
                      <div class="row">
                    <?php foreach ($violation_list as $row): ?>
                      <div class="col-6">
                          <input type="checkbox" name="violation[]" value="<?=$row->Id?>"> <?=$row->name;?> (<?=$row->amount;?>)
                      </div>
                    <?php endforeach; ?>
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
              <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link <?=$pendingActive?>" aria-current="page" href="?referenceId=<?=$referenceId?>&type=<?=$type?>&status=Pending">Pending</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?=$paidActive?>" href="?referenceId=<?=$referenceId?>&type=<?=$type?>&status=Paid">Paid</a>
              </li>
            </ul>
              <div class="table-responsive">
                <table class="table search-table align-middle text-nowrap">
                  <thead class="header-item">
                    <th>#</th>
                    <th>Date</th>
                    <th>Officer</th>
                    <th width="10%">Action</th>
                  </thead>
                  <tbody>
                    <!-- start row -->

                    <?php
                    $count = 0;
                    foreach ($driver_penalty_list as $row):
                      $officer = account()->get("Id=$row->officerId");
                      $count += 1;
                       ?>

                    <tr class="search-items">
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <div class="user-meta-info">
                              <h6 class="user-name mb-0" data-id="<?=$row->Id;?>" data-name="<?=$row->name;?>" data-amount="<?=$row->amount;?>"><?=$count;?>. </h6>
                            </div>
                          </div>
                        </div>
                      </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <div class="user-meta-info">
                                <h6 class="user-name mb-0"><?=$row->dateAdded;?></h6>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <div class="user-meta-info">
                                <h6 class="user-name mb-0"><?=$officer->firstName;?> <?=$officer->lastName;?></h6>
                              </div>
                            </div>
                          </div>
                        </td>
                      <td>
                        <div class="action-btn">
                          <a href="violation-detail.php?pdId=<?=$row->Id;?>" class="text-info btn btn-primary">
                            View
                          </a>
                          <a href="process.php?action=dv-violation-delete&Id=<?=$row->Id?>&referenceId=<?=$referenceId?>&type=<?=$row->type?>" class="text-dark ms-2 btn btn-danger">
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


<script type="text/javascript">
$(function () {

    $("#input-search").on("keyup", function () {
      var rex = new RegExp($(this).val(), "i");
      $(".search-table .search-items:not(.header-item)").hide();
      $(".search-table .search-items:not(.header-item)")
        .filter(function () {
          return rex.test($(this).text());
        })
        .show();
    });

    $("#btn-add-contact").on("click", function (event) {

      // var $_username = document.getElementById("c-username");
      // $_username.value = "";
      //
      // var $_generatedpw = Math.floor(Math.random()*899999+100000);
      //
      // var $_password = document.getElementById("c-password");
      // $_password.value = $_generatedpw;
      //
      // var $_dpassword = document.getElementById("c-display-password");
      // $_dpassword.value = $_generatedpw;

      $("#violationModal #btn-add").show();
      $("#violationModal #btn-edit").hide();
      $("#violationModal").modal("show");
    });


    function editContact() {
      $(".edit").on("click", function (event) {
        $("#violationModal #btn-add").hide();
        $("#violationModal #btn-edit").show();

        // Get Parents
        var getParentItem = $(this).parents(".search-items");
        var getModal = $("#violationModal");

        // Get List Item Fields
        var $_name = getParentItem.find(".user-name");
        // Set Modal Field's Value

        // Set Modal Field's Value
        getModal.find("#c-id").val($_name.attr("data-id"));
        getModal.find("#c-name").val($_name.attr("data-name"));
        getModal.find("#c-amount").val($_name.attr("data-amount"));

        $("#violationModal").modal("show");
      });
    }

    editContact();

  });

</script>
