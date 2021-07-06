-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 06, 2021 at 02:07 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `hibitan`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL COMMENT 'いいねID',
  `userId` int(11) NOT NULL COMMENT '会員ID',
  `postId` int(11) NOT NULL COMMENT '投稿ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `userId`, `postId`) VALUES
(21, 8, 24),
(29, 5, 21);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL COMMENT 'id',
  `teamId` int(11) DEFAULT NULL COMMENT '所属チーム',
  `userId` varchar(100) NOT NULL COMMENT '会員名',
  `startTime` datetime NOT NULL COMMENT '勉強開始時間',
  `endTime` datetime NOT NULL COMMENT '勉強終了時間',
  `material` varchar(100) NOT NULL COMMENT '教材',
  `learningContent` varchar(1000) NOT NULL COMMENT '学習内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `teamId`, `userId`, `startTime`, `endTime`, `material`, `learningContent`) VALUES
(16, 19, '3', '2021-06-26 14:44:00', '2021-06-26 15:44:00', 'PHP基礎', 'サービスの機能テスト過程で飛んだデータの復旧'),
(17, 19, '3', '2021-06-26 20:45:00', '2021-06-26 22:45:00', 'PHP基礎', '作成したサービスの機能テスト用のコード作成'),
(18, 19, '3', '2021-06-27 13:46:00', '2021-06-27 15:52:00', 'PHP基礎', '作成したサービスのテストコード作成、機能修正'),
(19, 19, '2', '2021-06-27 18:49:00', '2021-06-27 23:57:00', 'PHP入門', 'CRUD処理100本ノック'),
(20, 19, '4', '2021-06-28 06:53:00', '2021-06-28 08:53:00', 'PHP脱初心者', 'PHPMailerの使用方法'),
(21, 20, '5', '2021-06-26 14:55:00', '2021-06-26 15:55:00', 'PHP中級者', 'PHPでよく使われるフレームワークについて'),
(22, 21, '6', '2021-06-27 14:58:00', '2021-06-27 15:58:00', 'PHP超実践', 'ネットサービス開発の肝'),
(23, 22, '7', '2021-06-26 15:00:00', '2021-06-26 16:00:00', 'PHP大全', 'PHPのメリット、デメリット'),
(24, 23, '8', '2021-06-26 15:08:00', '2021-06-26 16:08:00', 'テスト', 'テスト\r\nテスト'),
(25, 23, '8', '2021-06-27 12:27:00', '2021-06-27 16:24:00', 'PHP入門', 'ループ処理\r\n修正'),
(26, 19, '2', '2021-07-03 05:50:00', '2021-07-03 16:39:00', 'PHP入門', 'ログイン機能の実装'),
(27, 19, '2', '2021-07-04 11:44:00', '2021-07-04 18:55:00', 'PHP入門', 'PHPUnitの使い方');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL COMMENT 'id',
  `leader` int(11) NOT NULL COMMENT 'チームリーダー',
  `teamName` varchar(1000) NOT NULL COMMENT 'チーム名',
  `language` varchar(16) NOT NULL COMMENT '学習言語',
  `proficiancy` varchar(16) NOT NULL COMMENT '習熟度',
  `about` varchar(10000) NOT NULL COMMENT 'チーム概要'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `leader`, `teamName`, `language`, `proficiancy`, `about`) VALUES
