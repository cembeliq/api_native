<?php

class Disbursement{
	// database connection and table name
    private $conn;
    private $table_name = "disbursement";
 
    // object properties
    public $id;
    public $amount;
    public $status;
    public $bank_code;
    public $account_number;
    public $beneficiary_name;
    public $remark;
    public $receipt;
    public $time_served;
    public $fee;
    public $created_at;

 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read disbursement
	function read(){
	 
	    // select all query
	    $query = "SELECT
	                c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
	            FROM
	                " . $this->table_name . " p
	                LEFT JOIN
	                    categories c
	                        ON p.category_id = c.id
	            ORDER BY
	                p.created DESC";
	 
	    // prepare query statement
	    $stmt = $this->conn->prepare($query);
	 
	    // execute query
	    $stmt->execute();
	 
	    return $stmt;
	}

	// create disbursement
	function create(){
	 
	    // query to insert record
	    $query = "INSERT INTO
	                " . $this->table_name . "
	            SET
	                id=:id, amount=:amount, status=:status, bank_code=:bank_code, account_number=:account_number, beneficiary_name=:beneficiary_name, remark=:remark, receipt=:receipt, time_served=:time_served, fee=:fee, created_at=:created_at";
	 
	    // prepare query
	    $stmt = $this->conn->prepare($query);
	 
	    // sanitize
	    $this->id=htmlspecialchars(strip_tags($this->id));
	    $this->amount=(int)htmlspecialchars(strip_tags($this->amount));
	    $this->status=htmlspecialchars(strip_tags($this->status));
	    $this->bank_code=htmlspecialchars(strip_tags($this->bank_code));
	    $this->account_number=htmlspecialchars(strip_tags($this->account_number));
	    $this->beneficiary_name=htmlspecialchars(strip_tags($this->beneficiary_name));
	    $this->remark=htmlspecialchars(strip_tags($this->remark));
	    $this->receipt=htmlspecialchars(strip_tags($this->receipt));
	    $this->time_served=htmlspecialchars(strip_tags($this->time_served));
	    $this->fee=(int)htmlspecialchars(strip_tags($this->fee));
	    $this->created_at=htmlspecialchars(strip_tags($this->created_at));
	 
	    // bind values
	    $stmt->bindParam(":id", $this->id);
	    $stmt->bindParam(":amount", $this->amount);
	    $stmt->bindParam(":status", $this->status);
	    $stmt->bindParam(":bank_code", $this->bank_code);
	    $stmt->bindParam(":account_number", $this->account_number);
	    $stmt->bindParam(":beneficiary_name", $this->beneficiary_name);
	    $stmt->bindParam(":remark", $this->remark);
	    $stmt->bindParam(":receipt", $this->receipt);
	    $stmt->bindParam(":time_served", $this->time_served);
	    $stmt->bindParam(":fee", $this->fee);
	    $stmt->bindParam(":created_at", $this->created_at);
	 
	    // execute query
	    if($stmt->execute()){
	        return true;
	    }
	 
	    return false;
	     
	}

	// used when filling up the update disbursement form
	function readOne(){
	 
	    // query to read single record
	    $query = "SELECT
	                c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
	            FROM
	                " . $this->table_name . " p
	                LEFT JOIN
	                    categories c
	                        ON p.category_id = c.id
	            WHERE
	                p.id = ?
	            LIMIT
	                0,1";
	 
	    // prepare query statement
	    $stmt = $this->conn->prepare( $query );
	 
	    // bind id of product to be updated
	    $stmt->bindParam(1, $this->id);
	 
	    // execute query
	    $stmt->execute();
	 
	    // get retrieved row
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
	    // set values to object properties
	    $this->name = $row['name'];
	    $this->price = $row['price'];
	    $this->description = $row['description'];
	    $this->category_id = $row['category_id'];
	    $this->category_name = $row['category_name'];
	}

	// update the disbursement
	function update(){
	 
	    // update query
	    $query = "UPDATE
	                " . $this->table_name . "
	            SET
	                status = :status,
	                receipt = :receipt,
	                time_served = :time_served
	            WHERE
	                id = :id";
	 
	    // prepare query statement
	    $stmt = $this->conn->prepare($query);
	 
	    // sanitize
	    $this->status=htmlspecialchars(strip_tags($this->status));
	    $this->receipt=htmlspecialchars(strip_tags($this->receipt));
	    $this->time_served=htmlspecialchars(strip_tags($this->time_served));
	    $this->id=htmlspecialchars(strip_tags($this->id));
	 
	    // bind new values
	    $stmt->bindParam(':status', $this->status);
	    $stmt->bindParam(':receipt', $this->receipt);
	    $stmt->bindParam(':time_served', $this->time_served);
	    $stmt->bindParam(':id', $this->id);
	 
	    // execute the query
	    if($stmt->execute()){
	        return true;
	    }
	 
	    return false;
	}

	// delete the disbursement
	function delete(){
	 
	    // delete query
	    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
	 
	    // prepare query
	    $stmt = $this->conn->prepare($query);
	 
	    // sanitize
	    $this->id=htmlspecialchars(strip_tags($this->id));
	 
	    // bind id of record to delete
	    $stmt->bindParam(1, $this->id);
	 
	    // execute query
	    if($stmt->execute()){
	        return true;
	    }
	 
	    return false;
	     
	}

}