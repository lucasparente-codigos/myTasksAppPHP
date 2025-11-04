<?php
// backend/models/Task.php

class Task {
    private $dataFile;
    
    public function __construct() {
        $this->dataFile = __DIR__ . '/../data/tasks.json';
        $this->initDataFile();
    }
    
    private function initDataFile() {
        if (!file_exists($this->dataFile)) {
            $dir = dirname($this->dataFile);
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            file_put_contents($this->dataFile, json_encode([]));
        }
    }
    
    public function getAll() {
        $json = file_get_contents($this->dataFile);
        return json_decode($json, true) ?: [];
    }
    
    public function getById($id) {
        $tasks = $this->getAll();
        foreach ($tasks as $task) {
            if ($task['id'] === $id) {
                return $task;
            }
        }
        return null;
    }
    
    public function create($data) {
        $tasks = $this->getAll();
        
        $newTask = [
            'id' => uniqid('task_'),
            'title' => $data['title'],
            'description' => $data['description'] ?? '',
            'priority' => $data['priority'] ?? 'medium',
            'completed' => false,
            'pomodoros' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $tasks[] = $newTask;
        $this->save($tasks);
        
        return $newTask;
    }
    
    public function update($id, $data) {
        $tasks = $this->getAll();
        $updated = false;
        
        foreach ($tasks as &$task) {
            if ($task['id'] === $id) {
                if (isset($data['title'])) $task['title'] = $data['title'];
                if (isset($data['description'])) $task['description'] = $data['description'];
                if (isset($data['priority'])) $task['priority'] = $data['priority'];
                if (isset($data['completed'])) $task['completed'] = $data['completed'];
                if (isset($data['pomodoros'])) $task['pomodoros'] = $data['pomodoros'];
                
                $task['updated_at'] = date('Y-m-d H:i:s');
                $updated = true;
                break;
            }
        }
        
        if ($updated) {
            $this->save($tasks);
            return $this->getById($id);
        }
        
        return null;
    }
    
    public function delete($id) {
        $tasks = $this->getAll();
        $filtered = array_filter($tasks, fn($t) => $t['id'] !== $id);
        
        if (count($filtered) < count($tasks)) {
            $this->save(array_values($filtered));
            return true;
        }
        
        return false;
    }
    
    public function toggleComplete($id) {
        $tasks = $this->getAll();
        
        foreach ($tasks as &$task) {
            if ($task['id'] === $id) {
                $task['completed'] = !$task['completed'];
                $task['updated_at'] = date('Y-m-d H:i:s');
                $this->save($tasks);
                return $task;
            }
        }
        
        return null;
    }
    
    public function addPomodoro($id) {
        $tasks = $this->getAll();
        
        foreach ($tasks as &$task) {
            if ($task['id'] === $id) {
                $task['pomodoros']++;
                $task['updated_at'] = date('Y-m-d H:i:s');
                $this->save($tasks);
                return $task;
            }
        }
        
        return null;
    }
    
    private function save($tasks) {
        file_put_contents($this->dataFile, json_encode($tasks, JSON_PRETTY_PRINT));
    }
}
