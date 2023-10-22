# Simply new MVC core framework

The purpose of this repo is to attempt to simplify the mvc framework that was created earlier. 


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
