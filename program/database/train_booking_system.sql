-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Bulan Mei 2025 pada 12.24
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `train_booking_system`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `train_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `passenger_name` varchar(100) NOT NULL,
  `passenger_phone` varchar(20) NOT NULL,
  `departure_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `seat_number` varchar(10) NOT NULL,
  `ticket_price` decimal(10,2) NOT NULL,
  `booking_status` enum('confirmed','pending','cancelled') DEFAULT 'confirmed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bookings`
--

INSERT INTO `bookings` (`id`, `train_id`, `route_id`, `passenger_name`, `passenger_phone`, `departure_date`, `departure_time`, `seat_number`, `ticket_price`, `booking_status`, `created_at`) VALUES
(3, 3, 3, 'Budi Santoso', '082345678901', '2025-06-03', '06:15:00', 'BIS-3C', 150000.00, 'confirmed', '2025-05-22 09:42:06'),
(4, 7, 6, 'Safira Cek', '0123456780', '2025-05-22', '17:08:00', 'EK-12', 25001.00, 'confirmed', '2025-05-22 10:08:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `departure_station` varchar(100) NOT NULL,
  `arrival_station` varchar(100) NOT NULL,
  `distance_km` int(11) NOT NULL,
  `duration_hours` decimal(3,1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `routes`
--

INSERT INTO `routes` (`id`, `departure_station`, `arrival_station`, `distance_km`, `duration_hours`, `created_at`) VALUES
(2, 'Jakarta Gambir', 'Yogyakarta Tugu', 560, 7.0, '2025-05-22 09:42:06'),
(3, 'Jakarta Gambir', 'Bandung', 150, 3.0, '2025-05-22 09:42:06'),
(4, 'Surabaya Gubeng', 'Malang', 90, 2.5, '2025-05-22 09:42:06'),
(5, 'Yogyakarta Tugu', 'Solo Balapan', 65, 1.5, '2025-05-22 09:42:06'),
(6, 'Gerlong Tengah', 'Stasiun UPI', 30, 5.0, '2025-05-22 10:07:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trains`
--

CREATE TABLE `trains` (
  `id` int(11) NOT NULL,
  `train_name` varchar(100) NOT NULL,
  `train_type` varchar(50) NOT NULL,
  `capacity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `trains`
--

INSERT INTO `trains` (`id`, `train_name`, `train_type`, `capacity`, `created_at`) VALUES
(2, 'Taksaka', 'Eksekutif', 180, '2025-05-22 09:42:05'),
(3, 'Sancaka', 'Bisnis', 250, '2025-05-22 09:42:05'),
(4, 'Matarmaja', 'Ekonomi', 300, '2025-05-22 09:42:05'),
(5, 'Jayabaya', 'Bisnis', 220, '2025-05-22 09:42:05'),
(6, 'KRL 2023', 'Ekonomi', 300, '2025-05-22 09:59:55'),
(7, 'UPI EDUN', 'Eksekutif', 20, '2025-05-22 10:06:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `train_id` (`train_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indeks untuk tabel `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `trains`
--
ALTER TABLE `trains`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `trains`
--
ALTER TABLE `trains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`train_id`) REFERENCES `trains` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
