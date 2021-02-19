
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>to do list</title>
	 <link rel="stylesheet" type="text/css" href="stylelist.css"> 
	  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>

<?php

	require "dbconn.php";
	require "fetchlist.php";
	
	if(isset($_POST['submit'])){

		$t = $_POST["tname"];

		$que = "INSERT INTO tasks (taskname, status) VALUES ('$t', 'Pending')";

		if(!empty($t)){
			execute($que);
		}	
	}

?>
<body>

	<form method="POST" action="">

		<div align="center">

			<input type="text" id="Mainbox" placeholder="Enter task" name="tname"><br><br>
			<input type="submit" style="visibility:hidden" id="myBtn" name="submit" value="Submit">

		</div>

		<br><br>


	

	<div class="Maindiv">
		<?php
	
		$tasks = getalltasks();
		
		
		foreach($tasks as $t){

			echo "<div class='item-box'>";

			echo "<input id='box'  type='checkbox' name='chk[]' value='$t[taskname]' >"."<label><input type='text' class='boxclass' id='tbox' name='$t[taskname]' value='$t[taskname]'></label>";
			echo "<br>";

			echo "<input type='submit' name='$t[id]' class='$t[id]' value='Edit' style='position:relative;top:-10px; left:260px'>
				
			</style>";
			
			echo "</div>";
			
			echo "<br>";

			if(isset($_POST[$t["id"]])){

				$txt=$_POST[$t['taskname']];

				echo $txt;



				$query="UPDATE tasks SET taskname='$txt' WHERE id=$t[id]";
				execute($query);
				header('Refresh: 0.0; url=index.php');


			}

			}

		?>
</div>

<?php

		if(isset($_POST['done'])){
				
			$j = (isset($_POST['chk'])) ? $_POST['chk'] : null;

			if(!empty($j)){
				
				foreach($j as $o){
				$qr= "UPDATE tasks SET status='Done' WHERE taskname='$o'";
				execute($qr);
				header('Refresh: 0.0; url=index.php');
			}
		}
			else{
				header('Refresh: 0.0; url=index.php');
			}
		
			}
		
		?>
	<div  align="center">
		<input type="submit" name="done" value="Active" align="center">
		<input type="submit" id="cm" name="Complete" value="Completed" align="center">

	</div>

	<?php

		if(isset($_POST['Complete'])){


		echo "<div class='Com'>";
			
			$donetasks = getdonetasks();

			

			foreach($donetasks as $d){

			echo "<div class='it'>";
			echo "<label class='donelist'>$d[taskname]</label>";
			echo "<br>";
			echo "</div>";
			echo "<br>";

			}

			echo "</div>";

			echo "<script>
					var g = $('.Com').html();
					$('.Maindiv').html(g);
					$('.Com').hide();
				</script>";	

			echo "<br><input class='clrComplete' type='submit' name='clear' value='Clear Completed'>";	

		}

		if(isset($_POST['clear'])){
			$qr= "DELETE FROM tasks WHERE status='Done'";
					
			 execute($qr);

			 header('Refresh: 0.0; url=index.php');
		}

	?>	
	
	</form>
	
</body>


</html>