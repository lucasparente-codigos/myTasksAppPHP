<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useTasks } from './composables/useTasks';
import TaskCard from './components/TaskCard.vue';
import TaskForm from './components/TaskForm.vue';
import type { CreateTaskData } from './services/api';

const theme = ref<'light' | 'dark'>(
  (localStorage.getItem('theme') as 'light' | 'dark') || 'light'
);

const {
  tasks,
  stats,
  loading,
  error,
  fetchTasks,
  fetchStats,
  createTask,
  toggleTask,
  deleteTask,
  addPomodoro,
} = useTasks();

onMounted(async () => {
  await fetchTasks();
  await fetchStats();
});

const handleCreateTask = async (taskData: CreateTaskData) => {
  try {
    await createTask(taskData);
  } catch (err) {
    console.error('Error creating task:', err);
  }
};

const handleToggle = async (id: string) => {
  try {
    await toggleTask(id);
  } catch (err) {
    console.error('Error toggling task:', err);
  }
};

const handleDelete = async (id: string) => {
  if (confirm('Tem certeza que deseja deletar esta tarefa?')) {
    try {
      await deleteTask(id);
    } catch (err) {
      console.error('Error deleting task:', err);
    }
  }
};

const handleAddPomodoro = async (id: string) => {
  try {
    await addPomodoro(id);
  } catch (err) {
    console.error('Error adding pomodoro:', err);
  }
};

const toggleTheme = () => {
  theme.value = theme.value === 'light' ? 'dark' : 'light';
  localStorage.setItem('theme', theme.value);
};

const getProgressMessage = (): string => {
  if (!stats.value) return '';
  const rate = stats.value.completion_rate;
  
  if (rate === 100 && stats.value.total > 0) {
    return '🎉 Parabéns! Todas as tarefas concluídas!';
  } else if (rate >= 75) {
    return '💪 Você está quase lá!';
  } else if (rate >= 50) {
    return '👍 Continue assim!';
  } else {
    return '🎯 Vamos começar!';
  }
};
</script>

<template>
  <div id="app" :data-theme="theme">
    <div class="container">
      <!-- Header -->
      <header class="app-header">
        <div class="header-content">
          <div>
            <h1 class="app-title">🚀 myTasks</h1>
            <p class="app-subtitle">Gerenciador Inteligente de Tarefas</p>
          </div>

          <div class="stats-container">
            <div v-if="stats" class="stat-card">
              <div class="stat-value">{{ stats.total }}</div>
              <div class="stat-label">Total</div>
            </div>
            <div v-if="stats" class="stat-card">
              <div class="stat-value">{{ stats.completed }}/{{ stats.total }}</div>
              <div class="stat-label">Concluídas</div>
            </div>
            <div v-if="stats" class="stat-card">
              <div class="stat-value">{{ stats.completion_rate }}%</div>
              <div class="stat-label">Progresso</div>
            </div>
            <button @click="toggleTheme" class="theme-toggle">
              {{ theme === 'light' ? '🌙' : '☀️' }} Tema
            </button>
          </div>
        </div>
      </header>

      <!-- Dashboard -->
      <div class="dashboard">
        <!-- Form -->
        <TaskForm 
          :loading="loading"
          :error="error"
          @submit="handleCreateTask"
        />

        <!-- Progress Card -->
        <div class="card" v-if="stats">
          <h2 class="card-title">📊 Progresso</h2>
          <div class="progress-bar">
            <div 
              class="progress-fill" 
              :style="{ width: stats.completion_rate + '%' }"
            >
              {{ stats.completion_rate }}%
            </div>
          </div>
          <p class="progress-message">
            {{ getProgressMessage() }}
          </p>
        </div>
      </div>

      <!-- Tasks List -->
      <div class="card tasks-section">
        <h2 class="card-title">📝 Minhas Tarefas</h2>
        
        <div v-if="loading && tasks.length === 0" class="loading">
          Carregando tarefas...
        </div>

        <div v-else-if="tasks.length === 0" class="empty-state">
          <p>Nenhuma tarefa criada ainda.</p>
          <p>Adicione sua primeira tarefa! 🎯</p>
        </div>

        <div v-else class="tasks-list">
          <TaskCard
            v-for="task in tasks"
            :key="task.id"
            :task="task"
            @toggle="handleToggle"
            @delete="handleDelete"
            @add-pomodoro="handleAddPomodoro"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<style>
:root[data-theme="light"] {
  --bg: #f5f7fa;
  --card-bg: #ffffff;
  --text: #2d3748;
  --text-light: #718096;
  --border: #e2e8f0;
  --primary: #4299e1;
  --success: #48bb78;
  --warning: #ed8936;
  --danger: #f56565;
}

:root[data-theme="dark"] {
  --bg: #1a202c;
  --card-bg: #2d3748;
  --text: #e2e8f0;
  --text-light: #a0aec0;
  --border: #4a5568;
  --primary: #63b3ed;
  --success: #68d391;
  --warning: #f6ad55;
  --danger: #fc8181;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: var(--bg);
  color: var(--text);
  line-height: 1.6;
  transition: all 0.3s ease;
}

#app {
  min-height: 100vh;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 1.5rem;
}

.app-header {
  background: var(--card-bg);
  padding: 1.5rem;
  border-radius: 15px;
  margin-bottom: 2rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.header-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1.5rem;
}

.app-title {
  color: var(--primary);
  font-size: 2rem;
  margin-bottom: 0.25rem;
}

.app-subtitle {
  color: var(--text-light);
  font-size: 0.95rem;
}

.stats-container {
  display: flex;
  gap: 1rem;
  align-items: center;
  flex-wrap: wrap;
}

.stat-card {
  padding: 0.75rem 1.25rem;
  background: var(--bg);
  border-radius: 10px;
  text-align: center;
}

.stat-value {
  font-size: 1.5rem;
  font-weight: bold;
  color: var(--primary);
}

.stat-label {
  font-size: 0.85rem;
  color: var(--text-light);
}

.theme-toggle {
  padding: 0.75rem 1.25rem;
  background: var(--primary);
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  cursor: pointer;
  font-weight: 500;
  transition: transform 0.2s;
}

.theme-toggle:hover {
  transform: scale(1.05);
}

.dashboard {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 1.5rem;
  margin-bottom: 2rem;
}

.card {
  background: var(--card-bg);
  padding: 1.5rem;
  border-radius: 15px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-title {
  margin-bottom: 1.25rem;
  color: var(--text);
  font-size: 1.35rem;
}

.progress-bar {
  width: 100%;
  height: 24px;
  background: var(--border);
  border-radius: 12px;
  overflow: hidden;
  margin: 1rem 0;
}

.progress-fill {
  height: 100%;
  background: linear-gradient(90deg, var(--primary), var(--success));
  transition: width 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: 600;
  font-size: 0.85rem;
}

.progress-message {
  text-align: center;
  color: var(--text-light);
  font-size: 0.95rem;
}

.tasks-section {
  margin-top: 2rem;
}

.tasks-list {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.empty-state {
  text-align: center;
  padding: 3rem 1rem;
  color: var(--text-light);
}

.empty-state p {
  margin: 0.5rem 0;
  font-size: 1.1rem;
}

.loading {
  text-align: center;
  padding: 2rem;
  color: var(--text-light);
}

@media (max-width: 768px) {
  .header-content {
    flex-direction: column;
    text-align: center;
  }

  .stats-container {
    justify-content: center;
  }

  .dashboard {
    grid-template-columns: 1fr;
  }
}
</style>