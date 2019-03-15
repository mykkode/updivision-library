updivision-library

Run:

`composer update`

Copy 

`.env.example` to `.env`

Configure

`.env`

Don't forget to migrate:
`php artisan migrate`

And you may need to create a symlink to the storage/public folder. You can do this by:
`php artisan storage:link`