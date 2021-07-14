<?php require_once __SITE_PATH . '/view/_header1.php'; ?>
<form action="index.php?rt=user/unlogged", method="post">
<label for="row">Izaberite prostoriju za koju zelite pogledati raspored</label>
<select name="row">
<?php 
foreach($arr as $row)
   {  ?>
    
     <option value="<?php echo $row->id_lecture_hall; ?>"> <?php echo $row->title; ?> </option>

<?php
   } ?>
</select>
<button type="submit" name="gumb" value="showSchedule">Pogledaj raspored</button>
</form>
<?php
 require_once __SITE_PATH . '/view/_footer.php'; ?>