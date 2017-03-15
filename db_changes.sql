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

ALTER TABLE `tags` CHANGE `table_id` `object` VARCHAR(100) NOT NULL;

UPDATE `tags` SET `object`='article' where object=1;
ALTER TABLE `tags` CHANGE `object` `object` ENUM('article','images','files') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

-- Изменения данных block
-- статьи
UPDATE `blocks` SET act='main' where model='article' && act='act_main';
ALTER TABLE `blocks` CHANGE `template_id` `tpl` VARCHAR(50) NULL DEFAULT NULL;
UPDATE `blocks` SET `tpl` = 'main' WHERE `tpl` = '1';
UPDATE `blocks` SET `tpl` = 'second' where tpl='15';

--html блоки
UPDATE `blocks` SET `model`='html',`act`='html' where act='act_html_block';
UPDATE `blocks` SET tpl='' WHERE tpl=4;

--auth
DELETE FROM `blocks` WHERE `act` = 'act_mini';

--menu
UPDATE `blocks` SET `act`='menu',`model`='struct' where `act`='act_menu';
UPDATE `blocks` SET `tpl`='top' where tpl in('2','7')

--Список документов
UPDATE `blocks` SET `model` ='files',`act`='listDocs' where act='act_list_for_struct';
--Картинки
UPDATE `blocks` SET`model`='files',act='listImages' where act='act_galery_for_struct';
UPDATE `blocks` SET tpl='listImages' where tpl=13;

