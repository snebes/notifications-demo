# snebes/notifications-bundle Demo Application

The [snebes/notifications-bundle](https://www.github.com/snebes/notifications-bundle) Demo Application is a reference application created to show how to use [snebes/notifications](https://www.github.com/snebes/notifications) in a Symfony application.

### Requirements

- PHP 7.1.3 or higher
- PDO-SQLite

### Installation

Open your console terminal and run any of these commands to run this demo application from the directory you cloned:

```shell script
composer create-project snebes/notifications-demo
cd notifications-demo

bin/console doctrine:database:create --if-not-exists
bin/console doctrine:schema:update --force
bin/console doctrine:fixtures:load -n

symfony server:start
```

Open the displayed URL in your browser of choice.  Click the buttons to create example notifications.

### Demo

You can see the most recent database notifications directly in the application.  All mail notifications are spooled to disk and never sent.  They can be viewed under the `var/spool` folder.

### Screenshots

![screen:demo]

[screen:demo]: https://user-images.githubusercontent.com/666333/65102683-7355d100-d991-11e9-9a3f-3dc186df69fc.png
