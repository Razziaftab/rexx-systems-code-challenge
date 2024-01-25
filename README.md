## Code Challenge

> Code Challenge for Rexx Systems read JSON file and data insert in Database. Then read data from Database and display data based on some filters.

## Developer Guide
    This Project is based on Core PHP and run via web server.

## Project Environments Versions
Below are versions I have used to complete this Task.
- Apache
- Composer
- PHP version 8.1
- Mysql version 10.5

## Installation & Setup
```
git clone https://github.com/Razziaftab/rexx-systems-code-challenge.git
cd rexx-code-challenge
composer install
composer dump-autoload

- Change the database driver, host, username, password and name according to your system in "config.php" file.
```

## Run the Tasks

`Run index.php file`

- Then you see the message "Data Inserted successfully".
- You also see the link to view the data. When you click on that new page will be open with data and filters.
- You can now search data using that filters.

## Technology Used

As the project is based on Core PHP and using the mysql database to insert and fetch the data.

## `Developer Contribution`

In this project I tried to solve this challenge by optimize way by using JSON parser library to reduce the load on memory for large JSON file and tried to handle the Exceptions.

This challenge will more be optimized like this:

- **I can also apply the pagination on view page if data will be large overtime.**
- **View Layer will be implemented in more proper way.**
- **Use the proper structure using classes and directories.**
