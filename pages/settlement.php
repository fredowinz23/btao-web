<?php
  $ROOT_DIR="../";
  include $ROOT_DIR . "templates/header.php";

  $type = get_query_string("type", "Driver");
  $status = get_query_string("status", "Pending");
  $driver_penalty_list = driver_penalty()->list("status='$status' and type='$type'");

  $pendingActive = "";
  $paidActive = "";

  if ($status=="Pending") {
    $pendingActive = "active";
  }
  if ($status=="Paid") {
    $paidActive = "active";
  }
?>



<h2><?=$type?> Settlement</h2>

          <div class="widget-content searchable-container list">

            <div class="card card-body">
              <input type="text" class="form-control product-search ps-5" id="input-search" placeholder="Search Driver..." />
              <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link <?=$pendingActive?>" aria-current="page" href="?type=<?=$type?>&status=Pending">Unpaid</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?=$paidActive?>" href="?type=<?=$type?>&status=Paid">Paid</a>
              </li>
            </ul>
              <div class="table-responsive">
                <table class="table search-table align-middle text-nowrap">
                  <thead class="header-item">
                    <th>&nbsp;</th>
                    <th><?=$type;?></th>
                    <th>Violation</th>
                    <th>Amount</th>
                    <th>Officer</th>
                    <th width="10%">Action</th>
                  </thead>
                  <tbody>
                    <!-- start row -->


                    <?php
                    $count = 0;
                    foreach ($driver_penalty_list as $row):
                      $officer = account()->get("Id=$row->officerId");
                      if ($type=="Driver") {
                          $driver = driver()->get("Id=$row->referenceId");
                      }
                      if ($type=="Vehicle") {
                          $vehicle = vehicle()->get("Id=$row->referenceId");
                      }

                      $violationArray = array();
                      $totalPayment = 0;
                      foreach (penalty_item()->list("driverPenaltyId=$row->Id") as $item) {
                        $vio = violation()->get("Id=$item->violationId");
                        array_push($violationArray, $vio->name);
                        $totalPayment += $vio->amount;
                      }
                      $violationList = implode(', ', $violationArray);
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
                      <?php if ($type=="Driver"): ?>
                          <td>
                            <div class="d-flex align-items-center">
                              <div class="ms-3">
                                <div class="user-meta-info">
                                  <h6 class="user-name mb-0"><?=$driver->firstName;?> <?=$driver->lastName;?></h6>
                                </div>
                              </div>
                            </div>
                          </td>
                      <?php endif; ?>
                      <?php if ($type=="Vehicle"): ?>
                          <td>
                            <div class="d-flex align-items-center">
                              <div class="ms-3">
                                <div class="user-meta-info">
                                  <h6 class="user-name mb-0">Plate #:<?=$vehicle->plateNumber;?></h6>
                                </div>
                              </div>
                            </div>
                          </td>
                      <?php endif; ?>
                          <td>
                            <div class="d-flex align-items-center">
                              <div class="ms-3">
                                <div class="user-meta-info">
                                  <h6 class="user-name mb-0"><?=$violationList;?></h6>
                                </div>
                              </div>
                            </div>
                          </td>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="ms-3">
                                  <div class="user-meta-info">
                                    <h6 class="user-name mb-0">P <?=format_money($totalPayment);?></h6>
                                  </div>
                                </div>
                              </div>
                            </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <div class="user-meta-info">
                                <h6 class="user-name mb-0"><?=$officer->officerBadge;?>: <?=$officer->firstName;?> <?=$officer->lastName;?></h6>
                              </div>
                            </div>
                          </div>
                        </td>
                      <td>
                        <div class="action-btn">
                          <a href="violation-detail.php?pdId=<?=$row->Id;?>" class="text-info btn btn-primary">
                            View
                          </a>
                          <a href="process.php?action=violation-delete&Id=<?=$row->Id?>" class="text-dark ms-2 btn btn-danger">
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
<style>
#input-search{
  width:300px;
  margin-bottom: 30px;
}
</style>
