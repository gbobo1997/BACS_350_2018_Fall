<?php require_once 'views.php';
require_once 'db.php';
$site_title = 'BACS 350 Assignments';
$page_title = 'MVC Pattern - Project 16';
begin_page($site_title, $page_title);
// enter extra content here
// CRUD insert
echo '<form action="insert.php" method="post">
        <label>What is your name?</label>
        <input type="text" name="my_name"><br>
        <label>What is your email?</label>
        <input type="text" name="my_email"><br>
        <input type="submit" value="Save"/>
    </form>';
// CRUD select/list
$db = remote_connect();
render_list(query_subscribers($db));


end_page();
?>