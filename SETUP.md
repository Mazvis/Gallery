Serverio Installiacija
Reikia įsidiegti virtualbox(virtuali1 mašiną) ir vagrant. taip pat jo papildinį. Jį galima įrašyti terminale, komanda:

    vagrant plugin install vagrant-hostsupdater

Norinti isitikinti ar yra sudiegtas nfs paketas:

    sudo apt-get install nfs-kernel-server

Tai sudiegę galime paleisti visą infrastruktūrą. Tai padarykite nueikite į projekto root direktoriją ir paleiskite komandą:

    vagrant up

Papildomai sudiegti paketus ar vėliau patikrinti pasiekitimus infrastruktūrai paleiskite komandą:

    vagrant provision

Prisijungti prie virtualios mašinos galima naudojant komandą:

    vagrant ssh

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

Importuojame i duombaze sql scriptą: /gallery DB.sql
administratoriaus prisijungimas:
username: admin
password: 123