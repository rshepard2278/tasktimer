<?php
require_once("db.php");
$dbconnection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if(!empty($_POST["keyword"])) {
	$sql ="SELECT DISTINCT project FROM tasks WHERE project like '" . $_POST["keyword"] . "%' ORDER BY project LIMIT 0,6";
	$result = mysqli_query($dbconnection, $sql);
	if(!empty($result)) { ?>
		<datalist id="project-list">
		<?php
		foreach($result as $Row) { ?>
			<option value="<?php echo $Row['project']; ?>">
			<?php 
		} ?>
		</datalist>
<?php } 
} ?>