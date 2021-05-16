## Project Description
Automated Billing System. This system bills users. It is assumed that the users are to be automatically billed at a specified time of the day. If the system is to bill much more users, more scheduled jobs should be added and then the server should be scaled vertically upwards.

### Cloning the GitHub Repository.

Clone the repository to your local machine by running the terminal command below.

```bash
git clone https://github.com/Ojsholly/htl-task
```

### Setup Database

Create your a MySQL database and note down the required connection parameters. (DB Host, Username, Password, Name)

### Install Composer Dependencies

Navigate to the project root directory via terminal and run the following command.

```bash
composer install
```
### Create a copy of your .env file

Run the following command

```bash
cp .env.example .env
```

This should create an exact copy of the .env.example file. Name the newly created file .env and update it with your local environment variables (database connection info and others).

### Generate an app encryption key

```bash
php artisan key:generate
```

### Migrate the database

```bash
php artisan migrate
```

### Run the scheduled jobs for billing the users.

```bash
php artisan schedule:run
```

[MIT](https://choosealicense.com/licenses/mit/)
