# Laravel AnyCable Demo

This is a minimal Laravel application that demonstrates how to use AnyCable as a broadcasting and Echo backend.

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

1.  **Run all services** (that would download and run AnyCable server as well)

    ```sh
    composer run dev
    ```
    
Go to [localhost:8000/dashboard](http://localhost:8000/dashboard) and log in using the following credentials:

```
user: test@example.com
pass: password
```

Try to submit a new status and see it updated in real-time in all open tabs.

### Using with Reverb

You can also run this project with the default Laravel Reverb WebSocket server without any code changes. Just update your configuration as follows:

- Set `BROADCAST_CONNECTION=reverb` in the `.env`

- Replace `php artisan anycable:server` with `php artisan reverb:start` in the process list of the `dev` command in the `composer.json` file.

## License

MIT.

## Acknowledgements

Based on this demo: https://github.com/novuhq/laravel-reverb-app
