<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>


<?php 
include('task.php');
$tasks=new TaskManager();
$task_list=$tasks->insert();
$task_error=$tasks->errors();

$task_edit=$tasks->edit();

$task_sort=$tasks->sort();

$task_del=$tasks->delete();

?>


<body>

  <div class="container">
    <div class="row">
      <h1 style="margin:auto; color: #7CFC00">TASK MANAGER</h1>

      <div class="col-md-8 offset-md-3">
       <br>


       <div class="col-md-6">
        <!-- part 1:  errors -->
        <?php  if (count($task_error) > 0) : ?>
          <h2>Errors:</h2>
          <ul>
            <?php   if($task_del>0){ ?>          
              <?php foreach($task_error as $error) : ?>
                <li><?php echo $error; ?></li>
              <?php endforeach; ?>
            <?php   }else{ ?>            
              <?php foreach($task_error as $error) : ?>
                <li><?php echo $error; ?></li>
              <?php endforeach; ?>

            <?php } ?>
          </ul>
        <?php   endif; ?>
      </div>


      <!-- Danh sách -->
      <div class="col-md-6">
        <h2>Tasks</h2>
        <?php if (count($task_list) == 0){  ?>
          <p>Không có task nào!</p>         
        <?php }else if(isset($_POST['btnsort'])){ ?>
          <ul>
            <?php foreach( $task_sort as $id => $task ) : ?>
              <li><?php echo $id + 1 . '. ' . $task; ?></li>
            <?php endforeach; ?>
          </ul>
        <?php }else if(isset($_POST['btndelete'])){ ?>
         <ul>
          <?php foreach( $task_del as $id => $task ) : ?>
            <li><?php echo $id + 1 . '. ' . $task; ?></li>
          <?php endforeach; ?>
        </ul>
      <?php }else{ ?>
       <?php foreach( $task_list as $id => $task ) : ?>
        <li><?php echo $id + 1 . '. ' . $task; ?></li>
      <?php endforeach; ?>
    <?php } ?>

    <br />
  </div>

  <!-- Thêm -->
  <div class="col-md-6">
   <h2>Add task</h2>
   <form action="" method="post">
    <div class="form-group">
      <?php foreach( $task_list as $task ) : ?>
        <input type="hidden" name="tasklist[]" value="<?php echo $task; ?>"/>
      <?php endforeach; ?>
      <label for="task">Task</label>
      <input type="text" class="form-control" id="task" name="task" placeholder="Enter task" >
    </div>      
    <button type="submit" name="btnsubmit" value="addtask" class="btn btn-primary">Submit</button>

  </form>
</div>


<br><hr>
<!-- chức năng -->
<div class="col-md-6">
  <form action="" method="post">
   <!-- show danh sách task -->
   <?php foreach( $task_list as $task ) : ?>
    <input type="hidden" name="tasklist[]" value="<?php echo $task; ?>"/>
  <?php endforeach; ?>

  <label>Chọn task</label>
  <select class="form-control" name="taskid">
   <!-- show danh sách task -->
   <?php if(isset($_POST['btndelete']))  { ?>
     <?php if($task_del){ ?>
       <?php foreach( $task_del as $key => $task ) : ?>
        <option  value="<?php echo $key; ?>">
          <?php echo $task; ?>
        </option>
      <?php endforeach; ?>
    <?php } ?>

  <?php }else if(isset($_POST['btnsort'])){ ?>
    <?php if($task_sort){ ?>
      <ul>
        <?php foreach( $task_sort as $key => $task ) : ?>
          <option value="<?php echo $key; ?>">
            <?php echo $task; ?>
          </option>
        <?php endforeach; ?>
      </ul>
    <?php } ?>

  <?php }else{ ?>
    <?php if($task_list){ ?>
     <?php foreach( $task_list as $key => $task ) : ?>
      <option value="<?php echo $key; ?>">
        <?php echo $task; ?>
      </option>
    <?php endforeach; ?>
  <?php } ?>
<?php } ?>
</select>

<br>
<button type="submit" class="btn btn-lg btn-warning" value="edit" name="btnedit">Sửa</button>
<button type="submit" class="btn btn-lg btn-success" value="sort" name="btnsort">Sắp xếp</button>
<button type="submit" class="btn btn-lg btn-danger" value="delete" name="btndelete">Xóa</button>
</form>
</div>

<br>
<!-- Hiển thị ra khi click vào edit -->
<div class="col-sm-6">
 <?php if (!empty($task_edit)) : ?>
  <h2>Sửa task</h2>
  <form action="." method="post" >

    <?php foreach( $task_edit as $task_index => $task ) : ?>
      <input type="hidden" name="tasklist[] " value="<?php echo $task?>"/>
    <?php endforeach; ?>

    <label>Task:</label>
    <input class="form-control" type="text" name="edit_task_id" value="<?php echo $task_index; ?>" />
    <input  class="form-control" type="text" name="modified_task" value="<?php echo $task; ?>" /><br />
    <label>&nbsp;</label>
    <button type="submit" class="btn btn-lg btn-success" name="btnedit" value="save"> save</button>
    <button type="reset"  class="btn btn-lg btn-danger" name="btnedit" value="reset"/>reset</button>
  </form>
<?php endif; ?>
</div>



</div>


</div>



</div>

</body>
</html>
