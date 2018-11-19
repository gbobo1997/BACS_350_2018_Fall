<?php 
	require_once 'db.php';

	function listReviews($db)
	{
		if ( isset( $_SESSION['user_id'] ) ) 
		{
			renderReviews($db);
		} 
		else 
		{
			echo 'Please log In if you wish to edit/create reviews.';
			renderReviews($db);
		}
	}

	function renderReviews($db)
	{
		$allReviews = getUserReviews($db);
		if ( isset( $_SESSION['user_id'] ) ) 
		{
			echo '
			<div class="reviews">
				Your Reviews:<br>
				<ul class="ownReviews">
			';	
			foreach($allReviews as $c)
			{
				if($c['userID']==$_SESSION['user_id'])
				{
					echo 
		            '
		                <form action="edit.php" method="post">
		                Review:<br>
		                <textarea rows="4" cols="50" name="newContent">'.$c['content'].'</textarea><br>
		                Designer<br>
		                <input type="text" name="designer" value="'.$c['designer'].'"><br>
		                Reviewer<br>
		                <input type="text" name="reviewer" value="'.$c['reviewer'].'"><br>
		                URL<br>
		                <input type="text" name="url" value="'.$c['url'].'"><br>
		                Score<br>
		                <input type="text" name="score" value="'.$c['score'].'"><br>
		                <input type="text" name="date" value="'.$c['date'].'" disabled><br>
		                <input type="hidden" name="ID" value="'.$c['id'].'">
		                <input type="hidden" name="choice" value="0">
		                <input type="submit" value="Save Edit">
		                <input type="submit" formaction="delete.php" value="Delete">
		                </form>
		            ';
				}
			}
			echo '
            </ul>
            <hr width="80%" color="#5e68c4" noshade>
            <form action="edit.php" method="post">
                New Review:<br>
                <textarea rows="4" cols="50" name="newContent">Review here</textarea><br>
		                Designer<br>
		                <input type="text" name="designer"><br>
		                Reviewer<br>
		                <input type="text" name="reviewer"><br>
		                URL<br>
		                <input type="text" name="url"><br>
		                Score<br>
		                <input type="text" name="score"><br>
		                <input type="hidden" name="ID" value="">
		                <input type="hidden" name="choice" value="1">
                <input type="submit" value="Create Review">
                </form>
                <hr width="80%" color="#5e68c4" noshade>
        </div>';
        echo '<h1> Reviews </h1>';
        foreach($allReviews as $c)
			{
				if($c['userID']!==$_SESSION['user_id'])
				{
					echo 
		            '	                	

		                <form action="" method="post">
		                Review:<br>
		                <textarea rows="4" cols="50" name="newContent" disabled>'.$c['content'].'</textarea><br>
		                Designer<br>
		                <input type="text" name="designer" value="'.$c['designer'].'" disabled><br>
		                Reviewer<br>
		                <input type="text" name="reviewer" value="'.$c['reviewer'].'" disabled><br>
		                URL<br>
		                <input type="text" name="url" value="'.$c['url'].'" disabled><br>
		                Score<br>
		                <input type="text" name="score" value="'.$c['score'].'" disabled><br>
		                <input type="text" name="date" value="'.$c['date'].'" disabled><br>
		                <input type="hidden" name="ID" value="'.$c['id'].'">
		                <input type="hidden" name="choice" value="0">
		                </form>
		            ';
				}
			}

		} 
		// not logged in, just display
		else 
		{
			echo '<h1> Reviews </h1>';
			 foreach($allReviews as $c)
			{
					echo 
		            '	                	

		                <form action="" method="post">
		                Review:<br>
		                <textarea rows="4" cols="50" name="newContent" disabled>'.$c['content'].'</textarea><br>
		                Designer<br>
		                <input type="text" name="designer" value="'.$c['designer'].'" disabled><br>
		                Reviewer<br>
		                <input type="text" name="reviewer" value="'.$c['reviewer'].'" disabled><br>
		                URL<br>
		                <input type="text" name="url" value="'.$c['url'].'" disabled><br>
		                Score<br>
		                <input type="text" name="score" value="'.$c['score'].'" disabled><br>
		                <input type="text" name="date" value="'.$c['date'].'" disabled><br>
		                <input type="hidden" name="ID" value="'.$c['id'].'">
		                <input type="hidden" name="choice" value="0">
		                </form>
		            ';
			}
		}
	}


?>