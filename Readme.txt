=> For database:
	1. DB is initilization using db_init.sql
		sudo mysql -h <hostname> -u <db_user> -p <database_name> < db_delete.sql

	2. DB is deletion using db_delete.sql
		sudo mysql -h <hostname> -u <db_user> -p <database_name> < db_delete.sql

=> For logging into system:
	Username: admin
	Password: admin
	[NOTE: in DB init admin user is created using which we can login and perform tasks]

=> Open site on localhost:8080, login page will appear.

=> For apache2 server:
	1. Restarting: 		sudo systemctl reload apache2
	2. Adding new site: 	sudo a2ensite <site_name>
