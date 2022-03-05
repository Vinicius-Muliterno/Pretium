-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Fev-2022 às 10:51
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pretium`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorys`
--

CREATE TABLE `categorys` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `measurement_units`
--

CREATE TABLE `measurement_units` (
  `id` int(11) NOT NULL,
  `unity` varchar(255) NOT NULL,
  `symbol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `measurement_units`
--

INSERT INTO `measurement_units` (`id`, `unity`, `symbol`) VALUES
(1, 'centímetros', 'cm'),
(2, 'metros', 'm'),
(3, 'unidade', 'un');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `measurement_units_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `product_name`, `brand`, `code`, `provider_id`, `measurement_units_id`, `created_at`, `updated_at`) VALUES
(1, 'Processador AMD Ryzen 5 5600X, Cache 35MB, 3.7GHz (4.6GHz Max Turbo), AM4, Sem Vídeo - 100-100000065BOX', 'AMD', '0001', 1, 3, '2022-02-10 23:58:18', '2022-02-10 23:58:18'),
(2, 'Memória XPG Hunter, 8GB, 3200MHz, DDR4, CL20, Para Notebook - AX4S32008G20I-SBHT', 'XPG', '002', 1, 3, '2022-02-10 23:59:18', '2022-02-10 23:59:18'),
(3, 'iPad Pro Apple 12.9, 128GB, Processador M1, WiFi, Bluetooth, USB-C, 12MP, iPadOS 15, Preto - MHNF3LL/A', 'Apple', '00', 1, 1, '2022-02-11 00:04:57', '2022-02-11 00:04:57'),
(4, 'Teclado Mecânico Gamer Razer BlackWidow Tournament V2, Chroma, Razer Switch Orange, US - RZ03-02190700-R3M1', 'Razer', '0001', 2, 3, '2022-02-11 00:06:08', '2022-02-11 00:06:08'),
(5, 'Fonte Corsair CV450, 450W, 80 Plus Bronze - CP-9020209-BR', 'Corsair', '000002', 2, 1, '2022-02-11 00:06:41', '2022-02-11 00:06:41'),
(6, 'Monitor Smart Samsung 24 IPS SmartHub, Bluetooth, HDR, Plataforma Tizen, AirPlay 2, Full HD, HDMI, VESA - LS24AM506NLMZD', 'Samsung', '00003', 2, 3, '2022-02-11 00:07:08', '2022-02-11 00:07:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `providers`
--

CREATE TABLE `providers` (
  `id` int(11) NOT NULL,
  `social_reason` varchar(255) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phonenumber` varchar(14) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `providers`
--

INSERT INTO `providers` (`id`, `social_reason`, `cnpj`, `email`, `phonenumber`, `address`, `created_at`, `updated_at`) VALUES
(1, 'LF INFORMATICA LTDA', '44956687000109', 'contato@lfinformatica.com.br', '81996567636', 'R ANTONIO ZIELONKA, 1043 - ESTANCIA PINHAIS', '2022-01-22 18:31:37', '2022-01-22 18:31:37'),
(2, 'SELECT INFORMATICA', '45120980000102', 'sivanilson.emp@gmail.com', '8386399349', 'R ANALIA RIBEIRO DIAS, 80, DINAMERICA', '2022-02-03 00:53:07', '2022-02-03 00:53:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `closure_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `quotes`
--

INSERT INTO `quotes` (`id`, `user_id`, `provider_id`, `status_id`, `closure_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '2022-02-13 20:22:37', '2022-02-13 17:46:18', '2022-02-13 20:22:37');

-- --------------------------------------------------------

--
-- Estrutura da tabela `quotes_products`
--

CREATE TABLE `quotes_products` (
  `id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qtd` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `quotes_products`
--

INSERT INTO `quotes_products` (`id`, `quote_id`, `product_id`, `qtd`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 3, '2022-02-13 17:46:18', '2022-02-13 17:46:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Nova Solicitação'),
(2, 'Finalizada'),
(3, 'Aprovada'),
(4, 'Recusada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(70) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `provider_id`, `created_at`, `updated_at`) VALUES
(1, 'Brenno Luan Pereira dos Santos', 'brennoluan8530@gmail.com', '$2y$10$mZvehU9indlxj3VwoadjGur7bxhvu.vcpM4F06mwrXEI8ZlzLzmMW', 1, '2022-01-22 18:31:38', '2022-01-22 18:31:38'),
(2, 'SIVANILSON PEREIRA BEZERRA', 'sivanilson.emp@gmail.com', '$2y$10$pMf8UYeMCPxI2TotQJEW8uzO4fZulX6bDlXLv1NuZHaxNFmWp0jnO', 2, '2022-02-03 00:53:08', '2022-02-03 00:53:08');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `measurement_units`
--
ALTER TABLE `measurement_units`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `measurement_units_id` (`measurement_units_id`);

--
-- Índices para tabela `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `quotes_products`
--
ALTER TABLE `quotes_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `quote_id` (`quote_id`);

--
-- Índices para tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `measurement_units`
--
ALTER TABLE `measurement_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `quotes_products`
--
ALTER TABLE `quotes_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `measurement_units_id` FOREIGN KEY (`measurement_units_id`) REFERENCES `measurement_units` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `quotes_products`
--
ALTER TABLE `quotes_products`
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `quote_id` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `provider_id` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
