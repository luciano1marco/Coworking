-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Nov-2022 às 16:07
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_coworking`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin_preferences`
--

CREATE TABLE `admin_preferences` (
  `id` tinyint(1) NOT NULL,
  `user_panel` tinyint(1) NOT NULL DEFAULT 0,
  `sidebar_form` tinyint(1) NOT NULL DEFAULT 0,
  `messages_menu` tinyint(1) NOT NULL DEFAULT 0,
  `notifications_menu` tinyint(1) NOT NULL DEFAULT 0,
  `tasks_menu` tinyint(1) NOT NULL DEFAULT 0,
  `user_menu` tinyint(1) NOT NULL DEFAULT 1,
  `ctrl_sidebar` tinyint(1) NOT NULL DEFAULT 0,
  `transition_page` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `admin_preferences`
--

INSERT INTO `admin_preferences` (`id`, `user_panel`, `sidebar_form`, `messages_menu`, `notifications_menu`, `tasks_menu`, `user_menu`, `ctrl_sidebar`, `transition_page`) VALUES
(1, 0, 0, 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendas`
--

CREATE TABLE `agendas` (
  `id` int(11) NOT NULL,
  `dia` date NOT NULL,
  `hora` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL,
  `vaga` int(11) NOT NULL,
  `ativo` tinyint(1) UNSIGNED DEFAULT NULL,
  `nome` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `telefone` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `agendas`
--

INSERT INTO `agendas` (`id`, `dia`, `hora`, `mesa`, `vaga`, `ativo`, `nome`, `email`, `telefone`) VALUES
(1, '2022-10-05', '3', '12', 1, 1, 'luciano marco', 'luciano1marco@gmail.com', '53984321028'),
(4, '2022-10-20', '4', '6', 1, 1, 'LUCIANO CORREA MARCO', 'luciano1marco@gmail.com', '53984321028'),
(5, '2022-10-27', '8', '14', 1, 1, 'LUCIANO CORREA MARCO', 'luciano1marco@gmail.com', '(53)9-8432-1028'),
(6, '2022-10-20', '2', '12', 1, 1, 'LUCIANO CORREA MARCO', 'luciano1marco@gmail.com', '(53)9-8432-1028'),
(7, '2022-10-06', '4', '4', 1, 1, 'LUCIANO CORREA MARCO', 'luciano1marco@gmail.com', '(53)9-8432-1028'),
(8, '2022-10-06', '5', '1', 1, 1, 'LUCIANO CORREA MARCO', 'luciano1marco@gmail.com', '(53)9-8432-1028'),
(9, '2022-10-06', '1', '1', 1, 1, 'LUCIANO CORREA MARCO', 'luciano1marco@gmail.com', '(53)9-8432-1028'),
(10, '2022-10-06', '11', '1', 1, 1, 'LUCIANO CORREA MARCO', 'luciano1marco@gmail.com', '(53)9-8432-1028'),
(11, '2022-10-07', '5', '8', 1, 1, 'LUCIANO CORREA MARCO', 'luciano1marco@gmail.com', '(53)9-8432-1028'),
(12, '2022-10-07', '6', '8', 1, 1, 'LUCIANO CORREA MARCO', 'luciano1marco@gmail.com', '(53)9-8432-1028'),
(13, '2022-10-07', '11', '11', 1, 1, 'LUCIANO CORREA MARCO', 'luciano1marco@gmail.com', '(53)9-8432-1028'),
(18, '2022-10-21', '7', '12', 1, 1, 'LUCIANO CORREA MARCO', 'luciano1marco@gmail.com', '(53)9-8432-1028'),
(19, '2022-10-24', '5', '11', 1, 1, 'LUCIANO CORREA MARCO', 'luciano1marco@gmail.com', '(53)9-8432-1028');

-- --------------------------------------------------------

--
-- Estrutura da tabela `datas`
--

CREATE TABLE `datas` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `bgcolor` char(7) NOT NULL DEFAULT '#607D8B'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `bgcolor`) VALUES
(1, 'admin', 'Administrator', '#F44336'),
(2, 'members', 'General User', '#2196F3'),
(3, 'teste', 'teste', '#607D8B');

-- --------------------------------------------------------

--
-- Estrutura da tabela `horas`
--

CREATE TABLE `horas` (
  `id` int(11) NOT NULL,
  `descricao` varchar(20) NOT NULL,
  `ativo` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `horas`
--

INSERT INTO `horas` (`id`, `descricao`, `ativo`) VALUES
(1, '9h', 1),
(2, '10h', 1),
(3, '11h', 1),
(4, '12h', 1),
(5, '13h', 1),
(6, '14h', 1),
(7, '15h', 1),
(8, '16h', 1),
(9, '17h', 1),
(10, '18h', 1),
(11, '19h', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `menugroups`
--

CREATE TABLE `menugroups` (
  `id` int(11) NOT NULL,
  `grupo` int(11) DEFAULT NULL,
  `menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `menugroups`
--

INSERT INTO `menugroups` (`id`, `grupo`, `menu`) VALUES
(2, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `menuitens`
--

CREATE TABLE `menuitens` (
  `id` int(11) NOT NULL,
  `controller` varchar(30) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `icone` varchar(30) DEFAULT NULL,
  `section` int(11) DEFAULT NULL,
  `publicado` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `menuitens`
--

INSERT INTO `menuitens` (`id`, `controller`, `descricao`, `icone`, `section`, `publicado`) VALUES
(1, 'license', 'Licenças', 'fa fa-legal', 1, 0),
(2, 'horas', 'Horários', 'clock-o', 2, 1),
(3, 'mesas', 'Espaços', 'table', 2, 1),
(4, 'agendas', 'Agenda', 'address-card-o', 2, 1),
(5, 'relatorios', 'Relatórios', 'area-chart', 3, 1),
(6, 'calendar', 'Calendario', 'calendar', 3, 0),
(7, 'calendar', 'Calendario', 'calendar', 3, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `menusection`
--

CREATE TABLE `menusection` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `publicado` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `menusection`
--

INSERT INTO `menusection` (`id`, `descricao`, `publicado`) VALUES
(1, 'Seção de Menu', NULL),
(2, 'Cadastros', 1),
(3, 'Relatórios', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `descricao` varchar(20) NOT NULL,
  `ativo` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `mesas`
--

INSERT INTO `mesas` (`id`, `descricao`, `ativo`) VALUES
(1, 'Mesa 1', 1),
(2, 'Mesa 2', 1),
(3, 'Mesa 3', 1),
(4, 'Mesa 4', 1),
(5, 'Mesa 5', 1),
(6, 'Mesa 6', 1),
(7, 'Mesa 7', 1),
(8, 'Mesa 8', 1),
(9, 'Mesa 9', 1),
(10, 'Mesa 10', 1),
(11, 'Mesa 11', 1),
(12, 'Mesa 12', 1),
(13, 'Mesa 13', 1),
(14, 'Mesa 14', 1),
(15, 'Mesa 15', 1),
(16, 'Mesa 16', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id` int(11) UNSIGNED NOT NULL,
  `ativo` tinyint(1) UNSIGNED DEFAULT NULL,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `public_preferences`
--

CREATE TABLE `public_preferences` (
  `id` int(1) NOT NULL,
  `transition_page` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `public_preferences`
--

INSERT INTO `public_preferences` (`id`, `transition_page`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `admin` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `admin`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1665668592, 1, 'Admin', 'istrator', 'ADMIN', '0', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admin_preferences`
--
ALTER TABLE `admin_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `datas`
--
ALTER TABLE `datas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `horas`
--
ALTER TABLE `horas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `menugroups`
--
ALTER TABLE `menugroups`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `menuitens`
--
ALTER TABLE `menuitens`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `menusection`
--
ALTER TABLE `menusection`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `public_preferences`
--
ALTER TABLE `public_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin_preferences`
--
ALTER TABLE `admin_preferences`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `datas`
--
ALTER TABLE `datas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `horas`
--
ALTER TABLE `horas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `menugroups`
--
ALTER TABLE `menugroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `menuitens`
--
ALTER TABLE `menuitens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `menusection`
--
ALTER TABLE `menusection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `public_preferences`
--
ALTER TABLE `public_preferences`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
