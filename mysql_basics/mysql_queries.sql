/* Place your queries below */

/* Feature Set 1 (done using c11_test database): */

SELECT * FROM `users` WHERE `username` = 'Ichabod Crane'
SELECT * FROM `users` WHERE `username` LIKE '%Ichabod%'
UPDATE `users` SET `email`='ichabod_crane@sleepy_hollow.gov' WHERE `username` = 'Ichabod Crane'
INSERT INTO `users` (`id`, `username`, `password`, `email`, `created`, `updated`, `status`) VALUES (NULL, 'Oscar Madison', SHA1('thesloppyone'), 'oscar_madison@odd_couple.com', NOW(), NOW(), 'new');
DELETE FROM `users` WHERE username='Oscar Madison'

/* Feature Set 2 (todo_items table): */
/* Create Table: */
CREATE TABLE `c11_test`.`todo_items` ( `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT KEY , `title` VARCHAR(50) NOT NULL , `details` VARCHAR(500) NOT NULL , `timestamp` INT(11) NOT NULL , `user_id` INT(11) UNSIGNED NOT NULL );
/* Create 10 items: */
INSERT INTO `todo_items` SET `id`=NULL, `title`='Research Login Library', `details`='Evaluate various login and authentication libraries and select one for use.', `timestamp`=NOW(), `user_id`=12345;
INSERT INTO `todo_items` SET `id`=NULL, `title`='Research Billing Library', `details`='Evaluate various billing and credit card libraries and select one for use.', `timestamp`=NOW(), `user_id`=12345;
INSERT INTO `todo_items` SET `id`=NULL, `title`='Build Wire Frames', `details`='Build basic wire frames for all panes.', `timestamp`=NOW(), `user_id`=98765;
INSERT INTO `todo_items` SET `id`=NULL, `title`='Build Skeleton Code', `detailsINSERT INTO `todo_items` SET `id`=NULL, `title`='Implement Angular Controllers', `details`='Populate controller for all Angular templates.', `timestamp`=NOW(), `user_id`=22222;`='Build basic HTML layout for all panes.', `timestamp`=NOW(), `user_id`=98765;
INSERT INTO `todo_items` SET `id`=NULL, `title`='Implement Angular Controllers', `details`='Populate controller for all Angular templates.', `timestamp`=NOW(), `user_id`=22222;
INSERT INTO `todo_items` SET `id`=NULL, `title`='Implement Angular Services', `details`='Populate service for all data sources.', `timestamp`=NOW(), `user_id`=44444;
INSERT INTO `todo_items` SET `id`=NULL, `title`='System Testing', `details`='Perform system test on all modules.', `timestamp`=NOW(), `user_id`=77777;
INSERT INTO `todo_items` SET `id`=NULL, `title`='Performance Testing', `details`='Execute performance tests and validate on all specified configurations.', `timestamp`=NOW(), `user_id`=88765;
INSERT INTO `todo_items` SET `id`=NULL, `title`='Finalize CD', `details`='Final build for shipping CDs.', `timestamp`=NOW(), `user_id`=33333;
INSERT INTO `todo_items` SET `id`=NULL, `title`='Launch Party', `details`='Bake all four cakes for the launch party and book the DJ.', `timestamp`=NOW(), `user_id`=99999;
/* Select all todo_items with a particular user_id. */
SELECT * FROM `todo_items` WHERE `user_id` = 12345
/* Insert a new todo_item into the table by that user. */
INSERT INTO `todo_items` SET `id`=NULL, `title`='Prepare User Documentation', `details`='Prepare user documentation and translate to all specified languages.', `timestamp`=NOW(), `user_id`=12345;
/* Delete a todo_item by that user. */
DELETE FROM `todo_items` WHERE user_id = 12345
/* Update a todo_item by that user with data of your choice. */
UPDATE `todo_items` SET `user_id` = 44321 WHERE `user_id` = 12345
/* Select to get all information from users by using the user's ID. */
SELECT * FROM `todo_items` WHERE `user_id` > 0

