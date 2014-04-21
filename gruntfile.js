module.exports = function(grunt) {

    var sassDir = 'src/Resources/sass/';
    var cssDir = 'htdocs/css/';

    grunt.initConfig({
        compass: {
            dist: {
                options: {
                    sassDir: sassDir,
                    cssDir: cssDir,
                    environment: 'production'
                }
            }
        },
        watch: {
            styles: {
                files: [ sassDir + '*.scss' ],
                tasks: [ 'compass' ]
            },
            gruntfile: {
                files: [ 'gruntfile.js' ],
                options: {
                    reload: true
                }
            },
            css: {
                files: [ cssDir + '*.css' ],
                options: {
                    livereload: true
                }
            }
        }
    });

    require('load-grunt-tasks')(grunt);
    grunt.registerTask('default', ['watch']);
};
