Mysql config
Nueiname į app/config/database.php ir pakeičiam į savo duomenis:

'mysql' => array(
	'driver'    => 'mysql',
	'host'      => 'localhost',
	'database'  => 'zwazaaz',
	'username'  => 'root',
	'password'  => '',
	'charset'   => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix'    => '',
),

Importuojame i duombaze sql scriptą: /gallery_newest.sql
administratoriaus prisijungimas:
username: admin
password: 123