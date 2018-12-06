DROP TABLE IF EXISTS d_release_data;
CREATE TABLE d_release_data (
	id INT(8) UNSIGNED NOT NULL,
	`status` ENUM('Accepted','Deleted','Draft','Rejected') NOT NULL,
	title TEXT NOT NULL,
	country VARCHAR(45) NOT NULL DEFAULT '',
	released VARCHAR(255) NOT NULL DEFAULT '',
	notes MEDIUMTEXT NOT NULL,
	data_quality ENUM('Complete and Correct','Correct','Entirely Incorrect','Needs Major Changes','Needs Minor Changes','Needs Vote') NOT NULL,
	UNIQUE KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS d_release_images;
CREATE TABLE d_release_images (
	_id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	_release_id INT(8) UNSIGNED NOT NULL,
	height VARCHAR(90) NOT NULL DEFAULT '',
	type VARCHAR(255) NOT NULL DEFAULT '',
	uri VARCHAR(255) NOT NULL DEFAULT '',
	uri150 VARCHAR(255) NOT NULL DEFAULT '',
	width VARCHAR(90) NOT NULL DEFAULT '',
	PRIMARY KEY (_id),
	KEY k_release (_release_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS d_release_tracklist;
CREATE TABLE d_release_tracklist (
	_id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	_release_id INT(8) UNSIGNED NOT NULL,
	_asset_type ENUM('tracklist','sub_tracks') NOT NULL,
	_asset_id INT(8) UNSIGNED NOT NULL DEFAULT '0',
	position VARCHAR(5000) NOT NULL DEFAULT '',
	title VARCHAR(10000) NOT NULL DEFAULT '',
	duration VARCHAR(90) NOT NULL DEFAULT '',
	PRIMARY KEY (_id),
	KEY k_release (_release_id),
	KEY k_asset_type (_asset_type),
	KEY k_asset_id (_asset_id),
	KEY k_title (title),
	KEY k_position (position)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS d_release_artists;
CREATE TABLE d_release_artists (
	_id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	_release_id INT(8) UNSIGNED NOT NULL,
	_asset_type ENUM('release','release_extra','track','track_extra') NOT NULL,
	_asset_id INT(8) UNSIGNED NOT NULL DEFAULT '0',
	id INT(8) UNSIGNED NOT NULL,
	name TEXT NOT NULL,
	anv VARCHAR(2000) NOT NULL DEFAULT '',
	`join` VARCHAR(255) NOT NULL DEFAULT '',
	role VARCHAR(5000) NOT NULL DEFAULT '',
	tracks VARCHAR(1000) NOT NULL DEFAULT '',
	PRIMARY KEY (_id),
	KEY k_release (_release_id),
	KEY k_asset_type (_asset_type),
	KEY k_asset_id (_asset_id),
	KEY k_artists (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS d_release_labels;
CREATE TABLE d_release_labels (
	_id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	_release_id INT(8) UNSIGNED NOT NULL,
	catno VARCHAR(1000) NOT NULL DEFAULT '',
	id INT(8) UNSIGNED NOT NULL DEFAULT '0',
	`name` VARCHAR(1000) NOT NULL DEFAULT '',
	PRIMARY KEY (_id),
	KEY k_release (_release_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS d_release_formats;
CREATE TABLE d_release_formats (
	_id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	_release_id INT(8) UNSIGNED NOT NULL,
	`name` VARCHAR(45) NOT NULL DEFAULT '',
	qty VARCHAR(90) NOT NULL DEFAULT '',
	text VARCHAR(1000) NOT NULL DEFAULT '',
	PRIMARY KEY (_id),
	KEY k_release (_release_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- TEMP
ALTER TABLE d_release_formats CHANGE text text VARCHAR(3000) NOT NULL DEFAULT '';

DROP TABLE IF EXISTS d_release_format_descriptions;
CREATE TABLE d_release_format_descriptions (
	_id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	_release_id INT(8) UNSIGNED NOT NULL,
	_format_id INT(8) UNSIGNED NOT NULL,
	description VARCHAR(45) NOT NULL DEFAULT '',
	PRIMARY KEY (_id),
	KEY k_release (_release_id),
	KEY k_format (_format_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS d_release_genres;
CREATE TABLE d_release_genres (
	_id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	_release_id INT(8) UNSIGNED NOT NULL,
	genre VARCHAR(45) NOT NULL DEFAULT '',
	PRIMARY KEY (_id),
	KEY k_release (_release_id),
	KEY k_genre (genre)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS d_release_styles;
CREATE TABLE d_release_styles (
	_id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	_release_id INT(8) UNSIGNED NOT NULL,
	style VARCHAR(45) NOT NULL DEFAULT '',
	PRIMARY KEY (_id),
	KEY k_release (_release_id),
	KEY k_style (style)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS d_release_identifiers;
CREATE TABLE d_release_identifiers (
	_id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	_release_id INT(8) UNSIGNED NOT NULL,
	description VARCHAR(2000) NOT NULL DEFAULT '',
	type VARCHAR(45) NOT NULL DEFAULT '',
	`value` TEXT NOT NULL,
	PRIMARY KEY (_id),
	KEY k_release (_release_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS d_release_videos;
CREATE TABLE d_release_videos (
	_id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	_release_id INT(8) UNSIGNED NOT NULL,
	duration MEDIUMINT(5) NOT NULL DEFAULT '0',
	embed ENUM('true','false') NOT NULL,
	src VARCHAR(90) NOT NULL DEFAULT '',
	title VARCHAR(500) NOT NULL DEFAULT '',
	description VARCHAR(500) NOT NULL DEFAULT '',
	PRIMARY KEY (_id),
	KEY k_release (_release_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS d_release_companies;
CREATE TABLE d_release_companies (
	_id INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
	_release_id INT(8) UNSIGNED NOT NULL,
	id INT(8) UNSIGNED NOT NULL,
	name VARCHAR(1000) NOT NULL DEFAULT '',
	catno VARCHAR(255) NOT NULL DEFAULT '',
	entity_type TINYINT(2) NOT NULL,
	entity_type_name VARCHAR(45) NOT NULL DEFAULT '',
	resource_url VARCHAR(45) NOT NULL DEFAULT '',
	PRIMARY KEY (_id),
	KEY k_release (_release_id),
	KEY k_companies (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
