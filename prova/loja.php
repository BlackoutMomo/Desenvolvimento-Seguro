<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackout Books // Catálogo de Livros</title>

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
    /* Adicionado -webkit- para suporte no Chrome antigo e Safari */
    -webkit-mask-image: linear-gradient(to bottom, black, transparent);
    mask-image: linear-gradient(to bottom, black, transparent);
}

.container {
    width: 100%;
    max-width: 1300px;
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

/* HEADER DE AÇÕES */
.header-acoes {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 12px;
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

.form-logout {
    margin: 0;
}

.btn-sair {
    padding: 12px 20px;
    background: transparent;
    color: #ff5c8a;
    border: 1px solid #ff5c8a;
    border-radius: 10px;
    font-family: 'Orbitron', sans-serif;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    cursor: pointer;
    transition: 0.3s;
}

.btn-sair:hover {
    background: rgba(255, 92, 138, 0.12);
    box-shadow:
        0 0 12px rgba(255, 92, 138, 0.45),
        0 0 25px rgba(255, 92, 138, 0.2);
    transform: translateY(-2px);
}

/* TABELA */
.lista {
    padding: 25px;
    background: rgba(12, 12, 15, 0.88);
    border: 1px solid #5c1a91;
    border-radius: 20px;
    box-shadow:
        0 20px 70px rgba(0, 0, 0, 0.7),
        inset 0 0 30px rgba(138, 43, 226, 0.04);
    /* Adicionado -webkit- para suporte de desfoque no Safari */
    -webkit-backdrop-filter: blur(15px);
    backdrop-filter: blur(15px);
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.85rem;
    white-space: nowrap;
}

thead th {
    text-align: left;
    padding: 12px 14px;
    color: #a879c9;
    letter-spacing: 1px;
    text-transform: uppercase;
    font-size: 0.7rem;
    border-bottom: 1px solid #3b145b;
}

tbody td {
    padding: 14px 12px;
    border-bottom: 1px solid rgba(92, 26, 145, 0.4);
    color: #ddd;
    font-family: 'Rajdhani', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    vertical-align: middle;
}

tbody tr:hover {
    background: rgba(138, 43, 226, 0.08);
}

/* ESTILIZAÇÃO DOS DADOS */
.isbn-code {
    font-size: 0.75rem;
    color: #888;
    display: block;
    margin-top: 2px;
    font-family: monospace;
}

.badge {
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: inline-block;
}

.badge-categoria {
    background: rgba(0, 240, 255, 0.15);
    border: 1px solid rgba(0, 240, 255, 0.4);
    color: #00f0ff;
}

.badge-genero {
    background: rgba(138, 43, 226, 0.2);
    border: 1px solid rgba(176, 0, 255, 0.4);
    color: #d182ff;
}

.preco {
    color: #00ffaa;
    font-weight: 700;
    font-size: 1.1rem;
}

.qtd-estoque {
    color: #ffb700;
    font-weight: 700;
}

.resumo-cell {
    white-space: normal; /* Sobrescreve o comportamento geral da tabela */
    max-width: 220px;
    font-size: 0.85rem;
    color: #aaa;
    line-height: 1.2;
    /* Adicionado para que palavras/links não ultrapassem a largura */
    word-wrap: break-word; 
    overflow-wrap: break-word;
}

/* AÇÕES */
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
    font-family: 'Orbitron', sans-serif;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-decoration: none;
    display: inline-block;
    /* Adicionado para centralizar textos nos links que agem como botões */
    text-align: center;
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

.sem-registros {
    text-align: center;
    padding: 30px;
    color: #888;
    letter-spacing: 2px;
    font-size: 0.8rem;
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

@media (max-width: 768px) {
    .container { padding: 15px; }
    .header-acoes { flex-direction: column; align-items: stretch; }
    .btn-novo, .btn-sair { width: 100%; text-align: center; }
}
</style>
</head>

<body>

    <div class="container">

        <section class="title">
            <h1>BLACKOUT</h1>
            <p class="subtitle">SISTEMA DE GESTÃO // ACERVO DE LIVROS</p>
        </section>

        <div class="header-acoes">
            <a href="cadastrarLivro.html" class="btn-novo">+ Novo Livro</a>

            <form action="logout.php" method="post" class="form-logout">
                <button type="submit" class="btn-sair">Sair</button>
            </form>
        </div>

        <section class="lista">
            <table>
                <thead>
                    <tr>
                        <th>ID / ISBN</th>
                        <th>Livro / Escritores</th>
                        <th>Editora</th>
                        <th>Categoria / Gênero</th>
                        <th>Estoque</th>
                        <th>Preço</th>
                        <th>Resumo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM livros ORDER BY id DESC";
                    $res = $conn->query($sql);

                    if ($res && $res->num_rows > 0) {
                        while ($row = $res->fetch_assoc()) {
                            $id = htmlspecialchars($row['id']);
                            $ISBN = htmlspecialchars($row['ISBN'] ?? 'N/A');
                            $Nome = htmlspecialchars($row['Nome'] ?? 'Desconhecido');
                            $Categoria = htmlspecialchars($row['Categoria'] ?? 'Geral');
                            $Valor = number_format($row['Valor'] ?? 0, 2, ',', '.');
                            $Quantidade = htmlspecialchars($row['Quantidade'] ?? '0');
                            $Genero = htmlspecialchars($row['Genero'] ?? 'Desconhecido');
                            $Editora = htmlspecialchars($row['Editora'] ?? 'Desconhecido');
                            $Escritores = htmlspecialchars($row['Escritores'] ?? 'Desconhecido');
                            $Resumo = htmlspecialchars($row['Resumo'] ?? 'Sem resumo disponível');

                            // Limita a exibição do resumo na tabela para no máximo 60 caracteres
                            $resumoCurto = (mb_strlen($Resumo) > 60) ? mb_substr($Resumo, 0, 60) . '...' : $Resumo;

                            echo "<tr>
                                    <td>
                                        #{$id}
                                        <span class='isbn-code'>ISBN: {$ISBN}</span>
                                    </td>
                                    <td>
                                        <strong style='color:#fff; font-size:1.1rem;'>{$Nome}</strong><br>
                                        <span style='color:#a879c9; font-size:0.85rem;'>Escrito por: {$Escritores}</span>
                                    </td>
                                    <td>{$Editora}</td>
                                    <td>
                                        <span class='badge badge-categoria'>{$Categoria}</span><br>
                                        <span class='badge badge-genero' style='margin-top:4px;'>{$Genero}</span>
                                    </td>
                                    <td class='qtd-estoque'>{$Quantidade} un.</td>
                                    <td class='preco'>R$ {$Valor}</td>
                                    <td class='resumo-cell' title='{$Resumo}'>{$resumoCurto}</td>
                                    <td class='acoes'>
                                        <a href='editar.php?id={$id}' class='btn-acao btn-editar'>Editar</a>
                                        <a href='excluir.php?id={$id}' class='btn-acao btn-apagar'
                                           onclick='return confirm(\"Deseja excluir o livro {$Nome}?\")'>Excluir</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr>
                                <td colspan='8' class='sem-registros'>NENHUM LIVRO CADASTRADO NO SISTEMA.</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <footer>
            <p>BLACKOUT BOOKS <span>//</span> TODOS OS DIREITOS RESERVADOS</p>
        </footer>

    </div>

</body>
</html>