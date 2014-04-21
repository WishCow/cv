This is the engine behind my cv site.

Installation steps:
* Run composer install to get the PHP depedencies
* Run npm install to get the grunt modules
* Copy src/data/sample.yml to src/data/cv.yml, and fill out the details
* (Optional) pass the DEBUG environment variable to the application, to enable debug mode

If the application is in debug mode, it will include the necessary javascript file for automatic browser refreshing with Grunt, and it will provide nice error messages if something goes wrong.

Grunt is set up to watch the sass files for modifications, and it automatically compiles them into css. The project requires PHP 5.5 due to the short array syntax, but it's trivial to modify it to be 5.3 compliant, if needed.
