<?php

    /*
        
    */

    // add_subscriber_form -- Create an HTML form to add record.
    function add_album_form() {
        
        echo '
            <div class="card">
                <h3>Add Albums</h3>
            
                <form action="insert.php" method="post">
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
        
    }


    // subscriber_list_view -- Loop over all of the log to make a bullet list
    function album_list_view($list) {

        echo '
            <div class="card">
                <h3>Albums</h3> 
                <ul class="albums">';
        foreach ($list as $c) 
        {
           echo '
            <div class="card">
                <h3>'.$c['name'].'</h3> ';
           
           echo '<img src="'. $c['artwork'] . '" alt="'. $c['name'] .'" width="200" height="200">';
           echo '<div class="content">';
           echo 'Artist: '. $c['name'].'<br>';
           echo '<a href="' . $c['purchaseURL'] . '">Buy</a><br>';
           echo 'Description: <br>'. $c['description'].'<br>';
           echo 'Review: '. $c['review'].'';
           echo '</div>';

           echo '</div>';
        }
        echo '</ul>
        </div>';

    
    }

?>
