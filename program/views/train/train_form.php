<?php
require_once 'views/template/header.php';
?>

<!-- Header Section -->
<div class="bg-train-light rounded-lg p-6 mb-6 shadow-train">
    <div class="flex items-center">
        <div class="bg-train-green text-white p-3 rounded-lg mr-4">
            <i class="fas fa-train text-2xl"></i>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-train-green">
                <?php echo isset($train) ? 'Edit Kereta' : 'Tambah Kereta Baru'; ?>
            </h2>
            <p class="text-gray-600">
                <?php echo isset($train) ? 'Perbarui informasi kereta' : 'Lengkapi data kereta yang akan ditambahkan'; ?>
            </p>
        </div>
    </div>
</div>

<!-- Back Button -->
<div class="mb-6">
    <a href="index.php?entity=train" class="text-gray-600 hover:text-train-green transition duration-200 inline-flex items-center space-x-2">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Daftar Kereta</span>
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
    <form action="index.php?entity=train&action=<?php echo isset($train) ? 'update&id=' . $train['id'] : 'save'; ?>" method="POST" class="space-y-6">
        
        <!-- Nama Kereta -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-train text-train-green mr-2"></i>Nama Kereta
            </label>
            <input type="text" 
                   name="train_name" 
                   value="<?php echo isset($train) ? htmlspecialchars($train['train_name']) : ''; ?>" 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" 
                   placeholder="Contoh: Argo Bromo Anggrek"
                   required>
            <p class="text-sm text-gray-500 mt-1">Masukkan nama lengkap kereta api</p>
        </div>

        <!-- Kelas Kereta -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-star text-train-green mr-2"></i>Kelas Kereta
            </label>
            <select name="train_type" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" 
                    required>
                <option value="">-- Pilih Kelas Kereta --</option>
                <option value="Eksekutif" <?php echo isset($train) && $train['train_type'] == 'Eksekutif' ? 'selected' : ''; ?>>
                    Eksekutif (Premium)
                </option>
                <option value="Bisnis" <?php echo isset($train) && $train['train_type'] == 'Bisnis' ? 'selected' : ''; ?>>
                    Bisnis (Business)
                </option>
                <option value="Ekonomi" <?php echo isset($train) && $train['train_type'] == 'Ekonomi' ? 'selected' : ''; ?>>
                    Ekonomi (Economy)
                </option>
            </select>
            <p class="text-sm text-gray-500 mt-1">Pilih kelas layanan kereta api</p>
        </div>

        <!-- Kapasitas -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-users text-train-green mr-2"></i>Kapasitas Penumpang
            </label>
            <input type="number" 
                   name="capacity" 
                   value="<?php echo isset($train) ? htmlspecialchars($train['capacity']) : ''; ?>" 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" 
                   placeholder="Contoh: 200"
                   min="1" 
                   max="500"
                   required>
            <p class="text-sm text-gray-500 mt-1">Jumlah kursi yang tersedia (1-500 kursi)</p>
        </div>

        <!-- Submit Button -->
        <div class="flex space-x-4 pt-6">
            <button type="submit" 
                    class="bg-train-green text-white px-8 py-3 rounded-lg hover-train-green transition duration-200 shadow-lg font-semibold inline-flex items-center space-x-2">
                <i class="fas fa-save"></i>
                <span><?php echo isset($train) ? 'Perbarui Data' : 'Simpan Data'; ?></span>
            </button>
            
            <a href="index.php?entity=train" 
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