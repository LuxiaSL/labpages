<?php
include_once('includehead.php');

$username = $_REQUEST['username'];
$type = $_REQUEST['type'];

if($type=="named"){
	$sqlQry = "SELECT *, DATE(datetime) AS Date, TIME(datetime) AS Time FROM logins WHERE username LIKE '{$username}' ORDER BY id DESC";
}else if($type=="numbered"){
	$sqlQry = "SELECT DATE(datetime) AS Date, TIME(datetime) AS Time, ipaddr, success FROM logins WHERE username LIKE '{$username}' ORDER BY id DESC";
}

echo $sqlQry;

$out = mysqli_query(db_connect(false), $sqlQry);

$outDoc = <<<HTML
<table class="table table-sm table-striped table-dark">
	<caption>Results for: {$username}</caption>
	<thead>
		<tr>
			<th scope="col">Date</th>
			<th scope="col">Time</th>
			<th scope="col">IP Address</th>
			<th scope="col">Success</th>
		</tr>
	</thead>
	<tbody>
HTML;

if($type == "named"){

	while($row = mysqli_fetch_assoc($out)){
		$success = $row['success'] == 1 ? "Succeeded" : "Failed";

		$outDoc .= <<<HTML
		<tr>
			<td>{$row['Date']}</td>
			<td>{$row['Time']}</td>
			<td>{$row['ipaddr']}</td>
			<td>{$success}</td>
		</tr>
HTML;

	}

}else if($type == "numbered"){

	while($row = mysqli_fetch_array($out)){
		$success = $row[3] == 1 ? "Succeeded" : "Failed";

		$outDoc .= <<<HTML
		<tr>
			<td>{$row[0]}</td>
			<td>{$row[1]}</td>
			<td>{$row[2]}</td>
			<td>{$success}</td>
		</tr>
HTML;

	}

}

$outDoc .= <<<HTML
	</tbody>
</table>
HTML;

echo $outDoc;