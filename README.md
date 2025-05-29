# Laravel Reverb Demo App

## Prerequisites

You need PHP and Composer installed. Follow the [official Laravel docs](https://laravel.com/docs/12.x/installation) or just try the following command on MacOS:

```
/bin/bash -c "$(curl -fsSL https://php.new/install/mac/8.4)"
```

## Start the Project

Follow the steps below to install and run the project successfully:

1.  **Install all PHP dependencies**

    ```sh
    composer install
    ```

1.  **Generate a key for your project**

    ```sh
    php artisan key:generate
    ```

1.  **Install all JavaScript dependencies**

    ```sh
    npm install
    ```

1.  **Run migrations**

    ```sh
    php artisan migrate --migrate
    ```

1.  **Run the Queue via a terminal**

    ```sh
    php artisan queue:listen
    ```

1.  **Run Reverb via a terminal**

    ```sh
    php artisan reverb:start --debug
    ```

1.  **Run Vite via a terminal**

    ```sh
    npm run dev
    ```

1. **Run Laravel web server**

    ```sh
    php artisan serve
    ```

    
Go to [localhost:8000/dashboard](http://localhost:8000/dashboard) and log in using the following credentials:

```
user: test@example.com
pass: password
```

Try to submit a new status and see it updated in real-time in all open tabs.

## License

MIT.

## Acknowledgements

Based on this demo: https://github.com/novuhq/laravel-reverb-app
