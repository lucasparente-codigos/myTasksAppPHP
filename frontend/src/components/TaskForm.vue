<script setup lang="ts">
import { ref } from 'vue';
import type { CreateTaskData } from '../services/api';

interface Props {
  loading?: boolean;
  error?: string | null;
}

withDefaults(defineProps<Props>(), {
  loading: false,
  error: null
});

const emit = defineEmits<{
  submit: [data: CreateTaskData];
}>();

const formData = ref<CreateTaskData>({
  title: '',
  description: '',
  priority: 'medium'
});

const handleSubmit = () => {
  if (!formData.value.title.trim()) return;
  
  emit('submit', { ...formData.value });
  
  // Limpar formulário
  formData.value = {
    title: '',
    description: '',
    priority: 'medium'
  };
};
</script>

<template>
  <div class="task-form-card">
    <h2 class="form-title">➕ Nova Tarefa</h2>
    
    <form @submit.prevent="handleSubmit" class="task-form">
      <div class="form-group">
        <input
          v-model="formData.title"
          type="text"
          placeholder="Título da tarefa"
          class="form-input"
          required
        />
      </div>

      <div class="form-group">
        <textarea
          v-model="formData.description"
          placeholder="Descrição (opcional)"
          rows="3"
          class="form-input"
        ></textarea>
      </div>

      <div class="form-group">
        <select v-model="formData.priority" class="form-input" required>
          <option value="high">🔴 Alta Prioridade</option>
          <option value="medium">🟡 Média Prioridade</option>
          <option value="low">🟢 Baixa Prioridade</option>
        </select>
      </div>

      <button 
        type="submit" 
        class="btn-submit"
        :disabled="loading"
      >
        {{ loading ? 'Adicionando...' : 'Adicionar Tarefa' }}
      </button>

      <p v-if="error" class="error-message">{{ error }}</p>
    </form>
  </div>
</template>

<style scoped>
.task-form-card {
  background: var(--card-bg);
  padding: 1.5rem;
  border-radius: 15px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.form-title {
  margin-bottom: 1.5rem;
  color: var(--text);
  font-size: 1.5rem;
}

.task-form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-input {
  width: 100%;
  padding: 0.875rem;
  border: 2px solid var(--border);
  border-radius: 8px;
  background: var(--bg);
  color: var(--text);
  font-size: 1rem;
  font-family: inherit;
  transition: border-color 0.2s ease;
}

.form-input:focus {
  outline: none;
  border-color: var(--primary);
}

.form-input::placeholder {
  color: var(--text-light);
}

textarea.form-input {
  resize: vertical;
  min-height: 80px;
}

.btn-submit {
  width: 100%;
  padding: 1rem;
  background: var(--success);
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
}

.btn-submit:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(72, 187, 120, 0.3);
}

.btn-submit:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.error-message {
  color: var(--danger);
  font-size: 0.9rem;
  text-align: center;
  margin-top: 0.5rem;
}
</style>
