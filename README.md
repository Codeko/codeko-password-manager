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

    If you use an IDE like Netbeans create a PHP application and configure it, then select Symfony2 as framework or download it from Netbeans Plugins.

    If you're using a command console: 
        
    With Symfony:


        symfony new 'my_project_name'

    , and paste the project in selected folder.

    With Composer:


        $ composer create-project symfony/framework-standard-edition my_project_name

    , and paste the project in selected folder.
    
    Run in a terminal 


        composer install

     or 


        composer update

    , third party bundles will be downloaded and installed into the project.
</li>
<li>
Running the project

    Open the command console and execute:
        

        $ cd my_project_name/
        
        $ php app/console server:run
        
    If you haven't install apache server or php previously, you must do it before continue.
    
    By default project's url is http://localhost:8000, but you can customize it creating a .conf file in /etc/apache2/sites-avaliable 
    You can directly open the project in Netbeans, first configure it in "project properties". 
</li>
