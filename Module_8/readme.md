Create a database in docker like this:
```bash
run --name mariadb -e MYSQL_ROOT_PASSWORD=123 -p 3306:3306 -d mariadb:latest
```

Optional, tool to insert sql queries:
```bash
run --name my-phpmyadmin -d --link mariadb:db -p 8080:80 phpmyadmin/phpmyadmin
```

You can find the sql queries in the file: Module_8/databaseV2.sql. 
Remember to populate the User table with some "Students" and "Tutors" (in singular form).