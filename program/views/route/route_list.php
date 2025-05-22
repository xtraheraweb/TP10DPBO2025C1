<?php
require_once 'views/template/header.php';
?>

<!-- Header Section -->
<div class="bg-train-light rounded-lg p-6 mb-6 shadow-train">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-train-green mb-2">
                <i class="fas fa-route mr-3"></i>Data Rute Perjalanan
            </h2>
            <p class="text-gray-600">Kelola rute perjalanan kereta api antar stasiun</p>
        </div>
        <div class="text-right">
            <div class="text-2xl font-bold text-train-green"><?php echo isset($routeList) ? count($routeList) : 0; ?></div>
            <div class="text-sm text-gray-600">Total Rute</div>
        </div>
    </div>
</div>

<!-- Action Button -->
<div class="mb-6">
    <a href="index.php?entity=route&action=add" class="bg-train-green text-white px-6 py-3 rounded-lg hover-train-green transition duration-200 shadow-lg inline-flex items-center space-x-2">
        <i class="fas fa-plus"></i>
        <span>Tambah Rute Baru</span>
    </a>
</div>

<!-- Success/Error Messages -->
<?php if (isset($_GET['message'])): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        <?php 
        switch($_GET['message']) {
            case 'created': echo '<i class="fas fa-check-circle mr-2"></i>Data rute berhasil ditambahkan!'; break;
            case 'updated': echo '<i class="fas fa-check-circle mr-2"></i>Data rute berhasil diperbarui!'; break;
            case 'deleted': echo '<i class="fas fa-check-circle mr-2"></i>Data rute berhasil dihapus!'; break;
        }
        ?>
    </div>
<?php endif; ?>

<!-- Data Table -->
<div class="bg-white rounded-lg shadow-train overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-train-green text-white">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold">
                        <i class="fas fa-map-marker-alt mr-2"></i>Stasiun Keberangkatan
                    </th>
                    <th class="px-6 py-4 text-left font-semibold">
                        <i class="fas fa-flag-checkered mr-2"></i>Stasiun Tujuan
                    </th>
                    <th class="px-6 py-4 text-center font-semibold">
                        <i class="fas fa-road mr-2"></i>Jarak (KM)
                    </th>
                    <th class="px-6 py-4 text-center font-semibold">
                        <i class="fas fa-clock mr-2"></i>Durasi (Jam)
                    </th>
                    <th class="px-6 py-4 text-center font-semibold">
                        <i class="fas fa-cogs mr-2"></i>Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (isset($routeList) && !empty($routeList)): ?>
                <?php foreach ($routeList as $route): ?>
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="bg-green-100 text-train-green p-2 rounded-lg mr-3">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">
                                    <?php echo htmlspecialchars($route['departure_station']); ?>
                                </div>
                                <div class="text-sm text-gray-500">Stasiun Asal</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                                <i class="fas fa-flag-checkered"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">
                                    <?php echo htmlspecialchars($route['arrival_station']); ?>
                                </div>
                                <div class="text-sm text-gray-500">Stasiun Tujuan</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center">
                            <i class="fas fa-road text-gray-400 mr-2"></i>
                            <span class="font-bold text-lg"><?php echo number_format($route['distance_km']); ?></span>
                            <span class="text-gray-500 ml-1">km</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center">
                            <i class="fas fa-clock text-gray-400 mr-2"></i>
                            <span class="font-bold text-lg"><?php echo number_format($route['duration_hours'], 1); ?></span>
                            <span class="text-gray-500 ml-1">jam</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center space-x-2">
                            <a href="index.php?entity=route&action=edit&id=<?php echo $route['id']; ?>" 
                               class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 text-sm inline-flex items-center space-x-1">
                                <i class="fas fa-edit"></i>
                                <span>Edit</span>
                            </a>
                            
                            <form action="index.php?entity=route&action=delete&id=<?php echo $route['id']; ?>" 
                                  method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus rute ini?');" 
                                  class="inline">
                                <button type="submit" 
                                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-200 text-sm inline-flex items-center space-x-1">
                                    <i class="fas fa-trash"></i>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="text-gray-400">
                            <i class="fas fa-route text-6xl mb-4"></i>
                            <p class="text-xl font-semibold mb-2">Belum ada data rute</p>
                            <p class="text-gray-500">Silakan tambahkan data rute perjalanan terlebih dahulu</p>
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