# 🧱 BuildForge - Sistema de E-commerce de Hardware

## 📦 Descrição
BuildForge é um sistema de e-commerce voltado à venda de hardware e periféricos de computador. Desenvolvido com Laravel, o sistema conta com autenticação RBAC (admin/cliente), gestão de produtos, categorias com filtros, pedidos, integração com pagamento externo e geração de comprovantes em PDF.

---

## 🚀 Funcionalidades Principais

- Autenticação com Breeze e controle de acesso RBAC
- Cadastro e gerenciamento de produtos e categorias
- Filtro de produtos por categoria (placas de vídeo, processadores, memória RAM, etc)
- Carrinho de compras com itens e totalização
- Emissão de pedidos e acompanhamento de status
- Integração com sistema de pagamento externo (mock)
- Geração de comprovante PDF após pagamento
- Painel administrativo para gestão de produtos, categorias e pedidos
- Perfil do usuário para visualização, edição e exclusão

---

## 🧱 Modelos e Relacionamentos

- **User** (admin / cliente)
- **Produto** (pertence a Categoria)
- **Categoria** (possui muitos Produtos)
- **Pedido** (pertence a User, tem muitos Itens)
- **ItemPedido** (relaciona Produto com Pedido)
- **Comprovante** (relacionado a Pedido)

---

## 🛠️ Tecnologias Utilizadas

- Laravel 10+
- Laravel Breeze (Blade)
- Laravel Spatie Permission (RBAC)
- Vite + Tailwind (frontend leve)
- DomPDF (PDF de comprovantes)
- MySQL (XAMPP / MariaDB)

---

## 📚 Casos de Uso

- Autenticar-se como cliente ou administrador
- Explorar e filtrar produtos por categoria
- Adicionar produtos ao carrinho
- Finalizar pedido com pagamento
- Gerar comprovante PDF
- Acompanhar status do pedido
- Visualizar e editar perfil do usuário
- Admin gerenciar produtos, categorias e pedidos

---

## 🔧 Rotas Principais

- `/` - Página inicial pública
- `/produtos` - Listagem pública de produtos com filtro por categoria (`?categoria=ID`)
- `/carrinho` - Área do carrinho (clientes autenticados)
- `/dashboard` - Dashboard do cliente
- `/profile` - Visualização e edição do perfil do usuário (clientes e admins)
- `/admin/dashboard` - Painel administrativo para admins
- CRUD de produtos e categorias no painel admin

---
