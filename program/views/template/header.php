<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pemesanan Tiket Kereta</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .bg-train-green { background: linear-gradient(135deg, #059669 0%, #047857 100%); }
        .bg-train-light { background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); }
        .text-train-green { color: #059669; }
        .border-train-green { border-color: #059669; }
        .hover-train-green:hover { background-color: #047857; }
        .shadow-train { box-shadow: 0 10px 25px rgba(5, 150, 105, 0.2); }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation Header -->
    <nav class="bg-train-green shadow-train sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo & Title -->
                <div class="flex items-center space-x-3">
                    <div class="bg-white p-2 rounded-lg">
                        <i class="fas fa-train text-train-green text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-white text-2xl font-bold">KeretaKu</h1>
                        <p class="text-green-100 text-sm">Sistem Pemesanan Tiket Kereta</p>
                    </div>
                </div>
                
                <!-- Navigation Menu -->
                <div class="flex space-x-1">
                    <a href="index.php?entity=train" class="flex items-center space-x-2 px-4 py-2 text-white hover:bg-green-600 rounded-lg transition duration-200">
                        <i class="fas fa-train"></i>
                        <span>Kereta</span>
                    </a>
                    <a href="index.php?entity=route" class="flex items-center space-x-2 px-4 py-2 text-white hover:bg-green-600 rounded-lg transition duration-200">
                        <i class="fas fa-route"></i>
                        <span>Rute</span>
                    </a>
                    <a href="index.php?entity=booking" class="flex items-center space-x-2 px-4 py-2 text-white hover:bg-green-600 rounded-lg transition duration-200">
                        <i class="fas fa-ticket-alt"></i>
                        <span>Pemesanan</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Main Content Container -->
    <div class="container mx-auto px-4 py-8">
        <div class="min-h-screen">