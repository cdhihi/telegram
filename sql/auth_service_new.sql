/*
 Navicat Premium Data Transfer

 Source Server         : 192.168.80.132
 Source Server Type    : MySQL
 Source Server Version : 50738
 Source Host           : 192.168.80.132:3306
 Source Schema         : auth_service

 Target Server Type    : MySQL
 Target Server Version : 50738
 File Encoding         : 65001

 Date: 27/07/2022 16:41:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sys_advertise
-- ----------------------------
DROP TABLE IF EXISTS `sys_advertise`;
CREATE TABLE `sys_advertise`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '广告名称',
  `link` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '广告链接',
  `status` smallint(6) NOT NULL DEFAULT 1 COMMENT '状态 0：禁用 1：正常',
  `create_uid` int(11) NOT NULL COMMENT '创建者ID',
  `create_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `update_time` timestamp(0) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '广告表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_advertise
-- ----------------------------
INSERT INTO `sys_advertise` VALUES (1, '百度12', 'http://baidu.com1', 1, 1, '2022-07-16 10:36:04', '2022-07-17 02:40:18');
INSERT INTO `sys_advertise` VALUES (2, '新浪', 'http://xinlang.com', 1, 1, '2022-07-16 13:02:30', '2022-07-16 21:02:23');
INSERT INTO `sys_advertise` VALUES (3, '111', 'http://baidu.com1', 1, 0, '2022-07-16 18:37:46', '2022-07-17 02:39:48');
INSERT INTO `sys_advertise` VALUES (4, '222', 'http://baidu.com1', 1, 0, '2022-07-16 18:39:31', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for sys_bot
-- ----------------------------
DROP TABLE IF EXISTS `sys_bot`;
CREATE TABLE `sys_bot`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'bot名称',
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'bot的用户名',
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'botkey',
  `create_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `status` smallint(1) NOT NULL COMMENT '状态 0：禁用 1：正常',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_bot
-- ----------------------------
INSERT INTO `sys_bot` VALUES (1, '开车测试机器人', 'cdkcBot', '5462861622:AAFOY1jqE-PuERg-gdd7MAZ0DkOai-1JWo0', '2022-07-17 17:03:04', 0);
INSERT INTO `sys_bot` VALUES (2, '2222', '22', '333', '2022-07-17 17:47:13', 1);

-- ----------------------------
-- Table structure for sys_group
-- ----------------------------
DROP TABLE IF EXISTS `sys_group`;
CREATE TABLE `sys_group`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_id` int(11) NOT NULL COMMENT 'telegram群组id',
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT '群组名称',
  `status` smallint(1) NOT NULL DEFAULT 1 COMMENT '状态 0:禁用 1:正常',
  `create_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `update_time` timestamp(0) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '群组' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_group
-- ----------------------------
INSERT INTO `sys_group` VALUES (1, 1, '1', 11, '2022-07-18 17:45:15', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for sys_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_menu`;
CREATE TABLE `sys_menu`  (
  `menu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '菜单唯一标识',
  `parent_id` int(11) NOT NULL COMMENT '父菜单ID,一级菜单为0',
  `menu_name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '菜单名称',
  `path` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '路径',
  `menu_type` smallint(6) NOT NULL COMMENT '类型 0:目录 1:菜单 2:按钮',
  `icon` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '菜单图标',
  `create_uid` int(11) NOT NULL COMMENT '创建者ID',
  `update_uid` int(11) NOT NULL COMMENT '修改者ID',
  `create_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `update_time` timestamp(0) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `status` smallint(6) NOT NULL COMMENT '状态 0:禁用 1:正常',
  `router` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '路由',
  `alias` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '别名',
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_menu
-- ----------------------------
INSERT INTO `sys_menu` VALUES (1, 0, '系统管理', '', 0, 'settings', 1, 1, '2019-08-21 11:27:03', '2019-07-11 17:40:07', 1, NULL, '');
INSERT INTO `sys_menu` VALUES (8, 1, '用户管理', 'system/user', 1, 'account_circle', 1, 1, '2019-08-20 19:04:00', '2019-08-16 14:49:58', 1, 'system/User', 'sys:user:list');
INSERT INTO `sys_menu` VALUES (9, 1, '角色管理', 'system/role', 1, 'perm_identity', 1, 1, '2019-08-20 19:04:01', '2019-08-19 11:05:58', 1, 'system/Role', 'sys:role:list');
INSERT INTO `sys_menu` VALUES (10, 1, '菜单管理', 'system/menu', 1, 'menu', 1, 1, '2019-08-20 19:04:02', '2019-07-11 15:55:02', 1, 'system/Menu', 'sys:menu:list');
INSERT INTO `sys_menu` VALUES (12, 1, '资源管理', 'system/resource', 1, 'folder', 1, 1, '2019-08-20 19:04:05', '2019-08-19 11:05:57', 1, 'system/Resource', 'sys:resource:list');
INSERT INTO `sys_menu` VALUES (13, 1, '广告管理', 'system/advertise', 1, 'chrome_reader_mode', 1, 1, '2022-07-15 16:39:08', '0000-00-00 00:00:00', 1, 'system/Advertise', 'sys:advertise:lit');
INSERT INTO `sys_menu` VALUES (15, 1, '视频管理', 'system/video', 1, 'ondemand_video', 1, 1, '2022-07-17 08:27:50', '0000-00-00 00:00:00', 1, 'system/Video', 'sys:video:lit');
INSERT INTO `sys_menu` VALUES (16, 1, '机器人管理', 'system/bot', 1, 'accessibility', 1, 1, '2022-07-17 16:11:34', '0000-00-00 00:00:00', 1, 'system/Bot', 'sys:bot:lit');
INSERT INTO `sys_menu` VALUES (17, 1, '群管理', 'system/group', 1, 'group', 1, 1, '2022-07-17 16:11:29', '0000-00-00 00:00:00', 1, 'system/Group', 'sys:group:lit');

-- ----------------------------
-- Table structure for sys_menu_resource
-- ----------------------------
DROP TABLE IF EXISTS `sys_menu_resource`;
CREATE TABLE `sys_menu_resource`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL COMMENT '菜单ID',
  `resource_id` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '资源ID',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_menu_resource
-- ----------------------------
INSERT INTO `sys_menu_resource` VALUES (1, 13, 'f705e671c6b7d38ee594017db55f1814');

-- ----------------------------
-- Table structure for sys_migration
-- ----------------------------
DROP TABLE IF EXISTS `sys_migration`;
CREATE TABLE `sys_migration`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` bigint(20) NOT NULL,
  `is_rollback` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_migration
-- ----------------------------
INSERT INTO `sys_migration` VALUES (1, 'App\\Model\\Migration\\MenuResource', 20190709110615, 2);
INSERT INTO `sys_migration` VALUES (2, 'App\\Model\\Migration\\RoleResource', 20190709110347, 2);
INSERT INTO `sys_migration` VALUES (3, 'App\\Model\\Migration\\RoleMenu', 20190709110525, 2);
INSERT INTO `sys_migration` VALUES (4, 'App\\Model\\Migration\\User', 20190709102419, 2);
INSERT INTO `sys_migration` VALUES (5, 'App\\Model\\Migration\\Resource', 20190709110443, 2);
INSERT INTO `sys_migration` VALUES (6, 'App\\Model\\Migration\\Menu', 20190709110557, 2);
INSERT INTO `sys_migration` VALUES (7, 'App\\Model\\Migration\\UserRole', 20190709110423, 2);
INSERT INTO `sys_migration` VALUES (8, 'App\\Model\\Migration\\Role', 20190709105655, 2);

-- ----------------------------
-- Table structure for sys_resource
-- ----------------------------
DROP TABLE IF EXISTS `sys_resource`;
CREATE TABLE `sys_resource`  (
  `resource_id` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '资源唯一标识',
  `resource_name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '资源名称',
  `mapping` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '路径映射',
  `method` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '请求方式',
  `auth_type` smallint(6) NOT NULL COMMENT '权限认证类型1:是否需要登录2:开放3:是否鉴定权限',
  `update_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '修改时间',
  `perm` varchar(68) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '权限标识',
  PRIMARY KEY (`resource_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_resource
-- ----------------------------
INSERT INTO `sys_resource` VALUES ('008c5504a999181eb0051016223c2c2a', '删除指定角色信息', '/auth-service/role/{roleId}', 'DELETE', 3, '2022-07-15 12:23:34', 'DELETE:/auth-service/role/{roleId}');
INSERT INTO `sys_resource` VALUES ('1992db9b9427b66b4247c20d08e1386a', '账号登录', '/auth-service/account/token', 'POST', 2, '2022-07-15 12:23:34', 'POST:/auth-service/account/token');
INSERT INTO `sys_resource` VALUES ('1f269fdf908c638b279d346eca414640', '获取账号详细信息', '/auth-service/account/info', 'GET', 1, '2022-07-15 12:23:34', 'GET:/auth-service/account/info');
INSERT INTO `sys_resource` VALUES ('249c7aeaddaa51fd21d87052e5f576ba', '获取所有用户信息', '/auth-service/user', 'GET', 3, '2022-07-15 12:23:34', 'GET:/auth-service/user');
INSERT INTO `sys_resource` VALUES ('251638d128962c4934b03fac6f0494ed', '获取指定用户信息', '/auth-service/user/{uid}', 'GET', 3, '2022-07-15 12:23:34', 'GET:/auth-service/user/{uid}');
INSERT INTO `sys_resource` VALUES ('303fc27ab54280b6f00d5835c1b34823', '获取账号菜单', '/auth-service/account/menu', 'GET', 1, '2022-07-15 12:23:34', 'GET:/auth-service/account/menu');
INSERT INTO `sys_resource` VALUES ('52971390ae4c63681ff3394646b7a01c', '刷新资源', '/auth-service/resource', 'PUT', 3, '2022-07-15 12:23:34', 'PUT:/auth-service/resource');
INSERT INTO `sys_resource` VALUES ('55983e4ea480ba85720f2212ee5ec886', '获取菜单列表(目录、菜单)', '/auth-service/menu/list', 'GET', 3, '2022-07-15 12:23:34', 'GET:/auth-service/menu/list');
INSERT INTO `sys_resource` VALUES ('717f1d6acf678059d3219a42782577b4', '创建角色', '/auth-service/role', 'POST', 3, '2022-07-15 12:23:34', 'POST:/auth-service/role');
INSERT INTO `sys_resource` VALUES ('7d358fb22e3012d3cbff6ea59eb89183', '创建菜单', '/auth-service/menu', 'POST', 3, '2022-07-15 12:23:34', 'POST:/auth-service/menu');
INSERT INTO `sys_resource` VALUES ('80ea55dede4fc8de34382d58e7bbc794', '获取账号菜单', '/auth-service/account/button', 'GET', 1, '2022-07-15 12:23:34', 'GET:/auth-service/account/button');
INSERT INTO `sys_resource` VALUES ('85129053780d148bc9c6c36bea87fc69', '获取所有资源信息', '/auth-service/resource', 'GET', 3, '2022-07-15 12:23:34', 'GET:/auth-service/resource');
INSERT INTO `sys_resource` VALUES ('85ebfb7e9c578f353577287ade9ad6c9', '重置密码', '/auth-service/user/{uid}/password', 'PUT', 3, '2022-07-15 12:23:34', 'PUT:/auth-service/user/{uid}/password');
INSERT INTO `sys_resource` VALUES ('94e3ddd1668169009542ba1aaa6b6bdb', '删除指定菜单', '/auth-service/menu/{menuId}', 'DELETE', 3, '2022-07-15 12:23:34', 'DELETE:/auth-service/menu/{menuId}');
INSERT INTO `sys_resource` VALUES ('a614b5b911e4a6d5fc4df27fde27890e', '修改账号信息', '/auth-service/account/info', 'PUT', 1, '2022-07-15 12:23:34', 'PUT:/auth-service/account/info');
INSERT INTO `sys_resource` VALUES ('ab777bb4b2b3ad8b96fc5cece9576aab', '修改密码', '/auth-service/account/password', 'PUT', 1, '2022-07-15 12:23:34', 'PUT:/auth-service/account/password');
INSERT INTO `sys_resource` VALUES ('abc6a5c291cee62207204a3bd28e1d26', '获取指定菜单列表', '/auth-service/menu/{menuId}', 'GET', 3, '2022-07-15 12:23:34', 'GET:/auth-service/menu/{menuId}');
INSERT INTO `sys_resource` VALUES ('b224f5bf274cf6e7982d51443aa7c857', '修改用户信息', '/auth-service/user/{uid}', 'PUT', 3, '2022-07-15 12:23:34', 'PUT:/auth-service/user/{uid}');
INSERT INTO `sys_resource` VALUES ('b427bcd8743ba1a8730b019d3c6068be', '设置用户状态', '/auth-service/user/{uid}/status', 'PUT', 3, '2022-07-15 12:23:34', 'PUT:/auth-service/user/{uid}/status');
INSERT INTO `sys_resource` VALUES ('bd2a50519bd2e2fb58c0f8e26bbbbf1f', '更新指定菜单', '/auth-service/menu/{menuId}/status', 'PUT', 3, '2022-07-15 12:23:34', 'PUT:/auth-service/menu/{menuId}/status');
INSERT INTO `sys_resource` VALUES ('bd9a93c74838bcf6ddf3d6db997f1668', '刷新token', '/auth-service/account/refresh', 'GET', 1, '2022-07-15 12:23:34', 'GET:/auth-service/account/refresh');
INSERT INTO `sys_resource` VALUES ('c4e605798ab049733af8e45e6e8bf895', '获取所有角色信息', '/auth-service/role', 'GET', 3, '2022-07-15 12:23:34', 'GET:/auth-service/role');
INSERT INTO `sys_resource` VALUES ('e54fc20e1e3ce9eb04cd3ded153d676b', '修改角色菜单', '/auth-service/role/{roleId}/menus', 'PUT', 3, '2022-07-15 12:23:34', 'PUT:/auth-service/role/{roleId}/menus');
INSERT INTO `sys_resource` VALUES ('e599e9195df9cf61aaca8ed36f1e5ebc', '退出登录', '/auth-service/account/logout', 'GET', 1, '2022-07-15 12:23:34', 'GET:/auth-service/account/logout');
INSERT INTO `sys_resource` VALUES ('e9ec5f8a2c0b19cbc79b23e7101b0086', '更新角色信息', '/auth-service/role/{roleId}', 'PUT', 3, '2022-07-15 12:23:34', 'PUT:/auth-service/role/{roleId}');
INSERT INTO `sys_resource` VALUES ('f0355b5eb2f9d11dee544c30ce600713', '获取所有菜单列表', '/auth-service/menu', 'GET', 3, '2022-07-15 12:23:34', 'GET:/auth-service/menu');
INSERT INTO `sys_resource` VALUES ('f705e671c6b7d38ee594017db55f1814', '创建用户', '/auth-service/user', 'POST', 3, '2022-07-15 12:23:34', 'POST:/auth-service/user');
INSERT INTO `sys_resource` VALUES ('f8bae34e99a4c460fb78e3e6e1857e26', '获取指定角色信息', '/auth-service/role/{roleId}', 'GET', 3, '2022-07-15 12:23:34', 'GET:/auth-service/role/{roleId}');
INSERT INTO `sys_resource` VALUES ('fbd18c637ace8b36d149c214fa19098e', '更新指定菜单', '/auth-service/menu/{menuId}', 'PUT', 3, '2022-07-15 12:23:34', 'PUT:/auth-service/menu/{menuId}');

-- ----------------------------
-- Table structure for sys_role
-- ----------------------------
DROP TABLE IF EXISTS `sys_role`;
CREATE TABLE `sys_role`  (
  `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '角色唯一标识',
  `role_name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '角色',
  `create_uid` int(11) NOT NULL COMMENT '创建者ID',
  `update_uid` int(11) NOT NULL COMMENT '修改者ID',
  `create_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `update_time` timestamp(0) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `remark` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '备注',
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_role
-- ----------------------------
INSERT INTO `sys_role` VALUES (1, '超级管理员', 1, 1, '2019-08-12 17:04:55', '2019-08-12 17:04:55', '超级管理员');
INSERT INTO `sys_role` VALUES (2, '普通管理员', 1, 1, '2018-11-12 16:00:17', '2018-11-12 16:00:19', '普通管理员');

-- ----------------------------
-- Table structure for sys_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_role_menu`;
CREATE TABLE `sys_role_menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  `menu_id` int(11) NOT NULL COMMENT '菜单ID',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 69 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_role_menu
-- ----------------------------
INSERT INTO `sys_role_menu` VALUES (51, 1, 1);
INSERT INTO `sys_role_menu` VALUES (52, 1, 13);
INSERT INTO `sys_role_menu` VALUES (53, 1, 16);
INSERT INTO `sys_role_menu` VALUES (54, 1, 8);
INSERT INTO `sys_role_menu` VALUES (55, 1, 17);
INSERT INTO `sys_role_menu` VALUES (56, 1, 10);
INSERT INTO `sys_role_menu` VALUES (57, 1, 15);
INSERT INTO `sys_role_menu` VALUES (58, 1, 9);
INSERT INTO `sys_role_menu` VALUES (59, 1, 12);
INSERT INTO `sys_role_menu` VALUES (60, 2, 1);
INSERT INTO `sys_role_menu` VALUES (61, 2, 13);
INSERT INTO `sys_role_menu` VALUES (62, 2, 16);
INSERT INTO `sys_role_menu` VALUES (63, 2, 8);
INSERT INTO `sys_role_menu` VALUES (64, 2, 17);
INSERT INTO `sys_role_menu` VALUES (65, 2, 10);
INSERT INTO `sys_role_menu` VALUES (66, 2, 15);
INSERT INTO `sys_role_menu` VALUES (67, 2, 9);
INSERT INTO `sys_role_menu` VALUES (68, 2, 12);

-- ----------------------------
-- Table structure for sys_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user`  (
  `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户唯一标识',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '用户名',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '邮箱',
  `phone` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '手机',
  `status` smallint(6) NOT NULL COMMENT '状态 0：禁用 1：正常',
  `create_uid` int(11) NOT NULL COMMENT '创建者ID',
  `create_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `update_time` timestamp(0) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `login_name` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '登录名',
  `password` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '密码',
  `ip` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'IP地址',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES (1, '', '', '', 1, 1, '2019-08-02 11:58:41', '2022-07-17 01:32:24', 'test', '0711b926d862dc50b1c8502270b03fa3', '192.168.23.69');
INSERT INTO `sys_user` VALUES (2, '', '', '', 1, 1, '2019-08-02 11:58:41', '2022-07-17 00:01:10', 'test', '0711b926d862dc50b1c8502270b03fa3', '192.168.23.69');
INSERT INTO `sys_user` VALUES (7, 'test', '11@qq.com', '138385438', 1, 1, '2019-08-09 17:23:34', '2019-08-15 11:48:21', 'wp', '3086e29cae227a6a19d5d2a6bc921187', '192.168.23.89');
INSERT INTO `sys_user` VALUES (8, 'test', '123@qq.com', '138385438', 1, 1, '2019-08-09 17:25:09', '2019-08-16 10:46:44', '123w', '9d402a6bbc8bcb6f2846a2c346b3daf0', '192.168.23.89');
INSERT INTO `sys_user` VALUES (9, 'adler', '111@qq.com', '15172277272', 1, 1, '2022-07-27 16:29:56', '2022-07-27 16:31:43', 'cdhihi', '253ab0fb8d4cd83e1e63003475ce62e4', '192.168.80.1');

-- ----------------------------
-- Table structure for sys_user_role
-- ----------------------------
DROP TABLE IF EXISTS `sys_user_role`;
CREATE TABLE `sys_user_role`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_user_role
-- ----------------------------
INSERT INTO `sys_user_role` VALUES (3, 2, 2);
INSERT INTO `sys_user_role` VALUES (10, 7, 2);
INSERT INTO `sys_user_role` VALUES (11, 8, 1);
INSERT INTO `sys_user_role` VALUES (17, 1, 1);
INSERT INTO `sys_user_role` VALUES (18, 1, 2);
INSERT INTO `sys_user_role` VALUES (19, 9, 1);
INSERT INTO `sys_user_role` VALUES (20, 9, 2);

-- ----------------------------
-- Table structure for sys_video
-- ----------------------------
DROP TABLE IF EXISTS `sys_video`;
CREATE TABLE `sys_video`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '视频名称',
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '视频地址',
  `type` smallint(2) NOT NULL DEFAULT 1 COMMENT '1短视频，2长视频',
  `status` smallint(6) NOT NULL DEFAULT 1 COMMENT '状态 0：禁用 1：正常',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '视频封面',
  `describe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '描述',
  `create_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '视频表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_video
-- ----------------------------
INSERT INTO `sys_video` VALUES (1, '111', 'http://res.cloudinary.com/dvzwc5v4d/video/upload/v1657728603/jtegaplyxxb9n1ykeeo8.mp4', 1, 1, '0', 'wwww', '2022-07-27 08:16:09');
INSERT INTO `sys_video` VALUES (13, '111', 'http://res.cloudinary.com/dvzwc5v4d/video/upload/v1657728645/w9hjitb76xwbtwrdksgk.mp4', 1, 1, '0', '0', '2022-07-21 14:00:24');
INSERT INTO `sys_video` VALUES (14, '022', 'http://res.cloudinary.com/dvzwc5v4d/video/upload/v1657728603/jtegaplyxxb9n1ykeeo8.mp4', 2, 1, '0', '0', '2022-07-21 14:00:14');
INSERT INTO `sys_video` VALUES (15, '22', 'http://res.cloudinary.com/dvzwc5v4d/video/upload/v1657728645/w9hjitb76xwbtwrdksgk.mp4', 2, 1, '0', '0', '2022-07-21 14:00:26');

SET FOREIGN_KEY_CHECKS = 1;
