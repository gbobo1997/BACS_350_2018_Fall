<?php
    // Start the page
    require_once 'views.php';
 
    $site_title = 'BACS 350 - Before';
    $page_title = 'Objects for Data';
    begin_page($site_title, $page_title);


    // Page Content
    echo '<p><a href="index.php">Solutions</a></p>';
    
    
    // Bring in albums logic
    require_once 'album.php';
    

    // Render a list of albums
    $albums->show_albums();


    // Show the add form
    echo '
    <div class="card">
    <h3>Add Albums</h3>

    <form action="index.php" method="post">
        <p><label>Album:</label> &nbsp; <input type="text" name="album"></p>
        <p><label>Artist:</label> &nbsp; <input type="text" name="artist"></p>
        <p><label>Artwork Link:</label> &nbsp; <input type="text" name="artworkLink"></p>
        <p><label>Purchase Link:</label> &nbsp; <input type="text" name="purchaseLink"></p>
        <p><label>Description:</label> &nbsp; <input type="text" name="description"></p>
        <p><label>Review:</label> &nbsp; <input type="text" name="review"></p>
        <p><input type="submit" value="Record"/></p>
        <input type="hidden" name="action" value="add">
    </form>
</div>
    ';


    end_page();
?>
