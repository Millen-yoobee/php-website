<?php
	$this->layout("master", [
		"title" => "Post page",
		"desc" => "View an individual post"

		]);


?>

<h1> <?= $post["title"] ?> </h1>

<p> <?= $post["description"] ?> </p>

<img src="img/uploads/original/<?= $post["image"]  ?>" alt="">

<ul>
	<li>Post created: <?= $post{"created_at"} ?></li>
	<li>Post updated: <?= $post{"updated_at"} ?></li>
	<li>Posted by <?= $post["first_name"] . " " . $post["last_name"] ?> </li>
</ul>

<section>
	
	<h1>Comments: (<?= count($allComments) ?>)</h1>

	<form action="index.php?page=post&postid=<?= $_GET['postid'] ?>" method="post">
		<label for="comment">Write a comment:</label>
		<textarea name="comment" id="comment" cols="30" rows="10"></textarea>
		<input type="submit" name="new-comment" value="Submit">
	</form>

			<!--  to loop around an associative array of comments in POSTCONTROLLER.php -->
	
	<?php foreach($allComments as $comment): ?>
		
		<article>
			<p><?= htmlentities($comment["comment"]) ?> </p> 

			<small>Written by: <?= htmlentities($comment["author"])?></small>
			 <!-- use htmlentities on any data provided by users to filter malicious codes/scripts -->

			 <?php
			  // is the user logged in
			 if ( isset($_SESSION["id"]) ) {
			 	if ( $_SESSION["id"] == $comment["user_id"]) {
			 		echo "Delete";
			 		echo "Edit";
			 	}
			 }


			 ?>

		</article>

		

		<?php endforeach ?>	


</section>