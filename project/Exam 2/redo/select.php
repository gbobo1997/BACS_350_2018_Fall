<?php
    // Connect to the database
    require_once 'db.php';
    // Query for all table contents
    $query = "SELECT * FROM Albums";
    $statement = $db->prepare($query);
    $statement->execute();
    echo '<h2>Contacts in Table</h2>';
    // Loop over table entry to output as list
    $list = $statement->fetchAll();
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
?>