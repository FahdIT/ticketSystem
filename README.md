
Ticket-system Nettside
Prosjektbeskrivelse
Dette prosjektet er en kundeservice Ticket nettside hvor kunder kan logge inn for å sende inn og se sine tickets. Språkene brukt er PHP, og vi benytter MariaDB/MySQL som database.

Systemkrav
Server maskin/VM
Apache
PHP
MariaDB
Virtual-Host
Oppsett av Server
Apache: Installer og konfigurer Apache for å tjene nettsiden.
MySQL: Installer og konfigurer MySQL/MariaDB for databasehåndtering.
PHP: Installer PHP og nødvendige moduler for å kjøre nettsiden.
Virtual-Host Konfigurasjon
Opprett en ny mappe for nettsiden.
Konfigurer en Virtual-Host i Apache for å peke til mappen.
Database
Opprett to tabeller: tickets og users.

Tickets:

ticket_id (int, auto_increment, primary key)
user_id (int, foreign key)
title (varchar)
description (text)
status (enum: 'open', 'closed', default 'open')
created_at (timestamp, default current_timestamp)
Users:

user_id (int, auto_increment, primary key)
username (varchar)
password (varchar)
created_at (timestamp, default current_timestamp)
Pushe til Git Repository
Initialiser et nytt git repository.
Legg til remote URL for ditt GitHub repository.
Legg til filer, commit, og push til GitHub.
Kode
Sørg for at PHP-koden er riktig konfigurert mot databasen og at SQL-spørringene er korrekte.

For mer detaljert informasjon, besøk DigitalOcean LAMP tutorial.
