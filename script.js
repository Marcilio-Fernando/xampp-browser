const petsMock = [
  { id: 1, nome: "Luna", especie: "gato", porte: "pequeno", cidade: "São Paulo", img: "https://images.unsplash.com/photo-1592194996308-7b43878e84a6?q=80&w=1200&auto=format&fit=crop", idade: "2 anos" },
  { id: 2, nome: "Thor", especie: "cachorro", porte: "medio", cidade: "São Paulo", img: "https://images.unsplash.com/photo-1552053831-71594a27632d?q=80&w=1200&auto=format&fit=crop", idade: "1 ano" },
  { id: 3, nome: "Nina", especie: "gato", porte: "pequeno", cidade: "Campinas", img: "https://images.unsplash.com/photo-1543852786-1cf6624b9987?q=80&w=1200&auto=format&fit=crop", idade: "6 meses" },
  { id: 4, nome: "Bob", especie: "cachorro", porte: "grande", cidade: "Santos", img: "https://images.unsplash.com/photo-1568572933382-74d440642117?q=80&w=1200&auto=format&fit=crop", idade: "3 anos" },
  { id: 5, nome: "Maya", especie: "gato", porte: "pequeno", cidade: "Rio de Janeiro", img: "https://images.unsplash.com/photo-1596854407944-bf87f6fdd49c?q=80&w=1200&auto=format&fit=crop", idade: "1 ano" },
  { id: 6, nome: "Koda", especie: "cachorro", porte: "medio", cidade: "São Paulo", img: "https://images.unsplash.com/photo-1568572933382-74d440642117?q=80&w=1200&auto=format&fit=crop", idade: "2 anos" },
  { id: 7, nome: "Mel", especie: "cachorro", porte: "pequeno", cidade: "Sorocaba", img: "https://images.unsplash.com/photo-1548199973-03cce0bbc87b?q=80&w=1200&auto=format&fit=crop", idade: "4 anos" },
  { id: 8, nome: "Tico", especie: "gato", porte: "pequeno", cidade: "Campinas", img: "https://images.unsplash.com/photo-1555685812-4b943f1cb0eb?q=80&w=1200&auto=format&fit=crop", idade: "8 meses" },
  { id: 9, nome: "Frida", especie: "cachorro", porte: "grande", cidade: "São Paulo", img: "https://images.unsplash.com/photo-1518717758536-85ae29035b6d?q=80&w=1200&auto=format&fit=crop", idade: "5 anos" },
];

let estado = {
  pagina: 1,
  porPagina: 6,
  filtros: { especie: "", porte: "", cidade: "" }
};

const $ = (s, el=document) => el.querySelector(s);
const $$ = (s, el=document) => [...el.querySelectorAll(s)];

function renderAno(){
  $("#anoAtual").textContent = new Date().getFullYear();
}

function aplicaFiltros(dados){
  const {especie, porte, cidade} = estado.filtros;
  return dados.filter(p =>
    (!especie || p.especie === especie) &&
    (!porte || p.porte === porte) &&
    (!cidade || p.cidade.toLowerCase().includes(cidade.toLowerCase()))
  );
}

function paginaAtualItens(dados){
  const inicio = (estado.pagina - 1) * estado.porPagina;
  return dados.slice(inicio, inicio + estado.porPagina);
}

function renderPets(){
  const lista = $("#listaPets");
  lista.innerHTML = "";

  const filtrados = aplicaFiltros(petsMock);
  const totalPaginas = Math.max(1, Math.ceil(filtrados.length / estado.porPagina));
  estado.pagina = Math.min(estado.pagina, totalPaginas);

  const pagina = paginaAtualItens(filtrados);

  const tpl = $("#tplCardPet");
  pagina.forEach(p => {
    const node = tpl.content.cloneNode(true);
    const midia = $(".card__midia", node);
    const titulo = $(".card__titulo", node);
    const detalhes = $(".card__detalhes", node);
    const botao = $(".card__acao", node);

    midia.style.backgroundImage = `url('${p.img}')`;
    midia.setAttribute("aria-label", `${p.nome} — ${p.especie}`);
    titulo.textContent = p.nome;
    detalhes.textContent = `${p.especie} • ${p.porte} • ${p.idade} • ${p.cidade}`;
    botao.addEventListener("click", () => {
      alert(`🔎 Vamos iniciar seu processo de adoção do(a) ${p.nome}!`);
    });
    lista.appendChild(node);
  });

  // paginação
  $("#paginaInfo").textContent = `Página ${estado.pagina} de ${totalPaginas}`;
  const [btnAnt, , btnProx] = $$(".paginacao .btn");
  btnAnt.disabled = estado.pagina === 1;
  btnProx.disabled = estado.pagina === totalPaginas;
}

function bindEventos(){
  // filtros
  $("#formFiltros").addEventListener("submit", (e)=>{
    e.preventDefault();
    const fd = new FormData(e.currentTarget);
    estado.filtros.especie = fd.get("especie") || "";
    estado.filtros.porte = fd.get("porte") || "";
    estado.filtros.cidade = fd.get("cidade") || "";
    estado.pagina = 1;
    renderPets();
  });

  // paginação
  $$("#paginacao .btn").forEach(btn => {
    btn.addEventListener("click", ()=>{
      const acao = btn.dataset.acao;
      if(acao === "anterior" && estado.pagina > 1){
        estado.pagina--;
      }
      if(acao === "proximo"){
        estado.pagina++;
      }
      renderPets();
    });
  });

  // menu mobile
  $("#menuMobile").addEventListener("click", ()=>{
    const menu = $(".menu");
    const visivel = getComputedStyle(menu).display !== "none";
    menu.style.display = visivel ? "none" : "flex";
  });

  // botão quero ajudar
  $("#btnQueroAjudar").addEventListener("click", ()=>{
    window.scrollTo({top: document.body.scrollHeight, behavior: "smooth"});
  });
}

document.addEventListener("DOMContentLoaded", ()=>{
  renderAno();
  bindEventos();
  renderPets();
});


//pop-up de loguinho

const btnLogin = document.getElementById("btnLogin");
const authModal = document.getElementById("authModal");
const closeAuth = document.querySelector(".close-auth");

const btnMostrarLogin = document.getElementById("btnMostrarLogin");
const btnMostrarCadastro = document.getElementById("btnMostrarCadastro");
const areaLogin = document.getElementById("areaLogin");
const areaCadastro = document.getElementById("areaCadastro");

btnLogin.onclick = () => authModal.style.display = "flex";
closeAuth.onclick = () => authModal.style.display = "none";

btnMostrarLogin.onclick = () => {
  areaLogin.style.display = "block";
  areaCadastro.style.display = "none";
};

btnMostrarCadastro.onclick = () => {
  areaLogin.style.display = "none";
  areaCadastro.style.display = "block";
};

window.onclick = (e) => {
  if (e.target === authModal) authModal.style.display = "none";
};

//barra de lateral
function toggleMenu() {
  document.getElementById("sidebar").classList.toggle("active");
  document.getElementById("overlay").classList.toggle("active");
}
