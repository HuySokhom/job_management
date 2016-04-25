<?php

require '../Slim/Slim.php';

$app = new Slim();

$app->get('/getJob', 'getJobs');
$app->post('/getAbc', 'getAbc');
$app->get('/getJob/:id',	'getJob');
$app->post('/saveJob', 'addJob');
$app->put('/getJob/:id', 'updateJob');
$app->delete('/deleteJob/:id',	'deleteJob');

$app->run();

function getAbc(){
	$sql = "select j.id, j.name, j.description, j.post_date, j.closing_date, c.id as category_id, c.name as category_name
		FROM job j LEFT JOIN category c on c.id = j.id_category  ORDER BY id DESC";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);
		$products = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"data": ' . json_encode($products) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getJobs() {
	$sql = "select j.id, j.name, j.description, j.post_date, j.closing_date, c.id as category_id, c.name as category_name
		FROM job j LEFT JOIN category c on c.id = j.id_category  ORDER BY id DESC";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$products = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"data": ' . json_encode($products) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
// function filter by job id
function getJob($id) {
	$sql = "select j.id, j.name, j.description, j.post_date, j.closing_date, c.id as category_id, c.name as category_name
		FROM job j LEFT JOIN category c on c.id = j.id_category WHERE j.id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$wine = $stmt->fetchObject();
		$db = null;
		echo json_encode($wine);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

// functionality for insert

function addJob() {
	$request = Slim::getInstance()->request();
	$job = json_decode($request->getBody());
	$sql = "
		INSERT INTO job (name, id_category, description, post_date, closing_date) VALUES (:name, :id_category, :description, :post_date, :closing_date)
	";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("name", $job->name);
		$stmt->bindParam("id_category", $job->id_category);
		$stmt->bindParam("description", $job->description);
		$stmt->bindParam("post_date", $job->post_date);
		$stmt->bindParam("closing_date", $job->closing_date);
		$stmt->execute();
		$job->id = $db->lastInsertId();
		$db = null;
		echo json_encode($job);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function updateJob($id) {
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	$job = json_decode($body);
	$sql = "
		UPDATE
			job
		SET
			name=:name, id_category=:id_category, post_date=:post_date, closing_date=:closing_date, description=:description
		WHERE
			id=:id
	";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("name", $job->name);
		$stmt->bindParam("id_category", $job->id_category);
		$stmt->bindParam("post_date", $job->post_date);
		$stmt->bindParam("closing_date", $job->closing_date);
		$stmt->bindParam("description", $job->description);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($job);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function deleteJob($id) {
	$sql = "DELETE FROM job WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}


function getConnection() {
	$dbhost="127.0.0.1";
	$dbuser="root";
	$dbpass="";
	$dbname="job";
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

?>