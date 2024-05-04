<p align="center"><img src="img/logo.png" alt="TODO" height="150px"></p>

## About
It's a web application that lets users add, modify, delete and mark tasks as completed, using JavaScript for interactivity, CSS for styling and PHP for server-side data management.

## Screenshots
![Todo List Screenshot](/img/img1.png)
![Todo List Screenshot](/img/img2.png)

# Installation guide

## Prérequis
- Make sure you have installed local server (WAMPP, Laragon, XAMPP, LAMPP or other if you know) is installed on your computer.
- Git

## Installation steps
1. Clone the project 
2. Copy to the www folder(Wampp) or htdocs folder(for Xampp, Lampp)
3. Configure your Apache server to point to the project folder.



# Configuration guide 

## Database
1. Create a new MySQL database name 'databse'
2. Import the `todo.sql` file into your new database.
3. If you want to change the database name, replace the text todo in process.php and list.php
```
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'dm';//change database name as yours
Global $dbconfig;
$dbconfig = mysqli_connect($host,$username,$password,$database) or die("An Error occured while connecting to the database");
```
If you want to change table name ,replace the text todo in both process.php and list.php
```
$result=mysqli_query($dbconfig,"SELECT * FROM todo");
```
4. Run the project on your browser. http://localhost/TODOLIST



# operating instructions

## Prérequis
- Run the project on your browser. http://localhost/TODOLIST

## Add a task 
1. Go to the application home page.
2. Enter the task name in the "New task" field and click "Add".

## Modifier une tâche
1. Click on the edit icon in front of the task in the list.
2. Modify the task name in the dialog box.
3. Click on "Ok".

## Delete a task
1. Click on the "Delete" button next to the task you wish to delete.
2. Click on "Ok".

## Mark a task as completed
1. Click on the "Complete" button next to the task you wish to mark as completed.


# Perform unit, integration and acceptance tests

## Install and verify PHPUnit
PHPUnit provides a framework for writing tests and a command-line tool for executing them. Before we move on to using PHPUnit, let's take a look at how to install and configure the PHP command-line interpreter.
You can consult the official phpunit documentation to install, configure and check https://docs.phpunit.de/en/11.1/installation.html.

## Perform tests
open the command prompt and enter the command "phpunit path". replace “path” with the path to your project's test directory.

![Perform tests command](/img/img3.png)

