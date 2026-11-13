# Moziműsor – Web programozás 2 (Laravel beadandó)

Laravel 12 alapú weboldal: moziműsor adatbázissal, kapcsolatfelvételi űrlappal, diagrammal és admin CRUD-dal.

Online: http://konyvtarinyilvantartas.nhely.hu

## Funkciók
- Főoldal, Adatbázis (szűrhető), Kapcsolat (szerveroldali validáció, mentés DB-be)
- Üzenetek (csak bejelentkezve, fordított időrendben)
- Diagram (Chart.js)
- CRUD a filmekhez (csak admin)

## Telepítés
1. `composer install`
2. `.env.example` másolása `.env` névre, DB-adatok beírása
3. `php artisan key:generate`
4. `php artisan migrate --seed`
