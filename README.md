INSERT MANDATORY GIF

# Wunderlist - A simple to do list

A task management application built with PHP. It takes tasks submitted by user in a form and saves them in a SQLite database. PDO is used to access the database and present the results.

As a user you are able to:

-   Create and delete your account
-   Login and out
-   Update your email and password
-   Upload, update and delete your profile picture
-   Add tasks along with a checklist(subtasks)
-   Update or delete tasks and subtasks
-   Mark tasks and subtasks as done or undone
-   Set deadlines for your tasks

# Getting started

1. #### Clone this repo to your desired folder

    ```
    git clone https://github.com/marcusxyz/wunderlist.git
    ```

2. #### Start a local server

    ```
    php -S localhost:8000
    ```

3. #### Open [http://localhost:8000/php/index.php](http://localhost:8000/php/index.php) in your browser of choice

# Code Review

Code review written by [Christopher Michael](https://github.com/chrs-m/).

1. `index.php:28` - Greeted by a 'undefined variable' and a 'fatal error' when logging in.
2. `index.php:28-32` - Could not use the application due to errors. Nothing loads on index.php. Needed to remove if-statement to see anything.
3. `index.php:83-105` - The big grey task-container is visible eventhough it's empty (under "Your tasks"). Could reuse if-stamtment to hide it while empty.
4. `update-avatar.php` - Cannot change profile picture. Nothing happens and when you try to save you get "No changes has been made".
5. `edit-task.php:85` - Don't know if its a feature or not, but you get task-ids displayed on your subtasks.
6. `delete-profile.php:38` - Would be nice if lists, posts etc also got deleted when removing the account.
7. `index.js:36-42` - You might want to toggle/add a class instead of styling with JS.
8. `profile.php:86` - Loading index.js again when it's already being loaded via the footer (same in index.php).
9. `index.php:144` - The footer is not required in (same in profile, signin, signup and delete).
10. `index.js:10-23` - _(Nitpick)_ You might want to remove code thats not being used instead of having it commented out.
11. `update-email.php:38-72` - _(Nitpick)_ You might want to remove code thats not being used instead of having it commented out..

Overall a nice looking to-do application! A lot of good implementations and functions. Nicely done with the subtasks! Got to give cred for the comments throughout the code. Well done Marcus! 👍🏼

# Testers

Tested by the following people:

1. Christopher Michael
2. Johanna Jönsson
