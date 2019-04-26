---
--- Добавление в список типов контента для поста
--- 
INSERT INTO `content_types` (`title`, `class_name`) VALUES
('Текст', 'text'),
('Цитата', 'quote'),
('Картинка', 'photo'),
('Видео', 'video'),
('Ссылка', 'link');

---
--- Создание списка пользователей
---
INSERT INTO `users` (`email`, `password`, `username`, `avatar_url`, `about`, `reg_ts`) VALUES 
('larisa@mail.ru', '$2y$10$oqG4Ke1bDXYJsqVVJlc5L.0TxM7.xG1XAF9Cj8Pad3l3iI6amkFp2', 'Лариса', 'userpic-larisa-small.jpg', '', '2019-04-10 00:00:01'),
('vladik@mail.ru', '$2y$10$oqG4Ke1bDXYJsqVVJlc5L.0TxM7.xG1XAF9Cj8Pad3l3iI6amkFp2', 'Владик', 'userpic.jpg', '', '2019-04-12 01:22:00'),
('viktor@mail.ru', '$2y$10$oqG4Ke1bDXYJsqVVJlc5L.0TxM7.xG1XAF9Cj8Pad3l3iI6amkFp2', 'Виктор', 'userpic-mark.jpg', '', '2019-04-18 12:00:00');

---
--- Список постов
---
INSERT INTO `posts` (`subject`, `content`, `img_url`, `link_url`, `video_url`, `quote_author`, `total_views`, `created_ts`, `author_id`, `content_type`) 
VALUES('Цитата', 'Мы в жизни любим только раз, а после ищем лишь похожих.', NULL, NULL, NULL, 'С.А.Есенин', 100, '2019-04-11 17:50:18', 1, 2);
INSERT INTO `posts` (`subject`, `content`, `img_url`, `link_url`, `video_url`, `quote_author`, `total_views`, `created_ts`, `author_id`, `content_type`) 
VALUES('Игра пристолов', 'Не могу дождаться начала финального сезона своего любимого сериала!', NULL, NULL, NULL, '', 2, '2019-04-26 17:58:22', 2, 1);
INSERT INTO `posts` (`subject`, `content`, `img_url`, `link_url`, `video_url`, `quote_author`, `total_views`, `created_ts`, `author_id`, `content_type`) 
VALUES('Наконец, обработал фотки!', '', 'rock-medium.jpg', NULL, NULL, '', 4, '2019-04-26 17:59:26', 3, 3);
INSERT INTO `posts` (`subject`, `content`, `img_url`, `link_url`, `video_url`, `quote_author`, `total_views`, `created_ts`, `author_id`, `content_type`) 
VALUES('Моя мечта', '', 'coast-medium.jpg', NULL, NULL, '', 43, '2019-04-26 18:00:31', 1, 3);
INSERT INTO `posts` (`subject`, `content`, `img_url`, `link_url`, `video_url`, `quote_author`, `total_views`, `created_ts`, `author_id`, `content_type`) 
VALUES('Лучшие курсы', NULL, NULL, 'www.htmlacademy.ru', NULL, '', 32, '2019-04-26 18:03:06', 2, 5);
INSERT INTO `posts` (`subject`, `content`, `img_url`, `link_url`, `video_url`, `quote_author`, `total_views`, `created_ts`, `author_id`, `content_type`) 
VALUES('Полезный пост про Байкал', 'Озеро Байкал – огромное древнее озеро в горах Сибири к северу от монгольской границы. Байкал считается самым глубоким озером в мире. Он окружен сетью пешеходных маршрутов, называемых Большой байкальской тропой. Деревня Листвянка, расположенная на западном берегу озера, – популярная отправная точка для летних экскурсий. Зимой здесь можно кататься на коньках и собачьих упряжках.', NULL, NULL, NULL, '', 68, '2019-04-26 18:06:01', 1, 1);

---
--- Несколько комментариев
---
INSERT INTO `comments` (`content`, `from_id`, `post_id`, `created_ts`) VALUES('Красивые слова.', 2, 1, '2019-04-26 21:19:40');
INSERT INTO `comments` (`content`, `from_id`, `post_id`, `created_ts`) VALUES('Полезная информация с Википедии )', 3, 6, '2019-04-26 21:20:36');
INSERT INTO `comments` (`content`, `from_id`, `post_id`, `created_ts`) VALUES('А мне не нравится этот сериал.', 1, 2, '2019-04-26 21:21:37');

---
--- Получить список постов с сортировкой по популярности и вместе с именами авторов и типом контента
---
SELECT t1.id, subject, t4.title as content_type, username, count(t2.from_id) as total_likes 
FROM `posts` as t1 
inner join likes as t2 on t1.id=t2.post_id 
join users as t3 on t1.author_id=t3.id 
join content_types as t4 on t1.content_type=t4.id
group by t2.post_id 
ORDER BY `total_likes` DESC

---
--- Получить список постов для конкретного пользователя
---
SELECT * FROM `posts` where author_id = 1

---
--- Получить список комментариев для одного поста, в комментариях должен быть логин пользователя
---
SELECT t1.content,username,post_id,t1.created_ts FROM `comments` as t1
RIGHT JOIN posts as t2 on t1.post_id=t2.id
JOIN users as t3 on t1.from_id=t3.id
WHERE t1.post_id=1

---
--- Добавить лайк к посту
---
INSERT INTO `likes` (`from_id`, `post_id`) VALUES(1, 1);

---
--- Подписаться на пользователя
---
INSERT INTO `subscriptions` (`subscriber_id`, `author_id`) VALUES ('3', '1');
