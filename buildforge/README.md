# 🧱 BuildForge - Sistema de E-commerce de Hardware

## 📦 Descrição
BuildForge é um sistema de e-commerce voltado à venda de hardware e periféricos de computador. Desenvolvido com Laravel, o sistema conta com autenticação RBAC (admin/cliente), gestão de produtos, pedidos, integração com pagamento externo e geração de comprovantes em PDF.

---

## 🚀 Funcionalidades Principais

- Autenticação com Breeze e controle de acesso RBAC
- Cadastro e gerenciamento de produtos e categorias
- Carrinho de compras com itens e totalização
- Emissão de pedidos e acompanhamento de status
- Integração com sistema de pagamento externo (mock)
- Geração de comprovante PDF após pagamento
- Painel administrativo para gestão de pedidos

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
- Explorar e filtrar produtos
- Adicionar produtos ao carrinho
- Finalizar pedido com pagamento
- Gerar comprovante PDF
- Acompanhar status do pedido
- Admin gerenciar produtos e pedidos

---