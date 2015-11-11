# Introduction #

If you are a PHP Developers or just a curious hacker, you are welcome to download the source code for the Myisern project and enchance the system. This page provides a roadmap to help your get oriented.


# Getting Started #

Before you begin, you shoul [install Symfony](InstallSymfony.md) and [install MyIsern](InstallationGuide.md). MyIsern used the Symfony framework so you should read some of the tutorial at the [Symfony Project Home Page](http://www.symfony-project.org). Symfony uses an MVC (Model-View-Controller) framework with an ORM (Object-Relationship-Management) backend. Symfony is database independent but MyIsern was developed using Mysql as a database. There are no database specific queries in the source code so another database could be used.

Once you have Symfony installed, [download the MyIser source code tree](http://code.google.com/p/myisern-lime/source) from our subverion repository.

### Database Setup ###

If you installed phpmyadmin, you can use that tool to create your databases. You will need to create three database: `isern_production`, `isern_test` and `isern_development`. You should create a Mysql user 'isern' that has all permissions on that database. If you want to quickly setup the databases and Mysql user form the command line, do the following:

  * mysqladmin -u root create isern\_production
  * mysqladmin -u root create isern\_development
  * mysqladmin -u root create isern\_test
  * mysql -u root
```
      CREATE USER 'isern'@'%' IDENTIFIED BY 'password_change_me';

      GRANT USAGE ON * . * TO 'isern'@'%' IDENTIFIED BY 'password_change_me' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;

      GRANT ALL PRIVILEGES ON `isern\_%` . * TO 'isern'@'%';
```

You have created the database but you still need to load the tables and the data. First edit the [config/database.yml](http://myisern-lime.googlecode.com/svn/trunk/config/databases.yml) to use the database you just created. If you are not familiar with Yaml, you can read about it at the [Yaml Website](http://www.yaml.org/). Symfony uses Yaml (instead of XML) for most of configuration. Yaml relies on indentation instead of tags which makes it easier to read. In Yaml, a new level of nesting is represented by 2 spaces. When editing Yaml files, be sure to double check the indentation before proceeding.

Next you will run the symfony task to create the database and load the data. From the root directory of the installation (mysiser-lime), issue the following command:

symfony propel-insert-sql
symfony propel-load-data isernweb

This will create the database tables and load the default isern data into the isern\_development database.

### Isern Data Model ###

Symfony uses a code-generation approach approach to Object-Relationship-Mapping (ORM). The schema for the MyIsern database can be found in [config/schema.yml](http://myisern-lime.googlecode.com/svn/trunk/config/schema.yml). This file is used by symfony to generate the database tables and corresponding PHP classes. Symfony is very smart and magically creates foreign key relationships between tables that follow the correct naming convention. For example, organization\_type\_id on the organizations table will be assumed to be a foreign key link to the organization\_types table.

The generated PHP classes can be found in [lib/model](http://myisern-lime.googlecode.com/svn/trunk/lib/model). The PHP class files in  [lib/model/om](http://myisern-lime.googlecode.com/svn/trunk/lib/model/om) or [lib/model/map](http://myisern-lime.googlecode.com/svn/trunk/lib/model/map) should not be edited since they are generated by symfony and could be generated again if the application schema changes. If you wish to add functionality to a data model object, add it to the inherited version of the Data Model files in [lib/model](http://myisern-lime.googlecode.com/svn/trunk/lib/model). As a rule, the Peer files (e.g. [UserPeer.php](http://myisern-lime.googlecode.com/svn/trunk/lib/model/UsersPeer.php), [CollaborationPeer.php](http://myisern-lime.googlecode.com/svn/trunk/lib/model/CollaborationPeer.php))  contains static methods which are used to get groups of objects using queries. The other class files (e.g. [User.php](http://myisern-lime.googlecode.com/svn/trunk/lib/model/User.php), [Collaboration.php](http://myisern-lime.googlecode.com/svn/trunk/lib/model/Collaboration.php))  contain methods that will be available to individual classes.

If you make changes to the database schema, you must use the symfony tasks to regenerate the model object.

### Enhancing the Application ###

The web application portion of MyIsern can can be found in [apps/isernweb](http://myisern-lime.googlecode.com/svn/trunk/apps/isernweb/). Each controller/view can be found in the [apps/isernweb/module](http://myisern-lime.googlecode.com/svn/trunk/apps/isernweb/modules/). Using collaboration as an example, the view files will be found in [apps/isernweb/module/collaboration/templates](http://myisern-lime.googlecode.com/svn/trunk/apps/isernweb/modules/collaboration/templates/) and the controller code resides in the [apps/isernweb/modules/collaboration/actions/actions.class.php](http://myisern-lime.googlecode.com/svn/trunk/apps/isernweb/modules/collaboration/actions/actions.class.php). Symfony also has a special folder for validation configuration. The directory for collaborations will be [apps/isernweb/modules/collaboration/validate/](http://myisern-lime.googlecode.com/svn/trunk/apps/isernweb/modules/collaboration/validate/). Validation methods make use of validation classes which can be reused throughout the application. These Validation classes are found in [apps/isernweb/lib](http://myisern-lime.googlecode.com/svn/trunk/apps/isernweb/lib).

You can begin enhancing the system by adding additional validations and enchancing the views and controllers.

### Symfony Tips ###

You may experience a learning curver while using Symfony. Keep in mind that Symfony (like MyIsern) is an open source project. Their [svn repositoy](http://svn.symfony-project.com/trunk/) is available online. Do not be afraid to refer to their code if you having a problem understanding how Symfony works internally.

Symfony provides a good logging library which is explained in their [Application Management Tools](http://www.symfony-project.org/book/1_0/16-Application-Management-Tools) Chapter. Briefly, anywhere within the MyIsern Symfony application you can write to the log like this:
```
sfContext::getInstance()->getLogger()->info("My log message shows my $variable");
```

However from you action class, you should use the more elegant version:
```
$this->logMessage($message, $level);
```

Log messages will appear in log/isern\_dev.log when you are using the development environment.

Also, when developing, follow conventions. Symfony has pretty set ways of handling things. You should use read through some of [their tutorials](http://www.symfony-project.org/askeet/1_0/) to get a good handle of these conventions.

### Testing MyIsern ###

Symfony includes the [Lime Testing Framework](http://trac.symfony-project.com/wiki/LimeTestingFramework). There are unit test for MyIsern and they are using the symfony plugin [sfModelTestPlugin](http://trac.symfony-project.com/wiki/sfModelTestPlugin). This plugin allows you to load test fixtures into the test database and gives you direct access to model objects in the test cases. Test fixtures can be found is [test/fixtures](http://myisern-lime.googlecode.com/svn/trunk/test/fixtures/). Fixtures are stored in YAML format and you are welcome to add fixtures to to enhance your tests. The Symfony website has a detailed  [chapter on Unit and Functional Testing](http://www.symfony-project.org/book/1_0/15-Unit-and-Functional-Testing) with Lime. The MyIsern test uses many of the same techiniques. The only difference is that in MyIsern each test case is wrapped within the sfMoldeTestPlugin class. For an example, see [test/functional/isernweb/collaboration/CreateOkTest.php](http://myisern-lime.googlecode.com/svn/trunk/test/functional/isernweb/collaboration/CreateOkTest.php). Tests are organized so that there is one test per file. This is one of the limitations of the Lime Framework.

The MyIsern tests use an object-oriented approach where each unit test is a class that extend a base class. For example, [CreateOkTest.php](http://myisern-lime.googlecode.com/svn/trunk/test/functional/isernweb/collaboration/CreateOkTest.php) extends [CollaborationBaseTest.php](http://myisern-lime.googlecode.com/svn/trunk/test/functional/isernweb/collaboration/CollaborationBaseTest.php). This allows us to use the `setup` and `teardown` methods to initialize the tests.

To run an individual test, you can run it as a php script from the command line directly:

```
php /test/functional/isernweb/collaboration/CreateOkTest.php
# or 
php /test/functional/isernweb/collaboration/CreateOkTest.php
```

To run all tests, you can use the symfony command:
```
symfony test-all
```

Test Coverage is not currently working. Symfony provides a file called `coverage.php` however it is not documented and does not appear to provide accurate coverage data.

### Creating a Deployment File ###
If you have reached a milestone and would like to prepare a release, we have create an automated build process. This process uses [Phing](http://phing.info/trac/), a PHP clone of ANT. Before proceeding, [Install Phing](http://phing.info/trac/wiki/Users/Download) on your system using Pear.

**Phing tasks**

Build a distribution file:
```
phing
```
(This will place a zip file _MyIsern-lime-_

&lt;version&gt;

-

&lt;datetimestamp&gt;

.zip in the build folder)

Clear out old build files.
```
phing clean
```

Create the build directory but not the zip file.
```
phing build
```
Create the build distribution file.
```
phing dist
```

### Keeping in touch ###

Be sure to keep in touch with the lead developers for MyIsern.