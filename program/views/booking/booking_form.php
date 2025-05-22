<?php
require_once 'views/template/header.php';
?>

<!-- Header Section -->
<div class="bg-train-light rounded-lg p-6 mb-6 shadow-train">
    <div class="flex items-center">
        <div class="bg-train-green text-white p-3 rounded-lg mr-4">
            <i class="fas fa-ticket-alt text-2xl"></i>
        </div>
        <div>
            <h2 class="text-3xl font-bold text-train-green">
                <?php echo isset($booking) ? 'Edit Pemesanan Tiket' : 'Tambah Pemesanan Baru'; ?>
            </h2>
            <p class="text-gray-600">
                <?php echo isset($booking) ? 'Perbarui informasi pemesanan tiket' : 'Lengkapi data pemesanan tiket kereta api'; ?>
            </p>
        </div>
    </div>
</div>

<!-- Back Button -->
<div class="mb-6">
    <a href="index.php?entity=booking" class="text-gray-600 hover:text-train-green transition duration-200 inline-flex items-center space-x-2">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Daftar Pemesanan</span>
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
    <form action="index.php?entity=booking&action=<?php echo isset($booking) ? 'update&id=' . $booking['id'] : 'save'; ?>" method="POST" class="space-y-6">
        
        <!-- Data Penumpang -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-user text-train-green mr-2"></i>Data Penumpang
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Penumpang -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user text-train-green mr-2"></i>Nama Lengkap
                    </label>
                    <input type="text" 
                           name="passenger_name" 
                           value="<?php echo isset($booking) ? htmlspecialchars($booking['passenger_name']) : ''; ?>" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" 
                           placeholder="Contoh: Ahmad Wijaya"
                           required>
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-phone text-train-green mr-2"></i>Nomor Telepon
                    </label>
                    <input type="tel" 
                           name="passenger_phone" 
                           value="<?php echo isset($booking) ? htmlspecialchars($booking['passenger_phone']) : ''; ?>" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" 
                           placeholder="Contoh: 081234567890"
                           required>
                </div>
            </div>
        </div>

        <!-- Data Perjalanan -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-route text-train-green mr-2"></i>Data Perjalanan
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pilih Kereta -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-train text-train-green mr-2"></i>Pilih Kereta
                    </label>
                    <select name="train_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" required>
                        <option value="">-- Pilih Kereta --</option>
                        <?php foreach ($trains as $train): ?>
                        <option value="<?php echo $train['id']; ?>" <?php echo isset($booking) && $booking['train_id'] == $train['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($train['train_name']); ?> (<?php echo $train['train_type']; ?> - <?php echo $train['capacity']; ?> kursi)
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Pilih Rute -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-route text-train-green mr-2"></i>Pilih Rute
                    </label>
                    <select name="route_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" required>
                        <option value="">-- Pilih Rute --</option>
                        <?php foreach ($routes as $route): ?>
                        <option value="<?php echo $route['id']; ?>" <?php echo isset($booking) && $booking['route_id'] == $route['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($route['departure_station']); ?> → <?php echo htmlspecialchars($route['arrival_station']); ?> 
                            (<?php echo $route['distance_km']; ?>km, <?php echo $route['duration_hours']; ?>h)
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <!-- Data Tiket -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-ticket-alt text-train-green mr-2"></i>Data Tiket
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Tanggal Keberangkatan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar text-train-green mr-2"></i>Tanggal Keberangkatan
                    </label>
                    <input type="date" 
                           name="departure_date" 
                           value="<?php echo isset($booking) ? $booking['departure_date'] : ''; ?>" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" 
                           min="<?php echo date('Y-m-d'); ?>"
                           required>
                </div>

                <!-- Waktu Keberangkatan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-clock text-train-green mr-2"></i>Waktu Keberangkatan
                    </label>
                    <input type="time" 
                           name="departure_time" 
                           value="<?php echo isset($booking) ? $booking['departure_time'] : ''; ?>" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" 
                           required>
                </div>

                <!-- Nomor Kursi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-chair text-train-green mr-2"></i>Nomor Kursi
                    </label>
                    <input type="text" 
                           name="seat_number" 
                           value="<?php echo isset($booking) ? htmlspecialchars($booking['seat_number']) : ''; ?>" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" 
                           placeholder="Contoh: EKS-1A"
                           required>
                </div>

                <!-- Harga Tiket -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-money-bill text-train-green mr-2"></i>Harga Tiket (Rp)
                    </label>
                    <input type="number" 
                           name="ticket_price" 
                           value="<?php echo isset($booking) ? $booking['ticket_price'] : ''; ?>" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" 
                           placeholder="350000"
                           min="1" 
                           step="1000"
                           required>
                </div>
            </div>
        </div>

        <!-- Status Pemesanan -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-info-circle text-train-green mr-2"></i>Status Pemesanan
            </label>
            <select name="booking_status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" required>
                <option value="confirmed" <?php echo isset($booking) && $booking['booking_status'] == 'confirmed' ? 'selected' : ''; ?>>
                    ✅ Confirmed (Dikonfirmasi)
                </option>
                <option value="pending" <?php echo isset($booking) && $booking['booking_status'] == 'pending' ? 'selected' : ''; ?>>
                    ⏳ Pending (Menunggu)
                </option>
                <option value="cancelled" <?php echo isset($booking) && $booking['booking_status'] == 'cancelled' ? 'selected' : ''; ?>>
                    ❌ Cancelled (Dibatalkan)
                </option>
            </select>
        </div>

        <!-- Submit Button -->
        <div class="flex space-x-4 pt-6">
            <button type="submit" 
                    class="bg-train-green text-white px-8 py-3 rounded-lg hover-train-green transition duration-200 shadow-lg font-semibold inline-flex items-center space-x-2">
                <i class="fas fa-save"></i>
                <span><?php echo isset($booking) ? 'Perbarui Pemesanan' : 'Simpan Pemesanan'; ?></span>
            </button>
            
            <a href="index.php?entity=booking" 
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