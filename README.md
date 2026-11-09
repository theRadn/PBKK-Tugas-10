# PBKK-Tugas-10

## Table of Contents

- [Local Setup](#local-setup)
- [Features](#features)
- [Demo Accounts](#demo-accounts)
- [Roles & Permissions (RBAC)](#roles--permissions-rbac)
- [Routes Reference](#routes-reference)
- [Usage Guide](#usage-guide)
- [Database Schema](#database-schema)

---

## Local Setup

```
git clone git@github.com:theRadn/PBKK-Tugas-10.git
cd PBKK-Tugas-10
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
composer run dev
```

## Features

### Core

- **Authentication** — Login / Register with AJAX-based login (graceful fallback to standard form post).
- **Dashboard** — Personalized greeting, project counter, and card grid of all projects.
- **Create Project** — Modal form to submit a new FP project idea (judul, tema agent, deskripsi, optional API key).
- **Search** — Real-time-ish search across **project title**, **agent theme**, and **owner name**.
- **Pagination** — 6 projects per page, query string preserved (`?search=...&page=2`).
- **Dark / Light Mode** — Persistent theme toggle stored in `localStorage`.

### Role-Based (Admin Only)

-  **Edit Project** — Amber "Edit" button opens a pre-filled modal; API key is preserved if left blank on save.
-  **Delete Project** — Rose "Hapus" button with confirmation dialog.
-  **Defense in depth** — Buttons are **never rendered** in HTML for non-admins (`@can('delete-data')`), and the controller **re-checks** the permission (`abort(403)`) even against crafted requests.

## Demo Accounts

Two accounts are seeded by default (`database/seeders/DemoUserSeeder.php` and `StudentUserSeeder.php`). Both use the same password.

| Role      | Email                      | Password   | Notes |
|-----------|----------------------------|------------|-------|
| **Admin** (Dosen)   | `dosenpbkk@its.ac.id`    | `password` | Full access: view, **edit**, **delete** |
| **Staf** (Mahasiswa)| `mahasiswa@its.ac.id`    | `password` | Read-only: view catalog, **own 12 seeded projects** |

> The Login page also has two **quick-fill buttons** (Admin / Staf) that populate the form for you.

Additionally, the seeder creates **15 random students** with 2 projects each to populate the catalog.

---

## Roles & Permissions (RBAC)

Uses **`spatie/laravel-permission`**. Seeded via `DatabaseSeeder`:

| Permission    | Admin | Staf |
|---------------|:-----:|:----:|
| `view-data`   | ✅    | ✅   |
| `delete-data` | ✅    | ❌   |

**Admin-only actions are gated on `delete-data`** (the only mutation permission in the seeder):

- Blade: `@can('delete-data') ... @endcan` → hides Edit + Hapus buttons for Staf.
- Controller: `abort_unless($request->user()->can('delete-data'), 403)` in `update()` and `destroy()`.

---

## Routes Reference

| Method | URI                     | Name                   | Middleware | Description |
|--------|-------------------------|------------------------|------------|-------------|
| `GET`  | `/`                     | —                      | `auth`     | Dashboard alias |
| `GET`  | `/dashboard`            | `dashboard`            | `auth`     | Main dashboard (list + search) |
| `POST` | `/agent/idea`           | `agent.idea.store`     | `auth`     | Create new project |
| `PUT`  | `/projects/{project}`   | `projects.update`      | `auth`     | **Admin-only** edit project |
| `DELETE` | `/projects/{project}` | `projects.destroy`     | `auth`     | **Admin-only** delete project |
| `GET`  | `/login`                | `login.form`           | `guest`    | Login page |
| `POST` | `/login`                | `login`                | `guest`    | Login submit |
| `GET`  | `/register`             | `register.form`        | `guest`    | Register page |
| `POST` | `/register`             | `register`             | `guest`    | Register submit |
| `POST` | `/logout`               | `logout`               | `auth`     | Logout |
| `*`    | _(fallback)_            | —                      | —          | Custom 404 view |

---

## Usage Guide

### 1. Logging in

1. Visit `/login`.
2. Click **"Admin (Dosen)"** or **"Staf (Mahasiswa)"** to auto-fill credentials.
3. Click **Login**.

### 2. Searching projects

- Type into the search bar (or press `/` anywhere on the page).
- Searches **project title**, **agent theme**, and **owner name** simultaneously.
- Press **Enter** or click **Cari**.
- The `×` icon (or the **Reset Pencarian** empty-state button) clears the query.

### 3. Creating a project

1. Click **"Tambah FP Project"**.
2. Fill in **Judul**, **Tema Agent**, **Deskripsi** (all required).
3. Optionally fill **API Key Secure**.
4. Submit → green banner confirms success.

### 4. Editing a project (Admin only)

1. On any project card, click the amber **Edit** icon.
2. Modal opens pre-filled with the project data.
3. Leave **API Key Secure** blank to **keep the old key**; type a new one to replace it.
4. Submit → amber banner confirms success.

### 5. Deleting a project (Admin only)

1. Click the rose **Hapus** icon.
2. Confirm the browser dialog.
3. Project disappears; green banner confirms.

> **Staf users** won't see Edit or Hapus buttons at all — inspecting the page source confirms they're absent from the DOM.

---

## Database Schema

### `users`

| Column              | Type      | Notes |
|---------------------|-----------|-------|
| `id`                | bigint PK | |
| `name`              | string    | |
| `email`             | string    | unique |
| `email_verified_at` | timestamp | nullable |
| `password`          | string    | hashed |
| `remember_token`    | string    | nullable |
| `timestamps`        | | |

### `projects`

| Column           | Type      | Notes |
|------------------|-----------|-------|
| `id`             | bigint PK | |
| `user_id`        | FK users  | `cascadeOnDelete` |
| `judul`          | string    | project title |
| `deskripsi`      | text      | nullable |
| `tema_agent`     | string    | default `Ollama` |
| `api_key_secure` | string    | nullable |
| `timestamps`     | | |

### `roles` / `permissions` / `model_has_roles` / `role_has_permissions`

Auto-created by `spatie/laravel-permission` migrations.
