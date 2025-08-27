<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Adoção de Pets — Modelo</title>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="estilo.css" />
</head>
<body>

<!-- Barra lateral -->
<div class="sidebar" id="sidebar">
  <a href="#">🏠 Página Inicial</a>
  <a href="#">🐶 Adotar</a>
  <a href="#">💖 Doar</a>
  <a href="#">🔎 Animais Perdidos</a>
  <a href="#">🐾 Animais Encontrados</a>
  <a href="#">🏢 ONGs</a>
  <a href="#">🤝 Voluntários</a>
  <a href="#">📅 Feiras de Adoção</a>
  <a href="#">📰 Blog</a>
</div>

<!-- Fundo escuro -->
<div class="overlay" id="overlay" onclick="toggleMenu()"></div>

  <header class="topo">
    <div class="container">

      <!-- Botão do menu -->
<button class="menu-btn" onclick="toggleMenu()">☰</button>
      
      <a class="logo" href="#"><span>Love</span>Pets</a>
      <nav class="menu">
        <a href="#pets">Pets</a>
        <a href="#como-adotar">Como adotar</a>
        <a href="#contato">Contato</a>
        <button class="btn btn--primario" id="btnQueroAjudar">Quero ajudar</button>
<?php if (isset($_SESSION['usuario'])): ?>
  <span class="usuario-logado">Olá, <?php echo $_SESSION['usuario']; ?>!</span>
  <a href="logout.php" class="btn btn--secundario">Sair</a>
<?php else: ?>
  <button class="btn btn--secundario" id="btnLogin">Entrar</button>
<?php endif; ?>

        
      </nav>
      <button class="menu-mobile" id="menuMobile" aria-label="Abrir menu">☰</button>
    </div>
  </header>

  <section class="hero">
    <div class="container hero__conteudo">
      <div>
        <h1>Encontre seu novo melhor amigo</h1>
        <p>Filtre por espécie, porte e cidade para conhecer pets prontos para receber amor.</p>
        <form class="filtros" id="formFiltros">
          <select name="especie" aria-label="Espécie">
            <option value="">Espécie</option>
            <option value="cachorro">Cachorro</option>
            <option value="gato">Gato</option>
          </select>
          <select name="porte" aria-label="Porte">
            <option value="">Porte</option>
            <option value="pequeno">Pequeno</option>
            <option value="medio">Médio</option>
            <option value="grande">Grande</option>
          </select>
          <input type="text" name="cidade" placeholder="Cidade" aria-label="Cidade" />
          <button class="btn btn--primario" type="submit">Buscar</button>
        </form>
      </div>
      <div class="hero__imagem" role="img" aria-label="Pessoa com pet feliz"></div>
    </div>
  </section>

  <main class="container" id="pets">
    <h2>Pets disponíveis</h2>
    <div class="grade" id="listaPets"></div>

    <div id="paginacao" class="paginacao">
      <button class="btn" data-acao="anterior">Anterior</button>
      <span id="paginaInfo"></span>
      <button class="btn" data-acao="proximo">Próximo</button>
    </div>

    <section class="secao-info" id="como-adotar">
      <h3>Como funciona a adoção</h3>
      <ol>
        <li>Escolha um pet e clique em “Quero adotar”.</li>
        <li>Ser maior de 18 anos e apresentar documento de identificação.</li>
        <li>Comprovante de residência (estabilidade no local).</li>
        <li>Espaço adequado para o porte do animal (com proteção em janelas para gatos).</li>
        <li>Tempo e disponibilidade para cuidar, passear e dar atenção.</li>
        <li>Compromisso com saúde do pet (vacinação, castração e cuidados veterinários).</li>
        <li>Assinar termo de responsabilidade (sem abandono e com alimentação adequada).</li>
        <li>Preencha seus dados e agende uma visita.</li>
        <li>Passe pelo processo de triagem e leve seu amigo para casa.</li>
      </ol>
    </section>
  </main>

  <section class="cta">
    <div class="container cta__conteudo">
      <h2>Não pode adotar agora?</h2>
      <p>Você pode apadrinhar um pet e ajudar com cuidados, ração e vacinas.</p>
      <button class="btn btn--secundario">Apadrinhar um pet</button>
    </div>
  </section>

  <footer class="rodape" id="contato">
    <div class="container rodape__grid">
      <div>
        <a class="logo logo--rodape" href="#"><span>Adote</span>Amigos</a>
        <p>Projeto exemplo para layout de adoção responsável.</p>
      </div>
      <div>
        <h4>Contato</h4>
        <ul>
          <li>Email: contato@adoteamigos.org</li>
          <li>WhatsApp: (45) 99999-9999</li>
          <li>Endereço: Rua Esperança, 666</li>
        </ul>
      </div>
      <div>
        <h4>Siga</h4>
        <ul class="social">
          <li><a href="#">Instagram <img class="redes" src="InstaLogo.png"></a></li>
          <li><a href="#">Facebook <img class="redes" src="FaceLogo.png"></a></li>
          <li><a href="#">TikTok <img class="redes" src="TikToklOGO.png"></a></li>
        </ul>
      </div>
    </div>
    <div class="copy">© <span id="anoAtual"></span> LovePets — Espalhe amor</div>
  </footer>

<!-- Modal de Login/Cadastro -->
<div id="authModal" class="modal">
  <div class="modal-content">
    <span class="close-auth">&times;</span>

    <!-- Botões de alternância -->
    <div class="auth-toggle">
      <button id="btnMostrarLogin" class="btn btn--secundario">Login</button>
      <button id="btnMostrarCadastro" class="btn btn--secundario">Cadastre-se</button>
    </div>

    <!-- Área de Login -->
    <div id="areaLogin">
      <h2>Login</h2>
      <form action="login.php" method="POST">
        <input type="email" name="email" placeholder="Seu e-mail" required />
        <input type="password" name="senha" placeholder="Sua senha" required />
        <button type="submit" class="btn btn--primario">Entrar</button>
      </form>
      <p><a href="#">Esqueceu sua senha?</a></p>
    </div>

    <!-- Área de Cadastro -->
    <div id="areaCadastro" style="display: none;">
      <h2>Cadastre-se</h2>
      <form action="cadastro.php" method="POST">
        <input type="text" name="nome" placeholder="Seu nome" required />
        <input type="email" name="email" placeholder="Seu e-mail" required />
        <input type="password" name="senha" placeholder="Crie uma senha" required />
        <button type="submit" class="btn btn--primario">Cadastrar</button>
      </form>
    </div>
  </div>
</div>



  <template id="tplCardPet">
    <article class="card">
      <div class="card__midia" role="img" aria-label=""></div>
      <div class="card__conteudo">
        <h3 class="card__titulo"></h3>
        <p class="card__detalhes"></p>
        <button class="btn btn--primario card__acao">Quero adotar</button>
      </div>
    </article>
  </template>

  <script src="script.js"></script>
</body>
</html>
