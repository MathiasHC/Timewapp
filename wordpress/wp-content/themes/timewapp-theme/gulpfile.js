var gulp              = require('gulp'),
    sass              = require('gulp-sass'),
    uglify            = require('gulp-uglify'),
    autoprefixer      = require('gulp-autoprefixer'),
    imagemin          = require('gulp-imagemin'),
    rename            = require('gulp-rename'),
    cache             = require('gulp-cache'),
    notify            = require('gulp-notify'),
    express           = require('express'),
    jshint            = require('gulp-jshint'),
    lr;


var EXPRESS_PORT    = 4000;
var EXPRESS_ROOT    = __dirname;
var LIVERELOAD_PORT = 35729;


function notifyLR(event) {
  var fileName = require('path').relative(EXPRESS_ROOT, event.path);
  lr.changed({
    body: { files: [fileName] }
  });
}

// Starts the express server
gulp.task('startExpress', function() {
  var app = express();
  app.use(require('connect-livereload')());
  app.use(express.static(EXPRESS_ROOT));
  app.listen(EXPRESS_PORT);
});

// Starts livereload
gulp.task('startLR', function() {
  lr = require('tiny-lr')();
  lr.listen(LIVERELOAD_PORT);
});

// Minifies and moves the styles to the dist folder
gulp.task('styles', function() {
    gulp.src('source/sass/**/*.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(autoprefixer('last 2 version'))
        .pipe(gulp.dest('assets/css'))
        .pipe(notify({ message: 'Styles updated' }))
});

// Minifies and moves the js to the dist folder
gulp.task('scripts', function() {
    gulp.src('source/js/*.js')
      .pipe(jshint({ lookup: false }))
      .pipe(jshint.reporter('default'))
      .pipe(uglify())
      .pipe(gulp.dest('assets/js'))
      .pipe(rename({suffix: '.min'}))
});

// Optimizes the images
gulp.task('images', function() {
    gulp.src('source/images/*')
        .pipe(cache(imagemin({ optimizationLevel: 5, progressive: true, interlaced: true })))
        .pipe(gulp.dest('assets/images'))
});

// Default start task
gulp.task('default', function() {
    gulp.start(
      'styles',
      'scripts',
      'images',
      'startExpress',
      'startLR',
      'watch'
    );
});

gulp.task('lint', function() {
  return gulp.src('./lib/*.js')

    .pipe(jshint.reporter('YOUR_REPORTER_HERE'));
});

// Watch all the folders for changes
gulp.task('watch', function() {
  gulp.watch('source/sass/*.scss', ['styles']);
  gulp.watch('source/js/**/*.js', ['scripts']);
  gulp.watch('source/images/**/*', ['images']);
  gulp.watch('assets/js/**/*.js', notifyLR);
  gulp.watch('assets/css/**/*.css', notifyLR);
  gulp.watch('**/*.html', notifyLR);
});
