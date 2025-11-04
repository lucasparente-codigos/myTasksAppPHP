<?php
// backend/routes/api.php

require_once __DIR__ . '/../controllers/TaskController.php';

function handleRoute($path, $method) {
    $taskController = new TaskController();
    
    // Remover barra inicial e final
    $path = trim($path, '/');
    
    // Dividir o path em segmentos
    $segments = explode('/', $path);
    
    // Rotas de Tasks
    if ($segments[0] === 'api' && $segments[1] === 'tasks') {
        
        // GET /api/tasks - Listar todas
        if ($method === 'GET' && count($segments) === 2) {
            $taskController->index();
        }
        
        // GET /api/tasks/stats - Estatísticas
        if ($method === 'GET' && count($segments) === 3 && $segments[2] === 'stats') {
            $taskController->getStats();
        }
        
        // GET /api/tasks/{id} - Buscar por ID
        if ($method === 'GET' && count($segments) === 3 && $segments[2] !== 'stats') {
            $taskController->show($segments[2]);
        }
        
        // POST /api/tasks - Criar
        if ($method === 'POST' && count($segments) === 2) {
            $taskController->store();
        }
        
        // PUT /api/tasks/{id} - Atualizar
        if ($method === 'PUT' && count($segments) === 3) {
            $taskController->update($segments[2]);
        }
        
        // DELETE /api/tasks/{id} - Deletar
        if ($method === 'DELETE' && count($segments) === 3) {
            $taskController->delete($segments[2]);
        }
        
        // POST /api/tasks/{id}/toggle - Toggle complete
        if ($method === 'POST' && count($segments) === 4 && $segments[3] === 'toggle') {
            $taskController->toggleComplete($segments[2]);
        }
        
        // POST /api/tasks/{id}/pomodoro - Adicionar pomodoro
        if ($method === 'POST' && count($segments) === 4 && $segments[3] === 'pomodoro') {
            $taskController->addPomodoro($segments[2]);
        }
        
        return;
    }
    
    // Rota não encontrada
    Response::notFound('Route not found');
}
