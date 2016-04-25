<?php

require '../Slim/Slim.php';

$app = new Slim();

$app->get('/getCategory', 'getCategories');
$app->get('/getCategory/:id',	'getCategory');
$app->post('/saveCategory', 'addCategory');
$app->put('/getCategory/:id', 'updateCategory');
$app->delete('/deleteCategory/:id',	'deleteCategory');

$app->run();

// get all list of category
function getCategories() {
	$sql = "select * FROM category ORDER BY id DESC";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$categories = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"data": ' . json_encode($categories) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

// filter category with id
function getCategory($id) {
	$sql = "SELECT * FROM category WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$category = $stmt->fetchObject();
		$db = null;
		echo '{"data": ' . json_encode($category) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

// save category
function addCategory() {
	$request = Slim::getInstance()->request();
	$category = json_decode($request->getBody());

	$sql = "
		INSERT INTO
			category (
				name,
				description
			)
			VALUES (
				:name,
				:description
			)
		";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("name", $category->name);
		$stmt->bindParam("description", $category->description);
		$stmt->execute();
		$category->id = $db->lastInsertId();
		$db = null;
		echo json_encode($category);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
// update category with id
function updateCategory($id) {
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	$category = json_decode($body);
	$sql = "UPDATE category SET name=:name, description=:description WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("name", $category->name);
		$stmt->bindParam("description", $category->description);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($category);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

/// delete category with id
function deleteCategory($id) {
	$sql = "DELETE FROM category WHERE id=:id";
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