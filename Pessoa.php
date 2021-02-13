<?php

class Pessoa
{
    private $pdo;

    //CONEXAO
    public function __construct($dbname, $host, $user, $senha)
    {
        try 
        {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
        }
        catch (Exception $e)
        {
            echo "Erro ". $e->getMessage();
        }
    }

    //SELECIONAR TODOS OS DADOS DA TABELA PESSOA PARA RETORNAR NA TELA
    public function select()
    {
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome");

        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    //CADASTRAR
    public function cadastrarPessoa($nome, $telefone, $email)
    {
        //ANTES DE CADASTRAR VERIFICAR SE O EMAIL JA EXISTE
        $cmd = $this->pdo->prepare("SELECT id from pessoa WHERE email = :e");
        $cmd->bindValue(":e", $email);
        $cmd->execute();

        if ($cmd->rowCount() > 0) //email ja existe 
        {
            return false;
        }
        else
        {
            $cmd = $this->pdo->prepare("INSERT INTO pessoa (nome, telefone, email) VALUES (:n, :t, :e)");
            $cmd->bindValue(":n",$nome);
            $cmd->bindValue(":t",$telefone);
            $cmd->bindValue(":e",$email);
            $cmd->execute();
            return true;
        }
    }

    public function excluir($id)
    {
        $cmd = $this->pdo->prepare("DELETE FROM pessoa WHERE id = :id");
        $cmd->bindValue(":id",$id);
        $cmd->execute();
    }


    //BUSCAR DADOS DE UMA PESSOA
    public function searchId($id)
    {
        $res = array();
        $cdm = $this->pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
        $cdm->bindValue(":id", $id);
        $cdm->execute();
        $res = $cdm->fetch(PDO::FETCH_ASSOC);
        return $res;
    }


    //ATUALIZAR
    public function update($id, $nome, $telefone, $email)
    {

        
        $cdm = $this->pdo->prepare("UPDATE pessoa SET nome = :n, telefone = :t, email = :e WHERE id = :id");
        $cdm->bindValue(":n", $nome);
        $cdm->bindValue(":t", $telefone);
        $cdm->bindValue(":e", $email);
        $cdm->bindValue(":id", $id);
        $cdm->execute();

        return true; 

        
    }

}