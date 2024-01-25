<?php

include "../templates/header.php";

$pdId = $_GET["pdId"];
$dp = driver_penalty()->get("Id=$pdId");
$officer = account()->get("Id=$dp->officerId");
if ($dp->type=="Driver") {
  $driver = driver()->get("Id=$dp->referenceId");
}
if ($dp->type=="Vehicle") {
  $vehicle = vehicle()->get("Id=$dp->referenceId");
}
$zone = zone()->get("Id=$dp->zoneId");

$penalty_item_list = penalty_item()->list("driverPenaltyId=$pdId");
 ?>


<div class="card" style="min-height:100px">
  <div class="card-body">

    <div class="row">
      <div class="col">
        <ul class="list-group">
          <li class="list-group-item">
            <b>Violation Detail</b>
          </li>
          <li class="list-group-item">
            <div class="row">
              <div class="col">
                <b>Date</b>
              </div>
                <div class="col-4 text-right">
                  <?=format_date($dp->dateAdded);?>
                </div>
            </div>
          </li>
            <li class="list-group-item">
              <div class="row">
                <div class="col">
                  <b>Officer</b>
                </div>
                  <div class="col-4 text-right">
                    <?=$officer->officerBadge;?>: <?=$officer->firstName;?> <?=$officer->lastName;?>
                  </div>
              </div>
            </li>
            <?php if ($dp->type=="Driver"): ?>
              <li class="list-group-item">
                <div class="row">
                  <div class="col">
                    <b>Driver</b>
                  </div>
                    <div class="col-4 text-right">
                      <?=$driver->firstName;?> <?=$driver->middleInitial;?>. <?=$driver->lastName;?>
                    </div>
                </div>
              </li>
            <?php endif; ?>

            <?php if ($dp->type=="Vehicle"): ?>
              <li class="list-group-item">
                <div class="row">
                  <div class="col">
                    <b>Vehicle</b>
                  </div>
                    <div class="col-4 text-right">
                      <?=$vehicle->plateNumber;?>
                    </div>
                </div>
              </li>
            <?php endif; ?>
                <li class="list-group-item">
                  <div class="row">
                    <div class="col">
                      <b>Zone</b>
                    </div>
                      <div class="col-4 text-right">
                        <?=$zone->name;?>
                      </div>
                  </div>
                </li>
        </ul>
      </div>
      <div class="col">
        <ul class="list-group">
          <li class="list-group-item">
            <b>Violations:</b>
          </li>
          <?php
          $totalAmount = 0;
           foreach ($penalty_item_list as $row):
            $violation = violation()->get("Id=$row->violationId");
            $totalAmount += $violation->amount;
             ?>
               <li class="list-group-item">
                 <div class="row">
                   <div class="col">
                     <?=$violation->name?>
                   </div>
                     <div class="col-4 text-right">
                       Php <?=format_money($violation->amount)?>
                     </div>
                 </div>
               </li>
          <?php endforeach; ?>
            <li class="list-group-item">
              <div class="row">
                <div class="col">
                  <b>Total</b>
                </div>
                  <div class="col-4 text-right">
                    <b>Php <?=format_money($totalAmount)?></b>
                  </div>
              </div>
            </li>
        </ul>
      </div>
    </div>
    <br><br>

    <?php if ($dp->type=="Driver"): ?>
        <a href="drivers.php" class="btn btn-warning">Back</a>
    <?php endif; ?>

    <?php if ($dp->type=="Vehicle"): ?>
        <a href="vehicles.php" class="btn btn-warning">Back</a>
    <?php endif; ?>
    <?php if ($dp->status=="Pending"): ?>
      <a href="process.php?action=change-violation-status&status=Paid&pdId=<?=$pdId;?>" class="btn btn-primary">Mark as Paid</a>
    <?php endif; ?>

    <?php if ($dp->status=="Paid"): ?>
      <a href="process.php?action=change-violation-status&status=Pending&pdId=<?=$pdId;?>" class="btn btn-warning">Undo</a>
    <?php endif; ?>

  </div>
</div>



 <?php

 include "../templates/footer.php";

  ?>
