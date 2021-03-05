/*
 Navicat Premium Data Transfer

 Source Server         : LOCALHOST
 Source Server Type    : MariaDB
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : piutang

 Target Server Type    : MariaDB
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 06/03/2021 05:39:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for auth_group
-- ----------------------------
DROP TABLE IF EXISTS `auth_group`;
CREATE TABLE `auth_group`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `definition` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_group
-- ----------------------------
INSERT INTO `auth_group` VALUES (1, 'xadmin', 'Admin Master');
INSERT INTO `auth_group` VALUES (2, 'admin', 'admin');

-- ----------------------------
-- Table structure for auth_permission
-- ----------------------------
DROP TABLE IF EXISTS `auth_permission`;
CREATE TABLE `auth_permission`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `definition` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 84 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_permission
-- ----------------------------
INSERT INTO `auth_permission` VALUES (1, 'config_view_default', 'Module config');
INSERT INTO `auth_permission` VALUES (2, 'config_view_logo', 'Module config');
INSERT INTO `auth_permission` VALUES (3, 'config_view_sosmed', 'Module config');
INSERT INTO `auth_permission` VALUES (4, 'config_view_core', 'Module config');
INSERT INTO `auth_permission` VALUES (5, 'config_update_web_name', 'Module config');
INSERT INTO `auth_permission` VALUES (6, 'config_update_web_domain', 'Module config');
INSERT INTO `auth_permission` VALUES (7, 'config_update_web_owner', 'Module config');
INSERT INTO `auth_permission` VALUES (8, 'config_update_email', 'Module config');
INSERT INTO `auth_permission` VALUES (9, 'config_update_telepon', 'Module config');
INSERT INTO `auth_permission` VALUES (10, 'config_update_address', 'Module config');
INSERT INTO `auth_permission` VALUES (11, 'config_update_logo', 'Module config');
INSERT INTO `auth_permission` VALUES (12, 'config_update_logo_mini', 'Module config');
INSERT INTO `auth_permission` VALUES (13, 'config_update_favicon', 'Module config');
INSERT INTO `auth_permission` VALUES (14, 'config_update_facebook', 'Module config');
INSERT INTO `auth_permission` VALUES (15, 'config_update_instagram', 'Module config');
INSERT INTO `auth_permission` VALUES (16, 'config_update_youtube', 'Module config');
INSERT INTO `auth_permission` VALUES (17, 'config_update_twitter', 'Module config');
INSERT INTO `auth_permission` VALUES (18, 'config_update_language', 'Module config');
INSERT INTO `auth_permission` VALUES (19, 'config_update_time_zone', 'Module config');
INSERT INTO `auth_permission` VALUES (20, 'config_update_max_upload', 'Module config');
INSERT INTO `auth_permission` VALUES (21, 'config_update_route_admin', 'Module config');
INSERT INTO `auth_permission` VALUES (22, 'config_update_route_login', 'Module config');
INSERT INTO `auth_permission` VALUES (23, 'config_update_encryption_key', 'Module config');
INSERT INTO `auth_permission` VALUES (24, 'config_update_encryption_url', 'Module config');
INSERT INTO `auth_permission` VALUES (25, 'config_update_url_suffix', 'Module config');
INSERT INTO `auth_permission` VALUES (26, 'config_update_user_log_status', 'Module config');
INSERT INTO `auth_permission` VALUES (27, 'config_update_maintenance_status', 'Module config');
INSERT INTO `auth_permission` VALUES (28, 'menu_list', 'Module menu');
INSERT INTO `auth_permission` VALUES (29, 'menu_add', 'Module menu');
INSERT INTO `auth_permission` VALUES (30, 'menu_update', 'Module menu');
INSERT INTO `auth_permission` VALUES (31, 'menu_delete', 'Module menu');
INSERT INTO `auth_permission` VALUES (32, 'menu_drag_positions', 'Module menu');
INSERT INTO `auth_permission` VALUES (33, 'user_list', 'Module user');
INSERT INTO `auth_permission` VALUES (34, 'user_add', 'Module user');
INSERT INTO `auth_permission` VALUES (35, 'user_update', 'Module user');
INSERT INTO `auth_permission` VALUES (36, 'user_detail', 'Module user');
INSERT INTO `auth_permission` VALUES (37, 'user_delete', 'Module user');
INSERT INTO `auth_permission` VALUES (38, 'groups_list', 'Module groups');
INSERT INTO `auth_permission` VALUES (39, 'groups_add', 'Module groups');
INSERT INTO `auth_permission` VALUES (40, 'groups_access', 'Module groups');
INSERT INTO `auth_permission` VALUES (41, 'groups_update', 'Module groups');
INSERT INTO `auth_permission` VALUES (42, 'groups_delete', 'Module groups');
INSERT INTO `auth_permission` VALUES (43, 'permission_list', 'Module permission');
INSERT INTO `auth_permission` VALUES (44, 'permission_add', 'Module permission');
INSERT INTO `auth_permission` VALUES (45, 'permission_update', 'Module permission');
INSERT INTO `auth_permission` VALUES (46, 'permission_delete', 'Module permission');
INSERT INTO `auth_permission` VALUES (47, 'dashboard__view_profile_user', 'Module dashboard');
INSERT INTO `auth_permission` VALUES (48, 'dashboard_view_total_user', 'Module dashboard');
INSERT INTO `auth_permission` VALUES (49, 'dashboard_view_total_group', 'Module dashboard');
INSERT INTO `auth_permission` VALUES (50, 'dashboard_view_total_permission', 'Module dashboard');
INSERT INTO `auth_permission` VALUES (51, 'dashboard_view_total_filemanager', 'Module dashboard');
INSERT INTO `auth_permission` VALUES (52, 'filemanager_list', 'Module filemanager');
INSERT INTO `auth_permission` VALUES (53, 'filemanager_add', 'Module filemanager');
INSERT INTO `auth_permission` VALUES (54, 'filemanager_delete', 'Module filemanager');
INSERT INTO `auth_permission` VALUES (55, 'sidebar_view_dashboard', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (56, 'sidebar_view_auth', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (57, 'sidebar_view_user', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (58, 'sidebar_view_groups', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (59, 'sidebar_view_permission', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (60, 'sidebar_view_config', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (61, 'sidebar_view_system', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (62, 'sidebar_view_management_menu', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (63, 'sidebar_view_file_manager', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (64, 'sidebar_view_m-crud_generator', 'Module Sidebar');
INSERT INTO `auth_permission` VALUES (65, 'crud_generator_list', 'Module crud generator');
INSERT INTO `auth_permission` VALUES (66, 'crud_generator_add', 'Module crud generator');
INSERT INTO `auth_permission` VALUES (67, 'crud_generator_delete', 'Module crud generator');
INSERT INTO `auth_permission` VALUES (68, 'sidebar_view_configuration', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (69, 'sidebar_view_settings', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (70, 'pelanggan_list', 'Module pelanggan');
INSERT INTO `auth_permission` VALUES (71, 'pelanggan_detail', 'Module pelanggan');
INSERT INTO `auth_permission` VALUES (72, 'pelanggan_add', 'Module pelanggan');
INSERT INTO `auth_permission` VALUES (73, 'pelanggan_update', 'Module pelanggan');
INSERT INTO `auth_permission` VALUES (74, 'pelanggan_delete', 'Module pelanggan');
INSERT INTO `auth_permission` VALUES (75, 'sidebar_view_data_pelanggan', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (76, 'piutang_list', 'Module piutang');
INSERT INTO `auth_permission` VALUES (77, 'piutang_detail', 'Module piutang');
INSERT INTO `auth_permission` VALUES (78, 'piutang_add', 'Module piutang');
INSERT INTO `auth_permission` VALUES (79, 'piutang_update', 'Module piutang');
INSERT INTO `auth_permission` VALUES (80, 'piutang_delete', 'Module piutang');
INSERT INTO `auth_permission` VALUES (81, 'sidebar_view_data_piutang', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (82, 'piutang_add_pembayaran', 'Module piutang');
INSERT INTO `auth_permission` VALUES (83, 'piutang_pembayaran_delete', 'Module piutang');

-- ----------------------------
-- Table structure for auth_permission_to_group
-- ----------------------------
DROP TABLE IF EXISTS `auth_permission_to_group`;
CREATE TABLE `auth_permission_to_group`  (
  `permission_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_permission_to_group
-- ----------------------------
INSERT INTO `auth_permission_to_group` VALUES (1, 2);
INSERT INTO `auth_permission_to_group` VALUES (2, 2);
INSERT INTO `auth_permission_to_group` VALUES (3, 2);
INSERT INTO `auth_permission_to_group` VALUES (4, 2);
INSERT INTO `auth_permission_to_group` VALUES (5, 2);
INSERT INTO `auth_permission_to_group` VALUES (6, 2);
INSERT INTO `auth_permission_to_group` VALUES (7, 2);
INSERT INTO `auth_permission_to_group` VALUES (8, 2);
INSERT INTO `auth_permission_to_group` VALUES (9, 2);
INSERT INTO `auth_permission_to_group` VALUES (10, 2);
INSERT INTO `auth_permission_to_group` VALUES (11, 2);
INSERT INTO `auth_permission_to_group` VALUES (12, 2);
INSERT INTO `auth_permission_to_group` VALUES (13, 2);
INSERT INTO `auth_permission_to_group` VALUES (14, 2);
INSERT INTO `auth_permission_to_group` VALUES (15, 2);
INSERT INTO `auth_permission_to_group` VALUES (16, 2);
INSERT INTO `auth_permission_to_group` VALUES (17, 2);
INSERT INTO `auth_permission_to_group` VALUES (18, 2);
INSERT INTO `auth_permission_to_group` VALUES (19, 2);
INSERT INTO `auth_permission_to_group` VALUES (20, 2);
INSERT INTO `auth_permission_to_group` VALUES (21, 2);
INSERT INTO `auth_permission_to_group` VALUES (22, 2);
INSERT INTO `auth_permission_to_group` VALUES (23, 2);
INSERT INTO `auth_permission_to_group` VALUES (24, 2);
INSERT INTO `auth_permission_to_group` VALUES (25, 2);
INSERT INTO `auth_permission_to_group` VALUES (26, 2);
INSERT INTO `auth_permission_to_group` VALUES (27, 2);
INSERT INTO `auth_permission_to_group` VALUES (33, 2);
INSERT INTO `auth_permission_to_group` VALUES (34, 2);
INSERT INTO `auth_permission_to_group` VALUES (35, 2);
INSERT INTO `auth_permission_to_group` VALUES (36, 2);
INSERT INTO `auth_permission_to_group` VALUES (37, 2);
INSERT INTO `auth_permission_to_group` VALUES (47, 2);
INSERT INTO `auth_permission_to_group` VALUES (52, 2);
INSERT INTO `auth_permission_to_group` VALUES (53, 2);
INSERT INTO `auth_permission_to_group` VALUES (54, 2);
INSERT INTO `auth_permission_to_group` VALUES (55, 2);
INSERT INTO `auth_permission_to_group` VALUES (56, 2);
INSERT INTO `auth_permission_to_group` VALUES (57, 2);
INSERT INTO `auth_permission_to_group` VALUES (60, 2);
INSERT INTO `auth_permission_to_group` VALUES (61, 2);
INSERT INTO `auth_permission_to_group` VALUES (63, 2);
INSERT INTO `auth_permission_to_group` VALUES (68, 2);
INSERT INTO `auth_permission_to_group` VALUES (69, 2);
INSERT INTO `auth_permission_to_group` VALUES (75, 2);
INSERT INTO `auth_permission_to_group` VALUES (81, 2);
INSERT INTO `auth_permission_to_group` VALUES (70, 2);
INSERT INTO `auth_permission_to_group` VALUES (71, 2);
INSERT INTO `auth_permission_to_group` VALUES (72, 2);
INSERT INTO `auth_permission_to_group` VALUES (73, 2);
INSERT INTO `auth_permission_to_group` VALUES (74, 2);
INSERT INTO `auth_permission_to_group` VALUES (76, 2);
INSERT INTO `auth_permission_to_group` VALUES (77, 2);
INSERT INTO `auth_permission_to_group` VALUES (78, 2);
INSERT INTO `auth_permission_to_group` VALUES (79, 2);
INSERT INTO `auth_permission_to_group` VALUES (80, 2);

-- ----------------------------
-- Table structure for auth_user
-- ----------------------------
DROP TABLE IF EXISTS `auth_user`;
CREATE TABLE `auth_user`  (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `photo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `token` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `last_login` datetime(0) NULL DEFAULT NULL,
  `ip_address` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1',
  `created` datetime(0) NULL DEFAULT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  `is_delete` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_user
-- ----------------------------
INSERT INTO `auth_user` VALUES (1, 'Mpampam Dev', '', 'mpampam@dev.com', '$2y$10$ONxIeWJ895ydHNUNlosW4OUNj6QL7bTOFjj5cpJD2dR90otT2bYY2', '4c88805560da6d9eb837e583fde4cfb8', '2021-03-05 23:13:00', '::1', '1', '2021-03-03 21:19:00', '2020-11-24 04:25:27', '0');
INSERT INTO `auth_user` VALUES (2, 'Admin', '', 'admin@mail.com', '$2y$10$5xxxFnqOpuQpmpyKoVtfeeaNyOw8xpDdRb8I6wSwIvEQpdsCu2lb.', '01ef99bccfa428c6d3065cc92e90048d', '2021-03-04 01:58:00', '::1', '1', '2021-03-04 01:32:16', NULL, '0');

-- ----------------------------
-- Table structure for auth_user_to_group
-- ----------------------------
DROP TABLE IF EXISTS `auth_user_to_group`;
CREATE TABLE `auth_user_to_group`  (
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_user_to_group
-- ----------------------------
INSERT INTO `auth_user_to_group` VALUES (1, 1);
INSERT INTO `auth_user_to_group` VALUES (2, 2);

-- ----------------------------
-- Table structure for ci_user_log
-- ----------------------------
DROP TABLE IF EXISTS `ci_user_log`;
CREATE TABLE `ci_user_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NULL DEFAULT NULL,
  `ip_address` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `controller` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for filemanager
-- ----------------------------
DROP TABLE IF EXISTS `filemanager`;
CREATE TABLE `filemanager`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ket` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created` datetime(0) NULL DEFAULT NULL,
  `update` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of filemanager
-- ----------------------------
INSERT INTO `filemanager` VALUES (1, '231120043259_logos1.png', 'LOGO APLIKASI', '2020-11-23 04:32:59', NULL);
INSERT INTO `filemanager` VALUES (2, '231120051100_logo_mini.png', 'LOGO MINI', '2020-11-23 05:11:00', NULL);
INSERT INTO `filemanager` VALUES (3, '231120051803_favicon.ico', 'FAVICON', '2020-11-23 05:18:03', NULL);
INSERT INTO `filemanager` VALUES (4, '030321213826_Untitled_1.jpg', 'Di upload melalui module Data Pelanggan', '2021-03-03 21:38:00', NULL);

-- ----------------------------
-- Table structure for main_menu
-- ----------------------------
DROP TABLE IF EXISTS `main_menu`;
CREATE TABLE `main_menu`  (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `is_parent` int(11) NULL DEFAULT NULL,
  `menu` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `slug` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type` enum('controller','url') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `controller` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `target` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `icon` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sort` int(11) NULL DEFAULT NULL,
  `created` datetime(0) NULL DEFAULT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 57 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of main_menu
-- ----------------------------
INSERT INTO `main_menu` VALUES (3, 7, 'management menu', 'management-menu', 'controller', 'main_menu', '', '', '1', 10, '2020-02-15 06:48:31', '2020-11-02 13:33:26');
INSERT INTO `main_menu` VALUES (7, 0, 'configuration', 'configuration', 'controller', '', '', 'fa fa-cogs', '1', 8, '2020-02-26 06:42:29', '2020-11-23 05:20:01');
INSERT INTO `main_menu` VALUES (34, 7, 'settings', 'settings', 'controller', 'setting', '', '', '1', 9, '2020-10-19 00:25:57', '2020-11-23 05:20:11');
INSERT INTO `main_menu` VALUES (36, 0, 'dashboard', 'dashboard', 'controller', 'dashboard', '', 'mdi mdi-laptop', '1', 1, '2020-10-27 08:18:55', '2020-11-09 23:07:13');
INSERT INTO `main_menu` VALUES (37, 0, 'auth', 'auth', NULL, '', NULL, 'mdi mdi-account-settings-variant', '1', 4, '2020-10-27 08:45:17', NULL);
INSERT INTO `main_menu` VALUES (38, 37, 'user', 'user', 'controller', 'user', NULL, 'mdi mdi-account-star', '1', 5, '2020-10-27 08:46:10', '2020-10-27 09:38:05');
INSERT INTO `main_menu` VALUES (39, 37, 'groups', 'groups', 'controller', 'group', NULL, '', '1', 6, '2020-10-27 08:48:28', '2020-10-27 20:24:12');
INSERT INTO `main_menu` VALUES (40, 37, 'permission', 'permission', 'controller', 'permission', NULL, '', '1', 7, '2020-10-27 08:49:49', '2020-10-29 22:47:10');
INSERT INTO `main_menu` VALUES (48, 0, 'm-crud generator', 'm-crud-generator', 'controller', 'm_crud_generator', '', 'mdi mdi-xml', '1', 12, '2020-11-01 12:23:11', '2020-11-22 00:06:35');
INSERT INTO `main_menu` VALUES (54, 7, 'file manager', 'file-manager', 'controller', 'filemanager', '', 'mdi mdi-folder-multiple-image', '1', 11, '2020-11-08 00:44:38', NULL);
INSERT INTO `main_menu` VALUES (55, 0, 'data pelanggan', 'data-pelanggan', 'controller', 'pelanggan', '', 'fa fa-user-circle-o', '1', 2, '2021-03-03 21:44:47', NULL);
INSERT INTO `main_menu` VALUES (56, 0, 'data piutang', 'data-piutang', 'controller', 'piutang', '', 'mdi mdi-file-document-box', '1', 3, '2021-03-03 22:08:47', NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `version` bigint(20) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1);

-- ----------------------------
-- Table structure for modules_crud_generator
-- ----------------------------
DROP TABLE IF EXISTS `modules_crud_generator`;
CREATE TABLE `modules_crud_generator`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `module_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `table` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of modules_crud_generator
-- ----------------------------
INSERT INTO `modules_crud_generator` VALUES (1, 'Pelanggan', 'Data Pelanggan', 'pelanggan', '2021-03-03 21:37:00');
INSERT INTO `modules_crud_generator` VALUES (2, 'Piutang', 'Data Piutang', 'piutang', '2021-03-03 21:58:00');

-- ----------------------------
-- Table structure for pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_lahir` date NULL DEFAULT NULL,
  `jenis_kelamin` enum('pria','wanita') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `telepon` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pelanggan
-- ----------------------------
INSERT INTO `pelanggan` VALUES (1, '1234567890', 'Abdullah majid', 'makassar', '2005-02-03', 'pria', 'jalan muhajirin no 3', '08754273527356272', '', '2021-03-03 21:38:00', '2021-03-03 23:39:00');

-- ----------------------------
-- Table structure for pembayaran
-- ----------------------------
DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE `pembayaran`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_piutang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `waktu_pembayaran` datetime(0) NULL DEFAULT NULL,
  `jumlah_pembayaran` bigint(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pembayaran
-- ----------------------------
INSERT INTO `pembayaran` VALUES (1, '6', '2021-03-16 01:16:16', 100000);
INSERT INTO `pembayaran` VALUES (7, '5', '2021-03-06 07:01:00', 400000);
INSERT INTO `pembayaran` VALUES (9, '5', '2021-03-06 09:14:00', 10000);

-- ----------------------------
-- Table structure for piutang
-- ----------------------------
DROP TABLE IF EXISTS `piutang`;
CREATE TABLE `piutang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) NULL DEFAULT NULL,
  `waktu_utang` datetime(0) NULL DEFAULT NULL,
  `jumlah` bigint(255) NULL DEFAULT NULL,
  `status_pembayaran` enum('belum','sudah') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'belum',
  `bunga` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `waktu_bayar` datetime(0) NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estimasi_bayar` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of piutang
-- ----------------------------
INSERT INTO `piutang` VALUES (4, 1, '2021-03-03 23:25:00', 1000000, 'belum', '0.1', '2021-03-03 23:45:00', 'estimasi bayar 3 blan', '2021-03-06');
INSERT INTO `piutang` VALUES (5, 1, '2021-03-03 23:43:00', 400000, 'sudah', '2', NULL, '', '2021-03-13');
INSERT INTO `piutang` VALUES (6, 1, '2021-03-05 22:48:00', 100000, 'belum', '30', NULL, '', '2021-03-05');

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `id_setting` int(11) NOT NULL,
  `group` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `options` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, 'general', 'web_name', 'Aplikasi Piutang');
INSERT INTO `setting` VALUES (2, 'general', 'web_domain', 'www.mpampam.com');
INSERT INTO `setting` VALUES (3, 'general', 'web_owner', 'Mpampam Dev');
INSERT INTO `setting` VALUES (4, 'general', 'email', 'mpampam@dev.com');
INSERT INTO `setting` VALUES (5, 'general', 'telepon', '085288888888');
INSERT INTO `setting` VALUES (6, 'general', 'address', '-');
INSERT INTO `setting` VALUES (7, 'general', 'logo', '231120043259_logos1.png');
INSERT INTO `setting` VALUES (8, 'general', 'logo_mini', '231120051100_logo_mini.png');
INSERT INTO `setting` VALUES (9, 'general', 'favicon', '231120051803_favicon.ico');
INSERT INTO `setting` VALUES (50, 'sosmed', 'facebook', 'https://facebook.com/mpampam');
INSERT INTO `setting` VALUES (51, 'general', 'instagram', 'https://instagram/mpampam');
INSERT INTO `setting` VALUES (52, 'sosmed', 'youtube', 'https://www.youtube.com/channel/UC1TlTaxRNdwrCqjBJ5zh6TA');
INSERT INTO `setting` VALUES (53, 'sosmed', 'twitter', 'https://twitter/m_pampam');
INSERT INTO `setting` VALUES (60, 'config', 'maintenance_status', 'N');
INSERT INTO `setting` VALUES (61, 'config', 'user_log_status', 'N');

SET FOREIGN_KEY_CHECKS = 1;
