--
-- Структура таблицы `log`
--
CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL,
  `log` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- USER
--  
ALTER TABLE `user` ADD `cookie` VARCHAR(255) NOT NULL AFTER `vk_id`;

