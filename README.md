# Mini Clinic Appointment System

A simple PHP application for managing clinic appointments. The project demonstrates routing, environment configuration, MVC-style organization, HTTP methods, JSON APIs, and proper HTTP status code handling.

---

## Features

### Home Page

* Display clinic information from `.env`
* Show available appointments
* Display doctor name, appointment date, available slots, and status

### Appointment API

#### GET /appointments

Returns the list of available appointments.

#### POST /appointments

Registers a patient for an appointment.

#### HEAD /appointments

Returns response headers without a response body.

#### OPTIONS /appointments

Returns supported HTTP methods.

---

## Project Structure

```text
project/
│
├── public/
│   └── index.php
│
├── src/
│   ├── Controller/
│   │   └── AppointmentController.php
│   │
│   ├── Data/
│   │   └── appointments.php
│   │
│   └── Support/
│       └── Env.php
│
├── views/
│   └── home.php
│
├── vendor/
│
├── .env
├── composer.json
└── README.md
```

---

## Requirements

* PHP 8.0+
* Composer

---

## Installation

### 1. Clone the repository

```bash
git clone <repository-url>
cd mini-clinic
```

### 2. Install dependencies

```bash
composer install
```

### 3. Create .env file

```env
CLINIC_NAME=Mini Clinic
```

### 4. Start local server

```bash
php -S localhost:8000 -t public
```

Open:

```text
http://localhost:8000
```

---

## API Endpoints

### GET /appointments

Request:

```http
GET /appointments
```

Response:

```json
[
  {
    "id": 1,
    "doctor": "Dr. An",
    "date": "2026-05-01",
    "total": 10,
    "available": 3,
    "status": "Open"
  }
]
```

Status Code:

```text
200 OK
```

---

### POST /appointments

Request:

```http
POST /appointments
Content-Type: application/json
```

Body:

```json
{
  "patient_name": "Nguyen Van A",
  "appointment_id": 1,
  "quantity": 1
}
```

Successful Response:

```json
{
  "message": "Appointment registered successfully",
  "patient_name": "Nguyen Van A",
  "appointment_id": 1
}
```

Status Code:

```text
201 Created
```

---

## Error Handling

### 415 Unsupported Media Type

Occurs when request Content-Type is not application/json.

Response:

```json
{
  "error": "Unsupported Media Type"
}
```

---

### 422 Invalid JSON

Response:

```json
{
  "error": "Invalid JSON"
}
```

---

### 422 Missing Patient Name

Response:

```json
{
  "error": "Patient name is required"
}
```

---

### 422 Invalid Patient Name Type

Response:

```json
{
  "error": "Patient name must be string"
}
```

---

### 422 Missing Appointment ID

Response:

```json
{
  "error": "Appointment ID is required"
}
```

---

### 422 Invalid Appointment ID Type

Response:

```json
{
  "error": "Appointment ID must be integer"
}
```

---

### 404 Appointment Not Found

Response:

```json
{
  "error": "Appointment not found"
}
```

---

### 422 No Slots Available

Response:

```json
{
  "error": "No slots available"
}
```

---

### 422 Exceeds Available Slots

Response:

```json
{
  "error": "Exceeds available slots"
}
```

---

### 405 Method Not Allowed

Response:

```json
{
  "error": "Method Not Allowed"
}
```

---

### 404 Not Found

Response:

```json
{
  "error": "Not Found"
}
```

---

## Supported HTTP Methods

| Endpoint      | Method  | Description            |
| ------------- | ------- | ---------------------- |
| /             | GET     | Home page              |
| /appointments | GET     | List appointments      |
| /appointments | POST    | Register appointment   |
| /appointments | HEAD    | Return headers only    |
| /appointments | OPTIONS | Return allowed methods |

---

## Sample cURL Commands

### Get Appointments

```bash
curl http://localhost:8000/appointments
```

### Register Appointment

```bash
curl -X POST http://localhost:8000/appointments \
-H "Content-Type: application/json" \
-d '{
  "patient_name":"Nguyen Van A",
  "appointment_id":1,
  "quantity":1
}'
```

### HEAD Request

```bash
curl -I http://localhost:8000/appointments
```

### OPTIONS Request

```bash
curl -X OPTIONS http://localhost:8000/appointments
```

---

## Author

Mini Clinic Appointment System

Developed for learning purposes: PHP Routing, MVC Structure, RESTful API Design, HTTP Methods, Status Codes, and Environment Configuration.
