

# My optimized CMS


## Requirements
1. use of PHP 8.1+
2. use of Laravel v10.0+
3. knowledge of Livewire v3.0+

## Theme and Packages used 
1. Livewire (https://livewire.laravel.com/)
2. Laravel-translatable (https://docs.astrotomic.info/laravel-translatable)
3. Laravel-excel (https://laravel-excel.com/)

## Installation
> If you want to continuously pull updates, fork it, and when updates are released sync a fork of a repository to keep it up-to-date with the upstream repository, or you can clone it.

```bash
 git clone https://github.com/..... my-project 
 cd my-project 
 composer install
 cp .env.example .env
 php artisan key:generate 

```
change database credentials that suit your system then:
```bash
php artisan optimize 
```
## Structure Overview 
The CMS comes with a full-featured access control system out of the box with module-based permission management.

this is the main structure schema, you can create modules depending on your needs.
### Example:
##### Let's assume that we want to create a services module:

1- Design database, make model and migration for the module 
```bash
php artisan make:model Service -m
```
2-  Create seeder, for module and permissions creation
```bash
php artisan make:seeder ServiceSeeder
```
now create the module and module-permissions using the seeder:
> You can create a module for permissions-module creation but the current structure depends on seeders.

3- Create needed livewire components 
```bash 
php artisan make:livewire Admin/Services/ServiceData
php artisan make:livewire Admin/Services/ServiceCreate
php artisan make:livewire Admin/Services/ServiceUpdate
php artisan make:livewire Admin/Services/ServiceDelete 
....
```
4- Create routes
```bash
// for full view design  
Route::view('services', 'livewire.admin.services.index')->name('services.index');
Route::view('services/create', 'livewire.admin.services.index')->name('services.create');
Route::view('services/{id}/update', 'livewire.admin.services.index')->name('services.update');
Route::view('services/{id}/show', 'livewire.admin.services.index')->name('services.show');
....
// OR 

// for modal design
Route::view('services', 'livewire.admin.services.index')->name('services.index');
```
5- Apply the required structure for the new module and add it to the backend menu

# theOptimizedCMS
