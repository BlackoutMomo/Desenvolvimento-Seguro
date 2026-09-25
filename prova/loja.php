<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackout Books // Catálogo de Livros</title>

    <style>
/* =========================================================
   MGSV : THE PHANTOM PAIN UI THEME (DIAMOND DOGS / iDROID)
   ========================================================= */

@import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Teko:wght@400;500;600;700&display=swap');

:root {
    --mgsv-bg: #0a0a0a;
    --mgsv-panel: rgba(15, 17, 15, 0.92);
    --mgsv-yellow: #e4bb24; /* iDroid Yellow */
    --mgsv-red: #a81c11;    /* Diamond Dogs Red */
    --mgsv-olive: #454d3d;  /* Tactical Olive Drab */
    --mgsv-text: #e0e0e0;
    --mgsv-muted: #7a7a7a;
    --mgsv-border: rgba(228, 187, 36, 0.25);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    min-height: 100vh;
    background-color: var(--mgsv-bg);
    background-image: 
        radial-gradient(circle at 50% 20%, #1a1c18 0%, #0a0a0a 80%);
    color: var(--mgsv-text);
    font-family: 'Share Tech Mono', monospace; /* Fonte militar/dados */
    overflow-x: hidden;
}

/* Efeito de Scanline e Sujeira da Tela do iDroid */
body::before {
    content: "";
    position: fixed;
    inset: 0;
    pointer-events: none;
    background:
        linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 255, 255, 0.01) 1px, transparent 1px);
    background-size: 8px 8px; /* Grid bem fechado militar */
    z-index: 9999;
    opacity: 0.5;
}

.container {
    width: 100%;
    max-width: 1300px;
    margin: auto;
    padding: 40px 20px;
}

/* Títulos MGSV Style */
.title {
    text-align: left; /* Alinhado à esquerda como logs militares */
    margin-bottom: 30px;
    border-bottom: 2px solid var(--mgsv-border);
    padding-bottom: 10px;
    position: relative;
}

.title::after {
    content: "";
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 150px;
    height: 2px;
    background-color: var(--mgsv-yellow);
}

h1 {
    font-family: 'Teko', sans-serif;
    font-size: clamp(2.5rem, 6vw, 4.5rem);
    letter-spacing: 4px;
    color: var(--mgsv-yellow);
    line-height: 1;
    text-transform: uppercase;
}

.subtitle {
    margin-top: 5px;
    color: var(--mgsv-muted);
    font-size: 0.85rem;
    letter-spacing: 3px;
    text-transform: uppercase;
}

.subtitle::before {
    content: ">> ";
    color: var(--mgsv-red);
}

/* HEADER DE AÇÕES */
.header-acoes {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

/* Botões Estilo Militar / Tático (Com chanfro nas pontas) */
.btn-novo, .btn-sair {
    font-family: 'Teko', sans-serif;
    font-size: 1.2rem;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    text-decoration: none;
    padding: 6px 25px;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
    background: transparent;
    position: relative;
    clip-path: polygon(10px 0, 10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%, 0 10px);
}

.btn-novo {
    background-color: var(--mgsv-yellow);
    color: #000;
}

.btn-novo:hover {
    background-color: #fff;
    color: #000;
}

.form-logout {
    margin: 0;
}

.btn-sair {
    background-color: var(--mgsv-red);
    color: #fff;
}

.btn-sair:hover {
    background-color: #ff3333;
}

/* TABELA iDROID / DATABASE */
.lista {
    background: var(--mgsv-panel);
    border: 1px solid var(--mgsv-border);
    border-left: 4px solid var(--mgsv-yellow); /* Faixa lateral de destaque */
    padding: 20px;
    overflow-x: auto;
    position: relative;
}

/* Marcador estilo Mother Base no topo direito da tabela */
.lista::before {
    content: "REC // 1984";
    position: absolute;
    top: 5px;
    right: 15px;
    font-size: 0.7rem;
    color: var(--mgsv-red);
    letter-spacing: 2px;
    animation: blink 2s infinite;
}

@keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0; }
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9rem;
    white-space: nowrap;
}

thead th {
    text-align: left;
    padding: 15px 14px;
    color: var(--mgsv-yellow);
    letter-spacing: 2px;
    text-transform: uppercase;
    font-family: 'Teko', sans-serif;
    font-size: 1.2rem;
    border-bottom: 2px solid var(--mgsv-border);
}

tbody td {
    padding: 12px 14px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    color: var(--mgsv-text);
    vertical-align: middle;
}

tbody tr {
    transition: background-color 0.2s;
}

tbody tr:hover {
    background-color: rgba(228, 187, 36, 0.1);
    border-left: 2px solid var(--mgsv-yellow);
}

/* ESTILIZAÇÃO DOS DADOS */
.isbn-code {
    font-size: 0.7rem;
    color: var(--mgsv-muted);
    display: block;
    margin-top: 4px;
}

.badge {
    padding: 2px 6px;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: inline-block;
    border: 1px solid;
    background: rgba(0,0,0,0.5);
}

.badge-categoria {
    border-color: var(--mgsv-yellow);
    color: var(--mgsv-yellow);
}

.badge-genero {
    border-color: var(--mgsv-olive);
    color: #a3b392;
    margin-top: 4px;
}

.preco {
    color: #fff;
    font-weight: 700;
}

.preco::before {
    content: "GMP "; /* Moeda do MGSV */
    color: var(--mgsv-yellow);
    font-size: 0.7rem;
}

.qtd-estoque {
    color: var(--mgsv-text);
}

.resumo-cell {
    white-space: normal;
    max-width: 250px;
    font-size: 0.8rem;
    color: var(--mgsv-muted);
    line-height: 1.4;
    word-wrap: break-word; 
    overflow-wrap: break-word;
}

/* AÇÕES DA TABELA */
.acoes {
    display: flex;
    gap: 8px;
}

.btn-acao {
    padding: 4px 10px;
    font-size: 0.75rem;
    font-family: 'Share Tech Mono', monospace;
    text-transform: uppercase;
    text-decoration: none;
    border: 1px solid transparent;
    cursor: pointer;
    transition: all 0.2s ease;
    text-align: center;
}

.btn-editar {
    color: var(--mgsv-yellow);
    border-color: var(--mgsv-yellow);
    background: transparent;
}

.btn-editar:hover {
    background: var(--mgsv-yellow);
    color: #000;
}

.btn-apagar {
    color: var(--mgsv-red);
    border-color: var(--mgsv-red);
    background: transparent;
}

.btn-apagar:hover {
    background: var(--mgsv-red);
    color: #fff;
}

.sem-registros {
    text-align: center;
    padding: 40px;
    color: var(--mgsv-red);
    letter-spacing: 3px;
    font-size: 1rem;
    text-transform: uppercase;
}

footer {
    text-align: left;
    padding: 30px 0 10px;
    color: var(--mgsv-muted);
    font-size: 0.75rem;
    letter-spacing: 2px;
    border-top: 1px solid var(--mgsv-border);
    margin-top: 40px;
    text-transform: uppercase;
}

footer span {
    color: var(--mgsv-yellow);
}

@media (max-width: 768px) {
    .container { padding: 15px; }
    .header-acoes { flex-direction: column; align-items: stretch; }
    .btn-novo, .btn-sair { width: 100%; text-align: center; clip-path: none; border-radius: 4px; }
    .title { text-align: center; }
    .title::after { left: 50%; transform: translateX(-50%); }
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