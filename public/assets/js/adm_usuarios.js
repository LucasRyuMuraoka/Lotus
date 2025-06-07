document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("usuario-form");
    const lista = document.getElementById("usuarios-lista");

    let usuarios = JSON.parse(localStorage.getItem("usuarios")) || [];
    let editandoIndex = null;

    function renderUsuarios() {
        lista.innerHTML = "";
        usuarios.forEach((usuario, index) => {
            const li = document.createElement("li");

            const span = document.createElement("span");
            span.textContent = `${usuario.nome} (${usuario.email}) - ${usuario.tipo}`;

            const acoes = document.createElement("div");
            acoes.classList.add("acoes");

            const editar = document.createElement("a");
            editar.href = "#";
            editar.classList.add("editar");
            editar.textContent = "Editar";
            editar.addEventListener("click", (e) => {
                e.preventDefault();
                carregarUsuario(index);
            });

            const excluir = document.createElement("a");
            excluir.href = "#";
            excluir.classList.add("excluir");
            excluir.textContent = "Excluir";
            excluir.addEventListener("click", (e) => {
                e.preventDefault();
                excluirUsuario(index);
            });

            acoes.appendChild(editar);
            acoes.appendChild(excluir);

            li.appendChild(span);
            li.appendChild(acoes);
            lista.appendChild(li);
        });
    }

    function carregarUsuario(index) {
        const usuario = usuarios[index];
        document.getElementById("nome-completo").value = usuario.nome;
        document.getElementById("email").value = usuario.email;
        document.getElementById("senha").value = usuario.senha;
        document.getElementById("confirmar-senha").value = usuario.senha;
        document.getElementById("tipo-usuario").value = usuario.tipo;
        editandoIndex = index;
    }

    function excluirUsuario(index) {
        if (confirm("Tem certeza que deseja excluir este usuário?")) {
            usuarios.splice(index, 1);
            salvar();
            renderUsuarios();
        }
    }

    function salvar() {
        localStorage.setItem("usuarios", JSON.stringify(usuarios));
    }

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const nome = document.getElementById("nome-completo").value.trim();
        const email = document.getElementById("email").value.trim();
        const senha = document.getElementById("senha").value;
        const confirmarSenha = document.getElementById("confirmar-senha").value;
        const tipo = document.getElementById("tipo-usuario").value;

        if (senha !== confirmarSenha) {
            alert("As senhas não coincidem.");
            return;
        }

        const novoUsuario = { nome, email, senha, tipo };

        if (editandoIndex !== null) {
            usuarios[editandoIndex] = novoUsuario;
            editandoIndex = null;
        } else {
            usuarios.push(novoUsuario);
        }

        salvar();
        renderUsuarios();
        form.reset();
    });

    renderUsuarios();
});
