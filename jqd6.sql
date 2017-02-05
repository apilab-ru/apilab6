-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 05 2017 г., 22:16
-- Версия сервера: 5.6.34
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `jqd6`
--

-- --------------------------------------------------------

--
-- Структура таблицы `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `struct_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `img_id` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `pre` text NOT NULL,
  `text` text NOT NULL,
  `date_change` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author` int(11) NOT NULL DEFAULT '0',
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `blocks`
--

CREATE TABLE `blocks` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `preset_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT 'Новый блок',
  `group` tinyint(4) NOT NULL DEFAULT '1',
  `weight` int(11) NOT NULL DEFAULT '0',
  `model` varchar(255) NOT NULL,
  `act` varchar(255) NOT NULL,
  `config` varchar(255) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `claim_message`
--

CREATE TABLE `claim_message` (
  `id` int(11) NOT NULL,
  `claim_id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `claim_options`
--

CREATE TABLE `claim_options` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `pre` text NOT NULL COMMENT 'Текст перед заявкой',
  `stat_ok` text NOT NULL,
  `stat_error` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `fields` mediumtext NOT NULL COMMENT 'Поле с jsonom вопросов'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `engine_blocks_preset`
--

CREATE TABLE `engine_blocks_preset` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group` tinyint(4) NOT NULL,
  `weight` int(11) NOT NULL,
  `mod` varchar(255) NOT NULL,
  `act` varchar(255) NOT NULL,
  `config` varchar(255) NOT NULL,
  `template_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `engine_block_act`
--

CREATE TABLE `engine_block_act` (
  `id` int(11) NOT NULL,
  `mod_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `param` text NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `engine_block_mod`
--

CREATE TABLE `engine_block_mod` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `engine_navigation`
--

CREATE TABLE `engine_navigation` (
  `id` int(11) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `alias` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `class` varchar(255) CHARACTER SET utf8 NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `engine_preset`
--

CREATE TABLE `engine_preset` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `mod` varchar(255) NOT NULL,
  `act` varchar(255) NOT NULL,
  `avtive` tinyint(4) NOT NULL DEFAULT '1',
  `config` varchar(255) NOT NULL,
  `template_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `engine_sessions`
--

CREATE TABLE `engine_sessions` (
  `id` int(11) UNSIGNED NOT NULL,
  `session_id` varchar(255) NOT NULL COMMENT 'Идентификатор сессии',
  `date_touched` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Время доступа к данным',
  `sess_data` text NOT NULL COMMENT 'Данные сессии'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `engine_tables`
--

CREATE TABLE `engine_tables` (
  `id` int(11) NOT NULL,
  `table` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `descr` text,
  `struct_id` int(11) NOT NULL DEFAULT '13',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `galery`
--

CREATE TABLE `galery` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `coment` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `globals`
--

CREATE TABLE `globals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `html_blocks`
--

CREATE TABLE `html_blocks` (
  `id` int(11) NOT NULL,
  `author` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `html` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `descr` text,
  `struct_id` int(11) NOT NULL DEFAULT '13',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `img_templates`
--

CREATE TABLE `img_templates` (
  `id` int(11) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `acess` tinyint(2) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `sticker_id` int(20) NOT NULL DEFAULT '0',
  `space_x` mediumint(3) UNSIGNED NOT NULL DEFAULT '0',
  `space_y` mediumint(3) UNSIGNED NOT NULL DEFAULT '0',
  `quality` mediumint(3) NOT NULL DEFAULT '0',
  `new_width` mediumint(3) UNSIGNED NOT NULL DEFAULT '0',
  `new_height` mediumint(3) UNSIGNED NOT NULL DEFAULT '0',
  `descriptions` varchar(255) DEFAULT NULL,
  `img_change_id` mediumint(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL,
  `log` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `main_rewrite`
--

CREATE TABLE `main_rewrite` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `old_url` varchar(255) NOT NULL,
  `new_url` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `answered` tinyint(1) NOT NULL DEFAULT '0',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `theme` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `cookie` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `answer` text CHARACTER SET utf8,
  `answer_author` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `request_log`
--

CREATE TABLE `request_log` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_send` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `send` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `set`
--

CREATE TABLE `set` (
  `key` varchar(255) NOT NULL,
  `val` text NOT NULL,
  `date_change` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `var` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `struct_id` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL,
  `img` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `struct`
--

CREATE TABLE `struct` (
  `id` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `class` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `theme` int(11) NOT NULL DEFAULT '2',
  `parent` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `mod` varchar(255) DEFAULT NULL,
  `act` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `element_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `templates`
--

CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `act_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tpl` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `acess` int(11) NOT NULL DEFAULT '1',
  `vk_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `article` ADD FULLTEXT KEY `title` (`title`,`pre`,`text`);

--
-- Индексы таблицы `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `claim_message`
--
ALTER TABLE `claim_message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `claim_options`
--
ALTER TABLE `claim_options`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `engine_blocks_preset`
--
ALTER TABLE `engine_blocks_preset`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `engine_block_act`
--
ALTER TABLE `engine_block_act`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `engine_block_mod`
--
ALTER TABLE `engine_block_mod`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `engine_navigation`
--
ALTER TABLE `engine_navigation`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `engine_preset`
--
ALTER TABLE `engine_preset`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `engine_sessions`
--
ALTER TABLE `engine_sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_id` (`session_id`);

--
-- Индексы таблицы `engine_tables`
--
ALTER TABLE `engine_tables`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `globals`
--
ALTER TABLE `globals`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `html_blocks`
--
ALTER TABLE `html_blocks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `img_templates`
--
ALTER TABLE `img_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- Индексы таблицы `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `main_rewrite`
--
ALTER TABLE `main_rewrite`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `request_log`
--
ALTER TABLE `request_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `set`
--
ALTER TABLE `set`
  ADD PRIMARY KEY (`key`);

--
-- Индексы таблицы `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `struct`
--
ALTER TABLE `struct`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);