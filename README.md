# Abi-Zitate

Webseite, die das Sammeln von Zitaten für beispielsweise eine Abi-Zeitung ermöglicht

## Installation

- Alle Dateien dieses Repositories in ein Verzeichnis auf einem PHP-Webserver kopieren
- In einer MySQL-Datenbank eine Tabelle mit den folgenden Spalten aufsetzen:
  - **added** (primär): *timestamp*
  - **date**: *date*
  - **class**: *text (utf8mb4_unicode_ci)*
  - **quotation**: *text (utf8mb4_unicode_ci)*
- Zugangsdaten in `config.ini` anpassen

## Als Adminstrator einloggen

Nach Anhängen von `?login` an den URL kann man sich mit dem Benutzernamen `admin` einloggen. Das zugehörige Passwort wird in `config.ini` festgelegt (`pw_admin`).
