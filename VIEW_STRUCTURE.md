# View Structure Organization

This document describes the organized view structure for the## Controller Mapping

The views are mapped to controllers as follows:

### Main Application

-   `DashboardController@index` → `pages.main.dashboard`
-   Welcome page → `pages.welcome.welcome`

### Monitoring Features

-   `DashboardController@healthMonitoring` → `pages.monitoring.health-monitoring`
-   `DashboardController@subdomainStatus` → `pages.monitoring.subdomain-status`
-   `DashboardController@serverInfrastructure` → `pages.monitoring.server-infrastructure`
-   `DashboardController@realtimeMonitoring` → `pages.monitoring.realtime-monitoring`

### Administrative Features

-   `SpreadsheetLinkController` → `admin.spreadsheet-links.*`
-   Upload functionality → `admin.management.upload`

### Tools & Utilities

-   Logo guide → `tools.logo-guide`
-   Logo background remover → `tools.logo-background-remover`Dashboard Diskominfo Purwakarta application.

## Directory Structure

```
resources/views/
├── admin/                      # Admin panel views
│   ├── management/             # Administrative management
│   │   └── upload.blade.php    # File upload interface
│   └── spreadsheet-links/      # Spreadsheet link management
│       ├── index.blade.php     # List spreadsheet links
│       ├── create.blade.php    # Create new link
│       ├── edit.blade.php      # Edit existing link
│       └── show.blade.php      # View link details
├── auth/                       # Authentication views
│   ├── login.blade.php         # Login page
│   ├── register.blade.php      # Registration page
│   ├── forgot-password.blade.php
│   ├── reset-password.blade.php
│   ├── confirm-password.blade.php
│   └── verify-email.blade.php
├── components/                 # Reusable UI components
│   ├── ui/                     # UI components (buttons, cards, etc.)
│   └── charts/                 # Chart components
├── dashboard/                  # Dashboard-specific components
│   └── index.blade.php
├── layouts/                    # Layout templates
│   ├── app.blade.php           # Main application layout
│   ├── guest.blade.php         # Guest layout (login/register)
│   ├── navbar.blade.php        # Navigation bar component
│   └── navigation.blade.php    # Navigation component
├── pages/                      # Main application pages
│   ├── main/                   # Core application pages
│   │   └── dashboard.blade.php # Main dashboard page
│   ├── monitoring/             # Monitoring-related pages
│   │   ├── health-monitoring.blade.php      # Domain health monitoring
│   │   ├── realtime-monitoring.blade.php    # Real-time system monitoring
│   │   ├── server-infrastructure.blade.php  # Server infrastructure dashboard
│   │   └── subdomain-status.blade.php       # Subdomain activation status
│   └── welcome/                # Landing pages
│       ├── welcome.blade.php       # Main landing page
│       └── welcome-clean.blade.php # Clean landing page variant
├── profile/                    # User profile management
└── tools/                      # Utility tools and helpers
    ├── logo-background-remover.blade.php    # Logo background removal tool
    └── logo-guide.blade.php                 # Logo usage guide
```

## Functional Organization

### 1. **Authentication (`auth/`)**

-   All login, registration, and password-related views
-   Used by Laravel Breeze authentication system

### 2. **Administration (`admin/`)**

-   Admin panel interfaces
-   Spreadsheet link management
-   File upload interfaces

### 3. **Core Pages (`pages/`)**

-   Main application functionality
-   Dashboard and sub-pages organized by feature

### 4. **Monitoring (`pages/monitoring/`)**

-   All monitoring and analytics views
-   Domain health monitoring
-   Server infrastructure monitoring
-   Real-time system monitoring
-   Subdomain status tracking

### 5. **Tools (`tools/`)**

-   Utility applications
-   Logo manipulation tools
-   Help and guide pages

### 6. **Layouts (`layouts/`)**

-   Template files for consistent UI
-   Navigation components
-   Application shells

### 7. **Components (`components/`)**

-   Reusable UI elements
-   Shared template parts

## Controller Mapping

The views are mapped to controllers as follows:

-   `DashboardController@index` → `pages.dashboard`
-   `DashboardController@healthMonitoring` → `pages.monitoring.health-monitoring`
-   `DashboardController@subdomainStatus` → `pages.monitoring.subdomain-status`
-   `DashboardController@serverInfrastructure` → `pages.monitoring.server-infrastructure`
-   `DashboardController@realtimeMonitoring` → `pages.monitoring.realtime-monitoring`

## Benefits of This Organization

1. **Logical Grouping**: Related views are grouped by functionality

    - Monitoring features grouped together
    - Administrative functions separated
    - Welcome/landing pages isolated

2. **Easy Navigation**: Developers can quickly find relevant view files

    - Clear naming conventions
    - Intuitive directory structure
    - Functional separation

3. **Maintainability**: Changes to specific features are isolated to their directories

    - Bug fixes localized to specific modules
    - Feature updates don't affect unrelated views
    - Easier code reviews

4. **Scalability**: New features can be added in appropriate directories

    - New monitoring features go in `pages/monitoring/`
    - New admin features go in `admin/`
    - New tools go in `tools/`

5. **Clear Separation**: Authentication, admin, and user views are clearly separated

    - Security-sensitive views isolated
    - Different access levels organized
    - Role-based view organization

6. **Component Reusability**:

    - UI components can be shared across different pages
    - Chart components centralized for consistency
    - Layout templates provide consistent structure

7. **Development Efficiency**:
    - Faster file location
    - Reduced naming conflicts
    - Better team collaboration

## Note on Compiled Views

The compiled views in `storage/framework/views/` with random hash names are automatically generated by Laravel from these organized source files. These should not be manually edited as they are regenerated automatically.
