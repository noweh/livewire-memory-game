# livewire-memory-game

Source code for Final Fantasy Memory Quest.

## BACK-END INSTALL

### Requirement

You will need to have the following installed:

- [Composer](https://getcomposer.org/)
- [PHP](https://www.php.net/)
- [SQLite](https://www.sqlite.org/index.html)

To install the back-end vendors, launch the following command:

```bash
cd project
composer install
```

### .env file

The `.env` file is mandatory to set up the site. The file should be located in the root of the project.
Copy the `.env.example` file and rename it to `.env`.

### Cache

To clear the cache, run the following command:

```bash
sh scripts/refresh_cache.sh
```

### Database

To create the database, run the following command:

```bash
php artisan migrate
```

### Seed

To seed the database, run the following command:

```bash
php artisan db:seed
```

## FRONT-END INSTALL

### Requirement

You will need to have the following installed:

- [Node.js](https://nodejs.org/en/)
- [NPM](https://www.npmjs.com/)

To compile the front-end assets, launch the following command to install the dependencies:

```bash
npm run development
```
Or, for minified assets:
```bash
npm run production
```

You should now see two new files within your projexts `public` folder:
- .public/css/app.min.css
- .public/js/app.min.js

To watch for changes, run the following command:

```bash
npm run start
```