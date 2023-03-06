<?php
class Parcels{   
    
    private $parcelTable = "parcels";      
    public $id;
    public $parcelname;
    public $sendername;
    public $receivername;
    public $address;   
    public $trackingcode; 
	public $shippingdate; 
    public $receiverdate; 
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function read(){	
		if($this->trackingcode) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->parcelTable." WHERE trackingcode = ?");
			$stmt->bind_param("i", $this->trackingcode);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->parcelTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	function create(){
		
		$stmt = $this->conn->prepare("INSERT INTO ".$this->parcelTable."(`parcelname`, `sendername`, `receivername`, `address`, `trackingcode`, `shippingdate`, `receiverdate`) VALUES(?,?,?,?,?,?,?");
		
		$this->parcelname = htmlspecialchars(strip_tags($this->parcelname));
		$this->sendername = htmlspecialchars(strip_tags($this->sendername));
		$this->receivername = htmlspecialchars(strip_tags($this->receivername));
		$this->address = htmlspecialchars(strip_tags($this->address));
		$this->trackingcode = htmlspecialchars(strip_tags($this->trackingcode));
		$this->shippingdate = htmlspecialchars(strip_tags($this->shippingdate));
		$this->receiverdate = htmlspecialchars(strip_tags($this->receiverdate));
		
		var_dump($stmt);
        exit();
		$stmt->bind_param("ssssiss", $this->parcelname, $this->sendername, $this->receivername, $this->address, $this->trackingcode, $this->shippingdate, $this->receiverdate);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	function update(){
	 
		$stmt = $this->conn->prepare("
			UPDATE ".$this->parcelTable." 
			SET parcelname= ?, sendername = ?, receivername = ?, address = ?, trackingcode = ?, shippingdate = ?, receiverdate = ?
			WHERE id = ?");
	 
            $this->parcelname = htmlspecialchars(strip_tags($this->parcelname));
            $this->sendername = htmlspecialchars(strip_tags($this->sendername));
            $this->receivername = htmlspecialchars(strip_tags($this->receivername));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->trackingcode = htmlspecialchars(strip_tags($this->trackingcode));
            $this->shippingdate = htmlspecialchars(strip_tags($this->shippingdate));
            $this->receiverdate = htmlspecialchars(strip_tags($this->receiverdate));
	 
            $stmt->bind_param("ssssiss", $this->parcelname, $this->sendername, $this->receivername, $this->address, $this->trackingcode, $this->shippingdate, $this->receiverdate);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	function delete(){
		
		$stmt = $this->conn->prepare("DELETE FROM ".$this->parcelTable." WHERE id = ?");
			
		$this->id = $this->id;
	 
		$stmt->bind_param("i", $this->id);
	 
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
}
?>