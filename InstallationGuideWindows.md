# Installing Myisern-lime on Windows XP #

First, you must  [install Symfony](InstallSymfony.md) on Windows using WAMP.

Begin by downloading the the latest distribution file of the system from the [Downloads Page](http://code.google.com/p/myisern-lime/downloads/list).

### Install Notepad ++ ###
To edit the configuration file, you will need an editor that understands Linux files. [Notepad++](http://notepad-plus.sourceforge.net/uk/site.htm) is a very good option. It is free and open source. If you open the files in regular notepad, windows will not undestand the new line characters.

### Install MyIsern Lime in your web root ###

To do this, simply unzip the distribution file into your WAMP webroot folder. If you used the defaults when installing WAMP, it will be C:\wamp\www. We will assumed C:\wamp\www to be your default install directory in this install guide.

### Setup the Database ###

Use the WAMP control to open the MySQL conole. Goto MySQL | MySQL Console. Your default root password for MySQL will be blank. You will need to create a database called 'isern\_production' and create a user 'isern' that has all permissions on that database.

![http://myisern-lime.googlecode.com/svn/wiki/wamp-screen.png](http://myisern-lime.googlecode.com/svn/wiki/wamp-screen.png)
(Developers, see the  [Developer's Installation Guide](DevelopersInstallationGuide.md).)

Paste the following commands into the MySQL console. (Make sure to change the password.)

```

CREATE DATABASE isern_production;

CREATE USER 'isern'@'%' IDENTIFIED BY 'password_change_me';

GRANT USAGE ON * . * TO 'isern'@'%'  WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;

GRANT ALL PRIVILEGES ON `isern\_%` . * TO 'isern'@'%';

Flush Privileges;
```

You have created the database but you still need to load the tables and the data.

Now, edit `C:\wamp\www\myisern-lime\config\database.yml` with Notepad++ and change the database password. (lines 9,18,27)
```
  password: password_change_me
```

Don't add any extra spaces to the yml file since it is space-sensitive.

Set your new password in `config/propel.ini` (line 5,6):
```
propel.database.createUrl  = mysql://isern:password_change_me@localhost/isern_production
propel.database.url        =  mysql://isern:password_change_me@localhost/isern_production
```

### Configure the application ###

You need to tell the application where symfony is installed. Do this by editing the file "C:\wamp\www\myisern-lime\config\config.php" with Notepad++. Change the values to the folllowing:
```
$sf_symfony_lib_dir  = 'C:\wamp\bin\php\php5.2.5\PEAR\symfony';
$sf_symfony_data_dir = 'C:\wamp\bin\php\php5.2.5\PEAR\data\symfony';
```

### Loading the seed data ###

Next you will run the symfony task to create the database stucture and load the data. Open the windows command console and cd to "C:\wamp\www\myisern-lime". From this directory , issue the following commands:

```
symfony propel-insert-sql
symfony propel-load-data isernweb data/fixtures/users.yml prod
symfony propel-load-data isernweb data/fixtures/collaborations.yml prod
symfony clear-cache
```

### Viewing the Myisern-lime Web Application ###

You are now ready to login to the MyIsern system. Point your broswer to your installation of MyIsern:

http://127.0.0.1/myisern-lime/web/

The login is isern and the password is isern2008. If you want to change this, edit the file data/fixtures/users.yml, put in a new value for the password and issue theses commands
```
 symfony propel-load-data isernweb data/fixtures/users.yml prod
 symfony clear-cache
```


### Troubleshooting the Install ###

There are many steps in this install process. If you are having difficulty installing the system, make sure you have done each step. First, you should make sure Symfony is working. There is an excellent tutorial called [My First Symfony Project](http://www.symfony-project.org/tutorial/1_0/my-first-project) which can help you test Symfony. Download the sandbox code that they provide and make sure it runs. If you can not get this running, there is something wrong with your PHP, Apache and MySQL setup. There are plenty resources on the Internet that can help you troubleshoot your setup.

If you have installed Symfony directly from the .zip or .tar.gz distribution file, you may have left out some important dependencies. It is better to install Symfony from using your  Linux distribution's package or PEAR. PEAR will ensure that all of the dependencies are installed.

If you still have problems, please the owner of this project.