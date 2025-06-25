<?php
require_once '../seguranca_geral.php';
require_once "../conexao.php";

$id_usuario = $_SESSION['id'] ?? null;
if (!$id_usuario) {
    die("Usuário não autenticado.");
}

$sql = "SELECT a.* FROM arquivos a 
        INNER JOIN categorias c ON a.id_categorias = c.id_categoria 
        WHERE c.id_usuario = :id_usuario";

$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
    <div class="arquivos">
        <a href="../adicionar_arquivo/<?= htmlspecialchars($row['caminho_arquivo']) ?>" target="_blank" class="linkAcesso">
        <div class="ladoEsquerdo">
            <img src="assets/arquivo.png" alt="arquivo" class="simbuloArquivo" />
            <h3 class="nomeArquivo"><?= htmlspecialchars($row['nome']) ?></h3>
        </div>
        <div class="ladoDireito">
            <a href="alteracao_arquivo.php?act=upd&id_arquivos=<?= $row['id_arquivos'] ?>">
                <img src="assets/lapis.png" alt="Editar" class="simbuloeditar">
            </a>
            <a href="excluir_arquivo.php?act=del&id_arquivos=<?= $row['id_arquivos'] ?>" onclick="return confirm('Tem certeza que deseja excluir esse arquivo?')">
                <img src="assets/lixeira.png" alt="Excluir" class="simbuloexcluir">
            </a>
        </div>
    </div>
<?php endwhile; ?>
