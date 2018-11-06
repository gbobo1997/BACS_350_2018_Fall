<?php require_once 'note_functions.php';
require_once 'db.php';
require_once 'views.php';
$site_title = 'BACS 350 Assignments';
$page_title = 'Notes Application';
begin_page($site_title, $page_title);
// enter extra content here
// CRUD insert
echo '<form action="insert.php" method="post">
        <label>Note Title</label>
        <input type="text" name="my_title"><br>
        <textarea name="my_content" rows="10" cols="30">
		Insert Note Content Here
		</textarea><br>
        <input type="submit" value="Enter"/>
    </form>';
// CRUD select/list
$db = remote_connect();
render_list(query_notes($db));


end_page();
?>