// frontend/src/services/api.ts

const API_URL = 'http://localhost:8000/api';

interface ApiResponse<T = any> {
  success: boolean;
  message: string;
  data: T;
}

interface Task {
  id: string;
  title: string;
  description: string;
  priority: 'high' | 'medium' | 'low';
  completed: boolean;
  pomodoros: number;
  created_at: string;
  updated_at: string;
}

interface TaskStats {
  total: number;
  completed: number;
  pending: number;
  high_priority: number;
  medium_priority: number;
  low_priority: number;
  total_pomodoros: number;
  completion_rate: number;
}

interface CreateTaskData {
  title: string;
  description?: string;
  priority?: 'high' | 'medium' | 'low';
}

class ApiService {
  private async request<T>(endpoint: string, options: RequestInit = {}): Promise<ApiResponse<T>> {
    try {
      const response = await fetch(`${API_URL}${endpoint}`, {
        headers: {
          'Content-Type': 'application/json',
          ...options.headers,
        },
        ...options,
      });

      const data: ApiResponse<T> = await response.json();

      if (!response.ok) {
        throw new Error(data.message || 'Erro na requisição');
      }

      return data;
    } catch (error) {
      console.error('API Error:', error);
      throw error;
    }
  }

  // Tasks
  async getTasks(): Promise<ApiResponse<Task[]>> {
    return this.request<Task[]>('/tasks');
  }

  async getTask(id: string): Promise<ApiResponse<Task>> {
    return this.request<Task>(`/tasks/${id}`);
  }

  async createTask(taskData: CreateTaskData): Promise<ApiResponse<Task>> {
    return this.request<Task>('/tasks', {
      method: 'POST',
      body: JSON.stringify(taskData),
    });
  }

  async updateTask(id: string, taskData: Partial<Task>): Promise<ApiResponse<Task>> {
    return this.request<Task>(`/tasks/${id}`, {
      method: 'PUT',
      body: JSON.stringify(taskData),
    });
  }

  async deleteTask(id: string): Promise<ApiResponse<null>> {
    return this.request<null>(`/tasks/${id}`, {
      method: 'DELETE',
    });
  }

  async toggleTask(id: string): Promise<ApiResponse<Task>> {
    return this.request<Task>(`/tasks/${id}/toggle`, {
      method: 'POST',
    });
  }

  async addPomodoro(id: string): Promise<ApiResponse<Task>> {
    return this.request<Task>(`/tasks/${id}/pomodoro`, {
      method: 'POST',
    });
  }

  async getStats(): Promise<ApiResponse<TaskStats>> {
    return this.request<TaskStats>('/tasks/stats');
  }
}

export default new ApiService();
export type { Task, TaskStats, CreateTaskData, ApiResponse };