# 🎬 Film Management Application for Media Library

A modern, responsive web application built with Laravel and vanilla JavaScript for managing a film collection in a media library. This project features a beautiful ocean-blue themed UI with complete CRUD operations and advanced filtering capabilities.

## 🌟 Features

### Core Functionality
- **Complete CRUD Operations**: Create, Read, Update, Delete films
- **Advanced Search & Filtering**: Real-time search by title, director, country, or description
- **Language Filtering**: Filter films by language
- **Dynamic Sorting**: Sort by title, release date, duration, or director
- **Responsive Design**: Works perfectly on desktop, tablet, and mobile devices

### Modern UI/UX
- **Ocean Blue Theme**: Beautiful gradient design with teal and gold accents
- **Interactive Tables**: Hover effects and smooth animations
- **Real-time Validation**: Form validation with visual feedback
- **Loading States**: Elegant loading spinners and transitions
- **Notifications**: Success/error notifications with animations
- **Modern Typography**: Inter font family for better readability

### Technical Features
- **RESTful API**: Complete REST API endpoints for all operations
- **AJAX Integration**: Seamless data loading without page refreshes
- **Database Seeding**: Pre-populated with sample film data
- **Form Validation**: Both client-side and server-side validation
- **Error Handling**: Comprehensive error handling and user feedback

## 🛠️ Technology Stack

- **Backend**: Laravel 10.x (PHP 8.1+)
- **Frontend**: Vanilla JavaScript, HTML5, CSS3
- **Database**: MySQL
- **Styling**: Bootstrap 5.3 + Custom CSS with CSS Variables
- **Icons**: Font Awesome 6.4
- **Fonts**: Google Fonts (Inter)
- **Build Tools**: Vite (Laravel Mix alternative)

## 📋 Database Schema

### Films Table
| Field | Type | Description |
|-------|------|-------------|
| id | bigint (PK) | Auto-increment primary key |
| titre | varchar(255) | Film title |
| realisateur | varchar(255) | Director name |
| pays | varchar(255) | Country of origin |
| date_sortie | date | Release date |
| description | text | Film description/synopsis |
| poster | varchar(255) | Poster image URL |
| duree | integer | Duration in minutes |
| langue | varchar(255) | Language |
| created_at | timestamp | Creation timestamp |
| updated_at | timestamp | Last update timestamp |

## 🚀 Installation & Setup

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL
- Node.js & npm
- XAMPP (recommended for local development)

### Step-by-Step Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/emnaot/Film-management-application-for-a-media-library.git
   cd Film-management-application-for-a-media-library
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   - Start XAMPP (Apache + MySQL)
   - Create database: `mini_projet_emna_othmen`
   - Update `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=mini_projet_emna_othmen
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Run migrations and seed data**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

9. **Access the application**
   - Main URL: http://127.0.0.1:8000
   - Films List: http://127.0.0.1:8000/films/liste
   - Add Film: http://127.0.0.1:8000/films/ajouter

## 📡 API Endpoints

### Films API
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/films` | Get all films |
| POST | `/api/films` | Create a new film |
| GET | `/api/films/{id}` | Get a specific film |
| PUT | `/api/films/{id}` | Update a film |
| DELETE | `/api/films/{id}` | Delete a film |

### API Response Format
```json
{
    "success": true,
    "message": "Operation successful",
    "data": {
        "id": 1,
        "titre": "Inception",
        "realisateur": "Christopher Nolan",
        "pays": "États-Unis",
        "date_sortie": "2010-07-16",
        "description": "A thief who infiltrates dreams...",
        "poster": "inception.jpg",
        "duree": 148,
        "langue": "Anglais",
        "created_at": "2024-01-03T12:42:07.000000Z",
        "updated_at": "2024-01-03T12:42:07.000000Z"
    }
}
```

## 🎨 UI Components & Features

### Film List Page
- **Searchable Table**: Real-time search across all film fields
- **Advanced Filters**: Language filter and sorting options
- **Action Buttons**: Edit and delete with confirmation dialogs
- **Responsive Cards**: Mobile-friendly card layout
- **Statistics**: Display total and filtered film counts

