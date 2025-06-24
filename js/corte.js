// Efeito de rolagem suave para âncoras
document.querySelectorAll('a[href^="#"]').forEach(ancora => {
    ancora.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Efeito no cabeçalho ao rolar a página
window.addEventListener('scroll', function () {
    const cabecalho = document.querySelector('.cabecalho');
    if (window.scrollY > 50) {
        cabecalho.style.padding = '10px 0';
        cabecalho.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.2)';
    } else {
        cabecalho.style.padding = '15px 0';
        cabecalho.style.boxShadow = 'none';
    }
});

// Carregar Font Awesome para ícones
function carregarFontAwesome() {
    const linkFontAwesome = document.createElement('link');
    linkFontAwesome.rel = 'stylesheet';
    linkFontAwesome.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css';
    document.head.appendChild(linkFontAwesome);
}

// Carrossel de imagens
function iniciarCarrossel() {
    const carrossel = document.getElementById('carrossel');
    const btnAnterior = document.getElementById('btn-anterior');
    const btnProximo = document.getElementById('btn-proximo');
    const imagens = document.querySelectorAll('.carrossel img');

    let indiceAtual = 0;
    const totalImagens = imagens.length;

    function atualizarCarrossel() {
        const tamanhoImagem = imagens[0].clientWidth;
        carrossel.style.transform = `translateX(${-indiceAtual * tamanhoImagem}px)`;
    }

    btnProximo.addEventListener('click', () => {
        indiceAtual = (indiceAtual + 1) % totalImagens;
        atualizarCarrossel();
    });

    btnAnterior.addEventListener('click', () => {
        indiceAtual = (indiceAtual - 1 + totalImagens) % totalImagens;
        atualizarCarrossel();
    });

    // Auto-avanço a cada 5 segundos
    setInterval(() => {
        indiceAtual = (indiceAtual + 1) % totalImagens;
        atualizarCarrossel();
    }, 5000);

    // Ajustar ao redimensionar a janela
    window.addEventListener('resize', atualizarCarrossel);
}

// Quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', function () {
    carregarFontAwesome();
    iniciarCarrossel();

    // Adicionar classe ativa ao item de menu atual
    const urlAtual = window.location.pathname;
    const linksMenu = document.querySelectorAll('.navegacao-principal a');

    linksMenu.forEach(link => {
        if (link.getAttribute('href') === urlAtual) {
            link.classList.add('ativo');
        }
    });
});
