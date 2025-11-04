<?php
// backend/controllers/TaskController.php

require_once __DIR__ . '/../models/Task.php';
require_once __DIR__ . '/../utils/Response.php';

class TaskController {
    private $taskModel;
    
    public function __construct() {
        $this->taskModel = new Task();
    }
    
    public function index() {
        $tasks = $this->taskModel->getAll();
        Response::success($tasks, 'Tasks retrieved successfully');
    }
    
    public function show($id) {
        $task = $this->taskModel->getById($id);
        
        if (!$task) {
            Response::notFound('Task not found');
        }
        
        Response::success($task, 'Task retrieved successfully');
    }
    
    public function store() {
        $data = json_decode(file_get_contents('php://input'), true);
        
        // Validação básica
        if (!isset($data['title']) || empty(trim($data['title']))) {
            Response::error('Title is required', 422);
        }
        
        $task = $this->taskModel->create($data);
        Response::created($task, 'Task created successfully');
    }
    
    public function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        
        $task = $this->taskModel->update($id, $data);
        
        if (!$task) {
            Response::notFound('Task not found');
        }
        
        Response::success($task, 'Task updated successfully');
    }
    
    public function delete($id) {
        $deleted = $this->taskModel->delete($id);
        
        if (!$deleted) {
            Response::notFound('Task not found');
        }
        
        Response::success(null, 'Task deleted successfully');
    }
    
    public function toggleComplete($id) {
        $task = $this->taskModel->toggleComplete($id);
        
        if (!$task) {
            Response::notFound('Task not found');
        }
        
        Response::success($task, 'Task status toggled successfully');
    }
    
    public function addPomodoro($id) {
        $task = $this->taskModel->addPomodoro($id);
        
        if (!$task) {
            Response::notFound('Task not found');
        }
        
        Response::success($task, 'Pomodoro added successfully');
    }
    
    public function getStats() {
        $tasks = $this->taskModel->getAll();
        
        $stats = [
            'total' => count($tasks),
            'completed' => count(array_filter($tasks, fn($t) => $t['completed'])),
            'pending' => count(array_filter($tasks, fn($t) => !$t['completed'])),
            'high_priority' => count(array_filter($tasks, fn($t) => $t['priority'] === 'high')),
            'medium_priority' => count(array_filter($tasks, fn($t) => $t['priority'] === 'medium')),
            'low_priority' => count(array_filter($tasks, fn($t) => $t['priority'] === 'low')),
            'total_pomodoros' => array_sum(array_column($tasks, 'pomodoros'))
        ];
        
        $stats['completion_rate'] = $stats['total'] > 0 
            ? round(($stats['completed'] / $stats['total']) * 100, 2) 
            : 0;
        
        Response::success($stats, 'Stats retrieved successfully');
    }
}
