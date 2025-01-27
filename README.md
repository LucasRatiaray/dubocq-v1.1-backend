# Laravel Artisan Commands Cheat Sheet

## Model Creation Command

Laravel provides a powerful Artisan command to generate models along with their associated files. The basic command structure is:

```bash
php artisan make:model <ModelName> -m -f
```

For the help menu, use:

```bash
php artisan make:model --help
```

### Command Flags Explanation

- `-m` or `--migration`: Creates a migration file for the model
- `-f` or `--factory`: Creates a factory file for the model
  
### Additional Flags

- `-s` or `--seed`: Creates a seeder file for the model
- `-c` or `--controller`: Creates a controller file for the model
- `-r` or `--resource`: Creates a resource file for the model
- `-a` or `--all`: Creates migration, factory, seeder, controller, and resource files
- `--pivot`: Indicates that the model is a pivot table

### Best Practices

1. Use singular, PascalCase names for your models (e.g., `Product`, `UserProfile`)
2. The migration will automatically create a plural, snake_case table name
3. Always review and customize the migration file before running migrations
4. Define proper factory states for different testing scenarios

### Additional Notes

- The migration file will be created with a timestamp prefix
- The factory file enables easy creation of test data
- Remember to define fillable or guarded properties in your model
- Add any relationships or custom methods to the model as needed

### After Generation

After generating the files, you should:

1. Add columns to the migration file
2. Define factory attributes
3. Add any necessary model relationships
4. Set model fillable/guarded properties
5. Run `php artisan migrate` to create the database table

## Migration Commands

Laravel provides several Artisan commands for managing database migrations. Here are some common commands:

### Running Migrations

To run all pending migrations, use:

```bash
php artisan migrate
```

For the help menu, use:

```bash
php artisan migrate --help
```

To rollback the last batch of migrations, use:

```bash
php artisan migrate:rollback
```

### Resetting and Refreshing

To rollback all migrations and re-run them, use:

```bash
php artisan migrate:refresh
```

To rollback all migrations and re-run them with seed data, use:

```bash
php artisan migrate:refresh --seed
```

### Rolling Back Specific Migrations

To rollback a specific migration batch, use:

```bash
php artisan migrate:rollback --step=3
```

### Additional Flags

- `--pretend`: See the SQL queries that would be run
- `--force`: Force the operation to run without confirmation
- `--path`: Specify the path to the migrations directory
- `--realpath`: Indicate that the path is a "real" path
- `--seed`: Seed the database after running migrations
- `--step`: Number of batches to rollback
- `--database`: Specify the database connection to use

### Additional Notes

1. Migrations are stored in the `database/migrations` directory
2. Each migration file contains `up()` and `down()` methods
3. Use `Schema` facade to define database schema changes
4. Migrations are timestamped to ensure order of execution

### Best Practices

1. Always review migrations before running them
2. Use migrations to modify database structure over time
3. Separate schema changes into multiple migrations
4. Seed initial data using seeders after migrations
5. Use database transactions for complex migrations
6. Write clean and readable migration files
7. Avoid modifying migrations that have already been run
8. Keep migrations in source control for versioning

### After Generation

After generating the migration file, you should:

1. Define the schema changes in the `up()` and `down()` methods
2. Add any necessary columns, indexes, or foreign keys
3. Run `php artisan migrate` to apply the migration
4. Rollback the migration if needed using `php artisan migrate:rollback`

## Seeder Commands

Laravel provides Artisan commands for generating seeders and seeding the database. Here are some common commands:

### Generating Seeders

To generate a seeder class, use:

```bash
php artisan make:seeder <SeederName>
```

For the help menu, use:

```bash
php artisan make:seeder --help
```

### Running Seeders

To seed the database with data, use:

```bash
php artisan db:seed
```

To seed a specific seeder class, use:

```bash
php artisan db:seed --class=<SeederName>
```

### Refreshing the Database

To refresh the database with seed data, use:

```bash
php artisan migrate:refresh --seed
```

### Additional Flags

- `--force`: Force the operation to run without confirmation
- `--database`: Specify the database connection to use
- `--class`: Specify the seeder class to run
- `--path`: Specify the path to the seeders directory
- `--realpath`: Indicate that the path is a "real" path

### Additional Notes

1. Seeders are stored in the `database/seeders` directory
2. Each seeder class contains a `run()` method to define data seeding
3. Use model factories to generate test data in seeders
4. Seeders are useful for populating the database with initial data
  
### Best Practices

1. Use seeders to populate the database with initial data
2. Create seeders for different types of data (e.g., users, products)
3. Use factories to generate test data in seeders
4. Seed data consistently across environments
5. Keep seeders in source control for versioning
6. Use seeders to populate lookup tables with static data
7. Use seeder classes to organize and group related data

### After Generation

After generating the seeder, you should:

1. Define the data to be seeded in the `run()` method
2. Use model factories to generate test data
3. Run `php artisan db:seed` to seed the database
4. Refresh the database with seed data using `php artisan migrate:refresh --seed`
5. Customize the seeder class as needed for different environments

## API Controller Creation Command

Laravel provides an Artisan command to generate API controllers with all necessary RESTful actions and form requests. The basic command structure is:

```bash
php artisan make:controller Api/V1/<ModelName>Controller --resource --model=<ModelName> --requests
```

For the help menu, use:

```bash
php artisan make:controller --help
```

### Command Flags Explanation

- `--resource`: Creates a RESTful resource controller with all standard methods
- `--model`: Automatically injects the specified model into controller methods
- `--requests`: Generates form request classes for validation

### Additional Flags
- `--force`: Overwrite existing files
- `--api`: Indicates that the controller is an API controller
- `--invokable`: Creates an invokable controller
- `--parent`: Specifies the parent class for the controller
- `--no-interaction`: Skip user interaction during generation

### Generated Files

This command will create:
1. A controller in `app/Http/Controllers/Api/V1/`
2. Form request classes in `app/Http/Requests/`
    - `Store<ModelName>Request.php`
    - `Update<ModelName>Request.php`

### Controller Methods

The generated controller includes these RESTful methods:
- `index()`: List all resources
- `store()`: Create a new resource
- `show()`: Display a specific resource
- `update()`: Update a specific resource
- `destroy()`: Delete a specific resource

### Best Practices

1. Use versioning in your API routes (V1, V2, etc.)
2. Utilize form requests for validation and authorization
3. Follow RESTful naming conventions
4. Keep controllers thin and move business logic to services
5. Use resource collections for consistent API responses

### After Generation

After generating the controller, you should:

1. Define validation rules in the form requests
2. Implement authorization logic if needed
3. Customize response formats
4. Add any additional methods required
5. Set up proper API routes in `routes/api.php`