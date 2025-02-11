# Events Platform

This project is an Events Platform designed to help users discover local events and activities. It allows users to browse, create, and manage events in their area.

## Features

- **Event Management**: Create, read, update, and delete events.
- **Category Management**: Organize events into categories for easier navigation.
- **Location Management**: Specify locations for events, including address and coordinates.
- **User-Friendly Interface**: Intuitive views for listing and managing events.

## Installation

1. Clone the repository:
   ```
   git clone <repository-url>
   ```

2. Navigate to the project directory:
   ```
   cd events-platform
   ```

3. Install dependencies:
   ```
   composer install
   ```

4. Set up your environment file:
   ```
   cp .env.example .env
   ```

5. Generate the application key:
   ```
   php artisan key:generate
   ```

6. Run migrations:
   ```
   php artisan migrate
   ```

7. Seed the database (optional):
   ```
   php artisan db:seed
   ```

8. Start the development server:
   ```
   php artisan serve
   ```

## Usage

Visit `http://localhost:8000` in your browser to access the application. You can manage events, categories, and locations through the provided interface.

## Contributing

Contributions are welcome! Please open an issue or submit a pull request for any improvements or bug fixes.

## License

This project is licensed under the MIT License. See the LICENSE file for more details.