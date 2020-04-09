

<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die;
}






$title = "Inventory|Home";
include 'api/config/database.php';


$content = '
     <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
	<thead>
		<tr>
			<th>Username</th>
			<th>Full Name</th>
			<th>Points</th>
			<th>Notes</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>

	<tbody>
		
	</tbody>
</table>

';

include 'blank.php';
