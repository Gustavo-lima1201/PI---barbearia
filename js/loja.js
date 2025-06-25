const produtos = [
  {
    imagem: "../loja.img/coloracao.png",
    titulo: "Creme de Coloração",
    preco: "R$ 49,99",
    descricao:
      "O creme de coloração é perfeito para renovar o visual, realçar a cor natural ou cobrir os fios brancos. Sua fórmula cremosa proporciona uma aplicação fácil e uniforme, garantindo resultado vibrante e duradouro. Ideal para quem busca praticidade e cuidado em um só produto."
  },
  {
    imagem: "../loja.img/gelcreme.png",
    titulo: "Gel Creme",
    preco: "R$ 54,99",
    descricao:
      "O Gel Creme combina a fixação do gel com a hidratação do creme, oferecendo controle e estilo sem deixar o cabelo rígido ou ressecado. Ideal para modelar e dar forma com aspecto natural e toque macio."
  },
  {
    imagem: "../loja.img/creme.png",
    titulo: "Hidratante para Barba",
    preco: "R$ 59,99",
    descricao:
      "O creme hidratante para barba é essencial para manter os fios macios, saudáveis e com aspecto alinhado. Ele combate o ressecamento da pele sob os pelos, evitando coceiras e irritações. Deixa a barba suave ao toque e com brilho natural, garantindo um visual impecável."
  }
];

let indiceAtual = 0;

function atualizarProduto() {
  const produto = produtos[indiceAtual];
  document.getElementById("img-produto").src = produto.imagem;
  document.getElementById("img-produto").alt = produto.titulo;
  document.getElementById("titulo-produto").textContent = produto.titulo;
  document.getElementById("preco-produto").textContent = produto.preco;
  document.getElementById("desc-produto").textContent = produto.descricao;
}

function proximaImagem() {
  indiceAtual = (indiceAtual + 1) % produtos.length;
  // Animação simples com fade out/in
  const img = document.getElementById("img-produto");
  const titulo = document.getElementById("titulo-produto");
  const preco = document.getElementById("preco-produto");
  const desc = document.getElementById("desc-produto");

  [img, titulo, preco, desc].forEach(el => {
    el.style.opacity = "0";
    el.style.transform = "scale(0.95)";
  });

  setTimeout(() => {
    atualizarProduto();
    [img, titulo, preco, desc].forEach(el => {
      el.style.opacity = "1";
      el.style.transform = "scale(1)";
    });
  }, 300);
}

function Comprar() {
  alert("Você clicou em comprar: " + produtos[indiceAtual].titulo);
}

window.onload = () => {
  atualizarProduto();
};
function toggleMenu() {
  const nav = document.getElementById("navMenu");
  nav.classList.toggle("active");
}
function toggleMenu() {
  const nav = document.getElementById("navMenu");
  nav.classList.toggle("active");
}
