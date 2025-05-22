<?php
require_once 'views/template/header.php';
?>

<!-- Header Section -->
<div class="bg-train-light rounded-lg p-6 mb-6 shadow-train">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-train-green mb-2">
                <i class="fas fa-train mr-3"></i>Data Kereta
            </h2>
            <p class="text-gray-600">Kelola data kereta api yang tersedia dalam sistem</p>
        </div>
        <div class="text-right">
            <div class="text-2xl font-bold text-train-green"><?php echo count($trainList); ?></div>
            <div class="text-sm text-gray-600">Total Kereta</div>
        </div>
    </div>
</div>

<!-- Action Button -->
<div class="mb-6">
    <a href="index.php?entity=train&action=add" class="bg-train-green text-white px-6 py-3 rounded-lg hover-train-green transition duration-200 shadow-lg inline-flex items-center space-x-2">
        <i class="fas fa-plus"></i>
        <span>Tambah Kereta Baru</span>
    </a>
</div>

<!-- Success/Error Messages -->
<?php if (isset($_GET['message'])): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        <?php 
        switch($_GET['message']) {
            case 'created': echo '<i class="fas fa-check-circle mr-2"></i>Data kereta berhasil ditambahkan!'; break;
            case 'updated': echo '<i class="fas fa-check-circle mr-2"></i>Data kereta berhasil diperbarui!'; break;
            case 'deleted': echo '<i class="fas fa-check-circle mr-2"></i>Data kereta berhasil dihapus!'; break;
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
                        <i class="fas fa-train mr-2"></i>Nama Kereta
                    </th>
                    <th class="px-6 py-4 text-left font-semibold">
                        <i class="fas fa-star mr-2"></i>Kelas Kereta
                    </th>
                    <th class="px-6 py-4 text-left font-semibold">
                        <i class="fas fa-users mr-2"></i>Kapasitas
                    </th>
                    <th class="px-6 py-4 text-center font-semibold">
                        <i class="fas fa-cogs mr-2"></i>Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php foreach ($trainList as $train): ?>
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="bg-train-green text-white p-2 rounded-lg mr-3">
                                <i class="fas fa-train"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">
                                    <?php echo htmlspecialchars($train['train_name']); ?>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-sm font-medium
                            <?php 
                            switch($train['train_type']) {
                                case 'Eksekutif': echo 'bg-purple-100 text-purple-800'; break;
                                case 'Bisnis': echo 'bg-blue-100 text-blue-800'; break;
                                case 'Ekonomi': echo 'bg-green-100 text-green-800'; break;
                                default: echo 'bg-gray-100 text-gray-800';
                            }
                            ?>">
                            <i class="fas fa-crown mr-1"></i>
                            <?php echo htmlspecialchars($train['train_type']); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-900">
                        <div class="flex items-center">
                            <i class="fas fa-users text-gray-400 mr-2"></i>
                            <span class="font-medium"><?php echo number_format($train['capacity']); ?></span>
                            <span class="text-gray-500 ml-1">kursi</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center space-x-2">
                            <a href="index.php?entity=train&action=edit&id=<?php echo $train['id']; ?>" 
                               class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 text-sm inline-flex items-center space-x-1">
                                <i class="fas fa-edit"></i>
                                <span>Edit</span>
                            </a>
                            
                            <form action="index.php?entity=train&action=delete&id=<?php echo $train['id']; ?>" 
                                  method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus kereta <?php echo htmlspecialchars($train['train_name']); ?>?');" 
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
                
                <?php if (empty($trainList)): ?>
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <div class="text-gray-400">
                            <i class="fas fa-train text-6xl mb-4"></i>
                            <p class="text-xl font-semibold mb-2">Belum ada data kereta</p>
                            <p class="text-gray-500">Silakan tambahkan data kereta terlebih dahulu</p>
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