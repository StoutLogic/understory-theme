import gulp from 'gulp';
import babelify from 'babelify';
import browserify from 'browserify';
import source from 'vinyl-source-stream';
import buffer from 'vinyl-buffer';
import glob from 'glob';
import handleErrors from '../util/handleErrors';
import browserSync from 'browser-sync';
import modernizr from 'gulp-modernizr';
import uglify from 'gulp-uglify';
import {javascript as config} from '../config';
import debowerify from 'debowerify';
import gulpif from 'gulp-if';

const env = process.env.NODE_ENV || 'development';

gulp.task('javascript', ['components', 'modernizr'], () => {
  const bundler = browserify({
    entries: config.src + '/main.js',
    debug: env === 'development',
  })

  // Use Babel to transpile ES6 -> ES5
  .transform(
    babelify.configure({
      optional: [
        'runtime', // Allows us to use Object.assign, useful for merging objects
      ],
    })
  )
  .transform(debowerify);

  bundler.bundle()
  .pipe(source('all.js'))
  .pipe(gulpif(env === 'production', buffer()))
  .pipe(gulpif(env === 'production', uglify()))
  .pipe(gulp.dest(config.dest))
  .pipe(browserSync.reload({
    stream: true,
  }));
});

gulp.task('components', () => {
  const files = glob.sync(config.src + '/../components/**/main.js');

  files.map((entry) => {
    const bundler = browserify(
      {
        entries: [entry],
        debug: env === 'development',
      })

    .on('error', handleErrors)

    .transform(
      babelify.configure({
        optional: [
          'runtime', // Allows us to use Object.assign, useful for merging objects
        ],
      })
    )

    .transform(debowerify);

    bundler.bundle()
    .on('error', handleErrors)
    .pipe(source(entry.replace(config.src + '/../', '').replace('/main.js', '.js')))
    .pipe(gulp.dest(config.dest));
  });

  return true;
});

gulp.task('modernizr', () => {
  return gulp.src([
      config.src + '**/*.js',
      config.src + '../components/**/*.js',
    ])
    .pipe(modernizr({
      'options': [
        'setClasses',
      ],
      'tests': ['touchevents'],
    }))
    .pipe(uglify())
    .pipe(gulp.dest(config.dest));
});
