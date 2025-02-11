events-platform
├── app
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── EventController.php
│   │   │   └── CategoryController.php
│   │   ├── Middleware
│   │   └── Requests
│   │       └── EventRequest.php
│   ├── Models
│   │   ├── Event.php
│   │   ├── Category.php
│   │   └── Location.php
├── database
│   ├── migrations
│   │   ├── create_events_table.php
│   │   ├── create_categories_table.php
│   │   └── create_locations_table.php
│   └── seeders
│       ├── EventSeeder.php
│       └── CategorySeeder.php
├── resources
│   ├── views
│   │   ├── events
│   │   │   ├── index.blade.php
│   │   │   ├── show.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   └── layouts
│   │       └── app.blade.php
├── routes
│   └── web.php
├── .env
├── composer.json
└── README.md