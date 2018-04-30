# codeigniter3x-migration
This project aims to facilitate migration system while developing applications with CodeIgniter 3.x

## Installation
Only, you have to copy all folders to application folder.<br />
**Note:** Don't modify any settings.

## Usage
The usage of this project is very easy. This project has only 3 commands.

### a. Create/Generate Migration File
If you want to create a migration file, you have to use followed command in terminal at root directory.
```
php index.php migration generate <fileName>
```
This command creates a migration file in **application/migrations** folder.

### b. Migrate all migration file
If you want to migrate all migrations file, you have to use followed command in terminal at root directory.
```
php index.php migration
or
php index.php migration latest
```

### c. Migrate a migration via **version**
If you want to migrate one migration via version, you have to use followed command in terminal at root directory.
```
php index.php migration version <versionkey>
```
**Note:** versionKey is the timestamp at the file name. 
