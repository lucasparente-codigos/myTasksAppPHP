// frontend/src/composables/useTasks.ts

import { ref, computed } from 'vue';
import api, { type Task, type TaskStats, type CreateTaskData } from '../services/api';

export function useTasks() {
  const tasks = ref<Task[]>([]);
  const stats = ref<TaskStats | null>(null);
  const loading = ref(false);
  const error = ref<string | null>(null);

  // Computed
  const completedTasks = computed(() => 
    tasks.value.filter(task => task.completed)
  );

  const pendingTasks = computed(() => 
    tasks.value.filter(task => !task.completed)
  );

  const highPriorityTasks = computed(() =>
    tasks.value.filter(task => task.priority === 'high' && !task.completed)
  );

  // Methods
  const fetchTasks = async () => {
    loading.value = true;
    error.value = null;
    try {
      const response = await api.getTasks();
      tasks.value = response.data;
    } catch (err) {
      error.value = err instanceof Error ? err.message : 'Erro ao buscar tarefas';
    } finally {
      loading.value = false;
    }
  };

  const fetchStats = async () => {
    try {
      const response = await api.getStats();
      stats.value = response.data;
    } catch (err) {
      console.error('Error fetching stats:', err);
    }
  };

  const createTask = async (taskData: CreateTaskData) => {
    loading.value = true;
    error.value = null;
    try {
      const response = await api.createTask(taskData);
      tasks.value.push(response.data);
      await fetchStats();
      return response.data;
    } catch (err) {
      error.value = err instanceof Error ? err.message : 'Erro ao criar tarefa';
      throw err;
    } finally {
      loading.value = false;
    }
  };

  const updateTask = async (id: string, taskData: Partial<Task>) => {
    loading.value = true;
    error.value = null;
    try {
      const response = await api.updateTask(id, taskData);
      const index = tasks.value.findIndex(t => t.id === id);
      if (index !== -1) {
        tasks.value[index] = response.data;
      }
      await fetchStats();
      return response.data;
    } catch (err) {
      error.value = err instanceof Error ? err.message : 'Erro ao atualizar tarefa';
      throw err;
    } finally {
      loading.value = false;
    }
  };

  const deleteTask = async (id: string) => {
    loading.value = true;
    error.value = null;
    try {
      await api.deleteTask(id);
      tasks.value = tasks.value.filter(t => t.id !== id);
      await fetchStats();
    } catch (err) {
      error.value = err instanceof Error ? err.message : 'Erro ao deletar tarefa';
      throw err;
    } finally {
      loading.value = false;
    }
  };

  const toggleTask = async (id: string) => {
    try {
      const response = await api.toggleTask(id);
      const index = tasks.value.findIndex(t => t.id === id);
      if (index !== -1) {
        tasks.value[index] = response.data;
      }
      await fetchStats();
    } catch (err) {
      error.value = err instanceof Error ? err.message : 'Erro ao alternar status';
      throw err;
    }
  };

  const addPomodoro = async (id: string) => {
    try {
      const response = await api.addPomodoro(id);
      const index = tasks.value.findIndex(t => t.id === id);
      if (index !== -1) {
        tasks.value[index] = response.data;
      }
      await fetchStats();
    } catch (err) {
      error.value = err instanceof Error ? err.message : 'Erro ao adicionar pomodoro';
      throw err;
    }
  };

  return {
    // State
    tasks,
    stats,
    loading,
    error,
    
    // Computed
    completedTasks,
    pendingTasks,
    highPriorityTasks,
    
    // Methods
    fetchTasks,
    fetchStats,
    createTask,
    updateTask,
    deleteTask,
    toggleTask,
    addPomodoro,
  };
}
