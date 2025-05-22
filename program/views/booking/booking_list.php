<?php
require_once 'views/template/header.php';
?>

<!-- Header Section -->
<div class="bg-train-light rounded-lg p-6 mb-6 shadow-train">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-train-green mb-2">
                <i class="fas fa-ticket-alt mr-3"></i>Data Pemesanan Tiket
            </h2>
            <p class="text-gray-600">Kelola semua pemesanan tiket kereta api</p>
        </div>
        <div class="text-right">
            <div class="text-2xl font-bold text-train-green"><?php echo count($bookingList); ?></div>
            <div class="text-sm text-gray-600">Total Pemesanan</div>
            <?php if (!empty($bookingList)): ?>
            <div class="text-lg font-semibold text-green-600 mt-2">
                Rp <?php echo number_format(array_sum(array_column($bookingList, 'ticket_price')), 0, ',', '.'); ?>
            </div>
            <div class="text-xs text-gray-500">Total Pendapatan</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Action Button -->
<div class="mb-6">
    <a href="index.php?entity=booking&action=add" class="bg-train-green text-white px-6 py-3 rounded-lg hover-train-green transition duration-200 shadow-lg inline-flex items-center space-x-2">
        <i class="fas fa-plus"></i>
        <span>Tambah Pemesanan Baru</span>
    </a>
</div>

<!-- Success/Error Messages -->
<?php if (isset($_GET['message'])): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        <?php 
        switch($_GET['message']) {
            case 'created': echo '<i class="fas fa-check-circle mr-2"></i>Pemesanan berhasil ditambahkan!'; break;
            case 'updated': echo '<i class="fas fa-check-circle mr-2"></i>Pemesanan berhasil diperbarui!'; break;
            case 'deleted': echo '<i class="fas fa-check-circle mr-2"></i>Pemesanan berhasil dihapus!'; break;
        }
        ?>
    </div>
<?php endif; ?>

<!-- Data Table -->
<div class="bg-white rounded-lg shadow-train overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-train-green text-white">
                <tr>
                    <th class="px-4 py-4 text-left font-semibold">
                        <i class="fas fa-user mr-2"></i>Penumpang
                    </th>
                    <th class="px-4 py-4 text-left font-semibold">
                        <i class="fas fa-train mr-2"></i>Kereta
                    </th>
                    <th class="px-4 py-4 text-left font-semibold">
                        <i class="fas fa-route mr-2"></i>Rute
                    </th>
                    <th class="px-4 py-4 text-center font-semibold">
                        <i class="fas fa-calendar mr-2"></i>Tanggal
                    </th>
                    <th class="px-4 py-4 text-center font-semibold">
                        <i class="fas fa-chair mr-2"></i>Kursi
                    </th>
                    <th class="px-4 py-4 text-center font-semibold">
                        <i class="fas fa-money-bill mr-2"></i>Harga
                    </th>
                    <th class="px-4 py-4 text-center font-semibold">
                        <i class="fas fa-info-circle mr-2"></i>Status
                    </th>
                    <th class="px-4 py-4 text-center font-semibold">
                        <i class="fas fa-cogs mr-2"></i>Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php foreach ($bookingList as $booking): ?>
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="px-4 py-4">
                        <div class="flex items-center">
                            <div class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">
                                    <?php echo htmlspecialchars($booking['passenger_name']); ?>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <i class="fas fa-phone mr-1"></i><?php echo htmlspecialchars($booking['passenger_phone']); ?>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div>
                            <div class="font-semibold text-gray-900">
                                <?php echo htmlspecialchars($booking['train_name']); ?>
                            </div>
                            <span class="px-2 py-1 text-xs rounded-full 
                                <?php 
                                switch($booking['train_type']) {
                                    case 'Eksekutif': echo 'bg-purple-100 text-purple-800'; break;
                                    case 'Bisnis': echo 'bg-blue-100 text-blue-800'; break;
                                    case 'Ekonomi': echo 'bg-green-100 text-green-800'; break;
                                }
                                ?>">
                                <?php echo htmlspecialchars($booking['train_type']); ?>
                            </span>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="text-sm">
                            <div class="font-medium text-gray-900">
                                <i class="fas fa-arrow-right text-train-green mx-1"></i>
                                <?php echo htmlspecialchars($booking['departure_station']); ?>
                            </div>
                            <div class="text-gray-500">
                                ke <?php echo htmlspecialchars($booking['arrival_station']); ?>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4 text-center">
                        <div class="text-sm">
                            <div class="font-medium text-gray-900">
                                <?php echo date('d/m/Y', strtotime($booking['departure_date'])); ?>
                            </div>
                            <div class="text-gray-500">
                                <?php echo date('H:i', strtotime($booking['departure_time'])); ?>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4 text-center">
                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded font-mono text-sm">
                            <?php echo htmlspecialchars($booking['seat_number']); ?>
                        </span>
                    </td>
                    <td class="px-4 py-4 text-center">
                        <div class="font-bold text-green-600">
                            Rp <?php echo number_format($booking['ticket_price'], 0, ',', '.'); ?>
                        </div>
                    </td>
                    <td class="px-4 py-4 text-center">
                        <span class="px-2 py-1 text-xs rounded-full font-medium
                            <?php 
                            switch($booking['booking_status']) {
                                case 'confirmed': echo 'bg-green-100 text-green-800'; break;
                                case 'pending': echo 'bg-yellow-100 text-yellow-800'; break;
                                case 'cancelled': echo 'bg-red-100 text-red-800'; break;
                            }
                            ?>">
                            <?php echo ucfirst($booking['booking_status']); ?>
                        </span>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex justify-center space-x-1">
                            <a href="index.php?entity=booking&action=edit&id=<?php echo $booking['id']; ?>" 
                               class="bg-blue-500 text-white px-3 py-2 rounded-lg hover:bg-blue-600 transition duration-200 text-xs inline-flex items-center">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <form action="index.php?entity=booking&action=delete&id=<?php echo $booking['id']; ?>" 
                                  method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pemesanan ini?');" 
                                  class="inline">
                                <button type="submit" 
                                        class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 transition duration-200 text-xs">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                
                <?php if (empty($bookingList)): ?>
                <tr>
                    <td colspan="8" class="px-6 py-12 text-center">
                        <div class="text-gray-400">
                            <i class="fas fa-ticket-alt text-6xl mb-4"></i>
                            <p class="text-xl font-semibold mb-2">Belum ada pemesanan</p>
                            <p class="text-gray-500">Silakan tambahkan pemesanan tiket terlebih dahulu</p>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once 'views/template/footer.php';
?>