<?php
require_once('Pessoa.php');
$pessoa = new Pessoa("crudpdo", "localhost", "root", "");
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo2.css">
    <title>Document</title>
</head>
<body>
    <?php
    
    if (isset($_POST['nome'])) // se clicou em CADASTRAR ou ATUALIZAR
    {
        //EDITAR
        if(isset($_GET['id_up']) && !empty($_GET['id_up']))
        {
            $id_update = addslashes($_GET['id_up']);
            $nome = addslashes($_POST['nome']); // addslashes para proteger os dados postados
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);

        if (!empty($nome) && !empty($telefone) && !empty($email))
        {
            //EDITAR
            $pessoa->update($id_update, $nome, $telefone, $email);
            header("location: index.php");
           
        }
        else
        {
            echo "Preencha todos os campos";
        }
        }
        //CADASTRAR
        else
        {
            $nome = addslashes($_POST['nome']); // addslashes para proteger os dados postados
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);

        if (!empty($nome) && !empty($telefone) && !empty($email))
        {
            if(!$pessoa->cadastrarPessoa($nome, $telefone, $email))
            {
                echo "email ja cadastrado!";
            }
        }
        else
        {
            echo "Preencha todos os campos";
        }
        }

        
    }
    ?>

    <?php
    //EDITAR
        if(isset($_GET['id_up'])) //se a pessoa clicou em editar 
        {
            $id_up = addslashes($_GET['id_up']);
            $res = $pessoa->searchId($id_up);
        }
    ?>

    <section id="esquerda">
    <form method="POST">
    <h2>CADASTRAR PESSOA</h2>
    <label for="nome">Nome</label> 
    <input type="text" name="nome" id="nome"
    value="<?php if(isset($res)){echo $res['nome'];} ?>"
    >

    <label for="telefone">Telefone</label>
    <input type="text" name="telefone" id="telefone"
    value="<?php if(isset($res)){echo $res['telefone'];} ?>"
    >

    <label for="email">Email</label>
    <input type="email" name="email" id="email"
    value="<?php if(isset($res)){echo $res['email'];} ?>"
    >

    <input type="submit" 
    value="<?php if(isset($res)){echo "Atualizar";} else{echo "Cadastrar";}?>">
    </form>
    </section>

    <section id="direita">
    <table>
   <tr id="titulo">
   <td>Nome</td>
   <td>Telefone</td>
   <td colspan="2">Email</td>
   </tr>

   <?php
   $dados = $pessoa->select();
   if (count($dados) > 0) // se tem pessoas cadastradas no BD
   {
       for ($i=0; $i < count($dados); $i++) //SEELCIONAR TODOS OS DADOS PARA MOSTRAR NA TELA
       {
           echo "<tr>";
           foreach ($dados[$i] as $k => $v)
           {
               if ($k != "id") // EXCETO O ID
               {
                    echo "<td>". $v . "</td>";
               }
              
           }

           ?>
           <td>
           <a href="index.php?id_up=<?php echo $dados[$i]['id'];?>">Editar</a>
           <a href="index.php?id=<?php echo $dados[$i]['id'];?>">Excluir</a></td>
           <?php
           echo "</tr>";
       }
       

   }
   else //se banco esta vazio
   {
       echo "Nao ha cadastros";
   }
   ?>

   </table>
    </section>
</body>
</html>

<!-- <?php
    //EXCLUIR
    // if(isset($_GET['id']))
    // {
    //     $id = addslashes($_GET['id']);
    //     $pessoa->excluir($id);
    //     header("location: index.php");
    // }

?> -->