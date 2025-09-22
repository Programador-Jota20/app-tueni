<?php
namespace App\Controllers\Admin;

class DashboardController
{
    public function index()
    {
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: /app-tueni/public/admin/login");
            exit;
        }

        require __DIR__ . '/../../Views/Admin/Dashboard.php';
    }
}