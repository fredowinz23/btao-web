<?php
$ROOT_DIR="../";
$pageName = "Product Detail";
include $ROOT_DIR . "user-templates/header.php";

$Id = $_GET["Id"];

$course = course()->get("Id=$Id");
$course_item_list = course_item()->list("courseId=$Id");

$studentId = $_SESSION["user_session"]["Id"];
$checkJoined = course_student()->count("courseId=$Id and studentId=$studentId");
?>

<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col text-center">
        <h3><?=$course->name?></h3>
        <i><?=$course->description;?></i>
        <br><br>

        <?php if ($checkJoined>0): ?>
          <a href="" class="btn btn-secondary">Already Joined</a>
          <?php else: ?>
            <a href="process.php?action=join-course&courseId=<?=$course->Id?>&studentId=<?=$studentId?>" class="btn btn-warning">Join Course</a>
        <?php endif; ?>

      </div>
      <div class="col">
        <b>Products:</b>
        <?php foreach ($course_item_list as $row):
          $item = item()->get("Id=$row->itemId");
           ?>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <img src="../media/<?=$item->image?>" alt="" width="100px">
                </div>
                <div class="col">
                  <h4><?=$item->name;?></h4>
                  <i><?=$item->description;?></i>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>




<?php include $ROOT_DIR . "user-templates/footer.php"; ?>
