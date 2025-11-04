# 🚀 myTasks - Gerenciador Inteligente de Tarefas

![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Vue.js](https://img.shields.io/badge/Vue.js-3.x-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-5.x-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

Sistema modular de gerenciamento de tarefas com **backend em PHP** (REST API) e **frontend em Vue.js 3**. Desenvolvido com arquitetura limpa e preparado para escalar.

## ✨ Funcionalidades

- ✅ **CRUD Completo** de tarefas
- 🎯 **Sistema de Prioridades** (Alta, Média, Baixa)
- 🍅 **Timer Pomodoro** integrado
- 📊 **Dashboard com Estatísticas** em tempo real
- 🌓 **Tema Dark/Light** persistente
- 📱 **Design Responsivo** mobile-first
- 💾 **Persistência JSON** (fácil migração para BD)
- 🔄 **API RESTful** completa

## 🎥 Demo

```
🚧 Em breve: screenshots e demo online
```

## 📁 Estrutura do Projeto

```
mytasks/
├── backend/                    # API REST em PHP
│   ├── controllers/           # Lógica de negócio
│   ├── models/               # Modelos de dados
│   ├── routes/               # Roteamento da API
│   ├── utils/                # Utilitários
│   └── data/                 # Persistência JSON
│
└── frontend/                  # Vue.js 3 + Vite
    ├── src/
    │   ├── components/       # Componentes Vue
    │   ├── composables/      # Lógica reutilizável
    │   └── services/         # Camada de API
    └── public/
```

## 🚀 Como Rodar

### Pré-requisitos

- **PHP 8.0+**
- **Node.js 18+** e npm
- Git

### 1. Clone o repositório

```bash
git clone https://github.com/lucasparente-codigos/myTasksAppPHP.git
cd myTasksAppPHP
```

### 2. Inicie o Backend (Terminal 1)

```bash
cd backend
php -S localhost:8000
```

🌐 API disponível em: `http://localhost:8000`

### 3. Inicie o Frontend (Terminal 2)

```bash
cd frontend
npm install
npm run dev
```

🌐 App disponível em: `http://localhost:3000`

## 📡 Endpoints da API

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| `GET` | `/api/tasks` | Listar todas as tarefas |
| `GET` | `/api/tasks/{id}` | Buscar tarefa por ID |
| `GET` | `/api/tasks/stats` | Obter estatísticas |
| `POST` | `/api/tasks` | Criar nova tarefa |
| `PUT` | `/api/tasks/{id}` | Atualizar tarefa |
| `DELETE` | `/api/tasks/{id}` | Deletar tarefa |
| `POST` | `/api/tasks/{id}/toggle` | Alternar status |
| `POST` | `/api/tasks/{id}/pomodoro` | Adicionar pomodoro |

### Exemplo de uso

```bash
# Criar tarefa
curl -X POST http://localhost:8000/api/tasks \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Estudar Vue.js",
    "description": "Completar tutorial oficial",
    "priority": "high"
  }'
```

## 🏗️ Arquitetura

### Backend (MVC Pattern)

```
┌─────────────┐
│   Routes    │  ← Define endpoints
└──────┬──────┘
       │
┌──────▼──────┐
│ Controllers │  ← Lógica de negócio
└──────┬──────┘
       │
┌──────▼──────┐
│   Models    │  ← Manipulação de dados
└──────┬──────┘
       │
┌──────▼──────┐
│  JSON File  │  ← Persistência
└─────────────┘
```

### Frontend (Composition API)

```
┌──────────────┐
│  Components  │  ← UI/Componentes Vue
└──────┬───────┘
       │
┌──────▼───────┐
│ Composables  │  ← Lógica compartilhada
└──────┬───────┘
       │
┌──────▼───────┐
│   Services   │  ← Chamadas HTTP
└──────┬───────┘
       │
┌──────▼───────┐
│   REST API   │  ← Backend PHP
└──────────────┘
```

## 🛠️ Tecnologias

### Backend
- **PHP 8+** - Linguagem backend
- **REST API** - Arquitetura de comunicação
- **JSON** - Persistência de dados

### Frontend
- **Vue.js 3** - Framework progressivo
- **Composition API** - Padrão moderno
- **Vite** - Build tool ultrarrápido
- **CSS Variables** - Tema dinâmico

## 📈 Roadmap

### ✅ Fase 1 - MVP (Concluído)
- [x] CRUD de tarefas
- [x] Sistema de prioridades
- [x] Pomodoro básico
- [x] Dashboard com stats
- [x] Tema dark/light

### 🚧 Fase 2 - Funcionalidades Avançadas (Em andamento)
- [ ] Sistema de busca e filtros
- [ ] Tags e categorias
- [ ] Ordenação drag-and-drop
- [ ] Exportar/Importar dados
- [ ] Timer Pomodoro com contador visual

### 🔮 Fase 3 - Escalabilidade
- [ ] Autenticação JWT
- [ ] Multi-usuário
- [ ] Migração para MySQL/PostgreSQL
- [ ] PWA (funciona offline)
- [ ] Notificações push

### 🎨 Fase 4 - Inovação
- [ ] Integração Google Calendar
- [ ] Gráficos de produtividade
- [ ] IA para sugestões inteligentes
- [ ] API pública documentada (Swagger)
- [ ] Mobile app (React Native)

## 🤝 Como Contribuir

Contribuições são muito bem-vindas! 

1. Fork o projeto
2. Crie uma branch: `git checkout -b feature/nova-funcionalidade`
3. Commit suas mudanças: `git commit -m '✨ Adiciona nova funcionalidade'`
4. Push para a branch: `git push origin feature/nova-funcionalidade`
5. Abra um Pull Request

### Convenção de Commits

Usamos [Conventional Commits](https://www.conventionalcommits.org/):

- ✨ `feat:` Nova funcionalidade
- 🐛 `fix:` Correção de bug
- 📝 `docs:` Documentação
- ♻️ `refactor:` Refatoração
- 🎨 `style:` Formatação
- ✅ `test:` Testes
- 🚀 `perf:` Performance

## 📚 Documentação Adicional

- [Guia de Início Rápido](QUICK_START.md)
- [Comandos Git](COMANDOS_GIT.md)
- [Documentação da API](#) (em breve)

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 👨‍💻 Autor

**Lucas Parente**

- GitHub: [@lucasparente-codigos](https://github.com/lucasparente-codigos)
- LinkedIn: [Seu LinkedIn](#) (opcional)

## 🙏 Agradecimentos

- Vue.js Team pela excelente documentação
- Comunidade PHP
- Todos os contribuidores

---

<div align="center">

**Desenvolvido com ❤️ para aprendizado e prática de desenvolvimento full-stack**

⭐ Se este projeto te ajudou, considere dar uma estrela!

[🐛 Reportar Bug](https://github.com/lucasparente-codigos/myTasksAppPHP/issues) • [✨ Sugerir Feature](https://github.com/lucasparente-codigos/myTasksAppPHP/issues)

</div>
