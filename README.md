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

1.  **Run all services (but Reverb)**

    ```sh
    composer run dev
    ```

1.  **Run Reverb**

    ```sh
    php artisan reverb:start --debug
    ```

    
Go to [localhost:8000/dashboard](http://localhost:8000/dashboard) and log in using the following credentials:

```
user: test@example.com
pass: password
```

Try to submit a new status and see it updated in real-time in all open tabs.

## Using with AnyCable

You can use AnyCable instead of Reverb. For that, run the app as follows:

```sh
BROADCAST_CONNECTION=anycable composer run dev
```

Then, launch AnyCable server (note: public mode is required for this app to work). For example:

```sh
anycable-go --public
```

## License

MIT.

## Acknowledgements

Based on this demo: https://github.com/novuhq/laravel-reverb-app
