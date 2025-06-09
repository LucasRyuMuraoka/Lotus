document.addEventListener('DOMContentLoaded', function () {
    // Elementos relacionados às abas
    const tabButtons = document.querySelectorAll('.account-tab-btn');
    const tabContents = document.querySelectorAll('.account-tab-content');

    // Máscaras para os campos
    const cpfInput = document.getElementById('cpf');
    const telefoneInput = document.getElementById('telefone');

    // Validação de formulário
    const profileForm = document.querySelector('.profile-form');
    const submitButton = profileForm.querySelector('button[type="submit"]');
    const cancelButton = profileForm.querySelector('.btn-secondary');

    // Botão de exclusão de conta
    const deleteButton = document.querySelector('.btn-delete');
    if (deleteButton) {
        deleteButton.addEventListener('click', function () {
            // Criar um modal de confirmação
            const modal = document.createElement('div');
            modal.className = 'confirmation-modal';
            modal.innerHTML = `
          <div class="modal-content">
            <h3>Tem certeza que deseja excluir sua conta?</h3>
            <p>Esta ação não pode ser desfeita. Todos os seus dados e histórico de pedidos serão removidos permanentemente.</p>
            <div class="modal-actions">
              <button class="btn-secondary modal-cancel">Cancelar</button>
              <button class="btn-danger modal-confirm">Excluir conta</button>
            </div>
          </div>
        `;

            // Adicionar modal ao DOM
            document.body.appendChild(modal);

            // Adicionar eventos aos botões
            modal.querySelector('.modal-cancel').addEventListener('click', function () {
                modal.remove();
            });

            modal.querySelector('.modal-confirm').addEventListener('click', function () {
                // Aqui seria a lógica para excluir a conta
                showNotification('Conta excluída com sucesso.', 'success');
                modal.remove();

                // Redirecionar para a página inicial após um tempo
                setTimeout(() => {
                    window.location.href = 'home.html';
                }, 2000);
            });

            // Fechar ao clicar fora do modal
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    modal.remove();
                }
            });
        });
    }

    // Função para exibir notificações
    function showNotification(message, type = 'info') {
        // Verificar se já existe uma notificação e removê-la
        const existingNotification = document.querySelector('.notification');
        if (existingNotification) {
            existingNotification.remove();
        }

        // Criar elemento de notificação
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;

        // Adicionar ao DOM
        document.body.appendChild(notification);

        // Mostrar com animação
        setTimeout(() => {
            notification.classList.add('show');
        }, 10);

        // Remover após 3 segundos
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }

    // Gerenciamento das abas (funcionalidade mantida para compatibilidade com outras páginas)
    tabButtons.forEach(button => {
        button.addEventListener('click', function () {
            const tabId = this.getAttribute('data-tab');

            // Não aplicar lógica de abas se o botão contém um link
            if (this.querySelector('a')) {
                return;
            }

            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Add active class to current button and content
            this.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Máscaras para inputs
    if (cpfInput) {
        cpfInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 11) value = value.slice(0, 11);

            // Formata o CPF
            if (value.length > 9) {
                value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d{0,2}).*/, '$1.$2.$3-$4');
            } else if (value.length > 6) {
                value = value.replace(/^(\d{3})(\d{3})(\d{0,3}).*/, '$1.$2.$3');
            } else if (value.length > 3) {
                value = value.replace(/^(\d{3})(\d{0,3}).*/, '$1.$2');
            }

            e.target.value = value;
        });
    }

    if (telefoneInput) {
        telefoneInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 11) value = value.slice(0, 11);

            // Formata o telefone
            if (value.length > 10) {
                value = value.replace(/^(\d{2})(\d{5})(\d{0,4}).*/, '($1) $2-$3');
            } else if (value.length > 6) {
                value = value.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
            } else if (value.length > 2) {
                value = value.replace(/^(\d{2})(\d{0,5}).*/, '($1) $2');
            }

            e.target.value = value;
        });
    }

    // Verificação de força de senha
    const novaSenhaInput = document.getElementById('nova-senha');
    if (novaSenhaInput) {
        novaSenhaInput.addEventListener('input', function () {
            checkPasswordStrength(this.value);
        });
    }

    function checkPasswordStrength(password) {
        // Elemento para mostrar a força da senha (cria se não existir)
        let strengthIndicator = document.querySelector('.password-strength');
        if (!strengthIndicator) {
            strengthIndicator = document.createElement('div');
            strengthIndicator.className = 'password-strength';
            novaSenhaInput.parentNode.appendChild(strengthIndicator);
        }

        // Limpar se a senha estiver vazia
        if (!password) {
            strengthIndicator.className = 'password-strength';
            strengthIndicator.textContent = '';
            return;
        }

        // Calcular força da senha
        let strength = 0;

        // Comprimento mínimo
        if (password.length >= 8) strength += 1;

        // Letras minúsculas e maiúsculas
        if (/[a-z]/.test(password)) strength += 1;
        if (/[A-Z]/.test(password)) strength += 1;

        // Números e caracteres especiais
        if (/[0-9]/.test(password)) strength += 1;
        if (/[^a-zA-Z0-9]/.test(password)) strength += 1;

        // Atualizar indicador
        strengthIndicator.className = 'password-strength';
        if (strength < 2) {
            strengthIndicator.classList.add('weak');
            strengthIndicator.textContent = 'Fraca';
        } else if (strength < 4) {
            strengthIndicator.classList.add('medium');
            strengthIndicator.textContent = 'Média';
        } else {
            strengthIndicator.classList.add('strong');
            strengthIndicator.textContent = 'Forte';
        }
    }

    // Botão de cancelar
    if (cancelButton) {
        cancelButton.addEventListener('click', function (e) {
            e.preventDefault();

            // Perguntar ao usuário se deseja descartar as alterações
            const modal = document.createElement('div');
            modal.className = 'confirmation-modal';
            modal.innerHTML = `
          <div class="modal-content">
            <h3>Descartar alterações?</h3>
            <p>Todas as alterações não salvas serão perdidas.</p>
            <div class="modal-actions">
              <button class="btn-secondary modal-cancel">Continuar editando</button>
              <button class="btn-primary modal-confirm">Descartar alterações</button>
            </div>
          </div>
        `;

            // Adicionar modal ao DOM
            document.body.appendChild(modal);

            // Adicionar eventos aos botões
            modal.querySelector('.modal-cancel').addEventListener('click', function () {
                modal.remove();
            });

            modal.querySelector('.modal-confirm').addEventListener('click', function () {
                modal.remove();
                // Redirecionar para a página de pedidos
                window.location.href = 'conta.html';
            });

            // Fechar ao clicar fora do modal
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    modal.remove();
                }
            });
        });
    }

    // Validação de formulário
    if (profileForm) {
        profileForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Validação dos campos
            const nome = document.getElementById('nome').value.trim();
            const cpf = document.getElementById('cpf').value.trim();
            const email = document.getElementById('email').value.trim();
            const senhaAtual = document.getElementById('senha-atual').value;
            const novaSenha = document.getElementById('nova-senha').value;
            const confirmarSenha = document.getElementById('confirmar-senha').value;

            // Verificações básicas
            if (!nome || !cpf || !email) {
                showNotification('Preencha todos os campos obrigatórios.', 'error');
                return;
            }

            // Validação de email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showNotification('Por favor, insira um e-mail válido.', 'error');
                return;
            }

            // Validação de senhas (apenas se o usuário estiver tentando alterar a senha)
            if (novaSenha || confirmarSenha || senhaAtual) {
                if (!senhaAtual) {
                    showNotification('Informe sua senha atual para alterá-la.', 'error');
                    return;
                }

                if (novaSenha !== confirmarSenha) {
                    showNotification('As senhas não coincidem.', 'error');
                    return;
                }

                if (novaSenha.length < 8) {
                    showNotification('A senha deve ter pelo menos 8 caracteres.', 'error');
                    return;
                }
            }

            // Adicionar uma classe para indicar o envio do formulário
            submitButton.classList.add('loading');
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner"></span> Salvando...';

            // Simular uma requisição ao servidor (apenas para demonstração)
            setTimeout(() => {
                submitButton.classList.remove('loading');
                submitButton.disabled = false;
                submitButton.textContent = 'Salvar alterações';

                // Simulação de envio bem-sucedido
                showNotification('Dados atualizados com sucesso!', 'success');
            }, 1500);

            // Em um caso real, aqui seria feita uma requisição ao servidor
            // fetch('/api/updateProfile', {
            //   method: 'POST',
            //   headers: { 'Content-Type': 'application/json' },
            //   body: JSON.stringify(formData)
            // }).then(...)
        });
    }
});
