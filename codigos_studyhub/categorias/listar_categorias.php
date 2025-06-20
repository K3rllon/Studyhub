<?php

require_once "../conexao.php";

$resultado = $conexao->query("SELECT * FROM Categorias");

while ($row = $resultado->fetch(PDO::FETCH_ASSOC)):?>
    <div class="categorias">
        <div class="ladoEsquerdo">
            <img src="assets/categorias" alt="categorias" class="simbuloCategorias">
            <h3 class="nomeCategoria" ><?= htmlspecialchars($row['nome']) ?></h3>
        </div>
        <div class="ladoDireito">
            <a href="alteracao_categorias.php?act=upd&id_categoria=<?= $row['id_categoria'] ?>">
                <img src="assets/lapis.png" alt="Editar" class="simbuloeditar">
            </a>
            <a href="excluir_categoria.php?act=del&id_categoria=<?= $row['id_categoria'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                <img src="assets/lixeira.png" alt="Excluir" class="simbuloexcluir">
            </a>
        </div>
    </div>
<?php endwhile; ?>