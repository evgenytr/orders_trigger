<?php
class Storage {
    private $host = 'postgres';
    private $port = 5432;
    private $user = 'user';
    private $password = 'password';
    private $dbname = 'orders';
    
    private $dbconn;
    
    public function __construct() {
        $this->user     = $this->getFromEnvWithDefault('POSTGRES_USER','user');
        $this->password = $this->getFromEnvWithDefault('POSTGRES_PASSWORD','password');
        $this->dbname   = $this->getFromEnvWithDefault('POSTGRES_DBNAME','orders');
    }
    
    public function connect() {
        $this->dbconn = pg_connect("host=".$this->host." port=".$this->port." user=".$this->user." password=".$this->password." dbname=".$this->dbname);
    }
    
    public function disconnect() {
        pg_close($this->dbconn);
    }
    
    public function saveOrder($product,$quantity) {
        $params_array = [
                        htmlspecialchars($product),
                        htmlspecialchars($quantity)
                        ];
        pg_query_params($this->dbconn, "INSERT INTO orders (product_id, quantity) VALUES ($1,$2)",$params_array);
    }
    
    public function getStats() {
        $result = [];
        $ret = pg_query($this->dbconn, 
                        "SELECT categories.category_name,statistics.total_products, statistics.day
                         FROM statistics 
                         JOIN categories ON categories.id=statistics.category_id
                         ORDER BY statistics.day, categories.category_name");
         while($row = pg_fetch_row($ret)) {
             $result[] = $row;
         };                   
         return $result;       
    }
    
    public function getProducts() {
        $result = [];
        $ret = pg_query($this->dbconn, 
                        "SELECT products.id,products.name,categories.category_name 
                         FROM products
                         JOIN categories ON categories.id=products.category_id 
                         ORDER BY products.category_id, products.name");
         while($row = pg_fetch_row($ret)) {
             $result[] = $row;
         };                   
         return $result;  
    }
    private function getFromEnvWithDefault($envVarName,$defaultValue) {
        $result = getenv($envVarName);
        if(!$result) $result = $defaultValue;
        return $result;
    }
}
?>