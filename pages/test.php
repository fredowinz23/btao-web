<?php
include "../templates/header.php";
$contact_list=contact()->list();


 ?>

 <form class="" action="test-process.php?action=save-contact" method="post">
   firstName:
   <input type="text" name="firstName" value="" required>
   <br>
   <br>
     lastName:
   <input type="text" name="lastName" value="" required>
    <br><br>
       Age:
      <input type="text" name="age" value="" required>

    <button type="submit" name="button">Submit</button>
 </form>


  <br>
   <br>
    <br>
     <br>

<?php foreach ($contact_list as $row): ?>
  <?=$row->firstName;?> <?=$row->lastName;?> <?=$row->age;?>
<br>

<?php endforeach; ?>




 <?php
 include "../templates/footer.php";



  ?>
