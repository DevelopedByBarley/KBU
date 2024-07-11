-- Table structure for `admin_activities`
CREATE TABLE `admin_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(300) NOT NULL,
  `contentInEn` varchar(300) DEFAULT NULL,
  `adminRef_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `adminRef_id` (`adminRef_id`),
  CONSTRAINT `admin_activities_ibfk_1` FOREIGN KEY (`adminRef_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admin_activities` VALUES ('123', 'Kitörölt egy admint: knorr_admin_2, level(2)', NULL, '5', '2024-07-09 13:18:39');
INSERT INTO `admin_activities` VALUES ('124', 'Új admint adott hozzá: Szaniszlóaradsad, level(1)', NULL, '5', '2024-07-09 13:18:55');
INSERT INTO `admin_activities` VALUES ('125', '', NULL, '5', '2024-07-10 09:48:56');
INSERT INTO `admin_activities` VALUES ('126', 'Belépett az admin felületre', NULL, '5', '2024-07-10 09:50:07');
INSERT INTO `admin_activities` VALUES ('127', 'Frissítette a profilját.', NULL, '5', '2024-07-10 11:02:58');
INSERT INTO `admin_activities` VALUES ('128', 'Frissítette a profilját.', NULL, '5', '2024-07-10 11:03:03');
INSERT INTO `admin_activities` VALUES ('129', 'Belépett az admin felületre', NULL, '5', '2024-07-10 15:10:18');
INSERT INTO `admin_activities` VALUES ('130', 'Frissítette a profilját.', NULL, '5', '2024-07-10 15:19:28');
INSERT INTO `admin_activities` VALUES ('131', 'Kiexportálta a regisztráltakat', NULL, '5', '2024-07-10 15:30:36');
INSERT INTO `admin_activities` VALUES ('132', 'Belépett az admin felületre', NULL, '5', '2024-07-11 09:49:16');
INSERT INTO `admin_activities` VALUES ('133', 'Kitörölte Szaniszló Árpádnevű felhasználót', NULL, '5', '2024-07-11 10:15:38');
INSERT INTO `admin_activities` VALUES ('134', 'Kitörölte Szaniszló Árpád 2nevű felhasználót', NULL, '5', '2024-07-11 10:15:58');
INSERT INTO `admin_activities` VALUES ('135', 'Kitörölte Szaniszló Árpádnevű felhasználót', NULL, '5', '2024-07-11 10:16:21');
INSERT INTO `admin_activities` VALUES ('136', 'Kitörölte Szaniszló Árpádnevű felhasználót', NULL, '5', '2024-07-11 10:23:09');
INSERT INTO `admin_activities` VALUES ('137', 'Kitörölte Szaniszló Árpádnevű felhasználót', NULL, '5', '2024-07-11 10:24:41');
INSERT INTO `admin_activities` VALUES ('138', 'Kitörölte Szaniszló Árpádnevű felhasználót', NULL, '5', '2024-07-11 10:25:50');
INSERT INTO `admin_activities` VALUES ('139', 'Kitörölte Szaniszló Árpádnevű felhasználót', NULL, '5', '2024-07-11 10:26:37');
INSERT INTO `admin_activities` VALUES ('140', 'Kitörölte Szaniszló Árpádnevű felhasználót', NULL, '5', '2024-07-11 10:27:30');
INSERT INTO `admin_activities` VALUES ('141', 'Kitörölte Szaniszló Árpádnevű felhasználót', NULL, '5', '2024-07-11 10:28:06');
INSERT INTO `admin_activities` VALUES ('142', 'Kitörölte dsadsanevű felhasználót', NULL, '5', '2024-07-11 10:33:00');
INSERT INTO `admin_activities` VALUES ('143', 'Kitörölte Szaniszló Árpádnevű felhasználót', NULL, '5', '2024-07-11 10:33:53');
INSERT INTO `admin_activities` VALUES ('144', 'Frissítette a profilját.', NULL, '5', '2024-07-11 11:12:30');
INSERT INTO `admin_activities` VALUES ('145', 'Kitörölte Szaniszló Árpád 2nevű felhasználót', NULL, '5', '2024-07-11 11:26:17');

-- Table structure for `admins`
CREATE TABLE `admins` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `adminId` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(500) NOT NULL,
  `avatar` varchar(500) NOT NULL,
  `created_at` date DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admins` VALUES ('5', '6672c1b72a8cf', '3', 'barley_admin', 'developedbybarley@gmail.com', '$2y$10$U1WLkh2qzKMGKXKDCYpSmeN/AskkEYXCkyfCEfcASrT0fkNGwnTmS', 'shark', '2024-06-19');
INSERT INTO `admins` VALUES ('38', '66853d1feee8c', '3', 'Szaniszló Árpád', 'developedbybarley@gmail.com', '$2y$10$yU0GX4cy4LP.VVtsX53wK.4oWS6zr6b5aFZZgz5nSbIHXRsjFVBKO', 'bear', '2024-07-03');
INSERT INTO `admins` VALUES ('51', '668d1c9fc862a', '1', 'Szaniszlóaradsad', 'arpadsz@max.hu', '$2y$10$sA7AZ028WzXQcRrBNtY7YeOBsSibYnJVGOcCUAcz8dGRrMTL6tLka', 'monkey', '2024-07-09');

-- Table structure for `duel_sports`
CREATE TABLE `duel_sports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `max` int(11) NOT NULL,
  `created_at` date DEFAULT current_timestamp(),
  `main_teamRef_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `main_teameRef_id` (`main_teamRef_id`),
  CONSTRAINT `duel_sports_ibfk_1` FOREIGN KEY (`main_teamRef_id`) REFERENCES `main_teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `duel_sports` VALUES ('1', 'Ping Pong', '#C0C0C0', '8', '2024-06-18', '1');
INSERT INTO `duel_sports` VALUES ('2', 'Csocsó', '#C0C0C0', '8', '2024-06-18', '1');

-- Table structure for `feedbacks`
CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_ip` varchar(45) NOT NULL,
  `feedback` int(11) NOT NULL,
  `content` varchar(2000) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Table structure for `main_teams`
CREATE TABLE `main_teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `color` varchar(11) NOT NULL,
  `color_emoji` varchar(50) NOT NULL,
  `max` int(11) NOT NULL,
  `leader` varchar(100) NOT NULL,
  `created_at` date DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `main_teams` VALUES ('1', 'Sárga', 'yellow-400', '🟡', '50', 'Mándoki Ádám', '2024-06-17');
INSERT INTO `main_teams` VALUES ('2', 'Piros', 'red-400', '🔴', '50', 'Szaniszló Árpád', '2024-06-17');

-- Table structure for `team_sports`
CREATE TABLE `team_sports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `max` int(11) NOT NULL,
  `main_teamRef_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `main_teamRef_id` (`main_teamRef_id`),
  CONSTRAINT `team_sports_ibfk_1` FOREIGN KEY (`main_teamRef_id`) REFERENCES `main_teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `team_sports` VALUES ('1', 'Foci', '#C0C0C0', '1', '1');
INSERT INTO `team_sports` VALUES ('2', 'Sorverseny', '#C0C0C0', '1', '1');

-- Table structure for `token`
CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(200) NOT NULL,
  `expires` varchar(50) NOT NULL,
  `link` varchar(200) NOT NULL,
  `ref_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `token` VALUES ('2', '882f62e5dcf9e332f03c70da338a55da', '-1', '/reset', '7', '2024-07-10 10:06:01');
INSERT INTO `token` VALUES ('3', '2a3e772b321609820da93bb52721ca2f', '-1', '/reset', '8', '2024-07-10 10:06:46');
INSERT INTO `token` VALUES ('4', 'f38bcc7f5fedfbff9e00e88ec35deca3', '-1', '/reset', '9', '2024-07-10 10:07:21');
INSERT INTO `token` VALUES ('5', '0fc7c74cdd45a4d44702235712098df5', '1721462873', '/reset', '10', '2024-07-10 10:07:53');
INSERT INTO `token` VALUES ('6', 'e07315604b7689c3488df022ba6455e4', '1721463230', '/reset', '11', '2024-07-10 10:13:50');
INSERT INTO `token` VALUES ('7', '6e3e45e0ebe2f05691dbf4ce7c221220', '-1', '/reset', '12', '2024-07-10 11:26:45');
INSERT INTO `token` VALUES ('8', 'a444d1313f379b198f6a214bc95547e8', '-1', '/reset', '13', '2024-07-10 11:45:18');
INSERT INTO `token` VALUES ('9', '3fdcbd3967194e209ed472c300591262', '1721468837', '/reset', '14', '2024-07-10 11:47:17');
INSERT INTO `token` VALUES ('10', '9c58d7cb181b1b0b8f0c31353449c201', '1721468920', '/reset', '15', '2024-07-10 11:48:40');
INSERT INTO `token` VALUES ('11', 'bec5120de35c000ef429ef17c1d5be3c', '1721468959', '/reset', '16', '2024-07-10 11:49:19');
INSERT INTO `token` VALUES ('12', '1504b7e8d3ccbe6a10d1003a9a6b70f5', '-1', '/reset', '17', '2024-07-10 12:09:52');
INSERT INTO `token` VALUES ('13', '3da2c94c845a634d5dfcdd3e53eeb242', '-1', '/reset', '18', '2024-07-10 12:12:25');
INSERT INTO `token` VALUES ('14', '1cbe97d070e146b4c22dec29736d02e4', '-1', '/reset', '19', '2024-07-10 12:12:55');
INSERT INTO `token` VALUES ('15', '01c899c45cf522d87cd32cc9f23f3df0', '-1', '/reset', '20', '2024-07-10 13:52:06');
INSERT INTO `token` VALUES ('16', 'a8f17adc4951b3dd9d3b7eb38ee096bc', '-1', '/reset', '21', '2024-07-10 13:55:32');
INSERT INTO `token` VALUES ('17', 'ec1eebeff9d415a3590281cffa8e767c', '1721476588', '/reset', '22', '2024-07-10 13:56:28');
INSERT INTO `token` VALUES ('18', '937842f599358d63c30018bc268afd69', '-1', '/reset', '23', '2024-07-10 14:19:13');
INSERT INTO `token` VALUES ('19', 'c6c1303f49c01eb5c0003fa2c2170de6', '1721477979', '/reset', '24', '2024-07-10 14:19:39');
INSERT INTO `token` VALUES ('20', '387ea0c395e803914adcb24637f304b3', '-1', '/reset', '25', '2024-07-10 14:28:31');
INSERT INTO `token` VALUES ('21', 'e53aab12fcf40dcbf0e2ed9ae6d55fb8', '1721478542', '/reset', '26', '2024-07-10 14:29:02');
INSERT INTO `token` VALUES ('22', '12e7798b9bb344ffe28953c54efb8c8e', '-1', '/reset', '27', '2024-07-10 14:33:01');
INSERT INTO `token` VALUES ('23', '24e30fc22622464de5b7b09b769b1dac', '1721478809', '/reset', '28', '2024-07-10 14:33:29');
INSERT INTO `token` VALUES ('24', '85f989394a4cb8e7d3108e7b60e607d2', '-1', '/reset', '29', '2024-07-10 14:39:40');
INSERT INTO `token` VALUES ('25', 'db41282b8e16e43dce9db14750e513c5', '1721479204', '/reset', '30', '2024-07-10 14:40:04');
INSERT INTO `token` VALUES ('26', '09a5ead6d2f64f170cc73ed9af491d8b', '-1', '/reset', '31', '2024-07-10 14:45:32');
INSERT INTO `token` VALUES ('27', 'dce8e031bfcafd7cc214644171c0e7f5', '1721479579', '/reset', '32', '2024-07-10 14:46:19');
INSERT INTO `token` VALUES ('28', '1944f46c7b4672f1f94d14194a27720c', '-1', '/reset', '33', '2024-07-10 14:48:33');
INSERT INTO `token` VALUES ('29', '4cbb44841eab69fa301352243d259f0f', '1721479755', '/reset', '34', '2024-07-10 14:49:15');
INSERT INTO `token` VALUES ('30', 'bd1c8035888d11026bf01738cceb52a7', '-1', '/reset', '35', '2024-07-10 14:52:46');
INSERT INTO `token` VALUES ('31', '4e37c571b46d2df975565a3ac5b09f80', '1721479989', '/reset', '36', '2024-07-10 14:53:09');
INSERT INTO `token` VALUES ('32', '321572be4691595a8d5ff36be0b27965', '-1', '/reset', '37', '2024-07-10 14:56:17');
INSERT INTO `token` VALUES ('33', 'b67d389c247937812b06b55305cefe3f', '1721481130', '/reset', '38', '2024-07-10 15:12:10');
INSERT INTO `token` VALUES ('34', '4353ccc291d98d49c8b844208d14f53d', '1721550061', '/reset', '39', '2024-07-11 10:21:01');
INSERT INTO `token` VALUES ('35', 'fa11390622ca73f063bb44de1142b034', '1721550176', '/reset', '40', '2024-07-11 10:22:56');
INSERT INTO `token` VALUES ('36', 'c538bd118b1da26cc9d3c0ff195929f1', '1721550303', '/reset', '41', '2024-07-11 10:25:03');
INSERT INTO `token` VALUES ('37', '4bb2fdc9a70443d17fb103ccf0c84c92', '1721550340', '/reset', '42', '2024-07-11 10:25:40');
INSERT INTO `token` VALUES ('38', '80e2bdd2dec56367419fc8598d308fdc', '1721550417', '/reset', '43', '2024-07-11 10:26:57');
INSERT INTO `token` VALUES ('39', '1a4a4b1fb75de6ee981d6b3863babe35', '1721550445', '/reset', '44', '2024-07-11 10:27:25');
INSERT INTO `token` VALUES ('40', 'dfcc4047fdc96fa48e20ae1817fa391e', '1721550803', '/reset', '46', '2024-07-11 10:33:23');
INSERT INTO `token` VALUES ('41', '65bb41204c00d9f2f5e09ab7ddaa2d22', '1721550829', '/reset', '47', '2024-07-11 10:33:49');
INSERT INTO `token` VALUES ('42', '11c2c8b13b1a86664f171c3c73319fa0', '1721554007', '/reset', '48', '2024-07-11 11:26:47');
INSERT INTO `token` VALUES ('43', 'a3d0f02db92d3c28f0e5ba064f010bf0', '-1', '/reset', '49', '2024-07-11 11:27:10');
INSERT INTO `token` VALUES ('44', 'e0da65db280702293630d7a47518256d', '1721560438', '/reset', '50', '2024-07-11 13:13:58');
INSERT INTO `token` VALUES ('45', '686835f1c02e6e7338193d83fc9836cf', '1721561551', '/reset', '51', '2024-07-11 13:32:31');
INSERT INTO `token` VALUES ('46', '51d9190a030289ef8507ddf76eee1f40', '1721561687', '/reset', '52', '2024-07-11 13:34:47');

-- Table structure for `users`
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `class` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `ident_number` int(11) NOT NULL,
  `main_teamRef_id` int(11) DEFAULT NULL,
  `team_sportRef_id` int(11) DEFAULT NULL,
  `duel_sportRef_id` int(11) DEFAULT NULL,
  `chess` tinyint(1) NOT NULL,
  `run` tinyint(1) NOT NULL,
  `transfer` int(11) NOT NULL,
  `vegetarian` tinyint(1) NOT NULL,
  `actimo` tinyint(1) NOT NULL,
  `pair_status` int(11) NOT NULL,
  `pair_eligibility` int(11) NOT NULL,
  `pair_password` varchar(50) NOT NULL,
  `pairRef_id` int(11) DEFAULT NULL,
  `created_at` date DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `main_teamRef_id` (`main_teamRef_id`),
  KEY `duel_sportRef_id` (`duel_sportRef_id`),
  KEY `team_sportRef_id` (`team_sportRef_id`),
  KEY `pairRef_id` (`pairRef_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`duel_sportRef_id`) REFERENCES `duel_sports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`main_teamRef_id`) REFERENCES `main_teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_ibfk_3` FOREIGN KEY (`team_sportRef_id`) REFERENCES `team_sports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_ibfk_4` FOREIGN KEY (`pairRef_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` VALUES ('48', 'Szaniszló Árpád 2', 'dsadsad', 'developedbybarley@gmail.com', '3213213', '1', '1', '1', '0', '0', '0', '0', '0', '2', '1', '', '52', '2024-07-11');
INSERT INTO `users` VALUES ('49', 'Szaniszló Árpád', 'dsadasdas', 'developedbybarley@gmail.com', '3213213', '1', '2', '1', '0', '0', '0', '0', '0', '2', '1', '', '50', '2024-07-11');
INSERT INTO `users` VALUES ('50', 'sdadasd sdaasd', 'dsadasdas', 'developedbybarley@gmail.com', '3213213', '1', NULL, '1', '0', '0', '0', '0', '0', '1', '0', '', '49', '2024-07-11');
INSERT INTO `users` VALUES ('51', 'Szaniszló Árpád', '3213213', 'Barley@gmail.com', '323213', NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '', NULL, '2024-07-11');
INSERT INTO `users` VALUES ('52', '3213123d dsadsad', '3213213', 'developedbybarley@gmail.com', '3213213', '1', NULL, '1', '0', '0', '0', '0', '0', '1', '0', '', '48', '2024-07-11');

-- Table structure for `visits`
CREATE TABLE `visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(50) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `operating_system` varchar(255) DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `device_type` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `visit_start` datetime NOT NULL DEFAULT current_timestamp(),
  `visit_end` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `visits` VALUES ('40', '', '123', 'dsad', 'dsadas', 'dsadasd', 'dsadsads', 'dsadsadasd', '2024-07-04 11:21:56', '2024-07-04 11:21:56');
INSERT INTO `visits` VALUES ('41', '0c3nva93g5e0pen403ovi69nip', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'Windows NT', 'Direct', 'Desktop', 'Localhost', '2024-07-05 09:36:48', '2024-07-05 12:49:54');
INSERT INTO `visits` VALUES ('42', '2ddvvn02v7m7cjsv8shbr1n99n', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'Windows NT', 'Direct', 'Desktop', 'Localhost', '2024-07-05 13:12:23', '2024-07-05 13:38:06');
INSERT INTO `visits` VALUES ('43', 'e27d20lgl0ppho5apg2mj0gbiv', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'Windows NT', 'Direct', 'Desktop', 'Localhost', '2024-07-08 14:35:43', '2024-07-08 14:35:43');
INSERT INTO `visits` VALUES ('44', '3lgjm5vnd6obhkmebpq6kg2vqf', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'Windows NT', 'Direct', 'Desktop', 'Localhost', '2024-07-09 09:42:15', '2024-07-09 09:42:28');
INSERT INTO `visits` VALUES ('45', '49rpbc7bq0m4ddc5mm0kk9kchv', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'Windows NT', 'Direct', 'Desktop', 'Localhost', '2024-07-09 09:57:36', '2024-07-09 10:14:33');
INSERT INTO `visits` VALUES ('46', '24fbvhd152cid482lf9793fq65', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'Windows NT', 'Direct', 'Desktop', 'Localhost', '2024-07-09 10:26:19', '2024-07-09 10:31:08');
INSERT INTO `visits` VALUES ('47', 'q5vndbe4bgplu6i564hiolatij', '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_1_2 like Mac OS X) AppleWebKit/537.51.2 (KHTML, like Gecko) Version/7.0 Mobile/11D257 Safari/9537.53', 'Windows NT', 'Direct', 'Mobile', 'Localhost', '2024-07-09 10:31:28', '2024-07-09 13:24:41');
INSERT INTO `visits` VALUES ('48', 'euugbqblof50s7ftrgs9m00jes', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'Windows NT', 'Direct', 'Desktop', 'Localhost', '2024-07-10 09:47:17', '2024-07-10 15:10:18');

