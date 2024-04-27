### Luqman Ali ###
----------------- Employee Management System -----------------

### Overview ###
This Project a Employee Management System that facilitates the
management of departments and employees.
the system featuers : user authentication, CRUD operations for employees and departments,
relationships between them,soft delete.

### Database Tables ###
[1] Departments Table
The departments table stores information about the various departments within the organization. Each department has a unique identifier (id) and contains the following fields:
name: The name of the department.
description: A brief description or summary of the department's purpose or function.

[2] Employees Table
The employees table contains records for all the employees working within the organization. Each employee has a unique identifier (id) and includes the following fields:

first_name: The first name of the employee.
last_name: The last name of the employee.
email: The email address of the employee.
department_id: A foreign key referencing the id of the department to which the employee belongs.

[3] Projects Table
The projects table tracks information related to various projects undertaken by the organization. Each project has a unique identifier (id) and may include fields such as project name, description, start date, end date, etc. This table is utilized in the many-to-many relationship between employees and projects.

[4] Notes Table
The notes table serves as a flexible mechanism for attaching notes to either departments or employees. It is implemented using polymorphic relations and contains the following fields:

id: The unique identifier for the note record.
notable: The ID of the related entity (either department or employee).
note: The content or text of the note.

[5] employee_project
The employee_project table serves as a pivot table to establish a many-to-many relationship between employees and projects. This table facilitates the assignment of multiple employees to multiple projects and vice versa. It contains the following fields:

id: The unique identifier for the pivot record.
project_id: A foreign key referencing the id of the project to which an employee is assigned.
employee_id: A foreign key referencing the id of the employee assigned to a project.

### Relationships ###
One-to-Many Relationship between Employee and Department
In the Employee Management System, there exists a one-to-many relationship between employees and departments. This means that:
[1] One To Many
An employee belongs to a single department.
A department can have multiple employees.
This relationship is established by adding a department_id foreign key to the employees table, referencing the id primary key of the departments table.
[2] Many To Many
Many-to-Many Relationship between Employees and Projects
The system supports a many-to-many relationship between employees and projects, allowing employees to work on multiple projects and projects to involve multiple employees. This relationship is achieved through a pivot table called employee_project, which contains the foreign keys employee_id and project_id.
[3] Polymorphic Relations
Polymorphic Relations for Notes
Both departments and employees have the ability to have associated notes. This is implemented using polymorphic relations, where the notes table has two columns: notable and note.

### Installation ###
to install and run the project locally,follow this steps:
[1] clone the repository from GitHub:
https://github.com/luqman1it/EMS.git
[2]install dependencies
composer install
[3]Copy the '.env.example' file to '.env' and configure the database settings
[4]generate a new application key
php artisan key:generate
[5]run database migration
php artisan migrata
[6]start the development serve
php artisan serve