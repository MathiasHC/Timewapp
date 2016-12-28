'use strict';

//
// Gulp requirements.
// -------------------------------------------------------------
var gulp        = require('gulp'),
    concat      = require('gulp-concat'),
    sass        = require('gulp-sass'),
    uglify      = require('gulp-uglify'),
    minifyCSS   = require('gulp-cssnano'),
    del         = require('del'),
    livereload  = require('gulp-livereload');

//
// Tasks
// -------------------------------------------------------------
gulp.task('css', function() {
    return gulp.src('source/assets/sass/*.scss')
        .pipe(sass({
            errLogToConsole: true,
            compass: true,
            includePaths: ['./node_modules/compass-mixins/lib'],
            sourcemap: true,
            sourcemapPath: 'main.css'
        }))
        .pipe(minifyCSS())
        .pipe(gulp.dest('assets/css/'));
});

gulp.task('js', function() {
    var FILES = [ 'source/assets/js/*.js' ];
    gulp.src(FILES)
        .pipe(uglify()
            .on('error', function (error) {
                console.warn(error.message);
            }))
        .pipe(gulp.dest('assets/js/'));
});

gulp.task('jade', function() {
    var FILES = 'source/styleguide/**/*.jade';
    gulp.src(FILES)
        .pipe(jade({ pretty: true })
            .on('error', function (error) {
                console.warn(error.message);
            }))
        .pipe(gulp.dest('assets/styleguide/'));
});

gulp.task('images', function() {
    var FILES = 'source/assets/images/*.*';
    return gulp.src(FILES)
        .pipe(livereload(FILES, function(files) {
            return files.pipe( gulp.dest('assets/images/') );
        }));
});

gulp.task('fonts', function() {
    var FILES = 'source/assets/fonts/*.*';
    gulp.src(FILES)
        .pipe(livereload(FILES, function(files) {
            return files.pipe( gulp.dest('assets/fonts'));
        }));
});

gulp.task('clean', function(cb){
    return del(['assets/'], cb);
});

gulp.task('public', function() {
    var FILES = 'public/**/*.*';
    gulp.src(FILES)
        .pipe(livereload(FILES, function(files) {
            return files.pipe( gulp.dest('public/'));
        }));
});

// Let gulp keep an eye on our files and compile stuff if it changes.
gulp.task('watch', function() {
    livereload.listen({
        start: true
    });
    // Theme specific.
    gulp.watch('source/assets/sass/**/*.scss',['css']);
    gulp.watch('source/assets/js**/*.js',['js']);
    gulp.watch('source/assets/images/*.*',['images']);

});

// Bringing it all together in a build task.
gulp.task('build', ['js', 'css', 'images', 'fonts', 'public']);

// Default task.
gulp.task('default', ['clean'], function(){
    gulp.start('build', 'watch');
});
