FooAppsHelloBundle
==================

Enhanced :) 'Hello world!' bundle. Manage a list of friends and say 'Hello!' to
them. If you are tired of bundles that greet everyone without distinction, now
you can send your 'hellos' only to people who really deserve them.

Beside jokes, this is a bundle I've created to start playing with Symfony2.
I'm sharing it with the hope it can be useful to others as a simple demo of basic
Symfony2 features. But consider that I'm still learning and can't assure I've
followed all the best practices.

Installation
============

Bundle is tested with Symfony2 Standard Edition (PR10). Be sure to have properly
configured it with the web configurator or by manually editing the file
'app/config/parameters.ini' (see instructions in the README file inside Symfony
package).

Install bundle source code
--------------------------

With git
~~~~~~~~

Cd to your project directory and run the following command::

    $ git clone git://github.com/mgiagnoni/HelloBundle.git src/FooApps/HelloBundle

From package
~~~~~~~~~~~~

Currently not available.

Add the FooApps namespace to your autoloader
--------------------------------------------

::

    // app/autoload.php

    $loader->registerNamespaces(array(
        /* ... */
        'FooApps' => __DIR__.'/../src',
    );

Add bundle to your application kernel
-------------------------------------

::

    // app/AppKernel.php

    public function registerBundles()
    {
        return array(
            /* ... */
            new FooApps\HelloBundle\FooAppsHelloBundle(),
        );
    }

Configure Doctrine mapping
--------------------------

::

    # app/config/config.yml

		# ...
    doctrine:
        dbal:
            # ...
        orm:
            # ...
            default_entity_manager: default
            entity_managers:
                default:
                    mappings:
                        # ...
                        FooAppsHelloBundle: ~

Configure routing
-----------------

When you import bundle routes in your application routing configuration is
recommended to use a prefix ('hello_friend' in this example, but you can choose
another one)::

    # app/config/routing.yml

    fooapps_hello:
        resource: "@FooAppsHelloBundle/Resources/config/routing.yml"
        prefix: /hello_friend

Initialize database
-------------------

From your project directory run::

    $ php app/console doctrine:database:create
    $ php app/console doctrine:schema:create

The first command can obviously be omitted if the database configured in
'app/config/parameters.ini' already exists.

Load fixtures
-------------

If you want to load the database with some sample data you will need a Doctrine
extension not included in Symfony Standard Edition package. From your project
folder run::

    $ git clone git://github.com/doctrine/data-fixtures.git vendor/doctrine-data-fixtures

Then include extension namespace in your autoloader::

    // app/autoload.php

    /* ... */
    $loader->registerNamespaces(array(
        'Symfony'            => array(__DIR__.'/../vendor/symfony/src', __DIR__.'/../vendor/bundles'),
        'Sensio'             => __DIR__.'/../vendor/bundles',
        'JMS'                => __DIR__.'/../vendor/bundles',
        /* Add the following line */
        'Doctrine\\Common\\DataFixtures'   => __DIR__.'/../vendor/doctrine-data-fixtures/lib',
        /* ... */
    ));

Now you can load fixtures::

    $ php app/console doctrine:data:load --fixtures=src/FooApps/HelloBundle/DataFixtures/ORM

Play with it
------------

Visit the following address with your browser::

    http://localhost/Symfony/web/app_dev.php/hello_friend/friends

If you have configured a virtual host replace 'localhost/Symfony/web' with your
virtual host name. Note that 'hello_friend' is the prefix used to import bundle
routes in you application routing configuration.

If you have loaded sample data you can click a name to say 'Hello!' or add/edit
a friend.
