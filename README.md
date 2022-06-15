# Backend API(Laravel) installations
Follow the steps mentioned below to install and run the project.

Clone or download the repository
Go to the project directory and run composer install
Create .env file by copying the .env.example. You may use the command to do that cp .env.example .env
Update the database name and credentials in .env file
Run the command php artisan migrate:fresh --seed
You may create a virtualhost entry to access the application or run php artisan serve from the project root and visit http://127.0.0.1:8000