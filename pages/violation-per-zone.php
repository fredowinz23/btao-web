<?php
  $ROOT_DIR="../";
  include $ROOT_DIR . "templates/header.php";

  $dateNow = date("Y-m-d");
  $from = get_query_string("from", $dateNow);
  $to = get_query_string("to", $dateNow);
  $zone_list = zone()->list();
?>


<h2>Violation Per Zone</h2>

          <div class="widget-content searchable-container list">

            <div class="card">

              <form action="" method="get">

              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <input type="date" name="from" value="<?=$from?>" class="form-control" required>
                  </div>
                    <div class="col">
                      <input type="date" name="to" value="<?=$to?>" class="form-control" required>
                    </div>
                      <div class="col">
                        <button type="submit" class="btn btn-primary">Filter</button>
                      </div>
                </div>
              </div>

            </form>

            </div>


          <div class="card card-body">
              <div class="table-responsive">
                <table class="table search-table align-middle text-nowrap">
                  <thead class="header-item">
                    <th>#</th>
                    <th>Zone</th>
                    <th width="100">Total Violators</th>
                  </thead>
                  <tbody>
                    <!-- start row -->

                    <?php
                    $count = 0;
                    $totalViolations = 0;
                    foreach ($zone_list as $row):
                      $countViolation = driver_penalty()->count("zoneId=$row->Id and (dateAdded>='$from' and dateAdded<='$to')");
                      $totalViolations += $countViolation;
                      $count += 1;
                       ?>

                    <tr class="search-items">
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="ms-3">
                            <div class="user-meta-info">
                              <h6 class="user-name mb-0" data-id="<?=$row->Id;?>" data-name="<?=$row->name;?>" data-amount="<?=$row->amount;?>"><?=$count;?>.</h6>
                            </div>
                          </div>
                        </div>
                      </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <div class="user-meta-info">
                                <h6 class="user-name mb-0"><?=$row->name;?></h6>
                              </div>
                            </div>
                          </div>
                        </td>
                          <td>
                            <div class="d-flex align-items-center">
                              <div class="ms-3">
                                <div class="user-meta-info">
                                  <h6 class="user-name mb-0"><?=$countViolation?></h6>
                                </div>
                              </div>
                            </div>
                          </td>
                    </tr>
                    <!-- end row -->

                  <?php endforeach; ?>
                  <tr>
                    <td>&nbsp;</td>
                      <td>&nbsp;</td>
                          <td>Total: <?=$totalViolations;?></td>
                  </tr>
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
