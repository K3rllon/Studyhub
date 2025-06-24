<?php

require_once "../conexao.php";

$resultado = $conexao->query("SELECT * FROM arquivos");

while ($row = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
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