### Add/Edit Film Forms
- **Validation**: Real-time form validation with visual feedback
- **Dropdown Selections**: Pre-defined language and genre options
- **Date Picker**: HTML5 date input for release dates
- **Rich Textarea**: Multi-line description input
- **Loading States**: Button animations during form submission

### Modern Design Elements
- **Gradient Backgrounds**: Ocean blue to sky blue gradients
- **Hover Effects**: Smooth transitions and shadow effects
- **Badge System**: Color-coded badges for different data types
- **Icon Integration**: Font Awesome icons throughout the interface
- **Typography**: Consistent font hierarchy with Inter font family

## 🧪 Testing the API

### Using Postman or Thunder Client

1. **Get all films**
   ```
   GET http://127.0.0.1:8000/api/films
   ```

2. **Create a new film**
   ```
   POST http://127.0.0.1:8000/api/films
   Content-Type: application/json
   
   {
       "titre": "New Movie",
       "realisateur": "Director Name",
       "pays": "Country",
       "date_sortie": "2024-01-01",
       "description": "Movie description",
       "poster": "poster.jpg",
       "duree": 120,
       "langue": "English"
   }
   ```

3. **Update a film**
   ```
   PUT http://127.0.0.1:8000/api/films/1
   Content-Type: application/json
   
   {
       "titre": "Updated Title"
   }
   ```

4. **Delete a film**
   ```
   DELETE http://127.0.0.1:8000/api/films/1
   ```

## 📁 Project Structure

```
mini_projet_films/
├── app/
│   ├── Http/Controllers/
│   │   ├── FilmController.php          # API Controller
│   │   └── FilmViewController.php      # Web Controller
│   └── Models/
│       └── Film.php                    # Film Model
├── database/
│   ├── migrations/
│   │   └── create_films_table.php      # Database migration
│   └── seeders/
│       ├── DatabaseSeeder.php          # Main seeder
│       └── FilmSeeder.php              # Film data seeder
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php           # Main layout
│       └── films/
│           ├── liste.blade.php         # Films list page
│           ├── ajouter.blade.php       # Add film page
│           └── modifier.blade.php      # Edit film page
├── routes/
│   ├── api.php                         # API routes
│   └── web.php                         # Web routes
└── public/                             # Public assets
```

## 🎯 Key Features Explained

### Real-time Search & Filtering
The application implements client-side filtering for instant results:
- Search across multiple fields simultaneously
- Language-based filtering with dynamic dropdown population
- Multiple sorting options with smooth transitions

### Modern CSS Architecture
- **CSS Variables**: Consistent color scheme management
- **Flexbox & Grid**: Modern layout techniques
- **Responsive Design**: Mobile-first approach
- **Animation System**: Smooth transitions and hover effects

### Form Validation System
- **Client-side**: Immediate feedback with visual indicators
- **Server-side**: Laravel validation rules with detailed error messages
- **UX Enhancement**: Loading states and success animations

## 🔧 Customization

### Changing Colors
Modify the CSS variables in `resources/views/layouts/app.blade.php`:
```css
:root {
    --primary-color: #0891b2;      /* Main brand color */
    --accent-color: #f59e0b;       /* Accent/action color */
    --success-color: #059669;      /* Success states */
    --danger-color: #dc2626;       /* Error/danger states */
}
```

### Adding New Fields
1. Create a new migration
2. Update the Film model's `$fillable` array
3. Modify the form views
4. Update the API controller validation rules

## 🐛 Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Ensure XAMPP MySQL is running
   - Check database credentials in `.env`
   - Verify database exists

2. **Assets Not Loading**
   - Run `npm run build`
   - Clear browser cache
   - Check file permissions

3. **API Errors**
   - Verify CSRF token in requests
   - Check Laravel logs in `storage/logs/`
   - Ensure proper HTTP headers

## 📝 License

This project is open-source and available under the [MIT License](LICENSE).

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📸 Screenshots

### Films List Page
- Modern table with search and filtering capabilities
- Responsive design with hover effects
- Action buttons with confirmation dialogs

### Add/Edit Forms
- Clean, modern form design
- Real-time validation feedback
- Dropdown selections for better UX

### Mobile Responsive
- Optimized for all screen sizes
- Touch-friendly interface
- Collapsible navigation

---

⭐ **Star this repository if you found it helpful!**
