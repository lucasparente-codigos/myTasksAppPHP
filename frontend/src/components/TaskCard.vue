<script setup lang="ts">
import { computed } from 'vue';
import type { Task } from '../services/api';

interface Props {
  task: Task;
}

const props = defineProps<Props>();

const emit = defineEmits<{
  toggle: [id: string];
  delete: [id: string];
  addPomodoro: [id: string];
}>();

const priorityLabel = computed(() => {
  const labels: Record<Task['priority'], string> = {
    high: '🔴 Alta',
    medium: '🟡 Média',
    low: '🟢 Baixa'
  };
  return labels[props.task.priority] || 'Média';
});

const formatDate = (dateString: string): string => {
  const date = new Date(dateString);
  return date.toLocaleDateString('pt-BR');
};
</script>

<template>
  <div 
    class="task-card" 
    :class="[task.priority, { completed: task.completed }]"
  >
    <div class="task-content">
      <h3 class="task-title" :class="{ 'line-through': task.completed }">
        {{ task.title }}
      </h3>
      <p v-if="task.description" class="task-description">
        {{ task.description }}
      </p>
      <div class="task-meta">
        <span class="meta-item">
          📅 {{ formatDate(task.created_at) }}
        </span>
        <span class="meta-item">
          🍅 {{ task.pomodoros }} pomodoros
        </span>
        <span class="meta-item priority-badge" :class="task.priority">
          {{ priorityLabel }}
        </span>
      </div>
    </div>

    <div class="task-actions">
      <button 
        @click="emit('addPomodoro', task.id)"
        class="btn btn-pomodoro"
        title="Completar Pomodoro"
      >
        🍅
      </button>
      <button 
        @click="emit('toggle', task.id)"
        class="btn btn-toggle"
        :title="task.completed ? 'Marcar como pendente' : 'Marcar como concluída'"
      >
        {{ task.completed ? '↩️' : '✓' }}
      </button>
      <button 
        @click="emit('delete', task.id)"
        class="btn btn-delete"
        title="Deletar tarefa"
      >
        🗑️
      </button>
    </div>
  </div>
</template>

<style scoped>
.task-card {
  background: var(--bg);
  padding: 1.25rem;
  border-radius: 12px;
  border-left: 4px solid;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1rem;
  transition: all 0.3s ease;
}

.task-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.task-card.high { border-color: var(--danger); }
.task-card.medium { border-color: var(--warning); }
.task-card.low { border-color: var(--success); }
.task-card.completed { opacity: 0.6; }

.task-content {
  flex: 1;
  min-width: 0;
}

.task-title {
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
  color: var(--text);
}

.line-through {
  text-decoration: line-through;
}

.task-description {
  color: var(--text-light);
  font-size: 0.9rem;
  margin-bottom: 0.75rem;
  line-height: 1.5;
}

.task-meta {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  font-size: 0.85rem;
}

.meta-item {
  color: var(--text-light);
}

.priority-badge {
  padding: 0.25rem 0.75rem;
  border-radius: 20px;
  font-weight: 500;
}

.priority-badge.high {
  background: rgba(245, 101, 101, 0.2);
  color: var(--danger);
}

.priority-badge.medium {
  background: rgba(237, 137, 54, 0.2);
  color: var(--warning);
}

.priority-badge.low {
  background: rgba(72, 187, 120, 0.2);
  color: var(--success);
}

.task-actions {
  display: flex;
  gap: 0.5rem;
  flex-shrink: 0;
}

.btn {
  padding: 0.5rem 0.75rem;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 1rem;
  transition: all 0.2s ease;
  background: var(--card-bg);
}

.btn:hover {
  transform: scale(1.1);
}

.btn-pomodoro {
  background: var(--primary);
  color: white;
}

.btn-toggle {
  background: var(--success);
  color: white;
}

.btn-delete {
  background: var(--danger);
  color: white;
}

@media (max-width: 640px) {
  .task-card {
    flex-direction: column;
    align-items: stretch;
  }

  .task-actions {
    justify-content: flex-end;
  }
}
</style>
