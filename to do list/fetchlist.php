	<?php
	
	

	function getAlltasks()
	{
		$query ="SELECT * FROM tasks WHERE status ='Pending'";
		$tasks = get($query);
		return $tasks;	
	}

	function getdonetasks()
	{
		$query ="SELECT * FROM tasks WHERE status ='Done'";
		$done = get($query);
		return $done;	
	}


	

	function getexp(){
		$query ="SELECT * FROM exp";
		$exps = get($query);
		return $exps;	
	}
	
	?>