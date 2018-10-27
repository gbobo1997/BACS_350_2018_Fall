<?php 

	function display_albums($list)
	{
		 echo '
            <div class="card">
                <h3>Notes in List of SQL elements</h3> 
                <ul>
            ';
        foreach ($list as $s) {
            echo '<li>' . $s['artist'] . ', ' . $s['name'] . ', ' . $s['artwork'] . $s['purchaseURL'].', '.$s['description'].', '.$s['review'].'</li>';
        }
        echo '
                </ul>
            </div>';
	}

?>