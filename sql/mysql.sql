CREATE TABLE `xoops_stats` (
    `id`          TINYINT(4)  NOT NULL AUTO_INCREMENT,
    `titre`       VARCHAR(20) NOT NULL DEFAULT '',
    `count_table` VARCHAR(30) NOT NULL DEFAULT '',
    `champ_time`  VARCHAR(30) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
)
    ENGINE = ISAM
    AUTO_INCREMENT = 5;


INSERT INTO `xoops_stats`
VALUES (1, 'Articles', 'stories', 'published');
INSERT INTO `xoops_stats`
VALUES (2, 'Liens Web', 'mylinks_links', 'date');
INSERT INTO `xoops_stats`
VALUES (3, 'Téléchargements', 'mydownloads_downloads', 'date');
INSERT INTO `xoops_stats`
VALUES (4, 'Membres', 'users', 'user_regdate');
