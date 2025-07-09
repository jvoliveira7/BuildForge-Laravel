# 🧱 BuildForge - Sistema de E-commerce de Hardware

## 📦 Descrição
BuildForge é um sistema de e-commerce focado na venda de hardware e periféricos para computadores. Desenvolvido com Laravel, o sistema possui autenticação com controle de acesso baseado em papéis (RBAC), gestão completa de produtos e categorias com filtros, pedidos, integração com Mercado Pago e geração automática de comprovantes em PDF.

---

## 🚀 Funcionalidades Principais

- Autenticação com Laravel Breeze e controle RBAC (admin/cliente)
- Cadastro e gerenciamento de produtos e categorias
- Filtro de produtos por categoria (placas de vídeo, processadores, memória RAM, etc.)
- Carrinho de compras com itens e totalização automática
- Emissão e acompanhamento de pedidos por status
- Integração com **Mercado Pago** (modos sandbox e produção)
- Geração automática de comprovantes em PDF após pagamento
- Página detalhada do produto com diferenciais, dicas de uso e especificações técnicas
- Sistema de newsletter para envio de ofertas promocionais
- Painel administrativo para gestão completa (produtos, categorias, pedidos)
- Perfil do usuário com visualização, edição e exclusão
- Layout moderno e responsivo com **Tailwind CSS**

---

## 🧱 Modelos e Relacionamentos

- **User** (roles: admin / cliente)
- **Produto** (pertence a uma Categoria; possui ficha técnica e detalhes adicionais)
- **Categoria** (possui vários Produtos)
- **Pedido** (pertence a um User; possui muitos Itens)
- **ItemPedido** (relaciona Produto a Pedido)
- **Comprovante** (associado a Pedido)
- **Newsletter** (armazenamento de e-mails para ofertas)
- **DetalheProduto** (relação 1:1 com Produto)

---

## 🛠️ Tecnologias Utilizadas

- Laravel 10+
- Laravel Breeze (Blade)
- Spatie Permission (RBAC)
- Tailwind CSS + Vite
- Mercado Pago API REST (pagamentos)
- DomPDF (geração de PDFs)
- MySQL / MariaDB (via XAMPP)

---

## 📚 Casos de Uso

- Login e controle de acesso para clientes e administradores
- Explorar, buscar e filtrar produtos por categoria
- Visualizar página detalhada com ficha técnica completa
- Adicionar produtos ao carrinho e revisar pedido
- Finalizar pedido com pagamento via Mercado Pago
- Receber comprovante em PDF após pagamento confirmado
- Acompanhar status do pedido em tempo real
- Assinar newsletter para receber promoções exclusivas
- Gerenciar perfil pessoal (visualização, edição, exclusão)
- Administração completa via painel para produtos, categorias e pedidos

---

## 🔧 Rotas Principais

- `/` — Página inicial pública
- `/produtos` — Listagem pública de produtos (com filtro por categoria: `?categoria=ID`)
- `/produtos/{id}` — Página de detalhes do produto
- `/carrinho` — Carrinho de compras (clientes autenticados)
- `/dashboard` — Dashboard do cliente
- `/profile` — Perfil do usuário (visualização e edição)
- `/admin/dashboard` — Painel administrativo (admins)
- `/admin/produtos` — CRUD de produtos (admin)
- `/admin/categorias` — CRUD de categorias (admin)
- `/admin/pedidos` — Gestão de pedidos (admin)
- `/newsletter` — Cadastro para newsletter
- `/pagamento/falha|sucesso|pendente` — Retornos do Mercado Pago

---

## 🧪 Testes com Sandbox Mercado Pago

- Suporte total ao modo sandbox para testes com usuários e tokens simulados.

---

## ▶️ Como Rodar o Projeto

### ✅ Pré-requisitos
- Ngrok para gateway com api 
- PHP 8.1 ou superior
- Composer
- MySQL ou MariaDB
- Node.js + NPM
- Laravel CLI
- Extensões PHP: `openssl`, `pdo`, `mbstring`, `tokenizer`, `xml`, `fileinfo`

### ⚙️ Passos para Instalação

1. **Clone o repositório:**

```bash
git clone https://github.com/seu-usuario/buildforge.git
cd buildforge
```

2. **Instale as dependências PHP:**

```bash
composer install
```

3. **Instale as dependências do frontend:**

```bash
npm install && npm run dev
```

4. **Crie o arquivo `.env`:**

```bash
cp .env.example .env
```

5. **Configure seu banco de dados no `.env`:**

```env
DB_DATABASE=buildforge
DB_USERNAME=root
DB_PASSWORD=
```

6. **Gere a chave da aplicação e rode as migrations + seeders:**

```bash
php artisan key:generate
php artisan migrate --seed
```

7. **Inicie o servidor local:**

```bash
php artisan serve
```

8. **Inicie o ngrok para funcionamento da api gateway com api de pagamento:**
ngrok http 80 

9. **Adicione no final do env o https gerado pelo cmd do ngrok:**  
EX: NGROK_URL=https://1234esdffsf.ngrok-free.app 


10. **Acesse em:**  
[http://127.0.0.1:8000](http://127.0.0.1:8000)

---
