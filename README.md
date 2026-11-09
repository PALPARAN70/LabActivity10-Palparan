# LabActivity10-Palparan

Barangay Bulletin for Lab Activity 10 (Full-Stack Web Development, 4-334).
A small blog where barangay officials post announcements and residents can
browse, search and page through them. Built with Laravel 12, SQLite, Blade
and Tailwind.

## My personalization

- **Site title:** Barangay Bulletin – Purok Palparan
- **Posts per page: 8.** My last name is Palparan, which has 8 letters, so
  `paginate(8)` in `PostController@index`.
- **My custom category: Lost & Found.** I added it to the four required ones
  (Announcement, Health, Peace & Order, Ayuda) because residents here usually
  post about lost pets and misplaced IDs on the actual cork board.
- **My author:** Kagawad Luis Palparan, kagawad.palparan@bulletin.test,
  created by hand with `Author::create()` in `AuthorSeeder`.
- **My pinned post:** "Purok Palparan Clean-up Drive", published
  **2026-03-12** (my birthday), written with `Post::create()` in `PostSeeder`.

## What the seeders make

- 5 authors (my Kagawad + 4 from `AuthorFactory`)
- 51 posts total: 40 published from the factory, 10 drafts using the
  `draft()` state, plus my pinned post
- 41 of those are published, which is what the list page pages through

## How to run it

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
npm install
npm run dev
php artisan serve
```

The database is SQLite. If `database/database.sqlite` is missing, make it
first with `touch database/database.sqlite` (PowerShell:
`New-Item database/database.sqlite`).

Keep `npm run dev` running in one terminal and `php artisan serve` in
another, then open http://127.0.0.1:8000 which redirects to /posts.

## Migrations

Three of my own, in this order:

1. `create_authors_table`
2. `create_posts_table` (has the `foreignId('author_id')->constrained()`)
3. `add_views_to_posts_table` (separate alter migration using
   `Schema::table`, so the posts migration never had a views column)

All three have a working `down()`. I tested it with
`php artisan migrate:rollback` then `php artisan migrate` again.

## Pages

- `/posts` - published posts only, pinned first then newest. Search by title
  with `?q=` and filter by category with `?category=`. Both are only applied
  when filled. Pagination keeps the filters with `withQueryString()`.
- `/posts/{id}` - one post, uses `findOrFail`. Drafts return 404 because the
  query filters to published first. Each visit adds 1 to `views` and calls
  `save()`.

## Notes

`docs/tinker.png` is the screenshot of the find → change title → save → read
back cycle from Step 13.

`vendor/`, `node_modules/` and `database/database.sqlite` are not committed.