<?php

include "../templates/header.php";

$pdId = $_GET["pdId"];
$dp = driver_penalty()->get("Id=$pdId");
$officer = account()->get("Id=$dp->officerId");

$penalty_item_list = penalty_item()->list("driverPenaltyId=$pdId");
 ?>


<div class="card" style="min-height:100px">
  <div class="card-body">
    <center>
      Date: <?=$dp->dateAdded;?> <br>
      Officer: <?=$officer->firstName;?> <?=$officer->lastName;?> <br><br>

      <b>Violations:</b> <br>

      <?php
      $totalAmount = 0;
       foreach ($penalty_item_list as $row):
        $violation = violation()->get("Id=$row->violationId");
        $totalAmount += $violation->amount;
         ?>
        <?=$violation->name?> (Php <?=format_money($violation->amount)?>)<br>
      <?php endforeach; ?>

      <br>
      <b>Total Penalty:</b>
      <br>
      Php <?=format_money($totalAmount)?>

      <br><br>

      <?php if ($dp->status=="Pending"): ?>

        <a href="process.php?action=change-violation-status&status=Paid&pdId=<?=$pdId;?>" class="btn btn-primary">Mark as Paid</a>
      <?php endif; ?>


      <?php if ($dp->status=="Paid"): ?>

        <a href="process.php?action=change-violation-status&status=Pending&pdId=<?=$pdId;?>" class="btn btn-warning">Undo</a>
      <?php endif; ?>


    </center>
  </div>
</div>



 <?php

 include "../templates/footer.php";

  ?>
