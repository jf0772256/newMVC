# Simply new MVC core framework

The purpose of this repo is to attempt to simplify the mvc framework that was created earlier. 

Requires: 
PHP 8.2 or greater!

You will need to include the router (extracted to its own repo) and install script will be added that will do the pull, but until then
run the following command::

```git
git clone https://github.com/jf0772256/simpleMVCRouter.git app/Router
```

Important:: create a .htaccess file in /public/
and copy the following:

    RewriteEngine On
    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ public/%1 [QSA,L]
    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule (.*) index.php [QSA,L]

This is used for routing and without it the mvc will not work correctly (this can also be done in the vhost file as well)

For either Docker or other server the following must be completed::

make sure to generate your application keys - by running 
```php bin/commands/genkey.php [-l|--keyLength]=(int) [-n|--keyName]=(string)[ENCODER | SIGNATURE]``` twice on for each... copy to the env file for the project

-------------------------------------------------------------------

We now are working to provide a simple way to spin up a docker server to test this code out for yourself.
to get started::

git clone
https://github.com/sprintcube/docker-compose-lamp


copy and rename sample.env to .env (not the env in this project)
open and set the php version to php82
change other files as you wish

clone this project to the www folder into a sub folder(because there is some code in the root www folder that you will need)
copy and rename the dockerSite.env.example to dockerSite.env and make sure that the settings are correct or you will get errors (see comments on the file for more information)
in \\app\\Application.php change the line to point use dockerSiteEnvPath as opposed to envPath

have docker engine running
run docker compose up -d  in a console window to start the installation and run of the server, The first time you run it will take a few minutes

you can also set up virtual hosts , but you will have to also edit hosts file on the host machine. 