<?php

// ---------------------CONEXAO------------------------
 
try 
{
    $pdo = new PDO("mysql:dbname=CRUDPDO;host=localhost", "root", "");
}
catch (PDOException $e)
{
    echo "Erro ao conectar com o BD". $e->getMessage(); 
}
catch(Exception $e)
{
    echo "Erro ". $e->getMessage(); 
}


// ---------------------INSERT------------------------

// $res = $pdo->prepare("INSERT INTO pessoa(nome, telefone, email) VALUES (:n, :t, :e)"); // prepere quando passa parametros e substituir

// //bindParam aceita apenas variaveis 
// $nome = "Julia";
// $telefone = "11111111";
// $email = "ju@gmail.com";
// $res->bindParam(":n", $nome);
// $res->bindParam(":t", $telefone);
// $res->bindParam(":e", $email);

// $res->execute();

//enquanto bindValue aceita qualquer coisa, aceito os valores direto
// $res->bindValue(":n", "Julia");
// $res->bindValue(":t", "11111111");
// $res->bindValue(":e", "ju@gmail.com");
//$res->execute();

//ou
// $pdo->query("INSERT INTO pessoa(nome, telefone, email) VALUES
// ('Julia', '11111111', 'ju@gmail.com')"); // query nao precisa substituir, ja coloca os valores direto 


// ---------------------DELETE------------------------

// $res = $pdo->prepare("DELETE FROM pessoa WHERE id = :id");

// $id = 2;
// $res->bindParam(":id", $id);
// $res->execute(); 

// $res = $pdo->query("DELETE FROM pessoa WHERE id = '1'");


// ---------------------UPDATE------------------------

$res = $pdo->prepare("UPDATE pessoa SET email = :e WHERE id = :id");
$email = "julia@gmail.com";
$id = 4;
$res->bindParam(":e", $email);
$res->bindParam(":id", $id);

$res->execute(); 

//ou
// $res = $pdo->query("UPDATE pessoa SET email = 'jjjj@gmail.com' WHERE id = '5'");


// ---------------------SELECT------------------------

$res = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id ");

$id = 6;
$res->bindParam(":id", $id);
$res->execute();

$result = $res->fetch(PDO::FETCH_ASSOC); // fetch() p quando vem apenas 1 linha do BD, 1 registro

foreach ($result as $key => $value)
{
    echo $key. ": ". $value. "<br>";
}

// echo "<pre>";
// print_r($result);
// echo "</pre>";

// ou
// $res = $pdo->prepare("SELECT * FROM pessoa");
// $res->fetchAll(); // p mais de 1 registro



