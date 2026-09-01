# Finance System

<p align="center">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
</p>

---

## About the Project

**Finance System** is a Laravel-based financial management application designed to manage financial transactions, accounting entries, approvals, users, roles, documents, and financial reports.

The system uses:

- Laravel
- PHP
- MySQL
- Blade
- Tailwind CSS
- Vite
- Laravel Breeze
- Eloquent ORM
- Laravel Migrations
- Laravel Seeders
- Spatie Laravel Permission
- DomPDF
- Laravel Excel

The application is designed to provide a clean and structured interface for managing organizational financial transactions.

---

## Technology Stack

| Technology | Purpose |
|---|---|
| Laravel | Backend framework |
| PHP | Server-side programming |
| MySQL | Database |
| Blade | Server-side UI |
| Tailwind CSS | UI styling |
| Vite | Frontend asset bundling |
| Laravel Breeze | Authentication |
| Eloquent ORM | Database interaction |
| Laravel Migrations | Database structure |
| Laravel Seeders | Initial data |
| Spatie Permission | Roles and permissions |
| DomPDF | PDF generation |
| Laravel Excel | Excel import/export |

---

# Features

## Authentication

Laravel Breeze provides the authentication system.

Supported functionality includes:

- Login
- Logout
- Registration
- Password reset
- Authentication middleware
- User sessions

---

## User Management

The system can manage:

- Users
- Roles
- Permissions
- Departments
- User status
- User profiles

Example roles:

- Admin
- Manager
- Finance
- Staff

---

## Finance Forms

The finance module can support different transaction types.

### Transaction Types

- Journal Entry
- Income
- Direct Payment
- Reimbursement
- Disbursement
- Cash Advance
- Cash Advance Settlement
- Refund
- Receipt

---

## Accounting

Financial forms support accounting entries with:

- Debit
- Credit
- Amount
- Account Code
- Donor
- Program
- Project
- Cost Center
- Reference
- Remarks

The system keeps the transaction amount separate from accounting totals.

### Example

A transaction may have:

```text
Transaction Total: $20.00

Total Debit:       $320.00
Total Credit:      $320.00
Balance:           $0.00