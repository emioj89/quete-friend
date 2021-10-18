

<form action="index.php" method ="post">
<label for="firstname">first name</label>
<input type="text" id="firstname" name="firstname"> <br>
<label for="lastname">last name</label>
<input type="text" id="lastname" name="lastname"><br>
<button type="submit">envoyer</button>




</form>


<?php


require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);




$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

foreach($friends as $friend) {
    echo "<ul>\n<li>" .$friend['firstname'] . ' ' . $friend['lastname']."</li></ul>";
}


if($_SERVER["REQUEST_METHOD"] == "POST")
{
    

    $firstname = trim($_POST['firstname']); 
    $lastname = trim($_POST['lastname']); 
    
    
    $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
    $statement = $pdo->prepare($query);

    $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
    $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);


    $statement->execute();

    $friends = $statement->fetchAll();
}
