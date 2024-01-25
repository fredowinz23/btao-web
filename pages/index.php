<?php
  $ROOT_DIR="../";
  include $ROOT_DIR . "templates/header.php";

  $violation_list = violation()->list();
  $zone_list = zone()->list();

  $totalUnpaid = driver_penalty()->count("status='Pending'");
  $totalPaid = driver_penalty()->count("status='Paid'");

  $totalAdmin = account()->count("role='Admin'");
  $totalStaff = account()->count("role='Staff'");
  $totalOfficer = account()->count("role='Officer'");
  $totalDriver = driver()->count();
?>

<br>

<center>
<h2>BTAO: <br>  Bacolod Traffic Authority Office</h2>
</center>

<div class="row">
  <div class="col-4">
    <canvas id="settlementPie"></canvas>
  </div>
  <div class="col-8">
    <canvas id="violationGraph"></canvas>
  </div>
  <div class="col-4">
    <ul class="list-group mt-4">
      <li class="list-group-item">
        <div class="row">
          <div class="col">
            <b>Total Admin:</b>
          </div>
          <div class="col text-center">
            <?=$totalAdmin;?>
          </div>
        </div>
      </li>

        <li class="list-group-item">
          <div class="row">
            <div class="col">
              <b>Total Staff:</b>
            </div>
            <div class="col text-center">
              <?=$totalStaff;?>
            </div>
          </div>
        </li>

          <li class="list-group-item">
            <div class="row">
              <div class="col">
                <b>Total Officer:</b>
              </div>
              <div class="col text-center">
                <?=$totalOfficer;?>
              </div>
            </div>
          </li>

            <li class="list-group-item">
              <div class="row">
                <div class="col">
                  <b>Total Driver:</b>
                </div>
                <div class="col text-center">
                  <?=$totalDriver;?>
                </div>
              </div>
            </li>
    </ul>
  </div>
  <div class="col-8">
    <canvas id="zoneGraph"></canvas>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const settlementPie = document.getElementById('settlementPie');

new Chart(settlementPie, {
  type: 'pie',
  data: {
    labels: [
      'Paid',
      'Unpaid',
    ],
    datasets: [{
      label: 'Settlement',
      data: [
        <?=$totalPaid?>, <?=$totalUnpaid?>
      ],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
        yAxes: [{
            ticks: {
                display: false
            }
        }]
    }
  }
});


const zoneGraph = document.getElementById('zoneGraph');

new Chart(zoneGraph, {
  type: 'bar',
  data: {
    labels: [
        <?php foreach ($zone_list as $row): ?>
          '<?=$row->name;?>',
        <?php endforeach; ?>
    ],
    datasets: [{
      label: 'Zone',
      data: [
          <?php foreach ($zone_list as $row):
            $countZone = driver_penalty()->count("zoneId=$row->Id");
             ?>
             <?=$countZone?>,
          <?php endforeach; ?>
      ],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});


    var violationGraph = document.getElementById('violationGraph');
    var violationGraphX = new Chart(violationGraph, {
       type: 'bar',
       data: {
          labels:[
              <?php foreach ($violation_list as $row): ?>
                '<?=$row->name;?>',
              <?php endforeach; ?>
          ],
          datasets: [{
            label:'Violations',
             data: [
               <?php foreach ($violation_list as $row):
                   $countViolation = penalty_item()->count("violationId=$row->Id");
                 ?>
                 <?=$countViolation?>,
               <?php endforeach; ?>
             ],
             backgroundColor: ["#64B5F6", "#FFD54F", "#2196F3", "#FFC107", "#1976D2", "#FFA000", "#0D47A1"],
             hoverBackgroundColor: ["#B2EBF2", "#FFCCBC", "#4DD0E1", "#FF8A65", "#00BCD4", "#FF5722", "#0097A7"]
          }]
       },
       options: {
          legend: {
             display: true,
             position: "right"
          }
       }
    });

  violationGraph.onclick = function(e) {
     var slice = violationGraphX.getElementsAtEventForMode(e, 'nearest', {intersect: true}, true);
     if (!slice.length) return; // return if not clicked on slice
     var label = violationGraphX.data.labels[slice[0].index];
     switch (label) {
       <?php foreach ($violation_list as $row): ?>
          case '<?=$row->name;?>':
             window.location.href = 'violators-per-violation.php?Id=<?=$row->Id?>';
             break;
       <?php endforeach; ?>
     }
  }
</script>

<?php include $ROOT_DIR . "templates/footer.php"; ?>
