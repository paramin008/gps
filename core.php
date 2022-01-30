<?php


class Track {
  
  public $pdo = null;
  public $stmt = null;
  public $error = "";
  function __construct () {
    try {
      $this->pdo = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET, 
        DB_USER, DB_PASSWORD, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
      );
    } catch (Exception $ex) { exit($ex->getMessage()); }
  }

 
  function __destruct () {
    if ($this->stmt !== null) { $this->stmt = null; }
    if ($this->pdo !== null) { $this->pdo = null; }
  }

 
  function query ($sql, $data=null) {
    try {
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute($data);
      return true;
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }
  }
  
 
  function update ($id, $lng, $lat) {
    return $this->query(
      "REPLACE INTO gps_track (rider_id, track_time, track_lng, track_lat,ipaddress) VALUES (?, ?, ?, ?, ?)",
      [$id, date("d-m-Y H:i:s"), $lng, $lat, $_SERVER['REMOTE_ADDR'] ]
    );
  }

  
  function get ($id) {
    $this->query("SELECT * FROM gps_track WHERE rider_id=?", [$id]);
    return $this->stmt->fetch();
  }

  
  function getAll () {
    $this->query("SELECT * FROM gps_track");
    return $this->stmt->fetchAll();
  }
  
}


define('DB_HOST', 'localhost');
define('DB_NAME', 'gps');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
date_default_timezone_set("Asia/Bangkok");


$_TRACK = new Track();