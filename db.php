<?php
class connect_database{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "Final_Project"; // fill in your database name containing tables: products and categories
    public $conn = NULL;

    public function connectDb(){
        try{
            $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->dbname", $this->username, $this->password);
			//if($this->conn !=null){echo "successfully connected";}
			//$this->conn->setAttribute(PDO:ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			echo "Connected successfully";
			/*
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected successfully";
			*/
        }
        catch(PDOException $e){
            echo "500 Internal Server Error\n\n"."There was a SQL error:\n\n". $e->getMessage();
            $error_out->http_error("500 Internal Server Error\n\n"."There was a SQL error:\n\n". $e->getMessage());
        }
        return $this->conn;
    }
}

class error_message{
	function http_error($message){
        header("Content-type: text/plain");
        die($message);
    }
}

class running_SQL{
    function runQuery($conn, $query) {
        try {
			var_dump($conn);
            $q = $conn->prepare($query);
            $q->execute();
            $results = $q->fetchAll();
            $q->closeCursor();
            return $results;    
        } catch (PDOException $e) {
			$error_out = new error_message();
            $error_out->http_error("500 Internal Server Error\n\n"."There was a SQL error:\n\n" . $e->getMessage());
        }     
    }

    function printTable($array){
        print("<table border=1>");
        foreach ($array as $line_num=>$line){
            if ($line_num == 0){
                print("<tr>");
                $count_col = 0;
                foreach ($line as $col_name => $columns){
                    if ($count_col%2 == 0){
                        print("<th>$col_name</th>");
                    }
                    $count_col++;
                }
                print("</tr>");
            }
            print("</tr>");
            $count_col = 0;
            foreach($line as $col_name => $columns){
                if ($count_col%2 ==0){
                    print("<td>$columns</td>");
                }
                $count_col++;
            }
            print("</tr>");
        }
        print("</tr>");
		print("</table>");
    }
}
?>
