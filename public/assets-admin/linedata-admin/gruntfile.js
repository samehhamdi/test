module.exports = function(grunt) {
  require("load-grunt-tasks")(grunt);

  var path = "";

  grunt.initConfig({
    jshint: {
      all: [path + "theme/js/main.js"]
    },

    uglify: {
      dist: {
        files: {
          "theme/js/main.min.js": [
            path + "bower_components/jquery/dist/jquery.min.js", 
            path + "bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js", 
            path + "bower_components/bootstrap/dist/js/bootstrap.min.js", 
            path + "bower_components/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js", 
            path + "theme/vendor/summernote/dist/summernote-bs4.js",
            path + "theme/js/main.js"
          ]
        }
      }
    },

    sass: {
      dist: {
        files: {
          "theme/css/main.css": path + "theme/sass/global.scss"
        }
      }
    },

    cssmin: {
      dist: {
        files: {
          "theme/css/main.min.css": [
            path + "bower_components/bootstrap/dist/css/bootstrap.min.css",
            path + "bower_components/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css",
            path + "theme/vendor/summernote/dist/summernote-bs4.css",
            path + "theme/css/main.css"

          ]
        }
      }
    },

    imagemin: {
      images: {
        files: [
          {
            expand: true,
            cwd: path + "theme/images/",
            src: ["**/*.{png,jpg,gif}"],
            dest: path + "theme/images/"
          }
        ]
      }
    },

    watch: {
      js: {
        files: ["theme/js/*.js", "!theme/js/main.min.js"],
        tasks: ["jshint", "uglify"],
        options: { spawn: false }
      },
      css: {
        files: [path + "theme/sass/**/*.scss"],
        tasks: ["sass"],
        options: {
          spawn: false,
          livereload: true
        }
      }
    }
  });

  grunt.registerTask("dist", ["jshint", "uglify", "sass", "cssmin", "imagemin"]);
};
