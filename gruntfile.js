module.exports = function(grunt) {

    grunt.initConfig({
        compass: {
            dist: {
                options: {
                    sassDir: 'sass',
                    cssDir: 'htdocs/css',
                    environment: 'production'
                }
            }
        },
        watch: {
            styles: {
                files: [ 'sass/*.scss' ],
                tasks: [ 'compass' ]
            },
            gruntfile: {
                files: [ 'gruntfile.js' ],
                options: {
                    reload: true
                }
            },
            css: {
                files: [ 'htdocs/css/*.css' ],
                options: {
                    livereload: true
                }
            }
        }
    });

    require('load-grunt-tasks')(grunt);
    grunt.registerTask('default', ['watch']);
};
