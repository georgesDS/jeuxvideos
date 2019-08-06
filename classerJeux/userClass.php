<?php
class userClass {
/* User Login */
	public function userLogin($username,$password){
		try{
			$db = getDB();
			/*$hash_password= hash('sha256', $password);*/ //Password encryption 
			$stmt = $db->prepare("SELECT id FROM users WHERE pseudo=:username AND password=:hash_password"); 
			$stmt->bindParam("username", $username,PDO::PARAM_STR) ;
			$stmt->bindParam("hash_password", /*$hash_password*/ $password,PDO::PARAM_STR) ;
			$stmt->execute();
			$count=$stmt->rowCount();
			$data=$stmt->fetch(PDO::FETCH_OBJ);
			$db = null;
			if($count){
				$_SESSION['id'] = $data->id; // Storing user session value
				return true;
			}
			else {
				return false;
/*				echo 'PAS DE CORRESPONDANCE';*/
			} 
		}
		catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}

	}

/* User Registration */
/*public function userRegistration($username,$password,$email,$name)
{
try{
$db = getDB();
$st = $db->prepare("SELECT id FROM users WHERE username=:username"); 
$st->bindParam("username", $username,PDO::PARAM_STR);
$st->bindParam("email", $email,PDO::PARAM_STR);
$st->execute();
$count=$st->rowCount();
if($count<1)
{
$stmt = $db->prepare("INSERT INTO users(username,password,email,name) VALUES (:username,:hash_password,:email,:name)");
$stmt->bindParam("username", $username,PDO::PARAM_STR) ;
$hash_password= hash('sha256', $password); //Password encryption
$stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
$stmt->bindParam("email", $email,PDO::PARAM_STR) ;
$stmt->bindParam("name", $name,PDO::PARAM_STR) ;
$stmt->execute();
$uid=$db->lastInsertId(); // Last inserted row id
$db = null;
$_SESSION['id']=$id;
return true;
}
else
{
$db = null;
return false;
}

} 
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}
}*/

/* User Details */
/*public function userDetails($uid)
{
try{
$db = getDB();
$stmt = $db->prepare("SELECT email,username,name FROM users WHERE uid=:uid"); 
$stmt->bindParam("id", $id,PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_OBJ); //User data
return $data;
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}*/


}
?>