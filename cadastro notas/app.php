<?php


// ​Inserir dados
// Listar um a primeira linha da tabela
// Alterar um registro existente com update
// Excluir um registro
// Listar todos os registros


//como abrir conexão 
$db = new PDO('sqlite:CadastroNotas.db');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// print para ver o que tem na tabela no inicio 
echo ("o que tem no inicio \n \n");
print_r(PrintTudoDaTabela($db));

// ​Inserir dados
function AdicionarRegistro($db, $nome, $email, $ra)
{
    $stmt = $db->prepare('insert into Aluno (nome, email, ra) VALUES (:nome, :email, :ra)');
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':ra', $ra);
    return $stmt->execute();
}

AdicionarRegistro($db, 'teste', 'teste@teste.teste', '5354645');
AdicionarRegistro($db, 'teste2', 'teste2@teste.teste', '5416546');
AdicionarRegistro($db, 'teste3', 'teste3@teste.teste', '8796146');


// print para ver se foi inserido corretamente os registros 
echo ("o que tem depois de inserir os registros \n \n");
print_r(PrintTudoDaTabela($db));


// Listar um a primeira linha da tabela
function PrintPrimeiraLinha($db)
{
    $stmt = $db->prepare("select * from Aluno limit 1");
    $stmt->execute();
    return $stmt->fetchAll();
}

echo ("primeira linha \n \n");
print_r(PrintPrimeiraLinha($db));



// Alterar um registro existente com update
function AlterarRegistro($db, $nome, $email, $ra)
{
    $stmt = $db->prepare('update Aluno set nome = :nome, email = :email where ra = :ra');
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':ra', $ra);
    return $stmt->execute();
}

AlterarRegistro($db, 'testeNovo', 'testeNovo@teste.teste', '8796146');


// print para ver se foi alterado o registro
echo ("o que tem depois de alterar o registro \n \n ");
print_r(PrintTudoDaTabela($db));


// Excluir um registro
function ExcluirRegistro($db, $ra)
{
    $stmt = $db->prepare('delete from Aluno where ra = :ra');
    $stmt->bindParam(':ra', $ra);
    return $stmt->execute();
}

ExcluirRegistro($db, 5416546);

// Listar todos os registros
function PrintTudoDaTabela($db)
{
    $stmt = $db->prepare('select * from aluno');
    $stmt->execute();
    return $stmt->fetchAll();
}

echo ("o que tem no final \n \n");
print_r(PrintTudoDaTabela($db));