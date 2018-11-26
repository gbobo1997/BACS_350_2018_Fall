<?php 
	require_once 'db.php';

	function listPresentations($db)
	{
		if ( isset( $_SESSION['user_id'] ) ) 
		{
			renderPresentations($db);
		} 
		else 
		{
			echo 'Please log In if you wish to edit/create presentations.';
			renderPresentations($db);
		}
	}

	function renderPresentations($db)
	{
		$allSlides = getPresentations($db);
		if ( isset( $_SESSION['user_id'] ) ) 
		{
			echo '
			<div class=""reviews">
			Your Presentations:<br>
				<ul class="ownReviews">';
				foreach($allSlides as $c)
				{
					if($c['username']==$_SESSION['user_id'])
					{
						$slides = $c['source'];
						$source = 'slides/'.$slides;
						echo 
			            '
			                Author: '.$c['username'].'
			                <form action="edit.php" method="post">
			                Source:<br>
			                <textarea name="newContent" rows="30" cols="50">';
			                include $source;
			                echo '</textarea><br>
			                Date Made: '.$c['dateMade'].'<br>
			                <br>		                
			                <input type="hidden" name="ID" value="'.$c['id'].'">
			                <input type="hidden" name="choice" value="0">
			                <input type="submit" value="Save Edit">
			                <input type="submit" formaction="delete.php" value="Delete">
			                <input type="submit" formaction="renderslide.php" value="View">
			                <input type="hidden" name="source" value="'.$slides.'">
			                </form>
			            ';
		        	}
				}
			echo '
            </ul>
            <hr width="80%" color="#5e68c4" noshade>
            <form action="edit.php" method="post">
                New Presentation:<br>  
                <input type="text" name="name" value="Presentation Name, no spaces"><br>
                <textarea rows="4" cols="50" name="newContent">Markdown Here</textarea><br>
		                
		                <input type="hidden" name="ID" value="">
		                <input type="hidden" name="choice" value="1">
                <input type="submit" value="Create Presentation">
                </form>
                <hr width="80%" color="#5e68c4" noshade>
        </div>';
			echo '<h1> Presentations </h1>';
			foreach($allSlides as $c)
			{
				if($c['username']!==$_SESSION['user_id'])
					{
						$slides = $c['source'];
						$source = 'slides/'.$slides;
						echo 
			            '
			                Author: '.$c['username'].'
			                <form action="edit.php" method="post">
			                Source:<br>
			                <textarea name="newContent" rows="30" cols="50">';
			                include $source;
			                echo '</textarea><br>
			                Date Made: '.$c['dateMade'].'<br>
			                <br>		                
			                <input type="hidden" name="ID" value="'.$c['id'].'">
			                <input type="hidden" name="choice" value="0">
			                <input type="submit" value="Save Edit" disabled>
			                <input type="submit" formaction="delete.php" value="Delete" disabled>
			                <input type="submit" formaction="renderslide.php" value="View">
			                <input type="hidden" name="source" value="'.$slides.'">
			                </form>
			            ';
		        	}
			}
		}
		// not logged in views
		else
		{
			echo '<h1> Presentations </h1>';
			foreach($allSlides as $c)
			{
						$slides = $c['source'];
						$source = 'slides/'.$slides;
						echo 
			            '
			                Author: '.$c['username'].'
			                <form action="edit.php" method="post">
			                Source:<br>
			                <textarea name="newContent" rows="30" cols="50">';
			                include $source;
			                echo '</textarea><br>
			                Date Made: '.$c['dateMade'].'<br>
			                <br>		                
			                <input type="hidden" name="ID" value="'.$c['id'].'">
			                <input type="hidden" name="choice" value="0">
			                <input type="submit" value="Save Edit" disabled>
			                <input type="submit" formaction="delete.php" value="Delete" disabled>
			                <input type="submit" formaction="renderslide.php" value="View">
			                <input type="hidden" name="source" value="'.$slides.'">
			                </form>
			            ';
		        	
			}
		}
	}

?>