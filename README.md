1) Project is developed in codeigniter3
2) please import the database file in the root directory and update required parameters in database.php
3) Link to create admin : whiterhabit-machine-test/login/createAdmin
4) Admin username and password, if already exists : wrAdmin : admin123


Please Run the following queries to add menus and permissions.
------------------------------------------------------------------


INSERT INTO `wh_menu_master` (`id`, `menuname`, `link`, `parent`, `wieght`, `iconclass`, `createdtime`, `createdby`, `status`) VALUES
(3, 'Users', '/users', 0, 3, 'nav-icon fas fa-user', '2020-10-22 00:00:00', '1', 1);


INSERT INTO `wh_role_master` (`id`, `name`, `status`) VALUES
(1, 'Super Admin', 1),
(2, 'Admin', 1),
(3, 'Normal User', 1);


INSERT INTO `wh_role_permissions` (`id`, `roleid`, `menuid`, `permission`, `status`) VALUES
(1, '2', 3, 'view', 1);


Pending Modules 
----------------
=> File delete and update



