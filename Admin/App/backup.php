<?php
session_start();
// Configuração do banco de dados
$host = 'localhost'; // Servidor do banco de dados
$dbname = 'db_app_pizza'; // Nome do banco
$username = 'root'; // Usuário do banco
$password = ''; // Senha do banco
$backupDir = __DIR__ . '/backups/'; // Pasta onde os backups serão armazenados
$backupFile = $backupDir . 'backup_' . date('Y-m-d_H-i-s') . '.sql.gz'; // Nome do arquivo de backup

try {
    // Conectando ao banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // Criando diretório de backup, se não existir
    if (!is_dir($backupDir)) {
        mkdir($backupDir, 0777, true);
    }

    // Abrindo arquivo para escrever o backup
    $gzFile = gzopen($backupFile, 'w9');
    gzwrite($gzFile, "-- Backup do banco de dados: $dbname\n");
    gzwrite($gzFile, "-- Data: " . date('Y-m-d H:i:s') . "\n\n");

    // Pegando todas as tabelas do banco
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

    foreach ($tables as $table) {
        // Criando a estrutura da tabela
        $stmt = $pdo->query("SHOW CREATE TABLE `$table`");
        $row = $stmt->fetch();
        gzwrite($gzFile, "DROP TABLE IF EXISTS `$table`;\n" . $row['Create Table'] . ";\n\n");

        // Pegando os dados da tabela
        $rows = $pdo->query("SELECT * FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $values = array_map(function ($value) use ($pdo) {
                return is_null($value) ? 'NULL' : $pdo->quote($value);
            }, array_values($row));
            gzwrite($gzFile, "INSERT INTO `$table` VALUES (" . implode(", ", $values) . ");\n");
        }
        gzwrite($gzFile, "\n");
    }

    // Fechando arquivo de backup
    gzclose($gzFile);

   $_SESSION['backup'] = "Backup realizado com susseco!";
   header('Location: ../View/dashboard.php');

} catch (PDOException $e) {
    die("Erro ao fazer backup: " . $e->getMessage());
}
?>
