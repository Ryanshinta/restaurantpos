
# Start The Project


### Install dependencies

    cd restaurantpos
    composer install


### Config file
Rename the **.env.example** to  **.env** file and fill in your database password 


### DataBase
    php artisan key:generate
    php artisan migrate
    php artisan db:seed

### Install Node Dependencies

1. `npm install`
2. `npm run dev` (sometime need run twice)

### Create Admin Account

1. `php artisan tinker` and than paste
    ```php
    App\Models\User::create([
        'name'=>'Admin',
        'email'=>'admin@gmail.com',
        'password' => bcrypt('admin')
    ]);
    ```

Run Project

1. `php artisan serve`






