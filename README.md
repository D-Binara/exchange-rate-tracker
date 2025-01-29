# Exchange Rate Tracker (USD/LKR)
A simple Laravel-based application to track and visualize the exchange rate of USD against LKR.

## Features
- Fetches USD/LKR exchange rates from [People’s Bank Sri Lanka](https://www.peoplesbank.lk/exchange-rates/).
- Stores exchange rate data in a database for historical tracking.
- Provides API endpoints for retrieving daily, weekly, and monthly exchange rate trends.
- Displays data using interactive graphs with Blade and Chart.js.
- Includes a scheduled cron job to update exchange rates automatically.

## Tech Stack
- **Backend:** Laravel
- **Frontend:** Blade, Chart.js
- **Database:** MySQL
- **API Integration:** Web scraping from People's Bank
- **Task Scheduling:** Laravel Cron Jobs

## Setup Instructions
### 1. Clone the Repository
```bash
git clone https://github.com/D-Binara/exchange-rate-tracker.git
cd exchange-rate-tracker
```
### 2. Install Dependencies
```bash
composer install
npm install
```
### 3. Configure Environment
- Copy the `.env.example` file and rename it to `.env`:
```bash
cp .env.example .env
```
- Set up your database connection in the `.env` file:
```env
DB_DATABASE=your_database_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```
- Generate the application key:
```bash
php artisan key:generate
```

### 4. Run Migrations
```bash
php artisan migrate
```

### 5. Schedule Exchange Rate Updates
Set up a cron job to run Laravel’s scheduler every minute:
```bash
php /path-to-your-project/artisan schedule:run
```

### 6. Run the Application
Start the Laravel development server:
```bash
php artisan serve
```
Visit `http://127.0.0.1:8000` in your browser.

## Graph Visualization
- Uses Chart.js to display exchange rate trends.
- Users can select between **daily, weekly, and monthly views**.

## Contributing
Feel free to fork this repository and submit pull requests for improvements.

## License
This project is licensed under the [MIT License](LICENSE).
