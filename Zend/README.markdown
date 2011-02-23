README
======
Author: Quyen Do Nguyen quyendon@gmail.com

Useful Eclipse templates
------------------------
The file templates.xml includes templates useful in case you want to build more involved model objects with Zend Framework.

1. Go to Window > Preferences > PHP > Editor > Templates and then click on New.
2. Import templates.xml
3. In the PHP file, type fgs then press CTRL + SPACE, enter the name of the template (e.g. zfmapper), then press enter.


Setting up the VHOST
---------------------
Uncomment the line below in httpd.conf:

	Include conf/extra/httpd-vhosts.conf

Add the following to extras/httpd-vhosts.conf

	NameVirtualHost *:8080
	
	<VirtualHost *:8080>
	    ServerName jobboard.local
	    DocumentRoot "C:\Users\quyenngd\dev\eclipse_workspace\JobBoard\public"
	
	    SetEnv APPLICATION_ENV "development"
	
	    <Directory "C:\Users\quyenngd\dev\eclipse_workspace\JobBoard\public">
			DirectoryIndex index.php
			AllowOverride All
			Order allow,deny
			Allow from all
		</Directory>
	
	    ErrorLog "logs/jobboard-error.log"
	    CustomLog "logs/jobboard-access.log" common
	</VirtualHost>
