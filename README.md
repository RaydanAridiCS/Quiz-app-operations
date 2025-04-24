# Quiz App Project

## Overview

The Quiz App is a web-based application designed to create, manage, and take quizzes. It includes features for creating users, quizzes, questions, and options, as well as tracking scores.

## Database Structure

The application uses a relational database with the following tables:

1. **Users**
   - `User_ID` (Primary Key)
   - `Username`
   - `Email`
   - `Password`
   - `RegistrationDate`

2. **Quizzes**
   - `Quiz_ID` (Primary Key)
   - `Title`
   - `Description`
   - `CreatedBy` (Foreign Key referencing Users)
   - `CreationDate`
   - `IsPublished`

3. **Questions**
   - `Question_ID` (Primary Key)
   - `Quiz_ID` (Foreign Key referencing Quizzes)
   - `QuestionText`
   - `QuestionType`
   - `IsCorrect`

4. **Options** (for multiple-choice questions)
   - `Options_ID` (Primary Key)
   - `Question_ID` (Foreign Key referencing Questions)
   - `OptionText`
   - `IsCorrect`

5. **Scores**
   - `Score_ID` (Primary Key)
   - `UserID` (Foreign Key referencing Users)
   - `Quiz_ID` (Foreign Key referencing Quizzes)
   - `Score`
   - `DateTaken`
   - `TimeTaken`

## Setup

1. **Database Setup**
   - Create a MySQL database named `QuizApp`.
   - Import the `queries.sql` file to create the necessary tables and relationships.

2. **PHP Scripts**
   - Ensure that the `connection.php` file is correctly configured to connect to your MySQL database.
   - Place the PHP scripts (`create_user.php`, `login_user.php`, `create_quiz.php`, etc.) in the appropriate directory of your web server.

3. **Web Server**
   - Set up a web server (e.g., Apache, Nginx) to serve the PHP scripts.
   - Configure the server to handle PHP requests.

## Usage

1. **Creating Users**
   - Use the `create_user.php` script to add new users to the system.

2. **Logging In**
   - Use the `login_user.php` script to authenticate users.

3. **Creating Quizzes**
   - Use the `create_quiz.php` script to create new quizzes.

4. **Managing Questions and Options**
   - Use the `create_question.php`, `edit_question.php`, `delete_question.php`, `create_options.php`, `edit-options.php`, and `delete_option.php` scripts to manage questions and options.

