# 🚗 SPK EcoCarFinder

Web-based Decision Support System (SPK) for selecting eco-friendly cars using the Simple Additive Weighting (SAW) method. Built with Laravel 10 and MySQL.

---

## 📌 About The Project

SPK EcoCarFinder is a web application designed to help users determine the most suitable eco-friendly car based on multiple criteria such as fuel consumption, fuel efficiency, emissions, engine size and other relevant factors.

The system implements the **Simple Additive Weighting (SAW)** method to calculate ranking scores and provide objective recommendations.

---

## 🧮 Method Used

- Simple Additive Weighting (SAW)
- Multi-Criteria Decision Making (MCDM)

Steps implemented in the system:
1. Determining criteria and weights
2. Normalization process
3. Weighted scoring
4. Final ranking calculation

---

## 🛠️ Tech Stack

- Laravel 10.50.0
- PHP
- MySQL
- Bootstrap (if used)
- Laragon (local development)

---

## ⚙️ Installation Guide

### 1. Clone Repository
```bash
git clone https://github.com/fajrdyt/spk-ecocarfinder.git
cd spk-ecocarfinder
```
### 2. Install Dependencies
```bash
cp .env.example .env
php artisan key:generate
```
### 3. Setup Enviroment
```bash
cp .env.example .env
php artisan key:generate
```
### 4. Configure Database
Edit ```.env``` file and set your database credentials.
### 5. Run Migration
```bash
php artisan migrate
```
### 5. Start Development Server
```bash
php artisan serve
```