<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Editar Arquivo</title>
    <link rel="stylesheet" href="style_form.css" />
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_arquivos" value="<?= htmlspecialchars($id_arquivos ?? '') ?>" />

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required
            value="<?= htmlspecialchars($nome ?? '') ?>" placeholder="Digite o nome do arquivo" />

        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" id="tipo" required
            value="<?= htmlspecialchars($tipo ?? '') ?>" placeholder="Ex: Resumo, vídeo-aula..." />

        <label for="formato">Formato:</label>
        <input type="text" name="formato" id="formato" required
            value="<?= htmlspecialchars($formato ?? '') ?>" placeholder="Ex: PDF, MP4..." />

        <label for="id_categorias">Categoria:</label>
        <select name="id_categorias" id="id_categorias" required>
            <option value="">Selecione uma categoria</option>
            <?php
            require_once "../conexao.php";
            try {
                $stmt = $conexao->query("SELECT id_categoria, nome FROM categorias");
                $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($categorias as $cat):
                    $selected = ($cat['id_categoria'] == ($id_categorias ?? '')) ? 'selected' : '';
                    ?>
                    <option value="<?= $cat['id_categoria'] ?>" <?= $selected ?>>
                        <?= htmlspecialchars($cat['nome']) ?>
                    </option>
                <?php endforeach;
            } catch (PDOException $e) {
                echo "<option disabled>Erro ao carregar categorias</option>";
            }
            ?>
        </select>

        <label for="caminho_arquivo">Arquivo (caminho ou upload):</label>
        <input type="file" name="arquivo" id="caminho_arquivo" accept=".pdf,.mp4,.avi,.mov,.png,.jpg,.jpeg" />
        <?php if (!empty($caminho_arquivo)): ?>
            <p>Arquivo atual: <?= htmlspecialchars($caminho_arquivo) ?></p>
        <?php endif; ?>

        <button type="submit">Salvar</button>
    </form>
</body>
</html>
