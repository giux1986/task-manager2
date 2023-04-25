INSTRUCTIONS

Clone the repository to your local machine using Git.
Install the necessary dependencies using Composer by running composer install from the project root directory.
Create a new MySQL database for the project.
Copy the .env.example file to a new file named .env and set the DB_DATABASE, DB_USERNAME, and DB_PASSWORD environment variables to match your database settings.
Generate a new application key by running php artisan key:generate.
Run the database migrations using php artisan migrate.
Seed the database with some sample data using php artisan db:seed.
Start the development server using php artisan serve.
Visit http://localhost:8000 in your web browser to view the application.


DB DIAGRAM:

users: This table stores information about each user of the system, such as their name, email, and password.

task_groups: This table stores information about each group of tasks, including a name and description.

tasks: This table stores information about each individual task, including a name, description, due date, and status.

task_group_user: This is a many-to-many relationship table that links users to the task groups they have access to.

task_task_group: This is a many-to-many relationship table that links tasks to the task groups they belong to.

+----------+         +----------------+         +--------+
|   users  |         |  task_groups   |         |  tasks |
+----------+         +----------------+         +--------+
| id       |         | id             |         | id     |
| name     |         | name           |         | name   |
| email    |         | description    |         | due_at |
| password |         +----------------+         | status |
+----------+                                      +--------+

+-----------------+       +-------------------+
| task_group_user |       | task_task_group   |
+-----------------+       +-------------------+
| user_id         |       | task_id           |
| task_group_id   |       | task_group_id     |
+-----------------+       +-------------------+
