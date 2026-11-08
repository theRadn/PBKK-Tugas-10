# PBKK-Tugas-10

## Website Link

[http://172.188.98.77/](http://172.188.98.77/)

## Local Setup

```
git clone git@github.com:theRadn/PBKK-Tugas-10.git
cd PBKK-Tugas-10
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
composer run dev
```

## Routes list
- `/` home page <br>
- `/?mode={dark | light}` change to dark / light theme <br>
- `/beranda` home page <br>
- `/beranda?user={name}` home page with greeting notification <br>
- `/ide-agent` agent idea page <br>
- `/profil-mahasiswa` student detail page <br>
- `POST /agent/idea` send agent idea <br>
