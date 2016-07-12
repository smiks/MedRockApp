<?php
require_once 'Model.php';

class queue extends Model{
	var $table = "queue";

	/* construction and helper functions */
	public function __construct() {

	}

	private static function cleanInput($value)
	{
		$replace     = array("'",'"','<','>','\\');
		$replacement = array("&#39;",'&quot;','&lt;','&gt;','&#092;');
		$outputVal   = str_replace($replace, $replacement, $value);
		return $outputVal;
	}


	public function add($data){
		/* making SQL */
		$sql = "INSERT INTO {$this->table} (<FIELDS>) VALUES (<VALUES>);";
		$fields = "";
		$values = "";
		foreach ($data as $key => $value) {
			$fields .= $key.", ";
			$values .= "'".$value."', ";
		}
		$fields = rtrim($fields, ", ");
		$values = rtrim($values, ", ");
		$sql = str_replace("<FIELDS>", $fields, $sql);
		$sql = str_replace("<VALUES>", $values, $sql);
		$this->execute($sql);
	}

	public function exists($key, $value){
		$data = $this->orm("select")->
						count($key)->
						table($this->table)->
						where($key, "=", $value)->
						limit(1)->
						fetchSingle();
		return ($data != 0);

	}

	public function selectAlldata($whereKey, $whereValue){
		$data = $this->orm("select")->
						selectAll()->
						table($this->table)->
						where($whereKey, "=", $whereValue)->
						limit(1)->
						fetchRow();
		return $data;

	}

	public function getAll(){
		$data = $this->orm("select")->
						selectAll()->
						table($this->table)->
						fetchArray();
		return $data;

	}

	public function getQueue(){
		$data = $this->orm("select")->
						selectAll()->
						table($this->table)->
						fetchArray();
		return $data;

	}

	public function getQueueWithDetails(){
		global $db;
		$sql = "SELECT * FROM queue q 
				LEFT JOIN history h ON (h.historyID = q.historyID) 
				LEFT JOIN users u ON (u.userID = q.userID)
				ORDER BY queueID DESC;";
		$data = $this->sqlRaw($sql)->fetchArray();
		return $data;
	}

	public function getQueueTime(){
		global $db;
		$sql = "SELECT SUM(waitingTime) FROM ".$this->table." ;";
		$q  = $db -> query($sql);
		$ret = $db -> fetch_single($q);
		return $ret;
	}

	public function getAllWhere($whereKey, $whereValue){
		$data = $this->orm("select")->
						selectAll()->
						table($this->table)->
						where($whereKey, "=", $whereValue)->
						limit(1)->
						fetchArray();
		return $data;

	}	

	public function selectData($select, $whereKey, $whereValue){
		$data = $this->orm("select")->
						select($select)->
						table($this->table)->
						where($whereKey, "=", $whereValue)->
						limit(1)->
						fetchSingle();
		return $data;

	}


	/* function updates row in database.
	 * $data = array(fieldName => fieldValue)
	 * $value = where clause value
	 * $field = where clause name
	 * $limit = how many rows to update (limit 0: no limit)
	 */
	public function updateData($field, $value, $data, $limit = 1){
		$field = $field;
		$inject = " {$field} = {$value} ";
		if(gettype($value) == "string"){
			$inject = " {$field} LIKE ('{$value}') ";
		}
		$limitS = " LIMIT {$limit}; ";
		if($limit == 0){
			$limitS = ";";
		}
		$sql = "UPDATE {$this->table} SET <SET> WHERE {$inject} {$limitS}";
		$set = "";
		foreach($data as $key => $value){
			$key = $key;
			$set .= "`{$key}` = '{$value}', ";
		}
		$set = rtrim($set, ", ");
		$sql = str_replace("<SET>", $set, $sql);
		$this->execute($sql);
	}	
	

}
