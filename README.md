# Album

A simple PHP-based digital photo album with a page flipping interface. Users can browse pages and, after logging in, upload images that are stored in the application.

## Features

- Interactive album with swipe gestures (touch) or arrow-key navigation.
- Login system protected by a password stored in a `.env` file.
- Upload images through the back of each page; uploaded images are saved under `assets/upload/` and tracked in `res/storage.json`.
- Uses jQuery and SweetAlert for front‑end interactions.

## Requirements

- PHP 7.4+
- A web server capable of running PHP (the built-in PHP server is sufficient).

## Setup

1. Create a `.env` file in the project root and define a `PASSWORD` value:

   ```env
   PASSWORD=your_password_here
   ```

2. Start a local PHP server:

   ```sh
   php -S localhost:8000
   ```

3. Navigate to `http://localhost:8000` in your browser.

4. Use the "Login" button in the top-right corner and enter the password from the `.env` file to enable image uploads.

## Project Structure

- `Index.php` – main entry point rendering the album.
- `auth.php` – handles login requests using the password from `.env`.
- `upload_image.php` – processes image uploads and updates `res/storage.json`.
- `base_url.php` – determines the base URL for asset paths.
- `assets/` – static images and uploaded files.
- `res/` – JavaScript (`script.js`) and CSS (`style.css`) resources.

## License

This project is distributed under the MIT License.

