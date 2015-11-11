# Introduction #

This page will walk you through installing [Symfony](http://www.symfony-project.org) on your system. Much of the information presented here can be found on the [Installation Page of the Symfony Project](http://www.symfony-project.org/installation).

# Installing Symfony with LAMP on Ubuntu #

You must first install PHP 5, Apache/2.2.4, Mysql 5 & PHP Pear. Pear is the PHP Extension and Application Repository. You will also need the php-xml and php5-xsl packages.

### Installing Symfony on Ubuntu ###

The following sequence will enable you to get the system install on Ubuntu Linux:

**Install LAMP and other required php packages**
  1. sudo apt-get install php5 apache2 mysql-server
  1. sudo apt-get install php-xml-util php5-xsl
  1. (Optional, mysql admin tool) sudo apt-get install phpmyadmin
  1. Test the apache installation by going to http://127.0.0.1/apache2-default or   http://127.0.0.1/phpmyadmin if you installed phpmyadmin

**Install Symfony**
  1. Edit /etc/apt/sources.list with your favorite editor (sudo gedit /etc/apt/sources.list )
  1. add the following line at the end of the file:
> > deb http://www.symfony-project.org/get debian/
  1. sudo apt-get update
  1. sudo apt-get install php5-symfony php-pear php5-mysql

This should install the dependencies for php5-symfony which include php5-cli, php5-common, php-pear, php5-mysql, php5-pgsql.

If you don't want to install the .deb package, you can install using pear. Follow the [Symfony installation instruction](http://www.symfony-project.org/installation) found on the Symfony website.


# Installing Symfony on Windows #

The [Symfony Project Installation Page](http://www.symfony-project.org/installation) has articles describing how to install Symfony on Windows. Begin by installing [WAMP 2.0](http://www.wampserver.com/en/). Next, follow the step-by-step directions for [How to install PEAR on windows with WAMP](http://trac.symfony-project.com/wiki/HowToInstallPearOnWindowsWithWamp) and [How to install Symfony on windows with WAMP](http://trac.symfony-project.com/wiki/HowToInstallSymfonyOnWindowsWithWamp). The only difference will be that the php directory they describe will be has changed in WAMP 2.0. It can be found in C:\wamp\bin\php\php5.2 NOT C:\wamp\php.

# Installing Symfony on Mac #

The [Symfony Project Installation Page](http://www.symfony-project.org/installation) has articles describing how to install Symfony on Macs. The following is a summary of what is provide:
  * [Installing Symfony on MacOsX with php5 binary from entropy](http://trac.symfony-project.com/wiki/InstallingSymfonyOnMacOSXWithPHPBinaryFromEntropy) (This one looks the easiest.)

  * [Install a Symfony on a MacBook Pro](http://trac.symfony-project.com/wiki/SymfonyMacOsXIntel)

# Another Solution #

If you are on Windows and you have a lot of memory and hard disk space, you could install Ubuntu on [VirtualBox](http://www.virtualbox.org) and install the system on Ubuntu. Follow the instructions here:

> [How to install ubuntu studio in windows](http://www.simplehelp.net/2007/05/13/how-to-install-ubuntu-studio-in-windows-using-virtualbox-a-complete-walkthrough/)

This is risk free way to try out a full linux desktop environment. After doing this perhaps you will see the light and [Switch to linux](http://www.tuxmagazine.com/node/1000117)

Now you are ready to Install MyIsern. There is a [Production Installation](InstallationGuide.md)  Guide as well as a [Developer Installation Guide](DeveloperInstallationGuide.md)