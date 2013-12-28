'use strict';
module.exports = function(grunt) {

  grunt.initConfig({
    sass: {
      dist: {
        files: {
          'www/wp-content/themes/yana/style.css': [
            'www/wp-content/themes/yana/css/site.scss'
          ]
        },
        options: {
          unixNewlines: true,
          style: 'compact',
          precision: 5,
          sourceMap: false
        }
      }
    },
    coffee: {
      dist: {
        files: {
          'www/wp-content/themes/yana/js/yana.js': [
            'www/wp-content/themes/yana/js/*.coffee'
          ]
        }
      }
    },
    concat: {
      dist: {
        options: {
          separator: ';',
        },
        files: {
          "www/wp-content/themes/yana/yana.js": [
            'www/wp-content/themes/yana/js/vendor/!(modernizr).js',
            'www/wp-content/themes/yana/js/yana.js'
          ]
        }
      }
    },

    uglify: {
      dist: {
        files: {
          'www/wp-content/themes/yana/yana.min.js': [
            'www/wp-content/themes/yana/yana.js'
          ]
        }
      }
    },
    watch: {
      sass: {
        files: [
          'www/wp-content/themes/yana/css/*.scss'
        ],
        tasks: ['sass']
      },
      js: {
        files: [
          'www/wp-content/themes/yana/js/*.coffee',
          'www/wp-content/themes/yana/js/vendor/*'
        ],
        tasks: ['coffee', 'concat', 'uglify']
      }
    },
    clean: {
      dist: [
        'www/wp-content/themes/yana/style.css',
        'www/wp-content/themes/yana/style.min.css',
        'www/wp-content/themes/yana/js/yana.js',
        'www/wp-content/themes/yana/yana.js',
        'www/wp-content/themes/yana/yana.min.js'
      ]
    }
  });

  // Load tasks
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-coffee');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');

  // Register tasks
  grunt.registerTask('default', [
    'clean',
    'sass',
    'coffee',
    'concat',
    'uglify'
  ]);

  grunt.registerTask('dev', [
    'watch'
  ]);
};
