<?php
require_once 'views/template/header.php';
?>

<!-- Header Section -->
<div class="bg-train-light rounded-lg p-6 mb-6 shadow-train">
    <div class="flex items-center">
        <div class="bg-train-green text-white p-3 rounded-lg mr-4">
            <i class="fas fa-route text-2xl"></i>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-train-green">
                <?php echo isset($route) ? 'Edit Rute Perjalanan' : 'Tambah Rute Baru'; ?>
            </h2>
            <p class="text-gray-600">
                <?php echo isset($route) ? 'Perbarui informasi rute perjalanan' : 'Lengkapi data rute perjalanan yang akan ditambahkan'; ?>
            </p>
        </div>
    </div>
</div>

<!-- Back Button -->
<div class="mb-6">
    <a href="index.php?entity=route" class="text-gray-600 hover:text-train-green transition duration-200 inline-flex items-center space-x-2">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Daftar Rute</span>
    </a>
</div>

<!-- Error Messages -->
<?php if (isset($_GET['error'])): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <i class="fas fa-exclamation-circle mr-2"></i>
        Terjadi kesalahan saat menyimpan data. Silakan coba lagi.
    </div>
<?php endif; ?>

<!-- Form -->
<div class="bg-white rounded-lg shadow-train p-8">
    <form action="index.php?entity=route&action=<?php echo isset($route) ? 'update&id=' . $route['id'] : 'save'; ?>" method="POST" class="space-y-6">
        
        <!-- Stasiun Keberangkatan -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-map-marker-alt text-train-green mr-2"></i>Stasiun Keberangkatan
            </label>
            <input type="text" 
                   name="departure_station" 
                   value="<?php echo isset($route) ? htmlspecialchars($route['departure_station']) : ''; ?>" 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" 
                   placeholder="Contoh: Jakarta Gambir"
                   required>
            <p class="text-sm text-gray-500 mt-1">Nama stasiun keberangkatan</p>
        </div>

        <!-- Stasiun Tujuan -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-flag-checkered text-train-green mr-2"></i>Stasiun Tujuan
            </label>
            <input type="text" 
                   name="arrival_station" 
                   value="<?php echo isset($route) ? htmlspecialchars($route['arrival_station']) : ''; ?>" 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" 
                   placeholder="Contoh: Surabaya Gubeng"
                   required>
            <p class="text-sm text-gray-500 mt-1">Nama stasiun tujuan</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Jarak -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-road text-train-green mr-2"></i>Jarak Tempuh (KM)
                </label>
                <input type="number" 
                       name="distance_km" 
                       value="<?php echo isset($route) ? htmlspecialchars($route['distance_km']) : ''; ?>" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" 
                       placeholder="Contoh: 725"
                       min="1" 
                       max="2000"
                       required>
                <p class="text-sm text-gray-500 mt-1">Jarak dalam kilometer</p>
            </div>

            <!-- Durasi -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-clock text-train-green mr-2"></i>Durasi Perjalanan (Jam)
                </label>
                <input type="number" 
                       name="duration_hours" 
                       value="<?php echo isset($route) ? htmlspecialchars($route['duration_hours']) : ''; ?>" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" 
                       placeholder="Contoh: 8.5"
                       min="0.1" 
                       max="24"
                       step="0.1"
                       required>
                <p class="text-sm text-gray-500 mt-1">Durasi dalam jam (desimal)</p>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex space-x-4 pt-6">
            <button type="submit" 
                    class="bg-train-green text-white px-8 py-3 rounded-lg hover-train-green transition duration-200 shadow-lg font-semibold inline-flex items-center space-x-2">
                <i class="fas fa-save"></i>
                <span><?php echo isset($route) ? 'Perbarui Data' : 'Simpan Data'; ?></span>
            </button>
            
            <a href="index.php?entity=route" 
               class="bg-gray-500 text-white px-8 py-3 rounded-lg hover:bg-gray-600 transition duration-200 shadow-lg font-semibold inline-flex items-center space-x-2">
                <i class="fas fa-times"></i>
                <span>Batal</span>
            </a>
        </div>
    </form>
</div>

<?php
require_once 'views/template/footer.php';
?>