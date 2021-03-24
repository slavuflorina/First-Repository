<?php
if (empty($_POST['name']) || empty($_POST['password']) ) {
$validare=0;
}
	if($validare==1)
    {
		$name=mysqli_real_escape_string($id_conexiune,$_POST['name']); 
		$password=mysqli_real_escape_string($id_conexiune,md5($_POST['password']));

		$sql="SELECT * FROM users WHERE user_username='$name' AND user_password='$password'";
		$result=mysqli_query($id_conexiune,$sql);
		if($row = mysqli_fetch_assoc($result)) { 
			$user_id=$row['user_id'];
			$_SESSION['id']=$user_id;
			header("Location:index.php");
		} 
		else $mesaj="Combinatie gresita"; 
	}
?>

  <form method="post" action="index.php">
	<div class="form-group">
       <label for="exampleInputName">Nume:</label>
       <input type="name" name="name" class="form-control" id="exampleInputName" placeholder="Introduceti nume">
	</div>	   
	
	<div class="form-group">
       <label for="exampleInputPassword">Parola:</label>
       <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Introduceti parola"> 
	</div>  
		 <span class="mesaj"><?php echo $mesaj;?></span> 
       <button type="submit" name="login_btn" class="btn btn-primary btn-block">Trimite</button>
    </form>