/*jshint node:true */

'use strict';

var gulp = require('gulp');
var gutil = require('gulp-util');
var spawn = require('child_process').spawn;
var sass = require('gulp-sass');
var sasslint = require('gulp-sass-lint');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');

var paths = {
  SASS_DIR: 'sass/',
  CSS_DIR: '.',

  init: function () {
    this.SASS = this.SASS_DIR + '**/*.scss';
    return this;
  }
}.init();

var spawned = [];
process.on('exit', function () {
  spawned.forEach(function (p) {
    p.kill();
  });
});

// Execute a command, logging output live while process runs
var spawnTask = function (command, args, cb) {
  spawned.push(
    spawn(command, args, {stdio: 'inherit'})
      .on('error', function (err) {
        cb(err);
        gutil.beep();
      })
      .on('exit', cb)
  );
};

gulp.task('default', ['watch', 'runserver']);

gulp.task('watch', function () {
  // lint and compile scss
  gulp.watch(paths.SASS, ['sasslint', 'sass']);
});

gulp.task('sass', function () {
  return gulp.src(paths.SASS_DIR + '*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.CSS_DIR));
});

gulp.task('sasslint', function () {
  return gulp.src(paths.SASS)
    .pipe(sasslint('.sass-lint.yml'))
    .pipe(sasslint.reporter())
    .pipe(sasslint.reporter('fail'));
});

gulp.task('runserver', function (cb) {
  spawnTask('make', ['serve'], cb);
});
