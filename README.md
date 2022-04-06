
# Restaurant POS System


### Install dependencies

    cd restaurantpos
    composer install


### Config file
Rename the **.env.example** to  **.env** file and fill in your database password 


### Database
    php artisan key:generate
    php artisan migrate
    php artisan db:seed

### Install Node Dependencies

1. `npm install`
2. `npm run dev` (sometime need run twice)

### Create permissions
1. `php artisan db:seed --class=PermissionTableSeeder`

### Create Admin Account

1. `php artisan db:seed --class=CreateAdminUserSeeder`
2. login with email: 'admin@gmail.com'
           password: 'admin123456'

### Link to local storage

    php artisan storage:link


### Run Project

1. `php artisan serve`






