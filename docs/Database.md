# Database

Steps to create the Discogs Data database and user, and import the table structure.

---

## MySQL

```
mysql -h localhost -u root -p
```

### Create databse
```
CREATE DATABASE discogs_data_import;
ALTER DATABASE discogs_data_import CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
```

### Create database user
```
CREATE USER 'discogs_data_import'@localhost IDENTIFIED BY 'ogger123';
GRANT ALL ON discogs_data_import.* TO 'discogs_data_import'@localhost;
FLUSH PRIVILEGES;
```

### Import table structure
```
mysql -h localhost -u root -p --max_allowed_packet=16M --default-character-set=utf8 discogs_data_import < resources/schema/mysql/discogs_data_import.sql
```
 ---
