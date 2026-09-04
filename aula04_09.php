<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackout</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at 50% 0%, #35105c 0%, #11051d 35%, #050505 70%);
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

        /* BOTÃO DE NOVO CADASTRO */
        .header-acoes {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .btn-novo {
            padding: 12px 20px;
            background: linear-gradient(135deg, #7b1fa2, #b000ff);
            color: #fff;
            border-radius: 10px;
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            box-shadow: 0 0 15px rgba(176, 0, 255, 0.4);
            transition: 0.3s;
            display: inline-block;
        }

        .btn-novo:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 20px #b000ff, 0 0 35px rgba(176, 0, 255, 0.5);
        }

        .lista {
            padding: 30px;
            background: rgba(12, 12, 15, 0.88);
            border: 1px solid #5c1a91;
            border-radius: 20px;
            box-shadow:
                0 20px 70px rgba(0, 0, 0, 0.7),
                inset 0 0 30px rgba(138, 43, 226, 0.04);
            backdrop-filter: blur(15px);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        thead th {
            text-align: left;
            padding: 10px 12px;
            color: #a879c9;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 0.7rem;
            border-bottom: 1px solid #3b145b;
        }

        tbody td {
            padding: 12px;
            border-bottom: 1px solid rgba(92, 26, 145, 0.4);
            color: #ddd;
        }

        tbody tr:hover {
            background: rgba(138, 43, 226, 0.08);
        }

        .acoes {
            display: flex;
            gap: 8px;
        }

        .btn-acao {
            padding: 8px 14px;
            font-size: 0.65rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-block;
        }

        .btn-editar {
            background: linear-gradient(135deg, #7b1fa2, #b000ff);
            color: #fff;
        }

        .btn-editar:hover {
            box-shadow: 0 0 15px #b000ff;
        }

        .btn-apagar {
            background: transparent;
            color: #ff5c8a;
            border: 1px solid #ff5c8a;
        }

        .btn-apagar:hover {
            background: rgba(255, 92, 138, 0.15);
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
            .lista { padding: 18px; }
            .header-acoes { justify-content: center; }
            .btn-novo { width: 100%; text-align: center; }
        }
    </style>
</head>

<body>

    <div class="container">

        <section class="title">
            <h1>BLACKOUT</h1>
            <p class="subtitle">LISTA DE CLIENTES</p>
        </section>

        <div class="header-acoes">
            <a href="aulaEmail/cadastro.php" class="btn-novo">+ Novo Cadastro</a>
        </div>

        <section class="lista">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM usuario";
                    $res = $conn->query($sql);
                    while ($row = $res->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['usuario']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['telefone']}</td>
                                <td class='acoes'>
                                    <a href='editar.php?id={$row['id']}' class='btn-acao btn-editar'>Editar</a>
                                    <a href='excluir.php?id={$row['id']}' class='btn-acao btn-apagar'
                                       onclick='return confirm(\"Deseja excluir?\")'>Excluir</a>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <footer>
            <p>BLACKOUT SYSTEMS <span>//</span> TODOS OS DIREITOS RESERVADOS</p>
        </footer>

    </div>

</body>
</html>