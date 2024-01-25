<?php
  $ROOT_DIR="../";
  include $ROOT_DIR . "templates/header.php";

  $Id = $_GET["Id"];
  $violation = violation()->get("Id=$Id");

  $item_list = penalty_item()->list("violationId='$Id'");

?>

          <div class="widget-content searchable-container list">

            <h2><?=$violation->name?></h2>

            <div class="card card-body">
              <div class="table-responsive">
                <table class="table search-table align-middle text-nowrap">
                  <thead class="header-item">
                    <th>#</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Violator</th>
                    <th>Zone</th>
                    <th>Officer</th>
                  </thead>
                  <tbody>
                    <!-- start row -->

                    <?php
                    $count = 0;
                    foreach ($item_list as $row):
                      $dp = driver_penalty()->get("Id=$row->driverPenaltyId");
                      $officer = account()->get("Id=$dp->officerId");
                      if ($dp->type=="Driver") {
                        $driver = driver()->get("Id=$dp->referenceId");
                      }
                      if ($dp->type=="Vehicle") {
                        $vehicle = vehicle()->get("Id=$dp->referenceId");
                      }
                      $zone = zone()->get("Id=$dp->zoneId");
                      $count += 1;
                       ?>

                    <tr class="search-items">
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <div class="user-meta-info">
                              <h6 class="user-name mb-0"><?=$count;?>. </h6>
                            </div>
                          </div>
                        </div>
                      </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <div class="user-meta-info">
                                <h6 class="user-name mb-0"><?=format_date($dp->dateAdded);?></h6>
                              </div>
                            </div>
                          </div>
                        </td>
                          <td>
                            <div class="d-flex align-items-center">
                              <div class="ms-3">
                                <div class="user-meta-info">
                                  <h6 class="user-name mb-0"><?=$dp->type;?></h6>
                                </div>
                              </div>
                            </div>
                          </td>

                          <?php if ($dp->type=="Driver"): ?>
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


                            <?php if ($dp->type=="Vehicle"): ?>
                              <td>
                                <div class="d-flex align-items-center">
                                  <div class="ms-3">
                                    <div class="user-meta-info">
                                      <h6 class="user-name mb-0">Plate #: <?=$vehicle->plateNumber;?></h6>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <?php endif; ?>

                            <td>
                              <div class="d-flex align-items-center">
                                <div class="ms-3">
                                  <div class="user-meta-info">
                                    <h6 class="user-name mb-0"><?=$zone->name;?></h6>
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
