# ViciDial-style Admin Dashboard (Lightweight Demo)

This `vicidial/` folder now contains a complete, lightweight PHP admin dashboard inspired by ViciDial layout patterns. It uses placeholder/sample data only and has no database dependency.

## Included pages

- `login.php` – demo sign-in page
- `logout.php` – clears session and returns to login
- `index.php` – dashboard with stat cards, campaign snapshot, and status panels
- `campaigns.php` – campaign table view
- `agents.php` – agent status cards + searchable table
- `leads.php` – lead inventory table + quick filters
- `reports.php` – summary cards and performance panels
- `settings.php` – settings form sections

## Shared assets

- `assets/css/style.css` – core admin UI styling
- `assets/css/responsive.css` – mobile/tablet responsive behavior
- `assets/css/login.css` – login page styling
- `assets/js/script.js` – clock, mobile sidebar, table filtering
- `assets/js/login.js` – client-side login validation
- `includes/app.php` – simple shared PHP layout/auth helpers

## Folder structure

```text
vicidial/
├── README.md
├── index.php
├── login.php
├── logout.php
├── campaigns.php
├── agents.php
├── leads.php
├── reports.php
├── settings.php
├── includes/
│   └── app.php
└── assets/
    ├── css/
    │   ├── style.css
    │   ├── responsive.css
    │   └── login.css
    └── js/
        ├── script.js
        └── login.js
```

## Run locally

Use any PHP-capable web server and open `/vicidial/login.php`.

### Quick option (PHP built-in server)

```bash
cd vicidial
php -S 127.0.0.1:8080
```

Then browse to: `http://127.0.0.1:8080/login.php`

## Download from GitHub

1. Open `mdionglay/viciboxinstallation`
2. Switch to the branch containing this dashboard update
3. Click **Code** → **Download ZIP**
4. Extract and open the `vicidial/` folder

> Demo authentication: any non-empty username/password is accepted.
