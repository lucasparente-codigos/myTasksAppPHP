# 🤝 Guia de Contribuição

Obrigado por considerar contribuir com o myTasks! Este documento fornece diretrizes para contribuir com o projeto.

## 📋 Código de Conduta

- Seja respeitoso e inclusivo
- Aceite críticas construtivas
- Foque no que é melhor para a comunidade
- Mostre empatia com outros membros

## 🚀 Como Contribuir

### 1. Fork e Clone

```bash
# Fork no GitHub, depois:
git clone https://github.com/SEU-USUARIO/myTasksAppPHP.git
cd myTasksAppPHP
```

### 2. Crie uma Branch

```bash
# Para nova funcionalidade
git checkout -b feature/nome-da-funcionalidade

# Para correção de bug
git checkout -b fix/descricao-do-bug

# Para documentação
git checkout -b docs/melhoria-na-doc
```

### 3. Faça suas Alterações

Siga os padrões de código do projeto:

#### Backend (PHP)
```php
// Use PSR-12
class ExemploController {
    public function metodo() {
        // Código limpo e bem comentado
    }
}

// Sempre valide inputs
if (!isset($data['campo']) || empty($data['campo'])) {
    Response::error('Campo obrigatório', 422);
}
```

#### Frontend (Vue.js)
```vue
<script setup>
// Use Composition API
import { ref, computed } from 'vue';

// Comente lógica complexa
const filteredTasks = computed(() => {
  // Filtra tarefas por prioridade
  return tasks.value.filter(t => t.priority === 'high');
});
</script>

<style scoped>
/* Use CSS moderno e responsivo */
.card {
  /* ... */
}
</style>
```

### 4. Teste suas Alterações

#### Backend
```bash
# Teste manualmente com curl
curl http://localhost:8000/api/tasks

# Ou com ferramentas como Postman/Insomnia
```

#### Frontend
```bash
cd frontend
npm run dev

# Teste em diferentes navegadores
# Teste responsividade (mobile/tablet/desktop)
```

### 5. Commit

Use [Conventional Commits](https://www.conventionalcommits.org/):

```bash
# Formato: <tipo>(<escopo>): <descrição>

git commit -m "feat(tasks): adiciona filtro por data"
git commit -m "fix(api): corrige validação de prioridade"
git commit -m "docs(readme): atualiza instruções de setup"
git commit -m "refactor(controller): melhora legibilidade"
git commit -m "style(css): ajusta espaçamento do card"
```

#### Tipos de Commit

- `feat`: Nova funcionalidade
- `fix`: Correção de bug
- `docs`: Documentação
- `style`: Formatação (CSS, código)
- `refactor`: Refatoração
- `test`: Testes
- `chore`: Tarefas gerais
- `perf`: Melhoria de performance

#### Emojis Recomendados

- ✨ `:sparkles:` - Nova feature
- 🐛 `:bug:` - Bug fix
- 📝 `:memo:` - Documentação
- ♻️ `:recycle:` - Refatoração
- 🎨 `:art:` - Melhoria de UI/UX
- 🚀 `:rocket:` - Performance
- 🔒 `:lock:` - Segurança
- ✅ `:white_check_mark:` - Testes

### 6. Push e Pull Request

```bash
git push origin feature/nome-da-funcionalidade
```

Depois, abra um Pull Request no GitHub com:

- **Título claro**: ex: "Adiciona sistema de filtros"
- **Descrição detalhada**: O que foi feito e por quê
- **Screenshots**: Se houver mudanças visuais
- **Checklist**: Use o template abaixo

## 📝 Template de Pull Request

```markdown
## Descrição
Descreva suas alterações em detalhes.

## Tipo de Mudança
- [ ] Bug fix (mudança que corrige um problema)
- [ ] Nova feature (mudança que adiciona funcionalidade)
- [ ] Breaking change (mudança que quebra compatibilidade)
- [ ] Documentação

## Como Testar
1. Passo 1
2. Passo 2
3. ...

## Checklist
- [ ] Código segue o padrão do projeto
- [ ] Código foi testado localmente
- [ ] Documentação foi atualizada (se necessário)
- [ ] Não quebra funcionalidades existentes
- [ ] Commits seguem Conventional Commits

## Screenshots (se aplicável)
[Adicione screenshots aqui]
```

## 🐛 Reportando Bugs

Use o template de issue:

```markdown
## Descrição do Bug
Descrição clara do problema.

## Para Reproduzir
1. Vá para '...'
2. Clique em '....'
3. Veja o erro

## Comportamento Esperado
O que deveria acontecer.

## Screenshots
Se aplicável.

## Ambiente
- OS: [ex: Windows 10]
- Browser: [ex: Chrome 120]
- PHP Version: [ex: 8.2]
- Node Version: [ex: 20.0]
```

## 💡 Sugerindo Features

```markdown
## Descrição da Feature
Descrição clara da funcionalidade.

## Problema que Resolve
Qual problema esta feature resolve?

## Solução Proposta
Como você imagina que funcione?

## Alternativas Consideradas
Outras formas de resolver?

## Contexto Adicional
Informações extras, mockups, etc.
```

## 📚 Áreas para Contribuir

### 🔰 Bom para Iniciantes
- Melhorar documentação
- Adicionar comentários no código
- Corrigir typos
- Melhorar mensagens de erro
- Adicionar testes simples

### 🎨 Design/Frontend
- Melhorar UI/UX
- Adicionar animações
- Melhorar responsividade
- Criar componentes reutilizáveis
- Otimizar CSS

### ⚙️ Backend
- Adicionar validações
- Melhorar performance
- Implementar cache
- Adicionar logs
- Refatorar código

### 🚀 Features Avançadas
- Sistema de busca
- Autenticação
- Integração com APIs externas
- PWA
- Testes automatizados

## 🔍 Revisão de Código

Todos os PRs passam por revisão. Esperamos:

- Código limpo e legível
- Comentários quando necessário
- Testes (quando aplicável)
- Documentação atualizada
- Sem breaking changes (sem aviso prévio)

## 🎯 Prioridades do Projeto

1. **Alta**: Bugs críticos, segurança
2. **Média**: Novas features, melhorias
3. **Baixa**: Refatorações, otimizações

## 💬 Comunicação

- **Issues**: Para bugs e features
- **Discussions**: Para perguntas gerais
- **Pull Requests**: Para código

## 🏆 Reconhecimento

Contribuidores são adicionados automaticamente:
- README.md (seção de contribuidores)
- CONTRIBUTORS.md

## ❓ Dúvidas?

- Abra uma issue com a tag `question`
- Entre em contato: [seu-email]

## 📖 Recursos

- [Vue.js Docs](https://vuejs.org/)
- [PHP Best Practices](https://phptherightway.com/)
- [REST API Design](https://restfulapi.net/)
- [Conventional Commits](https://www.conventionalcommits.org/)

---

**Obrigado por contribuir! 🎉**
