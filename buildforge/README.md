# 🧱 BuildForge - Sistema de E-commerce de Hardware

## 📦 Descrição
BuildForge é um sistema de e-commerce voltado à venda de hardware e periféricos de computador. Desenvolvido com Laravel, o sistema conta com autenticação RBAC (admin/cliente), gestão de produtos, categorias com filtros, pedidos, integração com pagamento Mercado Pago e geração de comprovantes em PDF.

---

## 🚀 Funcionalidades Principais

- Autenticação com Breeze e controle de acesso RBAC
- Cadastro e gerenciamento de produtos e categorias
- Filtro de produtos por categoria (placas de vídeo, processadores, memória RAM, etc)
- Carrinho de compras com itens e totalização
- Emissão de pedidos e acompanhamento de status
- Integração com **Mercado Pago** (modo sandbox e produção)
- Geração de comprovante PDF após pagamento
- Página de detalhes do produto com **diferenciais**, **dicas de uso** e **especificações técnicas**
- Sistema de **newsletter** com envio de **ofertas promocionais**
- Painel administrativo para gestão de produtos, categorias e pedidos
- Perfil do usuário para visualização, edição e exclusão
- Estilização moderna com **Tailwind CSS**

---

## 🧱 Modelos e Relacionamentos

- **User** (admin / cliente)
- **Produto** (pertence a Categoria; possui ficha técnica e detalhes)
- **Categoria** (possui muitos Produtos)
- **Pedido** (pertence a User, tem muitos Itens)
- **ItemPedido** (relaciona Produto com Pedido)
- **Comprovante** (relacionado a Pedido)
- **Newsletter** (cadastro de e-mails)
- **DetalheProduto** (1:1 com Produto)

---

## 🛠️ Tecnologias Utilizadas

- Laravel 10+
- Laravel Breeze (Blade)
- Laravel Spatie Permission (RBAC)
- Tailwind CSS + Vite (frontend moderno)
- Mercado Pago API REST (pagamentos)
- DomPDF (geração de PDFs)
- MySQL (XAMPP / MariaDB)

---

## 📚 Casos de Uso

- Autenticar-se como cliente ou administrador
- Explorar e filtrar produtos por categoria
- Visualizar produtos com ficha técnica detalhada
- Adicionar produtos ao carrinho
- Finalizar pedido com pagamento via Mercado Pago
- Gerar comprovante PDF
- Acompanhar status do pedido
- Assinar newsletter e receber ofertas
- Visualizar e editar perfil do usuário
- Admin gerenciar produtos, categorias e pedidos

---

## 🔧 Rotas Principais

- `/` - Página inicial pública
- `/produtos` - Listagem pública de produtos com filtro por categoria (`?categoria=ID`)
- `/produtos/{id}` - Página de detalhes do produto (com ficha técnica)
- `/carrinho` - Carrinho de compras (clientes autenticados)
- `/dashboard` - Dashboard do cliente
- `/profile` - Visualização e edição do perfil do usuário
- `/admin/dashboard` - Painel administrativo para admins
- `/admin/produtos` - CRUD de produtos (admin)
- `/admin/categorias` - CRUD de categorias (admin)
- `/admin/pedidos` - Gestão de pedidos (admin)
- `/newsletter` - Cadastro de e-mails para ofertas
- `/pagamento/falha|sucesso|pendente` - Rotas de retorno do Mercado Pago

---

## 🧪 Testes com Sandbox Mercado Pago

- A integração suporta modo **sandbox**, usando usuários e tokens de teste.

---

