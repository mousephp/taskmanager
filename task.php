<?php 

class TaskManager{
	
	public function errors(){
		$errors = array();
		if (isset($_POST['btnsubmit'])){
			if (isset($_POST['task'])){
				$new_task = $_POST['task'];
				if (empty($new_task)) {
					$errors[] = "<span style='color:red;'> task name khong duoc de trong. </span>";
				}
			}			
		}
		if (isset($_POST['btnedit'])){
			if (isset($_POST['modified_task'])){
				$new_task = $_POST['modified_task'];
				if (empty($new_task)) {
					$errors[] = "<span style='color:red;'> task name khong duoc de trong. </span>";
				}
			}		
		}
		return $errors;
	}

	public function taskList(){
		if(isset($_POST['tasklist'])){ //(4)
			$task_list = $_POST['tasklist'];
			print_r($task_list);
		}else{
			$task_list = array();
    		//gt duoc gan mac dinh
			$task_list[] = 'html';
			$task_list[] = 'css';
			$task_list[] = 'javascript';
			print_r($task_list);
		}

		return $task_list;
	}

	public function insert(){
		$task_list=self::taskList();
		if (isset($_POST['btnsubmit'])) { //(1)
			switch( $_POST['btnsubmit'] ) { //(2)
				case 'addtask': //(3)
				$new_task = $_POST['task'];

				//bat loi cach 2
				$error=self::errors();
				if ($error) {
					self::errors();
				}else {
					array_push($task_list, $new_task);
				}
				break;

				case 'sort':
				sort($task_list);
				break;
			}
		}
		return $task_list;
	}

	public function sort(){	
		if (isset($_POST['btnsort'])) {
			$task_list=self::taskList();
			switch($_POST['btnsort'] ) { 				
				case 'sort':
				sort($task_list);
				print_r($task_list);
				break;
			}
			return $task_list;
		}
	}

	public function edit(){	
		if (isset($_POST['btnedit'])) { 
			$task_list=self::taskList();
			switch($_POST['btnedit'] ) { 
				case 'edit':
				$task_index = $_POST['taskid'];
				$edit_task = $task_list[$task_index];
				//print_r($edit_task);
				break;

				case 'save':
				$i = $_POST['edit_task_id'];
				$modified_task = $_POST['modified_task'];
				print_r($modified_task);
				if (empty($modified_task)) {
					self::errors();
				} else {
					$task_list[$i] = $modified_task;
					$modified_task = '';
				}
				break;

			}
			return $task_list;
		}	
	}

	public function delete(){	
		if (isset($_POST['btndelete'])) {
			$task_list=self::taskList();
			switch($_POST['btndelete'] ) { 
				case 'delete':
				$task_index = $_POST['taskid'];
				print_r($task_index);
				unset($task_list[$task_index]);
				$task_list = array_values($task_list);
				print_r($task_list);
				break;
			}
			return $task_list;
		}	
	}




}



?>