# codeko-password-manager
A online password manager tool

- Installation.
<ol>
<li>
Download or clone the project from our repository.
</li>
<li>
Installing Symfony.

    Open a command console and execute: 

        
        $ sudo curl -LsS http://symfony.com/installer -o /usr/local/bin/symfony
       
        $ sudo chmod a+x /usr/local/bin/symfony       
</li>
<li>
Opening the project.
    
    Run in a terminal 


        composer install

     or 


        composer update

    , third party bundles will be downloaded and installed into the project.

    Generate project's database typing in a terminal:


        $ php app/console doctrine:database:create
</li>

