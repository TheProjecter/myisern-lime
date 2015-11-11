# Installing Myisern-lime #

First, you must  [install Symfony](InstallSymfony.md). Begin by downloading the the latest distribution file of the system from the [Downloads Page](http://code.google.com/p/myisern-lime/downloads/list). This guide will cover how to install the system with an apache/mysql setup.

### Install MyIsern Lime in your web root ###

To do this, simply unzip the distribution file into you

  1. Unzip the file into a directory.
> On Linux
```
   unzip myisern-lime-2.0.xxxxxx.zip -d /var/www/
```

Later, we will show you how to setup virtual host and at that point you can move it out of you web tree.

### Setup the Database ###

If you installed phpmyadmin, you can use that tool to create your database. You will need to create a database called 'isern\_production' and create a user 'isern' that has all permissions on that database.

(Developers, see the  [Developer's Installation Guide](DevelopersInstallationGuide.md).)

You can use either phpmyadmin or the mysql command line tool to issue the following commands. (Make sure to change the password.)

```

CREATE DATABASE isern_production;

CREATE USER 'isern'@'%' IDENTIFIED BY 'password_change_me';

GRANT USAGE ON * . * TO 'isern'@'%'  WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;

GRANT ALL PRIVILEGES ON `isern\_%` . * TO 'isern'@'%';

Flush Privileges;
```

You have created the database but you still need to load the tables and the data.

Set your new password in `config/database.yml` (lines 9,18,27)
```
  password: password_change_me
```

Don't add any extra spaces to the yml file since it is space-sensitive.

Set your new password in `config/propel.ini` (line 5,6):
```
propel.database.createUrl  = mysql://isern:password_change_me@localhost/isern_production
propel.database.url        =  mysql://isern:password_change_me@localhost/isern_production
```

### Loading the seed data ###

Next you will run the symfony task to create the database and load the data. From the root directory of the installation (mysiser-lime), issue the following command:

```
symfony propel-insert-sql
symfony propel-load-data isernweb data/fixtures/users.yml prod
symfony propel-load-data isernweb data/fixtures/collaborations.yml prod
symfony clear-cache
```

### Change Permissions ###

Symfony needs to write to write to directories "log" and "cache." You will need to create these and make them writable by your web server. From  INSTALL\_DIR/myisern-lime) root folder

```
chmod 777 cache log -R
```

### Viewing the Myisern-lime Web Application ###

You are now ready to login to the MyIsern system. Point your broswer to your installation of MyIsern:

http://127.0.0.1/myisern-lime/web/

The login is isern and the password is isern2008. If you want to change this, edit the file data/fixtures/users.yml, put in a new value for the password and reissue these commands
```
 chmod 777 cache log -R 
 symfony propel-load-data isernweb data/fixtures/users.yml prod
 symfony clear-cache
```

The first line is optional but sometimes the webserver writes files that you do not have permission to and this will cause the propel-load-data task to fail.

### Setting up the Virtual Host (Optional) ###

If you don't mind having you application web directory be "myisern-lime/web", you can skip this section. We will show you how to setup the virtual host so that the web directory will be http://127.0.0.1/isernweb instead of http://127.0.0.1/myisern-lime/web.

First, move your myiser-lime directory to a directory that is not in your apache web tree:

```
 mv /var/www/myisern-lime /home/kenglish/applications
  # or, to be generic. 
 mv /var/www/myisern-lime /dir/to/install
```

Create a file isernweb.conf in your the conf.d of your Apache2 configuration directory.

```
# Isernweb Apache configuration

Alias /isernweb /dir/to/install/myisern-lime/web

<Directory /dir/to/install/myisern-lime/web>
        Options Indexes FollowSymLinks
        DirectoryIndex index.php
        AllowOverride All
        Allow from All

  # To use the latest version of symfony libraries 
  # ln -s /usr/share/php5/symfony/data/web/sf /dir/to/install/myisern-lime/web

</Directory>
```

You will need to restart Apache for this to take effect. It is not necessary to symlink the "sf" unless you plan on doing development. If you plan on doing development, please go to our [Developer's Installation Guide](DevelopersInstallationGuide.md).

### Troubleshooting the Install ###

There are many steps in this install process. If you are having difficulty installing the system, make sure you have done each step. First, you should make sure Symfony is working. There is an excellent tutorial called [My First Symfony Project](http://www.symfony-project.org/tutorial/1_0/my-first-project) which can help you test Symfony. Download the sandbox code that they provide and make sure it runs. If you can not get this running, there is something wrong with your PHP, Apache and MySql setup. There are plenty resources on the Internet that can help you troubleshoot your setup.

If you have installed Symfony directly from the .zip or .tar.gz distribution file, you may have left out some important dependencies. It is better to install Symfony from using your  Linux distribution's package or PEAR. PEAR will ensure that all of the dependencies are installed.

If you still have problems, please the owner of this project.