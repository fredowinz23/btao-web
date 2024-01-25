<?php
  $ROOT_DIR="../";
  include $ROOT_DIR . "templates/header.php";

  $dateNow = date("Y-m-d");
  $from = get_query_string("from", $dateNow);
  $to = get_query_string("to", $dateNow);
  $violation_list = violation()->list();
?>


<h2>Violation Per Category</h2>

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

            <!-- Modal -->
            <div class="modal fade" id="violationModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title">Violation Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="process.php?action=violation-save" id="addContactModalTitle" method="post">
                  <div class="modal-body">
                    <div class="add-contact-box">
                      <div class="add-contact-content">
                        <input type="hidden" name="Id" id="c-id" class="form-control" placeholder="Name" />
                        <b>Name</b>
                        <input type="text" name="name" id="c-name" class="form-control" placeholder="Name" required/>
                        <b>Amount</b>
                        <input type="number" step=".01" name="amount" id="c-amount" class="form-control" placeholder="Amount" required/>
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
                    <th>#</th>
                      <th>Violation</th>
                    <th width="100">Total Violators</th>
                  </thead>
                  <tbody>
                    <!-- start row -->

                    <?php
                    $count = 0;
                    $totalViolations = 0;
                    foreach ($violation_list as $row):
                      $countViolation = penalty_item()->count("violationId=$row->Id and (dateAdded>='$from' and dateAdded<='$to')");
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
                                <h6 class="user-name mb-0" ><?=$row->name;?></h6>
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

Qualtrics.SurveyEngine.addOnload(function() {
    var table = document.querySelector('table');
    var rows = Array.from(table.querySelectorAll('tr'));

    rows.sort(function(a, b) {
        var scoreA = parseFloat(a.cells[2].textContent);
        var scoreB = parseFloat(b.cells[2].textContent);
        return scoreB - scoreA;
    });

    rows.forEach(function(row) {
        table.appendChild(row);
    });
});

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
