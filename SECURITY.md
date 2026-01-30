# ElectroMart Security Documentation

This document outlines the security measures, threats, risks, and mitigation strategies implemented in the ElectroMart Laravel 12 application.

## 1. Security Threats & Risks

### A. SQL Injection (SQLi)
- **Threat**: Attacker injects malicious SQL queries to bypass authentication or steal data.
- **Risk**: High. Data breach, unauthorized access.
- **Mitigation**: Laravel's **Eloquent ORM** and **Query Builder** use PDO parameter binding, making the application immune to most SQL injection vectors.

### B. Cross-Site Request Forgery (CSRF)
- **Threat**: Attacker tricks a victim into performing actions they didn't intend to.
- **Risk**: Medium. Unauthorized orders, account changes.
- **Mitigation**: Laravel's **VerifyCsrfToken middleware** automatically generates and validates CSRF tokens for every active user session managed by the application.

### C. Cross-Site Scripting (XSS)
- **Threat**: Injection of malicious scripts into web pages viewed by other users.
- **Risk**: Medium. Session hijacking, defacement.
- **Mitigation**: **Blade Templating Engine** automatically escapes all output (`{{ $var }}`). Input validation ensures only safe data is stored.

### D. Mass Assignment
- **Threat**: Attacker passes unexpected HTTP parameters to a model.
- **Risk**: Medium. Unauthorized modification of sensitive fields (e.g., `role`).
- **Mitigation**: Models use the `$fillable` property to explicitly define which attributes can be mass-assigned.

### E. Brute Force & Password Security
- **Threat**: Guessing passwords through repeated attempts.
- **Risk**: High. Account takeover.
- **Mitigation**: 
    - **Password Hashing**: Bcrypt/Argon2 via Laravel's `Hash` facade.
    - **Jetstream Rate Limiting**: Automatic throttling of login attempts.
    - **Strong Validation**: Enforced password rules during registration.

## 2. Secure Implementation Details

### API Authentication (Laravel Sanctum)
- Uses **Mobile Device Tokens** for lean and secure API access.
- Tokens are hashed in the database.
- Routes are protected via the `auth:sanctum` middleware.

### Authorization (RBAC)
- Implemented **Role-Based Access Control** using Laravel Gates.
- Admin routes are protected to ensure only users with the `admin` role can access management features.

### Session Security
- Sessions are stored securely with encrypted cookies.
- HTTPS is assumed for production environments (recommended).

### Input Validation
- All user inputs are validated using Laravel's **Validation** engine before processing, preventing malformed data from reaching the database.

## 3. Advanced Security Features

### Two-Factor Authentication (2FA)
- Integrated via **Laravel Jetstream**.
- Users can enable 2FA in their account settings, requiring a TOTP (Google Authenticator, etc.) for login.
- Recovery codes are provided for emergency access.

### Secure File Uploads
- Product images are validated for size and MIME types (`image|max:1024`).
- Uploads are stored on a private disk or a public folder with randomized filenames to prevent directory traversal.

### API Token Scopes
- Tokens generated via Sanctum support granular permissions (scopes).
- Routes are protected via the `auth:sanctum` middleware.

## 4. Security Implementation Checklist 
| Feature | Implementation Method |
|---------|------------------|
| SQL Injection Protection | Eloquent ORM & Parameter Binding |
| CSRF Protection | VerifyCsrfToken Middleware |
| XSS Protection | Blade Auto-Escaping |
| Secure Password Hashing | Bcrypt (Laravel Hash Facade) |
| API Security | Laravel Sanctum Token Auth |
| Authorization | Role-Based Gates & Policies |
| Rate Limiting | Throttle Middleware |

---
*Developed by Antigravity AI for ElectroMart Finalization.*
*Objective: Outstanding/Excellent Attempt (SSP2 Assignment)*
