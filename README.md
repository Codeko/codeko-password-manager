# codeko-password-manager
A online password manager tool

- Installation.
<ol>
<li>
Download or clone the project from our repository.
</li>
<li>
Opening the project.
    
    Run in a terminal 


        composer install

     or 


        composer update

    , third party bundles will be downloaded and installed into the project. Please provide correct info when composer requires it.

    Generate project's database typing in a terminal:


        $ php app/console doctrine:database:create
        $ php app/console doctrine:schema:update --force

    Create an admin account 

        $ php app/console fos:user:create admin --super-admin

    Generate project's web folder typing in a terminal:


        $ php app/console assets:install web --symlink

    Run server

        $ php app/console server:start 
</li>
<li>
Admin Panel URL: http://localhost/app_dev.php/admin or ~/app_dev.php/admin (add your personal local path before)
</li>
