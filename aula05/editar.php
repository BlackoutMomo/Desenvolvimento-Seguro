<?php
include 'db.php';
$id = $_GET['id'];
$sql = "SELECT * FROM usuario WHERE id=$id";
$res = $conn->query($sql);
$cliente = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackout - Editar Cliente</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800&display=swap');

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
            max-width: 900px;
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
            gap: 24px;
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

        input {
            width: 100%;
            padding: 14px 16px;
            background: #09090b;
            color: white;
            border: 1px solid #3b145b;
            border-radius: 10px;
            outline: none;
            font-family: inherit;
            transition: 0.3s;
        }

        input:focus {
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
            font-family: inherit;
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
            <p class="subtitle">EDITAR CLIENTE</p>
        </section>

        <form action="salvar_edicao.php" method="POST">
            <input type="hidden" name="id" value="<?= $cliente['id'] ?>">

            <div class="form-grid">
                <div class="field full">
                    <label for="usuario">Usuário</label>
                    <input type="text" id="usuario" name="usuario" value="<?= $cliente['usuario'] ?>" required>
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= $cliente['email'] ?>" required>
                </div>

                <div class="field">
                    <label for="telefone">Telefone</label>
                    <input type="text" id="telefone" name="telefone" value="<?= $cliente['telefone'] ?>">
                </div>
            </div>

            <div class="buttons">
                <button type="submit" class="submit">Salvar</button>
                <a href="index.php" class="btn cancel">Cancelar</a>
            </div>
        </form>

        <footer>
            <p>BLACKOUT SYSTEMS <span>//</span> TODOS OS DIREITOS RESERVADOS</p>
        </footer>

    </div>

</body>

</html>