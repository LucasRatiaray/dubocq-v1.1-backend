# Laravel Artisan Commands Cheat Sheet

## Model Creation Command

Laravel provides a powerful Artisan command to generate models along with their associated files. The basic command structure is:

```bash
php artisan make:model <ModelName> -m -f
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

## API Controller Creation Command

Laravel provides an Artisan command to generate API controllers with all necessary RESTful actions and form requests. The basic command structure is:

```bash
php artisan make:controller Api/V1/<ModelName>Controller --resource --model=<ModelName> --requests
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
