<?php
$db_file_name = realpath(PATH_DATA . '/db.sqlite3');

if (dict('CONFIG_DEV_MODE') !== true) {
	die('Not allowed');
}

echo 'DB: ' . $db_file_name . "<br>" . PHP_EOL;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (file_exists($db_file_name)) {
	unlink($db_file_name); // Delete DB
}

$db = new PDO('sqlite:' . $db_file_name);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = "
CREATE TABLE IF NOT EXISTS entry (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	user_id INTEGER NOT NULL,
	title TEXT NOT NULL,
	url TEXT,
	ranking REAL DEFAULT 0.0 NOT NULL,
	timestamp INTEGER NOT NULL,
	category INTEGER NOT NULL
);";
$db->exec($query);

$query = "CREATE INDEX idx_entry_user_id ON entry (user_id);";
$db->exec($query);

$query = "CREATE INDEX idx_entry_timestamp ON entry (timestamp);";
$db->exec($query);

$query = "
CREATE TABLE IF NOT EXISTS vote (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	entry_id INTEGER NOT NULL,
	user_id INTEGER NOT NULL
);";
$db->exec($query);

$query = "CREATE INDEX idx_vote_user_id ON vote (user_id);";
$db->exec($query);

$query = "
CREATE TABLE IF NOT EXISTS user (
	email TEXT PRIMARY KEY,
	display_email TEXT,
	nick TEXT NOT NULL UNIQUE,
	last_login_timestamp INTEGER NOT NULL DEFAULT 0,
	last_login_attempt_timestamp INTEGER NOT NULL,
	current_token TEXT NOT NULL
);";
$db->exec($query);

/*
if ($config['environment'] === 'dev') {
$query = file_get_contents('test_data.sql');
$db->query($query);
echo 'Inserting test data<br>';
}

$sentencia = $db->prepare(
"INSERT INTO videojuegos(anio, titulo, genero)
VALUES(:anio, :titulo, :genero);"
);

$sentencia->bindParam(":anio", $_POST["anio"]);
$sentencia->bindParam(":titulo", $_POST["titulo"]);
$sentencia->bindParam(":genero", $_POST["genero"]);
$resultado = $sentencia->execute();

if ($resultado === true) {
echo "Videojuego registrado correctamente";
} else {
echo "Lo siento, ocurrió un error";
}
 */

echo 'DB Initiated';