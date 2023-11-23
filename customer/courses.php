<?php
$ROOT_DIR="../";
include $ROOT_DIR . "user-templates/header.php";

$catId = get_query_string('catId', '');

if ($catId=="") {
  $course_list = course()->list();
}
else{
  $course_list = course()->list("categoryId=$catId");
}
?>

<style media="screen">
  .cursor-option{
    cursor:pointer;
  }
  .cursor-option:hover{
    background: #ededed;
  }
</style>

<div class="row">

<?php foreach ($course_list as $row): ?>
  <div class="col-6">
    <div class="card cursor-option" onclick="location.href='course-detail.php?Id=<?=$row->Id;?>'">
      <div class="card-body">
        <h4><?=$row->name;?></h4>
        <i><?=$row->description;?></i>
      </div>
    </div>
  </div>
<?php endforeach; ?>

</div>

<?php include $ROOT_DIR . "user-templates/footer.php"; ?>
