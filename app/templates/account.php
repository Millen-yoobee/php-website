  <?php  
  		$this -> layout ("master", [

  	    "title" => "Your name",
        "desc" => "Change your password, review comments, add new content on your very own account page"
        ])

  ?>

  <body>

  <h1>Update your contact details</h1>
  <form action="index.php?page=account" method="post">
  	<label for"">First Name: </label>
  	<input type="text" name="first-name" value="<?= 
  		isset($_POST["update-contact"]) ? $_POST["first-name"] : "" 
  		?> ">
 
	<?= isset($firstNameMessage) ? $firstNameMessage : "" ?>
 
   	<label for"">Last Name: </label>
  	<input type="text" name="last-name"value="<?= 
  		isset($_POST["update-contact"]) ? $_POST["last-name"] : "" 
  		?> ">

	<?= isset($lastNameMessage) ? $lastNameMessage : "" ?>
 
  	<input type="submit" class=button name="update-contact" value="Update your name">

  </form>