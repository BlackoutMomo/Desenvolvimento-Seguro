<?php
include 'db.php';

// Valida se o ID foi informado e é um número inteiro
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: loja.php");
    exit;
}

$id = intval($_GET['id']);

// Consulta segura utilizando Prepared Statement
$stmt = $conn->prepare("SELECT * FROM livros WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    header("Location: index.php");
    exit;
}

$livro = $res->fetch_assoc();

// Sanitização de dados para exibição segura nos inputs
$ISBN       = htmlspecialchars($livro['ISBN'] ?? '');
$Nome       = htmlspecialchars($livro['Nome'] ?? '');
$Escritores = htmlspecialchars($livro['Escritores'] ?? '');
$Editora    = htmlspecialchars($livro['Editora'] ?? '');
$Categoria  = htmlspecialchars($livro['Categoria'] ?? '');
$Genero     = htmlspecialchars($livro['Genero'] ?? '');
$Valor      = htmlspecialchars($livro['Valor'] ?? '0.00');
$Quantidade = htmlspecialchars($livro['Quantidade'] ?? '0');
$Resumo     = htmlspecialchars($livro['Resumo'] ?? '');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackout Books - Editar Livro</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800&family=Rajdhani:wght@500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: radial-gradient(circle at 50% 0%, #35105c 0%, #11051d 35%, #050505 70%);
            color: #fff;
            font-family: 'Orbitron', sans-serif;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background:
                linear-gradient(rgba(255, 255, 255, 0.015) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.015) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: linear-gradient(to bottom, black, transparent);
        }

        .container {
            width: 100%;
            max-width: 950px;
            margin: auto;
            padding: 30px 20px;
        }

        .title {
            text-align: center;
            margin-bottom: 35px;
        }

        h1 {
            font-size: clamp(2rem, 6vw, 3.5rem);
            letter-spacing: 10px;
            color: #fff;
            text-shadow: 0 0 5px #fff, 0 0 15px #8a2be2, 0 0 35px #8a2be2;
        }

        .subtitle {
            margin-top: 10px;
            color: #a879c9;
            font-size: 0.75rem;
            letter-spacing: 5px;
        }

        form {
            position: relative;
            padding: 35px;
            background: rgba(12, 12, 15, 0.88);
            border: 1px solid #5c1a91;
            border-radius: 20px;
            box-shadow:
                0 20px 70px rgba(0, 0, 0, 0.7),
                inset 0 0 30px rgba(138, 43, 226, 0.04);
            backdrop-filter: blur(15px);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        label {
            color: #c58aff;
            font-size: 0.75rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        input, textarea {
            width: 100%;
            padding: 14px 16px;
            background: #09090b;
            color: white;
            border: 1px solid #3b145b;
            border-radius: 10px;
            outline: none;
            font-family: 'Rajdhani', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            transition: 0.3s;
        }

        textarea {
            resize: vertical;
            min-height: 110px;
        }

        input:focus, textarea:focus {
            border-color: #a020f0;
            box-shadow:
                0 0 0 2px rgba(160, 32, 240, 0.15),
                0 0 18px rgba(160, 32, 240, 0.35);
            transform: translateY(-1px);
        }

        .buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        button,
        .btn {
            flex: 1;
            padding: 15px;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 10px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
        }

        .submit {
            background: linear-gradient(135deg, #7b1fa2, #b000ff);
            color: white;
            box-shadow: 0 0 15px rgba(176, 0, 255, 0.4);
        }

        .submit:hover {
            transform: translateY(-3px);
            box-shadow:
                0 0 15px #b000ff,
                0 0 35px rgba(176, 0, 255, 0.5);
        }

        .cancel {
            background: transparent;
            color: #c58aff;
            border: 1px solid #5c1a91;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cancel:hover {
            background: rgba(138, 43, 226, 0.1);
            border-color: #a020f0;
            color: white;
        }

        footer {
            text-align: center;
            padding: 30px 0 10px;
            color: #555;
            font-size: 0.7rem;
            letter-spacing: 3px;
        }

        footer span {
            color: #8a2be2;
        }

        @media (max-width: 650px) {
            .container { padding: 15px; }
            form { padding: 22px; }
            .form-grid { grid-template-columns: 1fr; }
            .buttons { flex-direction: column; }
        }
    </style>
</head>

<body>

    <div class="container">

        <section class="title">
            <h1>BLACKOUT</h1>
            <p class="subtitle">SISTEMA DE GESTÃO // EDITAR LIVRO #<?= $id ?></p>
        </section>

        <form action="salvar_edicao.php" method="POST">
            <!-- ID Oculto para envio no formulário -->
            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="form-grid">
                <!-- Nome do Livro -->
                <div class="field full">
                    <label for="Nome">Título / Nome do Livro</label>
                    <input type="text" id="Nome" name="Nome" value="<?= $Nome ?>" required>
                </div>

                <!-- Escritores -->
                <div class="field full">
                    <label for="Escritores">Escritores / Autores</label>
                    <input type="text" id="Escritores" name="Escritores" value="<?= $Escritores ?>" required>
                </div>

                <!-- ISBN -->
                <div class="field">
                    <label for="ISBN">ISBN</label>
                    <input type="text" id="ISBN" name="ISBN" value="<?= $ISBN ?>" required>
                </div>

                <!-- Editora -->
                <div class="field">
                    <label for="Editora">Editora</label>
                    <input type="text" id="Editora" name="Editora" value="<?= $Editora ?>" required>
                </div>

                <!-- Categoria -->
                <div class="field">
                    <label for="Categoria">Categoria</label>
                    <input type="text" id="Categoria" name="Categoria" value="<?= $Categoria ?>" required>
                </div>

                <!-- Gênero -->
                <div class="field">
                    <label for="Genero">Gênero</label>
                    <input type="text" id="Genero" name="Genero" value="<?= $Genero ?>" required>
                </div>

                <!-- Valor / Preço -->
                <div class="field">
                    <label for="Valor">Valor (R$)</label>
                    <input type="number" step="0.01" min="0" id="Valor" name="Valor" value="<?= $Valor ?>" required>
                </div>

                <!-- Quantidade em Estoque -->
                <div class="field">
                    <label for="Quantidade">Quantidade em Estoque</label>
                    <input type="number" min="0" id="Quantidade" name="Quantidade" value="<?= $Quantidade ?>" required>
                </div>

                <!-- Resumo / Sinopse -->
                <div class="field full">
                    <label for="Resumo">Resumo / Sinopse</label>
                    <textarea id="Resumo" name="Resumo" required><?= $Resumo ?></textarea>
                </div>
            </div>

            <div class="buttons">
                <button type="submit" class="submit">Atualizar Livro</button>
                <a href="index.php" class="btn cancel">Cancelar</a>
            </div>
        </form>

        <footer>
            <p>BLACKOUT BOOKS <span>//</span> TODOS OS DIREITOS RESERVADOS</p>
        </footer>

    </div>

</body>

</html>