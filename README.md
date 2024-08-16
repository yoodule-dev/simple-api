# Simple Laravel API with Job Queue, Database, and Event Handling

## Objective

This project is a test implementation of a simple Laravel API demonstrating job queues, database operations, migrations, and event handling. The API processes user submissions via a background job, stores them in a database, and triggers an event to log the submission details.

## Requirements

- **API Endpoint**: The `/submit` endpoint accepts a `POST` request with the following JSON payload structure:
  ```json
  {
    "name": "John Doe",
    "email": "john.doe@example.com",
    "message": "This is a test message."
  }
  ```
- **Validation**: The `name`, `email`, and `message` fields are required.
- **Database Setup**: Use migrations to create a `submissions` table with the following columns:
  - `id`
  - `name`
  - `email`
  - `message`
  - `created_at`
  - `updated_at`
- **Job Queue**: Upon receiving the API request, a job is dispatched to save the data to the `submissions` table.
- **Event Handling**: After successfully saving the data, a `SubmissionSaved` event is triggered, which logs the `name` and `email`.
- **Error Handling**: Implements validation error handling and handles any job processing errors.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yoodule-dev/simple-api.git
   cd simple-api
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Create a `.env` file:
   ```bash
   cp .env.example .env
   ```

4. Update your `.env` file with your database credentials.

5. Run migrations to create the `submissions` table:
   ```bash
   php artisan migrate
   ```

6. Start the queue worker:
   ```bash
   php artisan queue:work
   ```

7. Serve the application:
   ```bash
   php artisan serve
   ```

## Usage

Send a `POST` request to `/api/submit` with the following JSON structure:

```json
{
  "name": "John Doe",
  "email": "john.doe@example.com",
  "message": "This is a test message."
}
```

Example using `curl`:
```bash
curl -X POST http://localhost:8000/api/submit \
-H "Content-Type: application/json" \
-d '{"name": "John Doe", "email": "john.doe@example.com", "message": "This is a test message."}'
```

Upon success, you will receive a `202` status code, and the data will be processed in the background.

## Testing

Run the unit tests with:
```bash
php artisan test
```

This will test the `/submit` endpoint for correct functionality and validation errors.

## Project Features

- **API Endpoint**: `/submit` to handle user submissions.
- **Job Queue**: Submission is processed in the background and saved to the database.
- **Event Handling**: Logs submission details after saving.
- **Error Handling**: Validates and handles any errors during processing.