(19, 3, 'テストチーム１', 'PHP', '初級者', 'テスト用チーム１です。'),
(20, 5, 'テストチーム２', 'PHP', '中級者', '中級者むけチームです。'),
(21, 6, 'テストチーム３', 'PHP', '上級者', '上級者向けのチームです'),
(22, 7, 'テストチーム４', 'PHP', '問わない', '習熟度は問いません'),
(23, 8, '頑張ろう初級者', 'PHP', '初級者', '初級者向けテストチームその５\r\nみんな来て'),
(24, 9, 'テストチーム６', 'PHP', '初級者', 'テストチームその６\r\nゆっくりしていってね'),
(25, 10, 'PHP初級者の集い', 'PHP', '初級者', '初級者きてよ'),
(26, 11, '５チーム目のチーム', 'PHP', '初級者', '初級者チーム五番目のチーム');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'id',
  `mail` varchar(100) NOT NULL COMMENT 'メールアドレス',
  `password` varchar(1000) NOT NULL COMMENT 'パスワード',
  `name` varchar(1000) NOT NULL COMMENT '会員名',
  `language` varchar(16) NOT NULL COMMENT '学習言語',
  `proficiancy` varchar(16) NOT NULL COMMENT '習熟度',
  `teamNo` varchar(100) DEFAULT NULL COMMENT '所属チーム',
  `teamLeader` int(1) DEFAULT NULL COMMENT 'チームリーダー'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `mail`, `password`, `name`, `language`, `proficiancy`, `teamNo`, `teamLeader`) VALUES
(2, 'testteam@team', '$2y$10$tb/8IVWmRb07g5302QAIku42soRD9CP8vcNKwUbE6Lu3tuMxxsuSO', 'テストチーム１会員１', 'PHP', '初級者', '19', NULL),
(3, 'teamleader@team', '$2y$10$5URIQxFjNVCoLBuJRA/mP.yx7zVTs1h9ebnTMDanuLc1Uh4Rpvfb6', 'テストチーム１リーダー', 'PHP', '初級者', '19', 1),
(4, 'test2team@team', '$2y$10$CMxGJGIOCiozrGbJHjiYIeDKyvJQptf.7l.WXl4TP.0AHkoSazjqm', 'テストチーム１会員２', 'PHP', '初級者', '19', NULL),
(5, 'testteam2@team', '$2y$10$37YCHPXW8LvOO/iddgBtSeQJuvow7YrxcPrbu4JVLlF684no72mMe', 'テストチーム２リーダー', 'PHP', '中級者', '20', 1),
(6, 'testteam3@team', '$2y$10$QIiECQBSLAB13/KS/9vobuLHCJxxZfLc7iTqTcwfGTW1DiD18RSBG', 'テストチーム３リーダー', 'PHP', '上級者', '21', 1),
(7, 'testteam4@team', '$2y$10$DmpK519/5G8rKVo5Msq1put2k0Xgw./sTQkgDshQueC03pQai8niC', 'テストチーム４リーダー', 'PHP', '初級者', '22', 1),
(8, 'testteam5@team', '$2y$10$fURLqPrbJpj5012Gua/EbOWQd7WZc8vWzlo6NTABxuUKUyglpGEcq', 'テストチーム５リーダー', 'PHP', '初級者', '23', 1),
(9, 'testteam6@team', '$2y$10$HUD7cnz8CJrdwnmqNpfLOud3KKnTo6KMhPlzjBw4p0HH612fEuf.y', 'テストチーム６リーダー', 'PHP', '初級者', '24', 1),
(10, 'testteam7@team', '$2y$10$ZFQNMglr7dEC0tQwq2gT1ejmuhniI8SCSKGT7xyiWYranoCHDYAOi', 'テストチーム７リーダー', 'PHP', '初級者', '25', 1),
(11, 'testteam8@team', '$2y$10$IoNR7.RNeSxyo60Bh8Pe1.zuEMxtMEfHBCRuozMD5tcGQoLSrIvdK', 'テストチーム８リーダー', 'PHP', '初級者', '26', 1),
(12, 'noteam@test', '$2y$10$25w1AbFos1PuiPNT3Q0j3eZzSY.ueJg/ZzfGDbtygoddtPJfntm.2', 'チーム未所属会員', 'PHP', '初級者', NULL, NULL),
(13, 'why@why', '$2y$10$cYKO0sc8AyocE2geVSOdwOzxe2biqUWnNHTKDxANaENv8Hy9sk9r6', 'tttttttt', 'PHP', '初級者', NULL, NULL),
(15, 'kanitama3980@outlook.jp', '$2y$10$Nlgj4aVhpLExsBc8ll6X8.2jwJqfEuOv5InGVv2SqxTws6m8mUnvG', 'ttta', 'PHP', '初級者', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'いいねID', AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=16;
